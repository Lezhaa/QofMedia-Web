@extends('adminlte::page')

@section('title', 'Tambah User')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="mb-0" style="font-size: 1.4rem; font-weight: 700; color: #0D1B2A;">
                <i class="fas fa-user-plus me-2" style="color: #0E7A96;"></i> Tambah User
            </h1>
            <ol class="breadcrumb mb-0 mt-1" style="font-size: 0.8rem; background: transparent; padding: 0;">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">User</a></li>
                <li class="breadcrumb-item active">Tambah</li>
            </ol>
        </div>
        <a href="{{ route('admin.users.index') }}"
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
    .fch-icon.purple { background: #EEF2FF; color: #4F46E5; }
    .fch-icon.amber  { background: #FEF3C7; color: #D97706; }
    .fch-icon.green  { background: #D1FAE5; color: #059669; }

    .fch-title {
        font-size: 0.92rem;
        font-weight: 700;
        color: #0D1B2A;
    }
    .fch-sub {
        font-size: 0.75rem;
        color: #94A3B8;
        margin-top: 1px;
    }
    .form-card-body { padding: 24px; }

    /* ============================================
       FIELD
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
    }
    .field-input:focus {
        border-color: #4EB8CC;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(78,184,204,0.1);
    }
    .field-input.is-invalid {
        border-color: #EF4444;
        background: #FFF5F5;
    }
    .field-input.is-invalid:focus {
        box-shadow: 0 0 0 3px rgba(239,68,68,0.1);
    }

    /* Password input wrapper */
    .pw-wrap {
        position: relative;
    }
    .pw-wrap .field-input {
        padding-right: 44px;
    }
    .pw-toggle {
        position: absolute;
        right: 14px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        cursor: pointer;
        color: #94A3B8;
        font-size: 0.9rem;
        padding: 0;
        transition: color 0.2s;
    }
    .pw-toggle:hover { color: #0E7A96; }

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

    .field-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 16px;
    }

    /* ============================================
       ROLE CARDS
       ============================================ */
    .role-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
        gap: 10px;
    }
    .role-item {
        position: relative;
    }
    .role-item input[type="checkbox"] {
        position: absolute;
        opacity: 0;
        width: 0; height: 0;
    }
    .role-label {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 16px 12px;
        border: 1.5px solid #E2E8F0;
        border-radius: 12px;
        cursor: pointer;
        background: #F8FAFC;
        transition: all 0.25s;
        text-align: center;
        user-select: none;
    }
    .role-label .role-icon {
        width: 36px; height: 36px;
        border-radius: 10px;
        background: #E2E8F0;
        color: #94A3B8;
        display: flex; align-items: center; justify-content: center;
        font-size: 0.9rem;
        transition: all 0.25s;
    }
    .role-label .role-name {
        font-size: 0.78rem;
        font-weight: 600;
        color: #64748B;
        transition: color 0.25s;
    }
    .role-label:hover {
        border-color: #4EB8CC;
        background: #EEF9FC;
    }
    .role-label:hover .role-icon {
        background: #4EB8CC;
        color: #fff;
    }
    /* Checked state */
    .role-item input:checked + .role-label {
        border-color: #0E7A96;
        background: #EEF9FC;
    }
    .role-item input:checked + .role-label .role-icon {
        background: #0E7A96;
        color: #fff;
    }
    .role-item input:checked + .role-label .role-name {
        color: #0E7A96;
        font-weight: 700;
    }

    /* ============================================
       SIDEBAR INFO CARD
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

    .info-tip {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        padding: 12px 0;
        border-bottom: 1px solid #F8FAFC;
    }
    .info-tip:last-child { border-bottom: none; padding-bottom: 0; }
    .info-tip:first-child { padding-top: 0; }

    .info-tip .tip-icon {
        width: 30px; height: 30px;
        border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        font-size: 0.8rem;
        flex-shrink: 0;
        margin-top: 1px;
    }
    .info-tip .tip-text {
        font-size: 0.78rem;
        color: #64748B;
        line-height: 1.6;
    }
    .info-tip .tip-text strong {
        color: #0D1B2A;
        display: block;
        font-size: 0.8rem;
        margin-bottom: 2px;
    }

    /* Password strength */
    .pw-strength {
        margin-top: 8px;
        display: none;
    }
    .pw-strength-bar {
        height: 4px;
        border-radius: 4px;
        background: #E2E8F0;
        overflow: hidden;
        margin-bottom: 4px;
    }
    .pw-strength-fill {
        height: 100%;
        border-radius: 4px;
        transition: width 0.3s, background 0.3s;
        width: 0%;
    }
    .pw-strength-text {
        font-size: 0.72rem;
        font-weight: 600;
    }

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
    .action-bar .ab-hint {
        font-size: 0.78rem;
        color: #94A3B8;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .action-bar .ab-buttons { display: flex; gap: 10px; }

    .btn-save {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: linear-gradient(135deg, #0E7A96, #0A5A70);
        color: #fff;
        border: none;
        padding: 11px 28px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.88rem;
        cursor: pointer;
        transition: all 0.3s;
    }
    .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(14,122,150,0.3);
        color: #fff;
    }
    .btn-cancel {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #fff;
        color: #64748B;
        border: 1.5px solid #E2E8F0;
        padding: 11px 22px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.88rem;
        text-decoration: none;
        transition: all 0.3s;
    }
    .btn-cancel:hover {
        border-color: #CBD5E0;
        color: #0D1B2A;
        background: #F8FAFC;
        text-decoration: none;
    }

    /* ============================================
       RESPONSIVE
       ============================================ */
    @media (max-width: 992px) {
        .form-layout { grid-template-columns: 1fr; }
        .info-card   { position: static; }
        .field-row   { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')

    <form action="{{ route('admin.users.store') }}" method="POST" id="userForm">
        @csrf

        <div class="form-layout">

            {{-- ── KIRI: FORM UTAMA ── --}}
            <div>

                {{-- Informasi Dasar --}}
                <div class="form-card">
                    <div class="form-card-header">
                        <div class="fch-icon blue"><i class="fas fa-user"></i></div>
                        <div>
                            <div class="fch-title">Informasi Dasar</div>
                            <div class="fch-sub">Nama, email, dan nomor HP</div>
                        </div>
                    </div>
                    <div class="form-card-body">

                        {{-- Nama & Email --}}
                        <div class="field-row">
                            <div class="field-group">
                                <label class="field-label" for="name">
                                    Nama Lengkap <span class="req">*</span>
                                </label>
                                <input type="text"
                                       class="field-input @error('name') is-invalid @enderror"
                                       id="name" name="name"
                                       value="{{ old('name') }}"
                                       placeholder="Contoh: Ahmad Fauzi"
                                       required>
                                @error('name')
                                    <div class="invalid-msg"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="field-group">
                                <label class="field-label" for="email">
                                    Email <span class="req">*</span>
                                </label>
                                <input type="email"
                                       class="field-input @error('email') is-invalid @enderror"
                                       id="email" name="email"
                                       value="{{ old('email') }}"
                                       placeholder="contoh@email.com"
                                       required>
                                @error('email')
                                    <div class="invalid-msg"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- No HP --}}
                        <div class="field-group">
                            <label class="field-label" for="phone">Nomor HP</label>
                            <input type="text"
                                   class="field-input @error('phone') is-invalid @enderror"
                                   id="phone" name="phone"
                                   value="{{ old('phone') }}"
                                   placeholder="Contoh: 08123456789"
                                   style="max-width: 260px;">
                            @error('phone')
                                <div class="invalid-msg"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                            @else
                                <div class="field-hint"><i class="fas fa-info-circle"></i> Opsional</div>
                            @enderror
                        </div>

                    </div>
                </div>

                {{-- Password --}}
                <div class="form-card">
                    <div class="form-card-header">
                        <div class="fch-icon purple"><i class="fas fa-lock"></i></div>
                        <div>
                            <div class="fch-title">Password</div>
                            <div class="fch-sub">Buat password yang kuat</div>
                        </div>
                    </div>
                    <div class="form-card-body">

                        <div class="field-row">
                            <div class="field-group">
                                <label class="field-label" for="password">
                                    Password <span class="req">*</span>
                                </label>
                                <div class="pw-wrap">
                                    <input type="password"
                                           class="field-input @error('password') is-invalid @enderror"
                                           id="password" name="password"
                                           placeholder="Min. 8 karakter"
                                           oninput="checkStrength(this.value)"
                                           required>
                                    <button type="button" class="pw-toggle" onclick="togglePw('password', this)">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <div class="invalid-msg"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                                @enderror
                                {{-- Strength indicator --}}
                                <div class="pw-strength" id="pwStrength">
                                    <div class="pw-strength-bar">
                                        <div class="pw-strength-fill" id="pwFill"></div>
                                    </div>
                                    <span class="pw-strength-text" id="pwText"></span>
                                </div>
                            </div>

                            <div class="field-group">
                                <label class="field-label" for="password_confirmation">
                                    Konfirmasi Password <span class="req">*</span>
                                </label>
                                <div class="pw-wrap">
                                    <input type="password"
                                           class="field-input"
                                           id="password_confirmation"
                                           name="password_confirmation"
                                           placeholder="Ulangi password"
                                           required>
                                    <button type="button" class="pw-toggle" onclick="togglePw('password_confirmation', this)">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                <div class="field-hint"><i class="fas fa-info-circle"></i> Harus sama dengan password di atas</div>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- Role --}}
                <div class="form-card">
                    <div class="form-card-header">
                        <div class="fch-icon amber"><i class="fas fa-shield-alt"></i></div>
                        <div>
                            <div class="fch-title">Role & Akses</div>
                            <div class="fch-sub">Tentukan hak akses user</div>
                        </div>
                    </div>
                    <div class="form-card-body">
                        <div class="role-grid">
                            @foreach($roles as $role)
                                @php
                                    $icons = [
                                        'admin'         => 'fas fa-user-shield',
                                        'super_admin'   => 'fas fa-crown',
                                        'editor'        => 'fas fa-pen',
                                        'studio'        => 'fas fa-camera',
                                        'user'          => 'fas fa-user',
                                    ];
                                    $icon = $icons[$role->name] ?? 'fas fa-user-tag';
                                @endphp
                                <div class="role-item">
                                    <input type="checkbox"
                                           id="role_{{ $role->id }}"
                                           name="roles[]"
                                           value="{{ $role->name }}"
                                           {{ in_array($role->name, old('roles', [])) ? 'checked' : '' }}>
                                    <label class="role-label" for="role_{{ $role->id }}">
                                        <div class="role-icon">
                                            <i class="{{ $icon }}"></i>
                                        </div>
                                        <div class="role-name">
                                            {{ ucfirst(str_replace('_', ' ', $role->name)) }}
                                        </div>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <div class="field-hint mt-3">
                            <i class="fas fa-info-circle"></i>
                            Jika tidak dipilih, user akan otomatis menjadi User biasa.
                        </div>
                    </div>
                </div>

            </div>

            {{-- ── KANAN: SIDEBAR INFO ── --}}
            <div>
                <div class="info-card">
                    <div class="info-card-header">
                        <div class="fch-icon green"><i class="fas fa-lightbulb"></i></div>
                        <div>
                            <div class="fch-title">Panduan</div>
                            <div class="fch-sub">Tips membuat user</div>
                        </div>
                    </div>
                    <div class="info-card-body">
                        <div class="info-tip">
                            <div class="tip-icon" style="background:#EEF9FC; color:#0E7A96;">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="tip-text">
                                <strong>Nama & Email</strong>
                                Gunakan nama lengkap dan email aktif yang bisa dihubungi.
                            </div>
                        </div>
                        <div class="info-tip">
                            <div class="tip-icon" style="background:#EEF2FF; color:#4F46E5;">
                                <i class="fas fa-lock"></i>
                            </div>
                            <div class="tip-text">
                                <strong>Password Kuat</strong>
                                Minimal 8 karakter, kombinasikan huruf, angka, dan simbol.
                            </div>
                        </div>
                        <div class="info-tip">
                            <div class="tip-icon" style="background:#FEF3C7; color:#D97706;">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <div class="tip-text">
                                <strong>Role</strong>
                                Berikan role sesuai kebutuhan akses. Admin memiliki akses penuh.
                            </div>
                        </div>
                        <div class="info-tip">
                            <div class="tip-icon" style="background:#D1FAE5; color:#059669;">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="tip-text">
                                <strong>Email Unik</strong>
                                Setiap user harus memiliki email yang berbeda-beda.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- ── ACTION BAR ── --}}
        <div class="action-bar">
            <div class="ab-hint">
                <i class="fas fa-asterisk" style="color:#DC2626; font-size:0.6rem;"></i>
                Kolom bertanda wajib diisi
            </div>
            <div class="ab-buttons">
                <a href="{{ route('admin.users.index') }}" class="btn-cancel">
                    <i class="fas fa-times"></i> Batal
                </a>
                <button type="submit" class="btn-save">
                    <i class="fas fa-save"></i> Simpan User
                </button>
            </div>
        </div>

    </form>

