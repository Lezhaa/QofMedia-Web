<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->paginate(10);
        return view('admin.articles.index', compact('articles'));
    }
    
    public function create()
    {
        return view('admin.articles.create');
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'published_at' => 'nullable|date',
        ]);
        
        $validated['slug'] = Str::slug($validated['title']);
        
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('articles', 'public');
        }
        
        Article::create($validated);

        // Otomatis buat notifikasi jika kategori Pengumuman
        $article = Article::create($validated);
 
        // Otomatis buat notifikasi broadcast jika kategori Pengumuman
        if (strtolower(trim($validated['category'])) === 'pengumuman') {
            Notification::create([
                'user_id' => null, // null = broadcast ke semua (user & guest)
                'type'    => 'announcement',
                'title'   => '📢 ' . $validated['title'],
                'message' => $validated['excerpt'] ?? 'Ada pengumuman baru. Klik untuk membaca selengkapnya.',
                'url'     => route('information.show', $article->slug),
                'data'    => ['article_id' => $article->id],
            ]);
        }
        
        return redirect()->route('admin.articles.index')
            ->with('success', 'Artikel berhasil ditambahkan');
    }
    
    public function edit(Article $article)
    {
        return view('admin.articles.edit', compact('article'));
    }
    
    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'published_at' => 'nullable|date',
        ]);
        
        $validated['slug'] = Str::slug($validated['title']);
        
        if ($request->hasFile('image')) {
            if ($article->image) {
                \Storage::disk('public')->delete($article->image);
            }
            $validated['image'] = $request->file('image')->store('articles', 'public');
        }
        
        $article->update($validated);

        $wasAnnouncement = strtolower(trim($article->getOriginal('category'))) === 'pengumuman';
        $isNowAnnouncement = strtolower(trim($validated['category'])) === 'pengumuman';
 
        $article->update($validated);
 
        if (!$wasAnnouncement && $isNowAnnouncement) {
            Notification::create([
                'user_id' => null,
                'type'    => 'announcement',
                'title'   => '📢 ' . $validated['title'],
                'message' => $validated['excerpt'] ?? 'Ada pengumuman baru. Klik untuk membaca selengkapnya.',
                'url'     => route('information.show', $article->slug),
                'data'    => ['article_id' => $article->id],
            ]);
        }
        
        return redirect()->route('admin.articles.index')
            ->with('success', 'Artikel berhasil diperbarui');
    }
    
    public function destroy(Article $article)
    {
        if ($article->image) {
            \Storage::disk('public')->delete($article->image);
        }
        
        $article->delete();
        
        return redirect()->route('admin.articles.index')
            ->with('success', 'Artikel berhasil dihapus');
    }
}