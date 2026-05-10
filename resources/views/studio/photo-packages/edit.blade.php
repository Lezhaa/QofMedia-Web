@extends('adminlte::page')

@section('title', 'Edit Paket Foto')

@section('content_header')
    <div>
        <h1>Edit Paket Fotografi</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('studio.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('studio.photo-packages.index') }}">Paket Foto</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('studio.photo-packages.update', $package) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="name">Nama Paket <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                           id="name" name="name" value="{{ old('name', $package->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="price">Harga <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('price') is-invalid @enderror" 
                                   id="price" name="price" value="{{ old('price', $package->price) }}" required>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="duration">Durasi <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('duration') is-invalid @enderror" 
                                   id="duration" name="duration" value="{{ old('duration', $package->duration) }}" required>
                            @error('duration')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="description">Deskripsi</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                              id="description" name="description" rows="3">{{ old('description', $package->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="features">Fitur (pisahkan dengan koma)</label>
                    <textarea class="form-control @error('features') is-invalid @enderror" 
                              id="features" name="features" rows="4">{{ old('features', is_array($package->features) ? implode(', ', $package->features) : $package->features) }}</textarea>
                    <small class="form-text text-muted">Pisahkan setiap fitur dengan koma (,)</small>
                    @error('features')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="is_popular" name="is_popular" value="1" {{ old('is_popular', $package->is_popular) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="is_popular">
                            Tandai sebagai paket populer
                        </label>
                    </div>
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Update Paket
                    </button>
                    <a href="{{ route('studio.photo-packages.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@stop