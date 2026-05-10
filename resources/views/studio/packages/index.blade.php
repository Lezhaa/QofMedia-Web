@extends('adminlte::page')

@section('title', 'Paket Studio')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1>Paket Studio</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('studio.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Paket Studio</li>
            </ol>
        </div>
        <a href="{{ route('studio.packages.create') }}" class="btn btn-primary">
            <i class="fas fa-plus mr-1"></i> Tambah Paket
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
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="50">#</th>
                            <th>Nama Paket</th>
                            <th>Tipe</th>
                            <th>Harga</th>
                            <th>Durasi</th>
                            <th>Fasilitas</th>
                            <th width="120">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($packages as $index => $package)
                            <tr>
                                <td>{{ $packages->firstItem() + $index }}</td>
                                <td>
                                    <strong>{{ $package->name }}</strong>
                                    <br>
                                    <small class="text-muted">{{ Str::limit($package->description, 40) }}</small>
                                </td>
                                <td><span class="badge badge-info">{{ $package->type }}</span></td>
                                <td>Rp {{ number_format($package->price, 0, ',', '.') }}</td>
                                <td>{{ $package->duration }}</td>
                                <td>
                                    @if(is_array($package->facilities) && count($package->facilities) > 0)
                                        <ul class="list-unstyled mb-0 small">
                                            @foreach(array_slice($package->facilities, 0, 3) as $facility)
                                                <li><i class="fas fa-check text-success mr-1"></i> {{ $facility }}</li>
                                            @endforeach
                                            @if(count($package->facilities) > 3)
                                                <li class="text-muted">+{{ count($package->facilities) - 3 }} lainnya</li>
                                            @endif
                                        </ul>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('studio.packages.edit', $package) }}" class="btn btn-xs btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('studio.packages.destroy', $package) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-xs btn-danger" 
                                                onclick="return confirm('Yakin ingin menghapus paket ini?')" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">
                                    <i class="fas fa-video fa-2x mb-2 opacity-50"></i>
                                    <p>Belum ada paket studio</p>
                                    <a href="{{ route('studio.packages.create') }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-plus mr-1"></i> Tambah Paket
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($packages->hasPages())
            <div class="card-footer">
                {{ $packages->links() }}
            </div>
        @endif
    </div>
@stop