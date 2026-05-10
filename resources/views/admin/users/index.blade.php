@extends('adminlte::page')

@section('title', 'Manajemen User')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1>Manajemen User</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">User</li>
            </ol>
        </div>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
            <i class="fas fa-plus mr-1"></i> Tambah User
        </a>
    </div>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif
    
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="fas fa-exclamation-circle mr-1"></i> {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

    <!-- Stats Cards -->
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $stats['total'] }}</h3>
                    <p>Total User</p>
                </div>
                <div class="icon"><i class="fas fa-users"></i></div>
            </div>
        </div>
        <div class="col-lg-2 col-6">
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3>{{ $stats['admin'] }}</h3>
                    <p>Admin</p>
                </div>
                <div class="icon"><i class="fas fa-user-shield"></i></div>
            </div>
        </div>
        <div class="col-lg-2 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $stats['studio'] }}</h3>
                    <p>Studio</p>
                </div>
                <div class="icon"><i class="fas fa-camera"></i></div>
            </div>
        </div>
        <div class="col-lg-2 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $stats['apparel'] }}</h3>
                    <p>Apparel</p>
                </div>
                <div class="icon"><i class="fas fa-tshirt"></i></div>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <div class="small-box bg-secondary">
                <div class="inner">
                    <h3>{{ $stats['user'] }}</h3>
                    <p>User Biasa</p>
                </div>
                <div class="icon"><i class="fas fa-user"></i></div>
            </div>
        </div>
    </div>

    <!-- Filter -->
    <div class="card">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.users.index') }}" class="form-inline">
                <div class="row">
                    <div class="col-md-5">
                        <input type="text" name="search" class="form-control w-100" 
                               placeholder="Cari nama atau email..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-4">
                        <select name="role" class="form-control w-100">
                            <option value="">Semua Role</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->name }}" {{ request('role') == $role->name ? 'selected' : '' }}>
                                    {{ ucfirst(str_replace('_', ' ', $role->name)) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-filter mr-1"></i> Filter
                        </button>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Reset</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Users Table -->
    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="50">#</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No. HP</th>
                            <th>Role</th>
                            <th>Tanggal Daftar</th>
                            <th width="120">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $index => $user)
                            <tr>
                                <td>{{ $users->firstItem() + $index }}</td>
                                <td>
                                    <strong>{{ $user->name }}</strong>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone ?? '-' }}</td>
                                <td>
                                    @foreach($user->roles as $role)
                                        @php
                                            $badgeClass = match($role->name) {
                                                'admin_qofmedia' => 'primary',
                                                'admin_studio' => 'success',
                                                'admin_apparel' => 'warning',
                                                'user' => 'secondary',
                                                default => 'info'
                                            };
                                            $roleName = match($role->name) {
                                                'admin_qofmedia' => 'Admin',
                                                'admin_studio' => 'Studio',
                                                'admin_apparel' => 'Apparel',
                                                'user' => 'User',
                                                default => $role->name
                                            };
                                        @endphp
                                        <span class="badge badge-{{ $badgeClass }}">{{ $roleName }}</span>
                                    @endforeach
                                </td>
                                <td>{{ $user->created_at->format('d M Y') }}</td>
                                <td>
                                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-xs btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @if($user->id !== auth()->id())
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-xs btn-danger" 
                                                    onclick="return confirm('Yakin ingin menghapus user ini?')" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">
                                    <i class="fas fa-users fa-2x mb-2 opacity-50"></i>
                                    <p>Belum ada user</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($users->hasPages())
            <div class="card-footer">
                {{ $users->links() }}
            </div>
        @endif
    </div>
@stop