@stop

@push('js')
<script>
    /* ── TOGGLE PASSWORD VISIBILITY ── */
    function togglePw(id, btn) {
        var input = document.getElementById(id);
        var icon  = btn.querySelector('i');
        if (input.type === 'password') {
            input.type = 'text';
            icon.className = 'fas fa-eye-slash';
        } else {
            input.type = 'password';
            icon.className = 'fas fa-eye';
        }
    }

    /* ── PASSWORD STRENGTH ── */
    function checkStrength(val) {
        var wrap = document.getElementById('pwStrength');
        var fill = document.getElementById('pwFill');
        var text = document.getElementById('pwText');

        if (!val) { wrap.style.display = 'none'; return; }
        wrap.style.display = 'block';

        var score = 0;
        if (val.length >= 8)               score++;
        if (/[A-Z]/.test(val))             score++;
        if (/[0-9]/.test(val))             score++;
        if (/[^A-Za-z0-9]/.test(val))     score++;

        var levels = [
            { pct: '25%', bg: '#EF4444', label: 'Lemah',  color: '#EF4444' },
            { pct: '50%', bg: '#F59E0B', label: 'Cukup',  color: '#F59E0B' },
            { pct: '75%', bg: '#3B82F6', label: 'Baik',   color: '#3B82F6' },
            { pct: '100%',bg: '#10B981', label: 'Kuat',   color: '#10B981' },
        ];
        var lvl = levels[Math.max(0, score - 1)];
        fill.style.width      = lvl.pct;
        fill.style.background = lvl.bg;
        text.textContent      = lvl.label;
        text.style.color      = lvl.color;
    }
</script>
@endpush