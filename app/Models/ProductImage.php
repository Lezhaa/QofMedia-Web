<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'image',
        'label',
        'order',
    ];
    
    // Relasi ke produk
    public function product()
    {
        return $this->belongsTo(ApparelProduct::class, 'product_id');
    }
}
