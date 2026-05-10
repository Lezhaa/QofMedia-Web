@extends('adminlte::page')

@section('title', 'Dashboard Studio')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Dashboard Admin Studio</h1>
        <a href="{{ route('home') }}" class="btn btn-outline-secondary" target="_blank">
            <i class="fas fa-globe"></i> Lihat Website
        </a>
    </div>
@stop

@section('content')
    <!-- Stats Cards -->
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $stats['total_tools'] ?? 0 }}</h3>
                    <p>Total Alat</p>
                </div>
                <div class="icon">
                    <i class="fas fa-tools"></i>
                </div>
                <a href="{{ route('studio.tools.index') }}" class="small-box-footer">
                    Kelola Alat <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $stats['available_tools'] ?? 0 }}</h3>
                    <p>Alat Tersedia</p>
                </div>
                <div class="icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <a href="{{ route('studio.tools.index') }}" class="small-box-footer">
                    Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $stats['total_studio_packages'] ?? 0 }}</h3>
                    <p>Paket Studio</p>
                </div>
                <div class="icon">
                    <i class="fas fa-video"></i>
                </div>
                <a href="{{ route('studio.packages.index') }}" class="small-box-footer">
                    Kelola Paket <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $stats['total_photo_packages'] ?? 0 }}</h3>
                    <p>Paket Foto</p>
                </div>
                <div class="icon">
                    <i class="fas fa-camera"></i>
                </div>
                <a href="{{ route('studio.photo-packages.index') }}" class="small-box-footer">
                    Kelola Paket <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Menu Cepat</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('studio.tools.create') }}" class="btn btn-primary btn-block">
                                <i class="fas fa-plus"></i> Tambah Alat Baru
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('studio.packages.create') }}" class="btn btn-success btn-block">
                                <i class="fas fa-plus"></i> Tambah Paket Studio
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('studio.photo-packages.create') }}" class="btn btn-warning btn-block">
                                <i class="fas fa-plus"></i> Tambah Paket Foto
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('service.studio') }}" class="btn btn-info btn-block" target="_blank">
                                <i class="fas fa-eye"></i> Lihat Halaman Studio
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Info -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Informasi Layanan Studio</h3>
                </div>
                <div class="card-body">
                    <div class="alert alert-info">
                        <h5><i class="icon fas fa-info"></i> Selamat Datang di Dashboard Admin Studio!</h5>
                        <p>Kelola semua alat sewa, paket studio, dan paket fotografi dari menu di sidebar.</p>
                        <hr>
                        <p class="mb-0">
                            <i class="fab fa-whatsapp text-success"></i> 
                            Nomor WhatsApp Studio: <strong>{{ setting('whatsapp_studio', '6281246943349') }}</strong>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop