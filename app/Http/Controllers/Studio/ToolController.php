<?php

namespace App\Http\Controllers\Studio;

use App\Http\Controllers\Controller;
use App\Models\RentalTool;
use Illuminate\Http\Request;

class ToolController extends Controller
{
    public function index()
    {
        $tools = RentalTool::latest()->paginate(10);
        return view('studio.tools.index', compact('tools'));
    }
    
    public function create()
    {
        return view('studio.tools.create');
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'description' => 'nullable|string',
            'price_per_day' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048',
            'is_available' => 'boolean',
        ]);
        
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')
                ->store('tools', 'public');
        }
        
        RentalTool::create($validated);
        
        return redirect()->route('studio.tools.index')
            ->with('success', 'Alat berhasil ditambahkan');
    }
    
    public function edit(RentalTool $tool)
    {
        return view('studio.tools.edit', compact('tool'));
    }
    
    public function update(Request $request, RentalTool $tool)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'description' => 'nullable|string',
            'price_per_day' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048',
            'is_available' => 'boolean',
        ]);
        
        if ($request->hasFile('image')) {
            if ($tool->image) {
                \Storage::disk('public')->delete($tool->image);
            }
            $validated['image'] = $request->file('image')
                ->store('tools', 'public');
        }
        
        $tool->update($validated);
        
        return redirect()->route('studio.tools.index')
            ->with('success', 'Alat berhasil diperbarui');
    }
    
    public function destroy(RentalTool $tool)
    {
        if ($tool->image) {
            \Storage::disk('public')->delete($tool->image);
        }
        
        $tool->delete();
        
        return redirect()->route('studio.tools.index')
            ->with('success', 'Alat berhasil dihapus');
    }
}