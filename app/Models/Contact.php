<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name', 
        'email', 
        'phone', 
        'message', 
        'read_at'];
    
    protected $casts = [
        'read_at' => 'datetime',
    ];
    
    public function markAsRead()
    {
        $this->update(['read_at' => now()]);
    }
    
    public function getIsReadAttribute()
    {
        return !is_null($this->read_at);
    }
}