<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductImage;

class ApparelProduct extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'category_id', 'name', 'description', 'price',
        'stock', 'image', 'type'
    ];
    
    public function category()
    {
        return $this->belongsTo(ApparelCategory::class);
    }
    
    public function editions()
    {
        return $this->hasMany(TshirtEdition::class, 'product_id');
    }
    
    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : asset('images/default-product.jpg');
    }
    
    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    public function images()
{
    return $this->hasMany(ProductImage::class, 'product_id')->orderBy('order');
}
}