@extends('adminlte::page')

@section('title', 'Manajemen Divisi')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1>Manajemen Divisi</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Divisi</li>
            </ol>
        </div>
        <a href="{{ route('admin.divisions.create') }}" class="btn btn-primary">
            <i class="fas fa-plus mr-1"></i> Tambah Divisi
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

    <div class="card">
        <div class="card-body p-0">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width="50">#</th>
                        <th>Nama Divisi</th>
                        <th>Slug</th>
                        <th>Instagram</th>
                        <th width="100">Jml Member</th>
                        <th width="80">Status</th>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($divisions as $division)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <strong>{{ $division->name }}</strong>
                                @if($division->description)
                                    <br><small class="text-muted">{{ Str::limit($division->description, 50) }}</small>
                                @endif
                            </td>
                            <td>{{ $division->slug }}</td>
                            <td>{{ $division->instagram ?? '-' }}</td>
                            <td>
                                <span class="badge badge-info">{{ $division->members_count }} member</span>
                            </td>
                            <td>
                                @if($division->is_active)
                                    <span class="badge badge-success">Aktif</span>
                                @else
                                    <span class="badge badge-secondary">Nonaktif</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.divisions.edit', $division) }}" class="btn btn-xs btn-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.divisions.destroy', $division) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-xs btn-danger" 
                                            onclick="return confirm('Yakin hapus divisi ini? Semua member di dalamnya juga akan terhapus.')" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                <i class="fas fa-layer-group fa-2x mb-2 opacity-50"></i>
                                <p>Belum ada divisi</p>
                                <a href="{{ route('admin.divisions.create') }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-plus mr-1"></i> Tambah Divisi
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($divisions->hasPages())
            <div class="card-footer">{{ $divisions->links() }}</div>
        @endif
    </div>
@stop