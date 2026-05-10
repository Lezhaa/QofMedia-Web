<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Division extends Model
{
    protected $fillable = [
        'name', 'slug', 'description', 'instagram', 
        'icon', 'order', 'is_active'
    ];
    
    protected $casts = [
        'is_active' => 'boolean',
    ];
    
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($division) {
            if (!$division->slug) {
                $division->slug = Str::slug($division->name);
            }
        });
        
        static::updating(function ($division) {
            if ($division->isDirty('name')) {
                $division->slug = Str::slug($division->name);
            }
        });
    }
    
    public function members()
    {
        return $this->belongsToMany(Member::class, 'division_member')
            ->withPivot('order')
            ->orderBy('division_member.order')
            ->withTimestamps();
    }
    
    public function activeMembers()
    {
        return $this->belongsToMany(Member::class, 'division_member')
            ->where('is_active', true)
            ->withPivot('order')
            ->orderBy('division_member.order')
            ->withTimestamps();
    }
}