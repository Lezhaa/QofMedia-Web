@extends('adminlte::page')

@section('title', 'Edit User')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="mb-0" style="font-size: 1.4rem; font-weight: 700; color: #0D1B2A;">
                <i class="fas fa-user-edit me-2" style="color: #0E7A96;"></i> Edit User
            </h1>
            <ol class="breadcrumb mb-0 mt-1" style="font-size: 0.8rem; background: transparent; padding: 0;">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">User</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </div>
        <a href="{{ route('admin.users.index') }}"
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
       USER IDENTITY BANNER
       ============================================ */
    .user-banner {
        background: #fff;
        border: 1px solid #E2E8F0;
        border-radius: 20px;
        padding: 20px 24px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 16px;
    }
    .user-banner-avatar {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        background: linear-gradient(135deg, #0E7A96, #0a6278);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 1.1rem;
        font-weight: 800;
        flex-shrink: 0;
        text-transform: uppercase;
    }
    .user-banner-name {
        font-size: 1rem;
        font-weight: 700;
        color: #0D1B2A;
        margin: 0 0 3px;
    }
    .user-banner-email {
        font-size: 0.82rem;
        color: #94A3B8;
        margin: 0;
    }
    .user-banner-roles {
        margin-left: auto;
        display: flex;
        gap: 5px;
        flex-wrap: wrap;
        justify-content: flex-end;
    }
    .role-pill {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 4px 10px;
        border-radius: 50px;
        font-size: 0.72rem;
        font-weight: 700;
    }
    .role-admin   { background: rgba(37,99,235,0.1);   color: #2563EB; }
    .role-studio  { background: rgba(5,150,105,0.1);   color: #059669; }
    .role-apparel { background: rgba(217,119,6,0.1);   color: #D97706; }
    .role-user    { background: rgba(100,116,139,0.1); color: #64748B; }
    .role-other   { background: rgba(14,122,150,0.1);  color: #0E7A96; }

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
    .custom-label .req  { color: #EF4444; font-size: 0.78rem; }
    .custom-label i     { color: #CBD5E1; font-size: 0.78rem; }
    .custom-label .opt  { font-size: 0.72rem; color: #94A3B8; font-weight: 500; }

    .custom-input,
    .custom-password {
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
    .custom-password:focus {
        border-color: #0E7A96;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(14,122,150,0.08);
    }
    .custom-input.is-invalid,
    .custom-password.is-invalid {
        border-color: #EF4444;
        background: #FFF9F9;
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

    /* Password wrapper with show/hide toggle */
    .password-wrap {
        position: relative;
    }
    .password-wrap .custom-password {
        padding-right: 42px;
    }
    .pw-toggle {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        background: none;
        border: none;
        color: #94A3B8;
        cursor: pointer;
        font-size: 0.85rem;
        padding: 0;
        transition: color 0.2s;
    }
    .pw-toggle:hover { color: #0E7A96; }

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
       ROLE CHECKBOXES
       ============================================ */
    .role-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        gap: 10px;
        margin-top: 4px;
    }
    .role-check-item {
        position: relative;
    }
    .role-check-item input[type="checkbox"] {
        position: absolute;
        opacity: 0;
        width: 0;
        height: 0;
    }
    .role-check-label {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 12px 14px;
        border: 1.5px solid #E2E8F0;
        border-radius: 10px;
        background: #F8FAFC;
        cursor: pointer;
        transition: all 0.2s;
        user-select: none;
    }
    .role-check-label:hover {
        border-color: #0E7A96;
        background: #EEF9FC;
    }
    .role-check-item input:checked + .role-check-label {
        border-color: #0E7A96;
        background: rgba(14,122,150,0.06);
    }
    .role-check-box {
        width: 18px;
        height: 18px;
        border-radius: 5px;
        border: 2px solid #CBD5E1;
        background: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        transition: all 0.2s;
        font-size: 0.6rem;
        color: transparent;
    }
    .role-check-item input:checked + .role-check-label .role-check-box {
        background: #0E7A96;
        border-color: #0E7A96;
        color: #fff;
    }
    .role-check-text {
        font-size: 0.83rem;
        font-weight: 600;
        color: #374151;
        line-height: 1.3;
    }
    .role-check-item input:checked + .role-check-label .role-check-text {
        color: #0D1B2A;
    }
    .role-check-icon {
        margin-left: auto;
        font-size: 0.78rem;
        color: #CBD5E1;
    }
    .role-check-item input:checked + .role-check-label .role-check-icon {
        color: #0E7A96;
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

    {{-- User Identity Banner --}}
    <div class="user-banner">
        <div class="user-banner-avatar">{{ mb_substr($user->name, 0, 2) }}</div>
        <div>
            <p class="user-banner-name">{{ $user->name }}</p>
            <p class="user-banner-email">{{ $user->email }}</p>
        </div>
        <div class="user-banner-roles">
            @foreach($user->roles as $role)
                @php
                    $roleClass = match($role->name) {
                        'admin_qofmedia' => 'role-admin',
                        'admin_studio'   => 'role-studio',
                        'admin_apparel'  => 'role-apparel',
                        'user'           => 'role-user',
                        default          => 'role-other'
                    };
                    $roleIcon = match($role->name) {
                        'admin_qofmedia' => 'fa-user-shield',
                        'admin_studio'   => 'fa-camera',
                        'admin_apparel'  => 'fa-tshirt',
                        'user'           => 'fa-user',
                        default          => 'fa-tag'
                    };
                    $roleName = match($role->name) {
                        'admin_qofmedia' => 'Admin',
                        'admin_studio'   => 'Studio',
                        'admin_apparel'  => 'Apparel',
                        'user'           => 'User',
                        default          => $role->name
                    };
                @endphp
                <span class="role-pill {{ $roleClass }}">
                    <i class="fas {{ $roleIcon }}" style="font-size:0.65rem;"></i>
                    {{ $roleName }}
                </span>
            @endforeach
        </div>
    </div>

    <form action="{{ route('admin.users.update', $user) }}" method="POST" id="editUserForm">
        @csrf
        @method('PUT')

        {{-- ─── INFORMASI AKUN ─── --}}
        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-header-icon"><i class="fas fa-id-card"></i></div>
                <div>
                    <p class="form-card-header-title">Informasi Akun</p>
                    <p class="form-card-header-subtitle">Nama lengkap, email, dan nomor HP</p>
                </div>
            </div>
            <div class="form-card-body">

                <div class="form-grid-2" style="margin-bottom: 20px;">
                    {{-- Nama --}}
                    <div>
                        <label class="custom-label" for="name">
                            <i class="fas fa-user"></i> Nama Lengkap <span class="req">*</span>
                        </label>
                        <input type="text"
                               class="custom-input @error('name') is-invalid @enderror"
                               id="name" name="name"
                               value="{{ old('name', $user->name) }}"
                               placeholder="Nama lengkap user..."
                               required>
                        @error('name')
                            <div class="custom-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div>
                        <label class="custom-label" for="email">
                            <i class="fas fa-envelope"></i> Email <span class="req">*</span>
                        </label>
                        <input type="email"
                               class="custom-input @error('email') is-invalid @enderror"
                               id="email" name="email"
                               value="{{ old('email', $user->email) }}"
                               placeholder="email@example.com"
                               required>
                        @error('email')
                            <div class="custom-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- No. HP --}}
                <div style="max-width: 360px;">
                    <label class="custom-label" for="phone">
                        <i class="fas fa-phone"></i> Nomor HP
                        <span class="opt">(opsional)</span>
                    </label>
                    <input type="text"
                           class="custom-input @error('phone') is-invalid @enderror"
                           id="phone" name="phone"
                           value="{{ old('phone', $user->phone) }}"
                           placeholder="08xxxxxxxxxx">
                    @error('phone')
                        <div class="custom-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                    @enderror
                </div>

            </div>
        </div>

        {{-- ─── KEAMANAN ─── --}}
        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-header-icon"><i class="fas fa-lock"></i></div>
                <div>
                    <p class="form-card-header-title">Keamanan</p>
                    <p class="form-card-header-subtitle">Kosongkan jika tidak ingin mengubah password</p>
                </div>
            </div>
            <div class="form-card-body">
                <div class="form-grid-2">
                    {{-- Password Baru --}}
                    <div>
                        <label class="custom-label" for="password">
                            <i class="fas fa-key"></i> Password Baru
                            <span class="opt">(opsional)</span>
                        </label>
                        <div class="password-wrap">
                            <input type="password"
                                   class="custom-password @error('password') is-invalid @enderror"
                                   id="password" name="password"
                                   placeholder="Masukkan password baru...">
                            <button type="button" class="pw-toggle" onclick="togglePassword('password', this)">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <div class="custom-hint">
                            <i class="fas fa-info-circle"></i>
                            Minimal 8 karakter. Kosongkan jika tidak ingin mengubah.
                        </div>
                        @error('password')
                            <div class="custom-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Konfirmasi Password --}}
                    <div>
                        <label class="custom-label" for="password_confirmation">
                            <i class="fas fa-key"></i> Konfirmasi Password Baru
                        </label>
                        <div class="password-wrap">
                            <input type="password"
                                   class="custom-password"
                                   id="password_confirmation"
                                   name="password_confirmation"
                                   placeholder="Ulangi password baru...">
                            <button type="button" class="pw-toggle" onclick="togglePassword('password_confirmation', this)">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <div id="pw-match-hint" class="custom-hint" style="display:none;"></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ─── ROLE ─── --}}
        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-header-icon"><i class="fas fa-shield-alt"></i></div>
                <div>
                    <p class="form-card-header-title">Role & Hak Akses</p>
                    <p class="form-card-header-subtitle">Pilih satu atau lebih role untuk user ini</p>
                </div>
            </div>
            <div class="form-card-body">
                <div class="role-grid">
                    @foreach($roles as $role)
                        @php
                            $roleIcon = match($role->name) {
                                'admin_qofmedia' => 'fa-user-shield',
                                'admin_studio'   => 'fa-camera',
                                'admin_apparel'  => 'fa-tshirt',
                                'user'           => 'fa-user',
                                default          => 'fa-tag'
                            };
                            $roleLabel = ucfirst(str_replace('_', ' ', $role->name));
                        @endphp
                        <div class="role-check-item">
                            <input type="checkbox"
                                   id="role_{{ $role->id }}"
                                   name="roles[]"
                                   value="{{ $role->name }}"
                                   {{ in_array($role->name, old('roles', $userRoles)) ? 'checked' : '' }}>
                            <label class="role-check-label" for="role_{{ $role->id }}">
                                <span class="role-check-box">
                                    <i class="fas fa-check"></i>
                                </span>
                                <span class="role-check-text">{{ $roleLabel }}</span>
                                <i class="fas {{ $roleIcon }} role-check-icon"></i>
                            </label>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- ─── ACTIONS ─── --}}
        <div class="form-card">
            <div class="form-actions">
                <button type="submit" class="btn-save">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
                <a href="{{ route('admin.users.index') }}" class="btn-cancel">
                    <i class="fas fa-times"></i> Batal
                </a>
            </div>
        </div>

    </form>

@stop

@push('js')
<script>
    // Toggle show/hide password
    function togglePassword(fieldId, btn) {
        var input = document.getElementById(fieldId);
        var icon  = btn.querySelector('i');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    }

    // Password match indicator
    var pwField    = document.getElementById('password');
    var pwConfirm  = document.getElementById('password_confirmation');
    var matchHint  = document.getElementById('pw-match-hint');

    function checkMatch() {
        if (!pwField.value && !pwConfirm.value) {
            matchHint.style.display = 'none';
            return;
        }
        matchHint.style.display = 'flex';
        if (pwField.value === pwConfirm.value) {
            matchHint.innerHTML = '<i class="fas fa-check-circle" style="color:#059669;"></i> <span style="color:#059669;">Password cocok</span>';
            pwConfirm.style.borderColor = '#059669';
        } else {
            matchHint.innerHTML = '<i class="fas fa-times-circle" style="color:#EF4444;"></i> <span style="color:#EF4444;">Password tidak cocok</span>';
            pwConfirm.style.borderColor = '#EF4444';
        }
    }

    pwField.addEventListener('input', checkMatch);
    pwConfirm.addEventListener('input', checkMatch);
</script>
@endpush