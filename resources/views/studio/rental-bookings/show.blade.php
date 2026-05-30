@extends('adminlte::page')

@section('title', 'Detail Pemesanan Sewa')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="mb-0" style="font-size: 1.4rem; font-weight: 700; color: #0D1B2A;">
                <i class="fas fa-file-alt me-2" style="color: #0E7A96;"></i> Detail Pemesanan Sewa
            </h1>
            <ol class="breadcrumb mb-0 mt-1" style="font-size: 0.8rem; background: transparent; padding: 0;">
                <li class="breadcrumb-item"><a href="{{ route('studio.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('studio.rental-bookings.index') }}">Pemesanan Sewa</a></li>
                <li class="breadcrumb-item active">#{{ $rentalBooking->id }}</li>
            </ol>
        </div>
        <a href="{{ route('studio.rental-bookings.index') }}"
           style="display:inline-flex; align-items:center; gap:7px; background:#64748B; color:#fff; padding:10px 22px; border-radius:50px; font-weight:700; font-size:0.88rem; text-decoration:none;">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
@stop

@push('css')
<style>
    .alert-success-custom {
        border-radius: 12px; border: none; background: #D1FAE5; color: #065F46;
        font-size: 0.88rem; padding: 12px 18px; display: flex; align-items: center;
        gap: 8px; margin-bottom: 20px;
    }
    .alert-error-custom {
        border-radius: 12px; border: none; background: #FEE2E2; color: #991B1B;
        font-size: 0.88rem; padding: 12px 18px; display: flex; align-items: center;
        gap: 8px; margin-bottom: 20px;
    }
    .detail-card {
        background: #fff; border: 1px solid #E2E8F0; border-radius: 20px;
        overflow: hidden; margin-bottom: 20px;
    }
    .detail-card-header {
        background: #F8FAFC; border-bottom: 1px solid #F1F5F9;
        padding: 16px 24px; display: flex; align-items: center; gap: 10px;
    }
    .detail-card-header-icon {
        width: 36px; height: 36px; background: rgba(14,122,150,0.1); border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        color: #0E7A96; font-size: 0.9rem; flex-shrink: 0;
    }
    .detail-card-header-title    { font-size: 0.92rem; font-weight: 700; color: #0D1B2A; margin: 0; }
    .detail-card-header-subtitle { font-size: 0.75rem; color: #94A3B8; margin: 1px 0 0; }
    .detail-card-body { padding: 24px; }

    .info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
    @media (max-width: 640px) { .info-grid { grid-template-columns: 1fr; } .detail-card-body { padding: 16px; } }

    .info-label {
        font-size: 0.72rem; font-weight: 700; text-transform: uppercase;
        letter-spacing: 0.06em; color: #94A3B8; margin-bottom: 5px;
        display: flex; align-items: center; gap: 5px;
    }
    .info-label i { color: #CBD5E1; }
    .info-value { font-size: 0.9rem; font-weight: 600; color: #0D1B2A; }
    .info-value.price { font-size: 1.1rem; font-weight: 800; color: #0E7A96; }

    /* Status badge */
    .status-badge {
        display: inline-flex; align-items: center; gap: 5px;
        padding: 5px 14px; border-radius: 50px; font-size: 0.78rem; font-weight: 700;
    }
    .status-menunggu  { background: rgba(245,158,11,0.12); color: #D97706; }
    .status-disetujui { background: rgba(14,122,150,0.1);  color: #0E7A96; }
    .status-aktif     { background: rgba(37,99,235,0.1);   color: #2563EB; }
    .status-selesai   { background: rgba(5,150,105,0.1);   color: #059669; }
    .status-ditolak   { background: rgba(220,38,38,0.1);   color: #DC2626; }

    /* Tool card */
    .tool-mini-card {
        display: flex; align-items: center; gap: 14px;
        background: #F8FAFC; border: 1px solid #E2E8F0;
        border-radius: 12px; padding: 14px 16px;
    }
    .tool-mini-img { width: 56px; height: 56px; border-radius: 10px; object-fit: cover; border: 1px solid #E2E8F0; flex-shrink: 0; }
    .tool-mini-placeholder {
        width: 56px; height: 56px; border-radius: 10px; flex-shrink: 0;
        background: linear-gradient(135deg, #EEF9FC, #D6EEF5);
        display: flex; align-items: center; justify-content: center;
        color: #0E7A96; font-size: 1.4rem; opacity: 0.6;
    }
    .tool-mini-name  { font-weight: 700; color: #0D1B2A; font-size: 0.9rem; margin-bottom: 3px; }
    .tool-mini-price { font-size: 0.8rem; color: #64748B; }

    /* Divider */
    .section-divider { display: flex; align-items: center; gap: 10px; margin: 20px 0; }
    .section-divider span { font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; color: #94A3B8; white-space: nowrap; }
    .section-divider::before, .section-divider::after { content: ''; flex: 1; height: 1px; background: #F1F5F9; }

    /* Bukti Transfer */
    .bukti-img {
        width: 100%; max-height: 400px; object-fit: contain; display: block;
        border-radius: 12px; border: 1px solid #E2E8F0; cursor: zoom-in; transition: transform 0.2s;
    }
    .bukti-img:hover { transform: scale(1.01); }
    .bukti-empty {
        background: #FFFBEB; border: 1.5px dashed #FCD34D; border-radius: 12px;
        padding: 20px 16px; display: flex; align-items: center; gap: 12px; color: #92400E;
    }
    .bukti-empty i { font-size: 1.3rem; color: #F59E0B; flex-shrink: 0; }

    /* Proof validated badge */
    .badge-proof {
        display: inline-flex; align-items: center; gap: 5px;
        padding: 4px 12px; border-radius: 50px; font-size: 0.76rem; font-weight: 700;
    }
    .badge-proof.valid   { background: #D1FAE5; color: #065F46; }
    .badge-proof.invalid { background: #FEE2E2; color: #991B1B; }
    .badge-proof.pending { background: #FEF9C3; color: #92400E; }

    /* Validation divider */
    .val-divider {
        display: flex; align-items: center; justify-content: space-between;
        margin: 20px 0 16px; padding-top: 16px; border-top: 1px solid #F1F5F9;
    }
    .val-divider-label {
        font-size: 0.8rem; font-weight: 700; color: #374151;
        display: flex; align-items: center; gap: 6px;
    }
    .val-divider-label i { color: #0E7A96; }

    /* Form fields */
    .field-label-sm { font-size: 0.78rem; font-weight: 700; color: #374151; display: block; margin-bottom: 6px; }
    .field-select {
        width: 100%; border: 1.5px solid #E2E8F0; border-radius: 10px;
        padding: 9px 14px; font-size: 0.85rem; color: #0D1B2A; background: #F8FAFC;
        outline: none; transition: border-color 0.2s; appearance: none;
    }
    .field-select:focus { border-color: #0E7A96; background: #fff; }
    .field-textarea-sm {
        width: 100%; border: 1.5px solid #E2E8F0; border-radius: 10px;
        padding: 9px 14px; font-size: 0.85rem; color: #0D1B2A; background: #F8FAFC;
        outline: none; resize: vertical; transition: border-color 0.2s;
    }
    .field-textarea-sm:focus { border-color: #0E7A96; background: #fff; }
    .btn-validate {
        display: inline-flex; align-items: center; gap: 7px; margin-top: 14px;
        background: #0E7A96; color: #fff; padding: 9px 22px; border-radius: 50px;
        font-size: 0.85rem; font-weight: 700; border: none; cursor: pointer; transition: all 0.2s;
    }
    .btn-validate:hover { background: #0c6880; box-shadow: 0 4px 14px rgba(14,122,150,0.3); transform: translateY(-1px); }

    /* Action form */
    .custom-label { font-size: 0.82rem; font-weight: 700; color: #374151; margin-bottom: 7px; display: flex; align-items: center; gap: 5px; }
    .custom-label i { color: #CBD5E1; font-size: 0.78rem; }
    .custom-textarea {
        width: 100%; border: 1.5px solid #E2E8F0; border-radius: 10px;
        padding: 10px 14px; font-size: 0.88rem; color: #0D1B2A; background: #F8FAFC;
        outline: none; transition: border-color 0.2s; resize: vertical; min-height: 80px;
    }
    .custom-textarea:focus { border-color: #0E7A96; background: #fff; box-shadow: 0 0 0 3px rgba(14,122,150,0.08); }

    /* Status action buttons */
    .status-actions { display: flex; gap: 10px; flex-wrap: wrap; margin-top: 18px; }
    .btn-action {
        display: inline-flex; align-items: center; gap: 7px;
        padding: 10px 20px; border-radius: 50px; font-weight: 700;
        font-size: 0.85rem; border: none; cursor: pointer; transition: all 0.2s;
    }
    .btn-action:hover { transform: translateY(-1px); }
    .btn-setujui { background: rgba(14,122,150,0.1); color: #0E7A96; }
    .btn-setujui:hover { background: #0E7A96; color: #fff; box-shadow: 0 4px 14px rgba(14,122,150,0.3); }
    .btn-aktif { background: rgba(37,99,235,0.1); color: #2563EB; }
    .btn-aktif:hover { background: #2563EB; color: #fff; box-shadow: 0 4px 14px rgba(37,99,235,0.3); }
    .btn-selesai { background: rgba(5,150,105,0.1); color: #059669; }
    .btn-selesai:hover { background: #059669; color: #fff; box-shadow: 0 4px 14px rgba(5,150,105,0.3); }
    .btn-tolak { background: rgba(220,38,38,0.1); color: #DC2626; }
    .btn-tolak:hover { background: #DC2626; color: #fff; box-shadow: 0 4px 14px rgba(220,38,38,0.3); }
    .btn-action:disabled { opacity: 0.5; cursor: not-allowed; transform: none !important; }

    /* Jaminan badge */
    .jaminan-badge {
        display: inline-flex; align-items: center; gap: 6px;
        background: rgba(14,122,150,0.08); color: #0E7A96;
        border-radius: 8px; padding: 6px 14px; font-size: 0.85rem; font-weight: 600;
    }

    /* Timeline */
    .timeline { padding: 0; list-style: none; margin: 0; }
    .tl-item { display: flex; gap: 14px; padding-bottom: 20px; position: relative; }
    .tl-item:last-child { padding-bottom: 0; }
    .tl-item:not(:last-child)::before {
        content: ''; position: absolute; left: 15px; top: 32px;
        width: 2px; bottom: 0; background: #F1F5F9;
    }
    .tl-dot {
        width: 32px; height: 32px; border-radius: 50%; flex-shrink: 0;
        display: flex; align-items: center; justify-content: center;
        font-size: 0.75rem; font-weight: 700; position: relative; z-index: 1;
    }
    .tl-dot.done    { background: #D1FAE5; color: #059669; }
    .tl-dot.current { background: #DBEAFE; color: #2563EB; }
    .tl-dot.pending { background: #F1F5F9; color: #94A3B8; }
    .tl-content .tl-title { font-size: 0.85rem; font-weight: 700; color: #0D1B2A; margin-bottom: 2px; }
    .tl-content .tl-sub   { font-size: 0.76rem; color: #94A3B8; }
</style>
@endpush

@section('content')

    @php
        $proofStatus = $rentalBooking->bukti_transfer_validated ?? 'pending';
    @endphp

    @if(session('success'))
        <div class="alert-success-custom">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert-error-custom">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
        </div>
    @endif

    <div class="row">
        <div class="col-lg-8">

            {{-- Info Pemesan & Detail Sewa --}}
            <div class="detail-card">
                <div class="detail-card-header">
                    <div class="detail-card-header-icon"><i class="fas fa-user"></i></div>
                    <div>
                        <p class="detail-card-header-title">Data Pemesan</p>
                        <p class="detail-card-header-subtitle">Pemesanan #{{ $rentalBooking->id }} · {{ $rentalBooking->created_at->format('d M Y, H:i') }}</p>
                    </div>
                    <div class="ml-auto">
                        <span class="status-badge status-{{ $rentalBooking->status }}">
                            {{ $rentalBooking->status_label }}
                        </span>
                    </div>
                </div>
                <div class="detail-card-body">

                    <div class="info-grid" style="margin-bottom: 20px;">
                        <div class="info-item">
                            <div class="info-label"><i class="fas fa-user"></i> Nama Pemesan</div>
                            <div class="info-value">{{ $rentalBooking->pemesan_name }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label"><i class="fas fa-phone"></i> Nomor HP</div>
                            <div class="info-value">
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $rentalBooking->pemesan_phone) }}"
                                   target="_blank" style="color:#059669; text-decoration:none;">
                                    <i class="fab fa-whatsapp"></i> {{ $rentalBooking->pemesan_phone }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="section-divider"><span>Detail Sewa</span></div>

                    <div class="tool-mini-card" style="margin-bottom: 20px;">
                        @if($rentalBooking->tool?->image)
                            <img src="{{ asset('storage/' . $rentalBooking->tool->image) }}" class="tool-mini-img" alt="">
                        @else
                            <div class="tool-mini-placeholder"><i class="fas fa-tools"></i></div>
                        @endif
                        <div>
                            <div class="tool-mini-name">{{ $rentalBooking->tool->name ?? '—' }}</div>
                            <div class="tool-mini-price">
                                Kategori: {{ $rentalBooking->tool->category ?? '—' }}
                                &nbsp;·&nbsp;
                                Rp {{ number_format($rentalBooking->tool->price_per_day ?? 0, 0, ',', '.') }} / hari
                            </div>
                        </div>
                    </div>

                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-label"><i class="fas fa-calendar-alt"></i> Tanggal Mulai</div>
                            <div class="info-value">{{ $rentalBooking->tanggal_mulai->format('d M Y') }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label"><i class="fas fa-calendar-check"></i> Tanggal Selesai</div>
                            <div class="info-value">{{ $rentalBooking->tanggal_selesai->format('d M Y') }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label"><i class="fas fa-clock"></i> Durasi</div>
                            <div class="info-value">{{ $rentalBooking->durasi }} hari</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label"><i class="fas fa-box"></i> Jumlah Unit</div>
                            <div class="info-value">{{ $rentalBooking->qty }} unit</div>
                        </div>
                        <div class="info-item" style="grid-column: 1 / -1;">
                            <div class="info-label"><i class="fas fa-money-bill-wave"></i> Total Biaya</div>
                            <div class="info-value price">Rp {{ number_format($rentalBooking->total_harga, 0, ',', '.') }}</div>
                        </div>
                    </div>

                    @if($rentalBooking->catatan_user)
                        <div class="section-divider"><span>Catatan Pemesan</span></div>
                        <div style="background:#F8FAFC; border:1px solid #E2E8F0; border-radius:10px; padding:12px 16px; font-size:0.88rem; color:#374151; line-height:1.6;">
                            {{ $rentalBooking->catatan_user }}
                        </div>
                    @endif

                    @if($rentalBooking->catatan_admin)
                        <div class="section-divider"><span>Catatan Admin</span></div>
                        <div style="background:#EEF9FC; border:1px solid rgba(14,122,150,0.2); border-radius:10px; padding:12px 16px; font-size:0.88rem; color:#0D1B2A; line-height:1.6;">
                            {{ $rentalBooking->catatan_admin }}
                        </div>
                    @endif

                </div>
            </div>

            {{-- ══════════════════════════════════════════════════════ --}}
            {{-- BUKTI TRANSFER & FORM VALIDASI                         --}}
            {{-- ══════════════════════════════════════════════════════ --}}
            <div class="detail-card">
                <div class="detail-card-header">
                    <div class="detail-card-header-icon"><i class="fas fa-file-invoice-dollar"></i></div>
                    <div>
                        <p class="detail-card-header-title">Bukti Transfer & Jaminan</p>
                        <p class="detail-card-header-subtitle">Verifikasi pembayaran dari pemesan</p>
                    </div>
                    @if($rentalBooking->bukti_transfer)
                        <a href="{{ asset('storage/' . $rentalBooking->bukti_transfer) }}" target="_blank"
                           style="margin-left:auto; display:inline-flex; align-items:center; gap:6px; background:#0E7A96; color:#fff; padding:7px 16px; border-radius:50px; font-size:0.78rem; font-weight:700; text-decoration:none;">
                            <i class="fas fa-expand-alt"></i> Buka Penuh
                        </a>
                    @endif
                </div>
                <div class="detail-card-body">

                    {{-- Gambar Bukti Transfer --}}
                    <div class="info-label" style="margin-bottom: 10px;"><i class="fas fa-receipt"></i> Bukti Transfer Pembayaran</div>
                    @if($rentalBooking->bukti_transfer)
                        <a href="{{ asset('storage/' . $rentalBooking->bukti_transfer) }}" target="_blank">
                            <img src="{{ asset('storage/' . $rentalBooking->bukti_transfer) }}" class="bukti-img" alt="Bukti Transfer">
                        </a>
                        <div style="margin-top:8px; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:8px;">
                            <span style="font-size:0.75rem; color:#94A3B8;"><i class="fas fa-search-plus"></i> Klik untuk lihat penuh</span>
                            <a href="{{ asset('storage/' . $rentalBooking->bukti_transfer) }}" download
                               style="font-size:0.78rem; font-weight:600; color:#0E7A96; text-decoration:none;">
                                <i class="fas fa-download"></i> Unduh
                            </a>
                        </div>

                        {{-- ── FORM VALIDASI (hanya tampil saat status masih menunggu) ── --}}
                        @if($rentalBooking->status === 'menunggu')
                            <div class="val-divider">
                                <div class="val-divider-label"><i class="fas fa-check-double"></i> Validasi Bukti Transfer</div>
                                <span class="badge-proof {{ $proofStatus }}">
                                    @if($proofStatus === 'valid')   <i class="fas fa-check-circle"></i> Valid
                                    @elseif($proofStatus === 'invalid') <i class="fas fa-times-circle"></i> Tidak Valid
                                    @else <i class="fas fa-clock"></i> Pending
                                    @endif
                                </span>
                            </div>

                            <form action="{{ route('studio.rental-bookings.validate-proof', $rentalBooking) }}" method="POST">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="field-label-sm">Status Validasi</label>
                                        <div style="position:relative;">
                                            <select name="bukti_transfer_validated" class="field-select">
                                                <option value="pending"  {{ $proofStatus === 'pending'  ? 'selected' : '' }}>⏳ Pending (Belum Diverifikasi)</option>
                                                <option value="valid"    {{ $proofStatus === 'valid'    ? 'selected' : '' }}>✅ Valid (Bukti Sesuai)</option>
                                                <option value="invalid"  {{ $proofStatus === 'invalid'  ? 'selected' : '' }}>❌ Tidak Valid (Bukti Bermasalah)</option>
                                            </select>
                                            <i class="fas fa-chevron-down" style="position:absolute; right:12px; top:50%; transform:translateY(-50%); color:#CBD5E1; font-size:0.7rem; pointer-events:none;"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="field-label-sm">Catatan Validasi</label>
                                        <textarea name="catatan_admin" class="field-textarea-sm" rows="2"
                                                  placeholder="Nominal sesuai / rekening tidak cocok...">{{ $rentalBooking->catatan_admin }}</textarea>
                                    </div>
                                </div>
                                <button type="submit" class="btn-validate">
                                    <i class="fas fa-save"></i> Simpan Validasi
                                </button>
                            </form>
                        @else
                            {{-- Sudah diproses, tampilkan status validasi saja --}}
                            <div class="val-divider">
                                <div class="val-divider-label"><i class="fas fa-check-double"></i> Status Validasi Bukti</div>
                                <span class="badge-proof {{ $proofStatus }}">
                                    @if($proofStatus === 'valid')   <i class="fas fa-check-circle"></i> Valid
                                    @elseif($proofStatus === 'invalid') <i class="fas fa-times-circle"></i> Tidak Valid
                                    @else <i class="fas fa-clock"></i> Pending
                                    @endif
                                </span>
                            </div>
                        @endif

                    @else
                        <div class="bukti-empty">
                            <i class="fas fa-exclamation-triangle"></i>
                            <div>
                                <div style="font-weight:700; margin-bottom:2px;">Bukti transfer belum diunggah</div>
                                <div style="font-size:0.8rem; color:#B45309;">Pemesan belum melampirkan bukti pembayaran.</div>
                            </div>
                        </div>
                    @endif

                    {{-- Jenis Jaminan --}}
                    <div style="margin-top: 20px;">
                        <div class="info-label" style="margin-bottom: 8px;"><i class="fas fa-id-card"></i> Jenis Jaminan yang Dibawa</div>
                        @if($rentalBooking->jenis_jaminan)
                            <span class="jaminan-badge"><i class="fas fa-id-badge"></i> {{ $rentalBooking->jaminan_label }}</span>
                        @else
                            <span style="font-size:0.88rem; color:#94A3B8;">—</span>
                        @endif
                    </div>

                </div>
            </div>
            {{-- ══════════════════════════════════════════════════════ --}}

            {{-- Update Status Form --}}
            @if(!in_array($rentalBooking->status, ['selesai', 'ditolak']))
                <div class="detail-card">
                    <div class="detail-card-header">
                        <div class="detail-card-header-icon"><i class="fas fa-exchange-alt"></i></div>
                        <div>
                            <p class="detail-card-header-title">Ubah Status Pemesanan</p>
                            <p class="detail-card-header-subtitle">Pilih aksi untuk memproses pemesanan ini</p>
                        </div>
                    </div>
                    <div class="detail-card-body">

                        {{-- Info validasi untuk tombol Setujui --}}
                        @if($rentalBooking->status === 'menunggu')
                            @if(!$rentalBooking->bukti_transfer)
                                <div style="background:#FEF9C3; border:1px solid #FDE68A; border-radius:10px; padding:12px 16px; font-size:0.85rem; color:#92400E; margin-bottom:16px; display:flex; align-items:center; gap:8px;">
                                    <i class="fas fa-exclamation-circle" style="color:#F59E0B; flex-shrink:0;"></i>
                                    Pemesan belum mengunggah bukti transfer. Konfirmasi pembayaran via cara lain sebelum menyetujui.
                                </div>
                            @elseif($proofStatus === 'pending')
                                <div style="background:#FEF9C3; border:1px solid #FDE68A; border-radius:10px; padding:12px 16px; font-size:0.85rem; color:#92400E; margin-bottom:16px; display:flex; align-items:center; gap:8px;">
                                    <i class="fas fa-exclamation-circle" style="color:#F59E0B; flex-shrink:0;"></i>
                                    Bukti transfer belum divalidasi. Validasi dulu di bagian atas sebelum menyetujui pemesanan.
                                </div>
                            @elseif($proofStatus === 'invalid')
                                <div style="background:#FEE2E2; border:1px solid #FECACA; border-radius:10px; padding:12px 16px; font-size:0.85rem; color:#991B1B; margin-bottom:16px; display:flex; align-items:center; gap:8px;">
                                    <i class="fas fa-times-circle" style="color:#DC2626; flex-shrink:0;"></i>
                                    Bukti transfer ditandai <strong>Tidak Valid</strong>. Tidak dapat menyetujui pemesanan ini. Tolak atau minta pemesan upload ulang.
                                </div>
                            @else
                                <div style="background:#D1FAE5; border:1px solid #6EE7B7; border-radius:10px; padding:12px 16px; font-size:0.85rem; color:#065F46; margin-bottom:16px; display:flex; align-items:center; gap:8px;">
                                    <i class="fas fa-check-circle" style="color:#059669; flex-shrink:0;"></i>
                                    Bukti transfer sudah tervalidasi <strong>Valid</strong>. Pemesanan siap untuk disetujui.
                                </div>
                            @endif
                        @endif

                        <form action="{{ route('studio.rental-bookings.update-status', $rentalBooking) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <div>
                                <label class="custom-label" for="catatan_admin">
                                    <i class="fas fa-comment-alt"></i> Catatan untuk Pemesan
                                    <span style="font-size:0.72rem; color:#94A3B8; font-weight:400;">(opsional)</span>
                                </label>
                                <textarea class="custom-textarea" id="catatan_admin" name="catatan_admin"
                                          rows="3"
                                          placeholder="Misal: Silakan ambil alat di studio pukul 08.00...">{{ old('catatan_admin', $rentalBooking->catatan_admin) }}</textarea>
                            </div>

                            <div class="status-actions">
                                @if($rentalBooking->status === 'menunggu')
                                    {{-- Tombol Setujui: disable jika proof bukan 'valid' --}}
                                    @php $canApprove = $proofStatus === 'valid'; @endphp
                                    <button type="submit" name="status" value="disetujui"
                                            class="btn-action btn-setujui"
                                            {{ !$canApprove ? 'disabled' : '' }}
                                            title="{{ !$canApprove ? 'Validasi bukti transfer terlebih dahulu' : 'Setujui pemesanan' }}">
                                        <i class="fas fa-check"></i> Setujui
                                    </button>
                                    <button type="submit" name="status" value="ditolak" class="btn-action btn-tolak"
                                            onclick="return confirm('Yakin tolak pemesanan ini?')">
                                        <i class="fas fa-times"></i> Tolak
                                    </button>
                                @endif

                                @if($rentalBooking->status === 'disetujui')
                                    <button type="submit" name="status" value="aktif" class="btn-action btn-aktif">
                                        <i class="fas fa-play"></i> Tandai Sedang Berjalan
                                    </button>
                                    <button type="submit" name="status" value="ditolak" class="btn-action btn-tolak"
                                            onclick="return confirm('Yakin batalkan pemesanan ini?')">
                                        <i class="fas fa-ban"></i> Batalkan
                                    </button>
                                @endif

                                @if($rentalBooking->status === 'aktif')
                                    <button type="submit" name="status" value="selesai" class="btn-action btn-selesai">
                                        <i class="fas fa-flag-checkered"></i> Tandai Selesai
                                    </button>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            @endif

        </div>

        <div class="col-lg-4">

            {{-- Timeline status --}}
            <div class="detail-card">
                <div class="detail-card-header">
                    <div class="detail-card-header-icon"><i class="fas fa-stream"></i></div>
                    <div>
                        <p class="detail-card-header-title">Alur Status</p>
                        <p class="detail-card-header-subtitle">Progres pemesanan sewa</p>
                    </div>
                </div>
                <div class="detail-card-body">
                    @php
                        $steps = [
                            'menunggu'  => ['icon' => 'fa-hourglass-half', 'label' => 'Menunggu Konfirmasi', 'sub' => 'Pemesanan masuk, belum diproses'],
                            'disetujui' => ['icon' => 'fa-check',          'label' => 'Disetujui',           'sub' => 'Admin telah menyetujui'],
                            'aktif'     => ['icon' => 'fa-tools',          'label' => 'Sedang Berjalan',     'sub' => 'Alat sedang dipinjam'],
                            'selesai'   => ['icon' => 'fa-flag-checkered', 'label' => 'Selesai',             'sub' => 'Alat telah dikembalikan'],
                        ];
                        $order      = array_keys($steps);
                        $current    = $rentalBooking->status === 'ditolak' ? 'ditolak' : $rentalBooking->status;
                        $currentIdx = array_search($current, $order);
                    @endphp

                    @if($rentalBooking->status === 'ditolak')
                        <div style="display:flex; align-items:center; gap:10px; padding:12px 14px; background:#FEF2F2; border:1px solid rgba(220,38,38,0.15); border-radius:10px;">
                            <div style="width:32px; height:32px; border-radius:50%; background:#FEE2E2; display:flex; align-items:center; justify-content:center; color:#DC2626; flex-shrink:0;">
                                <i class="fas fa-times" style="font-size:0.75rem;"></i>
                            </div>
                            <div>
                                <div style="font-size:0.85rem; font-weight:700; color:#DC2626;">Pemesanan Ditolak</div>
                                <div style="font-size:0.75rem; color:#94A3B8;">{{ $rentalBooking->updated_at->format('d M Y') }}</div>
                            </div>
                        </div>
                    @else
                        <ul class="timeline">
                            @foreach($steps as $key => $step)
                                @php
                                    $idx   = array_search($key, $order);
                                    $state = $idx < $currentIdx ? 'done' : ($idx === $currentIdx ? 'current' : 'pending');
                                @endphp
                                <li class="tl-item">
                                    <div class="tl-dot {{ $state }}">
                                        <i class="fas {{ $state === 'done' ? 'fa-check' : $step['icon'] }}" style="font-size:0.7rem;"></i>
                                    </div>
                                    <div class="tl-content">
                                        <div class="tl-title" style="{{ $state === 'pending' ? 'color:#94A3B8;' : '' }}">{{ $step['label'] }}</div>
                                        <div class="tl-sub">{{ $step['sub'] }}</div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

            {{-- Ringkasan --}}
            <div class="detail-card">
                <div class="detail-card-header">
                    <div class="detail-card-header-icon"><i class="fas fa-info"></i></div>
                    <div>
                        <p class="detail-card-header-title">Ringkasan</p>
                        <p class="detail-card-header-subtitle">Data cepat pemesanan</p>
                    </div>
                </div>
                <div class="detail-card-body">
                    <div style="display:flex; flex-direction:column; gap:12px;">
                        @foreach([
                            ['label' => 'ID Pemesanan',    'value' => '#'.$rentalBooking->id],
                            ['label' => 'Tanggal Masuk',   'value' => $rentalBooking->created_at->format('d M Y, H:i')],
                            ['label' => 'Durasi',          'value' => $rentalBooking->durasi.' hari'],
                            ['label' => 'Jumlah Unit',     'value' => $rentalBooking->qty.' unit'],
                            ['label' => 'Total Biaya',     'value' => 'Rp '.number_format($rentalBooking->total_harga,0,',','.')],
                            ['label' => 'Bukti Transfer',  'value' => $rentalBooking->bukti_transfer ? '✅ Sudah diunggah' : '⚠️ Belum ada'],
                            ['label' => 'Validasi Bukti',  'value' => match($proofStatus) { 'valid' => '✅ Valid', 'invalid' => '❌ Tidak Valid', default => '⏳ Pending' }],
                            ['label' => 'Jaminan',         'value' => $rentalBooking->jaminan_label ?? '—'],
                        ] as $row)
                            <div style="display:flex; justify-content:space-between; align-items:center; padding-bottom:12px; border-bottom:1px solid #F8FAFC;">
                                <span style="font-size:0.78rem; color:#94A3B8;">{{ $row['label'] }}</span>
                                <span style="font-size:0.83rem; font-weight:700; color:#0D1B2A;">{{ $row['value'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>

@stop