@extends('adminlte::page')

@section('title', 'Manajemen Anggota Tim')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1>Manajemen Anggota Tim</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Anggota Tim</li>
            </ol>
        </div>
        <a href="{{ route('admin.members.create') }}" class="btn btn-primary">
            <i class="fas fa-plus mr-1"></i> Tambah Anggota
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

    <!-- Filter -->
    <div class="card">
        <div class="card-body">
            <form method="GET" class="form-inline">
                <div class="row w-100">
                    <div class="col-md-3">
                        <select name="division_id" class="form-control w-100">
                            <option value="">Semua Divisi</option>
                            @foreach($divisions as $div)
                                <option value="{{ $div->id }}" {{ request('division_id') == $div->id ? 'selected' : '' }}>
                                    {{ $div->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-filter mr-1"></i> Filter
                        </button>
                        <a href="{{ route('admin.members.index') }}" class="btn btn-secondary">Reset</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Members Table -->
    <div class="card">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="thead-light">
                    <tr>
                        <th width="60">Foto</th>
                        <th>Nama</th>
                        <th>Panggilan</th>
                        <th>Media Sosial</th>
                        <th>Divisi</th>
                        <th>Status</th>
                        <th>Urutan</th>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($members as $member)
                        <tr>
                            <td>
                                @if($member->photo_url)
                                    <img src="{{ $member->photo_url }}" style="width: 40px; height: 40px; object-fit: cover; border-radius: 8px;">
                                @else
                                    <div style="width: 40px; height: 40px; border-radius: 8px; background: #6366f1; display: flex; align-items: center; justify-content: center;">
                                        <span style="color: white; font-weight: 700; font-size: 16px;">
                                            {{ strtoupper(substr($member->nickname, 0, 1)) }}
                                        </span>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <strong>{{ $member->name }}</strong>
                                @if($member->position)
                                    <br><small class="text-muted">{{ $member->position }}</small>
                                @endif
                            </td>
                            <td>{{ $member->nickname }}</td>
                            <td>
                                @if($member->social_platform && $member->social_username)
                                    <a href="{{ $member->social_url }}" target="_blank" class="text-decoration-none">
                                        <i class="fab fa-{{ $member->social_platform }}"></i>
                                        {{ ucfirst($member->social_platform) }}
                                    </a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @forelse($member->divisions as $div)
                                    <span class="badge badge-info mr-1 mb-1">{{ $div->name }}</span>
                                @empty
                                    <span class="text-muted">-</span>
                                @endforelse
                            </td>
                            <td>
                                @if($member->is_active)
                                    <span class="badge badge-success">Aktif</span>
                                @else
                                    <span class="badge badge-secondary">Nonaktif</span>
                                @endif
                            </td>
                            <td>{{ $member->order }}</td>
                            <td>
                                <a href="{{ route('admin.members.edit', $member) }}" class="btn btn-xs btn-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.members.destroy', $member) }}" method="POST" class="d-inline" 
                                      onsubmit="return confirm('Yakin hapus anggota {{ $member->name }}?')">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-xs btn-danger" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <i class="fas fa-users fa-3x mb-2 opacity-50"></i>
                                <p class="mb-0">Belum ada anggota tim</p>
                                <a href="{{ route('admin.members.create') }}" class="btn btn-sm btn-primary mt-2">
                                    <i class="fas fa-plus mr-1"></i> Tambah Anggota
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($members->hasPages())
            <div class="card-footer">
                {{ $members->links() }}
            </div>
        @endif
    </div>
@stop