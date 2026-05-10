@extends('layouts.app')

@section('title', 'Dashboard User')

@section('content')
<section class="py-5 bg-qof-secondary text-white">
    <div class="container">
        <h1 class="display-4 mb-4">Dashboard</h1>
        <p class="lead">Selamat datang, {{ Auth::user()->name }}</p>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <!-- Stats Cards -->
        <div class="row mb-4">
            <div class="col-md-3 col-6 mb-3">
                <div class="card bg-primary text-white h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-bag-check fs-1"></i>
                        <h3 class="mt-2">{{ $orderStats['total'] ?? 0 }}</h3>
                        <p class="mb-0">Total Pesanan</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-3">
                <div class="card bg-warning text-white h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-clock-history fs-1"></i>
                        <h3 class="mt-2">{{ $orderStats['menunggu'] ?? 0 }}</h3>
                        <p class="mb-0">Menunggu</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-3">
                <div class="card bg-success text-white h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-check-circle fs-1"></i>
                        <h3 class="mt-2">{{ $orderStats['disetujui'] ?? 0 }}</h3>
                        <p class="mb-0">Disetujui</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6 mb-3">
                <div class="card bg-danger text-white h-100">
                    <div class="card-body text-center">
                        <i class="bi bi-x-circle fs-1"></i>
                        <h3 class="mt-2">{{ $orderStats['ditolak'] ?? 0 }}</h3>
                        <p class="mb-0">Ditolak</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Menu Cards -->
        <div class="row mb-4">
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-primary rounded-circle p-3 me-3">
                                <i class="bi bi-person text-white fs-4"></i>
                            </div>
                            <h5 class="card-title mb-0">Profil Saya</h5>
                        </div>
                        <p class="card-text text-muted">Kelola informasi profil dan password Anda</p>
                        <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary">
                            <i class="bi bi-pencil"></i> Edit Profil
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-success rounded-circle p-3 me-3">
                                <i class="bi bi-bag text-white fs-4"></i>
                            </div>
                            <h5 class="card-title mb-0">Pesanan Saya</h5>
                        </div>
                        <p class="card-text text-muted">Lihat riwayat dan status pesanan Anda</p>
                        <a href="{{ route('user.orders') }}" class="btn btn-outline-success">
                            <i class="bi bi-list"></i> Lihat Pesanan
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-info rounded-circle p-3 me-3">
                                <i class="bi bi-shop text-white fs-4"></i>
                            </div>
                            <h5 class="card-title mb-0">Belanja</h5>
                        </div>
                        <p class="card-text text-muted">Lihat produk apparel kami dan mulai berbelanja</p>
                        <a href="{{ route('service.apparel') }}" class="btn btn-outline-info">
                            <i class="bi bi-cart"></i> Belanja Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Orders -->
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Pesanan Terbaru</h5>
                    <a href="{{ route('user.orders') }}" class="btn btn-sm btn-outline-primary">
                        Lihat Semua <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="card-body p-0">
                @if(isset($orders) && $orders->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>No. Pesanan</th>
                                    <th>Produk</th>
                                    <th>Jumlah</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td>#{{ $order->id }}</td>
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
                                            <span class="badge bg-{{ $badgeClass }}">
                                                {{ $statusLabel }}
                                            </span>
                                        </td>
                                        <td>{{ $order->created_at->format('d M Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="bi bi-bag-x text-muted" style="font-size: 48px;"></i>
                        <p class="text-muted mt-2">Belum ada pesanan</p>
                        <a href="{{ route('service.apparel') }}" class="btn btn-sm btn-primary">
                            Mulai Belanja
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection