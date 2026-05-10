<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'name', 
        'nickname',
        'social_platform',
        'social_username', 
        'photo',
        'position', 
        'order', 
        'is_active'
    ];
    
    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Appends untuk tambahan atribut
    protected $appends = ['photo_url', 'social_url', 'social_icon', 'division_names'];
    
    // Many-to-Many dengan Division
    public function divisions()
    {
        return $this->belongsToMany(Division::class, 'division_member')
            ->withPivot('order')
            ->orderBy('division_member.order')
            ->withTimestamps();
    }
    
    // Scope untuk anggota aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
    
    // Scope untuk diurutkan
    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }
    
    // Accessor: URL Foto
    public function getPhotoUrlAttribute()
    {
        if ($this->photo && file_exists(public_path('images/team/' . $this->photo))) {
            return asset('images/team/' . $this->photo);
        }
        
        // Cek juga di storage
        if ($this->photo && file_exists(storage_path('app/public/team/' . $this->photo))) {
            return asset('storage/team/' . $this->photo);
        }
        
        return null;
    }
    
    // Accessor: URL Media Sosial lengkap
    public function getSocialUrlAttribute()
    {
        if (!$this->social_platform || !$this->social_username) {
            return null;
        }

        $username = ltrim($this->social_username, '@');
        
        $platforms = [
            'instagram' => "https://instagram.com/{$username}",
            'twitter' => "https://twitter.com/{$username}",
            'x' => "https://x.com/{$username}",
            'linkedin' => $this->isValidUrl($this->social_username) ? $this->social_username : "https://linkedin.com/in/{$username}",
            'github' => "https://github.com/{$username}",
            'tiktok' => "https://tiktok.com/@{$username}",
            'facebook' => "https://facebook.com/{$username}",
            'youtube' => "https://youtube.com/@{$username}",
            'whatsapp' => "https://wa.me/{$username}",
            'telegram' => "https://t.me/{$username}",
            'discord' => $this->social_username, // Discord pakai username#tag
        ];

        return $platforms[$this->social_platform] ?? $this->social_username;
    }
    
    // Accessor: Icon Bootstrap untuk media sosial
    public function getSocialIconAttribute()
    {
        $icons = [
            'instagram' => 'bi-instagram',
            'twitter' => 'bi-twitter-x',
            'x' => 'bi-twitter-x',
            'linkedin' => 'bi-linkedin',
            'github' => 'bi-github',
            'tiktok' => 'bi-tiktok',
            'facebook' => 'bi-facebook',
            'youtube' => 'bi-youtube',
            'whatsapp' => 'bi-whatsapp',
            'telegram' => 'bi-telegram',
            'discord' => 'bi-discord',
        ];

        return $icons[$this->social_platform] ?? 'bi-share';
    }
    
    // Accessor: Warna untuk setiap platform (opsional untuk styling)
    public function getSocialColorAttribute()
    {
        $colors = [
            'instagram' => '#E4405F',
            'twitter' => '#1DA1F2',
            'x' => '#000000',
            'linkedin' => '#0077B5',
            'github' => '#333333',
            'tiktok' => '#000000',
            'facebook' => '#1877F2',
            'youtube' => '#FF0000',
            'whatsapp' => '#25D366',
            'telegram' => '#26A5E4',
            'discord' => '#5865F2',
        ];

        return $colors[$this->social_platform] ?? '#6c757d';
    }
    
    // Accessor: Nama platform diformat
    public function getSocialPlatformNameAttribute()
    {
        $names = [
            'instagram' => 'Instagram',
            'twitter' => 'Twitter',
            'x' => 'X',
            'linkedin' => 'LinkedIn',
            'github' => 'GitHub',
            'tiktok' => 'TikTok',
            'facebook' => 'Facebook',
            'youtube' => 'YouTube',
            'whatsapp' => 'WhatsApp',
            'telegram' => 'Telegram',
            'discord' => 'Discord',
        ];

        return $names[$this->social_platform] ?? ucfirst($this->social_platform);
    }
    
    // Accessor: Nama divisi (untuk tampilan)
    public function getDivisionNamesAttribute()
    {
        return $this->divisions->pluck('name')->implode(', ');
    }
    
    // Helper: Mendapatkan anggota aktif beserta divisinya
    public static function getActiveMembersWithDivisions()
    {
        return self::with('divisions')
            ->active()
            ->ordered()
            ->get();
    }
    
    // Helper: Cek apakah URL valid
    private function isValidUrl($url)
    {
        return filter_var($url, FILTER_VALIDATE_URL) !== false;
    }
    
    // Boot method untuk event handling
    protected static function boot()
    {
        parent::boot();
        
        // Set order otomatis jika belum diisi
        static::creating(function ($member) {
            if (empty($member->order)) {
                $member->order = static::max('order') + 1;
            }
        });
    }
}