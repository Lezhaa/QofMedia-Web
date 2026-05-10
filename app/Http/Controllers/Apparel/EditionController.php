<?php

namespace App\Http\Controllers\Apparel;

use App\Http\Controllers\Controller;
use App\Models\TshirtEdition;
use App\Models\ApparelProduct;
use Illuminate\Http\Request;

class EditionController extends Controller
{
    public function index()
    {
        $editions = TshirtEdition::with('product')->latest()->paginate(10);
        $products = ApparelProduct::where('type', 'kaos')->get();
        return view('apparel.editions.index', compact('editions', 'products'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:apparel_products,id',
            'name' => 'required|string|max:255',
            'year' => 'required|integer|min:2020|max:2099',
            'description' => 'nullable|string',
        ]);
        
        TshirtEdition::create($request->all());
        
        return redirect()->route('apparel.editions.index')
            ->with('success', 'Edisi berhasil ditambahkan');
    }
    
    public function update(Request $request, TshirtEdition $edition)
    {
        $request->validate([
            'product_id' => 'required|exists:apparel_products,id',
            'name' => 'required|string|max:255',
            'year' => 'required|integer|min:2020|max:2099',
            'description' => 'nullable|string',
        ]);
        
        $edition->update($request->all());
        
        return redirect()->route('apparel.editions.index')
            ->with('success', 'Edisi berhasil diperbarui');
    }
    
    public function destroy(TshirtEdition $edition)
    {
        $edition->delete();
        return redirect()->route('apparel.editions.index')
            ->with('success', 'Edisi berhasil dihapus');
    }
}