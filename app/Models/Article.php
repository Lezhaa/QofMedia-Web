<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title', 'slug', 'excerpt', 'content', 
        'category', 'image', 'published_at'
    ];
    
    protected $casts = [
        'published_at' => 'datetime',  // Pastikan ini ada
    ];
    
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($article) {
            if (!$article->slug) {
                $article->slug = Str::slug($article->title);
            }
        });
        
        static::updating(function ($article) {
            if ($article->isDirty('title') && !$article->isDirty('slug')) {
                $article->slug = Str::slug($article->title);
            }
        });
    }
    
    public function getImageUrlAttribute()
    {
        if ($this->image && \Storage::disk('public')->exists($this->image)) {
            return asset('storage/' . $this->image);
        }
        
        return asset('images/default-article.jpg');
    }
    
    public function getFormattedDateAttribute()
    {
        return $this->published_at ? $this->published_at->format('d M Y') : '-';
    }
}