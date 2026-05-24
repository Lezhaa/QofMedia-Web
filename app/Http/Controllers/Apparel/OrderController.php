<?php

namespace App\Http\Controllers\Apparel;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Daftar semua order — admin apparel
     */
    public function index(Request $request)
    {
        $query = Order::with(['user', 'product', 'variant']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('payment_method')) {
            $query->where('payment_method', $request->payment_method);
        }

        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->payment_status);
        }

        $orders = $query->latest()->paginate(15);

        return view('apparel.orders.index', compact('orders'));
    }

    /**
     * Detail satu order
     */
    public function show(Order $order)
    {
        $order->load(['user', 'product', 'variant.model.edition']);
        return view('apparel.orders.show', compact('order'));
    }

    /**
     * STEP 1: Validasi bukti transfer (tanpa mengubah status order)
     * - Hanya untuk payment_method = manual_transfer
     * - Update payment_proof_validated (pending/valid/invalid)
     */
    public function validateProof(Request $request, Order $order)
    {
        $request->validate([
            'payment_proof_validated' => 'required|in:pending,valid,invalid',
            'catatan_admin' => 'nullable|string|max:500',
        ]);

        // Validasi: hanya untuk manual transfer
        if ($order->payment_method !== 'manual_transfer') {
            return redirect()->route('apparel.orders.show', $order)
                ->with('error', 'Validasi bukti transfer hanya untuk metode pembayaran manual transfer.');
        }

        // Jika sudah disetujui atau ditolak, tidak bisa divalidasi lagi
        if ($order->status !== 'menunggu') {
            return redirect()->route('apparel.orders.show', $order)
                ->with('error', 'Order ini sudah diproses, tidak dapat mengubah status validasi bukti.');
        }

        $oldStatus = $order->payment_proof_validated ?? 'pending';
        
        $order->update([
            'payment_proof_validated' => $request->payment_proof_validated,
            'catatan_admin' => $request->catatan_admin ?? $order->catatan_admin,
        ]);

        if ($request->payment_proof_validated === 'valid') {
            Notification::create([
                'user_id' => $order->user_id,
                'type'    => 'order_proof_validated',
                'title'   => 'Bukti Transfer Diverifikasi ✅',
                'message' => "Bukti transfer pesanan #{$order->id} sudah diverifikasi. Menunggu konfirmasi akhir dari admin.",
                'url'     => route('user.orders.show', $order->id),
                'data'    => ['order_id' => $order->id],
            ]);
        } elseif ($request->payment_proof_validated === 'invalid') {
            Notification::create([
                'user_id' => $order->user_id,
                'type'    => 'order_rejected',
                'title'   => 'Bukti Transfer Tidak Valid ❌',
                'message' => "Bukti transfer pesanan #{$order->id} dinyatakan tidak valid oleh admin. Silakan upload ulang.",
                'url'     => route('user.orders.show', $order->id),
                'data'    => ['order_id' => $order->id],
            ]);
        }

        $statusText = [
            'valid' => 'VALID (disetujui)',
            'invalid' => 'TIDAK VALID (ditolak)',
            'pending' => 'PENDING (perlu ditinjau ulang)'
        ];

        Log::info("Admin validasi bukti Order #{$order->id} dari '{$oldStatus}' menjadi '{$request->payment_proof_validated}'");

        return redirect()->route('apparel.orders.show', $order)
            ->with('success', 'Status bukti pembayaran berhasil diubah menjadi ' . $statusText[$request->payment_proof_validated]);
    }

    /**
     * STEP 2: Setujui order transfer manual
     * - Hanya untuk payment_method = manual_transfer
     * - Status harus "menunggu"
     * - payment_proof_validated harus "valid"
     * - Potong stok
     */
    public function approve(Request $request, Order $order)
    {
        $validated = $request->validate([
            'catatan_admin' => 'nullable|string|max:500',
        ]);

        // Validasi: hanya untuk manual transfer
        if ($order->payment_method !== 'manual_transfer') {
            return redirect()->route('apparel.orders.show', $order)
                ->with('error', 'Order dengan payment gateway otomatis tidak perlu approve manual.');
        }

        if ($order->status !== 'menunggu') {
            return redirect()->route('apparel.orders.show', $order)
                ->with('error', 'Order ini sudah diproses sebelumnya.');
        }

        // Validasi: bukti transfer harus sudah divalidasi sebagai VALID
        if (($order->payment_proof_validated ?? 'pending') !== 'valid') {
            return redirect()->route('apparel.orders.show', $order)
                ->with('error', 'Harap validasi bukti transfer terlebih dahulu sebagai "Valid" sebelum menyetujui pesanan.');
        }

        DB::beginTransaction();
        try {
            // Potong stok
            if ($order->product_type === 'kaos' && $order->variant_id) {
                $variant = $order->variant;
                if (!$variant) {
                    DB::rollBack();
                    return redirect()->route('apparel.orders.show', $order)
                        ->with('error', 'Varian tidak ditemukan.');
                }
                if ($variant->stock < $order->qty) {
                    DB::rollBack();
                    return redirect()->route('apparel.orders.show', $order)
                        ->with('error', "Stok varian hanya {$variant->stock} pcs, tidak cukup untuk pesanan {$order->qty} pcs.");
                }
                $variant->decrement('stock', $order->qty);
            } else {
                $product = $order->product;
                if (!$product) {
                    DB::rollBack();
                    return redirect()->route('apparel.orders.show', $order)
                        ->with('error', 'Produk tidak ditemukan.');
                }
                if ($product->stock < $order->qty) {
                    DB::rollBack();
                    return redirect()->route('apparel.orders.show', $order)
                        ->with('error', "Stok produk hanya {$product->stock} pcs, tidak cukup untuk pesanan {$order->qty} pcs.");
                }
                $product->decrement('stock', $order->qty);
            }

            $order->update([
                'status'         => 'disetujui',
                'payment_status' => 'paid',
                'paid_at'        => now(),
                'catatan_admin'  => $validated['catatan_admin'] ?? $order->catatan_admin,
            ]);

            Notification::create([
                'user_id' => $order->user_id,
                'type'    => 'order_approved',
                'title'   => 'Pesanan Disetujui 🎉',
                'message' => "Pesanan #{$order->id} Anda telah disetujui dan sedang diproses. Terima kasih!",
                'url'     => route('user.orders.show', $order->id),
                'data'    => ['order_id' => $order->id],
            ]);

            DB::commit();

            Log::info("Admin approve Order #{$order->id} (manual transfer) — stok dipotong {$order->qty} pcs.");

            return redirect()->route('apparel.orders.show', $order)
                ->with('success', 'Pesanan berhasil disetujui dan stok telah dikurangi.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Error approve Order #{$order->id}: " . $e->getMessage());
            return redirect()->route('apparel.orders.show', $order)
                ->with('error', 'Terjadi kesalahan saat memproses persetujuan: ' . $e->getMessage());
        }
    }

    /**
     * STEP 2: Tolak order — stok tidak dipotong
     * - payment_proof_validated disarankan sudah "invalid" (tapi tidak wajib)
     */
    public function reject(Request $request, Order $order)
    {
        $validated = $request->validate([
            'catatan_admin' => 'required|string|max:500',
        ]);

        if ($order->status !== 'menunggu') {
            return redirect()->route('apparel.orders.show', $order)
                ->with('error', 'Order ini sudah diproses sebelumnya.');
        }

        $order->update([
            'status'         => 'ditolak',
            'payment_status' => 'failed',
            'catatan_admin'  => $validated['catatan_admin'],
        ]);

        Notification::create([
            'user_id' => $order->user_id,
            'type'    => 'order_rejected',
            'title'   => 'Pesanan Ditolak ❌',
            'message' => "Pesanan #{$order->id} ditolak. Alasan: {$validated['catatan_admin']}",
            'url'     => route('user.orders.show', $order->id),
            'data'    => ['order_id' => $order->id],
        ]);

        Log::info("Admin reject Order #{$order->id} — alasan: {$validated['catatan_admin']}");

        return redirect()->route('apparel.orders.show', $order)
            ->with('success', 'Pesanan telah ditolak.');
    }

    /**
     * STEP 3: Tandai order sebagai Sedang Dipacking
     * - Status harus "disetujui"
     */
    public function packing(Order $order)
    {
        if ($order->status !== 'disetujui') {
            return redirect()->route('apparel.orders.show', $order)
                ->with('error', 'Hanya order berstatus "Disetujui" yang dapat dipindah ke Sedang Dipacking.');
        }

        $order->update(['status' => 'packing', 'packing_at' => now()]);

        Notification::create([
            'user_id' => $order->user_id,
            'type'    => 'order_packing',
            'title'   => 'Pesanan Sedang Dipacking 📦',
            'message' => "Pesanan #{$order->id} Anda sedang dalam proses packing dan akan segera dikirim.",
            'url'     => route('user.orders.show', $order->id),
            'data'    => ['order_id' => $order->id],
        ]);

        Log::info("Admin tandai Order #{$order->id} sebagai Sedang Dipacking.");

        return redirect()->route('apparel.orders.show', $order)
            ->with('success', 'Pesanan berhasil ditandai Sedang Dipacking.');
    }

    /**
     * STEP 4: Tandai order sebagai Sudah Dikirim
     * - Status harus "packing"
     * - Bisa menyertakan nomor resi / info pengiriman di catatan_admin
     */
    public function kirim(Request $request, Order $order)
    {
        $validated = $request->validate([
            'tracking_number' => 'required|string|max:100',
            'catatan_admin'   => 'nullable|string|max:500',
        ]);

        if ($order->status !== 'packing') {
            return redirect()->route('apparel.orders.show', $order)
                ->with('error', 'Hanya order berstatus "Sedang Dipacking" yang dapat ditandai sebagai Dikirim.');
        }

        $order->update([
            'status'          => 'dikirim',
            'tracking_number' => $validated['tracking_number'],
            'shipped_at'      => now(),
            'catatan_admin'   => $validated['catatan_admin'] ?? $order->catatan_admin,
        ]);

        $resiInfo = " No. Resi: {$validated['tracking_number']}";

        Notification::create([
            'user_id' => $order->user_id,
            'type'    => 'order_shipped',
            'title'   => 'Pesanan Sudah Dikirim 🚚',
            'message' => "Pesanan #{$order->id} Anda telah dikirim.{$resiInfo}",
            'url'     => route('user.orders.show', $order->id),
            'data'    => ['order_id' => $order->id],
        ]);

        Log::info("Admin tandai Order #{$order->id} sebagai Sudah Dikirim." . ($validated['catatan_admin'] ? " Resi: {$validated['catatan_admin']}" : ''));

        return redirect()->route('apparel.orders.show', $order)
            ->with('success', 'Pesanan berhasil ditandai Sudah Dikirim.');
    }

    /**
     * Hapus order
     * - Hanya untuk order dengan status 'ditolak' atau 'menunggu'
     * - Order yang sudah disetujui tidak bisa dihapus
     */
    public function destroy(Order $order)
    {
        // Cek apakah order boleh dihapus
        if (in_array($order->status, ['disetujui', 'packing', 'dikirim'])) {
            return redirect()->route('apparel.orders.index')
                ->with('error', 'Order yang sudah diproses (disetujui/packing/dikirim) tidak dapat dihapus.');
        }

        // Simpan informasi untuk log
        $orderId = $order->id;
        $customerName = $order->pemesan_name;

        // Hapus file bukti transfer jika ada
        if ($order->payment_proof && file_exists(storage_path('app/public/' . $order->payment_proof))) {
            unlink(storage_path('app/public/' . $order->payment_proof));
            Log::info("File bukti transfer Order #{$orderId} dihapus: {$order->payment_proof}");
        }

        // Hapus order
        $order->delete();

        Log::info("Admin menghapus Order #{$orderId} milik {$customerName}");

        return redirect()->route('apparel.orders.index')
            ->with('success', "Order #{$orderId} milik {$customerName} berhasil dihapus.");
    }
}