<?php

namespace App\Http\Controllers\Apparel;

use App\Http\Controllers\Controller;
use App\Models\ApparelCategory;
use App\Models\ApparelProduct;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = ApparelProduct::with('category')->latest()->paginate(10);
        return view('apparel.products.index', compact('products'));
    }
    
    public function create()
    {
        $categories = ApparelCategory::all();
        return view('apparel.products.create', compact('categories'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:apparel_categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048',
            'type' => 'required|in:kaos,other',
            'gallery_images.*' => 'nullable|image|max:2048',
        ]);
        
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('apparel/products', 'public');
        }
        
        $product = ApparelProduct::create($validated);
        
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $index => $image) {
                $path = $image->store('apparel/products/gallery', 'public');
                $product->images()->create([
                    'image' => $path,
                    'label' => $request->gallery_labels[$index] ?? null,
                    'order' => $index + 1,
                ]);
            }
        }

        return redirect()->route('apparel.products.index')
            ->with('success', 'Produk berhasil ditambahkan');
    }
    
    public function edit(ApparelProduct $product)
    {
        $categories = ApparelCategory::all();
        return view('apparel.products.edit', compact('product', 'categories'));
    }
    
    public function update(Request $request, ApparelProduct $product)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:apparel_categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048',
            'type' => 'required|in:kaos,other',
            'gallery_images.*' => 'nullable|image|max:2048',
        ]);
        
        if ($request->hasFile('image')) {
            if ($product->image) {
                \Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $request->file('image')->store('apparel/products', 'public');
        }
        
        $product->update($validated);
        
        if ($request->hasFile('gallery_images')) {
            $orderStart = $product->images()->max('order') ?? 0;
            foreach ($request->file('gallery_images') as $index => $image) {
                $path = $image->store('apparel/products/gallery', 'public');
                $product->images()->create([
                    'image' => $path,
                    'label' => $request->gallery_labels[$index] ?? null,
                    'order' => $orderStart + $index + 1,
                ]);
            }
        }

        return redirect()->route('apparel.products.index')
            ->with('success', 'Produk berhasil diperbarui');
    }

    public function show(ApparelProduct $product)
    {
        $product->load(['category', 'images']);
        return view('apparel.products.show', compact('product'));
    }
    
    public function destroy(ApparelProduct $product)
    {
        if ($product->image) {
            \Storage::disk('public')->delete($product->image);
        }
        
        // Hapus semua gambar galeri
        foreach ($product->images as $img) {
            \Storage::disk('public')->delete($img->image);
            $img->delete();
        }
        
        $product->delete();
        
        return redirect()->route('apparel.products.index')
            ->with('success', 'Produk berhasil dihapus');
    }

    public function deleteImage($id)
    {
        $image = ProductImage::findOrFail($id);
        \Storage::disk('public')->delete($image->image);
        $image->delete();
        return back()->with('success', 'Foto berhasil dihapus');
    }

    public function updateImageLabel(Request $request, $id)
    {
        $request->validate(['label' => 'nullable|string|max:255']);
        
        $image = ProductImage::findOrFail($id);
        $image->update(['label' => $request->label]);
        
        return back()->with('success', 'Label foto berhasil diperbarui');
    }
}