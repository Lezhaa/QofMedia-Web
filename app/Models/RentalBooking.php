<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class RentalBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tool_id',
        'pemesan_name',
        'pemesan_phone',
        'tanggal_mulai',
        'tanggal_selesai',
        'qty',
        'total_harga',
        'catatan_user',
        'bukti_transfer',
        'bukti_transfer_validated',  // ← TAMBAHAN: wajib ada agar update() tidak diabaikan
        'jenis_jaminan',
        'setuju_syarat',
        'status',
        'catatan_admin',
    ];

    protected $casts = [
        'tanggal_mulai'   => 'date',
        'tanggal_selesai' => 'date',
        'setuju_syarat'   => 'boolean',
    ];

    // ── Relasi ─────────────────────────────────────────────────

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tool()
    {
        return $this->belongsTo(RentalTool::class, 'tool_id');
    }

    // ── Accessor ───────────────────────────────────────────────

    /** Durasi dalam hari */
    public function getDurasiAttribute(): int
    {
        return max(1, $this->tanggal_mulai->diffInDays($this->tanggal_selesai) + 1);
    }

    /** Label jenis jaminan */
    public function getJaminanLabelAttribute(): string
    {
        return match ($this->jenis_jaminan) {
            'ktp'           => 'KTP (Kartu Tanda Penduduk)',
            'kk'            => 'KK (Kartu Keluarga)',
            'sim'           => 'SIM (Surat Izin Mengemudi)',
            'kartu_pelajar' => 'Kartu Pelajar / Mahasiswa',
            default         => $this->jenis_jaminan ?? '—',
        };
    }

    /** Label status */
    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'menunggu'  => 'Menunggu Konfirmasi',
            'disetujui' => 'Disetujui',
            'aktif'     => 'Sedang Berjalan',
            'selesai'   => 'Selesai',
            'ditolak'   => 'Ditolak',
            default     => $this->status,
        };
    }

    /** CSS class badge untuk status */
    public function getStatusBadgeClassAttribute(): string
    {
        return match ($this->status) {
            'menunggu'  => 'warning',
            'disetujui' => 'info',
            'aktif'     => 'primary',
            'selesai'   => 'success',
            'ditolak'   => 'danger',
            default     => 'secondary',
        };
    }

    // ── Hitung ulang total harga ───────────────────────────────

    public function hitungTotal(): int
    {
        if (!$this->tool) return 0;
        return (int) $this->tool->price_per_day * $this->durasi * $this->qty;
    }
}