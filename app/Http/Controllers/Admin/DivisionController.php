<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DivisionController extends Controller
{
    public function index()
    {
        $divisions = Division::withCount('members')->orderBy('order')->paginate(10);
        return view('admin.divisions.index', compact('divisions'));
    }

    public function create()
    {
        return view('admin.divisions.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:divisions,name',
            'description' => 'nullable|string',
            'instagram' => 'nullable|string|max:255',
            'icon' => 'nullable|string|max:100',
            'order' => 'nullable|integer',
        ]);
        
        $validated['slug'] = Str::slug($validated['name']);
        
        Division::create($validated);
        
        return redirect()->route('admin.divisions.index')
            ->with('success', 'Divisi berhasil ditambahkan');
    }

    public function edit(Division $division)
    {
        return view('admin.divisions.edit', compact('division'));
    }

    public function update(Request $request, Division $division)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:divisions,name,' . $division->id,
            'description' => 'nullable|string',
            'instagram' => 'nullable|string|max:255',
            'icon' => 'nullable|string|max:100',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);
        
        $validated['slug'] = Str::slug($validated['name']);
        
        $division->update($validated);
        
        return redirect()->route('admin.divisions.index')
            ->with('success', 'Divisi berhasil diperbarui');
    }

    public function destroy(Division $division)
    {
        $division->delete();
        
        return redirect()->route('admin.divisions.index')
            ->with('success', 'Divisi berhasil dihapus');
    }
}