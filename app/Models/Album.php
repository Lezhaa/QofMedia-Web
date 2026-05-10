<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Album extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name', 
        'year', 
        'slug', 
        'description', 
        'cover_image'
    ];
    
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($album) {
            if (!$album->slug) {
                $album->slug = Str::slug($album->name . '-' . $album->year);
            }
        });
    }
    
    public function items()
    {
        return $this->hasMany(GalleryItem::class);
    }
    
    public function getCoverUrlAttribute()
    {
        return $this->cover_image ? asset('storage/' . $this->cover_image) : asset('images/default-album.jpg');
    }
}