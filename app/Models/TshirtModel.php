<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TshirtModel extends Model
{
    use HasFactory;
    
    protected $fillable = ['edition_id', 'name', 'design_image'];
    
    public function edition()
    {
        return $this->belongsTo(TshirtEdition::class);
    }
    
    public function variants()
    {
        return $this->hasMany(TshirtVariant::class, 'model_id');
    }
    
    public function getDesignImageUrlAttribute()
    {
        return $this->design_image ? asset('storage/' . $this->design_image) : asset('images/default-design.jpg');
    }
}