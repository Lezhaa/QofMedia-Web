@extends('adminlte::page')

@section('title', 'Tambah Produk')

@section('content_header')
    <div>
        <h1>Tambah Produk</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('apparel.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('apparel.products.index') }}">Produk</a></li>
            <li class="breadcrumb-item active">Tambah</li>
        </ol>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('apparel.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="name">Nama Produk <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name') }}" required>
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="description">Deskripsi</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="4">{{ old('description') }}</textarea>
                            @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="category_id">Kategori <span class="text-danger">*</span></label>
                            <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror" required>
                                <option value="">Pilih Kategori</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="type">Tipe Produk <span class="text-danger">*</span></label>
                            <select name="type" id="type" class="form-control @error('type') is-invalid @enderror" required>
                                <option value="other" {{ old('type') == 'other' ? 'selected' : '' }}>Produk Biasa</option>
                                <option value="kaos" {{ old('type') == 'kaos' ? 'selected' : '' }}>Kaos (Dengan Edisi/Varian)</option>
                            </select>
                            @error('type') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="price">Harga <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('price') is-invalid @enderror" 
                                           id="price" name="price" value="{{ old('price') }}" required>
                                    @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="stock">Stok <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('stock') is-invalid @enderror" 
                                           id="stock" name="stock" value="{{ old('stock') }}" required>
                                    @error('stock') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Gambar Utama --}}
                <div class="row mt-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="image">Gambar Utama Produk</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                   id="image" name="image" accept="image/*">
                            <small class="form-text text-muted">Ukuran maksimal 2MB, format: JPG, PNG</small>
                            @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                {{-- Galeri Foto --}}
                <div class="card mt-3">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-images"></i> Galeri Produk (Multiple Foto)
                        </h5>
                    </div>
                    <div class="card-body">
                        <p class="text-muted small mb-3">
                            <i class="fas fa-info-circle"></i> Upload foto dengan variasi motif/warna berbeda. 
                            Foto pertama akan jadi tampilan utama. Beri label untuk setiap foto.
                        </p>
                        <div id="galleryContainer">
                            <div class="gallery-row row mb-2">
                                <div class="col-md-5">
                                    <label>Foto</label>
                                    <input type="file" name="gallery_images[]" class="form-control" accept="image/*">
                                </div>
                                <div class="col-md-5">
                                    <label>Label (Nama Motif/Warna)</label>
                                    <input type="text" name="gallery_labels[]" class="form-control" placeholder="Contoh: Motif A - Hitam">
                                </div>
                                <div class="col-md-2 d-flex align-items-end">
                                    <button type="button" class="btn btn-danger btn-sm remove-gallery-row" style="display:none;">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-sm btn-info mt-2" id="addGalleryRow">
                            <i class="fas fa-plus"></i> Tambah Foto
                        </button>
                    </div>
                </div>
                
                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Produk
                    </button>
                    <a href="{{ route('apparel.products.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@stop

@section('js')
<script>
    // Tambah baris galeri
    document.getElementById('addGalleryRow').addEventListener('click', function() {
        const container = document.getElementById('galleryContainer');
        const row = document.createElement('div');
        row.className = 'gallery-row row mb-2';
        row.innerHTML = `
            <div class="col-md-5">
                <label>Foto</label>
                <input type="file" name="gallery_images[]" class="form-control" accept="image/*">
            </div>
            <div class="col-md-5">
                <label>Label (Nama Motif/Warna)</label>
                <input type="text" name="gallery_labels[]" class="form-control" placeholder="Contoh: Motif B - Putih">
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="button" class="btn btn-danger btn-sm remove-gallery-row" onclick="this.closest('.gallery-row').remove()">
                    <i class="fas fa-trash"></i> Hapus
                </button>
            </div>
        `;
        container.appendChild(row);
    });
</script>
@stop