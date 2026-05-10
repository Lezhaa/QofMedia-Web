@extends('adminlte::page')

@section('title', 'Paket Fotografi')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1>Paket Fotografi</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('studio.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Paket Foto</li>
            </ol>
        </div>
        <a href="{{ route('studio.photo-packages.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Paket
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
                        <th>Nama Paket</th>
                        <th>Harga</th>
                        <th>Durasi</th>
                        <th>Populer</th>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($packages as $package)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $package->name }}</td>
                            <td>Rp {{ number_format($package->price, 0, ',', '.') }}</td>
                            <td>{{ $package->duration }}</td>
                            <td>
                                @if($package->is_popular)
                                    <span class="badge badge-warning">
                                        <i class="fas fa-star"></i> Populer
                                    </span>
                                @else
                                    <span class="badge badge-secondary">-</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('studio.photo-packages.edit', $package) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('studio.photo-packages.destroy', $package) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" 
                                            onclick="return confirm('Yakin ingin menghapus paket ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                <i class="fas fa-camera fa-2x text-muted mb-2"></i>
                                <p class="text-muted mb-0">Belum ada paket fotografi</p>
                                <a href="{{ route('studio.photo-packages.create') }}" class="btn btn-sm btn-primary mt-2">
                                    <i class="fas fa-plus"></i> Tambah Paket
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if(isset($packages) && $packages->hasPages())
            <div class="card-footer">
                {{ $packages->links() }}
            </div>
        @endif
    </div>
@stop