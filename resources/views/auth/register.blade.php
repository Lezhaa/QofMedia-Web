<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Daftar - QofMedia</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #0D1B2A 0%, #1B3A4B 50%, #0E7A96 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 60px 20px;
            position: relative;
            overflow-x: hidden;
        }

        /* Background ornaments */
        body::before {
            content: '';
            position: absolute;
            top: -30%;
            right: -15%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(78,184,204,0.15) 0%, transparent 70%);
            border-radius: 50%;
        }

        body::after {
            content: '';
            position: absolute;
            bottom: -20%;
            left: -10%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(168,221,232,0.1) 0%, transparent 70%);
            border-radius: 50%;
        }

        /* ============================================
           REGISTER CARD
           ============================================ */
        .register-wrapper {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 420px;
        }

        .register-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 25px 80px rgba(0,0,0,0.3);
            overflow: hidden;
            width: 100%;
        }

        /* Header */
        .register-header {
            background: linear-gradient(135deg, #0D1B2A 0%, #0E7A96 100%);
            color: white;
            padding: 24px 28px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .register-header::before {
            content: '';
            position: absolute;
            top: -20px;
            right: -20px;
            width: 80px;
            height: 80px;
            background: radial-gradient(circle, rgba(78,184,204,0.3) 0%, transparent 70%);
            border-radius: 50%;
        }

        .register-header .logo-img {
            height: 32px;
            width: auto;
            margin-bottom: 8px;
            position: relative;
            z-index: 1;
        }

        .register-header h3 {
            margin: 0;
            font-weight: 700;
            font-size: 1.15rem;
            position: relative;
            z-index: 1;
        }

        .register-header p {
            margin: 4px 0 0;
            opacity: 0.8;
            font-size: 0.8rem;
            position: relative;
            z-index: 1;
        }

        /* Body */
        .register-body {
            padding: 24px 28px;
        }

        /* Form */
        .form-label {
            font-weight: 600;
            font-size: 0.8rem;
            color: #0D1B2A;
            margin-bottom: 6px;
        }

        .form-control {
            border-radius: 10px;
            padding: 10px 14px;
            border: 1.5px solid #E2E8F0;
            font-size: 0.85rem;
            transition: all 0.3s;
            background: #F8FAFC;
        }

        .form-control:focus {
            border-color: #4EB8CC;
            box-shadow: 0 0 0 3px rgba(78,184,204,0.1);
            background: white;
        }

        .form-control::placeholder {
            color: #94A3B8;
            font-size: 0.8rem;
        }

        .form-control.is-invalid {
            border-color: #DC2626;
        }

        .form-control.is-invalid:focus {
            box-shadow: 0 0 0 3px rgba(220,38,38,0.1);
        }

        .invalid-feedback {
            font-size: 0.75rem;
            font-weight: 500;
            margin-top: 4px;
        }

        /* Input Group with Icon */
        .input-group .input-group-icon {
            background: #F8FAFC;
            border: 1.5px solid #E2E8F0;
            border-right: none;
            border-radius: 10px 0 0 10px;
            padding: 0 12px;
            display: flex;
            align-items: center;
            color: #64748B;
            font-size: 0.9rem;
            transition: all 0.3s;
        }

        .input-group .form-control {
            border-left: none;
        }

        .input-group:focus-within .form-control {
            border-color: #4EB8CC;
        }

        .input-group:focus-within .input-group-icon {
            border-color: #4EB8CC;
            color: #0E7A96;
        }

        /* Password Toggle */
        .input-group .btn-toggle-password {
            border: 1.5px solid #E2E8F0;
            border-left: none;
            background: #F8FAFC;
            border-radius: 0 10px 10px 0;
            padding: 0 12px;
            color: #64748B;
            transition: all 0.3s;
            font-size: 0.9rem;
        }

        .input-group .btn-toggle-password:hover {
            background: #E2E8F0;
            color: #0E7A96;
        }

        .input-group:focus-within .btn-toggle-password {
            border-color: #4EB8CC;
        }

        /* Button */
        .btn-register {
            background: linear-gradient(135deg, #0E7A96 0%, #4EB8CC 100%);
            border: none;
            border-radius: 10px;
            padding: 11px;
            font-weight: 600;
            font-size: 0.9rem;
            color: white;
            width: 100%;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 4px;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(14,122,150,0.3);
            color: white;
        }

        .btn-register:active {
            transform: translateY(0);
        }

        /* Links */
        .text-link {
            color: #0E7A96;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.82rem;
            transition: all 0.3s;
        }

        .text-link:hover {
            color: #0A4A60;
            text-decoration: underline;
        }

        /* Divider */
        .divider-text {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #94A3B8;
            font-size: 0.75rem;
            margin: 16px 0;
        }

        .divider-text::before,
        .divider-text::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #E2E8F0;
        }

        /* Alert */
        .alert {
            border-radius: 10px;
            font-size: 0.8rem;
            padding: 10px 14px;
            border: none;
            margin-bottom: 16px;
        }

        .alert-success {
            background: #D1FAE5;
            color: #065F46;
        }

        .mb-3 {
            margin-bottom: 14px !important;
        }

        .mb-4 {
            margin-bottom: 18px !important;
        }

        /* ============================================
           RESPONSIVE
           ============================================ */
        @media (max-width: 480px) {
            .register-wrapper {
                max-width: 100%;
            }

            .register-header {
                padding: 20px 20px;
            }

            .register-body {
                padding: 20px 20px;
            }

            .register-header h3 {
                font-size: 1.05rem;
            }

            .register-header .logo-img {
                height: 28px;
            }
        }
    </style>
</head>
<body>

    <div class="register-wrapper">
        <div class="register-card">
            {{-- Header --}}
            <div class="register-header">
                <img src="{{ asset('images/logo/logo-qof-light.png') }}" alt="QofMedia Logo" class="logo-img">
                <h3>Buat Akun Baru</h3>
                <p>Bergabunglah dengan komunitas QofMedia</p>
            </div>

            {{-- Body --}}
            <div class="register-body">
                {{-- Session Status --}}
                @if(session('status'))
                    <div class="alert alert-success" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        {{ session('status') }}
                    </div>
                @endif

                {{-- Error Alert --}}
                @if($errors->any())
                    <div class="alert" style="background: #FEE2E2; color: #991B1B;" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        {{ $errors->first() }}
                    </div>
                @endif

                {{-- Form --}}
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    {{-- Nama Lengkap --}}
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <div class="input-group">
                            <span class="input-group-icon">
                                <i class="bi bi-person"></i>
                            </span>
                            <input type="text"
                                   class="form-control @error('name') is-invalid @enderror"
                                   id="name"
                                   name="name"
                                   value="{{ old('name') }}"
                                   required
                                   autofocus
                                   autocomplete="name"
                                   placeholder="Masukkan nama lengkap">
                        </div>
                        @error('name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Nomor HP/WhatsApp --}}
                    <div class="mb-3">
                        <label for="phone" class="form-label">Nomor HP / WhatsApp</label>
                        <div class="input-group">
                            <span class="input-group-icon">
                                <i class="bi bi-whatsapp"></i>
                            </span>
                            <input type="text"
                                   class="form-control @error('phone') is-invalid @enderror"
                                   id="phone"
                                   name="phone"
                                   value="{{ old('phone') }}"
                                   placeholder="0812-3456-7890">
                        </div>
                        @error('phone')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="mb-3">
                        <label for="email" class="form-label">Alamat Email</label>
                        <div class="input-group">
                            <span class="input-group-icon">
                                <i class="bi bi-envelope"></i>
                            </span>
                            <input type="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   id="email"
                                   name="email"
                                   value="{{ old('email') }}"
                                   required
                                   autocomplete="username"
                                   placeholder="contoh@email.com">
                        </div>
                        @error('email')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-icon">
                                <i class="bi bi-lock"></i>
                            </span>
                            <input type="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   id="password"
                                   name="password"
                                   required
                                   autocomplete="new-password"
                                   placeholder="Minimal 8 karakter">
                            <button class="btn-toggle-password" type="button" id="togglePassword" tabindex="-1">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                        @error('password')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Konfirmasi Password --}}
                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                        <div class="input-group">
                            <span class="input-group-icon">
                                <i class="bi bi-lock-fill"></i>
                            </span>
                            <input type="password"
                                   class="form-control @error('password_confirmation') is-invalid @enderror"
                                   id="password_confirmation"
                                   name="password_confirmation"
                                   required
                                   autocomplete="new-password"
                                   placeholder="Ulangi password">
                            <button class="btn-toggle-password" type="button" id="toggleConfirmPassword" tabindex="-1">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                        @error('password_confirmation')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Submit --}}
                    <button type="submit" class="btn btn-register">
                        <i class="bi bi-person-plus"></i> Daftar Sekarang
                    </button>
                </form>

                {{-- Login Link --}}
                <div class="text-center mt-3">
                    <p style="color: #64748B; font-size: 0.85rem; margin-bottom: 0;">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="text-link">Login di Sini</a>
                    </p>
                </div>

                {{-- Divider --}}
                <div class="divider-text">atau</div>

                {{-- Back to Home --}}
                <div class="text-center">
                    <a href="{{ route('home') }}" style="color: #64748B; text-decoration: none; font-size: 0.82rem; font-weight: 500; transition: all 0.3s;">
                        <i class="bi bi-arrow-left me-1"></i> Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            togglePasswordVisibility('password', this);
        });

        document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
            togglePasswordVisibility('password_confirmation', this);
        });

        function togglePasswordVisibility(inputId, button) {
            const input = document.getElementById(inputId);
            const icon = button.querySelector('i');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            }
        }
    </script>
</body>
</html>