@extends('adminlte::page')

@section('title', 'Tambah Informasi Baru')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="mb-0" style="font-size: 1.4rem; font-weight: 700; color: #0D1B2A;">
                <i class="fas fa-plus-circle me-2" style="color: #0E7A96;"></i> Tambah Informasi Baru
            </h1>
            <ol class="breadcrumb mb-0 mt-1" style="font-size: 0.8rem; background: transparent; padding: 0;">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.articles.index') }}">Artikel</a></li>
                <li class="breadcrumb-item active">Tambah</li>
            </ol>
        </div>
        <a href="{{ route('admin.articles.index') }}"
           style="display:inline-flex; align-items:center; gap:6px; background:#fff; border:1.5px solid #E2E8F0; color:#64748B; padding:9px 20px; border-radius:50px; font-weight:700; font-size:0.85rem; text-decoration:none; transition:all 0.3s;">
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
       DASH CARD
       ============================================ */
    .dash-card {
        background: #fff;
        border: 1px solid #E2E8F0;
        border-radius: 18px;
        overflow: hidden;
        margin-bottom: 20px;
    }
    .dash-card-header {
        padding: 18px 24px;
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
    .dash-card-body { padding: 24px; }

    /* ============================================
       FORM GROUPS
       ============================================ */
    .form-section { margin-bottom: 24px; }
    .form-section:last-child { margin-bottom: 0; }

    .field-label {
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #64748B;
        margin-bottom: 7px;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .field-label .req { color: #DC2626; }
    .field-label .opt {
        font-size: 0.68rem;
        color: #94A3B8;
        font-weight: 500;
        text-transform: none;
        letter-spacing: 0;
    }

    .field-input {
        width: 100%;
        padding: 11px 14px;
        border: 1.5px solid #E2E8F0;
        border-radius: 12px;
        font-size: 0.88rem;
        color: #0D1B2A;
        background: #fff;
        transition: border-color 0.2s, box-shadow 0.2s;
        outline: none;
        font-family: inherit;
    }
    .field-input:focus {
        border-color: #0E7A96;
        box-shadow: 0 0 0 3px rgba(14,122,150,0.1);
    }
    .field-input::placeholder { color: #CBD5E1; }
    .field-input.is-invalid { border-color: #DC2626; }
    .field-input.is-invalid:focus { box-shadow: 0 0 0 3px rgba(220,38,38,0.1); }

    textarea.field-input { resize: vertical; line-height: 1.6; }

    .field-hint {
        font-size: 0.73rem;
        color: #94A3B8;
        margin-top: 5px;
        display: flex;
        align-items: flex-start;
        gap: 4px;
        line-height: 1.5;
    }

    .invalid-msg {
        font-size: 0.78rem;
        color: #DC2626;
        margin-top: 5px;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    /* ============================================
       CHARACTER COUNTER
       ============================================ */
    .char-counter {
        font-size: 0.72rem;
        color: #94A3B8;
        font-weight: 600;
        margin-top: 5px;
        text-align: right;
    }
    .char-counter.warn  { color: #D97706; }
    .char-counter.over  { color: #DC2626; }

    /* ============================================
       CATEGORY TAGS
       ============================================ */
    .cat-suggestions {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        margin-top: 8px;
    }
    .cat-chip {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 4px 12px;
        border-radius: 50px;
        background: #F1F5F9;
        color: #475569;
        font-size: 0.75rem;
        font-weight: 700;
        cursor: pointer;
        border: 1.5px solid transparent;
        transition: all 0.2s;
        user-select: none;
    }
    .cat-chip:hover, .cat-chip.active {
        background: #EEF9FC;
        color: #0E7A96;
        border-color: rgba(14,122,150,0.25);
    }

    /* ============================================
       IMAGE UPLOAD
       ============================================ */
    .upload-zone {
        border: 2px dashed #E2E8F0;
        border-radius: 14px;
        padding: 28px 20px;
        text-align: center;
        cursor: pointer;
        transition: all 0.25s;
        position: relative;
        overflow: hidden;
        background: #FAFBFC;
    }
    .upload-zone:hover, .upload-zone.dragover {
        border-color: #0E7A96;
        background: #EEF9FC;
    }
    .upload-zone input[type="file"] {
        position: absolute;
        inset: 0;
        opacity: 0;
        cursor: pointer;
        width: 100%;
        height: 100%;
    }
    .upload-zone .uz-icon {
        font-size: 2rem;
        color: #CBD5E1;
        margin-bottom: 10px;
        transition: color 0.25s;
        display: block;
    }
    .upload-zone:hover .uz-icon,
    .upload-zone.dragover .uz-icon { color: #0E7A96; }
    .upload-zone .uz-label {
        font-size: 0.85rem;
        color: #64748B;
        font-weight: 700;
        margin-bottom: 4px;
    }
    .upload-zone .uz-sub {
        font-size: 0.75rem;
        color: #CBD5E1;
    }
    .upload-zone .uz-browse {
        display: inline-block;
        color: #0E7A96;
        font-weight: 700;
        text-decoration: underline;
    }

    /* image preview */
    .img-preview-wrap {
        display: none;
        margin-top: 12px;
        border-radius: 14px;
        overflow: hidden;
        border: 1.5px solid #E2E8F0;
        position: relative;
    }
    .img-preview-wrap img {
        width: 100%;
        max-height: 220px;
        object-fit: cover;
        display: block;
    }
    .img-preview-overlay {
        position: absolute;
        top: 10px; right: 10px;
    }
    .btn-remove-img {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 5px 12px;
        background: rgba(220,38,38,0.85);
        color: #fff;
        border: none;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 700;
        cursor: pointer;
        backdrop-filter: blur(4px);
        transition: all 0.2s;
    }
    .btn-remove-img:hover { background: #DC2626; }

    /* ============================================
       PUBLISH DATE
       ============================================ */
    .datetime-wrap {
        position: relative;
    }
    .datetime-wrap .dt-icon {
        position: absolute;
        left: 13px;
        top: 50%;
        transform: translateY(-50%);
        color: #94A3B8;
        font-size: 0.85rem;
        pointer-events: none;
    }
    .datetime-wrap .field-input {
        padding-left: 36px;
    }

    /* ============================================
       SIDEBAR CARD — STATUS & TIPS
       ============================================ */
    .side-info-item {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        padding: 10px 0;
        border-bottom: 1px solid #F8FAFC;
    }
    .side-info-item:last-child { border-bottom: none; padding-bottom: 0; }
    .side-info-item .sii-icon {
        width: 30px; height: 30px;
        border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        font-size: 0.78rem;
        flex-shrink: 0;
    }
    .side-info-item .sii-label {
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #94A3B8;
        margin-bottom: 2px;
    }
    .side-info-item .sii-value {
        font-size: 0.83rem;
        font-weight: 600;
        color: #0D1B2A;
        line-height: 1.4;
    }

    /* tips list */
    .tips-list { padding: 0; margin: 0; list-style: none; }
    .tips-list li {
        display: flex;
        align-items: flex-start;
        gap: 8px;
        font-size: 0.8rem;
        color: #475569;
        line-height: 1.5;
        padding: 7px 0;
        border-bottom: 1px solid #F8FAFC;
    }
    .tips-list li:last-child { border-bottom: none; padding-bottom: 0; }
    .tips-list li i {
        color: #0E7A96;
        font-size: 0.72rem;
        margin-top: 3px;
        flex-shrink: 0;
    }

    /* ============================================
       ACTION BUTTONS
       ============================================ */
    .action-bar {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }
    .btn-save {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 28px;
        background: linear-gradient(135deg, #0E7A96, #4EB8CC);
        color: #fff;
        border: none;
        border-radius: 50px;
        font-size: 0.9rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.25s;
        box-shadow: 0 4px 14px rgba(14,122,150,0.25);
    }
    .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 22px rgba(14,122,150,0.35);
        color: #fff;
    }
    .btn-save:active { transform: translateY(0); }

    .btn-cancel-link {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 12px 22px;
        background: #fff;
        color: #64748B;
        border: 1.5px solid #E2E8F0;
        border-radius: 50px;
        font-size: 0.88rem;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.2s;
    }
    .btn-cancel-link:hover { background: #F8FAFC; color: #0D1B2A; text-decoration: none; }

    .btn-preview {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 12px 20px;
        background: rgba(14,122,150,0.07);
        color: #0E7A96;
        border: 1.5px solid rgba(14,122,150,0.15);
        border-radius: 50px;
        font-size: 0.88rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s;
    }
    .btn-preview:hover { background: #EEF9FC; }

    /* ============================================
       LIVE PREVIEW STRIP
       ============================================ */
    .preview-strip {
        background: linear-gradient(135deg, #0D1B2A 0%, #1B3A4B 55%, #0E7A96 100%);
        border-radius: 14px;
        padding: 18px 22px;
        margin-bottom: 20px;
        display: none;
        animation: fadeIn 0.3s ease;
    }
    .preview-strip.visible { display: block; }
    .preview-strip .ps-cat {
        display: inline-block;
        background: rgba(255,255,255,0.15);
        color: #A8DDE8;
        padding: 3px 12px;
        border-radius: 50px;
        font-size: 0.72rem;
        font-weight: 700;
        margin-bottom: 8px;
    }
    .preview-strip .ps-title {
        color: #fff;
        font-size: 1.1rem;
        font-weight: 800;
        margin-bottom: 6px;
        line-height: 1.3;
    }
    .preview-strip .ps-excerpt {
        color: rgba(255,255,255,0.6);
        font-size: 0.82rem;
        line-height: 1.6;
    }

    /* ============================================
       ANIMATIONS
       ============================================ */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(14px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    @keyframes fadeIn {
        from { opacity: 0; }
        to   { opacity: 1; }
    }
    .anim-1 { animation: fadeInUp 0.38s ease both; }
    .anim-2 { animation: fadeInUp 0.38s 0.07s ease both; }
    .anim-3 { animation: fadeInUp 0.38s 0.14s ease both; }
</style>
@endpush

@section('content')

    {{-- ── LIVE PREVIEW STRIP ── --}}
    <div class="preview-strip anim-1" id="previewStrip">
        <span class="ps-cat" id="prevCat">Kategori</span>
        <div class="ps-title" id="prevTitle">Judul artikel akan muncul di sini...</div>
        <div class="ps-excerpt" id="prevExcerpt">Ringkasan artikel akan ditampilkan di sini.</div>
    </div>

    <form action="{{ route('admin.articles.store') }}" method="POST"
          enctype="multipart/form-data" id="articleForm">
        @csrf

        <div class="row g-3">

            {{-- ── LEFT / MAIN COLUMN ── --}}
            <div class="col-lg-8">

                {{-- Konten Utama --}}
                <p class="sec-label anim-1">Konten Artikel</p>

                {{-- Judul --}}
                <div class="dash-card anim-1">
                    <div class="dash-card-header">
                        <div class="dash-card-title">
                            <i class="fas fa-heading"></i> Judul & Kategori
                        </div>
                    </div>
                    <div class="dash-card-body">

                        <div class="form-section">
                            <label class="field-label" for="title">
                                <i class="fas fa-heading" style="color:#0E7A96;"></i>
                                Judul Artikel
                                <span class="req">*</span>
                            </label>
                            <input type="text"
                                   class="field-input @error('title') is-invalid @enderror"
                                   id="title" name="title"
                                   value="{{ old('title') }}"
                                   placeholder="Tulis judul yang menarik dan informatif..."
                                   maxlength="200"
                                   oninput="updatePreview()"
                                   required>
                            @error('title')
                                <div class="invalid-msg"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                            @enderror
                            <div class="char-counter" id="titleCounter">0 / 200</div>
                        </div>

                        <div class="form-section" style="margin-bottom:0;">
                            <label class="field-label" for="category">
                                <i class="fas fa-tag" style="color:#0E7A96;"></i>
                                Kategori
                                <span class="req">*</span>
                            </label>
                            <input type="text"
                                   class="field-input @error('category') is-invalid @enderror"
                                   id="category" name="category"
                                   value="{{ old('category') }}"
                                   placeholder="Contoh: Berita, Pengumuman, Tips"
                                   oninput="updatePreview()"
                                   required>
                            @error('category')
                                <div class="invalid-msg"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                            @enderror
                            <div class="cat-suggestions">
                                @foreach(['Berita','Pengumuman','Tips','Tutorial','Event','Promo','Informasi'] as $cat)
                                    <span class="cat-chip" onclick="setCategory('{{ $cat }}')">
                                        {{ $cat }}
                                    </span>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>

                {{-- Ringkasan --}}
                <div class="dash-card anim-2">
                    <div class="dash-card-header">
                        <div class="dash-card-title">
                            <i class="fas fa-align-left"></i> Ringkasan
                        </div>
                        <span style="font-size:0.75rem; color:#94A3B8; font-weight:600;">Opsional</span>
                    </div>
                    <div class="dash-card-body">
                        <label class="field-label" for="excerpt">
                            <i class="fas fa-quote-left" style="color:#0E7A96;"></i>
                            Ringkasan / Excerpt
                            <span class="opt">(opsional)</span>
                        </label>
                        <textarea class="field-input @error('excerpt') is-invalid @enderror"
                                  id="excerpt" name="excerpt"
                                  rows="3"
                                  placeholder="Tulis ringkasan singkat yang menggambarkan isi artikel..."
                                  maxlength="300"
                                  oninput="updatePreview(); countChar(this, 'excerptCounter', 300)">{{ old('excerpt') }}</textarea>
                        @error('excerpt')
                            <div class="invalid-msg"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                        <div style="display:flex; justify-content:space-between; align-items:center; margin-top:5px;">
                            <span class="field-hint"><i class="fas fa-info-circle"></i> Ditampilkan di halaman daftar artikel.</span>
                            <span class="char-counter" id="excerptCounter">0 / 300</span>
                        </div>
                    </div>
                </div>

                {{-- Konten --}}
                <div class="dash-card anim-2">
                    <div class="dash-card-header">
                        <div class="dash-card-title">
                            <i class="fas fa-file-alt"></i> Konten Lengkap
                        </div>
                        <span style="background:#FEF3C7; color:#92400E; padding:3px 10px; border-radius:50px; font-size:0.72rem; font-weight:700;">
                            <i class="fas fa-asterisk"></i> Wajib diisi
                        </span>
                    </div>
                    <div class="dash-card-body">
                        <label class="field-label" for="content">
                            <i class="fas fa-align-justify" style="color:#0E7A96;"></i>
                            Isi Artikel
                            <span class="req">*</span>
                        </label>
                        <textarea class="field-input @error('content') is-invalid @enderror"
                                  id="content" name="content"
                                  rows="16"
                                  placeholder="Tulis konten artikel secara lengkap di sini..."
                                  required>{{ old('content') }}</textarea>
                        @error('content')
                            <div class="invalid-msg"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                        <div class="field-hint" style="margin-top:6px;">
                            <i class="fas fa-lightbulb"></i>
                            Gunakan paragraf yang jelas. Jika diperlukan, Anda bisa mengintegrasikan editor teks kaya (TinyMCE / CKEditor).
                        </div>
                    </div>
                </div>

                {{-- Action Bar --}}
                <div class="dash-card anim-3">
                    <div class="dash-card-body">
                        <div class="action-bar">
                            <button type="submit" class="btn-save">
                                <i class="fas fa-save"></i> Simpan Artikel
                            </button>
                            <button type="button" class="btn-preview" onclick="togglePreview()">
                                <i class="fas fa-eye"></i> Preview
                            </button>
                            <a href="{{ route('admin.articles.index') }}" class="btn-cancel-link">
                                <i class="fas fa-times"></i> Batal
                            </a>
                        </div>
                    </div>
                </div>

            </div>

            {{-- ── RIGHT / SIDEBAR COLUMN ── --}}
            <div class="col-lg-4">

                {{-- Gambar --}}
                <p class="sec-label anim-1">Media</p>
                <div class="dash-card anim-1" style="margin-bottom:20px;">
                    <div class="dash-card-header">
                        <div class="dash-card-title">
                            <i class="fas fa-image"></i> Gambar Artikel
                        </div>
                        <span style="font-size:0.75rem; color:#94A3B8; font-weight:600;">Opsional</span>
                    </div>
                    <div class="dash-card-body">
                        <div class="upload-zone" id="uploadZone">
                            <input type="file" name="image" id="imageInput"
                                   accept="image/*"
                                   onchange="handleImagePreview(this)">
                            <i class="fas fa-cloud-upload-alt uz-icon"></i>
                            <div class="uz-label">
                                <span class="uz-browse">Pilih gambar</span> atau drag & drop
                            </div>
                            <div class="uz-sub">PNG, JPG, WEBP — Maks. 2 MB</div>
                        </div>
                        @error('image')
                            <div class="invalid-msg mt-2"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                        <div class="img-preview-wrap" id="imgPreviewWrap">
                            <img src="" alt="Preview" id="imgPreview">
                            <div class="img-preview-overlay">
                                <button type="button" class="btn-remove-img" onclick="removeImage()">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Publish Settings --}}
                <p class="sec-label anim-2">Pengaturan Publish</p>
                <div class="dash-card anim-2" style="margin-bottom:20px;">
                    <div class="dash-card-header">
                        <div class="dash-card-title">
                            <i class="fas fa-calendar-alt"></i> Jadwal & Status
                        </div>
                    </div>
                    <div class="dash-card-body">
                        <div class="form-section" style="margin-bottom:0;">
                            <label class="field-label" for="published_at">
                                <i class="fas fa-clock" style="color:#0E7A96;"></i>
                                Tanggal & Waktu Publish
                                <span class="opt">(opsional)</span>
                            </label>
                            <div class="datetime-wrap">
                                <i class="fas fa-calendar-alt dt-icon"></i>
                                <input type="datetime-local"
                                       class="field-input @error('published_at') is-invalid @enderror"
                                       id="published_at" name="published_at"
                                       value="{{ old('published_at', now()->format('Y-m-d\TH:i')) }}">
                            </div>
                            @error('published_at')
                                <div class="invalid-msg"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                            @enderror
                            <div class="field-hint mt-2">
                                <i class="fas fa-info-circle"></i>
                                Kosongkan untuk publish langsung, atau isi untuk menjadwalkan.
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Artikel Info --}}
                <p class="sec-label anim-3">Informasi</p>
                <div class="dash-card anim-3" style="margin-bottom:20px;">
                    <div class="dash-card-header">
                        <div class="dash-card-title">
                            <i class="fas fa-info-circle"></i> Detail Artikel
                        </div>
                    </div>
                    <div class="dash-card-body">
                        <div class="side-info-item">
                            <div class="sii-icon" style="background:#EEF9FC; color:#0E7A96;">
                                <i class="fas fa-user"></i>
                            </div>
                            <div>
                                <div class="sii-label">Penulis</div>
                                <div class="sii-value">{{ Auth::user()->name }}</div>
                            </div>
                        </div>
                        <div class="side-info-item">
                            <div class="sii-icon" style="background:#D1FAE5; color:#059669;">
                                <i class="fas fa-calendar-plus"></i>
                            </div>
                            <div>
                                <div class="sii-label">Dibuat</div>
                                <div class="sii-value">{{ now()->isoFormat('D MMMM Y, HH:mm') }}</div>
                            </div>
                        </div>
                        <div class="side-info-item">
                            <div class="sii-icon" style="background:#FEF3C7; color:#D97706;">
                                <i class="fas fa-tag"></i>
                            </div>
                            <div>
                                <div class="sii-label">Kategori</div>
                                <div class="sii-value" id="sideCategory">—</div>
                            </div>
                        </div>
                        <div class="side-info-item">
                            <div class="sii-icon" style="background:#FEE2E2; color:#DC2626;">
                                <i class="fas fa-file-word"></i>
                            </div>
                            <div>
                                <div class="sii-label">Jumlah Kata</div>
                                <div class="sii-value" id="wordCount">0 kata</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Writing Tips --}}
                <div class="dash-card anim-3">
                    <div class="dash-card-header">
                        <div class="dash-card-title">
                            <i class="fas fa-lightbulb"></i> Tips Penulisan
                        </div>
                    </div>
                    <div class="dash-card-body">
                        <ul class="tips-list">
                            <li><i class="fas fa-check-circle"></i> Gunakan judul yang jelas dan menarik perhatian pembaca.</li>
                            <li><i class="fas fa-check-circle"></i> Tulis ringkasan yang menggambarkan isi artikel secara singkat.</li>
                            <li><i class="fas fa-check-circle"></i> Bagi konten menjadi paragraf pendek agar mudah dibaca.</li>
                            <li><i class="fas fa-check-circle"></i> Gunakan gambar berkualitas tinggi (rasio 16:9 disarankan).</li>
                            <li><i class="fas fa-check-circle"></i> Pastikan kategori sesuai agar mudah ditemukan.</li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>

    </form>

@stop

@push('js')
<script>
    /* ── Character counters ── */
    function countChar(el, counterId, max) {
        var len = el.value.length;
        var el2 = document.getElementById(counterId);
        el2.textContent = len + ' / ' + max;
        el2.className   = 'char-counter' + (len > max * 0.9 ? ' warn' : '') + (len >= max ? ' over' : '');
    }

    document.getElementById('title').addEventListener('input', function () {
        countChar(this, 'titleCounter', 200);
    });
    document.getElementById('excerpt').addEventListener('input', function () {
        countChar(this, 'excerptCounter', 300);
    });

    /* ── Word count ── */
    document.getElementById('content').addEventListener('input', function () {
        var words = this.value.trim().split(/\s+/).filter(Boolean).length;
        document.getElementById('wordCount').textContent = words.toLocaleString() + ' kata';
    });

    /* ── Category chips ── */
    function setCategory(val) {
        var input = document.getElementById('category');
        input.value = val;
        document.querySelectorAll('.cat-chip').forEach(function (c) {
            c.classList.toggle('active', c.textContent.trim() === val);
        });
        updatePreview();
        updateSideCategory();
    }

    document.getElementById('category').addEventListener('input', function () {
        document.querySelectorAll('.cat-chip').forEach(function (c) {
            c.classList.remove('active');
        });
        updateSideCategory();
    });

    function updateSideCategory() {
        var val = document.getElementById('category').value.trim();
        document.getElementById('sideCategory').textContent = val || '—';
    }

    /* ── Live preview strip ── */
    function updatePreview() {
        var title   = document.getElementById('title').value.trim();
        var excerpt = document.getElementById('excerpt').value.trim();
        var cat     = document.getElementById('category').value.trim();

        document.getElementById('prevTitle').textContent   = title   || 'Judul artikel akan muncul di sini...';
        document.getElementById('prevExcerpt').textContent = excerpt || 'Ringkasan artikel akan ditampilkan di sini.';
        document.getElementById('prevCat').textContent     = cat     || 'Kategori';
        updateSideCategory();
    }

    function togglePreview() {
        var strip = document.getElementById('previewStrip');
        strip.classList.toggle('visible');
        if (strip.classList.contains('visible')) {
            strip.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    }

    /* ── Image upload preview ── */
    function handleImagePreview(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('imgPreview').src  = e.target.result;
                document.getElementById('imgPreviewWrap').style.display = 'block';
                document.getElementById('uploadZone').style.display     = 'none';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function removeImage() {
        document.getElementById('imageInput').value    = '';
        document.getElementById('imgPreview').src      = '';
        document.getElementById('imgPreviewWrap').style.display = 'none';
        document.getElementById('uploadZone').style.display     = '';
    }

    /* ── Drag & drop highlight ── */
    var uz = document.getElementById('uploadZone');
    uz.addEventListener('dragover',  function (e) { e.preventDefault(); this.classList.add('dragover'); });
    uz.addEventListener('dragleave', function ()  { this.classList.remove('dragover'); });
    uz.addEventListener('drop',      function (e) {
        this.classList.remove('dragover');
        var files = e.dataTransfer.files;
        if (files.length) {
            document.getElementById('imageInput').files = files;
            handleImagePreview(document.getElementById('imageInput'));
        }
    });

    /* ── Init ── */
    updatePreview();
    (function () {
        var t = document.getElementById('title');
        var x = document.getElementById('excerpt');
        if (t.value) countChar(t, 'titleCounter', 200);
        if (x.value) countChar(x, 'excerptCounter', 300);
    })();
</script>
@endpush