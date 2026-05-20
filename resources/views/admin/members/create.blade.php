@extends('adminlte::page')

@section('title', 'Tambah Anggota Tim')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="mb-0" style="font-size: 1.4rem; font-weight: 700; color: #0D1B2A;">
                <i class="fas fa-user-plus me-2" style="color: #0E7A96;"></i> Tambah Anggota Tim
            </h1>
            <ol class="breadcrumb mb-0 mt-1" style="font-size: 0.8rem; background: transparent; padding: 0;">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.members.index') }}">Anggota Tim</a></li>
                <li class="breadcrumb-item active">Tambah</li>
            </ol>
        </div>
        <a href="{{ route('admin.members.index') }}"
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
    .field-select,
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
        appearance: none;
        -webkit-appearance: none;
    }

    .field-input:focus,
    .field-select:focus,
    .field-textarea:focus {
        border-color: #0E7A96;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(14,122,150,0.08);
    }

    .field-input.is-invalid,
    .field-select.is-invalid,
    .field-textarea.is-invalid {
        border-color: #DC2626;
        background: #FEF2F2;
    }

    .field-input::placeholder,
    .field-textarea::placeholder { color: #CBD5E1; }

    .field-textarea { resize: vertical; min-height: 80px; }

    /* Select arrow */
    .field-select-wrap { position: relative; }
    .field-select-wrap::after {
        content: '\f078';
        font-family: 'Font Awesome 5 Free';
        font-weight: 900;
        position: absolute;
        right: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #CBD5E1;
        font-size: 0.7rem;
        pointer-events: none;
    }

    /* Input with icon */
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
       FILE UPLOAD
       ============================================ */
    .file-upload-area {
        border: 1.5px dashed #CBD5E1;
        border-radius: 10px;
        background: #F8FAFC;
        padding: 18px;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s;
        position: relative;
    }

    .file-upload-area:hover,
    .file-upload-area.dragover {
        border-color: #0E7A96;
        background: rgba(14,122,150,0.04);
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
        width: 40px; height: 40px;
        background: rgba(14,122,150,0.1);
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        color: #0E7A96;
        font-size: 1rem;
        margin: 0 auto 10px;
    }

    .file-upload-area p {
        margin: 0;
        font-size: 0.8rem;
        color: #64748B;
        font-weight: 600;
    }

    .file-upload-area span {
        font-size: 0.72rem;
        color: #94A3B8;
    }

    #photoPreview {
        display: none;
        width: 70px; height: 70px;
        border-radius: 12px;
        object-fit: cover;
        border: 2px solid #E2E8F0;
        margin: 10px auto 0;
    }

    /* ============================================
       CHECKBOX GRID (Divisi)
       ============================================ */
    .checkbox-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
        gap: 8px;
        margin-top: 4px;
    }

    .checkbox-item {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 9px 12px;
        border: 1.5px solid #E2E8F0;
        border-radius: 10px;
        background: #F8FAFC;
        cursor: pointer;
        transition: all 0.18s;
        user-select: none;
    }

    .checkbox-item:hover { border-color: #0E7A96; background: rgba(14,122,150,0.04); }

    .checkbox-item input[type="checkbox"] {
        width: 15px; height: 15px;
        accent-color: #0E7A96;
        cursor: pointer;
        flex-shrink: 0;
    }

    .checkbox-item input[type="checkbox"]:checked + span {
        color: #0E7A96;
        font-weight: 700;
    }

    .checkbox-item:has(input:checked) {
        border-color: #0E7A96;
        background: rgba(14,122,150,0.07);
    }

    .checkbox-item span {
        font-size: 0.82rem;
        font-weight: 600;
        color: #64748B;
        transition: color 0.18s;
        line-height: 1.3;
    }

    /* ============================================
       SOCIAL PLATFORM COMBO
       ============================================ */
    .social-combo {
        display: flex;
        gap: 10px;
        align-items: flex-start;
    }

    .social-combo .field-select-wrap { flex: 0 0 180px; }
    .social-combo .field-input-wrap  { flex: 1; }

    /* Social hint pill */
    #socialHint {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: rgba(14,122,150,0.07);
        color: #0E7A96;
        border-radius: 50px;
        padding: 4px 12px;
        font-size: 0.72rem;
        font-weight: 600;
        margin-top: 8px;
        transition: all 0.2s;
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

<form action="{{ route('admin.members.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="row">

        {{-- ── Kolom Kiri: Identitas ── --}}
        <div class="col-lg-7">
            <div class="form-card mb-4">
                <div class="form-card-header">
                    <div class="header-icon"><i class="fas fa-id-card"></i></div>
                    <div>
                        <h5>Identitas Anggota</h5>
                        <p>Nama, panggilan, jabatan, dan divisi</p>
                    </div>
                </div>
                <div class="form-card-body">

                    {{-- Nama Lengkap --}}
                    <div class="field-group">
                        <label for="name" class="field-label">
                            Nama Lengkap <span class="required">*</span>
                        </label>
                        <input type="text" id="name" name="name"
                               value="{{ old('name') }}"
                               class="field-input {{ $errors->has('name') ? 'is-invalid' : '' }}"
                               placeholder="Masukkan nama lengkap" required>
                        @error('name')
                            <div class="field-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Nama Panggilan --}}
                    <div class="field-group">
                        <label for="nickname" class="field-label">
                            Nama Panggilan <span class="required">*</span>
                        </label>
                        <input type="text" id="nickname" name="nickname"
                               value="{{ old('nickname') }}"
                               class="field-input {{ $errors->has('nickname') ? 'is-invalid' : '' }}"
                               placeholder="Masukkan nama panggilan" required>
                        @error('nickname')
                            <div class="field-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Posisi / Jabatan --}}
                    <div class="field-group">
                        <label for="position" class="field-label">Posisi / Jabatan</label>
                        <div class="field-input-wrap">
                            <i class="fas fa-briefcase field-icon"></i>
                            <input type="text" id="position" name="position"
                                   value="{{ old('position') }}"
                                   class="field-input {{ $errors->has('position') ? 'is-invalid' : '' }}"
                                   placeholder="Contoh: Ketua Divisi, Staff Kreatif">
                        </div>
                        @error('position')
                            <div class="field-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <hr class="form-divider">
                    <p class="form-section-label"><i class="fas fa-layer-group"></i> Divisi</p>

                    {{-- Divisi Checkbox --}}
                    <div class="field-group">
                        <label class="field-label">
                            Pilih Divisi <span class="required">*</span>
                        </label>
                        <div class="checkbox-grid">
                            @foreach($divisions as $div)
                                <label class="checkbox-item" for="div_{{ $div->id }}">
                                    <input type="checkbox"
                                           id="div_{{ $div->id }}"
                                           name="division_ids[]"
                                           value="{{ $div->id }}"
                                           {{ in_array($div->id, old('division_ids', [])) ? 'checked' : '' }}>
                                    <span>{{ $div->name }}</span>
                                </label>
                            @endforeach
                        </div>
                        @error('division_ids')
                            <div class="field-error mt-2"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                        <p class="field-hint">Bisa memilih lebih dari satu divisi.</p>
                    </div>

                </div>
            </div>
        </div>

        {{-- ── Kolom Kanan: Foto & Pengaturan ── --}}
        <div class="col-lg-5">

            {{-- Foto Profil --}}
            <div class="form-card mb-4">
                <div class="form-card-header">
                    <div class="header-icon"><i class="fas fa-camera"></i></div>
                    <div>
                        <h5>Foto Profil</h5>
                        <p>Upload foto anggota (opsional)</p>
                    </div>
                </div>
                <div class="form-card-body">
                    <div class="field-group">
                        <div class="file-upload-area" id="dropArea">
                            <input type="file" id="photo" name="photo"
                                   accept="image/*"
                                   class="{{ $errors->has('photo') ? 'is-invalid' : '' }}"
                                   onchange="previewPhoto(this)">
                            <div class="upload-icon"><i class="fas fa-cloud-upload-alt"></i></div>
                            <p>Klik atau seret foto ke sini</p>
                            <span>JPG, PNG — Maks. 2MB</span>
                            <img id="photoPreview" src="#" alt="Preview">
                        </div>
                        @error('photo')
                            <div class="field-error mt-2"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                        <p class="field-hint">Ukuran ideal: 300 × 400px (portrait).</p>
                    </div>
                </div>
            </div>

            {{-- Media Sosial --}}
            <div class="form-card mb-4">
                <div class="form-card-header">
                    <div class="header-icon"><i class="fas fa-share-alt"></i></div>
                    <div>
                        <h5>Media Sosial</h5>
                        <p>Platform & username (opsional)</p>
                    </div>
                </div>
                <div class="form-card-body">
                    <div class="field-group">
                        <label class="field-label">Platform & Username</label>
                        <div class="social-combo">
                            <div class="field-select-wrap">
                                <select name="social_platform" id="socialPlatform" class="field-select">
                                    <option value="">-- Platform --</option>
                                    <option value="instagram" {{ old('social_platform') == 'instagram' ? 'selected' : '' }}>Instagram</option>
                                    <option value="twitter"   {{ old('social_platform') == 'twitter'   ? 'selected' : '' }}>Twitter / X</option>
                                    <option value="linkedin"  {{ old('social_platform') == 'linkedin'  ? 'selected' : '' }}>LinkedIn</option>
                                    <option value="github"    {{ old('social_platform') == 'github'    ? 'selected' : '' }}>GitHub</option>
                                    <option value="tiktok"    {{ old('social_platform') == 'tiktok'    ? 'selected' : '' }}>TikTok</option>
                                    <option value="facebook"  {{ old('social_platform') == 'facebook'  ? 'selected' : '' }}>Facebook</option>
                                    <option value="youtube"   {{ old('social_platform') == 'youtube'   ? 'selected' : '' }}>YouTube</option>
                                    <option value="whatsapp"  {{ old('social_platform') == 'whatsapp'  ? 'selected' : '' }}>WhatsApp</option>
                                    <option value="telegram"  {{ old('social_platform') == 'telegram'  ? 'selected' : '' }}>Telegram</option>
                                </select>
                            </div>
                            <div class="field-input-wrap" style="flex:1;">
                                <i class="fas fa-at field-icon" id="socialIcon"></i>
                                <input type="text"
                                       name="social_username"
                                       id="socialUsername"
                                       class="field-input {{ $errors->has('social_username') ? 'is-invalid' : '' }}"
                                       placeholder="username"
                                       value="{{ old('social_username') }}">
                            </div>
                        </div>
                        @error('social_username')
                            <div class="field-error mt-2"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                        <span id="socialHint"><i class="fas fa-info-circle"></i> Pilih platform terlebih dahulu</span>
                    </div>
                </div>
            </div>

            {{-- Pengaturan --}}
            <div class="form-card mb-4">
                <div class="form-card-header">
                    <div class="header-icon"><i class="fas fa-sliders-h"></i></div>
                    <div>
                        <h5>Pengaturan</h5>
                        <p>Urutan tampil dan status aktif</p>
                    </div>
                </div>
                <div class="form-card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="field-group">
                                <label for="order" class="field-label">Urutan Tampil</label>
                                <input type="number" id="order" name="order"
                                       value="{{ old('order', 0) }}" min="0"
                                       class="field-input">
                                <p class="field-hint">Angka kecil = tampil lebih awal</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="field-group">
                                <label for="is_active" class="field-label">Status</label>
                                <div class="field-select-wrap">
                                    <select name="is_active" id="is_active" class="field-select">
                                        <option value="1" {{ old('is_active', 1) == '1' ? 'selected' : '' }}>Aktif</option>
                                        <option value="0" {{ old('is_active') == '0'     ? 'selected' : '' }}>Nonaktif</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- Actions --}}
    <div class="form-actions mb-4">
        <button type="submit" class="btn-save">
            <i class="fas fa-save"></i> Simpan Anggota
        </button>
        <a href="{{ route('admin.members.index') }}" class="btn-cancel">
            Batal
        </a>
    </div>

