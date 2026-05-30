<?php

namespace App\Http\Controllers;

use App\Models\RentalBooking;
use App\Models\RentalTool;
use Illuminate\Http\Request;

class RentalBookingController extends Controller
{
    /**
     * Tampilkan form pemesanan untuk alat tertentu.
     */
    public function create(RentalTool $tool)
    {
        abort_if(!$tool->is_available || $tool->stock < 1, 404);

        return view('public.service.studio.rental.booking-form', compact('tool'));
    }

    /**
     * Simpan pemesanan baru.
     */
    public function store(Request $request, RentalTool $tool)
    {
        abort_if(!$tool->is_available || $tool->stock < 1, 404);

        $validated = $request->validate([
            'pemesan_name'    => 'required|string|max:100',
            'pemesan_phone'   => 'required|string|max:20',
            'tanggal_mulai'   => 'required|date|after_or_equal:today',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'qty'             => 'required|integer|min:1|max:' . $tool->stock,
            'catatan_user'    => 'nullable|string|max:500',
            'bukti_transfer'  => 'required|image|mimes:jpg,jpeg,png,webp|max:3072',
            'jenis_jaminan'   => 'required|in:ktp,kk,sim,kartu_pelajar',
            'setuju_syarat'   => 'accepted',
        ], [
            'pemesan_name.required'       => 'Nama pemesan wajib diisi.',
            'pemesan_phone.required'      => 'Nomor HP wajib diisi.',
            'tanggal_mulai.required'      => 'Tanggal mulai wajib diisi.',
            'tanggal_mulai.after_or_equal'=> 'Tanggal mulai tidak boleh sebelum hari ini.',
            'tanggal_selesai.required'    => 'Tanggal selesai wajib diisi.',
            'tanggal_selesai.after_or_equal' => 'Tanggal selesai tidak boleh sebelum tanggal mulai.',
            'qty.required'                => 'Jumlah unit wajib diisi.',
            'qty.max'                     => 'Jumlah melebihi stok yang tersedia (' . $tool->stock . ' unit).',
            'bukti_transfer.required'     => 'Bukti transfer wajib diunggah.',
            'bukti_transfer.image'        => 'File harus berupa gambar.',
            'bukti_transfer.mimes'        => 'Format gambar harus JPG, PNG, atau WEBP.',
            'bukti_transfer.max'          => 'Ukuran file maksimal 3 MB.',
            'jenis_jaminan.required'      => 'Pilih jenis jaminan yang akan dibawa.',
            'jenis_jaminan.in'            => 'Pilihan jaminan tidak valid.',
            'setuju_syarat.accepted'      => 'Anda harus menyetujui syarat dan ketentuan.',
        ]);

        // Upload bukti transfer
        $buktiPath = $request->file('bukti_transfer')
            ->store('rental-bukti', 'public');

        // Hitung durasi & total harga
        $mulai   = \Carbon\Carbon::parse($validated['tanggal_mulai']);
        $selesai = \Carbon\Carbon::parse($validated['tanggal_selesai']);
        $durasi  = max(1, $mulai->diffInDays($selesai) + 1);
        $total   = (int) $tool->price_per_day * $durasi * (int) $validated['qty'];

        RentalBooking::create([
            'user_id'         => auth()->id(),
            'tool_id'         => $tool->id,
            'pemesan_name'    => $validated['pemesan_name'],
            'pemesan_phone'   => $validated['pemesan_phone'],
            'tanggal_mulai'   => $validated['tanggal_mulai'],
            'tanggal_selesai' => $validated['tanggal_selesai'],
            'qty'             => $validated['qty'],
            'total_harga'     => $total,
            'catatan_user'    => $validated['catatan_user'] ?? null,
            'bukti_transfer'  => $buktiPath,
            'jenis_jaminan'   => $validated['jenis_jaminan'],
            'setuju_syarat'   => true,
            'status'          => 'menunggu',
        ]);

        return redirect()->route('service.studio')
            ->with('booking_success', 'Pemesanan sewa "' . $tool->name . '" berhasil dikirim! Tim studio kami akan menghubungi Anda untuk konfirmasi.');
    }
}