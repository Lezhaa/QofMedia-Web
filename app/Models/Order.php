<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id', 'product_type', 'product_id', 'variant_id',
        'qty', 'pemesan_name', 'pemesan_phone', 'alamat',
        'catatan_user', 'status', 'catatan_admin'
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
    
    public function getStatusBadgeClassAttribute()
    {
        return match($this->status) {
            'menunggu' => 'warning',
            'disetujui' => 'success',
            'ditolak' => 'danger',
            default => 'secondary'
        };
    }
    
    public function getStatusLabelAttribute()
    {
        return match($this->status) {
            'menunggu' => 'Menunggu Konfirmasi',
            'disetujui' => 'Disetujui',
            'ditolak' => 'Ditolak',
            default => $this->status
        };
    }
}