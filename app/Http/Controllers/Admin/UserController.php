<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::with('roles');
        
        // Search
        if ($request->has('search') && $request->search != '') {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }
        
        // Filter by role
        if ($request->has('role') && $request->role != '') {
            $query->whereHas('roles', function($q) use ($request) {
                $q->where('name', $request->role);
            });
        }
        
        $users = $query->latest()->paginate(15)->withQueryString();
        $roles = Role::all();
        
        // Stats
        $stats = [
            'total' => User::count(),
            'admin' => User::whereHas('roles', fn($q) => $q->where('name', 'admin_qofmedia'))->count(),
            'studio' => User::whereHas('roles', fn($q) => $q->where('name', 'admin_studio'))->count(),
            'apparel' => User::whereHas('roles', fn($q) => $q->where('name', 'admin_apparel'))->count(),
            'user' => User::whereHas('roles', fn($q) => $q->where('name', 'user'))->count(),
        ];
        
        return view('admin.users.index', compact('users', 'roles', 'stats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'password' => 'required|string|min:8|confirmed',
            'roles' => 'nullable|array',
        ]);
        
        $validated['password'] = bcrypt($validated['password']);
        $validated['email_verified_at'] = now();
        
        $user = User::create($validated);
        
        if ($request->has('roles')) {
            $user->syncRoles($request->roles);
        } else {
            $user->assignRole('user');
        }
        
        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $user->load('roles');
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        $userRoles = $user->roles->pluck('name')->toArray();
        return view('admin.users.edit', compact('user', 'roles', 'userRoles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:8|confirmed',
            'roles' => 'nullable|array',
        ]);
        
        if ($request->filled('password')) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }
        
        $user->update($validated);
        
        if ($request->has('roles')) {
            $user->syncRoles($request->roles);
        }
        
        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Cegah hapus diri sendiri
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')
                ->with('error', 'Anda tidak dapat menghapus akun sendiri.');
        }
        
        $user->delete();
        
        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil dihapus');
    }
    
    /**
     * Assign role to user (AJAX)
     */
    public function assignRole(Request $request, User $user)
    {
        $request->validate([
            'roles' => 'required|array',
        ]);
        
        $user->syncRoles($request->roles);
        
        return response()->json([
            'success' => true,
            'message' => 'Role berhasil diperbarui'
        ]);
    }
}