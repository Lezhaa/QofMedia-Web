@extends('adminlte::page')

@section('title', 'Edit Album')

@section('content_header')
    <h1>Edit Album: {{ $album->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.albums.update', $album) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="name">Nama Album <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                           id="name" name="name" value="{{ old('name', $album->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="year">Tahun <span class="text-danger">*</span></label>
                    <input type="number" class="form-control @error('year') is-invalid @enderror" 
                           id="year" name="year" value="{{ old('year', $album->year) }}" 
                           min="2000" max="2099" required>
                    @error('year')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="description">Deskripsi</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                              id="description" name="description" rows="3">{{ old('description', $album->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label>Cover Saat Ini</label>
                    <div>
                        @if($album->cover_image)
                            <img src="{{ asset('storage/' . $album->cover_image) }}" 
                                 alt="{{ $album->name }}" style="max-width: 200px;">
                        @else
                            <p class="text-muted">Tidak ada cover</p>
                        @endif
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="cover_image">Cover Album (Baru)</label>
                    <input type="file" class="form-control @error('cover_image') is-invalid @enderror" 
                           id="cover_image" name="cover_image" accept="image/*">
                    <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah cover</small>
                    @error('cover_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Album
                    </button>
                    <a href="{{ route('admin.albums.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@stop