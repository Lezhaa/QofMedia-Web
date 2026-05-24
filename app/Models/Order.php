<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'product_type', 
        'product_id', 
        'variant_id',
        'qty', 
        'pemesan_name', 
        'pemesan_phone',
        'provinsi', 
        'kab_kota', 
        'alamat_detail', 
        'kode_pos', 
        'alamat',
        'catatan_user', 
        'status', 
        'payment_status', 
        'catatan_admin',
        'total_price', 
        'payment_method',
        'payment_proof', 
        'payment_proof_validated',
        'payment_message', 
        'paid_at',
        'tracking_number',
        'packing_at',
        'shipped_at',
        'received_at',
    ];

    protected $casts = [
        'paid_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(ApparelProduct::class);
    }

    public function variant()
    {
        return $this->belongsTo(TshirtVariant::class);
    }

    // ── Alamat Lengkap ────────────────────────────────────────
    public function getAlamatLengkapAttribute(): string
    {
        $parts = array_filter([
            $this->alamat_detail,
            $this->kab_kota,
            $this->provinsi,
            $this->kode_pos ? 'Kode Pos: ' . $this->kode_pos : null,
        ]);
        return implode(', ', $parts) ?: ($this->alamat ?? '-');
    }

    // ── Status Order ──────────────────────────────────────────
    public function getStatusBadgeClassAttribute(): string
    {
        return match($this->status) {
            'menunggu'  => 'warning',
            'disetujui' => 'success',
            'packing'   => 'info',
            'dikirim'   => 'primary',
            'diterima'  => 'success',
            'ditolak'   => 'danger',
            default     => 'secondary',
        };
    }

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'menunggu'  => 'Menunggu Konfirmasi',
            'disetujui' => 'Disetujui',
            'packing'   => 'Sedang Dipacking',
            'dikirim'   => 'Sudah Dikirim',
            'diterima'  => 'Pesanan Diterima',
            'ditolak'   => 'Ditolak',
            default     => $this->status,
        };
    }

    // ── Status Pembayaran ─────────────────────────────────────
    public function getPaymentStatusLabelAttribute(): string
    {
        return match($this->payment_status) {
            'unpaid'  => 'Belum Bayar',
            'pending' => 'Menunggu Verifikasi Admin',
            'paid'    => 'Lunas',
            'failed'  => 'Gagal / Ditolak',
            default   => $this->payment_status ?? '-',
        };
    }

    public function getPaymentStatusBadgeClassAttribute(): string
    {
        return match($this->payment_status) {
            'unpaid'  => 'secondary',
            'pending' => 'warning',
            'paid'    => 'success',
            'failed'  => 'danger',
            default   => 'secondary',
        };
    }

    public function getPaymentMethodLabelAttribute(): string
    {
        return 'Transfer Manual';
    }

    public function isManualTransfer(): bool
    {
        return true; // Semua order menggunakan transfer manual
    }

    public function isPaymentGateway(): bool
    {
        return false;
    }
}
