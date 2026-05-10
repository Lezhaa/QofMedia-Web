@extends('adminlte::page')

@section('title', 'Kelola Order')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Kelola Order</h1>
        <a href="{{ route('home') }}" class="btn btn-outline-secondary" target="_blank">
            <i class="fas fa-globe"></i> Lihat Website
        </a>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Filter Status</h3>
        </div>
        <div class="card-body">
            <div class="btn-group">
                <a href="{{ route('apparel.orders.index') }}" class="btn btn-outline-secondary {{ !request('status') ? 'active' : '' }}">
                    Semua
                </a>
                <a href="{{ route('apparel.orders.index', ['status' => 'menunggu']) }}" class="btn btn-outline-warning {{ request('status') == 'menunggu' ? 'active' : '' }}">
                    Menunggu
                </a>
                <a href="{{ route('apparel.orders.index', ['status' => 'disetujui']) }}" class="btn btn-outline-success {{ request('status') == 'disetujui' ? 'active' : '' }}">
                    Disetujui
                </a>
                <a href="{{ route('apparel.orders.index', ['status' => 'ditolak']) }}" class="btn btn-outline-danger {{ request('status') == 'ditolak' ? 'active' : '' }}">
                    Ditolak
                </a>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body table-responsive p-0">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Pemesan</th>
                        <th>No. HP</th>
                        <th>Produk</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders ?? [] as $order)
                        <tr>
                            <td>#{{ $order->id }}</td>
                            <td>{{ $order->pemesan_name }}</td>
                            <td>{{ $order->pemesan_phone }}</td>
                            <td>{{ $order->product->name ?? 'N/A' }}</td>
                            <td>{{ $order->qty }}</td>
                            <td>Rp {{ number_format($order->qty * ($order->variant->price ?? $order->product->price ?? 0), 0, ',', '.') }}</td>
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
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-4">
                                <i class="fas fa-shopping-cart fa-2x text-muted mb-2"></i>
                                <p class="text-muted mb-0">Belum ada order</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if(isset($orders) && $orders->hasPages())
            <div class="card-footer">
                {{ $orders->links() }}
            </div>
        @endif
    </div>
@stop