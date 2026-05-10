<?php

namespace App\Http\Controllers\Apparel;

use App\Http\Controllers\Controller;
use App\Models\TshirtModel;
use App\Models\TshirtEdition;
use Illuminate\Http\Request;

class ModelController extends Controller
{
    public function index()
    {
        $models = TshirtModel::with('edition.product')->latest()->paginate(10);
        $editions = TshirtEdition::with('product')->get();
        return view('apparel.models.index', compact('models', 'editions'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'edition_id' => 'required|exists:tshirt_editions,id',
            'name' => 'required|string|max:255',
            'design_image' => 'nullable|image|max:2048',
        ]);
        
        $data = $request->only(['edition_id', 'name']);
        
        if ($request->hasFile('design_image')) {
            $data['design_image'] = $request->file('design_image')->store('tshirt/models', 'public');
        }
        
        TshirtModel::create($data);
        
        return redirect()->route('apparel.models.index')
            ->with('success', 'Model berhasil ditambahkan');
    }
    
    public function update(Request $request, TshirtModel $model)
    {
        $request->validate([
            'edition_id' => 'required|exists:tshirt_editions,id',
            'name' => 'required|string|max:255',
            'design_image' => 'nullable|image|max:2048',
        ]);
        
        $data = $request->only(['edition_id', 'name']);
        
        if ($request->hasFile('design_image')) {
            if ($model->design_image) {
                \Storage::disk('public')->delete($model->design_image);
            }
            $data['design_image'] = $request->file('design_image')->store('tshirt/models', 'public');
        }
        
        $model->update($data);
        
        return redirect()->route('apparel.models.index')
            ->with('success', 'Model berhasil diperbarui');
    }
    
    public function destroy(TshirtModel $model)
    {
        if ($model->design_image) {
            \Storage::disk('public')->delete($model->design_image);
        }
        $model->delete();
        return redirect()->route('apparel.models.index')
            ->with('success', 'Model berhasil dihapus');
    }
}