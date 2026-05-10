@extends('adminlte::page')

@section('title', 'Produk Apparel')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Produk Apparel</h1>
        <a href="{{ route('apparel.products.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Produk
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
                        <th>Tipe</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th width="100">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products ?? [] as $product)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" 
                                         style="width: 50px; height: 50px; object-fit: cover;">
                                @else
                                    <div class="bg-secondary d-flex align-items-center justify-content-center" 
                                         style="width: 50px; height: 50px;">
                                        <i class="fas fa-box text-white"></i>
                                    </div>
                                @endif
                            </td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->category->name ?? 'N/A' }}</td>
                            <td>
                                <span class="badge badge-{{ $product->type == 'kaos' ? 'info' : 'secondary' }}">
                                    {{ ucfirst($product->type) }}
                                </span>
                            </td>
                            <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>
                                <a href="{{ route('apparel.products.edit', $product) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('apparel.products.destroy', $product) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" 
                                            onclick="return confirm('Yakin ingin menghapus produk ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <i class="fas fa-box fa-2x text-muted mb-2"></i>
                                <p class="text-muted mb-0">Belum ada produk</p>
                                <a href="{{ route('apparel.products.create') }}" class="btn btn-sm btn-primary mt-2">
                                    <i class="fas fa-plus"></i> Tambah Produk
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if(isset($products) && $products->hasPages())
            <div class="card-footer">
                {{ $products->links() }}
            </div>
        @endif
    </div>
@stop