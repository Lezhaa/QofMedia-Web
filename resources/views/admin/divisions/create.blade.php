@extends('adminlte::page')

@section('title', 'Tambah Divisi')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="mb-0" style="font-size: 1.4rem; font-weight: 700; color: #0D1B2A;">
                <i class="fas fa-plus-circle me-2" style="color: #0E7A96;"></i> Tambah Divisi
            </h1>
            <ol class="breadcrumb mb-0 mt-1" style="font-size: 0.8rem; background: transparent; padding: 0;">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.divisions.index') }}">Divisi</a></li>
                <li class="breadcrumb-item active">Tambah</li>
            </ol>
        </div>
        <a href="{{ route('admin.divisions.index') }}"
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
        max-width: 680px;
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

    .form-card-body {
        padding: 28px;
    }

    /* ============================================
       FORM ELEMENTS
       ============================================ */
    .field-group {
        margin-bottom: 20px;
    }

    .field-label {
        display: block;
        font-size: 0.78rem;
        font-weight: 700;
        color: #0D1B2A;
        margin-bottom: 7px;
        letter-spacing: 0.02em;
    }

    .field-label .required {
        color: #DC2626;
        margin-left: 3px;
    }

    .field-hint {
        font-size: 0.73rem;
        color: #94A3B8;
        margin-top: 5px;
    }

    /* Input & Textarea */
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
    .field-input-wrap {
        position: relative;
        display: flex;
        align-items: center;
    }

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

    /* Error message */
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
       DIVIDER
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
    }

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

    <div class="form-card">
        <div class="form-card-header">
            <div class="header-icon"><i class="fas fa-sitemap"></i></div>
            <div>
                <h5>Informasi Divisi</h5>
                <p>Isi detail divisi baru yang akan ditambahkan</p>
            </div>
        </div>

        <div class="form-card-body">
            <form action="{{ route('admin.divisions.store') }}" method="POST">
                @csrf

                {{-- Nama Divisi --}}
                <div class="field-group">
                    <label for="name" class="field-label">
                        Nama Divisi <span class="required">*</span>
                    </label>
                    <input type="text"
                           id="name"
                           name="name"
                           value="{{ old('name') }}"
                           class="field-input {{ $errors->has('name') ? 'is-invalid' : '' }}"
                           placeholder="Contoh: Broadcasting"
                           required>
                    @error('name')
                        <div class="field-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>

                {{-- Deskripsi --}}
                <div class="field-group">
                    <label for="description" class="field-label">Deskripsi</label>
                    <textarea id="description"
                              name="description"
                              class="field-textarea {{ $errors->has('description') ? 'is-invalid' : '' }}"
                              placeholder="Deskripsi singkat divisi...">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="field-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>

                <hr class="form-divider">
                <p class="form-section-label"><i class="fas fa-cog me-1"></i> Pengaturan Tambahan</p>

                <div class="row">
                    {{-- Instagram --}}
                    <div class="col-md-6">
                        <div class="field-group">
                            <label for="instagram" class="field-label">Instagram</label>
                            <div class="field-input-wrap">
                                <i class="fab fa-instagram field-icon"></i>
                                <input type="text"
                                       id="instagram"
                                       name="instagram"
                                       value="{{ old('instagram') }}"
                                       class="field-input {{ $errors->has('instagram') ? 'is-invalid' : '' }}"
                                       placeholder="@qofmedia.divisi">
                            </div>
                            @error('instagram')
                                <div class="field-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Urutan --}}
                    <div class="col-md-6">
                        <div class="field-group">
                            <label for="order" class="field-label">Urutan Tampil</label>
                            <input type="number"
                                   id="order"
                                   name="order"
                                   value="{{ old('order', 0) }}"
                                   min="0"
                                   class="field-input {{ $errors->has('order') ? 'is-invalid' : '' }}"
                                   placeholder="0">
                            <p class="field-hint">Angka kecil = tampil lebih awal</p>
                            @error('order')
                                <div class="field-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Actions --}}
                <div class="form-actions">
                    <button type="submit" class="btn-save">
                        <i class="fas fa-save"></i> Simpan Divisi
                    </button>
                    <a href="{{ route('admin.divisions.index') }}" class="btn-cancel">
                        Batal
                    </a>
                </div>

            </form>
        </div>
    </div>

@stop