<?php

namespace App\Http\Controllers\Apparel;

use App\Http\Controllers\Controller;
use App\Models\TshirtVariant;
use App\Models\TshirtModel;
use Illuminate\Http\Request;

class VariantController extends Controller
{
    public function index()
    {
        $variants = TshirtVariant::with('model.edition.product')->latest()->paginate(15);
        $models = TshirtModel::with('edition')->get();
        return view('apparel.variants.index', compact('variants', 'models'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'model_id' => 'required|array',
            'model_id.*' => 'required|exists:tshirt_models,id',
            'size' => 'required|array',
            'size.*' => 'required|in:S,M,L,XL,XXL',
            'color' => 'required|array',
            'color.*' => 'required|string|max:50',
            'sleeve_type' => 'required|array',
            'sleeve_type.*' => 'required|in:pendek,panjang',
            'stock' => 'required|array',
            'stock.*' => 'required|integer|min:0',
            'price' => 'required|array',
            'price.*' => 'required|numeric|min:0',
        ]);

        $count = count($request->model_id);
        
        for ($i = 0; $i < $count; $i++) {
            TshirtVariant::create([
                'model_id' => $request->model_id[$i],
                'size' => $request->size[$i],
                'color' => $request->color[$i],
                'sleeve_type' => $request->sleeve_type[$i],
                'stock' => $request->stock[$i],
                'price' => $request->price[$i],
            ]);
        }

        return redirect()->route('apparel.variants.index')
            ->with('success', $count . ' varian berhasil ditambahkan!');
    }
    
    public function update(Request $request, TshirtVariant $variant)
    {
        $request->validate([
            'model_id' => 'required|exists:tshirt_models,id',
            'size' => 'required|in:S,M,L,XL,XXL',
            'color' => 'required|string|max:50',
            'sleeve_type' => 'required|in:pendek,panjang',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
        ]);
        
        $variant->update($request->all());
        
        return redirect()->route('apparel.variants.index')
            ->with('success', 'Varian berhasil diperbarui');
    }
    
    public function destroy(TshirtVariant $variant)
    {
        $variant->delete();
        return redirect()->route('apparel.variants.index')
            ->with('success', 'Varian berhasil dihapus');
    }
}