@extends('adminlte::page')

@section('title', 'Tambah Paket Foto')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="mb-0" style="font-size: 1.4rem; font-weight: 700; color: #0D1B2A;">
                <i class="fas fa-camera me-2" style="color: #0E7A96;"></i> Tambah Paket Fotografi
            </h1>
            <ol class="breadcrumb mb-0 mt-1" style="font-size: 0.8rem; background: transparent; padding: 0;">
                <li class="breadcrumb-item"><a href="{{ route('studio.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('studio.photo-packages.index') }}">Paket Foto</a></li>
                <li class="breadcrumb-item active">Tambah</li>
            </ol>
        </div>
        <a href="{{ route('studio.photo-packages.index') }}"
           style="display:inline-flex; align-items:center; gap:7px; background:#64748B; color:#fff; padding:10px 22px; border-radius:50px; font-weight:700; font-size:0.88rem; text-decoration:none; transition:all 0.3s;">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
@stop

@push('css')
<style>
    /* ============================================
       ALERT
       ============================================ */
    .alert-error-custom {
        border-radius: 12px;
        border: none;
        background: #FEE2E2;
        color: #991B1B;
        font-size: 0.88rem;
        padding: 12px 18px;
        display: flex;
        align-items: flex-start;
        gap: 8px;
        margin-bottom: 20px;
    }
    .alert-error-custom ul { margin: 4px 0 0 0; padding-left: 18px; }

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
    .form-card-header {
        background: #F8FAFC;
        border-bottom: 1px solid #F1F5F9;
        padding: 16px 24px;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .form-card-header-icon {
        width: 36px;
        height: 36px;
        background: rgba(14,122,150,0.1);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #0E7A96;
        font-size: 0.9rem;
        flex-shrink: 0;
    }
    .form-card-header-title    { font-size: 0.92rem; font-weight: 700; color: #0D1B2A; margin: 0; }
    .form-card-header-subtitle { font-size: 0.75rem; color: #94A3B8; margin: 1px 0 0; }
    .form-card-body            { padding: 24px; }

    /* ============================================
       FORM ELEMENTS
       ============================================ */
    .custom-label {
        font-size: 0.82rem;
        font-weight: 700;
        color: #374151;
        margin-bottom: 7px;
        display: flex;
        align-items: center;
        gap: 5px;
    }
    .custom-label .req { color: #EF4444; font-size: 0.78rem; }
    .custom-label i    { color: #CBD5E1; font-size: 0.78rem; }
    .custom-label .opt { font-size: 0.72rem; color: #94A3B8; font-weight: 500; }

    .custom-input,
    .custom-textarea {
        width: 100%;
        border: 1.5px solid #E2E8F0;
        border-radius: 10px;
        padding: 10px 14px;
        font-size: 0.88rem;
        color: #0D1B2A;
        background: #F8FAFC;
        transition: border-color 0.2s, background 0.2s, box-shadow 0.2s;
        outline: none;
    }
    .custom-input:focus,
    .custom-textarea:focus {
        border-color: #0E7A96;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(14,122,150,0.08);
    }
    .custom-input.is-invalid,
    .custom-textarea.is-invalid {
        border-color: #EF4444;
        background: #FFF9F9;
    }
    .custom-textarea { resize: vertical; min-height: 80px; }

    /* Price input with prefix */
    .input-prefix-wrap {
        display: flex;
        align-items: stretch;
        border: 1.5px solid #E2E8F0;
        border-radius: 10px;
        overflow: hidden;
        background: #F8FAFC;
        transition: border-color 0.2s, box-shadow 0.2s;
    }
    .input-prefix-wrap:focus-within {
        border-color: #0E7A96;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(14,122,150,0.08);
    }
    .input-prefix-wrap.is-invalid { border-color: #EF4444; }
    .input-prefix {
        padding: 10px 14px;
        background: #F1F5F9;
        color: #64748B;
        font-size: 0.85rem;
        font-weight: 700;
        border-right: 1.5px solid #E2E8F0;
        white-space: nowrap;
        display: flex;
        align-items: center;
    }
    .input-prefix-wrap input {
        flex: 1;
        border: none;
        outline: none;
        padding: 10px 14px;
        font-size: 0.88rem;
        color: #0D1B2A;
        background: transparent;
        min-width: 0;
    }

    .custom-error {
        font-size: 0.76rem;
        color: #EF4444;
        margin-top: 5px;
        display: flex;
        align-items: center;
        gap: 4px;
    }
    .custom-hint {
        font-size: 0.75rem;
        color: #94A3B8;
        margin-top: 5px;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    /* ============================================
       FORM GRID
       ============================================ */
    .form-grid-2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }
    @media (max-width: 640px) {
        .form-grid-2 { grid-template-columns: 1fr; }
        .form-card-body { padding: 16px; }
        .form-actions   { padding: 16px; }
    }

    /* ============================================
       FEATURES TAGS
       ============================================ */
    .features-preview {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        margin-top: 10px;
        min-height: 28px;
    }
    .feature-tag {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 4px 10px;
        background: rgba(14,122,150,0.08);
        color: #0E7A96;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
        border: 1px solid rgba(14,122,150,0.15);
    }
    .feature-tag i { font-size: 0.65rem; }

    /* ============================================
       POPULAR TOGGLE
       ============================================ */
    .toggle-card {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 14px 16px;
        background: #F8FAFC;
        border: 1.5px solid #E2E8F0;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.2s;
        user-select: none;
    }
    .toggle-card:hover { border-color: #0E7A96; background: #EEF9FC; }
    .toggle-card.active {
        border-color: #0E7A96;
        background: rgba(14,122,150,0.05);
    }
    .toggle-card-left {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .toggle-card-icon {
        width: 38px;
        height: 38px;
        background: rgba(245,158,11,0.1);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #F59E0B;
        font-size: 1rem;
        flex-shrink: 0;
    }
    .toggle-card.active .toggle-card-icon {
        background: rgba(245,158,11,0.18);
    }
    .toggle-card-title {
        font-size: 0.88rem;
        font-weight: 700;
        color: #0D1B2A;
        margin: 0 0 2px;
    }
    .toggle-card-desc {
        font-size: 0.75rem;
        color: #94A3B8;
        margin: 0;
    }

    /* Custom switch */
    .custom-switch-wrap {
        position: relative;
        width: 44px;
        height: 24px;
        flex-shrink: 0;
    }
    .custom-switch-wrap input { opacity: 0; width: 0; height: 0; position: absolute; }
    .switch-track {
        position: absolute;
        inset: 0;
        background: #CBD5E1;
        border-radius: 50px;
        transition: background 0.2s;
        cursor: pointer;
    }
    .switch-track::after {
        content: '';
        position: absolute;
        top: 3px;
        left: 3px;
        width: 18px;
        height: 18px;
        background: #fff;
        border-radius: 50%;
        transition: transform 0.2s;
        box-shadow: 0 1px 4px rgba(0,0,0,0.15);
    }
    .custom-switch-wrap input:checked + .switch-track {
        background: #0E7A96;
    }
    .custom-switch-wrap input:checked + .switch-track::after {
        transform: translateX(20px);
    }

    /* ============================================
       ACTION BUTTONS
       ============================================ */
    .form-actions {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 20px 24px;
        background: #F8FAFC;
        border-top: 1px solid #F1F5F9;
        flex-wrap: wrap;
    }
    .btn-save {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: #0E7A96;
        color: #fff;
        padding: 11px 26px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.88rem;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
    }
    .btn-save:hover {
        background: #0a6278;
        color: #fff;
        transform: translateY(-1px);
        box-shadow: 0 6px 18px rgba(14,122,150,0.28);
    }
    .btn-cancel {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: transparent;
        color: #64748B;
        padding: 11px 22px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.88rem;
        border: 1.5px solid #E2E8F0;
        cursor: pointer;
        transition: all 0.2s;
        text-decoration: none;
    }
    .btn-cancel:hover {
        background: #F1F5F9;
        color: #0D1B2A;
        text-decoration: none;
    }

    /* ============================================
       PRICE PREVIEW
       ============================================ */
    .price-preview {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        margin-top: 7px;
        font-size: 0.8rem;
        color: #059669;
        font-weight: 600;
    }
    .price-preview i { font-size: 0.72rem; }
</style>
@endpush

@section('content')

    {{-- Validation Errors --}}
    @if($errors->any())
        <div class="alert-error-custom">
            <i class="fas fa-exclamation-circle" style="flex-shrink:0; margin-top:2px;"></i>
            <div>
                <strong>Terdapat kesalahan pada form:</strong>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <form action="{{ route('studio.photo-packages.store') }}" method="POST" id="packageForm">
        @csrf

        {{-- ─── INFORMASI PAKET ─── --}}
        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-header-icon"><i class="fas fa-box-open"></i></div>
                <div>
                    <p class="form-card-header-title">Informasi Paket</p>
                    <p class="form-card-header-subtitle">Nama, harga, dan durasi sesi foto</p>
                </div>
            </div>
            <div class="form-card-body">

                {{-- Nama Paket --}}
                <div class="form-group" style="margin-bottom: 20px;">
                    <label class="custom-label" for="name">
                        <i class="fas fa-tag"></i> Nama Paket <span class="req">*</span>
                    </label>
                    <input type="text"
                           class="custom-input @error('name') is-invalid @enderror"
                           id="name" name="name"
                           value="{{ old('name') }}"
                           placeholder="Contoh: Paket Foto Gaya Bebas"
                           required>
                    @error('name')
                        <div class="custom-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>

                <div class="form-grid-2" style="margin-bottom: 20px;">

                    {{-- Harga --}}
                    <div>
                        <label class="custom-label" for="price">
                            <i class="fas fa-money-bill-wave"></i> Harga <span class="req">*</span>
                        </label>
                        <div class="input-prefix-wrap @error('price') is-invalid @enderror">
                            <span class="input-prefix">Rp</span>
                            <input type="number"
                                   id="price" name="price"
                                   value="{{ old('price') }}"
                                   placeholder="40000"
                                   min="0"
                                   oninput="updatePricePreview(this.value)"
                                   required>
                        </div>
                        <div id="pricePreview" class="price-preview" style="display:none;">
                            <i class="fas fa-check-circle"></i>
                            <span id="priceFormatted"></span>
                        </div>
                        @error('price')
                            <div class="custom-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Durasi --}}
                    <div>
                        <label class="custom-label" for="duration">
                            <i class="fas fa-clock"></i> Durasi <span class="req">*</span>
                        </label>
                        <input type="text"
                               class="custom-input @error('duration') is-invalid @enderror"
                               id="duration" name="duration"
                               value="{{ old('duration') }}"
                               placeholder="Contoh: 1 jam sesi"
                               required>
                        @error('duration')
                            <div class="custom-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                </div>

                {{-- Deskripsi --}}
                <div style="margin-bottom: 0;">
                    <label class="custom-label" for="description">
                        <i class="fas fa-align-left"></i> Deskripsi
                        <span class="opt">(opsional)</span>
                    </label>
                    <textarea class="custom-textarea @error('description') is-invalid @enderror"
                              id="description" name="description"
                              rows="3"
                              placeholder="Deskripsi singkat tentang paket ini...">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="custom-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>

            </div>
        </div>

        {{-- ─── FITUR PAKET ─── --}}
        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-header-icon"><i class="fas fa-list-check"></i></div>
                <div>
                    <p class="form-card-header-title">Fitur Paket</p>
                    <p class="form-card-header-subtitle">Daftar keuntungan yang didapat pelanggan</p>
                </div>
            </div>
            <div class="form-card-body">

                <label class="custom-label" for="features">
                    <i class="fas fa-star"></i> Daftar Fitur
                    <span class="opt">(opsional)</span>
                </label>
                <textarea class="custom-textarea @error('features') is-invalid @enderror"
                          id="features" name="features"
                          rows="4"
                          placeholder="foto gaya bebas, durasi 1 jam, soft file delivery, 20 foto pilihan"
                          oninput="renderFeatureTags(this.value)">{{ old('features') }}</textarea>
                <div class="custom-hint">
                    <i class="fas fa-info-circle"></i>
                    Pisahkan setiap fitur dengan koma (,)
                </div>
                @error('features')
                    <div class="custom-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                @enderror

                {{-- Live tag preview --}}
                <div id="featuresPreview" class="features-preview"></div>

            </div>
        </div>

        {{-- ─── PENGATURAN ─── --}}
        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-header-icon"><i class="fas fa-sliders-h"></i></div>
                <div>
                    <p class="form-card-header-title">Pengaturan</p>
                    <p class="form-card-header-subtitle">Visibilitas dan label khusus paket</p>
                </div>
            </div>
            <div class="form-card-body">

                <label class="toggle-card {{ old('is_popular') ? 'active' : '' }}"
                       for="is_popular" id="popularToggleCard">
                    <div class="toggle-card-left">
                        <div class="toggle-card-icon">
                            <i class="fas fa-fire"></i>
                        </div>
                        <div>
                            <p class="toggle-card-title">Paket Populer</p>
                            <p class="toggle-card-desc">Paket ini akan ditampilkan dengan label "Populer" di halaman publik</p>
                        </div>
                    </div>
                    <div class="custom-switch-wrap">
                        <input type="checkbox"
                               id="is_popular" name="is_popular" value="1"
                               {{ old('is_popular') ? 'checked' : '' }}
                               onchange="togglePopularCard(this)">
                        <span class="switch-track"></span>
                    </div>
                </label>

            </div>
        </div>

        {{-- ─── ACTIONS ─── --}}
        <div class="form-card">
            <div class="form-actions">
                <button type="submit" class="btn-save">
                    <i class="fas fa-save"></i> Simpan Paket
                </button>
                <a href="{{ route('studio.photo-packages.index') }}" class="btn-cancel">
                    <i class="fas fa-times"></i> Batal
                </a>
            </div>
        </div>

    </form>

@stop

@push('js')
<script>
    // ── Price formatted preview ───────────────────────────
    function updatePricePreview(val) {
        var preview   = document.getElementById('pricePreview');
        var formatted = document.getElementById('priceFormatted');
        if (!val || isNaN(val) || parseInt(val) <= 0) {
            preview.style.display = 'none';
            return;
        }
        var num = parseInt(val).toLocaleString('id-ID');
        formatted.textContent = 'Rp ' + num;
        preview.style.display = 'inline-flex';
    }

    // ── Feature tag live preview ──────────────────────────
    function renderFeatureTags(val) {
        var container = document.getElementById('featuresPreview');
        var items = val.split(',').map(function(s){ return s.trim(); }).filter(Boolean);
        container.innerHTML = '';
        items.forEach(function(item) {
            var tag = document.createElement('span');
            tag.className = 'feature-tag';
            tag.innerHTML = '<i class="fas fa-check"></i>' + item;
            container.appendChild(tag);
        });
    }

    // ── Popular toggle card highlight ─────────────────────
    function togglePopularCard(input) {
        var card = document.getElementById('popularToggleCard');
        if (input.checked) {
            card.classList.add('active');
        } else {
            card.classList.remove('active');
        }
    }

    // ── Run on load for old() values ─────────────────────
    var featuresEl = document.getElementById('features');
    if (featuresEl && featuresEl.value) renderFeatureTags(featuresEl.value);

    var priceEl = document.getElementById('price');
    if (priceEl && priceEl.value) updatePricePreview(priceEl.value);
</script>
@endpush