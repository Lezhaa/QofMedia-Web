<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TshirtVariant extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'model_id', 'size', 'color', 'sleeve_type',
        'stock', 'price'
    ];
    
    public function model()
    {
        return $this->belongsTo(TshirtModel::class);
    }
    
    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }
}