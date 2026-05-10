@extends('adminlte::page')

@section('title', 'Dashboard Apparel')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Dashboard Admin Apparel</h1>
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
                    <h3>{{ $stats['orders_today'] ?? 0 }}</h3>
                    <p>Order Hari Ini</p>
                </div>
                <div class="icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <a href="{{ route('apparel.orders.index') }}" class="small-box-footer">
                    Lihat Order <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        
        <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $stats['orders_waiting'] ?? 0 }}</h3>
                    <p>Menunggu Konfirmasi</p>
                </div>
                <div class="icon">
                    <i class="fas fa-clock"></i>
                </div>
                <a href="{{ route('apparel.orders.index', ['status' => 'menunggu']) }}" class="small-box-footer">
                    Proses <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        
        <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $stats['orders_approved'] ?? 0 }}</h3>
                    <p>Disetujui Hari Ini</p>
                </div>
                <div class="icon">
                    <i class="fas fa-check"></i>
                </div>
                <a href="{{ route('apparel.orders.index', ['status' => 'disetujui']) }}" class="small-box-footer">
                    Lihat <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        
        <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $stats['orders_rejected'] ?? 0 }}</h3>
                    <p>Ditolak Hari Ini</p>
                </div>
                <div class="icon">
                    <i class="fas fa-times"></i>
                </div>
                <a href="{{ route('apparel.orders.index', ['status' => 'ditolak']) }}" class="small-box-footer">
                    Lihat <i class="fas fa-arrow-circle-right"></i>
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
                            <a href="{{ route('apparel.categories.index') }}" class="btn btn-primary btn-block">
                                <i class="fas fa-tags"></i> Kelola Kategori
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('apparel.products.index') }}" class="btn btn-success btn-block">
                                <i class="fas fa-box"></i> Kelola Produk
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('apparel.orders.index') }}" class="btn btn-warning btn-block">
                                <i class="fas fa-shopping-cart"></i> Kelola Order
                            </a>
                        </div>
                        <div class="col-md-3 mb-3">
                            <a href="{{ route('service.apparel') }}" class="btn btn-info btn-block" target="_blank">
                                <i class="fas fa-eye"></i> Lihat Halaman Apparel
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Orders -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Order Terbaru</h3>
                    <div class="card-tools">
                        <a href="{{ route('apparel.orders.index') }}" class="btn btn-sm btn-primary">
                            Lihat Semua
                        </a>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Pemesan</th>
                                <th>Produk</th>
                                <th>Jumlah</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentOrders ?? [] as $order)
                                <tr>
                                    <td>#{{ $order->id }}</td>
                                    <td>{{ $order->pemesan_name }}</td>
                                    <td>{{ $order->product->name ?? 'N/A' }}</td>
                                    <td>{{ $order->qty }}</td>
                                    <td>
                                        @php
                                            $badgeClass = match($order->status) {
                                                'menunggu' => 'warning',
                                                'disetujui' => 'success',
                                                'ditolak' => 'danger',
                                                default => 'secondary'
                                            };
                                            $statusLabel = match($order->status) {
                                                'menunggu' => 'Menunggu',
                                                'disetujui' => 'Disetujui',
                                                'ditolak' => 'Ditolak',
                                                default => $order->status
                                            };
                                        @endphp
                                        <span class="badge badge-{{ $badgeClass }}">
                                            {{ $statusLabel }}
                                        </span>
                                    </td>
                                    <td>{{ $order->created_at->format('d M Y') }}</td>
                                    <td>
                                        <a href="{{ route('apparel.orders.show', $order) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4">
                                        <i class="fas fa-shopping-cart fa-2x text-muted mb-2"></i>
                                        <p class="text-muted mb-0">Belum ada order</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop