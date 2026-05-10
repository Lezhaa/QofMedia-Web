@extends('adminlte::page')

@section('title', 'Tambah Divisi')

@section('content_header')
    <div>
        <h1>Tambah Divisi</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.divisions.index') }}">Divisi</a></li>
            <li class="breadcrumb-item active">Tambah</li>
        </ol>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.divisions.store') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="name">Nama Divisi <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                           id="name" name="name" value="{{ old('name') }}" 
                           placeholder="Contoh: Broadcasting" required>
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                
                <div class="form-group">
                    <label for="description">Deskripsi</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                              id="description" name="description" rows="3" 
                              placeholder="Deskripsi singkat divisi...">{{ old('description') }}</textarea>
                    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="instagram">Instagram</label>
                            <input type="text" class="form-control @error('instagram') is-invalid @enderror" 
                                   id="instagram" name="instagram" value="{{ old('instagram') }}" 
                                   placeholder="@qofmedia.divisi">
                            @error('instagram') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="order">Urutan</label>
                            <input type="number" class="form-control @error('order') is-invalid @enderror" 
                                   id="order" name="order" value="{{ old('order', 0) }}" min="0">
                            @error('order') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save mr-1"></i> Simpan
                </button>
                <a href="{{ route('admin.divisions.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@stop