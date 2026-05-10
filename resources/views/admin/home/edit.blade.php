@extends('adminlte::page')

@section('title', 'Edit Beranda')

@section('content_header')
    <h1>Pengaturan Halaman Beranda</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.home.update') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="hero_title">Judul Hero</label>
                    <input type="text" class="form-control @error('hero_title') is-invalid @enderror" 
                           id="hero_title" name="hero_title" 
                           value="{{ old('hero_title', $settings['hero_title'] ?? 'Selamat Datang di QofMedia') }}" required>
                    @error('hero_title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="hero_subtitle">Subjudul Hero</label>
                    <input type="text" class="form-control @error('hero_subtitle') is-invalid @enderror" 
                           id="hero_subtitle" name="hero_subtitle" 
                           value="{{ old('hero_subtitle', $settings['hero_subtitle'] ?? 'Tim Multimedia Pondok Pesantren Tahfidzul Qur\'an Nurul Huda') }}" required>
                    @error('hero_subtitle')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="hero_cta_text">Teks Tombol CTA</label>
                    <input type="text" class="form-control @error('hero_cta_text') is-invalid @enderror" 
                           id="hero_cta_text" name="hero_cta_text" 
                           value="{{ old('hero_cta_text', $settings['hero_cta_text'] ?? 'Lihat Layanan Kami') }}" required>
                    @error('hero_cta_text')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="hero_cta_url">URL Tombol CTA</label>
                    <input type="text" class="form-control @error('hero_cta_url') is-invalid @enderror" 
                           id="hero_cta_url" name="hero_cta_url" 
                           value="{{ old('hero_cta_url', $settings['hero_cta_url'] ?? '/layanan/studio') }}" required>
                    @error('hero_cta_url')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Simpan Pengaturan
                </button>
            </form>
        </div>
    </div>
@stop