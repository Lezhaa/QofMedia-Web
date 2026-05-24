<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Login - QofMedia</title>

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
            /* Update Background menggunakan gambar */
            background-image: url('<?php echo e(asset("images/bg.jpg")); ?>');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            overflow: hidden;
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
            z-index: 0;
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
            z-index: 0;
        }

        /* Jika gambar background terlalu terang, Anda bisa mengaktifkan overlay di bawah ini
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(13, 27, 42, 0.6); 
            z-index: 0;
        }
        */

        /* ============================================
           LOGIN CARD
           ============================================ */
        .login-wrapper {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 440px;
        }

        .login-card {
            background: white;
            border-radius: 24px;
            box-shadow: 0 25px 80px rgba(0,0,0,0.3);
            overflow: hidden;
            width: 100%;
        }

        /* Header */
        .login-header {
            background: linear-gradient(135deg, #0D1B2A 0%, #0E7A96 100%);
            color: white;
            padding: 36px 32px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .login-header::before {
            content: '';
            position: absolute;
            top: -20px;
            right: -20px;
            width: 100px;
            height: 100px;
            background: radial-gradient(circle, rgba(78,184,204,0.3) 0%, transparent 70%);
            border-radius: 50%;
        }

        .login-header .logo-img {
            height: 40px;
            width: auto;
            margin-bottom: 12px;
            position: relative;
            z-index: 1;
        }

        .login-header h3 {
            margin: 0;
            font-weight: 700;
            font-size: 1.3rem;
            position: relative;
            z-index: 1;
        }

        .login-header p {
            margin: 6px 0 0;
            opacity: 0.8;
            font-size: 0.85rem;
            position: relative;
            z-index: 1;
        }

        /* Body */
        .login-body {
            padding: 36px 32px;
        }

        /* Form */
        .form-label {
            font-weight: 600;
            font-size: 0.85rem;
            color: #0D1B2A;
            margin-bottom: 8px;
        }

        .form-control {
            border-radius: 12px;
            padding: 12px 16px;
            border: 1.5px solid #E2E8F0;
            font-size: 0.9rem;
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
        }

        .form-control.is-invalid {
            border-color: #DC2626;
        }

        .form-control.is-invalid:focus {
            box-shadow: 0 0 0 3px rgba(220,38,38,0.1);
        }

        .invalid-feedback {
            font-size: 0.8rem;
            font-weight: 500;
            margin-top: 6px;
        }

        /* Input Group (Password) */
        .input-group .form-control {
            border-right: none;
        }

        .input-group .btn-toggle-password {
            border: 1.5px solid #E2E8F0;
            border-left: none;
            background: #F8FAFC;
            border-radius: 0 12px 12px 0;
            padding: 0 14px;
            color: #64748B;
            transition: all 0.3s;
        }

        .input-group .btn-toggle-password:hover {
            background: #E2E8F0;
            color: #0E7A96;
        }

        .input-group:focus-within .form-control {
            border-color: #4EB8CC;
        }

        .input-group:focus-within .btn-toggle-password {
            border-color: #4EB8CC;
        }

        /* Remember Me */
        .form-check-input {
            width: 18px;
            height: 18px;
            margin-top: 2px;
            border: 2px solid #CBD5E0;
            cursor: pointer;
        }

        .form-check-input:checked {
            background-color: #0E7A96;
            border-color: #0E7A96;
        }

        .form-check-label {
            font-size: 0.85rem;
            color: #475569;
            cursor: pointer;
        }

        /* Links */
        .text-link {
            color: #0E7A96;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.85rem;
            transition: all 0.3s;
        }

        .text-link:hover {
            color: #0A4A60;
            text-decoration: underline;
        }

        /* Button */
        .btn-login {
            background: linear-gradient(135deg, #0E7A96 0%, #4EB8CC 100%);
            border: none;
            border-radius: 12px;
            padding: 13px;
            font-weight: 600;
            font-size: 0.95rem;
            color: white;
            width: 100%;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(14,122,150,0.3);
            color: white;
        }

        .btn-login:active {
            transform: translateY(0);
        }

        /* Divider */
        .divider-text {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #94A3B8;
            font-size: 0.8rem;
            margin: 20px 0;
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
            border-radius: 12px;
            font-size: 0.85rem;
            padding: 14px 16px;
            border: none;
        }

        .alert-success {
            background: #D1FAE5;
            color: #065F46;
        }

        /* ============================================
           RESPONSIVE
           ============================================ */
        @media (max-width: 480px) {
            .login-header {
                padding: 28px 20px;
            }

            .login-body {
                padding: 24px 20px;
            }

            .login-header h3 {
                font-size: 1.1rem;
            }
        }
    </style>
</head>
<body>

    <!-- Uncomment div overlay di bawah ini jika gambar background terlalu terang agar form tetap jelas -->
    <!-- <div class="overlay"></div> -->

    <div class="login-wrapper">
        <div class="login-card">
            
            <div class="login-header">
                <img src="<?php echo e(asset('images/logo/logo-qof-light.png')); ?>" alt="QofMedia Logo" class="logo-img">
                <h3>Selamat Datang</h3>
                <p>Silakan login ke akun Anda</p>
            </div>

            
            <div class="login-body">
                
                <?php if(session('status')): ?>
                    <div class="alert alert-success" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        <?php echo e(session('status')); ?>

                    </div>
                <?php endif; ?>

                
                <?php if($errors->any()): ?>
                    <div class="alert" style="background: #FEE2E2; color: #991B1B;" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <?php echo e($errors->first()); ?>

                    </div>
                <?php endif; ?>

                
                <form method="POST" action="<?php echo e(route('login')); ?>">
                    <?php echo csrf_field(); ?>

                    
                    <div class="mb-3">
                        <label for="email" class="form-label">Alamat Email</label>
                        <input type="email"
                               class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               id="email"
                               name="email"
                               value="<?php echo e(old('email')); ?>"
                               required
                               autofocus
                               autocomplete="username"
                               placeholder="contoh@email.com">
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password"
                                   class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                   id="password"
                                   name="password"
                                   required
                                   autocomplete="current-password"
                                   placeholder="Masukkan password Anda">
                            <button class="btn-toggle-password" type="button" id="togglePassword" tabindex="-1">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                            <label class="form-check-label" for="remember_me">Ingat Saya</label>
                        </div>

                        <?php if(Route::has('password.request')): ?>
                            <a href="<?php echo e(route('password.request')); ?>" class="text-link">
                                Lupa Password?
                            </a>
                        <?php endif; ?>
                    </div>

                    
                    <button type="submit" class="btn btn-login">
                        <i class="bi bi-box-arrow-in-right"></i> Login
                    </button>
                </form>

                
                <div class="text-center mt-4">
                    <p style="color: #64748B; font-size: 0.9rem; margin-bottom: 0;">
                        Belum punya akun?
                        <a href="<?php echo e(route('register')); ?>" class="text-link">Daftar Sekarang</a>
                    </p>
                </div>

                
                <div class="divider-text">atau</div>

                
                <div class="text-center">
                    <a href="<?php echo e(route('home')); ?>" style="color: #64748B; text-decoration: none; font-size: 0.85rem; font-weight: 500; transition: all 0.3s;">
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
            const password = document.getElementById('password');
            const icon = this.querySelector('i');

            if (password.type === 'password') {
                password.type = 'text';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            } else {
                password.type = 'password';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            }
        });
    </script>
</body>
</html><?php /**PATH C:\xampp\htdocs\qofmedia-web\resources\views/auth/login.blade.php ENDPATH**/ ?>