@extends('layouts.app')

@section('title', 'Detail Pesanan #' . $order->id)

@push('styles')
<style>
    body { padding-top: 0 !important; }

    .detail-hero {
        background: linear-gradient(135deg, #0D1B2A 0%, #1B3A4B 50%, #0E7A96 100%);
        padding: 80px 0 60px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    .detail-hero::before {
        content: '';
        position: absolute;
        top: -50%; right: -20%;
        width: 500px; height: 500px;
        background: radial-gradient(circle, rgba(78,184,204,0.15) 0%, transparent 70%);
        border-radius: 50%;
    }
    .detail-hero .container { position: relative; z-index: 1; }
    .detail-hero .badge {
        display: inline-block;
        background: rgba(255,255,255,0.1);
        color: #A8DDE8;
        padding: 6px 16px;
        border-radius: 50px;
        font-size: 0.8rem;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        border: 1px solid rgba(255,255,255,0.2);
        margin-bottom: 16px;
    }
    .detail-hero h1 { font-size: 2rem; font-weight: 800; color: #fff; }

    .detail-section { padding: 60px 0 80px; background: #F8FAFC; }

    .detail-card {
        background: white;
        border-radius: 20px;
        padding: 28px;
        border: 1px solid #E2E8F0;
        margin-bottom: 24px;
    }
    .detail-card h5 {
        font-weight: 700;
        color: #0D1B2A;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 1.05rem;
    }
    .detail-card h5 i { color: #0E7A96; }

    .info-row { display: flex; padding: 10px 0; border-bottom: 1px solid #F1F5F9; }
    .info-row:last-child { border-bottom: none; }
    .info-label { width: 160px; font-weight: 600; color: #0D1B2A; font-size: 0.9rem; flex-shrink: 0; }
    .info-value { flex: 1; color: #475569; font-size: 0.9rem; }

    .status-badge {
        display: inline-block;
        padding: 8px 18px;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 600;
    }
    .status-badge.menunggu { background: #FEF3C7; color: #92400E; }
    .status-badge.disetujui { background: #D1FAE5; color: #065F46; }
    .status-badge.ditolak { background: #FEE2E2; color: #991B1B; }

    .admin-note {
        background: #FFF7ED;
        border: 1px solid #FED7AA;
        border-radius: 12px;
        padding: 16px;
        margin-top: 16px;
    }
    .admin-note h6 { color: #C2410C; font-weight: 700; margin-bottom: 8px; }
    .admin-note p { color: #475569; font-size: 0.85rem; margin: 0; }

    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #0E7A96;
        font-weight: 600;
        text-decoration: none;
        font-size: 0.9rem;
    }
    .btn-back:hover { color: #0A4A60; }

    .btn-contact {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: white;
        color: #0E7A96;
        border: 1.5px solid #0E7A96;
        padding: 10px 24px;
        border-radius: 50px;
        font-weight: 600;
        text-decoration: none;
        width: 100%;
        justify-content: center;
        transition: all 0.3s;
    }
    .btn-contact:hover { background: #0E7A96; color: white; }
</style>
@endpush

@section('content')

<section class="detail-hero">
    <div class="container">
        <span class="badge">Pesanan</span>
        <h1>Detail Pesanan #{{ $order->id }}</h1>
    </div>
</section>

<section class="detail-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="detail-card">
                    <h5><i class="bi bi-info-circle"></i> Informasi Pesanan</h5>
                    <div class="info-row"><span class="info-label">Nama Pemesan</span><span class="info-value">: {{ $order->pemesan_name }}</span></div>
                    <div class="info-row"><span class="info-label">Nomor HP/WA</span><span class="info-value">: {{ $order->pemesan_phone }}</span></div>
                    <div class="info-row"><span class="info-label">Alamat</span><span class="info-value">: {{ $order->alamat }}</span></div>
                    <div class="info-row"><span class="info-label">Produk</span><span class="info-value">: {{ $order->product->name ?? '-' }}</span></div>
                    @if($order->variant)
                        <div class="info-row">
                            <span class="info-label">Varian</span>
                            <span class="info-value">: {{ $order->variant->size }} / {{ $order->variant->color }} / {{ $order->variant->sleeve_type }}</span>
                        </div>
                    @endif
                    <div class="info-row"><span class="info-label">Jumlah</span><span class="info-value">: {{ $order->qty }}</span></div>
                    <div class="info-row">
                        <span class="info-label">Total Harga</span>
                        <span class="info-value">
                            @php $price = $order->variant->price ?? $order->product->price ?? 0; @endphp
                            : <strong style="color:#0E7A96;">Rp {{ number_format($price * $order->qty, 0, ',', '.') }}</strong>
                        </span>
                    </div>
                    @if($order->catatan_user)
                        <div class="info-row"><span class="info-label">Catatan</span><span class="info-value">: {{ $order->catatan_user }}</span></div>
                    @endif
                    <div class="info-row"><span class="info-label">Tanggal Pesan</span><span class="info-value">: {{ $order->created_at->format('d M Y H:i') }}</span></div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="detail-card">
                    <h5><i class="bi bi-clock-history"></i> Status</h5>
                    <span class="status-badge {{ $order->status }}">
                        @if($order->status == 'menunggu') Menunggu Konfirmasi
                        @elseif($order->status == 'disetujui') Disetujui
                        @elseif($order->status == 'ditolak') Ditolak
                        @else {{ $order->status }}
                        @endif
                    </span>
                    <p class="mt-3 text-muted small">
                        Terakhir diperbarui: {{ $order->updated_at->format('d M Y H:i') }}
                    </p>
                    @if($order->catatan_admin)
                        <div class="admin-note">
                            <h6><i class="bi bi-chat-dots"></i> Catatan Admin</h6>
                            <p>{{ $order->catatan_admin }}</p>
                        </div>
                    @endif
                    <hr>
                    <a href="{{ route('user.orders') }}" class="btn-back">
                        <i class="bi bi-arrow-left"></i> Kembali ke Daftar Pesanan
                    </a>
                </div>

                <div class="detail-card">
                    <h5><i class="bi bi-headset"></i> Butuh Bantuan?</h5>
                    <p class="text-muted small mb-3">Hubungi kami jika ada pertanyaan.</p>
                    <a href="{{ route('contact') }}" class="btn-contact">
                        <i class="bi bi-whatsapp"></i> Hubungi Kami
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection