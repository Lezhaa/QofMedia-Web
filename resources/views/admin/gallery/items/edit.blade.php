@extends('adminlte::page')

@section('title', 'Edit Item')

@section('content_header')
    <div>
        <h1>Edit Item</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.albums.index') }}">Album</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.albums.items.index', $album) }}">{{ $album->name }}</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.albums.items.update', [$album, $item]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label>File Saat Ini</label>
                            <div>
                                @if($item->type == 'foto')
                                    <img src="{{ asset('storage/' . $item->file_path) }}" 
                                         class="img-fluid rounded" 
                                         style="max-height: 200px;">
                                @else
                                    <div class="bg-dark d-flex align-items-center justify-content-center" 
                                         style="height: 150px; width: 100%;">
                                        <i class="fas fa-video text-white fa-3x"></i>
                                        <span class="text-white ml-2">Video</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="file">Ganti File (Opsional)</label>
                            <input type="file" class="form-control @error('file') is-invalid @enderror" 
                                   id="file" name="file" accept="image/*,video/*">
                            <small class="form-text text-muted">Kosongkan jika tidak ingin mengganti file.</small>
                            @error('file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="caption">Caption</label>
                            <input type="text" class="form-control @error('caption') is-invalid @enderror" 
                                   id="caption" name="caption" value="{{ old('caption', $item->caption) }}" 
                                   placeholder="Deskripsi singkat">
                            @error('caption')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save mr-1"></i> Update
                            </button>
                            <a href="{{ route('admin.albums.items.index', $album) }}" class="btn btn-secondary">
                                <i class="fas fa-times mr-1"></i> Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop