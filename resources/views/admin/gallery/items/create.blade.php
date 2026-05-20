@extends('adminlte::page')

@section('title', 'Tambah Item ke ' . $album->name)

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="mb-0" style="font-size: 1.4rem; font-weight: 700; color: #0D1B2A;">
                <i class="fas fa-cloud-upload-alt me-2" style="color: #0E7A96;"></i> Tambah Item
            </h1>
            <ol class="breadcrumb mb-0 mt-1" style="font-size: 0.8rem; background: transparent; padding: 0;">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.albums.index') }}">Album</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.albums.items.index', $album) }}">{{ $album->name }}</a></li>
                <li class="breadcrumb-item active">Tambah Item</li>
            </ol>
        </div>
        <a href="{{ route('admin.albums.items.index', $album) }}"
           style="display:inline-flex; align-items:center; gap:7px; background:#F8FAFC; color:#64748B; padding:10px 22px; border-radius:50px; font-weight:700; font-size:0.88rem; text-decoration:none; border:1.5px solid #E2E8F0; transition:all 0.3s;">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
@stop

@push('css')
<style>
    /* ============================================
       LAYOUT
       ============================================ */
    .page-grid {
        display: grid;
        grid-template-columns: 1fr 320px;
        gap: 20px;
        align-items: start;
    }
    @media (max-width: 900px) {
        .page-grid { grid-template-columns: 1fr; }
    }

    /* ============================================
       SECTION CARD
       ============================================ */
    .section-card {
        background: #fff;
        border: 1px solid #E2E8F0;
        border-radius: 20px;
        overflow: hidden;
        margin-bottom: 20px;
    }
    .section-card:last-child { margin-bottom: 0; }
    .section-card-header {
        padding: 16px 24px;
        border-bottom: 1px solid #F1F5F9;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .section-card-header .icon-wrap {
        width: 34px; height: 34px;
        background: rgba(14,122,150,0.09);
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        color: #0E7A96; font-size: 0.85rem; flex-shrink: 0;
    }
    .section-card-header h6 {
        margin: 0; font-size: 0.88rem; font-weight: 700; color: #0D1B2A;
    }
    .section-card-body { padding: 24px; }

    /* ============================================
       FORM FIELDS
       ============================================ */
    .field-group { margin-bottom: 18px; }
    .field-group:last-child { margin-bottom: 0; }

    .field-label {
        display: block;
        font-size: 0.78rem; font-weight: 700;
        text-transform: uppercase; letter-spacing: 0.06em;
        color: #94A3B8; margin-bottom: 7px;
    }
    .field-label .req { color: #EF4444; margin-left: 2px; }

    .field-input {
        width: 100%;
        border: 1.5px solid #E2E8F0; border-radius: 10px;
        padding: 10px 14px; font-size: 0.88rem;
        color: #0D1B2A; background: #F8FAFC; outline: none;
        transition: border-color 0.2s, background 0.2s, box-shadow 0.2s;
        box-sizing: border-box;
    }
    .field-input:focus {
        border-color: #0E7A96; background: #fff;
        box-shadow: 0 0 0 3px rgba(14,122,150,0.10);
    }
    .field-input.is-invalid { border-color: #EF4444; background: #FFF5F5; }

    select.field-input {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2394A3B8' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 12px center;
        padding-right: 32px; cursor: pointer;
    }

    .invalid-msg {
        font-size: 0.76rem; color: #EF4444;
        margin-top: 5px; display: flex; align-items: center; gap: 4px;
    }
    .field-hint { font-size: 0.76rem; color: #94A3B8; margin-top: 5px; margin-bottom: 0; }

    /* ============================================
       TYPE TOGGLE
       ============================================ */
    .type-toggle {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
    }
    .type-option { display: none; }
    .type-option-label {
        display: flex; flex-direction: column;
        align-items: center; justify-content: center;
        gap: 8px; padding: 18px 12px;
        border: 2px solid #E2E8F0; border-radius: 14px;
        cursor: pointer; background: #F8FAFC;
        transition: all 0.2s; text-align: center;
    }
    .type-option-label .type-icon {
        font-size: 1.6rem; line-height: 1;
    }
    .type-option-label .type-label {
        font-size: 0.82rem; font-weight: 700; color: #64748B;
    }
    .type-option-label .type-sub {
        font-size: 0.72rem; color: #94A3B8;
    }
    .type-option:checked + .type-option-label {
        border-color: #0E7A96;
        background: rgba(14,122,150,0.06);
    }
    .type-option:checked + .type-option-label .type-label { color: #0E7A96; }
    .type-option-label:hover { border-color: #0E7A96; background: rgba(14,122,150,0.04); }

    /* ============================================
       FILE DROP ZONE
       ============================================ */
    .drop-zone {
        border: 2px dashed #CBD5E1;
        border-radius: 14px;
        padding: 36px 20px;
        text-align: center;
        background: #F8FAFC;
        cursor: pointer;
        transition: all 0.25s;
        position: relative;
    }
    .drop-zone:hover, .drop-zone.dragover {
        border-color: #0E7A96;
        background: rgba(14,122,150,0.04);
    }
    .drop-zone input[type="file"] {
        position: absolute; inset: 0;
        opacity: 0; cursor: pointer; width: 100%; height: 100%;
    }
    .drop-zone .dz-icon {
        font-size: 2rem; color: #CBD5E1; margin-bottom: 10px;
        transition: color 0.2s;
    }
    .drop-zone:hover .dz-icon { color: #0E7A96; }
    .drop-zone .dz-title {
        font-size: 0.9rem; font-weight: 700; color: #64748B; margin-bottom: 4px;
    }
    .drop-zone .dz-sub { font-size: 0.76rem; color: #94A3B8; }
    .drop-zone.has-file { border-color: #10B981; background: rgba(16,185,129,0.04); }
    .drop-zone.has-file .dz-icon { color: #10B981; }

    .file-selected-info {
        display: none;
        align-items: center; gap: 10px;
        padding: 10px 14px;
        background: rgba(16,185,129,0.08);
        border: 1.5px solid rgba(16,185,129,0.25);
        border-radius: 10px; margin-top: 10px;
    }
    .file-selected-info.visible { display: flex; }
    .file-selected-info i { color: #10B981; }
    .file-selected-info span { font-size: 0.82rem; font-weight: 600; color: #065F46; }

    /* ============================================
       INFO BOX
       ============================================ */
    .info-box-custom {
        display: flex; gap: 12px;
        padding: 14px 16px;
        background: rgba(14,122,150,0.06);
        border: 1px solid rgba(14,122,150,0.15);
        border-left: 3px solid #0E7A96;
        border-radius: 10px;
        margin-top: 4px;
    }
    .info-box-custom i { color: #0E7A96; font-size: 0.9rem; margin-top: 1px; flex-shrink: 0; }
    .info-box-custom ul {
        margin: 6px 0 0 0; padding-left: 16px;
        font-size: 0.78rem; color: #475569; line-height: 1.8;
    }
    .info-box-custom p { font-size: 0.82rem; font-weight: 700; color: #0E7A96; margin: 0; }

    /* ============================================
       ALBUM INFO SIDEBAR
       ============================================ */
    .album-cover {
        width: 100%; aspect-ratio: 16/9;
        border-radius: 14px; object-fit: cover;
        border: 1px solid #E2E8F0;
        display: block;
    }
    .album-cover-placeholder {
        width: 100%; aspect-ratio: 16/9;
        border-radius: 14px;
        background: linear-gradient(135deg, #EEF9FC, #D6EEF5);
        display: flex; align-items: center; justify-content: center;
        color: #0E7A96; font-size: 2.5rem; opacity: 0.5;
        border: 1px solid #E2E8F0;
    }

    .album-meta-row {
        display: flex; align-items: center; justify-content: space-between;
        padding: 10px 0; border-bottom: 1px solid #F1F5F9;
        font-size: 0.82rem;
    }
    .album-meta-row:last-child { border-bottom: none; padding-bottom: 0; }
    .album-meta-row .meta-key { color: #94A3B8; font-weight: 600; }
    .album-meta-row .meta-val { color: #0D1B2A; font-weight: 700; text-align: right; }

    .capacity-bar {
        height: 6px; border-radius: 99px;
        background: #E2E8F0; overflow: hidden; margin-top: 6px;
    }
    .capacity-fill {
        height: 100%; border-radius: 99px;
        background: #0E7A96; transition: width 0.4s;
    }
    .capacity-fill.warn { background: #F59E0B; }
    .capacity-fill.full { background: #EF4444; }

    .badge-count {
        display: inline-flex; align-items: center; gap: 5px;
        padding: 4px 10px;
        border-radius: 50px; font-size: 0.75rem; font-weight: 700;
    }
    .badge-count.ok   { background: rgba(14,122,150,0.10); color: #0E7A96; }
    .badge-count.warn { background: rgba(245,158,11,0.12); color: #D97706; }
    .badge-count.full { background: rgba(239,68,68,0.10);  color: #DC2626; }

    /* ============================================
       BULK UPLOAD BUTTON
       ============================================ */
    .btn-bulk {
        display: flex; align-items: center; justify-content: center; gap: 8px;
        width: 100%; padding: 11px 16px;
        background: rgba(14,122,150,0.08); color: #0E7A96;
        border: 1.5px solid rgba(14,122,150,0.25); border-radius: 50px;
        font-size: 0.85rem; font-weight: 700; cursor: pointer;
        transition: all 0.2s; text-decoration: none;
    }
    .btn-bulk:hover {
        background: #0E7A96; color: #fff; border-color: #0E7A96;
        text-decoration: none;
    }

    /* ============================================
       ACTION BAR
       ============================================ */
    .action-bar {
        background: #fff; border: 1px solid #E2E8F0;
        border-radius: 16px; padding: 18px 24px;
        display: flex; align-items: center;
        justify-content: space-between; gap: 12px;
        margin-top: 20px; flex-wrap: wrap;
    }
    .action-bar .left-info {
        font-size: 0.82rem; color: #94A3B8;
        display: flex; align-items: center; gap: 8px;
    }
    .action-bar .left-info i { color: #CBD5E1; }
    .btn-save {
        display: inline-flex; align-items: center; gap: 8px;
        background: #0E7A96; color: #fff; padding: 11px 28px;
        border-radius: 50px; font-weight: 700; font-size: 0.88rem;
        border: none; cursor: pointer; transition: all 0.25s;
        box-shadow: 0 4px 14px rgba(14,122,150,0.28);
    }
    .btn-save:hover {
        background: #0a5a70; color: #fff;
        box-shadow: 0 6px 20px rgba(14,122,150,0.38);
        transform: translateY(-1px);
    }
    .btn-cancel {
        display: inline-flex; align-items: center; gap: 7px;
        background: #F8FAFC; color: #64748B; padding: 11px 22px;
        border-radius: 50px; font-weight: 700; font-size: 0.88rem;
        border: 1.5px solid #E2E8F0; text-decoration: none;
        transition: all 0.2s;
    }
    .btn-cancel:hover { background: #F1F5F9; color: #0D1B2A; text-decoration: none; }

    /* ============================================
       MODAL
       ============================================ */
    .modal-custom .modal-content {
        border: none; border-radius: 20px; overflow: hidden;
        box-shadow: 0 20px 60px rgba(0,0,0,0.15);
    }
    .modal-custom .modal-header {
        background: #F8FAFC; border-bottom: 1px solid #F1F5F9;
        padding: 18px 24px;
    }
    .modal-custom .modal-title {
        font-size: 0.95rem; font-weight: 700; color: #0D1B2A;
        display: flex; align-items: center; gap: 8px;
    }
    .modal-custom .modal-title .icon-wrap {
        width: 30px; height: 30px;
        background: rgba(14,122,150,0.09); border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        color: #0E7A96; font-size: 0.8rem;
    }
    .modal-custom .modal-body { padding: 24px; }
    .modal-custom .modal-footer {
        padding: 16px 24px; border-top: 1px solid #F1F5F9;
        background: #F8FAFC; gap: 10px;
    }
    .btn-modal-submit {
        display: inline-flex; align-items: center; gap: 7px;
        background: #0E7A96; color: #fff; padding: 10px 24px;
        border-radius: 50px; font-weight: 700; font-size: 0.85rem;
        border: none; cursor: pointer; transition: all 0.2s;
        box-shadow: 0 4px 12px rgba(14,122,150,0.25);
    }
    .btn-modal-submit:hover { background: #0a5a70; }
    .btn-modal-submit:disabled { opacity: 0.5; cursor: not-allowed; }
    .btn-modal-cancel {
        display: inline-flex; align-items: center; gap: 7px;
        background: #F1F5F9; color: #64748B; padding: 10px 20px;
        border-radius: 50px; font-weight: 700; font-size: 0.85rem;
        border: 1.5px solid #E2E8F0; cursor: pointer; transition: all 0.2s;
    }
    .btn-modal-cancel:hover { background: #E2E8F0; }

    .warn-box {
        display: flex; gap: 10px; padding: 12px 14px;
        background: rgba(245,158,11,0.08);
        border: 1px solid rgba(245,158,11,0.25);
        border-left: 3px solid #F59E0B;
        border-radius: 10px; margin-top: 4px;
    }
    .warn-box i { color: #F59E0B; flex-shrink: 0; margin-top: 1px; }
    .warn-box span { font-size: 0.80rem; color: #92400E; font-weight: 600; }
</style>
@endpush

@section('content')

    <form action="{{ route('admin.albums.items.store', $album) }}" method="POST" enctype="multipart/form-data" id="mainForm">
        @csrf

        <div class="page-grid">

            {{-- ==================== KOLOM KIRI ==================== --}}
            <div>

                {{-- Tipe Item --}}
                <div class="section-card">
                    <div class="section-card-header">
                        <div class="icon-wrap"><i class="fas fa-th-large"></i></div>
                        <h6>Tipe Item <span style="color:#EF4444;">*</span></h6>
                    </div>
                    <div class="section-card-body">
                        <div class="type-toggle">
                            <input type="radio" class="type-option" name="type" id="type_foto"
                                   value="foto" {{ old('type', 'foto') == 'foto' ? 'checked' : '' }}>
                            <label class="type-option-label" for="type_foto">
                                <span class="type-icon">📷</span>
                                <span class="type-label">Foto</span>
                                <span class="type-sub">JPG, PNG, GIF</span>
                            </label>

                            <input type="radio" class="type-option" name="type" id="type_video"
                                   value="video" {{ old('type') == 'video' ? 'checked' : '' }}>
                            <label class="type-option-label" for="type_video">
                                <span class="type-icon">🎬</span>
                                <span class="type-label">Video</span>
                                <span class="type-sub">MP4, MOV, AVI</span>
                            </label>
                        </div>
                        @error('type')
                            <div class="invalid-msg mt-2"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Upload File --}}
                <div class="section-card">
                    <div class="section-card-header">
                        <div class="icon-wrap"><i class="fas fa-cloud-upload-alt"></i></div>
                        <h6>Upload File <span style="color:#EF4444;">*</span></h6>
                    </div>
                    <div class="section-card-body">
                        <div class="field-group">
                            <div class="drop-zone @error('file') has-file @enderror" id="dropZone">
                                <input type="file" id="file" name="file"
                                       required accept="image/*,video/*"
                                       onchange="handleFileSelect(this)">
                                <div class="dz-icon"><i class="fas fa-cloud-upload-alt"></i></div>
                                <div class="dz-title">Klik atau seret file ke sini</div>
                                <div class="dz-sub" id="dzSub">Foto & video didukung · maks 20MB</div>
                            </div>
                            <div class="file-selected-info" id="fileInfo">
                                <i class="fas fa-check-circle"></i>
                                <span id="fileInfoName">—</span>
                            </div>
                            @error('file')
                                <div class="invalid-msg mt-2"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Caption --}}
                        <div class="field-group" style="margin-bottom:0;">
                            <label class="field-label" for="caption">Caption</label>
                            <input type="text" id="caption" name="caption"
                                   class="field-input @error('caption') is-invalid @enderror"
                                   value="{{ old('caption') }}"
                                   placeholder="Deskripsi singkat foto/video (opsional)"
                                   maxlength="255">
                            <p class="field-hint">Maksimal 255 karakter.</p>
                            @error('caption')
                                <div class="invalid-msg"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Info Box --}}
                <div class="info-box-custom">
                    <i class="fas fa-info-circle mt-1"></i>
                    <div>
                        <p>Ketentuan Upload</p>
                        <ul>
                            <li>Foto dan Video maksimal <strong>20MB</strong> per file</li>
                            <li>Format didukung: JPG, PNG, GIF, MP4, MOV, AVI</li>
                            <li>Maksimal <strong>100 item</strong> per album</li>
                            <li>File disimpan langsung di server</li>
                        </ul>
                    </div>
                </div>

            </div>

            {{-- ==================== KOLOM KANAN (SIDEBAR) ==================== --}}
            <div>

                {{-- Info Album --}}
                <div class="section-card">
                    <div class="section-card-header">
                        <div class="icon-wrap"><i class="fas fa-images"></i></div>
                        <h6>Info Album</h6>
                    </div>
                    <div class="section-card-body">

                        {{-- Cover --}}
                        <div style="margin-bottom:18px;">
                            @if($album->cover_image)
                                <img src="{{ asset('storage/' . $album->cover_image) }}"
                                     alt="{{ $album->name }}" class="album-cover">
                            @else
                                <div class="album-cover-placeholder">
                                    <i class="fas fa-images"></i>
                                </div>
                            @endif
                        </div>

                        {{-- Meta --}}
                        <div>
                            <div class="album-meta-row">
                                <span class="meta-key">Nama</span>
                                <span class="meta-val">{{ $album->name }}</span>
                            </div>
                            <div class="album-meta-row">
                                <span class="meta-key">Tahun</span>
                                <span class="meta-val">{{ $album->year }}</span>
                            </div>
                            @if($album->description)
                            <div class="album-meta-row" style="align-items:flex-start;">
                                <span class="meta-key">Deskripsi</span>
                                <span class="meta-val" style="font-weight:500; font-size:0.78rem; color:#64748B; max-width:160px;">{{ $album->description }}</span>
                            </div>
                            @endif
                            <div class="album-meta-row" style="flex-direction:column; align-items:flex-start; gap:8px;">
                                <div style="display:flex; justify-content:space-between; width:100%;">
                                    <span class="meta-key">Kapasitas</span>
                                    @php
                                        $count = $album->items->count();
                                        $pct   = min(100, round($count / 100 * 100));
                                        $cls   = $pct >= 100 ? 'full' : ($pct >= 80 ? 'warn' : 'ok');
                                    @endphp
                                    <span class="badge-count {{ $cls }}">
                                        <i class="fas fa-photo-video" style="font-size:0.65rem;"></i>
                                        {{ $count }} / 100
                                    </span>
                                </div>
                                <div class="capacity-bar" style="width:100%;">
                                    <div class="capacity-fill {{ $cls }}" style="width:{{ $pct }}%;"></div>
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('admin.albums.items.index', $album) }}"
                           style="display:flex; align-items:center; justify-content:center; gap:7px; margin-top:16px; padding:10px; background:#F8FAFC; border:1.5px solid #E2E8F0; border-radius:12px; font-size:0.82rem; font-weight:700; color:#64748B; text-decoration:none; transition:all 0.2s;"
                           onmouseover="this.style.borderColor='#0E7A96';this.style.color='#0E7A96';"
                           onmouseout="this.style.borderColor='#E2E8F0';this.style.color='#64748B';">
                            <i class="fas fa-images"></i> Lihat Semua Item
                        </a>
                    </div>
                </div>

                {{-- Upload Banyak --}}
                <div class="section-card">
                    <div class="section-card-header">
                        <div class="icon-wrap"><i class="fas fa-layer-group"></i></div>
                        <h6>Upload Banyak Sekaligus</h6>
                    </div>
                    <div class="section-card-body" style="text-align:center;">
                        <p style="font-size:0.82rem; color:#94A3B8; margin-bottom:14px;">
                            Ingin upload banyak file sekaligus? Gunakan fitur bulk upload.
                        </p>
                        <button type="button" class="btn-bulk" data-toggle="modal" data-target="#uploadMultipleModal">
                            <i class="fas fa-upload"></i> Upload Banyak File
                        </button>
                    </div>
                </div>

            </div>
        </div>

        {{-- Action Bar --}}
        <div class="action-bar">
            <div class="left-info">
                <i class="fas fa-info-circle"></i>
                Field bertanda <span style="color:#EF4444; font-weight:700; margin:0 3px;">*</span> wajib diisi.
            </div>
            <div style="display:flex; gap:10px; align-items:center; flex-wrap:wrap;">
                <a href="{{ route('admin.albums.items.index', $album) }}" class="btn-cancel">
                    <i class="fas fa-times"></i> Batal
                </a>
                <button type="submit" class="btn-save">
                    <i class="fas fa-save"></i> Simpan Item
                </button>
            </div>
        </div>

    </form>

    {{-- ==================== MODAL UPLOAD BANYAK ==================== --}}
    <div class="modal fade modal-custom" id="uploadMultipleModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('admin.albums.items.upload-multiple', $album) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <span class="icon-wrap"><i class="fas fa-upload"></i></span>
                            Upload Banyak File — {{ $album->name }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal"
                                style="background:none; border:none; font-size:1.2rem; color:#94A3B8; cursor:pointer;">&times;</button>
                    </div>
                    <div class="modal-body">

                        {{-- Tipe --}}
                        <div class="field-group">
                            <label class="field-label" for="modal_type">Tipe File <span class="req">*</span></label>
                            <select name="type" id="modal_type" class="field-input" required>
                                <option value="foto">📷 Foto</option>
                                <option value="video">🎬 Video</option>
                            </select>
                        </div>

                        {{-- Files --}}
                        <div class="field-group">
                            <label class="field-label">Pilih File <span class="req">*</span></label>
                            <div class="drop-zone" id="multiDropZone">
                                <input type="file" name="files[]" multiple required
                                       accept="image/*,video/*"
                                       onchange="handleMultiFileSelect(this)">
                                <div class="dz-icon"><i class="fas fa-folder-open"></i></div>
                                <div class="dz-title">Pilih beberapa file sekaligus</div>
                                <div class="dz-sub" id="multiDzSub">Klik atau seret file · maks 20MB per file</div>
                            </div>
                            <div class="file-selected-info" id="multiFileInfo">
                                <i class="fas fa-check-circle"></i>
                                <span id="multiFileInfoName">—</span>
                            </div>
                        </div>

                        @if($album->items->count() >= 100)
                            <div class="warn-box">
                                <i class="fas fa-exclamation-triangle"></i>
                                <span>Album sudah mencapai batas 100 item. Upload akan dibatasi secara otomatis.</span>
                            </div>
                        @else
                            <div class="info-box-custom" style="margin-top:0;">
                                <i class="fas fa-info-circle mt-1"></i>
                                <div>
                                    <p>File disimpan di server. Kapasitas tersisa: <strong>{{ 100 - $album->items->count() }} item</strong>.</p>
                                </div>
                            </div>
                        @endif

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-modal-cancel" data-dismiss="modal">
                            <i class="fas fa-times"></i> Batal
                        </button>
                        <button type="submit" class="btn-modal-submit" {{ $album->items->count() >= 100 ? 'disabled' : '' }}>
                            <i class="fas fa-upload"></i> Upload Semua
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@stop

@push('js')
<script>
    // ── Single file select ───────────────────────────────────
    function handleFileSelect(input) {
        const zone  = document.getElementById('dropZone');
        const info  = document.getElementById('fileInfo');
        const label = document.getElementById('fileInfoName');

        if (input.files && input.files[0]) {
            const f = input.files[0];
            zone.classList.add('has-file');
            info.classList.add('visible');
            label.textContent = f.name + ' (' + formatBytes(f.size) + ')';
            document.getElementById('dzSub').textContent = 'File siap diupload';
        }
    }

    // ── Multi file select ────────────────────────────────────
    function handleMultiFileSelect(input) {
        const zone  = document.getElementById('multiDropZone');
        const info  = document.getElementById('multiFileInfo');
        const label = document.getElementById('multiFileInfoName');

        if (input.files && input.files.length > 0) {
            const n = input.files.length;
            zone.classList.add('has-file');
            info.classList.add('visible');
            label.textContent = n + ' file dipilih';
            document.getElementById('multiDzSub').textContent = n + ' file siap diupload';
        }
    }

    // ── Drag & drop visual ───────────────────────────────────
    document.querySelectorAll('.drop-zone').forEach(function(zone) {
        zone.addEventListener('dragover',  function(e) { e.preventDefault(); zone.classList.add('dragover'); });
        zone.addEventListener('dragleave', function()  { zone.classList.remove('dragover'); });
        zone.addEventListener('drop',      function()  { zone.classList.remove('dragover'); });
    });

    // ── Byte formatter ────────────────────────────────────────
    function formatBytes(bytes) {
        if (bytes < 1024)       return bytes + ' B';
        if (bytes < 1048576)    return (bytes / 1024).toFixed(1) + ' KB';
        return (bytes / 1048576).toFixed(1) + ' MB';
    }
</script>
@endpush