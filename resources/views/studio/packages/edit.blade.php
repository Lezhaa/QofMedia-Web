@extends('adminlte::page')

@section('title', 'Edit Paket Studio')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="mb-0" style="font-size: 1.4rem; font-weight: 700; color: #0D1B2A;">
                <i class="fas fa-edit me-2" style="color: #0E7A96;"></i> Edit Paket Studio
            </h1>
            <ol class="breadcrumb mb-0 mt-1" style="font-size: 0.8rem; background: transparent; padding: 0;">
                <li class="breadcrumb-item"><a href="{{ route('studio.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('studio.packages.index') }}">Paket Studio</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </div>
        <a href="{{ route('studio.packages.index') }}"
           style="display:inline-flex; align-items:center; gap:7px; background:#fff; border:1.5px solid #E2E8F0; color:#64748B; padding:9px 20px; border-radius:50px; font-weight:700; font-size:0.85rem; text-decoration:none; transition:all 0.3s;">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
@stop

@push('css')
<style>
    /* ============================================
       LAYOUT
       ============================================ */
    .form-layout {
        display: grid;
        grid-template-columns: 1fr 300px;
        gap: 20px;
        align-items: start;
    }

    /* ============================================
       EDIT BANNER
       ============================================ */
    .edit-banner {
        background: linear-gradient(135deg, #0D1B2A 0%, #1B3A4B 55%, #0E7A96 100%);
        border-radius: 16px;
        padding: 18px 22px;
        display: flex;
        align-items: center;
        gap: 14px;
        margin-bottom: 20px;
        position: relative;
        overflow: hidden;
    }
    .edit-banner::before {
        content: '';
        position: absolute;
        top: -50%; right: -10%;
        width: 200px; height: 200px;
        background: radial-gradient(circle, rgba(78,184,204,0.15) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }
    .edit-banner .eb-icon {
        width: 42px; height: 42px;
        border-radius: 12px;
        background: rgba(255,255,255,0.12);
        display: flex; align-items: center; justify-content: center;
        color: #A8DDE8;
        font-size: 1.1rem;
        flex-shrink: 0;
        z-index: 1;
    }
    .edit-banner .eb-text { z-index: 1; }
    .edit-banner .eb-text strong {
        display: block;
        color: #fff;
        font-size: 0.9rem;
        font-weight: 700;
        margin-bottom: 2px;
    }
    .edit-banner .eb-text span {
        color: rgba(255,255,255,0.55);
        font-size: 0.78rem;
    }

    /* ============================================
       FORM CARD
       ============================================ */
    .form-card {
        background: #fff;
        border: 1px solid #E2E8F0;
        border-radius: 20px;
        overflow: hidden;
        margin-bottom: 20px;
    }
    .form-card:last-child { margin-bottom: 0; }

    .form-card-header {
        padding: 18px 24px;
        border-bottom: 1px solid #F1F5F9;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .fch-icon {
        width: 36px; height: 36px;
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 0.95rem;
        flex-shrink: 0;
    }
    .fch-icon.blue   { background: #EEF9FC; color: #0E7A96; }
    .fch-icon.green  { background: #D1FAE5; color: #059669; }
    .fch-icon.amber  { background: #FEF3C7; color: #D97706; }
    .fch-icon.purple { background: #EEF2FF; color: #4F46E5; }

    .fch-title { font-size: 0.92rem; font-weight: 700; color: #0D1B2A; }
    .fch-sub   { font-size: 0.75rem; color: #94A3B8; margin-top: 1px; }
    .form-card-body { padding: 24px; }

    /* ============================================
       FIELDS
       ============================================ */
    .field-group { margin-bottom: 20px; }
    .field-group:last-child { margin-bottom: 0; }

    .field-label {
        display: block;
        font-size: 0.78rem;
        font-weight: 700;
        color: #475569;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        margin-bottom: 8px;
    }
    .field-label .req { color: #DC2626; margin-left: 2px; }

    .field-input {
        width: 100%;
        border: 1.5px solid #E2E8F0;
        border-radius: 10px;
        padding: 11px 16px;
        font-size: 0.9rem;
        color: #0D1B2A;
        background: #F8FAFC;
        outline: none;
        transition: all 0.25s;
        font-family: inherit;
        appearance: none;
    }
    .field-input:focus {
        border-color: #4EB8CC;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(78,184,204,0.1);
    }
    .field-input.is-invalid { border-color: #EF4444; background: #FFF5F5; }
    .field-input.is-invalid:focus { box-shadow: 0 0 0 3px rgba(239,68,68,0.1); }

    textarea.field-input { resize: vertical; min-height: 100px; }

    .field-hint {
        font-size: 0.75rem;
        color: #94A3B8;
        margin-top: 6px;
        display: flex;
        align-items: center;
        gap: 4px;
    }
    .invalid-msg {
        font-size: 0.75rem;
        color: #DC2626;
        margin-top: 6px;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .field-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }

    /* Price prefix */
    .price-wrap { position: relative; }
    .price-wrap .price-prefix {
        position: absolute;
        left: 0; top: 0; bottom: 0;
        display: flex; align-items: center;
        padding: 0 14px;
        background: #F1F5F9;
        border: 1.5px solid #E2E8F0;
        border-right: none;
        border-radius: 10px 0 0 10px;
        font-size: 0.85rem;
        font-weight: 700;
        color: #64748B;
        pointer-events: none;
        transition: border-color 0.25s;
    }
    .price-wrap .field-input { padding-left: 58px; }
    .price-wrap:focus-within .price-prefix { border-color: #4EB8CC; }

    /* ============================================
       TYPE CARDS
       ============================================ */
    .type-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 10px; }
    .type-item { position: relative; }
    .type-item input[type="radio"] { position: absolute; opacity: 0; width: 0; height: 0; }

    .type-label {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 14px 8px;
        border: 1.5px solid #E2E8F0;
        border-radius: 12px;
        cursor: pointer;
        background: #F8FAFC;
        transition: all 0.25s;
        text-align: center;
        user-select: none;
    }
    .type-label .t-icon { font-size: 1.2rem; transition: transform 0.25s; }
    .type-label .t-name { font-size: 0.75rem; font-weight: 700; color: #64748B; transition: color 0.25s; }
    .type-label:hover { border-color: #4EB8CC; background: #EEF9FC; }
    .type-label:hover .t-icon { transform: scale(1.15); }

    .type-item input:checked + .type-label.basic    { border-color: #3B82F6; background: #EFF6FF; }
    .type-item input:checked + .type-label.standard { border-color: #10B981; background: #ECFDF5; }
    .type-item input:checked + .type-label.premium  { border-color: #D97706; background: #FFFBEB; }
    .type-item input:checked + .type-label.exclusive{ border-color: #7C3AED; background: #F5F3FF; }

    .type-item input:checked + .type-label.basic    .t-name { color: #3B82F6; }
    .type-item input:checked + .type-label.standard .t-name { color: #10B981; }
    .type-item input:checked + .type-label.premium  .t-name { color: #D97706; }
    .type-item input:checked + .type-label.exclusive .t-name{ color: #7C3AED; }

    /* ============================================
       FACILITIES BUILDER
       ============================================ */
    .facility-builder {
        border: 1.5px solid #E2E8F0;
        border-radius: 12px;
        overflow: hidden;
        background: #F8FAFC;
        transition: border-color 0.25s;
    }
    .facility-builder:focus-within { border-color: #4EB8CC; background: #fff; }

    .facility-list-edit { list-style: none; padding: 0; margin: 0; }
    .facility-item-edit {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 14px;
        border-bottom: 1px solid #F1F5F9;
        transition: background 0.15s;
    }
    .facility-item-edit:hover { background: #EEF9FC; }
    .facility-item-edit:last-child { border-bottom: none; }
    .facility-item-edit .fi-icon { color: #10B981; font-size: 0.8rem; flex-shrink: 0; }
    .facility-item-edit .fi-text { flex: 1; font-size: 0.85rem; color: #0D1B2A; font-weight: 500; }
    .facility-item-edit .fi-remove {
        background: none; border: none; cursor: pointer;
        color: #CBD5E1; font-size: 0.8rem; padding: 2px;
        border-radius: 4px; transition: color 0.2s;
        display: flex; align-items: center; justify-content: center;
        width: 22px; height: 22px;
    }
    .facility-item-edit .fi-remove:hover { color: #DC2626; background: #FEE2E2; }

    .facility-add-row { display: flex; gap: 0; border-top: 1.5px solid #E2E8F0; }
    .facility-add-row input {
        flex: 1; border: none; outline: none;
        padding: 11px 14px; font-size: 0.88rem;
        background: #fff; border-radius: 0;
        color: #0D1B2A; font-family: inherit;
    }
    .facility-add-row input::placeholder { color: #CBD5E1; }
    .facility-add-btn {
        padding: 0 18px; background: #0E7A96; color: #fff;
        border: none; cursor: pointer; font-size: 0.82rem; font-weight: 700;
        display: flex; align-items: center; gap: 6px;
        transition: background 0.2s; white-space: nowrap;
    }
    .facility-add-btn:hover { background: #0A5A70; }

    .facility-empty {
        padding: 20px; text-align: center;
        font-size: 0.8rem; color: #CBD5E1;
    }
    #facilitiesHidden { display: none; }

    /* ============================================
       SIDEBAR
       ============================================ */
    .info-card {
        background: #fff;
        border: 1px solid #E2E8F0;
        border-radius: 20px;
        overflow: hidden;
        position: sticky;
        top: 20px;
    }
    .info-card-header {
        padding: 18px 24px;
        border-bottom: 1px solid #F1F5F9;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .info-card-body { padding: 20px 24px; }

    /* Current package info */
    .pkg-meta {
        background: #F8FAFC;
        border-radius: 12px;
        padding: 14px 16px;
        margin-bottom: 16px;
    }
    .pkg-meta-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.78rem;
        color: #64748B;
        padding: 5px 0;
        border-bottom: 1px solid #F1F5F9;
    }
    .pkg-meta-row:last-child { border-bottom: none; }
    .pkg-meta-row span:first-child { color: #94A3B8; }
    .pkg-meta-row span:last-child  { font-weight: 700; color: #0D1B2A; }

    .info-tip {
        display: flex; align-items: flex-start;
        gap: 10px; padding: 12px 0;
        border-bottom: 1px solid #F8FAFC;
    }
    .info-tip:last-child { border-bottom: none; padding-bottom: 0; }
    .info-tip:first-child { padding-top: 0; }
    .info-tip .tip-icon {
        width: 30px; height: 30px;
        border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        font-size: 0.8rem; flex-shrink: 0; margin-top: 1px;
    }
    .info-tip .tip-text { font-size: 0.78rem; color: #64748B; line-height: 1.6; }
    .info-tip .tip-text strong { color: #0D1B2A; display: block; font-size: 0.8rem; margin-bottom: 2px; }

    /* Price preview */
    .price-preview {
        background: linear-gradient(135deg, #EEF9FC, #D6EEF5);
        border-radius: 12px;
        padding: 16px;
        margin-top: 14px;
        text-align: center;
    }
    .price-preview .pp-label {
        font-size: 0.72rem; color: #64748B;
        text-transform: uppercase; letter-spacing: 0.08em;
        font-weight: 600; margin-bottom: 4px;
    }
    .price-preview .pp-value { font-size: 1.3rem; font-weight: 800; color: #0E7A96; }

    /* ============================================
       ACTION BAR
       ============================================ */
    .action-bar {
        background: #fff;
        border: 1px solid #E2E8F0;
        border-radius: 16px;
        padding: 18px 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-top: 20px;
    }
    .ab-hint { font-size: 0.78rem; color: #94A3B8; display: flex; align-items: center; gap: 6px; }
    .ab-buttons { display: flex; gap: 10px; }

    .btn-save {
        display: inline-flex; align-items: center; gap: 8px;
        background: linear-gradient(135deg, #0E7A96, #0A5A70);
        color: #fff; border: none; padding: 11px 28px;
        border-radius: 50px; font-weight: 700; font-size: 0.88rem;
        cursor: pointer; transition: all 0.3s;
    }
    .btn-save:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(14,122,150,0.3); color: #fff; }

    .btn-cancel {
        display: inline-flex; align-items: center; gap: 8px;
        background: #fff; color: #64748B;
        border: 1.5px solid #E2E8F0;
        padding: 11px 22px; border-radius: 50px;
        font-weight: 600; font-size: 0.88rem;
        text-decoration: none; transition: all 0.3s;
    }
    .btn-cancel:hover { border-color: #CBD5E0; color: #0D1B2A; background: #F8FAFC; text-decoration: none; }

    /* ============================================
       RESPONSIVE
       ============================================ */
    @media (max-width: 992px) {
        .form-layout { grid-template-columns: 1fr; }
        .info-card   { position: static; }
        .field-row   { grid-template-columns: 1fr; }
        .type-grid   { grid-template-columns: repeat(2, 1fr); }
    }
</style>
@endpush

@section('content')

    <form action="{{ route('studio.packages.update', $package) }}" method="POST" id="packageForm">
        @csrf
        @method('PUT')

        {{-- Hidden textarea untuk fasilitas --}}
        <textarea name="facilities" id="facilitiesHidden"></textarea>

        {{-- Edit banner --}}
        <div class="edit-banner">
            <div class="eb-icon"><i class="fas fa-edit"></i></div>
            <div class="eb-text">
                <strong>{{ $package->name }}</strong>
                <span>Mengedit paket — perubahan akan langsung diterapkan setelah disimpan</span>
            </div>
        </div>

        <div class="form-layout">

            {{-- ── KIRI: FORM UTAMA ── --}}
            <div>

                {{-- Informasi Paket --}}
                <div class="form-card">
                    <div class="form-card-header">
                        <div class="fch-icon blue"><i class="fas fa-box-open"></i></div>
                        <div>
                            <div class="fch-title">Informasi Paket</div>
                            <div class="fch-sub">Nama dan deskripsi paket</div>
                        </div>
                    </div>
                    <div class="form-card-body">

                        <div class="field-group">
                            <label class="field-label" for="name">Nama Paket <span class="req">*</span></label>
                            <input type="text"
                                   class="field-input @error('name') is-invalid @enderror"
                                   id="name" name="name"
                                   value="{{ old('name', $package->name) }}"
                                   required>
                            @error('name')
                                <div class="invalid-msg"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                            @enderror
                        </div>

                        <div class="field-group">
                            <label class="field-label" for="description">Deskripsi</label>
                            <textarea class="field-input @error('description') is-invalid @enderror"
                                      id="description" name="description">{{ old('description', $package->description) }}</textarea>
                            @error('description')
                                <div class="invalid-msg"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                            @else
                                <div class="field-hint"><i class="fas fa-info-circle"></i> Opsional — tampil di halaman layanan publik</div>
                            @enderror
                        </div>

                    </div>
                </div>

                {{-- Tipe Paket --}}
                <div class="form-card">
                    <div class="form-card-header">
                        <div class="fch-icon amber"><i class="fas fa-tags"></i></div>
                        <div>
                            <div class="fch-title">Tipe Paket</div>
                            <div class="fch-sub">Pilih kategori paket</div>
                        </div>
                    </div>
                    <div class="form-card-body">
                        @php
                            $currentType = old('type', $package->type);
                            $types = [
                                'Basic'    => ['icon' => '🟦', 'class' => 'basic'],
                                'Standard' => ['icon' => '🟩', 'class' => 'standard'],
                                'Premium'  => ['icon' => '🟨', 'class' => 'premium'],
                                'Exclusive'=> ['icon' => '🟪', 'class' => 'exclusive'],
                            ];
                        @endphp
                        <div class="type-grid">
                            @foreach($types as $val => $meta)
                                <div class="type-item">
                                    <input type="radio"
                                           id="type_{{ $val }}"
                                           name="type"
                                           value="{{ $val }}"
                                           {{ $currentType == $val ? 'checked' : '' }}
                                           required>
                                    <label class="type-label {{ $meta['class'] }}" for="type_{{ $val }}">
                                        <span class="t-icon">{{ $meta['icon'] }}</span>
                                        <span class="t-name">{{ $val }}</span>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        @error('type')
                            <div class="invalid-msg mt-2"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Harga & Durasi --}}
                <div class="form-card">
                    <div class="form-card-header">
                        <div class="fch-icon green"><i class="fas fa-money-bill-wave"></i></div>
                        <div>
                            <div class="fch-title">Harga & Durasi</div>
                            <div class="fch-sub">Tarif dan lama sesi</div>
                        </div>
                    </div>
                    <div class="form-card-body">
                        <div class="field-row">

                            <div class="field-group">
                                <label class="field-label" for="price">Harga <span class="req">*</span></label>
                                <div class="price-wrap">
                                    <span class="price-prefix">Rp</span>
                                    <input type="number"
                                           class="field-input @error('price') is-invalid @enderror"
                                           id="price" name="price"
                                           value="{{ old('price', $package->price) }}"
                                           min="0"
                                           oninput="updatePricePreview(this.value)"
                                           required>
                                </div>
                                @error('price')
                                    <div class="invalid-msg"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="field-group">
                                <label class="field-label" for="duration">Durasi <span class="req">*</span></label>
                                <input type="text"
                                       class="field-input @error('duration') is-invalid @enderror"
                                       id="duration" name="duration"
                                       value="{{ old('duration', $package->duration) }}"
                                       placeholder="Contoh: 2 jam"
                                       required>
                                @error('duration')
                                    <div class="invalid-msg"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                                @else
                                    <div class="field-hint"><i class="fas fa-info-circle"></i> Contoh: 1 jam, 90 menit</div>
                                @enderror
                            </div>

                        </div>
                    </div>
                </div>

                {{-- Fasilitas --}}
                <div class="form-card">
                    <div class="form-card-header">
                        <div class="fch-icon purple"><i class="fas fa-list-check"></i></div>
                        <div>
                            <div class="fch-title">Fasilitas</div>
                            <div class="fch-sub">Apa saja yang termasuk dalam paket</div>
                        </div>
                    </div>
                    <div class="form-card-body">
                        <div class="facility-builder">
                            <ul class="facility-list-edit" id="facilityList"></ul>
                            <div class="facility-empty" id="facilityEmpty">
                                Belum ada fasilitas — tambahkan di bawah
                            </div>
                            <div class="facility-add-row">
                                <input type="text" id="facilityInput"
                                       placeholder="Tambah fasilitas baru..."
                                       onkeydown="if(event.key==='Enter'){event.preventDefault();addFacility();}">
                                <button type="button" class="facility-add-btn" onclick="addFacility()">
                                    <i class="fas fa-plus"></i> Tambah
                                </button>
                            </div>
                        </div>
                        <div class="field-hint mt-2">
                            <i class="fas fa-info-circle"></i>
                            Tekan Enter atau klik Tambah untuk menambahkan fasilitas
                        </div>
                        @error('facilities')
                            <div class="invalid-msg mt-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

            </div>

            {{-- ── KANAN: SIDEBAR ── --}}
            <div>
                <div class="info-card">
                    <div class="info-card-header">
                        <div class="fch-icon blue"><i class="fas fa-info-circle"></i></div>
                        <div>
                            <div class="fch-title">Info Paket</div>
                            <div class="fch-sub">Data saat ini</div>
                        </div>
                    </div>
                    <div class="info-card-body">

                        {{-- Current data --}}
                        <div class="pkg-meta">
                            <div class="pkg-meta-row">
                                <span>Nama</span>
                                <span>{{ Str::limit($package->name, 20) }}</span>
                            </div>
                            <div class="pkg-meta-row">
                                <span>Tipe</span>
                                <span>{{ $package->type }}</span>
                            </div>
                            <div class="pkg-meta-row">
                                <span>Harga</span>
                                <span>Rp {{ number_format($package->price, 0, ',', '.') }}</span>
                            </div>
                            <div class="pkg-meta-row">
                                <span>Durasi</span>
                                <span>{{ $package->duration }}</span>
                            </div>
                            <div class="pkg-meta-row">
                                <span>Fasilitas</span>
                                <span>{{ is_array($package->facilities) ? count($package->facilities) : 0 }} item</span>
                            </div>
                        </div>

                        <div class="info-tip">
                            <div class="tip-icon" style="background:#FEF3C7; color:#D97706;">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <div class="tip-text">
                                <strong>Perhatian</strong>
                                Perubahan akan langsung aktif setelah disimpan.
                            </div>
                        </div>

                        <div class="info-tip">
                            <div class="tip-icon" style="background:#D1FAE5; color:#059669;">
                                <i class="fas fa-money-bill-wave"></i>
                            </div>
                            <div class="tip-text">
                                <strong>Update Harga</strong>
                                Pastikan harga baru sudah disetujui sebelum menyimpan.
                            </div>
                        </div>

                        {{-- Price preview --}}
                        <div class="price-preview" id="pricePreview">
                            <div class="pp-label">Harga Baru</div>
                            <div class="pp-value" id="ppValue">
                                Rp {{ number_format($package->price, 0, ',', '.') }}
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>

        {{-- ACTION BAR --}}
        <div class="action-bar">
            <div class="ab-hint">
                <i class="fas fa-asterisk" style="color:#DC2626; font-size:0.6rem;"></i>
                Kolom bertanda wajib diisi
            </div>
            <div class="ab-buttons">
                <a href="{{ route('studio.packages.index') }}" class="btn-cancel">
                    <i class="fas fa-times"></i> Batal
                </a>
                <button type="submit" class="btn-save">
                    <i class="fas fa-save"></i> Update Paket
                </button>
            </div>
        </div>

    </form>

@stop

@push('js')
<script>
    /* ── FASILITAS BUILDER ── */
    var facilities = [];

    @php
        $existingFacilities = old('facilities')
            ? array_filter(array_map('trim', explode("\n", old('facilities'))))
            : (is_array($package->facilities) ? $package->facilities : []);
    @endphp

    facilities = {!! json_encode(array_values($existingFacilities)) !!};

    function renderFacilities() {
        var list  = document.getElementById('facilityList');
        var empty = document.getElementById('facilityEmpty');
        list.innerHTML = '';

        if (facilities.length === 0) {
            empty.style.display = 'block';
        } else {
            empty.style.display = 'none';
            facilities.forEach(function (item, idx) {
                var li = document.createElement('li');
                li.className = 'facility-item-edit';
                li.innerHTML =
                    '<i class="fas fa-check-circle fi-icon"></i>' +
                    '<span class="fi-text">' + escHtml(item) + '</span>' +
                    '<button type="button" class="fi-remove" onclick="removeFacility(' + idx + ')" title="Hapus">' +
                    '<i class="fas fa-times"></i></button>';
                list.appendChild(li);
            });
        }

        document.getElementById('facilitiesHidden').value = facilities.join('\n');
    }

    function addFacility() {
        var input = document.getElementById('facilityInput');
        var val   = input.value.trim();
        if (!val) return;
        facilities.push(val);
        input.value = '';
        input.focus();
        renderFacilities();
    }

    function removeFacility(idx) {
        facilities.splice(idx, 1);
        renderFacilities();
    }

    function escHtml(str) {
        return str.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
    }

    /* ── PRICE PREVIEW ── */
    function updatePricePreview(val) {
        var ppVal = document.getElementById('ppValue');
        var num   = parseInt(val, 10);
        ppVal.textContent = (!isNaN(num) && num >= 0)
            ? 'Rp ' + num.toLocaleString('id-ID')
            : 'Rp 0';
    }

    /* Init */
    document.addEventListener('DOMContentLoaded', function () {
        renderFacilities();
        var priceInput = document.getElementById('price');
        if (priceInput && priceInput.value) updatePricePreview(priceInput.value);
    });
</script>
@endpush