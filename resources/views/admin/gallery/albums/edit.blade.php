@extends('adminlte::page')

@section('title', 'Edit Album')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="mb-0" style="font-size: 1.4rem; font-weight: 700; color: #0D1B2A;">
                <i class="fas fa-edit me-2" style="color: #0E7A96;"></i> Edit Album
            </h1>
            <ol class="breadcrumb mb-0 mt-1" style="font-size: 0.8rem; background: transparent; padding: 0;">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.albums.index') }}">Album</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </div>
        <a href="{{ route('admin.albums.index') }}"
           style="display:inline-flex; align-items:center; gap:6px; background:#fff; border:1.5px solid #E2E8F0; color:#64748B; padding:9px 20px; border-radius:50px; font-weight:700; font-size:0.85rem; text-decoration:none; transition:all 0.3s;">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
@stop

@push('css')
<style>
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
    .sec-label::after { content:''; flex:1; height:1px; background:#E2E8F0; }

    .form-card {
        background: #fff;
        border: 1px solid #E2E8F0;
        border-radius: 18px;
        overflow: hidden;
        margin-bottom: 20px;
    }
    .form-card-header {
        padding: 16px 22px;
        border-bottom: 1px solid #F1F5F9;
        display: flex;
        align-items: center;
        gap: 10px;
        background: #F8FAFC;
    }
    .form-card-header-icon {
        width: 34px; height: 34px;
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 0.9rem; flex-shrink: 0;
    }
    .form-card-header-title { font-size: 0.9rem; font-weight: 700; color: #0D1B2A; }
    .form-card-header-sub   { font-size: 0.75rem; color: #94A3B8; margin-top: 1px; }
    .form-card-body         { padding: 22px 24px; }

    .form-label-custom {
        font-weight: 600; font-size: 0.8rem;
        color: #0D1B2A; margin-bottom: 6px; display: block;
    }
    .form-label-custom .required { color: #DC2626; margin-left: 2px; }

    .form-control-custom {
        width: 100%; border-radius: 12px; padding: 10px 14px;
        border: 1.5px solid #E2E8F0; font-size: 0.875rem;
        transition: all 0.3s; background: #F8FAFC;
        font-family: inherit; outline: none; color: #0D1B2A;
        appearance: none; -webkit-appearance: none;
    }
    .form-control-custom:focus {
        border-color: #4EB8CC;
        box-shadow: 0 0 0 3px rgba(78,184,204,0.12);
        background: #fff;
    }
    .form-control-custom::placeholder { color: #94A3B8; }
    .form-control-custom.is-invalid   { border-color: #DC2626; }
    .form-control-custom.is-invalid:focus { box-shadow: 0 0 0 3px rgba(220,38,38,0.1); }

    textarea.form-control-custom { resize: vertical; min-height: 100px; }

    .invalid-msg {
        font-size: 0.75rem; color: #DC2626; font-weight: 500;
        margin-top: 5px; display: flex; align-items: center; gap: 4px;
    }

    /* Current cover preview */
    .current-cover-wrap {
        position: relative;
        display: inline-block;
        border-radius: 14px;
        overflow: hidden;
        border: 2px solid #E2E8F0;
        margin-bottom: 14px;
    }
    .current-cover-wrap img {
        width: 100%; max-height: 180px;
        object-fit: cover; display: block;
    }
    .current-cover-badge {
        position: absolute; bottom: 0; left: 0; right: 0;
        background: rgba(13,27,42,0.65); color: #fff;
        font-size: 0.65rem; font-weight: 700;
        text-align: center; padding: 5px;
        backdrop-filter: blur(4px);
    }
    .no-cover-placeholder {
        width: 100%; height: 110px;
        border-radius: 12px; background: #F1F5F9;
        border: 1.5px dashed #CBD5E1;
        display: flex; flex-direction: column;
        align-items: center; justify-content: center;
        gap: 6px; margin-bottom: 14px;
        color: #94A3B8; font-size: 0.78rem; font-weight: 600;
    }
    .no-cover-placeholder i { font-size: 1.6rem; opacity: 0.35; }

    /* File upload */
    .file-upload-area {
        border: 2px dashed #E2E8F0;
        border-radius: 14px; padding: 20px 16px;
        text-align: center; cursor: pointer;
        transition: all 0.3s; background: #F8FAFC;
        position: relative;
    }
    .file-upload-area:hover { border-color: #4EB8CC; background: #EEF9FC; }
    .file-upload-area input[type="file"] {
        position: absolute; inset: 0; opacity: 0;
        cursor: pointer; width: 100%; height: 100%;
    }
    .file-upload-icon {
        width: 40px; height: 40px; border-radius: 12px;
        background: #EEF9FC; color: #0E7A96;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.1rem; margin: 0 auto 8px;
    }
    .file-upload-text  { font-size: 0.82rem; font-weight: 600; color: #0D1B2A; margin-bottom: 3px; }
    .file-upload-hint  { font-size: 0.7rem; color: #94A3B8; }
    .file-preview {
        display:none; margin-top:12px;
        border-radius:10px; overflow:hidden;
        max-height:160px; object-fit:cover; width:100%;
    }

    /* Form actions */
    .form-actions {
        display: flex; align-items: center; gap: 12px;
        padding: 20px 24px; background: #F8FAFC;
        border-top: 1px solid #F1F5F9;
        border-radius: 0 0 18px 18px;
    }
    .btn-submit {
        display:inline-flex; align-items:center; gap:7px;
        background:linear-gradient(135deg, #0E7A96, #4EB8CC);
        border:none; border-radius:12px; padding:11px 28px;
        font-weight:700; font-size:0.88rem; color:#fff;
        cursor:pointer; transition:all 0.3s;
    }
    .btn-submit:hover { transform:translateY(-2px); box-shadow:0 8px 20px rgba(14,122,150,0.3); }
    .btn-cancel {
        display:inline-flex; align-items:center; gap:7px;
        background:#fff; border:1.5px solid #E2E8F0; border-radius:12px;
        padding:10px 22px; font-weight:600; font-size:0.88rem;
        color:#64748B; text-decoration:none; transition:all 0.2s;
    }
    .btn-cancel:hover { background:#F1F5F9; color:#475569; text-decoration:none; }

    .alert-custom {
        border-radius:12px; font-size:0.85rem; padding:12px 16px;
        border:none; margin-bottom:20px;
        display:flex; align-items:center; gap:8px;
    }
    .alert-custom.error { background:#FEE2E2; color:#991B1B; }
</style>
@endpush

@section('content')

    @if($errors->any())
        <div class="alert-custom error">
            <i class="fas fa-exclamation-triangle"></i>
            Terdapat {{ $errors->count() }} kesalahan. Silakan periksa kembali formulir di bawah.
        </div>
    @endif

    <form action="{{ route('admin.albums.update', $album) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <p class="sec-label">Informasi Album</p>

        <div class="row g-3 mb-2">

            {{-- Kolom Kiri — Detail --}}
            <div class="col-lg-8">
                <div class="form-card">
                    <div class="form-card-header">
                        <div class="form-card-header-icon" style="background:#EEF9FC; color:#0E7A96;">
                            <i class="fas fa-images"></i>
                        </div>
                        <div>
                            <div class="form-card-header-title">Detail Album</div>
                            <div class="form-card-header-sub">Nama, tahun, dan deskripsi album</div>
                        </div>
                    </div>
                    <div class="form-card-body">

                        <div class="row g-3 mb-3">
                            <div class="col-md-8">
                                <label class="form-label-custom">Nama Album <span class="required">*</span></label>
                                <input type="text" name="name"
                                       class="form-control-custom {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                       value="{{ old('name', $album->name) }}"
                                       placeholder="Masukkan nama album..."
                                       required autofocus>
                                @error('name')
                                    <div class="invalid-msg"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label class="form-label-custom">Tahun <span class="required">*</span></label>
                                <input type="number" name="year"
                                       class="form-control-custom {{ $errors->has('year') ? 'is-invalid' : '' }}"
                                       value="{{ old('year', $album->year) }}"
                                       min="2000" max="2099"
                                       placeholder="{{ date('Y') }}"
                                       required>
                                @error('year')
                                    <div class="invalid-msg"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label class="form-label-custom">Deskripsi</label>
                            <textarea name="description"
                                      class="form-control-custom {{ $errors->has('description') ? 'is-invalid' : '' }}"
                                      placeholder="Tuliskan deskripsi singkat album...">{{ old('description', $album->description) }}</textarea>
                            @error('description')
                                <div class="invalid-msg"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                </div>
            </div>

            {{-- Kolom Kanan — Cover --}}
            <div class="col-lg-4">
                <div class="form-card">
                    <div class="form-card-header">
                        <div class="form-card-header-icon" style="background:#FEF3C7; color:#D97706;">
                            <i class="fas fa-image"></i>
                        </div>
                        <div>
                            <div class="form-card-header-title">Cover Album</div>
                            <div class="form-card-header-sub">Kosongkan jika tidak ingin mengubah</div>
                        </div>
                    </div>
                    <div class="form-card-body">

                        {{-- Cover aktif --}}
                        @if($album->cover_image)
                            <div class="current-cover-wrap" style="width:100%;">
                                <img src="{{ asset('storage/' . $album->cover_image) }}" alt="{{ $album->name }}">
                                <div class="current-cover-badge"><i class="fas fa-check-circle me-1"></i>Cover aktif</div>
                            </div>
                        @else
                            <div class="no-cover-placeholder">
                                <i class="fas fa-image"></i>
                                Belum ada cover
                            </div>
                        @endif

                        {{-- Upload baru --}}
                        <div class="file-upload-area" id="coverArea">
                            <input type="file" name="cover_image" id="coverInput" accept="image/*">
                            <div class="file-upload-icon" id="coverUploadIcon"><i class="fas fa-cloud-upload-alt"></i></div>
                            <div class="file-upload-text" id="coverUploadText">Klik untuk ganti cover</div>
                            <div class="file-upload-hint">JPG, PNG — Maks. 2MB</div>
                            <img id="coverPreview" class="file-preview" alt="Preview Cover Baru">
                        </div>
                        @error('cover_image')
                            <div class="invalid-msg mt-2"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror

                    </div>
                </div>
            </div>

        </div>

        {{-- Form Actions --}}
        <div class="form-card">
            <div class="form-actions">
                <button type="submit" class="btn-submit">
                    <i class="fas fa-save"></i> Update Album
                </button>
                <a href="{{ route('admin.albums.index') }}" class="btn-cancel">
                    <i class="fas fa-times"></i> Batal
                </a>
            </div>
        </div>

    </form>

@stop

@push('js')
<script>
    document.getElementById('coverInput').addEventListener('change', function () {
        const file = this.files[0];
        if (!file) return;
        const preview = document.getElementById('coverPreview');
        preview.src = URL.createObjectURL(file);
        preview.style.display = 'block';
        document.getElementById('coverUploadText').textContent = file.name;
        document.getElementById('coverUploadIcon').style.display = 'none';
    });
</script>
@endpush