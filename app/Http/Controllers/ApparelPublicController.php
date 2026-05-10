<?php

namespace App\Http\Controllers;

use App\Models\ApparelCategory;
use App\Models\ApparelProduct;
use App\Models\Setting;
use App\Models\TshirtEdition;
use App\Models\TshirtModel;
use App\Models\TshirtVariant;
use Illuminate\Http\Request;

class ApparelPublicController extends Controller
{
    public function index(Request $request)
    {
        $query = ApparelProduct::with('category')->where('stock', '>', 0);
        
        // Filter by category
        if ($request->has('category') && $request->category != '') {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('id', $request->category);
            });
        }
        
        // Search
        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }
        
        // Sort
        $sort = $request->get('sort', 'latest');
        switch ($sort) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            default:
                $query->latest();
        }
        
        $products = $query->paginate(12)->withQueryString();
        $categories = ApparelCategory::withCount('products')->get();

        // Ambil nomor dari database
        $whatsappNumber = Setting::where('key', 'whatsapp_apparel')->value('value');
        
        // Bersihkan format nomor
        $whatsappNumber = $this->formatWhatsAppNumber($whatsappNumber);
        
        return view('public.service.apparel.index', compact('products', 'categories', 'whatsappNumber'));
    }

    /**
     * Format nomor WhatsApp ke format internasional
     */
    private function formatWhatsAppNumber($number)
    {
        if (empty($number)) {
            return '6285156073776';
        }
        
        // Hapus semua karakter kecuali angka
        $number = preg_replace('/[^0-9]/', '', $number);
        
        // Kalau awalan 0, ganti dengan 62
        if (substr($number, 0, 1) === '0') {
            $number = '62' . substr($number, 1);
        }
        
        return $number;
    }
    
    public function show($id)
    {
        $product = ApparelProduct::with(['category', 'images'])->findOrFail($id);
        
        // Variabel untuk kaos
        $editions = collect();
        $models = collect();
        $variants = collect();
        $colors = collect();
        $sizes = collect();
        
        // Kalau tipe kaos, ambil data varian
        if ($product->type === 'kaos') {
            $editions = TshirtEdition::where('product_id', $product->id)
                ->with('models')
                ->orderBy('year', 'desc')
                ->get();
            
            $models = TshirtModel::whereHas('edition', function($q) use ($product) {
                $q->where('product_id', $product->id);
            })->get();
            
            $variants = TshirtVariant::whereHas('model.edition', function($q) use ($product) {
                $q->where('product_id', $product->id);
            })->get();
            
            $colors = $variants->pluck('color')->unique()->values();
            $sizes = $variants->pluck('size')->unique()->sort()->values();
        }
        
        // Get related products (same category)
        $relatedProducts = ApparelProduct::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('stock', '>', 0)
            ->take(4)
            ->get();
        
        return view('public.service.apparel.product-show', compact(
            'product', 
            'editions', 
            'models', 
            'variants', 
            'colors', 
            'sizes', 
            'relatedProducts'
        ));
    }
}