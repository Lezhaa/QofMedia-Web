@extends('adminlte::page')

@section('title', 'Dashboard Admin')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="m-0 text-dark">Dashboard Admin QofMedia</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Overview</li>
            </ol>
        </div>
        <a href="{{ route('home') }}" class="btn btn-outline-primary" target="_blank">
            <i class="fas fa-globe mr-1"></i> Lihat Website
        </a>
    </div>
@stop

@section('content')
    <!-- Welcome Card -->
    <div class="row">
        <div class="col-md-12">
            <div class="card bg-gradient-primary">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="mb-0">Selamat Datang, {{ Auth::user()->name }}!</h4>
                            <p class="mb-0 mt-2 opacity-75">Anda login sebagai Administrator QofMedia</p>
                            <p class="mb-0 small opacity-50">Terakhir login: {{ Auth::user()->last_login_at ?? now()->format('d M Y H:i') }}</p>
                        </div>
                        <div>
                            <i class="fas fa-user-shield fa-4x opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row">
        <div class="col-lg-3 col-6">
            <div class="small-box bg-gradient-info">
                <div class="inner">
                    <h3>{{ $stats['unread_contacts'] ?? 0 }}</h3>
                    <p>Pesan Masuk</p>
                </div>
                <div class="icon">
                    <i class="fas fa-envelope"></i>
                </div>
                <a href="{{ route('admin.contacts.index') }}" class="small-box-footer">
                    Lihat Detail <i class="fas fa-arrow-circle-right ml-1"></i>
                </a>
            </div>
        </div>
        
        <div class="col-lg-3 col-6">
            <div class="small-box bg-gradient-success">
                <div class="inner">
                    <h3>{{ $stats['total_articles'] ?? 0 }}</h3>
                    <p>Total Artikel</p>
                </div>
                <div class="icon">
                    <i class="fas fa-newspaper"></i>
                </div>
                <a href="{{ route('admin.articles.index') }}" class="small-box-footer">
                    Lihat Detail <i class="fas fa-arrow-circle-right ml-1"></i>
                </a>
            </div>
        </div>
        
        <div class="col-lg-3 col-6">
            <div class="small-box bg-gradient-warning">
                <div class="inner">
                    <h3>{{ $stats['total_albums'] ?? 0 }}</h3>
                    <p>Album Galeri</p>
                </div>
                <div class="icon">
                    <i class="fas fa-images"></i>
                </div>
                <a href="{{ route('admin.albums.index') }}" class="small-box-footer">
                    Lihat Detail <i class="fas fa-arrow-circle-right ml-1"></i>
                </a>
            </div>
        </div>
        
        <div class="col-lg-3 col-6">
            <div class="small-box bg-gradient-danger">
                <div class="inner">
                    <h3>{{ $stats['total_users'] ?? 0 }}</h3>
                    <p>Total User</p>
                </div>
                <div class="icon">
                    <i class="fas fa-users"></i>
                </div>
                <a href="{{ route('admin.users.index') }}" class="small-box-footer">
                    Lihat Detail <i class="fas fa-arrow-circle-right ml-1"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="row">
        <div class="col-md-6">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-envelope mr-2 text-primary"></i>
                        Pesan Terbaru
                    </h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.contacts.index') }}" class="btn btn-tool btn-sm">
                            <i class="fas fa-external-link-alt"></i> Lihat Semua
                        </a>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th style="width: 80px">Status</th>
                                    <th style="width: 60px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentContacts ?? [] as $index => $contact)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <strong>{{ $contact->name }}</strong>
                                            <br>
                                            <small class="text-muted">{{ Str::limit($contact->message, 30) }}</small>
                                        </td>
                                        <td>{{ $contact->email }}</td>
                                        <td>
                                            @if($contact->read_at)
                                                <span class="badge badge-success">
                                                    <i class="fas fa-check-circle mr-1"></i> Dibaca
                                                </span>
                                            @else
                                                <span class="badge badge-warning">
                                                    <i class="fas fa-clock mr-1"></i> Belum
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.contacts.show', $contact) }}" 
                                               class="btn btn-xs btn-outline-primary" 
                                               title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4 text-muted">
                                            <i class="fas fa-envelope-open-text fa-2x mb-2 opacity-50"></i>
                                            <p class="mb-0">Belum ada pesan masuk</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if(count($recentContacts ?? []) > 0)
                    <div class="card-footer text-center p-2">
                        <a href="{{ route('admin.contacts.index') }}" class="text-primary small">
                            Lihat semua pesan <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                @endif
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-newspaper mr-2 text-success"></i>
                        Artikel Terbaru
                    </h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.articles.create') }}" class="btn btn-tool btn-sm">
                            <i class="fas fa-plus"></i> Tambah
                        </a>
                        <a href="{{ route('admin.articles.index') }}" class="btn btn-tool btn-sm">
                            <i class="fas fa-external-link-alt"></i> Lihat Semua
                        </a>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Judul</th>
                                    <th style="width: 100px">Kategori</th>
                                    <th style="width: 60px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentArticles ?? [] as $index => $article)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <strong>{{ Str::limit($article->title, 40) }}</strong>
                                            <br>
                                            <small class="text-muted">
                                                <i class="far fa-calendar-alt mr-1"></i>
                                                {{ $article->created_at->format('d M Y') }}
                                            </small>
                                        </td>
                                        <td>
                                            <span class="badge badge-info">{{ $article->category }}</span>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.articles.edit', $article) }}" 
                                               class="btn btn-xs btn-outline-warning" 
                                               title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="{{ route('information.show', $article->slug) }}" 
                                               class="btn btn-xs btn-outline-info" 
                                               target="_blank" 
                                               title="Lihat">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-4 text-muted">
                                            <i class="fas fa-newspaper fa-2x mb-2 opacity-50"></i>
                                            <p class="mb-0">Belum ada artikel</p>
                                            <a href="{{ route('admin.articles.create') }}" class="btn btn-sm btn-primary mt-2">
                                                <i class="fas fa-plus mr-1"></i> Tambah Artikel
                                            </a>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if(count($recentArticles ?? []) > 0)
                    <div class="card-footer text-center p-2">
                        <a href="{{ route('admin.articles.index') }}" class="text-success small">
                            Lihat semua artikel <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-light">
                    <h3 class="card-title">
                        <i class="fas fa-bolt mr-2 text-warning"></i>
                        Aksi Cepat
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 col-sm-6 mb-3">
                            <a href="{{ route('admin.articles.create') }}" class="btn btn-primary btn-block py-3">
                                <i class="fas fa-plus-circle fa-lg mr-2"></i>Tambah Artikel
                            </a>
                        </div>
                        <div class="col-md-3 col-sm-6 mb-3">
                            <a href="{{ route('admin.albums.create') }}" class="btn btn-success btn-block py-3">
                                <i class="fas fa-plus-circle fa-lg mr-2"></i>Tambah Album
                            </a>
                        </div>
                        <div class="col-md-3 col-sm-6 mb-3">
                            <a href="{{ route('admin.users.index') }}" class="btn btn-warning btn-block py-3">
                                <i class="fas fa-users fa-lg mr-2"></i>Manajemen User
                            </a>
                        </div>
                        <div class="col-md-3 col-sm-6 mb-3">
                            <a href="{{ route('admin.settings.index') }}" class="btn btn-secondary btn-block py-3">
                                <i class="fas fa-cog fa-lg mr-2"></i>Pengaturan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- System Info -->
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-secondary collapsed-card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-info-circle mr-2"></i>
                        Informasi Sistem
                    </h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 col-sm-6">
                            <div class="info-box">
                                <span class="info-box-icon bg-info"><i class="fab fa-laravel"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Laravel</span>
                                    <span class="info-box-number">{{ app()->version() }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="info-box">
                                <span class="info-box-icon bg-success"><i class="fas fa-database"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Database</span>
                                    <span class="info-box-number">MySQL</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="info-box">
                                <span class="info-box-icon bg-warning"><i class="fas fa-users"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Total User</span>
                                    <span class="info-box-number">{{ $stats['total_users'] ?? 0 }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="info-box">
                                <span class="info-box-icon bg-danger"><i class="fas fa-clock"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Server Time</span>
                                    <span class="info-box-number">{{ now()->format('H:i:s') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        /* Gradient Backgrounds */
        .bg-gradient-primary {
            background: linear-gradient(135deg, #6366f1 0%, #818cf8 100%) !important;
            color: white;
        }
        
        .bg-gradient-info {
            background: linear-gradient(135deg, #00b4d8 0%, #48cae4 100%) !important;
        }
        
        .bg-gradient-success {
            background: linear-gradient(135deg, #10b981 0%, #34d399 100%) !important;
        }
        
        .bg-gradient-warning {
            background: linear-gradient(135deg, #f59e0b 0%, #fbbf24 100%) !important;
        }
        
        .bg-gradient-danger {
            background: linear-gradient(135deg, #ef4444 0%, #f87171 100%) !important;
        }
        
        /* Small Box Custom */
        .small-box {
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }
        
        .small-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
        }
        
        .small-box .icon {
            opacity: 0.3;
            transition: opacity 0.3s;
        }
        
        .small-box:hover .icon {
            opacity: 0.5;
        }
        
        /* Card Custom */
        .card {
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            border: none;
        }
        
        .card-header {
            background: transparent;
            border-bottom: 1px solid #f1f5f9;
            font-weight: 600;
            padding: 15px 20px;
        }
        
        .card-outline-primary {
            border-top: 3px solid #6366f1;
        }
        
        .card-outline-success {
            border-top: 3px solid #10b981;
        }
        
        .card-outline-secondary {
            border-top: 3px solid #64748b;
        }
        
        /* Table Custom */
        .table th {
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            color: #64748b;
            border-top: none;
        }
        
        .table td {
            vertical-align: middle;
        }
        
        /* Badge Custom */
        .badge {
            padding: 5px 10px;
            font-weight: 500;
        }
        
        /* Button Custom */
        .btn-block {
            border-radius: 10px;
            font-weight: 500;
        }
        
        /* Info Box Custom */
        .info-box {
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }
        
        /* Breadcrumb */
        .breadcrumb {
            background: transparent;
            padding: 0;
            margin: 5px 0 0 0;
        }
        
        /* Opacity utilities */
        .opacity-75 {
            opacity: 0.75;
        }
        
        .opacity-50 {
            opacity: 0.5;
        }
    </style>
@stop

@section('js')
    <script>
        // Auto refresh bisa ditambahkan jika perlu
        console.log('Dashboard Admin QofMedia loaded');
    </script>
@stop