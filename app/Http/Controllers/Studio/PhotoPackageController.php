<?php

namespace App\Http\Controllers\Studio;

use App\Http\Controllers\Controller;
use App\Models\PhotoPackage;
use Illuminate\Http\Request;

class PhotoPackageController extends Controller
{
    public function index()
    {
        $packages = PhotoPackage::latest()->paginate(10);
        return view('studio.photo-packages.index', compact('packages'));
    }
    
    public function create()
    {
        return view('studio.photo-packages.create');
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|string|max:100',
            'description' => 'nullable|string',
            'features' => 'nullable|string',
            'is_popular' => 'boolean',
        ]);
        
        // Convert features string to array
        if (!empty($validated['features'])) {
            $validated['features'] = array_map('trim', explode(',', $validated['features']));
        }
        
        PhotoPackage::create($validated);
        
        return redirect()->route('studio.photo-packages.index')
            ->with('success', 'Paket fotografi berhasil ditambahkan');
    }
    
    public function edit(PhotoPackage $photoPackage)
    {
        return view('studio.photo-packages.edit', ['package' => $photoPackage]);
    }
    
    public function update(Request $request, PhotoPackage $photoPackage)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|string|max:100',
            'description' => 'nullable|string',
            'features' => 'nullable|string',
            'is_popular' => 'boolean',
        ]);
        
        // Convert features string to array
        if (!empty($validated['features'])) {
            $validated['features'] = array_map('trim', explode(',', $validated['features']));
        }
        
        $photoPackage->update($validated);
        
        return redirect()->route('studio.photo-packages.index')
            ->with('success', 'Paket fotografi berhasil diperbarui');
    }
    
    public function destroy(PhotoPackage $photoPackage)
    {
        $photoPackage->delete();
        
        return redirect()->route('studio.photo-packages.index')
            ->with('success', 'Paket fotografi berhasil dihapus');
    }
}