<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentalTool extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name', 'category', 'description', 'price_per_day',
        'stock', 'image', 'is_available'
    ];
    
    protected $casts = [
        'is_available' => 'boolean',
        'price_per_day' => 'decimal:2',
    ];
    
    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }
    
    public function getAvailabilityBadgeAttribute()
    {
        return $this->is_available && $this->stock > 0 ? 'Tersedia' : 'Habis';
    }
}