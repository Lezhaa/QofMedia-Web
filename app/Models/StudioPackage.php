<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudioPackage extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name', 
        'type', 
        'description', 
        'price',
        'duration', 
        'facilities'
    ];
    
    protected $casts = [
        'facilities' => 'array',
    ];
    
    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }
}