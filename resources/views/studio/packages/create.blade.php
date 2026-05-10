@extends('adminlte::page')

@section('title', 'Tambah Paket Studio')

@section('content_header')
    <div>
        <h1>Tambah Paket Studio</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('studio.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('studio.packages.index') }}">Paket Studio</a></li>
            <li class="breadcrumb-item active">Tambah</li>
        </ol>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('studio.packages.store') }}" method="POST">
                @csrf
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">Nama Paket <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name') }}" 
                                   placeholder="Contoh: Paket Basic Studio" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="type">Tipe Paket <span class="text-danger">*</span></label>
                            <select name="type" id="type" class="form-control @error('type') is-invalid @enderror" required>
                                <option value="">Pilih Tipe</option>
                                <option value="Basic" {{ old('type') == 'Basic' ? 'selected' : '' }}>Basic</option>
                                <option value="Standard" {{ old('type') == 'Standard' ? 'selected' : '' }}>Standard</option>
                                <option value="Premium" {{ old('type') == 'Premium' ? 'selected' : '' }}>Premium</option>
                                <option value="Exclusive" {{ old('type') == 'Exclusive' ? 'selected' : '' }}>Exclusive</option>
                            </select>
                            @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="description">Deskripsi</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                              id="description" name="description" rows="3" 
                              placeholder="Deskripsi singkat paket...">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="price">Harga (Rp) <span class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('price') is-invalid @enderror" 
                                   id="price" name="price" value="{{ old('price') }}" 
                                   placeholder="Contoh: 250000" required>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="duration">Durasi <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('duration') is-invalid @enderror" 
                                   id="duration" name="duration" value="{{ old('duration') }}" 
                                   placeholder="Contoh: 2 jam" required>
                            @error('duration')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="facilities">Fasilitas (satu per baris)</label>
                    <textarea class="form-control @error('facilities') is-invalid @enderror" 
                              id="facilities" name="facilities" rows="5" 
                              placeholder="Background polos&#10;Lighting standar&#10;Kamera DSLR&#10;Edit 5 foto">{{ old('facilities') }}</textarea>
                    <small class="form-text text-muted">Tulis setiap fasilitas pada baris baru.</small>
                    @error('facilities')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-1"></i> Simpan Paket
                    </button>
                    <a href="{{ route('studio.packages.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times mr-1"></i> Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@stop