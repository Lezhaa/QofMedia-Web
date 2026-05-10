@extends('adminlte::page')

@section('title', 'Edit Divisi')

@section('content_header')
    <div>
        <h1>Edit Divisi: {{ $division->name }}</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.divisions.index') }}">Divisi</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.divisions.update', $division) }}" method="POST">
                @csrf @method('PUT')
                
                <div class="form-group">
                    <label>Nama Divisi <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                           name="name" value="{{ old('name', $division->name) }}" required>
                    @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                
                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                              name="description" rows="3">{{ old('description', $division->description) }}</textarea>
                    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Instagram</label>
                            <input type="text" class="form-control @error('instagram') is-invalid @enderror" 
                                   name="instagram" value="{{ old('instagram', $division->instagram) }}">
                            @error('instagram') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Urutan</label>
                            <input type="number" class="form-control" name="order" 
                                   value="{{ old('order', $division->order) }}" min="0">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Status</label>
                            <select name="is_active" class="form-control">
                                <option value="1" {{ $division->is_active ? 'selected' : '' }}>Aktif</option>
                                <option value="0" {{ !$division->is_active ? 'selected' : '' }}>Nonaktif</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i> Update</button>
                <a href="{{ route('admin.divisions.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@stop