@extends('adminlte::page')

@section('title', 'Edit Anggota: ' . $member->name)

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="mb-0" style="font-size: 1.4rem; font-weight: 700; color: #0D1B2A;">
                <i class="fas fa-user-edit me-2" style="color: #0E7A96;"></i> Edit Anggota
            </h1>
            <ol class="breadcrumb mb-0 mt-1" style="font-size: 0.8rem; background: transparent; padding: 0;">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.members.index') }}">Anggota Tim</a></li>
                <li class="breadcrumb-item active">Edit</li>
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
       LAYOUT WRAPPER
       ============================================ */
    .edit-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        align-items: start;
    }
    @media (max-width: 768px) {
        .edit-grid { grid-template-columns: 1fr; }
    }

    /* ============================================
       SECTION CARD
       ============================================ */
    .section-card {
        background: #fff;
        border: 1px solid #E2E8F0;
        border-radius: 20px;
        overflow: hidden;
    }
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
        color: #0E7A96;
        font-size: 0.85rem;
        flex-shrink: 0;
    }
    .section-card-header h6 {
        margin: 0;
        font-size: 0.88rem;
        font-weight: 700;
        color: #0D1B2A;
    }
    .section-card-body {
        padding: 24px;
    }

    /* ============================================
       FORM FIELDS
       ============================================ */
    .field-group {
        margin-bottom: 18px;
    }
    .field-group:last-child { margin-bottom: 0; }

    .field-label {
        display: block;
        font-size: 0.78rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        color: #94A3B8;
        margin-bottom: 7px;
    }
    .field-label .req { color: #EF4444; margin-left: 2px; }

    .field-input {
        width: 100%;
        border: 1.5px solid #E2E8F0;
        border-radius: 10px;
        padding: 10px 14px;
        font-size: 0.88rem;
        color: #0D1B2A;
        background: #F8FAFC;
        outline: none;
        transition: border-color 0.2s, background 0.2s, box-shadow 0.2s;
        box-sizing: border-box;
    }
    .field-input:focus {
        border-color: #0E7A96;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(14,122,150,0.10);
    }
    .field-input.is-invalid {
        border-color: #EF4444;
        background: #FFF5F5;
    }
    .field-input.is-invalid:focus {
        box-shadow: 0 0 0 3px rgba(239,68,68,0.10);
    }
    .invalid-msg {
        font-size: 0.76rem;
        color: #EF4444;
        margin-top: 5px;
        display: flex;
        align-items: center;
        gap: 4px;
    }
    .field-hint {
        font-size: 0.76rem;
        color: #94A3B8;
        margin-top: 5px;
    }

    /* ============================================
       SELECT
       ============================================ */
    select.field-input {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2394A3B8' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 12px center;
        padding-right: 32px;
    }

    /* ============================================
       SOCIAL ROW
       ============================================ */
    .social-row {
        display: grid;
        grid-template-columns: 185px 1fr;
        gap: 10px;
    }

    /* ============================================
       DIVISION CHECKBOXES
       ============================================ */
    .div-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(130px, 1fr));
        gap: 8px;
        margin-top: 4px;
    }
    .div-check-item {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 9px 12px;
        border: 1.5px solid #E2E8F0;
        border-radius: 10px;
        cursor: pointer;
        transition: border-color 0.2s, background 0.2s;
        background: #F8FAFC;
    }
    .div-check-item:hover { border-color: #0E7A96; background: #EEF9FC; }
    .div-check-item input[type="checkbox"] { display: none; }
    .div-check-item .check-box {
        width: 18px; height: 18px;
        border: 2px solid #CBD5E1;
        border-radius: 5px;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
        transition: all 0.2s;
    }
    .div-check-item .check-box i { display: none; font-size: 0.65rem; color: #fff; }
    .div-check-item input:checked ~ .check-box {
        background: #0E7A96;
        border-color: #0E7A96;
    }
    .div-check-item input:checked ~ .check-box i { display: block; }
    .div-check-item .check-label {
        font-size: 0.82rem;
        font-weight: 600;
        color: #0D1B2A;
    }
    .div-check-item input:checked ~ .check-label { color: #0E7A96; }
    .div-check-selected { border-color: #0E7A96 !important; background: rgba(14,122,150,0.05) !important; }

    /* ============================================
       PHOTO PREVIEW
       ============================================ */
    .photo-area {
        display: flex;
        align-items: center;
        gap: 18px;
        padding: 16px;
        background: #F8FAFC;
        border: 1.5px dashed #E2E8F0;
        border-radius: 14px;
        margin-bottom: 14px;
        transition: border-color 0.2s;
    }
    .photo-area:hover { border-color: #0E7A96; }
    .photo-preview-img {
        width: 72px; height: 72px;
        border-radius: 16px;
        object-fit: cover;
        border: 2px solid #E2E8F0;
        flex-shrink: 0;
    }
    .photo-avatar {
        width: 72px; height: 72px;
        border-radius: 16px;
        background: linear-gradient(135deg, #0E7A96, #0a5a70);
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
    }
    .photo-avatar span {
        color: #fff;
        font-weight: 800;
        font-size: 1.8rem;
        line-height: 1;
    }
    .photo-meta { flex: 1; }
    .photo-meta strong {
        display: block;
        font-size: 0.85rem;
        font-weight: 700;
        color: #0D1B2A;
        margin-bottom: 3px;
    }
    .photo-meta span {
        font-size: 0.76rem;
        color: #94A3B8;
    }

    /* ============================================
       ORDER + STATUS ROW
       ============================================ */
    .two-col {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px;
    }

    /* ============================================
       STATUS BADGE SELECT
       ============================================ */
    .status-wrap {
        position: relative;
    }
    .status-indicator {
        position: absolute;
        left: 12px; top: 50%;
        transform: translateY(-50%);
        width: 8px; height: 8px;
        border-radius: 50%;
        background: #10B981;
        pointer-events: none;
        transition: background 0.2s;
    }
    .status-indicator.inactive { background: #94A3B8; }
    select#is_active { padding-left: 28px; }

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
        flex-wrap: wrap;
    }
    .action-bar .left-info {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 0.82rem;
        color: #94A3B8;
    }
    .action-bar .left-info i { color: #CBD5E1; }
    .btn-save {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #0E7A96;
        color: #fff;
        padding: 11px 28px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.88rem;
        border: none;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.25s;
        box-shadow: 0 4px 14px rgba(14,122,150,0.28);
    }
    .btn-save:hover {
        background: #0a5a70;
        box-shadow: 0 6px 20px rgba(14,122,150,0.38);
        transform: translateY(-1px);
        color: #fff;
    }
    .btn-cancel {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: #F8FAFC;
        color: #64748B;
        padding: 11px 22px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.88rem;
        border: 1.5px solid #E2E8F0;
        text-decoration: none;
        transition: all 0.2s;
    }
    .btn-cancel:hover {
        background: #F1F5F9;
        color: #0D1B2A;
        text-decoration: none;
    }

    /* ============================================
       SOCIAL HINT BOX
       ============================================ */
    .social-hint-box {
        margin-top: 8px;
        padding: 9px 12px;
        background: rgba(14,122,150,0.06);
        border-radius: 8px;
        border-left: 3px solid #0E7A96;
        font-size: 0.76rem;
        color: #0E7A96;
        display: none;
    }
    .social-hint-box.visible { display: block; }

    /* ============================================
       ALERT SUCCESS
       ============================================ */
    .alert-success-custom {
        border-radius: 12px;
        border: none;
        background: #D1FAE5;
        color: #065F46;
        font-size: 0.88rem;
        padding: 12px 18px;
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 20px;
    }
</style>
@endpush

@section('content')

    {{-- Alert --}}
    @if(session('success'))
        <div class="alert-success-custom alert-dismissible">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="close ml-auto" data-dismiss="alert"
                    style="background:none; border:none; cursor:pointer; color:#065F46; font-size:1rem;">&times;</button>
        </div>
    @endif

    <form action="{{ route('admin.members.update', $member) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="edit-grid">

            {{-- ==================== KOLOM KIRI ==================== --}}
            <div style="display:flex; flex-direction:column; gap:20px;">

                {{-- Identitas --}}
                <div class="section-card">
                    <div class="section-card-header">
                        <div class="icon-wrap"><i class="fas fa-id-card"></i></div>
                        <h6>Identitas Anggota</h6>
                    </div>
                    <div class="section-card-body">

                        {{-- Nama Lengkap --}}
                        <div class="field-group">
                            <label class="field-label" for="name">Nama Lengkap <span class="req">*</span></label>
                            <input type="text"
                                   id="name" name="name"
                                   class="field-input @error('name') is-invalid @enderror"
                                   value="{{ old('name', $member->name) }}"
                                   placeholder="Masukkan nama lengkap"
                                   required>
                            @error('name')
                                <div class="invalid-msg"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Nama Panggilan --}}
                        <div class="field-group">
                            <label class="field-label" for="nickname">Nama Panggilan <span class="req">*</span></label>
                            <input type="text"
                                   id="nickname" name="nickname"
                                   class="field-input @error('nickname') is-invalid @enderror"
                                   value="{{ old('nickname', $member->nickname) }}"
                                   placeholder="Masukkan nama panggilan"
                                   required>
                            @error('nickname')
                                <div class="invalid-msg"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Posisi --}}
                        <div class="field-group">
                            <label class="field-label" for="position">Posisi / Jabatan</label>
                            <input type="text"
                                   id="position" name="position"
                                   class="field-input @error('position') is-invalid @enderror"
                                   value="{{ old('position', $member->position) }}"
                                   placeholder="Contoh: Ketua Divisi, Staff Kreatif">
                            @error('position')
                                <div class="invalid-msg"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                </div>

                {{-- Divisi --}}
                <div class="section-card">
                    <div class="section-card-header">
                        <div class="icon-wrap"><i class="fas fa-layer-group"></i></div>
                        <h6>Divisi <span style="color:#EF4444; margin-left:2px;">*</span></h6>
                    </div>
                    <div class="section-card-body">
                        <div class="div-grid">
                            @foreach($divisions as $div)
                                <label class="div-check-item {{ in_array($div->id, old('division_ids', $selectedDivisions)) ? 'div-check-selected' : '' }}"
                                       id="label_div_{{ $div->id }}">
                                    <input type="checkbox"
                                           name="division_ids[]"
                                           value="{{ $div->id }}"
                                           {{ in_array($div->id, old('division_ids', $selectedDivisions)) ? 'checked' : '' }}
                                           onchange="toggleDiv(this)">
                                    <span class="check-box"><i class="fas fa-check"></i></span>
                                    <span class="check-label">{{ $div->name }}</span>
                                </label>
                            @endforeach
                        </div>
                        @error('division_ids')
                            <div class="invalid-msg mt-2"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                        <p class="field-hint mt-2" style="margin-bottom:0;">Bisa pilih lebih dari satu divisi.</p>
                    </div>
                </div>

            </div>

            {{-- ==================== KOLOM KANAN ==================== --}}
            <div style="display:flex; flex-direction:column; gap:20px;">

                {{-- Foto --}}
                <div class="section-card">
                    <div class="section-card-header">
                        <div class="icon-wrap"><i class="fas fa-camera"></i></div>
                        <h6>Foto Profil</h6>
                    </div>
                    <div class="section-card-body">

                        {{-- Preview --}}
                        <div class="photo-area">
                            @if($member->photo_url)
                                <img src="{{ $member->photo_url }}"
                                     class="photo-preview-img"
                                     id="photoPreview"
                                     alt="{{ $member->nickname }}">
                            @else
                                <div class="photo-avatar" id="photoAvatar">
                                    <span>{{ strtoupper(substr($member->nickname, 0, 1)) }}</span>
                                </div>
                                <img src="" class="photo-preview-img" id="photoPreview"
                                     style="display:none;" alt="Preview">
                            @endif
                            <div class="photo-meta">
                                <strong>{{ $member->nickname }}</strong>
                                <span>
                                    @if($member->photo_url)
                                        Foto terpasang. Unggah baru untuk mengganti.
                                    @else
                                        Belum ada foto. Unggah foto profil.
                                    @endif
                                </span>
                            </div>
                        </div>

                        {{-- Upload --}}
                        <div class="field-group">
                            <label class="field-label" for="photo">Ganti Foto</label>
                            <input type="file"
                                   id="photo" name="photo"
                                   class="field-input @error('photo') is-invalid @enderror"
                                   accept="image/*"
                                   onchange="previewPhoto(this)">
                            <p class="field-hint">Kosongkan jika tidak ingin mengganti. JPG / PNG, maks 2MB.</p>
                            @error('photo')
                                <div class="invalid-msg"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                </div>

                {{-- Media Sosial --}}
                <div class="section-card">
                    <div class="section-card-header">
                        <div class="icon-wrap"><i class="fas fa-share-alt"></i></div>
                        <h6>Media Sosial <span style="font-size:0.75rem; color:#94A3B8; font-weight:500;">(Opsional)</span></h6>
                    </div>
                    <div class="section-card-body">
                        <div class="field-group">
                            <label class="field-label">Platform & Username</label>
                            <div class="social-row">
                                <select name="social_platform"
                                        id="socialPlatform"
                                        class="field-input"
                                        onchange="updateSocialHint()">
                                    <option value="">-- Platform --</option>
                                    <option value="instagram" {{ old('social_platform', $member->social_platform) == 'instagram' ? 'selected' : '' }}>📷 Instagram</option>
                                    <option value="twitter"   {{ old('social_platform', $member->social_platform) == 'twitter'   ? 'selected' : '' }}>🐦 Twitter / X</option>
                                    <option value="linkedin"  {{ old('social_platform', $member->social_platform) == 'linkedin'  ? 'selected' : '' }}>🔗 LinkedIn</option>
                                    <option value="github"    {{ old('social_platform', $member->social_platform) == 'github'    ? 'selected' : '' }}>💻 GitHub</option>
                                    <option value="tiktok"    {{ old('social_platform', $member->social_platform) == 'tiktok'    ? 'selected' : '' }}>🎵 TikTok</option>
                                    <option value="facebook"  {{ old('social_platform', $member->social_platform) == 'facebook'  ? 'selected' : '' }}>👍 Facebook</option>
                                    <option value="youtube"   {{ old('social_platform', $member->social_platform) == 'youtube'   ? 'selected' : '' }}>▶️ YouTube</option>
                                    <option value="whatsapp"  {{ old('social_platform', $member->social_platform) == 'whatsapp'  ? 'selected' : '' }}>💬 WhatsApp</option>
                                    <option value="telegram"  {{ old('social_platform', $member->social_platform) == 'telegram'  ? 'selected' : '' }}>✈️ Telegram</option>
                                </select>
                                <input type="text"
                                       name="social_username"
                                       id="socialUsername"
                                       class="field-input @error('social_username') is-invalid @enderror"
                                       placeholder="username atau link"
                                       value="{{ old('social_username', $member->social_username) }}">
                            </div>
                            @error('social_username')
                                <div class="invalid-msg"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                            @enderror
                            <div class="social-hint-box" id="socialHintBox"></div>
                        </div>
                    </div>
                </div>

                {{-- Tampilan & Status --}}
                <div class="section-card">
                    <div class="section-card-header">
                        <div class="icon-wrap"><i class="fas fa-sliders-h"></i></div>
                        <h6>Tampilan & Status</h6>
                    </div>
                    <div class="section-card-body">
                        <div class="two-col">
                            <div class="field-group" style="margin-bottom:0;">
                                <label class="field-label" for="order">Urutan Tampil</label>
                                <input type="number"
                                       id="order" name="order"
                                       class="field-input"
                                       value="{{ old('order', $member->order) }}"
                                       min="0"
                                       placeholder="0">
                                <p class="field-hint">Semakin kecil → semakin atas</p>
                            </div>
                            <div class="field-group" style="margin-bottom:0;">
                                <label class="field-label" for="is_active">Status</label>
                                <div class="status-wrap">
                                    <span class="status-indicator" id="statusDot"></span>
                                    <select name="is_active" id="is_active"
                                            class="field-input"
                                            onchange="updateStatusDot()">
                                        <option value="1" {{ old('is_active', $member->is_active) == '1' ? 'selected' : '' }}>Aktif</option>
                                        <option value="0" {{ old('is_active', $member->is_active) == '0' ? 'selected' : '' }}>Nonaktif</option>
                                    </select>
                                </div>
                            </div>
                        </div>
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
                <a href="{{ route('admin.members.index') }}" class="btn-cancel">
                    <i class="fas fa-times"></i> Batal
                </a>
                <button type="submit" class="btn-save">
                    <i class="fas fa-save"></i> Update Anggota
                </button>
            </div>
        </div>

    </form>

@stop

@push('js')
<script>
    // ── Social platform hints ────────────────────────────────
    const platformConfig = {
        instagram: { placeholder: 'contoh: johndoe',              hint: 'Masukkan username Instagram tanpa @, contoh: johndoe' },
        twitter:   { placeholder: 'contoh: johndoe',              hint: 'Masukkan username Twitter/X tanpa @, contoh: johndoe' },
        linkedin:  { placeholder: 'https://linkedin.com/in/...',  hint: 'Masukkan link profil LinkedIn lengkap' },
        github:    { placeholder: 'contoh: johndoe',              hint: 'Masukkan username GitHub, contoh: johndoe' },
        tiktok:    { placeholder: 'contoh: johndoe',              hint: 'Masukkan username TikTok tanpa @, contoh: johndoe' },
        facebook:  { placeholder: 'contoh: johndoe',              hint: 'Masukkan username Facebook, contoh: johndoe' },
        youtube:   { placeholder: 'contoh: johndoe',              hint: 'Masukkan username YouTube tanpa @, contoh: johndoe' },
        whatsapp:  { placeholder: '6281234567890',                hint: 'Masukkan nomor WhatsApp dengan kode negara, contoh: 6281234567890' },
        telegram:  { placeholder: 'contoh: johndoe',              hint: 'Masukkan username Telegram tanpa @, contoh: johndoe' },
    };

    function updateSocialHint() {
        const platform = document.getElementById('socialPlatform').value;
        const input    = document.getElementById('socialUsername');
        const hintBox  = document.getElementById('socialHintBox');
        const cfg      = platformConfig[platform];

        if (cfg) {
            input.placeholder  = cfg.placeholder;
            hintBox.textContent = cfg.hint;
            hintBox.classList.add('visible');
        } else {
            input.placeholder  = 'username atau link';
            hintBox.classList.remove('visible');
        }
    }

    // ── Status dot ───────────────────────────────────────────
    function updateStatusDot() {
        const val = document.getElementById('is_active').value;
        const dot = document.getElementById('statusDot');
        dot.classList.toggle('inactive', val !== '1');
    }

    // ── Division checkbox visual sync ────────────────────────
    function toggleDiv(cb) {
        const label = document.getElementById('label_div_' + cb.value);
        if (label) label.classList.toggle('div-check-selected', cb.checked);
    }

    // ── Photo preview ────────────────────────────────────────
    function previewPhoto(input) {
        if (!input.files || !input.files[0]) return;
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById('photoPreview');
            const avatar  = document.getElementById('photoAvatar');
            preview.src = e.target.result;
            preview.style.display = 'block';
            if (avatar) avatar.style.display = 'none';
        };
        reader.readAsDataURL(input.files[0]);
    }

    // ── Init on load ─────────────────────────────────────────
    document.addEventListener('DOMContentLoaded', function () {
        updateSocialHint();
        updateStatusDot();
    });
</script>
@endpush