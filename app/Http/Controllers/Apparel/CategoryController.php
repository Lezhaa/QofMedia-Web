<?php

namespace App\Http\Controllers\Apparel;

use App\Http\Controllers\Controller;
use App\Models\ApparelCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = ApparelCategory::withCount('products')->latest()->get();
        return view('apparel.categories.index', compact('categories'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:apparel_categories,name',
        ]);
        
        ApparelCategory::create($validated);
        
        return redirect()->route('apparel.categories.index')
            ->with('success', 'Kategori berhasil ditambahkan');
    }
    
    public function update(Request $request, ApparelCategory $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:apparel_categories,name,' . $category->id,
        ]);
        
        $category->update($validated);
        
        return redirect()->route('apparel.categories.index')
            ->with('success', 'Kategori berhasil diperbarui');
    }
    
    public function destroy(ApparelCategory $category)
    {
        $category->delete();
        
        return redirect()->route('apparel.categories.index')
            ->with('success', 'Kategori berhasil dihapus');
    }
}