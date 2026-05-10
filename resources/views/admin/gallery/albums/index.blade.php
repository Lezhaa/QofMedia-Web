@extends('adminlte::page')

@section('title', 'Manajemen Album')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1>Manajemen Album</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Album</li>
            </ol>
        </div>
        <a href="{{ route('admin.albums.create') }}" class="btn btn-primary">
            <i class="fas fa-plus mr-1"></i> Tambah Album
        </a>
    </div>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card">
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th width="50">#</th>
                        <th width="80">Cover</th>
                        <th>Nama Album</th>
                        <th>Tahun</th>
                        <th>Deskripsi</th>
                        <th width="100">Total Item</th>
                        <th width="200">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($albums as $album)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if($album->cover_image)
                                    <img src="{{ asset('storage/' . $album->cover_image) }}" 
                                         alt="{{ $album->name }}" 
                                         style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                                @else
                                    <div class="bg-secondary d-flex align-items-center justify-content-center" 
                                         style="width: 50px; height: 50px; border-radius: 5px;">
                                        <i class="fas fa-image text-white"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <strong>{{ $album->name }}</strong>
                                <br>
                                <small class="text-muted">{{ $album->slug }}</small>
                            </td>
                            <td>{{ $album->year }}</td>
                            <td>{{ Str::limit($album->description, 40) ?: '-' }}</td>
                            <td>
                                <span class="badge badge-info">
                                    <i class="fas fa-images mr-1"></i> {{ $album->items_count }} item
                                </span>
                            </td>
                            <td>
                                {{-- Tombol Lihat Item (NEW) --}}
                                <a href="{{ route('admin.albums.items.index', $album) }}" 
                                   class="btn btn-sm btn-primary" 
                                   title="Kelola Item">
                                    <i class="fas fa-images"></i> Item
                                </a>
                                
                                {{-- Tombol Edit --}}
                                <a href="{{ route('admin.albums.edit', $album) }}" 
                                   class="btn btn-sm btn-warning" 
                                   title="Edit Album">
                                    <i class="fas fa-edit"></i>
                                </a>
                                
                                {{-- Tombol Lihat Publik --}}
                                <a href="{{ route('gallery.album', ['year' => $album->year, 'slug' => $album->slug]) }}" 
                                   class="btn btn-sm btn-info" 
                                   target="_blank" 
                                   title="Lihat di Website">
                                    <i class="fas fa-eye"></i>
                                </a>
                                
                                {{-- Tombol Hapus --}}
                                <form action="{{ route('admin.albums.destroy', $album) }}" 
                                      method="POST" 
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="btn btn-sm btn-danger" 
                                            onclick="return confirm('Yakin ingin menghapus album ini? Semua item di dalamnya juga akan dihapus.')"
                                            title="Hapus Album">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <i class="fas fa-images fa-3x text-muted mb-3"></i>
                                <p class="text-muted">Belum ada album</p>
                                <a href="{{ route('admin.albums.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus mr-1"></i> Tambah Album Pertama
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($albums->hasPages())
            <div class="card-footer">
                {{ $albums->links() }}
            </div>
        @endif
    </div>
@stop

@section('css')
    <style>
        .table td {
            vertical-align: middle;
        }
        
        .btn-sm {
            margin: 2px;
        }
    </style>
@stop