</form>

@stop

@push('js')
<script>
    /* ── Photo preview ── */
    function previewPhoto(input) {
        const preview = document.getElementById('photoPreview');
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

    /* ── Social platform dynamic hint ── */
    const platformConfig = {
        instagram: { placeholder: 'username',                       hint: 'Username Instagram (tanpa @)',              icon: 'fa-instagram',  fab: true  },
        twitter:   { placeholder: 'username',                       hint: 'Username Twitter/X (tanpa @)',              icon: 'fa-twitter',    fab: true  },
        linkedin:  { placeholder: 'https://linkedin.com/in/...',    hint: 'Link profil LinkedIn lengkap',              icon: 'fa-linkedin',   fab: true  },
        github:    { placeholder: 'username',                       hint: 'Username GitHub',                           icon: 'fa-github',     fab: true  },
        tiktok:    { placeholder: 'username',                       hint: 'Username TikTok (tanpa @)',                 icon: 'fa-tiktok',     fab: true  },
        facebook:  { placeholder: 'username',                       hint: 'Username Facebook',                         icon: 'fa-facebook',   fab: true  },
        youtube:   { placeholder: '@channelname',                   hint: 'Username YouTube (tanpa @)',                icon: 'fa-youtube',    fab: true  },
        whatsapp:  { placeholder: '6281234567890',                  hint: 'Nomor dengan kode negara, contoh: 628xxx', icon: 'fa-whatsapp',   fab: true  },
        telegram:  { placeholder: 'username',                       hint: 'Username Telegram (tanpa @)',               icon: 'fa-telegram',   fab: true  },
    };

    const platformSelect = document.getElementById('socialPlatform');
    const usernameInput  = document.getElementById('socialUsername');
    const hintEl         = document.getElementById('socialHint');
    const iconEl         = document.getElementById('socialIcon');

    platformSelect.addEventListener('change', function () {
        const cfg = platformConfig[this.value];
        if (cfg) {
            usernameInput.placeholder = cfg.placeholder;
            hintEl.innerHTML = `<i class="fas fa-info-circle"></i> ${cfg.hint}`;
            iconEl.className = `${cfg.fab ? 'fab' : 'fas'} ${cfg.icon} field-icon`;
        } else {
            usernameInput.placeholder = 'username atau link';
            hintEl.innerHTML = '<i class="fas fa-info-circle"></i> Pilih platform terlebih dahulu';
            iconEl.className = 'fas fa-at field-icon';
        }
    });

    if (platformSelect.value) platformSelect.dispatchEvent(new Event('change'));
</script>
@endpush