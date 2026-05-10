<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryItem extends Model
{
    protected $fillable = [
        'album_id', 
        'file_path', 
        'type', 
        'caption', 
        'file_size'
    ];
    
    public function album()
    {
        return $this->belongsTo(Album::class);
    }
    
    public function getFileUrlAttribute()
    {
        if (empty($this->file_path)) {
            return asset('images/no-image.png');
        }
        
        return asset('storage/' . $this->file_path);
    }
    
    public function getFormattedSizeAttribute()
    {
        if (!$this->file_size) return '-';
        
        $units = ['B', 'KB', 'MB', 'GB'];
        $size = $this->file_size;
        $unit = 0;
        
        while ($size >= 1024 && $unit < 3) {
            $size /= 1024;
            $unit++;
        }
        
        return round($size, 2) . ' ' . $units[$unit];
    }
}