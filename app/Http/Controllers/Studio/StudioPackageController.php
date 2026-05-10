<?php

namespace App\Http\Controllers\Studio;

use App\Http\Controllers\Controller;
use App\Models\StudioPackage;
use Illuminate\Http\Request;

class StudioPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $packages = StudioPackage::latest()->paginate(10);
        return view('studio.packages.index', compact('packages'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('studio.packages.create');
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:100',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|string|max:100',
            'facilities' => 'nullable|string',
        ]);
        
        // Convert facilities string to array
        if (!empty($validated['facilities'])) {
            $validated['facilities'] = array_map('trim', explode("\n", $validated['facilities']));
            $validated['facilities'] = array_filter($validated['facilities']);
        } else {
            $validated['facilities'] = [];
        }
        
        StudioPackage::create($validated);
        
        return redirect()->route('studio.packages.index')
            ->with('success', 'Paket studio berhasil ditambahkan');
    }
    
    /**
     * Display the specified resource.
     */
    public function show(StudioPackage $package)
    {
        return view('studio.packages.show', compact('package'));
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StudioPackage $package)
    {
        return view('studio.packages.edit', compact('package'));
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StudioPackage $package)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:100',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|string|max:100',
            'facilities' => 'nullable|string',
        ]);
        
        // Convert facilities string to array
        if (!empty($validated['facilities'])) {
            $validated['facilities'] = array_map('trim', explode("\n", $validated['facilities']));
            $validated['facilities'] = array_filter($validated['facilities']);
        } else {
            $validated['facilities'] = [];
        }
        
        $package->update($validated);
        
        return redirect()->route('studio.packages.index')
            ->with('success', 'Paket studio berhasil diperbarui');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudioPackage $package)
    {
        $package->delete();
        
        return redirect()->route('studio.packages.index')
            ->with('success', 'Paket studio berhasil dihapus');
    }
}