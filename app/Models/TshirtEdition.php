<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TshirtEdition extends Model
{
    use HasFactory;
    
    protected $fillable = ['product_id', 
    'name', 
    'year', 
    'description'];
    
    public function product()
    {
        return $this->belongsTo(ApparelProduct::class);
    }
    
    public function models()
    {
        return $this->hasMany(TshirtModel::class, 'edition_id');
    }
}