<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Article;
use App\Models\Contact;
use App\Models\Setting;
use App\Models\ApparelProduct;
use App\Models\GalleryItem;
use Illuminate\Http\Request;


class PublicController extends Controller
{
    public function index()
    {
        $settings = Setting::query()->whereIn('key', [
            'hero_title', 'hero_subtitle', 'hero_cta_text', 'hero_cta_url'
        ])->get()->mapWithKeys(function ($setting) {
            return [$setting->key => $setting->value];
        });
        
        $latestAlbums = Album::with(['items' => function($q) {
            $q->where('type', 'foto')->take(1);
        }])->latest()->take(6)->get();

        $latestProducts = ApparelProduct::with('category')
            ->where('stock', '>', 0)
            ->latest()
            ->take(4)
            ->get();

        $latestNews = Article::whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->latest('published_at')
            ->take(3)
            ->get();
    
        return view('public.home', [
            'settings'       => $settings,
            'latestAlbums'   => $latestAlbums,
            'latestProducts' => $latestProducts,
            'latestNews'     => $latestNews,
        ]);
    }
    
    public function profil()
    {
        $page = \App\Models\Page::where('slug', 'profil')->first();
    
        $stats = [
            'years'    => date('Y') - 2020,
            'clients'  => 150,
            'projects' => 300,
            'team'     => 25,
        ];
    
        return view('public.about.profile', [
            'page'  => $page,
            'stats' => $stats,
        ]);
    }
    
    public function struktur()
    {
        $page = \App\Models\Page::where('slug', 'struktur')->first();

        return view('public.about.structure', [
            'page' => $page,
        ]);
    }
    
    public function informasi(Request $request)
    {
        $query = Article::whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->latest('published_at');
        
        if ($request->has('category')) {
            $query->where('category', $request->category);
        }
        
        if ($request->has('year')) {
            $query->whereYear('published_at', $request->year);
        }
        
        $articles   = $query->paginate(9);
        $categories = Article::distinct()->pluck('category');
        $years      = Article::selectRaw('YEAR(published_at) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');
        
        return view('public.information.index', [
            'articles'   => $articles,
            'categories' => $categories,
            'years'      => $years,
        ]);
    }
    
    public function informasiDetail(string $slug)
    {
        $article = Article::where('slug', $slug)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->firstOrFail();
        
        $relatedArticles = Article::where('category', $article->category)
            ->where('id', '!=', $article->id)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->latest('published_at')
            ->take(3)
            ->get();
        
        return view('public.information.show', [
            'article'         => $article,
            'relatedArticles' => $relatedArticles,
        ]);
    }
    
    public function galeri()
    {
        $years = Album::select('year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');
    
        $highlightPhotos = GalleryItem::where('type', 'foto')
            ->with('album')
            ->latest()
            ->take(8)
            ->get();
    
        return view('public.gallery.index', [
            'years'          => $years,
            'highlightPhotos' => $highlightPhotos,
        ]);
    }
    
    public function galeriYear(string $year)
    {
        $albums = Album::where('year', $year)
            ->withCount('items')
            ->latest()
            ->get();
        
        return view('public.gallery.year', [
            'albums' => $albums,
            'year'   => $year,
        ]);
    }
    
    public function galeriAlbum(string $year, string $slug)
    {
        $album = Album::where('year', $year)
            ->where('slug', $slug)
            ->with('items')
            ->firstOrFail();
        
        return view('public.gallery.album', [
            'album' => $album,
        ]);
    }
    
    public function kontak(Request $request)
    {
        $settings = Setting::whereIn('key', [
            'google_maps', 'facebook', 'instagram', 'twitter', 'tiktok', 'youtube'
        ])->pluck('value', 'key');
    
        $selectedTool    = $request->query('tool');
        $selectedPackage = $request->query('package');
        $serviceType     = $request->query('service');
    
        return view('public.contact', [
            'settings'        => $settings,
            'selectedTool'    => $selectedTool,
            'selectedPackage' => $selectedPackage,
            'serviceType'     => $serviceType,
        ]);
    }
    
    public function sendContact(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'required|string|max:20',
            'message' => 'required|string',
        ]);
        
        Contact::create($validated);
        
        return redirect()->route('contact')
            ->with('success', 'Pesan Anda telah terkirim. Kami akan segera menghubungi Anda.');
    }
}