<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApparelCategory extends Model
{
    use HasFactory;
    
    protected $fillable = ['name'];
    
    public function products()
    {
        return $this->hasMany(ApparelProduct::class, 'category_id');
    }
}