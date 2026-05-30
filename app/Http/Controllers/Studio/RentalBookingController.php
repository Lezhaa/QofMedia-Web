<?php

namespace App\Http\Controllers\Studio;

use App\Http\Controllers\Controller;
use App\Models\RentalBooking;
use App\Models\Notification;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RentalBookingController extends Controller
{
    /**
     * Daftar semua pemesanan sewa.
     */
    public function index(Request $request)
    {
        $query = RentalBooking::with('tool')
            ->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('pemesan_name', 'like', "%{$s}%")
                  ->orWhere('pemesan_phone', 'like', "%{$s}%")
                  ->orWhereHas('tool', fn($t) => $t->where('name', 'like', "%{$s}%"));
            });
        }

        $bookings = $query->paginate(15)->withQueryString();

        $stats = [
            'total'     => RentalBooking::count(),
            'menunggu'  => RentalBooking::where('status', 'menunggu')->count(),
            'aktif'     => RentalBooking::where('status', 'aktif')->count(),
            'selesai'   => RentalBooking::where('status', 'selesai')->count(),
        ];

        return view('studio.rental-bookings.index', compact('bookings', 'stats'));
    }

    /**
     * Detail pemesanan.
     */
    public function show(RentalBooking $rentalBooking)
    {
        $rentalBooking->load('tool', 'user');
        return view('studio.rental-bookings.show', compact('rentalBooking'));
    }

    /**
     * STEP 1 – Validasi bukti transfer (tidak mengubah status pemesanan).
     * Update kolom bukti_transfer_validated: pending / valid / invalid
     */
    public function validateProof(Request $request, RentalBooking $rentalBooking)
    {
        $request->validate([
            'bukti_transfer_validated' => 'required|in:pending,valid,invalid',
            'catatan_admin'            => 'nullable|string|max:500',
        ]);

        // Hanya bisa divalidasi selama status masih 'menunggu'
        if ($rentalBooking->status !== 'menunggu') {
            return redirect()->route('studio.rental-bookings.show', $rentalBooking)
                ->with('error', 'Pemesanan ini sudah diproses, validasi bukti tidak dapat diubah.');
        }

        $oldStatus = $rentalBooking->bukti_transfer_validated ?? 'pending';

        $rentalBooking->update([
            'bukti_transfer_validated' => $request->bukti_transfer_validated,
            'catatan_admin'            => $request->catatan_admin ?? $rentalBooking->catatan_admin,
        ]);

        // Kirim notifikasi ke pemesan
        if ($rentalBooking->user_id) {
            if ($request->bukti_transfer_validated === 'valid') {
                Notification::create([
                    'user_id' => $rentalBooking->user_id,
                    'type'    => 'rental_proof_validated',
                    'title'   => 'Bukti Transfer Diverifikasi ✅',
                    'message' => "Bukti transfer pemesanan sewa #{$rentalBooking->id} sudah diverifikasi. Menunggu konfirmasi akhir dari admin studio.",
                    'url'     => route('user.rentals.show', $rentalBooking->id),
                    'data'    => ['rental_booking_id' => $rentalBooking->id],
                ]);
            } elseif ($request->bukti_transfer_validated === 'invalid') {
                Notification::create([
                    'user_id' => $rentalBooking->user_id,
                    'type'    => 'rental_proof_invalid',
                    'title'   => 'Bukti Transfer Tidak Valid ❌',
                    'message' => "Bukti transfer pemesanan sewa #{$rentalBooking->id} dinyatakan tidak valid oleh admin. Silakan hubungi kami.",
                    'url'     => route('user.rentals.show', $rentalBooking->id),
                    'data'    => ['rental_booking_id' => $rentalBooking->id],
                ]);
            }
        }

        $statusText = [
            'valid'   => 'VALID',
            'invalid' => 'TIDAK VALID',
            'pending' => 'PENDING',
        ];

        return redirect()->route('studio.rental-bookings.show', $rentalBooking)
            ->with('success', "Status bukti transfer berhasil diubah menjadi {$statusText[$request->bukti_transfer_validated]}.");
    }

    /**
     * STEP 2 – Update status pemesanan (setujui / tolak / aktif / selesai).
     * Untuk menyetujui, bukti transfer harus sudah tervalidasi 'valid'.
     */
    public function updateStatus(Request $request, RentalBooking $rentalBooking)
    {
        $request->validate([
            'status'        => 'required|in:disetujui,aktif,selesai,ditolak',
            'catatan_admin' => 'nullable|string|max:500',
        ]);

        // Jika ingin menyetujui, wajib bukti transfer valid
        if ($request->status === 'disetujui') {
            $proofStatus = $rentalBooking->bukti_transfer_validated ?? 'pending';
            if ($proofStatus !== 'valid') {
                return redirect()->route('studio.rental-bookings.show', $rentalBooking)
                    ->with('error', 'Harap validasi bukti transfer terlebih dahulu sebagai "Valid" sebelum menyetujui pemesanan.');
            }
        }

        $rentalBooking->update([
            'status'        => $request->status,
            'catatan_admin' => $request->catatan_admin ?? $rentalBooking->catatan_admin,
        ]);

        // Kirim notifikasi ke pemesan
        if ($rentalBooking->user_id) {
            $notifMap = [
                'disetujui' => ['type' => 'rental_approved', 'title' => 'Pemesanan Disetujui ✅',
                    'message' => "Pemesanan sewa #{$rentalBooking->id} Anda telah disetujui. Silakan datang sesuai jadwal."],
                'ditolak'   => ['type' => 'rental_rejected', 'title' => 'Pemesanan Ditolak ❌',
                    'message' => "Pemesanan sewa #{$rentalBooking->id} ditolak. " . ($request->catatan_admin ? "Alasan: {$request->catatan_admin}" : '')],
                'aktif'     => ['type' => 'rental_active',   'title' => 'Sewa Sedang Berjalan 🔧',
                    'message' => "Pemesanan sewa #{$rentalBooking->id} Anda kini berstatus aktif."],
                'selesai'   => ['type' => 'rental_done',     'title' => 'Sewa Selesai ✅',
                    'message' => "Pemesanan sewa #{$rentalBooking->id} telah selesai. Terima kasih!"],
            ];
            if (isset($notifMap[$request->status])) {
                $n = $notifMap[$request->status];
                Notification::create([
                    'user_id' => $rentalBooking->user_id,
                    'type'    => $n['type'],
                    'title'   => $n['title'],
                    'message' => $n['message'],
                    'url'     => route('user.rentals.show', $rentalBooking->id),
                    'data'    => ['rental_booking_id' => $rentalBooking->id],
                ]);
            }
        }

        $label = $rentalBooking->fresh()->status_label;

        return redirect()->route('studio.rental-bookings.show', $rentalBooking)
            ->with('success', "Status pemesanan berhasil diubah menjadi \"{$label}\".");
    }

    /**
     * Hapus pemesanan.
     */
    public function destroy(RentalBooking $rentalBooking)
    {
        $rentalBooking->delete();
        return redirect()->route('studio.rental-bookings.index')
            ->with('success', 'Pemesanan berhasil dihapus.');
    }
}