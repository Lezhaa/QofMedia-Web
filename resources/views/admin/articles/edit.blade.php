@extends('adminlte::page')

@section('title', 'Edit Informasi')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="mb-0" style="font-size: 1.4rem; font-weight: 700; color: #0D1B2A;">
                <i class="fas fa-edit me-2" style="color: #0E7A96;"></i> Edit Informasi
            </h1>
            <ol class="breadcrumb mb-0 mt-1" style="font-size: 0.8rem; background: transparent; padding: 0;">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.articles.index') }}">Informasi</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </div>
        <a href="{{ route('admin.articles.index') }}"
           style="display:inline-flex; align-items:center; gap:7px; background:#64748B; color:#fff; padding:10px 22px; border-radius:50px; font-weight:700; font-size:0.88rem; text-decoration:none; border:none; transition:all 0.3s;">
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
    .alert-error-custom ul {
        margin: 4px 0 0 0;
        padding-left: 18px;
    }

    /* ============================================
       FORM CARD
       ============================================ */
    .form-card {
        background: #fff;
        border: 1px solid #E2E8F0;
        border-radius: 20px;
        overflow: hidden;
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

    .form-card-header-title {
        font-size: 0.92rem;
        font-weight: 700;
        color: #0D1B2A;
        margin: 0;
    }

    .form-card-header-subtitle {
        font-size: 0.75rem;
        color: #94A3B8;
        margin: 1px 0 0 0;
    }

    .form-card-body {
        padding: 28px 24px;
    }

    /* ============================================
       FORM ELEMENTS
       ============================================ */
    .form-section-divider {
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 28px 0 20px;
    }

    .form-section-divider span {
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: #94A3B8;
        white-space: nowrap;
    }

    .form-section-divider::before,
    .form-section-divider::after {
        content: '';
        flex: 1;
        height: 1px;
        background: #F1F5F9;
    }

    .custom-label {
        font-size: 0.82rem;
        font-weight: 700;
        color: #374151;
        margin-bottom: 7px;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .custom-label .req {
        color: #EF4444;
        font-size: 0.78rem;
    }

    .custom-label i {
        color: #CBD5E1;
        font-size: 0.78rem;
    }

    .custom-input,
    .custom-textarea,
    .custom-select,
    .custom-file {
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
    .custom-textarea:focus,
    .custom-select:focus {
        border-color: #0E7A96;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(14,122,150,0.08);
    }

    .custom-input.is-invalid,
    .custom-textarea.is-invalid,
    .custom-select.is-invalid {
        border-color: #EF4444;
        background: #FFF9F9;
    }

    .custom-input.is-invalid:focus,
    .custom-textarea.is-invalid:focus {
        box-shadow: 0 0 0 3px rgba(239,68,68,0.08);
    }

    .custom-textarea {
        resize: vertical;
        min-height: 80px;
    }

    .custom-error {
        font-size: 0.76rem;
        color: #EF4444;
        margin-top: 5px;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    /* ============================================
       IMAGE PREVIEW
       ============================================ */
    .current-image-wrap {
        background: #F8FAFC;
        border: 1.5px dashed #E2E8F0;
        border-radius: 12px;
        padding: 14px 16px;
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .current-image-wrap img {
        width: 72px;
        height: 72px;
        border-radius: 10px;
        object-fit: cover;
        border: 1px solid #E2E8F0;
        flex-shrink: 0;
    }

    .current-image-info {
        flex: 1;
    }

    .current-image-info p {
        margin: 0;
        font-size: 0.8rem;
        color: #64748B;
        line-height: 1.6;
    }

    .current-image-info strong {
        color: #0D1B2A;
        font-size: 0.82rem;
    }

    /* File input custom */
    .file-upload-wrap {
        position: relative;
    }

    .file-upload-wrap input[type="file"] {
        width: 100%;
        border: 1.5px dashed #CBD5E1;
        border-radius: 10px;
        padding: 10px 14px;
        font-size: 0.85rem;
        color: #64748B;
        background: #F8FAFC;
        cursor: pointer;
        transition: border-color 0.2s;
    }

    .file-upload-wrap input[type="file"]:hover {
        border-color: #0E7A96;
    }

    .file-upload-hint {
        font-size: 0.75rem;
        color: #94A3B8;
        margin-top: 5px;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    /* ============================================
       DATE INPUT
       ============================================ */
    input[type="datetime-local"].custom-input {
        color-scheme: light;
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
        text-decoration: none;
    }

    .btn-save:hover {
        background: #0a6278;
        color: #fff;
        transform: translateY(-1px);
        box-shadow: 0 6px 18px rgba(14,122,150,0.28);
        text-decoration: none;
    }

    .btn-save:active {
        transform: translateY(0);
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

    .btn-preview {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: rgba(5,150,105,0.08);
        color: #059669;
        padding: 11px 20px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.88rem;
        border: 1.5px solid rgba(5,150,105,0.2);
        text-decoration: none;
        transition: all 0.2s;
        margin-left: auto;
    }

    .btn-preview:hover {
        background: rgba(5,150,105,0.15);
        color: #059669;
        text-decoration: none;
    }

    /* ============================================
       TWO-COLUMN GRID
       ============================================ */
    .form-grid-2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    @media (max-width: 640px) {
        .form-grid-2 { grid-template-columns: 1fr; }
        .form-card-body { padding: 20px 16px; }
        .form-actions { padding: 16px; }
        .btn-preview { margin-left: 0; }
    }

    /* ============================================
       CHAR COUNTER
       ============================================ */
    .char-counter {
        font-size: 0.72rem;
        color: #CBD5E1;
        text-align: right;
        margin-top: 4px;
        transition: color 0.2s;
    }
    .char-counter.warn { color: #F59E0B; }
    .char-counter.limit { color: #EF4444; }
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

    <form action="{{ route('admin.articles.update', $article) }}" method="POST" enctype="multipart/form-data" id="editForm">
        @csrf
        @method('PUT')

        {{-- ─── INFORMASI UTAMA ─── --}}
        <div class="form-card" style="margin-bottom: 20px;">
            <div class="form-card-header">
                <div class="form-card-header-icon">
                    <i class="fas fa-file-alt"></i>
                </div>
                <div>
                    <p class="form-card-header-title">Informasi Utama</p>
                    <p class="form-card-header-subtitle">Judul, kategori, dan ringkasan artikel</p>
                </div>
            </div>

            <div class="form-card-body">

                {{-- Title --}}
                <div class="form-group" style="margin-bottom: 20px;">
                    <label class="custom-label" for="title">
                        <i class="fas fa-heading"></i> Judul <span class="req">*</span>
                    </label>
                    <input type="text"
                           class="custom-input @error('title') is-invalid @enderror"
                           id="title" name="title"
                           value="{{ old('title', $article->title) }}"
                           placeholder="Masukkan judul artikel..."
                           maxlength="255"
                           oninput="updateCounter('title', 255)"
                           required>
                    <div class="char-counter" id="title-counter">
                        {{ strlen(old('title', $article->title)) }}/255
                    </div>
                    @error('title')
                        <div class="custom-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>

                <div class="form-grid-2">
                    {{-- Category --}}
                    <div class="form-group" style="margin-bottom: 0;">
                        <label class="custom-label" for="category">
                            <i class="fas fa-tag"></i> Kategori <span class="req">*</span>
                        </label>
                        <input type="text"
                               class="custom-input @error('category') is-invalid @enderror"
                               id="category" name="category"
                               value="{{ old('category', $article->category) }}"
                               placeholder="Contoh: Berita, Pengumuman..."
                               required>
                        @error('category')
                            <div class="custom-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Published At --}}
                    <div class="form-group" style="margin-bottom: 0;">
                        <label class="custom-label" for="published_at">
                            <i class="fas fa-calendar-alt"></i> Tanggal Publish
                        </label>
                        <input type="datetime-local"
                               class="custom-input @error('published_at') is-invalid @enderror"
                               id="published_at" name="published_at"
                               value="{{ old('published_at', $article->published_at?->format('Y-m-d\TH:i')) }}">
                        @error('published_at')
                            <div class="custom-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Excerpt --}}
                <div class="form-group" style="margin-top: 20px; margin-bottom: 0;">
                    <label class="custom-label" for="excerpt">
                        <i class="fas fa-align-left"></i> Ringkasan
                        <span style="font-size:0.72rem; color:#94A3B8; font-weight:500;">(opsional)</span>
                    </label>
                    <textarea class="custom-textarea @error('excerpt') is-invalid @enderror"
                              id="excerpt" name="excerpt"
                              rows="2"
                              placeholder="Ringkasan singkat artikel yang tampil di daftar..."
                              maxlength="500"
                              oninput="updateCounter('excerpt', 500)">{{ old('excerpt', $article->excerpt) }}</textarea>
                    <div class="char-counter" id="excerpt-counter">
                        {{ strlen(old('excerpt', $article->excerpt ?? '')) }}/500
                    </div>
                    @error('excerpt')
                        <div class="custom-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>

            </div>
        </div>

        {{-- ─── KONTEN ─── --}}
        <div class="form-card" style="margin-bottom: 20px;">
            <div class="form-card-header">
                <div class="form-card-header-icon">
                    <i class="fas fa-align-justify"></i>
                </div>
                <div>
                    <p class="form-card-header-title">Konten Artikel</p>
                    <p class="form-card-header-subtitle">Isi lengkap artikel yang akan ditampilkan</p>
                </div>
            </div>

            <div class="form-card-body">
                <div class="form-group" style="margin-bottom: 0;">
                    <label class="custom-label" for="content">
                        <i class="fas fa-file-alt"></i> Konten <span class="req">*</span>
                    </label>
                    <textarea class="custom-textarea @error('content') is-invalid @enderror"
                              id="content" name="content"
                              rows="14"
                              placeholder="Tulis konten lengkap artikel di sini..."
                              required>{{ old('content', $article->content) }}</textarea>
                    @error('content')
                        <div class="custom-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                    <div style="display:flex; justify-content:flex-end; margin-top:5px;">
                        <span id="content-words" style="font-size:0.72rem; color:#CBD5E1;"></span>
                    </div>
                </div>
            </div>
        </div>

        {{-- ─── GAMBAR ─── --}}
        <div class="form-card" style="margin-bottom: 20px;">
            <div class="form-card-header">
                <div class="form-card-header-icon">
                    <i class="fas fa-image"></i>
                </div>
                <div>
                    <p class="form-card-header-title">Gambar Artikel</p>
                    <p class="form-card-header-subtitle">Thumbnail atau gambar utama artikel</p>
                </div>
            </div>

            <div class="form-card-body">

                {{-- Current Image --}}
                @if($article->image)
                    <div style="margin-bottom: 18px;">
                        <label class="custom-label" style="margin-bottom: 10px;">
                            <i class="fas fa-image"></i> Gambar Saat Ini
                        </label>
                        <div class="current-image-wrap">
                            <img src="{{ asset('storage/' . $article->image) }}"
                                 alt="{{ $article->title }}"
                                 id="currentImagePreview">
                            <div class="current-image-info">
                                <strong>Gambar terpasang</strong>
                                <p>Upload gambar baru di bawah untuk mengganti gambar ini. Jika tidak diupload, gambar lama tetap digunakan.</p>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- New Image Upload --}}
                <div class="form-group" style="margin-bottom: 0;">
                    <label class="custom-label" for="image">
                        <i class="fas fa-upload"></i>
                        {{ $article->image ? 'Ganti Gambar (Opsional)' : 'Upload Gambar (Opsional)' }}
                    </label>
                    <div class="file-upload-wrap">
                        <input type="file"
                               class="@error('image') is-invalid @enderror"
                               id="image" name="image"
                               accept="image/*"
                               onchange="previewNewImage(this)">
                    </div>
                    <div class="file-upload-hint">
                        <i class="fas fa-info-circle"></i>
                        Format: JPG, PNG, GIF, WEBP. Ukuran maksimal disarankan: 2 MB.
                    </div>
                    @error('image')
                        <div class="custom-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror

                    {{-- New Image Preview --}}
                    <div id="newImagePreviewWrap" style="display:none; margin-top:14px;">
                        <div class="current-image-wrap">
                            <img id="newImagePreview" src="" alt="Preview" style="width:72px; height:72px; border-radius:10px; object-fit:cover; border:1px solid #E2E8F0; flex-shrink:0;">
                            <div class="current-image-info">
                                <strong>Preview gambar baru</strong>
                                <p id="newImageName" style="margin:0; font-size:0.8rem; color:#64748B;"></p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        {{-- ─── FORM ACTIONS ─── --}}
        <div class="form-card">
            <div class="form-actions">
                <button type="submit" class="btn-save">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
                <a href="{{ route('admin.articles.index') }}" class="btn-cancel">
                    <i class="fas fa-times"></i> Batal
                </a>
                @if($article->slug ?? false)
                    <a href="{{ route('information.show', $article->slug) }}"
                       target="_blank"
                       class="btn-preview">
                        <i class="fas fa-eye"></i> Lihat Artikel
                    </a>
                @endif
            </div>
        </div>

    </form>

@stop

@push('js')
<script>
    // ── Char counter ──────────────────────────────────────
    function updateCounter(field, max) {
        var el    = document.getElementById(field);
        var counter = document.getElementById(field + '-counter');
        if (!el || !counter) return;
        var len = el.value.length;
        counter.textContent = len + '/' + max;
        counter.className = 'char-counter';
        if (len > max * 0.9) counter.classList.add('warn');
        if (len >= max)      counter.classList.add('limit');
    }

    // ── Word counter for content ──────────────────────────
    var contentEl = document.getElementById('content');
    var wordsEl   = document.getElementById('content-words');
    if (contentEl && wordsEl) {
        function updateWords() {
            var words = contentEl.value.trim().split(/\s+/).filter(Boolean).length;
            wordsEl.textContent = words + ' kata';
        }
        contentEl.addEventListener('input', updateWords);
        updateWords();
    }

    // ── New image preview ─────────────────────────────────
    function previewNewImage(input) {
        var wrap    = document.getElementById('newImagePreviewWrap');
        var preview = document.getElementById('newImagePreview');
        var nameEl  = document.getElementById('newImageName');
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                preview.src = e.target.result;
                nameEl.textContent = input.files[0].name + ' (' + (input.files[0].size / 1024).toFixed(1) + ' KB)';
                wrap.style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            wrap.style.display = 'none';
        }
    }

    // ── Run counters on load ──────────────────────────────
    updateCounter('title', 255);
    updateCounter('excerpt', 500);
</script>
@endpush