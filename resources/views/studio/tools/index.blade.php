@extends('adminlte::page')

@section('title', 'Manajemen Alat Sewa')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1>Manajemen Alat Sewa</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('studio.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Alat Sewa</li>
            </ol>
        </div>
        <a href="{{ route('studio.tools.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Alat
        </a>
    </div>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

    <div class="card">
        <div class="card-body table-responsive p-0">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width="50">#</th>
                        <th width="80">Gambar</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Harga/Hari</th>
                        <th>Stok</th>
                        <th>Status</th>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tools as $tool)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if($tool->image)
                                    <img src="{{ asset('storage/' . $tool->image) }}" 
                                         style="width: 50px; height: 50px; object-fit: cover;">
                                @else
                                    <div class="bg-secondary d-flex align-items-center justify-content-center" 
                                         style="width: 50px; height: 50px;">
                                        <i class="fas fa-tools text-white"></i>
                                    </div>
                                @endif
                            </td>
                            <td>{{ $tool->name }}</td>
                            <td>{{ $tool->category }}</td>
                            <td>Rp {{ number_format($tool->price_per_day, 0, ',', '.') }}</td>
                            <td>{{ $tool->stock }}</td>
                            <td>
                                @if($tool->is_available)
                                    <span class="badge badge-success">Tersedia</span>
                                @else
                                    <span class="badge badge-danger">Tidak Tersedia</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('studio.tools.edit', $tool) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('studio.tools.destroy', $tool) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" 
                                            onclick="return confirm('Yakin ingin menghapus alat ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <i class="fas fa-tools fa-2x text-muted mb-2"></i>
                                <p class="text-muted mb-0">Belum ada alat sewa</p>
                                <a href="{{ route('studio.tools.create') }}" class="btn btn-sm btn-primary mt-2">
                                    <i class="fas fa-plus"></i> Tambah Alat
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($tools->hasPages())
            <div class="card-footer">
                {{ $tools->links() }}
            </div>
        @endif
    </div>
@stop