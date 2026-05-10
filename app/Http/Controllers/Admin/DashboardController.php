<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Article;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'unread_contacts' => Contact::whereNull('read_at')->count(),
            'total_articles' => Article::count(),
            'total_albums' => Album::count(),
            'total_users' => User::count(),
        ];
        
        $recentContacts = Contact::latest()->take(5)->get();
        $recentArticles = Article::latest()->take(5)->get();
        
        return view('admin.dashboard', compact('stats', 'recentContacts', 'recentArticles'));
    }
    
    public function homeEdit()
    {
        $settings = \App\Models\Setting::whereIn('key', [
            'hero_title', 'hero_subtitle', 'hero_cta_text', 'hero_cta_url'
        ])->pluck('value', 'key');
        
        return view('admin.home.edit', compact('settings'));
    }
    
    public function homeUpdate(Request $request)
    {
        $validated = $request->validate([
            'hero_title' => 'required|string|max:255',
            'hero_subtitle' => 'required|string|max:255',
            'hero_cta_text' => 'required|string|max:100',
            'hero_cta_url' => 'required|string|max:255',
        ]);
        
        foreach ($validated as $key => $value) {
            \App\Models\Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }
        
        return redirect()->route('admin.home.edit')
            ->with('success', 'Pengaturan beranda berhasil diperbarui');
    }
}