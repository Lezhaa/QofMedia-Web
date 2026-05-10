@extends('layouts.app')

@section('title', 'Pesanan Saya')

@push('styles')
<style>
    body { padding-top: 0 !important; }

    .orders-hero {
        background: linear-gradient(135deg, #0D1B2A 0%, #1B3A4B 50%, #0E7A96 100%);
        padding: 80px 0 60px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    .orders-hero::before {
        content: '';
        position: absolute;
        top: -50%; right: -20%;
        width: 500px; height: 500px;
        background: radial-gradient(circle, rgba(78,184,204,0.15) 0%, transparent 70%);
        border-radius: 50%;
    }
    .orders-hero .container { position: relative; z-index: 1; }
    .orders-hero .badge {
        display: inline-block;
        background: rgba(255,255,255,0.1);
        color: #A8DDE8;
        padding: 6px 16px;
        border-radius: 50px;
        font-size: 0.8rem;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        margin-bottom: 16px;
        border: 1px solid rgba(255,255,255,0.2);
    }
    .orders-hero h1 { font-size: 2rem; font-weight: 800; color: #fff; margin-bottom: 8px; }
    .orders-hero p { color: rgba(255,255,255,0.7); }

    .orders-section { padding: 60px 0 80px; background: #F8FAFC; }

    .table-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 4px 16px rgba(0,0,0,0.04);
        border: 1px solid #E2E8F0;
    }
    .orders-table { width: 100%; border-collapse: collapse; }
    .orders-table thead th {
        background: #F8FAFC;
        padding: 14px 16px;
        font-size: 0.8rem;
        font-weight: 700;
        color: #64748B;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        border-bottom: 1px solid #E2E8F0;
    }
    .orders-table tbody td {
        padding: 14px 16px;
        font-size: 0.9rem;
        color: #475569;
        border-bottom: 1px solid #F1F5F9;
    }
    .orders-table tbody tr:hover { background: #F8FAFC; }

    .status-badge {
        display: inline-block;
        padding: 5px 14px;
        border-radius: 50px;
        font-size: 0.78rem;
        font-weight: 600;
    }
    .status-badge.menunggu { background: #FEF3C7; color: #92400E; }
    .status-badge.disetujui { background: #D1FAE5; color: #065F46; }
    .status-badge.ditolak { background: #FEE2E2; color: #991B1B; }

    .btn-detail {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: white;
        color: #0E7A96;
        border: 1.5px solid #0E7A96;
        padding: 7px 16px;
        border-radius: 50px;
        font-size: 0.82rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s;
    }
    .btn-detail:hover { background: #0E7A96; color: white; }

    .empty-state { text-align: center; padding: 60px 20px; }
    .empty-state i { font-size: 64px; color: #0E7A96; opacity: 0.3; }
    .empty-state h3 { font-weight: 700; color: #0D1B2A; margin-top: 16px; }
    .empty-state p { color: #64748B; }

    .btn-primary-custom {
        background: linear-gradient(135deg, #0E7A96, #4EB8CC);
        color: white;
        border: none;
        padding: 12px 28px;
        border-radius: 50px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s;
    }
    .btn-primary-custom:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(14,122,150,0.3); color: white; }

    @media (max-width: 768px) {
        .orders-hero { padding: 60px 0 40px; }
        .orders-table thead { display: none; }
        .orders-table tbody tr { display: block; margin-bottom: 16px; border: 1px solid #E2E8F0; border-radius: 12px; padding: 12px; }
        .orders-table tbody td { display: flex; justify-content: space-between; padding: 8px 0; border: none; }
        .orders-table tbody td::before { content: attr(data-label); font-weight: 600; color: #0D1B2A; }
    }
</style>
@endpush

@section('content')

<section class="orders-hero">
    <div class="container">
        <span class="badge">Akun Saya</span>
        <h1>Pesanan Saya</h1>
        <p>Pantau status pesanan Anda di sini</p>
    </div>
</section>

<section class="orders-section">
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success border-0 rounded-3 mb-4">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            </div>
        @endif

        @if($orders->count() > 0)
            <div class="table-card">
                <div class="table-responsive">
                    <table class="orders-table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Produk</th>
                                <th>Varian</th>
                                <th>Jumlah</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td data-label="No."><strong>#{{ $order->id }}</strong></td>
                                    <td data-label="Produk">{{ $order->product->name ?? '-' }}</td>
                                    <td data-label="Varian">
                                        @if($order->variant)
                                            {{ $order->variant->size }}/{{ $order->variant->color }}/{{ $order->variant->sleeve_type }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td data-label="Jumlah">{{ $order->qty }}</td>
                                    <td data-label="Total">
                                        @php $price = $order->variant->price ?? $order->product->price ?? 0; @endphp
                                        Rp {{ number_format($price * $order->qty, 0, ',', '.') }}
                                    </td>
                                    <td data-label="Status">
                                        <span class="status-badge {{ $order->status }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td data-label="Tanggal">{{ $order->created_at->format('d M Y') }}</td>
                                    <td data-label="Aksi">
                                        <a href="{{ route('user.orders.show', $order) }}" class="btn-detail">
                                            <i class="bi bi-eye"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if($orders->hasPages())
                    <div class="p-3">{{ $orders->links() }}</div>
                @endif
            </div>
        @else
            <div class="table-card">
                <div class="empty-state">
                    <i class="bi bi-bag-x"></i>
                    <h3>Belum Ada Pesanan</h3>
                    <p>Yuk, mulai belanja sekarang!</p>
                    <a href="{{ route('service.apparel') }}" class="btn-primary-custom mt-3">
                        <i class="bi bi-shop"></i> Lihat Produk
                    </a>
                </div>
            </div>
        @endif
    </div>
</section>

@endsection