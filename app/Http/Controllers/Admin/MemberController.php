<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Division;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MemberController extends Controller
{
    public function index(Request $request)
    {
        $query = Member::with('divisions');
        
        if ($request->has('division_id') && $request->division_id != '') {
            $query->whereHas('divisions', function($q) use ($request) {
                $q->where('divisions.id', $request->division_id);
            });
        }
        
        $members = $query->orderBy('order')->paginate(15);
        $divisions = Division::where('is_active', true)->get();
        
        return view('admin.members.index', compact('members', 'divisions'));
    }

    public function create()
    {
        $divisions = Division::where('is_active', true)->orderBy('order')->get();
        return view('admin.members.create', compact('divisions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nickname' => 'required|string|max:100',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'position' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
            'social_platform' => 'nullable|string|in:instagram,twitter,linkedin,github,tiktok,facebook,youtube,whatsapp,telegram',
            'social_username' => 'nullable|string|max:255',
            'division_ids' => 'required|array|min:1',
            'division_ids.*' => 'exists:divisions,id',
        ]);
        
        // Handle upload foto
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = Str::slug($validated['nickname']) . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/team'), $filename);
            $validated['photo'] = $filename;
        }
        
        // Set default values
        $validated['is_active'] = $request->has('is_active') ? true : false;
        $validated['order'] = $validated['order'] ?? 0;
        
        // Simpan social media (jika kosong set null)
        $validated['social_platform'] = $validated['social_platform'] ?? null;
        $validated['social_username'] = $validated['social_username'] ?? null;
        
        $divisionIds = $validated['division_ids'];
        unset($validated['division_ids']);
        
        $member = Member::create($validated);
        $member->divisions()->sync($divisionIds);
        
        return redirect()->route('admin.members.index')
            ->with('success', 'Anggota berhasil ditambahkan');
    }

    public function edit(Member $member)
    {
        $divisions = Division::where('is_active', true)->orderBy('order')->get();
        $selectedDivisions = $member->divisions->pluck('id')->toArray();
        return view('admin.members.edit', compact('member', 'divisions', 'selectedDivisions'));
    }

    public function update(Request $request, Member $member)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'nickname' => 'required|string|max:100',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'position' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
            'social_platform' => 'nullable|string|in:instagram,twitter,linkedin,github,tiktok,facebook,youtube,whatsapp,telegram',
            'social_username' => 'nullable|string|max:255',
            'division_ids' => 'required|array|min:1',
            'division_ids.*' => 'exists:divisions,id',
        ]);
        
        // Handle upload foto baru
        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($member->photo && file_exists(public_path('images/team/' . $member->photo))) {
                unlink(public_path('images/team/' . $member->photo));
            }
            
            $file = $request->file('photo');
            $filename = Str::slug($validated['nickname']) . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/team'), $filename);
            $validated['photo'] = $filename;
        }
        
        // Set values
        $validated['is_active'] = $request->has('is_active') ? true : false;
        $validated['order'] = $validated['order'] ?? 0;
        $validated['social_platform'] = $validated['social_platform'] ?? null;
        $validated['social_username'] = $validated['social_username'] ?? null;
        
        $divisionIds = $validated['division_ids'];
        unset($validated['division_ids']);
        
        $member->update($validated);
        $member->divisions()->sync($divisionIds);
        
        return redirect()->route('admin.members.index')
            ->with('success', 'Anggota berhasil diperbarui');
    }

    public function destroy(Member $member)
    {
        // Hapus foto jika ada
        if ($member->photo && file_exists(public_path('images/team/' . $member->photo))) {
            unlink(public_path('images/team/' . $member->photo));
        }
        
        // Hapus relasi divisions
        $member->divisions()->detach();
        
        // Hapus member
        $member->delete();
        
        return redirect()->route('admin.members.index')
            ->with('success', 'Anggota berhasil dihapus');
    }
}