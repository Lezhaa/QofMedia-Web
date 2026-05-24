<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\ApparelProduct;
use App\Models\TshirtVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    /**
     * STORE — Buat order baru dari form pemesanan
     * Pembayaran: transfer manual + upload bukti
     */
    public function store(Request $request)
    {
        // ── 1. Validasi Input ─────────────────────────────────
        $validated = $request->validate([
            'product_id'      => 'required|exists:apparel_products,id',
            'variant_id'      => 'nullable|exists:tshirt_variants,id',
            'qty'             => 'required|integer|min:1',
            'pemesan_name'    => 'required|string|max:255',
            'pemesan_phone'   => 'required|string|max:20',
            'provinsi'        => 'required|string|max:100',
            'kab_kota'        => 'required|string|max:100',
            'alamat_detail'   => 'required|string',
            'kode_pos'        => 'required|string|max:10',
            'catatan_user'    => 'nullable|string',
            'payment_proof'   => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'payment_message' => 'nullable|string',
        ]);

        // ── 2. Ambil Produk & Variant ─────────────────────────
        $product = ApparelProduct::findOrFail($validated['product_id']);

        $variant = null;
        if ($product->type === 'kaos' && !empty($validated['variant_id'])) {
            $variant = TshirtVariant::findOrFail($validated['variant_id']);
        }

        // ── 3. Kalkulasi Harga ────────────────────────────────
        $price      = $variant ? $variant->price : $product->price;
        $totalPrice = $price * $validated['qty'];

        // ── 4. Validasi Stok ──────────────────────────────────
        if ($variant) {
            if ($variant->stock < $validated['qty']) {
                return back()->withInput()->with('error', 'Stok varian tidak mencukupi.');
            }
        } else {
            if ($product->stock < $validated['qty']) {
                return back()->withInput()->with('error', 'Stok produk tidak mencukupi.');
            }
        }

        // ── 5. Gabungkan alamat lengkap ───────────────────────
        $alamatLengkap = implode(', ', array_filter([
            $validated['alamat_detail'],
            $validated['kab_kota'],
            $validated['provinsi'],
            $validated['kode_pos'],
        ]));

        // ── 6. Upload Bukti Pembayaran ke local storage ───────
        $paymentProofPath = $request->file('payment_proof')
            ->store('payment_proofs', 'public');

        Log::info('Payment proof uploaded', [
            'path'    => $paymentProofPath,
            'user_id' => Auth::id(),
        ]);

        // ── 7. Buat Order ─────────────────────────────────────
        Order::create([
            'user_id'         => Auth::id(),
            'product_type'    => $product->type,
            'product_id'      => $validated['product_id'],
            'variant_id'      => $validated['variant_id'] ?? null,
            'qty'             => $validated['qty'],
            'pemesan_name'    => $validated['pemesan_name'],
            'pemesan_phone'   => $validated['pemesan_phone'],
            'provinsi'        => $validated['provinsi'],
            'kab_kota'        => $validated['kab_kota'],
            'alamat_detail'   => $validated['alamat_detail'],
            'kode_pos'        => $validated['kode_pos'],
            'alamat'          => $alamatLengkap,
            'catatan_user'    => $validated['catatan_user'] ?? null,
            'status'          => 'menunggu',
            'payment_status'  => 'pending',
            'payment_method'  => 'manual_transfer',
            'total_price'     => $totalPrice,
            'payment_proof'   => $paymentProofPath,
            'payment_message' => $validated['payment_message'] ?? null,
        ]);

        return redirect()
            ->route('user.orders')
            ->with('success', 'Pesanan berhasil dibuat! Bukti pembayaran Anda sudah kami terima. Admin akan memverifikasi dan mengkonfirmasi pesanan dalam 1×24 jam.');
    }
}