@extends('adminlte::page')

@section('title', 'Edit Alat: ' . $tool->name)

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="mb-0" style="font-size: 1.4rem; font-weight: 700; color: #0D1B2A;">
                <i class="fas fa-edit me-2" style="color: #0E7A96;"></i> Edit Alat
            </h1>
            <ol class="breadcrumb mb-0 mt-1" style="font-size: 0.8rem; background: transparent; padding: 0;">
                <li class="breadcrumb-item"><a href="{{ route('studio.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('studio.tools.index') }}">Alat</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </div>
        <a href="{{ route('studio.tools.index') }}"
           style="display:inline-flex; align-items:center; gap:7px; background:#F8FAFC; color:#64748B; padding:10px 22px; border-radius:50px; font-weight:700; font-size:0.88rem; text-decoration:none; border:1.5px solid #E2E8F0; transition:all 0.3s;">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
@stop

@push('css')
<style>
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
        padding: 16px 28px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .form-card-header .header-icon {
        width: 36px; height: 36px;
        background: rgba(14,122,150,0.1);
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        color: #0E7A96;
        font-size: 0.95rem;
        flex-shrink: 0;
    }

    .form-card-header h5 {
        margin: 0;
        font-size: 0.92rem;
        font-weight: 700;
        color: #0D1B2A;
    }

    .form-card-header p {
        margin: 0;
        font-size: 0.76rem;
        color: #94A3B8;
    }

    .form-card-body { padding: 28px; }

    /* ============================================
       SECTION DIVIDER
       ============================================ */
    .form-divider {
        border: none;
        border-top: 1px solid #F1F5F9;
        margin: 24px 0;
    }

    .form-section-label {
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: #94A3B8;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    /* ============================================
       FIELD ELEMENTS
       ============================================ */
    .field-group { margin-bottom: 18px; }

    .field-label {
        display: block;
        font-size: 0.78rem;
        font-weight: 700;
        color: #0D1B2A;
        margin-bottom: 7px;
        letter-spacing: 0.02em;
    }

    .field-label .required { color: #DC2626; margin-left: 3px; }

    .field-hint {
        font-size: 0.73rem;
        color: #94A3B8;
        margin-top: 5px;
        line-height: 1.5;
    }

    .field-input,
    .field-textarea {
        width: 100%;
        border: 1.5px solid #E2E8F0;
        border-radius: 10px;
        padding: 10px 14px;
        font-size: 0.88rem;
        color: #0D1B2A;
        background: #F8FAFC;
        outline: none;
        transition: all 0.2s;
        font-family: inherit;
    }

    .field-input:focus,
    .field-textarea:focus {
        border-color: #0E7A96;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(14,122,150,0.08);
    }

    .field-input.is-invalid,
    .field-textarea.is-invalid {
        border-color: #DC2626;
        background: #FEF2F2;
    }

    .field-input.is-invalid:focus,
    .field-textarea.is-invalid:focus {
        box-shadow: 0 0 0 3px rgba(220,38,38,0.08);
    }

    .field-input::placeholder,
    .field-textarea::placeholder { color: #CBD5E1; }

    .field-textarea { resize: vertical; min-height: 90px; }

    /* Input with icon prefix */
    .field-input-wrap { position: relative; display: flex; align-items: center; }
    .field-input-wrap .field-icon {
        position: absolute;
        left: 13px;
        color: #CBD5E1;
        font-size: 0.85rem;
        pointer-events: none;
        transition: color 0.2s;
    }
    .field-input-wrap:focus-within .field-icon { color: #0E7A96; }
    .field-input-wrap .field-input { padding-left: 36px; }

    /* Error */
    .field-error {
        font-size: 0.75rem;
        font-weight: 600;
        color: #DC2626;
        margin-top: 5px;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    /* ============================================
       CURRENT IMAGE PREVIEW
       ============================================ */
    .current-image-wrap {
        background: #F8FAFC;
        border: 1.5px solid #E2E8F0;
        border-radius: 12px;
        padding: 14px 16px;
        display: flex;
        align-items: center;
        gap: 14px;
        margin-bottom: 12px;
    }

    .current-image-wrap img {
        width: 64px; height: 64px;
        border-radius: 10px;
        object-fit: cover;
        border: 1px solid #E2E8F0;
        flex-shrink: 0;
    }

    .current-image-wrap .ci-info strong {
        display: block;
        font-size: 0.82rem;
        font-weight: 700;
        color: #0D1B2A;
        margin-bottom: 2px;
    }

    .current-image-wrap .ci-info span {
        font-size: 0.73rem;
        color: #94A3B8;
    }

    /* ============================================
       FILE UPLOAD
       ============================================ */
    .file-upload-area {
        border: 1.5px dashed #CBD5E1;
        border-radius: 10px;
        background: #F8FAFC;
        padding: 20px;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s;
        position: relative;
    }

    .file-upload-area:hover {
        border-color: #0E7A96;
        background: rgba(14,122,150,0.03);
    }

    .file-upload-area input[type="file"] {
        position: absolute;
        inset: 0;
        opacity: 0;
        cursor: pointer;
        width: 100%;
        height: 100%;
    }

    .file-upload-area .upload-icon {
        width: 38px; height: 38px;
        background: rgba(14,122,150,0.1);
        border-radius: 9px;
        display: flex; align-items: center; justify-content: center;
        color: #0E7A96;
        font-size: 0.95rem;
        margin: 0 auto 8px;
    }

    .file-upload-area p { margin: 0; font-size: 0.82rem; color: #64748B; font-weight: 600; }
    .file-upload-area span { font-size: 0.73rem; color: #94A3B8; }

    #newImagePreview {
        display: none;
        width: 70px; height: 70px;
        border-radius: 10px;
        object-fit: cover;
        border: 2px solid #E2E8F0;
        margin: 10px auto 0;
    }

    /* ============================================
       TOGGLE SWITCH
       ============================================ */
    .toggle-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: #F8FAFC;
        border: 1.5px solid #E2E8F0;
        border-radius: 12px;
        padding: 14px 18px;
        transition: border-color 0.2s, background 0.2s;
        cursor: pointer;
        margin: 0;
    }

    .toggle-row:has(input:checked) {
        border-color: rgba(14,122,150,0.3);
        background: rgba(14,122,150,0.04);
    }

    .toggle-info strong {
        display: block;
        font-size: 0.85rem;
        font-weight: 700;
        color: #0D1B2A;
        margin-bottom: 2px;
    }

    .toggle-info span {
        font-size: 0.75rem;
        color: #94A3B8;
    }

    .custom-switch-wrap {
        position: relative;
        width: 44px; height: 24px;
        flex-shrink: 0;
    }

    .custom-switch-wrap input {
        opacity: 0;
        width: 0; height: 0;
        position: absolute;
    }

    .switch-slider {
        position: absolute;
        inset: 0;
        background: #E2E8F0;
        border-radius: 50px;
        cursor: pointer;
        transition: background 0.25s;
    }

    .switch-slider::before {
        content: '';
        position: absolute;
        width: 18px; height: 18px;
        left: 3px; top: 3px;
        background: #fff;
        border-radius: 50%;
        transition: transform 0.25s;
        box-shadow: 0 1px 4px rgba(0,0,0,0.15);
    }

    .custom-switch-wrap input:checked + .switch-slider { background: #0E7A96; }
    .custom-switch-wrap input:checked + .switch-slider::before { transform: translateX(20px); }

    /* ============================================
       ACTION BUTTONS
       ============================================ */
    .form-actions {
        display: flex;
        align-items: center;
        gap: 10px;
        padding-top: 8px;
    }

    .btn-save {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: #0E7A96;
        color: #fff;
        padding: 10px 28px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.88rem;
        border: none;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.2s;
    }

    .btn-save:hover {
        background: #0a5a70;
        color: #fff;
        transform: translateY(-1px);
        box-shadow: 0 6px 16px rgba(14,122,150,0.25);
    }

    .btn-cancel {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: #F8FAFC;
        color: #64748B;
        padding: 10px 22px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.88rem;
        border: 1.5px solid #E2E8F0;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.2s;
    }

    .btn-cancel:hover {
        background: #F1F5F9;
        color: #0D1B2A;
        text-decoration: none;
    }
</style>
@endpush

@section('content')

<form action="{{ route('studio.tools.update', $tool) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row">

        {{-- ── Kolom Kiri: Info Utama ── --}}
        <div class="col-lg-8">
            <div class="form-card mb-4">
                <div class="form-card-header">
                    <div class="header-icon"><i class="fas fa-tools"></i></div>
                    <div>
                        <h5>Informasi Alat</h5>
                        <p>Perbarui nama, kategori, dan deskripsi alat</p>
                    </div>
                </div>
                <div class="form-card-body">

                    {{-- Nama Alat --}}
                    <div class="field-group">
                        <label for="name" class="field-label">
                            Nama Alat <span class="required">*</span>
                        </label>
                        <input type="text" id="name" name="name"
                               value="{{ old('name', $tool->name) }}"
                               class="field-input {{ $errors->has('name') ? 'is-invalid' : '' }}"
                               placeholder="Contoh: Kamera Sony A7III"
                               required>
                        @error('name')
                            <div class="field-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Kategori --}}
                    <div class="field-group">
                        <label for="category" class="field-label">
                            Kategori <span class="required">*</span>
                        </label>
                        <div class="field-input-wrap">
                            <i class="fas fa-tag field-icon"></i>
                            <input type="text" id="category" name="category"
                                   value="{{ old('category', $tool->category) }}"
                                   class="field-input {{ $errors->has('category') ? 'is-invalid' : '' }}"
                                   placeholder="Contoh: Kamera, Lensa, Lighting"
                                   required>
                        </div>
                        @error('category')
                            <div class="field-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Deskripsi --}}
                    <div class="field-group">
                        <label for="description" class="field-label">Deskripsi</label>
                        <textarea id="description" name="description"
                                  class="field-textarea {{ $errors->has('description') ? 'is-invalid' : '' }}"
                                  placeholder="Deskripsikan spesifikasi dan kondisi alat...">{{ old('description', $tool->description) }}</textarea>
                        @error('description')
                            <div class="field-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <hr class="form-divider">
                    <p class="form-section-label"><i class="fas fa-coins"></i> Harga & Stok</p>

                    <div class="row">
                        {{-- Harga per Hari --}}
                        <div class="col-md-6">
                            <div class="field-group">
                                <label for="price_per_day" class="field-label">
                                    Harga per Hari <span class="required">*</span>
                                </label>
                                <div class="field-input-wrap">
                                    <span style="position:absolute; left:13px; font-size:0.72rem; font-weight:800; color:#CBD5E1; pointer-events:none; font-family:sans-serif; transition:color 0.2s;" class="rp-prefix">Rp</span>
                                    <input type="number" id="price_per_day" name="price_per_day"
                                           value="{{ old('price_per_day', $tool->price_per_day) }}"
                                           class="field-input {{ $errors->has('price_per_day') ? 'is-invalid' : '' }}"
                                           placeholder="0" min="0" required
                                           style="padding-left: 42px;">
                                </div>
                                @error('price_per_day')
                                    <div class="field-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Stok --}}
                        <div class="col-md-6">
                            <div class="field-group">
                                <label for="stock" class="field-label">
                                    Stok <span class="required">*</span>
                                </label>
                                <div class="field-input-wrap">
                                    <i class="fas fa-cubes field-icon"></i>
                                    <input type="number" id="stock" name="stock"
                                           value="{{ old('stock', $tool->stock) }}"
                                           class="field-input {{ $errors->has('stock') ? 'is-invalid' : '' }}"
                                           placeholder="0" min="0" required>
                                </div>
                                <p class="field-hint">Jumlah unit yang tersedia untuk disewa</p>
                                @error('stock')
                                    <div class="field-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        {{-- ── Kolom Kanan: Gambar & Status ── --}}
        <div class="col-lg-4">

            {{-- Gambar --}}
            <div class="form-card mb-4">
                <div class="form-card-header">
                    <div class="header-icon"><i class="fas fa-image"></i></div>
                    <div>
                        <h5>Foto Alat</h5>
                        <p>Kosongkan jika tidak ingin mengganti</p>
                    </div>
                </div>
                <div class="form-card-body">

                    {{-- Gambar saat ini --}}
                    @if($tool->image)
                        <div class="current-image-wrap">
                            <img src="{{ asset('storage/' . $tool->image) }}" alt="{{ $tool->name }}">
                            <div class="ci-info">
                                <strong>Foto saat ini</strong>
                                <span>Upload foto baru untuk mengganti</span>
                            </div>
                        </div>
                    @endif

                    {{-- Upload baru --}}
                    <div class="field-group">
                        <label class="field-label">{{ $tool->image ? 'Ganti Foto' : 'Upload Foto' }}</label>
                        <div class="file-upload-area" id="dropArea">
                            <input type="file" id="image" name="image"
                                   accept="image/*"
                                   class="{{ $errors->has('image') ? 'is-invalid' : '' }}"
                                   onchange="previewImage(this)">
                            <div class="upload-icon"><i class="fas fa-cloud-upload-alt"></i></div>
                            <p>Klik atau seret foto ke sini</p>
                            <span>JPG, PNG — Maks. 2MB</span>
                            <img id="newImagePreview" src="#" alt="Preview baru">
                        </div>
                        @error('image')
                            <div class="field-error mt-2"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                </div>
            </div>

            {{-- Status Ketersediaan --}}
            <div class="form-card mb-4">
                <div class="form-card-header">
                    <div class="header-icon"><i class="fas fa-toggle-on"></i></div>
                    <div>
                        <h5>Status Alat</h5>
                        <p>Ketersediaan untuk disewa</p>
                    </div>
                </div>
                <div class="form-card-body">
                    <label class="toggle-row" for="is_available">
                        <div class="toggle-info">
                            <strong>Tersedia untuk Disewa</strong>
                            <span>Alat akan muncul di halaman sewa publik</span>
                        </div>
                        <div class="custom-switch-wrap">
                            <input type="checkbox" id="is_available" name="is_available" value="1"
                                   {{ old('is_available', $tool->is_available) ? 'checked' : '' }}>
                            <span class="switch-slider"></span>
                        </div>
                    </label>
                </div>
            </div>

        </div>
    </div>

    {{-- Actions --}}
    <div class="form-actions mb-4">
        <button type="submit" class="btn-save">
            <i class="fas fa-save"></i> Simpan Perubahan
        </button>
        <a href="{{ route('studio.tools.index') }}" class="btn-cancel">
            Batal
        </a>
    </div>

</form>

@stop

@push('js')
<script>
    function previewImage(input) {
        const preview = document.getElementById('newImagePreview');
        const area    = document.getElementById('dropArea');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                preview.src = e.target.result;
                preview.style.display = 'block';
                area.querySelector('p').textContent = input.files[0].name;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    /* Focus effect untuk prefix Rp */
    document.getElementById('price_per_day').addEventListener('focus', function () {
        const rp = document.querySelector('.rp-prefix');
        if (rp) rp.style.color = '#0E7A96';
    });
    document.getElementById('price_per_day').addEventListener('blur', function () {
        const rp = document.querySelector('.rp-prefix');
        if (rp) rp.style.color = '#CBD5E1';
    });
</script>
@endpush