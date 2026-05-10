@extends('adminlte::page')

@section('title', 'Edit Artikel')

@section('content_header')
    <h1>Edit Artikel: {{ $article->title }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.articles.update', $article) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="title">Judul <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" 
                           id="title" name="title" value="{{ old('title', $article->title) }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="category">Kategori <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('category') is-invalid @enderror" 
                           id="category" name="category" value="{{ old('category', $article->category) }}" required>
                    @error('category')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="excerpt">Ringkasan</label>
                    <textarea class="form-control @error('excerpt') is-invalid @enderror" 
                              id="excerpt" name="excerpt" rows="2">{{ old('excerpt', $article->excerpt) }}</textarea>
                    @error('excerpt')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="content">Konten <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('content') is-invalid @enderror" 
                              id="content" name="content" rows="10" required>{{ old('content', $article->content) }}</textarea>
                    @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                @if($article->image)
                    <div class="form-group">
                        <label>Gambar Saat Ini</label>
                        <div>
                            <img src="{{ asset('storage/' . $article->image) }}" 
                                 alt="{{ $article->title }}" style="max-width: 200px;">
                        </div>
                    </div>
                @endif
                
                <div class="form-group">
                    <label for="image">Gambar (Baru)</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" 
                           id="image" name="image" accept="image/*">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="published_at">Tanggal Publish</label>
                    <input type="datetime-local" class="form-control @error('published_at') is-invalid @enderror" 
                           id="published_at" name="published_at" 
                           value="{{ old('published_at', $article->published_at?->format('Y-m-d\TH:i')) }}">
                    @error('published_at')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Artikel
                    </button>
                    <a href="{{ route('admin.articles.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
@stop