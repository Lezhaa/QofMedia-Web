@extends('adminlte::page')

@section('title', 'Detail Order')

@section('content_header')
    <div>
        <h1>Detail Order #{{ $order->id }}</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('apparel.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('apparel.orders.index') }}">Order</a></li>
            <li class="breadcrumb-item active">Detail</li>
        </ol>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Informasi Pesanan</h3>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th width="150">Nama Pemesan</th>
                            <td>{{ $order->pemesan_name }}</td>
                        </tr>
                        <tr>
                            <th>No. HP/WA</th>
                            <td>
                                {{ $order->pemesan_phone }}
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $order->pemesan_phone) }}" 
                                   class="btn btn-sm btn-success" target="_blank">
                                    <i class="fab fa-whatsapp"></i> Hubungi
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>{{ $order->alamat }}</td>
                        </tr>
                        <tr>
                            <th>Produk</th>
                            <td>{{ $order->product->name ?? 'N/A' }}</td>
                        </tr>
                        @if($order->variant)
                            <tr>
                                <th>Varian</th>
                                <td>
                                    Size: {{ $order->variant->size }} | 
                                    Warna: {{ $order->variant->color }} | 
                                    Lengan: {{ $order->variant->sleeve_type }}
                                </td>
                            </tr>
                        @endif
                        <tr>
                            <th>Jumlah</th>
                            <td>{{ $order->qty }}</td>
                        </tr>
                        <tr>
                            <th>Total Harga</th>
                            <td>
                                <strong>Rp {{ number_format($order->qty * ($order->variant->price ?? $order->product->price ?? 0), 0, ',', '.') }}</strong>
                            </td>
                        </tr>
                        @if($order->catatan_user)
                            <tr>
                                <th>Catatan Pemesan</th>
                                <td>{{ $order->catatan_user }}</td>
                            </tr>
                        @endif
                        <tr>
                            <th>Status</th>
                            <td>
                                @php
                                    $badgeClass = match($order->status) {
                                        'menunggu' => 'warning',
                                        'disetujui' => 'success',
                                        'ditolak' => 'danger',
                                        default => 'secondary'
                                    };
                                @endphp
                                <span class="badge badge-{{ $badgeClass }} text-lg px-3 py-2">
                                    {{ $order->status_label }}
                                </span>
                            </td>
                        </tr>
                        @if($order->catatan_admin)
                            <tr>
                                <th>Catatan Admin</th>
                                <td>{{ $order->catatan_admin }}</td>
                            </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            @if($order->status == 'menunggu')
                <div class="card">
                    <div class="card-header bg-warning">
                        <h3 class="card-title">Aksi</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('apparel.orders.approve', $order) }}" method="POST" class="mb-3">
                            @csrf
                            <div class="form-group">
                                <label>Catatan (Opsional)</label>
                                <textarea name="catatan_admin" class="form-control" rows="2"></textarea>
                            </div>
                            <button type="submit" class="btn btn-success btn-block">
                                <i class="fas fa-check"></i> Setujui Pesanan
                            </button>
                        </form>
                        
                        <form action="{{ route('apparel.orders.reject', $order) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Alasan Penolakan <span class="text-danger">*</span></label>
                                <textarea name="catatan_admin" class="form-control" rows="2" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-danger btn-block">
                                <i class="fas fa-times"></i> Tolak Pesanan
                            </button>
                        </form>
                    </div>
                </div>
            @endif
            
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Informasi User</h3>
                </div>
                <div class="card-body">
                    <p><strong>Nama:</strong> {{ $order->user->name ?? 'N/A' }}</p>
                    <p><strong>Email:</strong> {{ $order->user->email ?? 'N/A' }}</p>
                    <p><strong>Tanggal Order:</strong> {{ $order->created_at->format('d M Y H:i') }}</p>
                </div>
            </div>
        </div>
    </div>
@stop