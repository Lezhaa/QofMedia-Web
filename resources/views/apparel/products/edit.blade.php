@extends('adminlte::page')

@section('title', 'Edit Produk')

@section('content_header')
    <div>
        <h1>Edit Produk</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('apparel.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('apparel.products.index') }}">Produk</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </div>
@stop

@section('content')

    {{-- ===================== FORM UTAMA ===================== --}}
    <form action="{{ route('apparel.products.update', $product) }}" method="POST" enctype="multipart/form-data" id="mainForm">
        @csrf
        @method('PUT')

        <div class="card">
            <div class="card-body">

                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="name">Nama Produk <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   id="name" name="name" value="{{ old('name', $product->name) }}" required>
                            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Deskripsi</label>
                            <textarea class="form-control @error('description') is-invalid @enderror"
                                      id="description" name="description" rows="4">{{ old('description', $product->description) }}</textarea>
                            @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="category_id">Kategori <span class="text-danger">*</span></label>
                            <select name="category_id" id="category_id" class="form-control" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="type">Tipe Produk <span class="text-danger">*</span></label>
                            <select name="type" id="type" class="form-control" required>
                                <option value="other" {{ old('type', $product->type) == 'other' ? 'selected' : '' }}>Produk Biasa</option>
                                <option value="kaos"  {{ old('type', $product->type) == 'kaos'  ? 'selected' : '' }}>Kaos</option>
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="price">Harga</label>
                                    <input type="number" class="form-control" name="price" value="{{ old('price', $product->price) }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="stock">Stok</label>
                                    <input type="number" class="form-control" name="stock" value="{{ old('stock', $product->stock) }}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Gambar Utama --}}
                <div class="row mt-3">
                    <div class="col-md-6">
                        @if($product->image)
                            <div class="mb-2">
                                <label>Gambar Saat Ini</label><br>
                                <img src="{{ asset('storage/'.$product->image) }}" style="max-width:150px; border-radius:8px;">
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="image">Ganti Gambar Utama</label>
                            <input type="file" class="form-control" name="image" accept="image/*">
                            <small class="text-muted">Kosongkan jika tidak ingin mengubah</small>
                        </div>
                    </div>
                </div>

                {{-- Tambah Galeri Baru --}}
                <div class="card mt-3">
                    <div class="card-header">
                        <h5 class="card-title mb-0"><i class="fas fa-images"></i> Tambah Foto Galeri</h5>
                    </div>
                    <div class="card-body">
                        <div id="galleryContainer">
                            <div class="gallery-row row mb-2">
                                <div class="col-md-5">
                                    <label>Foto</label>
                                    <input type="file" name="gallery_images[]" class="form-control" accept="image/*">
                                </div>
                                <div class="col-md-5">
                                    <label>Label</label>
                                    <input type="text" name="gallery_labels[]" class="form-control" placeholder="Contoh: Motif A - Hitam">
                                </div>
                                <div class="col-md-2 d-flex align-items-end">
                                    {{-- tombol hapus baris pertama disembunyikan --}}
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-sm btn-info mt-2" id="addGalleryRow">
                            <i class="fas fa-plus"></i> Tambah Foto
                        </button>
                    </div>
                </div>

                {{-- Tombol Submit --}}
                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-save"></i> Update Produk
                    </button>
                    <a href="{{ route('apparel.products.index') }}" class="btn btn-secondary btn-lg">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>

            </div>
        </div>
    </form>
    {{-- ===================== END FORM UTAMA ===================== --}}


    {{-- ===================== GALERI EXISTING (DI LUAR FORM UTAMA) ===================== --}}
    @if($product->images->count() > 0)
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="card-title mb-0">Galeri Saat Ini</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach($product->images as $img)
                        <div class="col-md-2 text-center mb-3">
                            <img src="{{ asset('storage/'.$img->image) }}" style="width:100%; border-radius:8px;">

                            {{-- Form Update Label --}}
                            <form action="{{ route('apparel.products.updateImageLabel', $img->id) }}" method="POST" class="mt-1">
                                @csrf
                                <input type="text" name="label" value="{{ $img->label }}"
                                       class="form-control form-control-sm text-center"
                                       style="font-size:0.75rem;">
                                <button type="submit" class="btn btn-sm btn-info mt-1 btn-block" style="font-size:0.7rem;">
                                    <i class="fas fa-check"></i> Update
                                </button>
                            </form>

                            {{-- Form Delete --}}
                            <form action="{{ route('apparel.products.deleteImage', $img->id) }}" method="POST"
                                  onsubmit="return confirm('Hapus foto ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger mt-1 btn-block" style="font-size:0.7rem;">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
    {{-- ===================== END GALERI EXISTING ===================== --}}

@stop

@section('js')
<script>
    document.getElementById('addGalleryRow').addEventListener('click', function () {
        const container = document.getElementById('galleryContainer');
        const row = document.createElement('div');
        row.className = 'gallery-row row mb-2';
        row.innerHTML = `
            <div class="col-md-5">
                <input type="file" name="gallery_images[]" class="form-control" accept="image/*">
            </div>
            <div class="col-md-5">
                <input type="text" name="gallery_labels[]" class="form-control" placeholder="Label foto">
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="button" class="btn btn-danger btn-sm"
                        onclick="this.closest('.gallery-row').remove()">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        `;
        container.appendChild(row);
    });
</script>
@stop