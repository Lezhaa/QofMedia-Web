@extends('adminlte::page')

@section('title', 'Detail Order #' . $order->id)

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="mb-0" style="font-size: 1.4rem; font-weight: 700; color: #0D1B2A;">
                <i class="fas fa-receipt me-2" style="color: #0E7A96;"></i> Detail Order
                <span style="color:#0E7A96;">#{{ $order->id }}</span>
            </h1>
            <ol class="breadcrumb mb-0 mt-1" style="font-size: 0.8rem; background: transparent; padding: 0;">
                <li class="breadcrumb-item"><a href="{{ route('apparel.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('apparel.orders.index') }}">Order</a></li>
                <li class="breadcrumb-item active">Detail #{{ $order->id }}</li>
            </ol>
        </div>
        <a href="{{ route('apparel.orders.index') }}"
           style="display:inline-flex; align-items:center; gap:6px; background:#fff; border:1.5px solid #E2E8F0; color:#0E7A96; padding:9px 20px; border-radius:50px; font-weight:700; font-size:0.85rem; text-decoration:none; transition:all 0.3s;">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
@stop

@push('css')
<style>
    /* ============================================
       SECTION LABEL
       ============================================ */
    .sec-label {
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: #94A3B8;
        margin-bottom: 14px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .sec-label::after {
        content: '';
        flex: 1;
        height: 1px;
        background: #E2E8F0;
    }

    /* ============================================
       ORDER BANNER
       ============================================ */
    .order-banner {
        background: linear-gradient(135deg, #0D1B2A 0%, #1B3A4B 55%, #0E7A96 100%);
        border-radius: 20px;
        padding: 28px 32px;
        position: relative;
        overflow: hidden;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
    }
    .order-banner::before {
        content: '';
        position: absolute;
        top: -40%; right: -10%;
        width: 350px; height: 350px;
        background: radial-gradient(circle, rgba(78,184,204,0.18) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }
    .order-banner::after {
        content: '';
        position: absolute;
        bottom: -50%; left: -5%;
        width: 250px; height: 250px;
        background: radial-gradient(circle, rgba(168,221,232,0.1) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }
    .order-banner .ob-content { position: relative; z-index: 1; }
    .order-banner h4 {
        color: #fff;
        font-weight: 800;
        font-size: 1.2rem;
        margin-bottom: 4px;
    }
    .order-banner p {
        color: rgba(255,255,255,0.65);
        font-size: 0.85rem;
        margin: 0;
    }
    .order-banner .ob-meta {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-top: 12px;
        flex-wrap: wrap;
    }
    .ob-chip {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(255,255,255,0.1);
        border: 1px solid rgba(255,255,255,0.15);
        color: #A8DDE8;
        padding: 4px 14px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
        backdrop-filter: blur(8px);
    }
    .ob-chip.ob-chip-status {
        font-size: 0.78rem;
        font-weight: 700;
        color: #fff;
    }
    .ob-chip.ob-chip-status.menunggu  { background: rgba(217,119,6,0.35);  border-color: rgba(251,191,36,0.4); }
    .ob-chip.ob-chip-status.disetujui { background: rgba(5,150,105,0.35);  border-color: rgba(52,211,153,0.4); }
    .ob-chip.ob-chip-status.ditolak   { background: rgba(220,38,38,0.35);  border-color: rgba(248,113,113,0.4); }
    .ob-total {
        position: relative;
        z-index: 1;
        text-align: right;
        flex-shrink: 0;
    }
    .ob-total .ob-total-label {
        font-size: 0.75rem;
        color: rgba(255,255,255,0.55);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.07em;
        margin-bottom: 4px;
    }
    .ob-total .ob-total-amount {
        font-size: 1.8rem;
        font-weight: 800;
        color: #fff;
        line-height: 1;
    }
    .ob-total .ob-total-sub {
        font-size: 0.75rem;
        color: rgba(255,255,255,0.45);
        margin-top: 4px;
    }

    /* ============================================
       DASH CARD (matches dashboard style)
       ============================================ */
    .dash-card {
        background: #fff;
        border: 1px solid #E2E8F0;
        border-radius: 18px;
        overflow: hidden;
        margin-bottom: 0;
    }
    .dash-card-header {
        padding: 18px 22px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 1px solid #F1F5F9;
    }
    .dash-card-title {
        font-size: 0.92rem;
        font-weight: 700;
        color: #0D1B2A;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .dash-card-title i { color: #0E7A96; }

    /* ============================================
       INFO TABLE (order details)
       ============================================ */
    .info-table { width: 100%; border-collapse: collapse; }
    .info-table tr { border-bottom: 1px solid #F8FAFC; }
    .info-table tr:last-child { border-bottom: none; }
    .info-table tr:hover { background: #F8FAFC; }
    .info-table th {
        width: 160px;
        padding: 13px 22px;
        font-size: 0.78rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #94A3B8;
        vertical-align: top;
        white-space: nowrap;
    }
    .info-table td {
        padding: 13px 22px;
        font-size: 0.88rem;
        color: #0D1B2A;
        font-weight: 500;
        vertical-align: middle;
    }
    .info-table .td-icon {
        width: 32px; height: 32px;
        border-radius: 9px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 0.85rem;
        margin-right: 8px;
        flex-shrink: 0;
        vertical-align: middle;
    }

    /* ============================================
       STATUS BADGE
       ============================================ */
    .status-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 16px;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 700;
    }
    .status-pill.menunggu  { background: #FEF3C7; color: #92400E; }
    .status-pill.disetujui { background: #D1FAE5; color: #065F46; }
    .status-pill.ditolak   { background: #FEE2E2; color: #991B1B; }
    .status-pill .dot {
        width: 7px; height: 7px;
        border-radius: 50%;
        animation: blink 2s infinite;
    }
    .status-pill.menunggu  .dot { background: #D97706; }
    .status-pill.disetujui .dot { background: #059669; }
    .status-pill.ditolak   .dot { background: #DC2626; animation: none; }

    /* ============================================
       WHATSAPP BUTTON
       ============================================ */
    .btn-wa {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #25D366;
        color: #fff;
        padding: 5px 14px;
        border-radius: 50px;
        font-size: 0.78rem;
        font-weight: 700;
        text-decoration: none;
        margin-left: 10px;
        transition: all 0.2s;
        vertical-align: middle;
    }
    .btn-wa:hover { background: #1ebe5d; color: #fff; text-decoration: none; transform: scale(1.04); }

    /* ============================================
       VARIANT CHIPS
       ============================================ */
    .variant-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }
    .variant-chip {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: rgba(14,122,150,0.07);
        border: 1px solid rgba(14,122,150,0.15);
        color: #0E7A96;
        padding: 4px 12px;
        border-radius: 8px;
        font-size: 0.78rem;
        font-weight: 700;
    }
    .variant-chip span.vc-label {
        color: #94A3B8;
        font-weight: 600;
        margin-right: 2px;
    }

    /* ============================================
       ACTION CARD
       ============================================ */
    .action-form-group {
        margin-bottom: 16px;
    }
    .action-form-group label {
        font-size: 0.78rem;
        font-weight: 700;
        color: #64748B;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 6px;
        display: block;
    }
    .action-form-group .form-control {
        border: 1.5px solid #E2E8F0;
        border-radius: 12px;
        font-size: 0.85rem;
        color: #0D1B2A;
        padding: 10px 14px;
        transition: border-color 0.2s;
        resize: none;
    }
    .action-form-group .form-control:focus {
        border-color: #0E7A96;
        box-shadow: 0 0 0 3px rgba(14,122,150,0.1);
        outline: none;
    }
    .btn-approve {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        padding: 12px 20px;
        background: linear-gradient(135deg, #059669, #34D399);
        color: #fff;
        border: none;
        border-radius: 12px;
        font-size: 0.88rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.25s;
        text-decoration: none;
        margin-bottom: 10px;
    }
    .btn-approve:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(5,150,105,0.3);
        color: #fff;
        text-decoration: none;
    }
    .btn-reject {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        padding: 12px 20px;
        background: linear-gradient(135deg, #DC2626, #F87171);
        color: #fff;
        border: none;
        border-radius: 12px;
        font-size: 0.88rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.25s;
    }
    .btn-reject:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(220,38,38,0.3);
        color: #fff;
    }

    /* ============================================
       USER INFO CARD
       ============================================ */
    .user-avatar {
        width: 52px; height: 52px;
        border-radius: 14px;
        background: linear-gradient(135deg, #0E7A96, #4EB8CC);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 1.3rem;
        font-weight: 800;
        flex-shrink: 0;
    }
    .user-info-item {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        padding: 10px 0;
        border-bottom: 1px solid #F8FAFC;
    }
    .user-info-item:last-child { border-bottom: none; padding-bottom: 0; }
    .user-info-item .uii-icon {
        width: 32px; height: 32px;
        border-radius: 9px;
        display: flex; align-items: center; justify-content: center;
        font-size: 0.78rem;
        flex-shrink: 0;
        margin-top: 2px;
    }
    .user-info-item .uii-label {
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #94A3B8;
        margin-bottom: 2px;
    }
    .user-info-item .uii-value {
        font-size: 0.85rem;
        font-weight: 600;
        color: #0D1B2A;
    }

    /* ============================================
       CATATAN CALLOUT
       ============================================ */
    .note-callout {
        background: #FEF9EC;
        border: 1px solid #FDE68A;
        border-left: 4px solid #F59E0B;
        border-radius: 12px;
        padding: 12px 16px;
        font-size: 0.85rem;
        color: #78350F;
        line-height: 1.6;
    }
    .note-callout.note-admin {
        background: #EEF9FC;
        border-color: #BAE6F5;
        border-left-color: #0E7A96;
        color: #0A4A62;
    }
    .note-callout .note-label {
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.07em;
        margin-bottom: 4px;
        opacity: 0.7;
    }

    /* ============================================
       TIMELINE
       ============================================ */
    .order-timeline {
        padding: 18px 22px;
    }
    .tl-item {
        display: flex;
        gap: 14px;
        position: relative;
        padding-bottom: 20px;
    }
    .tl-item:last-child { padding-bottom: 0; }
    .tl-item:last-child .tl-line { display: none; }
    .tl-dot-wrap {
        display: flex;
        flex-direction: column;
        align-items: center;
        flex-shrink: 0;
    }
    .tl-dot {
        width: 32px; height: 32px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.78rem;
        font-weight: 700;
        flex-shrink: 0;
    }
    .tl-line {
        flex: 1;
        width: 2px;
        background: #F1F5F9;
        margin-top: 6px;
        min-height: 18px;
    }
    .tl-body { flex: 1; padding-top: 4px; }
    .tl-title {
        font-size: 0.85rem;
        font-weight: 700;
        color: #0D1B2A;
        margin-bottom: 2px;
    }
    .tl-time {
        font-size: 0.75rem;
        color: #94A3B8;
        font-weight: 500;
    }

    /* ============================================
       ANIMATIONS
       ============================================ */
    @keyframes blink {
        0%, 100% { opacity: 1; }
        50%       { opacity: 0.3; }
    }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(16px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .anim-1 { animation: fadeInUp 0.4s ease both; }
    .anim-2 { animation: fadeInUp 0.4s 0.08s ease both; }
    .anim-3 { animation: fadeInUp 0.4s 0.16s ease both; }
    .anim-4 { animation: fadeInUp 0.4s 0.24s ease both; }

    /* ============================================
       RESPONSIVE
       ============================================ */
    @media (max-width: 768px) {
        .ob-total { display: none; }
        .info-table th { width: 110px; }
    }
</style>
@endpush

@section('content')

    @if(session('success'))
        <div class="alert alert-dismissible fade show"
             style="border-radius: 12px; font-size: 0.88rem; border: none; background: #D1FAE5; color: #065F46; margin-bottom: 20px;">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-dismissible fade show"
             style="border-radius: 12px; font-size: 0.88rem; border: none; background: #FEE2E2; color: #991B1B; margin-bottom: 20px;">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

    {{-- ── ORDER BANNER ── --}}
    <div class="order-banner anim-1">
        <div class="ob-content">
            <h4><i class="fas fa-box-open me-2" style="opacity:0.8;"></i> Order #{{ $order->id }}</h4>
            <p>{{ $order->pemesan_name }} &bull; {{ $order->product->name ?? 'N/A' }}</p>
            <div class="ob-meta">
                <span class="ob-chip">
                    <i class="fas fa-calendar-alt"></i>
                    {{ $order->created_at->format('d M Y, H:i') }} WIB
                </span>
                @php
                    $statusClass = match($order->status) {
                        'menunggu'  => 'menunggu',
                        'disetujui' => 'disetujui',
                        'ditolak'   => 'ditolak',
                        default     => 'menunggu'
                    };
                    $statusIcon = match($order->status) {
                        'menunggu'  => 'fa-clock',
                        'disetujui' => 'fa-check-circle',
                        'ditolak'   => 'fa-times-circle',
                        default     => 'fa-clock'
                    };
                @endphp
                <span class="ob-chip ob-chip-status {{ $statusClass }}">
                    <i class="fas {{ $statusIcon }}"></i>
                    {{ $order->status_label }}
                </span>
                <span class="ob-chip">
                    <i class="fas fa-box"></i>
                    {{ $order->qty }} pcs
                </span>
            </div>
        </div>
        <div class="ob-total">
            <div class="ob-total-label">Total Harga</div>
            <div class="ob-total-amount">
                Rp {{ number_format($order->qty * ($order->variant->price ?? $order->product->price ?? 0), 0, ',', '.') }}
            </div>
            <div class="ob-total-sub">{{ $order->qty }} pcs &times; Rp {{ number_format($order->variant->price ?? $order->product->price ?? 0, 0, ',', '.') }}</div>
        </div>
    </div>

    <div class="row g-3">

        {{-- ── LEFT COLUMN ── --}}
        <div class="col-lg-8">

            {{-- Informasi Pesanan --}}
            <p class="sec-label anim-2">Informasi Pesanan</p>
            <div class="dash-card anim-2" style="margin-bottom: 20px;">
                <div class="dash-card-header">
                    <div class="dash-card-title">
                        <i class="fas fa-clipboard-list"></i> Rincian Pesanan
                    </div>
                    <span style="font-size:0.75rem; color:#94A3B8; font-weight:600;">
                        <i class="fas fa-hashtag me-1"></i>{{ $order->id }}
                    </span>
                </div>
                <table class="info-table">
                    <tr>
                        <th>
                            <span class="td-icon" style="background:#EEF9FC; color:#0E7A96; display:inline-flex;">
                                <i class="fas fa-user"></i>
                            </span>
                            Pemesan
                        </th>
                        <td>
                            <strong style="font-size:0.95rem;">{{ $order->pemesan_name }}</strong>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <span class="td-icon" style="background:#D1FAE5; color:#059669; display:inline-flex;">
                                <i class="fas fa-phone"></i>
                            </span>
                            No. HP / WA
                        </th>
                        <td>
                            {{ $order->pemesan_phone }}
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $order->pemesan_phone) }}"
                               class="btn-wa" target="_blank">
                                <i class="fab fa-whatsapp"></i> Hubungi
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <span class="td-icon" style="background:#FEF3C7; color:#D97706; display:inline-flex;">
                                <i class="fas fa-map-marker-alt"></i>
                            </span>
                            Alamat
                        </th>
                        <td style="line-height: 1.6;">{{ $order->alamat }}</td>
                    </tr>
                    <tr>
                        <th>
                            <span class="td-icon" style="background:#EEF9FC; color:#0E7A96; display:inline-flex;">
                                <i class="fas fa-tshirt"></i>
                            </span>
                            Produk
                        </th>
                        <td>
                            <strong>{{ $order->product->name ?? 'N/A' }}</strong>
                        </td>
                    </tr>

                    @if($order->variant)
                    <tr>
                        <th>
                            <span class="td-icon" style="background:#FEE2E2; color:#DC2626; display:inline-flex;">
                                <i class="fas fa-palette"></i>
                            </span>
                            Varian
                        </th>
                        <td>
                            <div class="variant-grid">
                                <span class="variant-chip">
                                    <span class="vc-label">Size</span>
                                    {{ $order->variant->size }}
                                </span>
                                <span class="variant-chip">
                                    <span class="vc-label">Warna</span>
                                    {{ $order->variant->color }}
                                </span>
                                <span class="variant-chip">
                                    <span class="vc-label">Lengan</span>
                                    {{ $order->variant->sleeve_type }}
                                </span>
                            </div>
                        </td>
                    </tr>
                    @endif

                    <tr>
                        <th>
                            <span class="td-icon" style="background:#FEF3C7; color:#D97706; display:inline-flex;">
                                <i class="fas fa-boxes"></i>
                            </span>
                            Jumlah
                        </th>
                        <td>
                            <span style="font-size:1.1rem; font-weight:800; color:#0D1B2A;">{{ $order->qty }}</span>
                            <span style="font-size:0.8rem; color:#94A3B8; font-weight:600;"> pcs</span>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <span class="td-icon" style="background:#D1FAE5; color:#059669; display:inline-flex;">
                                <i class="fas fa-tag"></i>
                            </span>
                            Total Harga
                        </th>
                        <td>
                            <span style="font-size:1.25rem; font-weight:800; color:#059669;">
                                Rp {{ number_format($order->qty * ($order->variant->price ?? $order->product->price ?? 0), 0, ',', '.') }}
                            </span>
                            <span style="display:block; font-size:0.75rem; color:#94A3B8; margin-top:2px;">
                                {{ $order->qty }} pcs &times;
                                Rp {{ number_format($order->variant->price ?? $order->product->price ?? 0, 0, ',', '.') }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <span class="td-icon" style="background:#EEF9FC; color:#0E7A96; display:inline-flex;">
                                <i class="fas fa-info-circle"></i>
                            </span>
                            Status
                        </th>
                        <td>
                            <span class="status-pill {{ $statusClass }}">
                                <span class="dot"></span>
                                {{ $order->status_label }}
                            </span>
                        </td>
                    </tr>
                </table>

                {{-- Catatan Pemesan --}}
                @if($order->catatan_user)
                <div style="padding: 16px 22px; border-top: 1px solid #F1F5F9;">
                    <div class="note-callout">
                        <div class="note-label"><i class="fas fa-comment-alt me-1"></i> Catatan Pemesan</div>
                        {{ $order->catatan_user }}
                    </div>
                </div>
                @endif

                {{-- Catatan Admin --}}
                @if($order->catatan_admin)
                <div style="padding: 0 22px 16px;">
                    <div class="note-callout note-admin">
                        <div class="note-label"><i class="fas fa-user-shield me-1"></i> Catatan Admin</div>
                        {{ $order->catatan_admin }}
                    </div>
                </div>
                @endif
            </div>

            {{-- Timeline --}}
            <p class="sec-label anim-3">Riwayat Status</p>
            <div class="dash-card anim-3">
                <div class="dash-card-header">
                    <div class="dash-card-title">
                        <i class="fas fa-history"></i> Timeline Order
                    </div>
                </div>
                <div class="order-timeline">
                    {{-- Order Dibuat --}}
                    <div class="tl-item">
                        <div class="tl-dot-wrap">
                            <div class="tl-dot" style="background:#EEF9FC; color:#0E7A96;">
                                <i class="fas fa-plus"></i>
                            </div>
                            <div class="tl-line"></div>
                        </div>
                        <div class="tl-body">
                            <div class="tl-title">Order Dibuat</div>
                            <div class="tl-time">
                                <i class="far fa-clock me-1"></i>
                                {{ $order->created_at->format('d M Y, H:i') }} WIB &bull;
                                {{ $order->created_at->diffForHumans() }}
                            </div>
                        </div>
                    </div>

                    {{-- Status Diproses / Disetujui / Ditolak --}}
                    @if($order->status == 'disetujui')
                        <div class="tl-item">
                            <div class="tl-dot-wrap">
                                <div class="tl-dot" style="background:#D1FAE5; color:#059669;">
                                    <i class="fas fa-check"></i>
                                </div>
                                <div class="tl-line"></div>
                            </div>
                            <div class="tl-body">
                                <div class="tl-title" style="color:#059669;">Pesanan Disetujui</div>
                                <div class="tl-time">
                                    <i class="far fa-clock me-1"></i>
                                    {{ $order->updated_at->format('d M Y, H:i') }} WIB
                                </div>
                                @if($order->catatan_admin)
                                    <div style="margin-top:6px; font-size:0.8rem; color:#64748B;">
                                        {{ $order->catatan_admin }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    @elseif($order->status == 'ditolak')
                        <div class="tl-item">
                            <div class="tl-dot-wrap">
                                <div class="tl-dot" style="background:#FEE2E2; color:#DC2626;">
                                    <i class="fas fa-times"></i>
                                </div>
                                <div class="tl-line"></div>
                            </div>
                            <div class="tl-body">
                                <div class="tl-title" style="color:#DC2626;">Pesanan Ditolak</div>
                                <div class="tl-time">
                                    <i class="far fa-clock me-1"></i>
                                    {{ $order->updated_at->format('d M Y, H:i') }} WIB
                                </div>
                                @if($order->catatan_admin)
                                    <div style="margin-top:6px; font-size:0.8rem; color:#64748B;">
                                        Alasan: {{ $order->catatan_admin }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    @else
                        <div class="tl-item">
                            <div class="tl-dot-wrap">
                                <div class="tl-dot" style="background:#FEF3C7; color:#D97706;">
                                    <i class="fas fa-clock"></i>
                                </div>
                            </div>
                            <div class="tl-body">
                                <div class="tl-title" style="color:#D97706;">Menunggu Konfirmasi</div>
                                <div class="tl-time">Belum ada tindakan admin</div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

        </div>

        {{-- ── RIGHT COLUMN ── --}}
        <div class="col-lg-4">

            {{-- Aksi (hanya saat menunggu) --}}
            @if($order->status == 'menunggu')
                <p class="sec-label anim-2">Aksi Admin</p>
                <div class="dash-card anim-2" style="margin-bottom: 20px;">
                    <div class="dash-card-header" style="background: linear-gradient(135deg, #FEF3C7, #FDE68A22);">
                        <div class="dash-card-title">
                            <i class="fas fa-gavel" style="color:#D97706;"></i>
                            <span style="color:#92400E;">Konfirmasi Pesanan</span>
                        </div>
                        <span class="status-pill menunggu" style="font-size:0.7rem; padding:3px 10px;">
                            <span class="dot"></span> Menunggu
                        </span>
                    </div>
                    <div style="padding: 20px 22px;">

                        {{-- Approve --}}
                        <form action="{{ route('apparel.orders.approve', $order) }}" method="POST"
                              id="form-approve">
                            @csrf
                            <div class="action-form-group">
                                <label>Catatan Persetujuan <span style="color:#94A3B8;">(opsional)</span></label>
                                <textarea name="catatan_admin" class="form-control" rows="2"
                                          placeholder="Tambahkan catatan untuk pemesan..."></textarea>
                            </div>
                            <button type="submit" class="btn-approve">
                                <i class="fas fa-check-circle"></i> Setujui Pesanan
                            </button>
                        </form>

                        <div style="display:flex; align-items:center; gap:10px; margin: 14px 0;">
                            <div style="flex:1; height:1px; background:#F1F5F9;"></div>
                            <span style="font-size:0.72rem; color:#CBD5E1; font-weight:600;">atau</span>
                            <div style="flex:1; height:1px; background:#F1F5F9;"></div>
                        </div>

                        {{-- Reject --}}
                        <form action="{{ route('apparel.orders.reject', $order) }}" method="POST"
                              id="form-reject">
                            @csrf
                            <div class="action-form-group">
                                <label>
                                    Alasan Penolakan
                                    <span style="color:#DC2626;">*</span>
                                </label>
                                <textarea name="catatan_admin" class="form-control" rows="2"
                                          placeholder="Jelaskan alasan penolakan..." required></textarea>
                            </div>
                            <button type="submit" class="btn-reject">
                                <i class="fas fa-times-circle"></i> Tolak Pesanan
                            </button>
                        </form>

                    </div>
                </div>
            @endif

            {{-- Informasi User --}}
            <p class="sec-label anim-3">Informasi User</p>
            <div class="dash-card anim-3" style="margin-bottom: 20px;">
                <div class="dash-card-header">
                    <div class="dash-card-title">
                        <i class="fas fa-user-circle"></i> Akun Pemesan
                    </div>
                </div>
                <div style="padding: 18px 22px;">
                    <div style="display:flex; align-items:center; gap:14px; margin-bottom:18px; padding-bottom:18px; border-bottom:1px solid #F1F5F9;">
                        <div class="user-avatar">
                            {{ strtoupper(substr($order->user->name ?? 'U', 0, 1)) }}
                        </div>
                        <div>
                            <div style="font-weight:800; font-size:0.95rem; color:#0D1B2A;">
                                {{ $order->user->name ?? 'N/A' }}
                            </div>
                            <div style="font-size:0.78rem; color:#94A3B8; margin-top:2px;">
                                {{ $order->user->email ?? 'N/A' }}
                            </div>
                        </div>
                    </div>

                    <div class="user-info-item">
                        <div class="uii-icon" style="background:#EEF9FC; color:#0E7A96;">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div>
                            <div class="uii-label">Email</div>
                            <div class="uii-value">{{ $order->user->email ?? 'N/A' }}</div>
                        </div>
                    </div>
                    <div class="user-info-item">
                        <div class="uii-icon" style="background:#D1FAE5; color:#059669;">
                            <i class="fas fa-calendar-plus"></i>
                        </div>
                        <div>
                            <div class="uii-label">Tanggal Order</div>
                            <div class="uii-value">{{ $order->created_at->format('d M Y, H:i') }}</div>
                        </div>
                    </div>
                    <div class="user-info-item">
                        <div class="uii-icon" style="background:#FEF3C7; color:#D97706;">
                            <i class="fas fa-sync-alt"></i>
                        </div>
                        <div>
                            <div class="uii-label">Update Terakhir</div>
                            <div class="uii-value">{{ $order->updated_at->diffForHumans() }}</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Ringkasan Harga --}}
            <p class="sec-label anim-4">Ringkasan Harga</p>
            <div class="dash-card anim-4">
                <div class="dash-card-header">
                    <div class="dash-card-title">
                        <i class="fas fa-calculator"></i> Kalkulasi
                    </div>
                </div>
                <div style="padding: 18px 22px;">
                    <div style="display:flex; justify-content:space-between; align-items:center; padding: 8px 0; border-bottom: 1px solid #F8FAFC;">
                        <span style="font-size:0.82rem; color:#64748B; font-weight:600;">Harga Satuan</span>
                        <span style="font-size:0.88rem; font-weight:700; color:#0D1B2A;">
                            Rp {{ number_format($order->variant->price ?? $order->product->price ?? 0, 0, ',', '.') }}
                        </span>
                    </div>
                    <div style="display:flex; justify-content:space-between; align-items:center; padding: 8px 0; border-bottom: 1px solid #F8FAFC;">
                        <span style="font-size:0.82rem; color:#64748B; font-weight:600;">Jumlah</span>
                        <span style="font-size:0.88rem; font-weight:700; color:#0D1B2A;">
                            {{ $order->qty }} pcs
                        </span>
                    </div>
                    <div style="display:flex; justify-content:space-between; align-items:center; padding: 14px 0 0;">
                        <span style="font-size:0.88rem; color:#0D1B2A; font-weight:700;">Total</span>
                        <span style="font-size:1.3rem; font-weight:800; color:#059669;">
                            Rp {{ number_format($order->qty * ($order->variant->price ?? $order->product->price ?? 0), 0, ',', '.') }}
                        </span>
                    </div>
                </div>
            </div>

        </div>
    </div>

@stop

@push('js')
<style>
    @keyframes blink {
        0%, 100% { opacity: 1; }
        50%       { opacity: 0.3; }
    }
</style>
@endpush