<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhotoPackage extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name', 
        'price', 
        'duration', 
        'is_popular',
        'description', 
        'features'
    ];
    
    protected $casts = [
        'features' => 'array',
        'is_popular' => 'boolean',
    ];
    
    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }
}