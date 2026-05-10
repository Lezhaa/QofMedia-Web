@extends('adminlte::page')

@section('title', 'Tambah Alat')

@section('content_header')
    <h1>Tambah Alat Baru</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('studio.tools.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="form-group">
                    <label for="name">Nama Alat</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                           id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="category">Kategori</label>
                    <input type="text" class="form-control @error('category') is-invalid @enderror" 
                           id="category" name="category" value="{{ old('category') }}" required>
                    @error('category')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="description">Deskripsi</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                              id="description" name="description" rows="3">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="price_per_day">Harga per Hari</label>
                            <input type="number" class="form-control @error('price_per_day') is-invalid @enderror" 
                                   id="price_per_day" name="price_per_day" value="{{ old('price_per_day') }}" required>
                            @error('price_per_day')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="stock">Stok</label>
                            <input type="number" class="form-control @error('stock') is-invalid @enderror" 
                                   id="stock" name="stock" value="{{ old('stock') }}" required>
                            @error('stock')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="image">Gambar</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" 
                           id="image" name="image" accept="image/*">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="is_available" name="is_available" value="1" checked>
                        <label class="custom-control-label" for="is_available">Tersedia</label>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('studio.tools.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@stop