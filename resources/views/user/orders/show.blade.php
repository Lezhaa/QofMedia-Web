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

    /* ============================================
       TIMELINE STYLES
       ============================================ */
    .timeline-section {
        margin-bottom: 30px;
    }
    .timeline {
        position: relative;
        padding-left: 30px;
        margin: 20px 0;
    }
    .timeline::before {
        content: '';
        position: absolute;
        left: 8px;
        top: 0;
        bottom: 0;
        width: 2px;
        background: #E2E8F0;
    }
    .timeline-item {
        position: relative;
        padding-bottom: 28px;
    }
    .timeline-item:last-child {
        padding-bottom: 0;
    }
    .timeline-dot {
        position: absolute;
        left: -30px;
        top: 0;
        width: 18px;
        height: 18px;
        border-radius: 50%;
        background: #CBD5E1;
        border: 3px solid white;
        box-shadow: 0 0 0 2px #CBD5E1;
        transition: all 0.3s;
    }
    .timeline-dot.completed {
        background: #059669;
        box-shadow: 0 0 0 2px #059669;
    }
    .timeline-dot.active {
        background: #0E7A96;
        box-shadow: 0 0 0 2px #0E7A96;
        animation: pulse 1.5s infinite;
    }
    .timeline-dot.rejected {
        background: #DC2626;
        box-shadow: 0 0 0 2px #DC2626;
    }
    .timeline-content {
        background: white;
        border-radius: 12px;
        padding: 12px 16px;
        border: 1px solid #F1F5F9;
        transition: all 0.3s;
    }
    .timeline-content:hover {
        border-color: #E2E8F0;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    .timeline-title {
        font-weight: 700;
        color: #0D1B2A;
        font-size: 0.9rem;
        margin-bottom: 4px;
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }
    .timeline-title i {
        color: #0E7A96;
        font-size: 0.85rem;
    }
    .timeline-date {
        font-size: 0.7rem;
        color: #94A3B8;
        margin-top: 4px;
        display: flex;
        align-items: center;
        gap: 5px;
    }
    .timeline-date i {
        font-size: 0.65rem;
    }
    .timeline-desc {
        font-size: 0.8rem;
        color: #64748B;
        margin-top: 6px;
        padding-top: 6px;
        border-top: 1px dashed #F1F5F9;
    }
    .timeline-desc.reason {
        color: #DC2626;
        background: #FEE2E2;
        padding: 6px 10px;
        border-radius: 8px;
        margin-top: 8px;
    }

    @keyframes pulse {
        0%, 100% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.7; transform: scale(1.1); }
    }

    /* Badge bukti */
    .proof-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 3px 10px;
        border-radius: 50px;
        font-size: 0.7rem;
        font-weight: 600;
    }
    .proof-badge.valid { background: #D1FAE5; color: #065F46; }
    .proof-badge.invalid { background: #FEE2E2; color: #991B1B; }
    .proof-badge.pending { background: #FEF3C7; color: #92400E; }
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
                {{-- TIMELINE STATUS --}}
                <div class="detail-card timeline-section">
                    <h5><i class="bi bi-diagram-3"></i> Timeline Pesanan</h5>
                    
                    @php
                        // Tentukan status timeline
                        $timeline = [];
                        
                        // 1. Order Dibuat
                        $timeline[] = [
                            'title' => 'Pesanan Dibuat',
                            'icon' => 'bi bi-cart-plus',
                            'date' => $order->created_at,
                            'completed' => true,
                            'description' => 'Pesanan berhasil dibuat dan menunggu konfirmasi pembayaran.'
                        ];
                        
                        // 2. Upload Bukti Transfer (jika ada)
                        if ($order->payment_proof) {
                            $timeline[] = [
                                'title' => 'Bukti Transfer Diunggah',
                                'icon' => 'bi bi-file-image',
                                'date' => $order->updated_at, // waktu upload bukti
                                'completed' => true,
                                'description' => 'Bukti pembayaran telah diunggah oleh pemesan.'
                            ];
                        } else {
                            $timeline[] = [
                                'title' => 'Menunggu Upload Bukti Transfer',
                                'icon' => 'bi bi-clock-history',
                                'date' => null,
                                'completed' => false,
                                'active' => $order->status == 'menunggu' && !$order->payment_proof,
                                'description' => 'Silakan unggah bukti transfer untuk memproses pesanan.'
                            ];
                        }
                        
                        // 3. Validasi Bukti Transfer (jika sudah divalidasi)
                        $proofValidated = $order->payment_proof_validated ?? 'pending';
                        if ($order->payment_proof && $proofValidated != 'pending') {
                            $isValid = $proofValidated == 'valid';
                            $timeline[] = [
                                'title' => $isValid ? '✅ Bukti Transfer Valid' : '❌ Bukti Transfer Tidak Valid',
                                'icon' => $isValid ? 'bi bi-check-circle-fill' : 'bi bi-x-circle-fill',
                                'date' => $order->updated_at,
                                'completed' => true,
                                'isValid' => $isValid,
                                'description' => $isValid 
                                    ? 'Bukti pembayaran telah diverifikasi dan dinyatakan valid.' 
                                    : 'Bukti pembayaran dinyatakan tidak valid. Silakan hubungi admin.',
                            ];
                        } elseif ($order->payment_proof && $proofValidated == 'pending' && $order->status == 'menunggu') {
                            $timeline[] = [
                                'title' => 'Menunggu Validasi Bukti Transfer',
                                'icon' => 'bi bi-hourglass-split',
                                'date' => null,
                                'completed' => false,
                                'active' => true,
                                'description' => 'Admin sedang memverifikasi bukti transfer Anda.'
                            ];
                        }
                        
                        // 4. Status Order Final
                        if ($order->status == 'disetujui') {
                            $timeline[] = [
                                'title' => '✅ Pesanan Disetujui',
                                'icon' => 'bi bi-check2-circle',
                                'date' => $order->updated_at,
                                'completed' => true,
                                'description' => 'Pesanan Anda telah disetujui dan akan segera diproses untuk packing.'
                            ];
                            
                            // 5. Proses Packing (estimasi)
                            $timeline[] = [
                                'title' => '📦 Proses Packing',
                                'icon' => 'bi bi-box-seam',
                                'date' => null,
                                'completed' => false,
                                'upcoming' => true,
                                'description' => 'Pesanan sedang disiapkan untuk pengiriman.'
                            ];
                        } elseif ($order->status == 'ditolak') {
                            $timeline[] = [
                                'title' => '❌ Pesanan Ditolak',
                                'icon' => 'bi bi-x-circle',
                                'date' => $order->updated_at,
                                'completed' => true,
                                'isRejected' => true,
                                'description' => 'Pesanan ditolak. ' . ($order->catatan_admin ? 'Alasan: ' . $order->catatan_admin : 'Silakan hubungi admin untuk informasi lebih lanjut.')
                            ];
                        } else {
                            // Status masih menunggu setelah upload bukti
                            if ($order->payment_proof && $proofValidated == 'pending') {
                                $timeline[] = [
                                    'title' => 'Menunggu Konfirmasi Admin',
                                    'icon' => 'bi bi-clock',
                                    'date' => null,
                                    'completed' => false,
                                    'active' => true,
                                    'description' => 'Admin akan segera mengkonfirmasi pesanan Anda setelah bukti transfer divalidasi.'
                                ];
                            } elseif (!$order->payment_proof) {
                                $timeline[] = [
                                    'title' => 'Menunggu Pembayaran',
                                    'icon' => 'bi bi-credit-card',
                                    'date' => null,
                                    'completed' => false,
                                    'active' => true,
                                    'description' => 'Lakukan pembayaran dan unggah bukti transfer untuk memproses pesanan.'
                                ];
                            }
                        }
                    @endphp

                    <div class="timeline">
                        @foreach($timeline as $index => $item)
                            <div class="timeline-item">
                                <div class="timeline-dot 
                                    @if(isset($item['completed']) && $item['completed']) completed
                                    @elseif(isset($item['active']) && $item['active']) active
                                    @elseif(isset($item['isRejected']) && $item['isRejected']) rejected
                                    @endif">
                                </div>
                                <div class="timeline-content">
                                    <div class="timeline-title">
                                        <i class="{{ $item['icon'] }}"></i>
                                        {{ $item['title'] }}
                                        @if(isset($item['isValid']) && $item['isValid'] === false)
                                            <span class="proof-badge invalid">Tidak Valid</span>
                                        @endif
                                    </div>
                                    @if(isset($item['date']) && $item['date'])
                                        <div class="timeline-date">
                                            <i class="bi bi-calendar3"></i>
                                            {{ $item['date']->format('d M Y, H:i') }} WIB
                                        </div>
                                    @endif
                                    @if(isset($item['description']))
                                        <div class="timeline-desc {{ isset($item['isRejected']) && $item['isRejected'] ? 'reason' : '' }}">
                                            {{ $item['description'] }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Informasi Pesanan --}}
                <div class="detail-card">
                    <h5><i class="bi bi-info-circle"></i> Informasi Pesanan</h5>
                    <div class="info-row"><span class="info-label">Nama Pemesan</span><span class="info-value">: {{ $order->pemesan_name }}</span></div>
                    <div class="info-row"><span class="info-label">Nomor HP/WA</span><span class="info-value">: {{ $order->pemesan_phone }}</span></div>
                    <div class="info-row"><span class="info-label">Alamat</span><span class="info-value">: {{ $order->alamat }}</span></div>
                    <div class="info-row"><span class="info-label">Produk</span><span class="info-value">: {{ $order->product->name ?? '-' }}</span></div>
                    <div class="info-row">
                        <span class="info-label">Metode Pembayaran</span>
                        <span class="info-value">: {{ $order->payment_method == 'manual_transfer' ? 'Transfer Manual' : 'Payment Gateway' }}</span>
                    </div>

                    @if($order->payment_method == 'manual_transfer')
                        <div class="info-row">
                            <span class="info-label">Bukti Transfer</span>
                            <span class="info-value">: 
                                @if($order->payment_proof)
                                    <a href="{{ asset('storage/' . $order->payment_proof) }}" target="_blank" class="btn btn-sm btn-info">
                                        <i class="bi bi-image"></i> Lihat Bukti
                                    </a>
                                    @php $proofStatus = $order->payment_proof_validated ?? 'pending'; @endphp
                                    <span class="proof-badge {{ $proofStatus }} ms-2">
                                        @if($proofStatus == 'valid') <i class="bi bi-check-circle"></i> Valid
                                        @elseif($proofStatus == 'invalid') <i class="bi bi-x-circle"></i> Tidak Valid
                                        @else <i class="bi bi-clock"></i> Pending
                                        @endif
                                    </span>
                                @else
                                    <span class="text-danger">Belum diunggah</span>
                                @endif
                            </span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Pesan Konfirmasi</span>
                            <span class="info-value">: {{ $order->payment_message ?? '-' }}</span>
                        </div>
                    @endif
                    
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