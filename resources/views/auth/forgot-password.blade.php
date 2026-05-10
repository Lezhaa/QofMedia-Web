<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Lupa Password - QofMedia</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .forgot-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
            max-width: 450px;
            width: 100%;
        }
        
        .forgot-header {
            background: linear-gradient(135deg, #1b263b 0%, #0d1b2a 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        
        .forgot-body {
            padding: 40px;
        }
        
        .form-control {
            border-radius: 10px;
            padding: 12px 15px;
            border: 1px solid #e0e0e0;
        }
        
        .form-control:focus {
            border-color: #6f42c1;
            box-shadow: 0 0 0 0.2rem rgba(111, 66, 193, 0.25);
        }
        
        .btn-reset {
            background: linear-gradient(135deg, #6f42c1 0%, #5a3396 100%);
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            color: white;
            width: 100%;
        }
        
        .text-link {
            color: #6f42c1;
            text-decoration: none;
            font-weight: 500;
        }
        
        .text-link:hover {
            color: #5a3396;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="forgot-card">
        <div class="forgot-header">
            <h2>🔐 Lupa Password</h2>
            <p class="mb-0 mt-2">Reset password akun Anda</p>
        </div>
        
        <div class="forgot-body">
            <div class="mb-4 text-muted">
                <p>Lupa password? Masukkan email Anda dan kami akan mengirimkan link untuk reset password.</p>
            </div>
            
            @if(session('status'))
                <div class="alert alert-success mb-4">
                    {{ session('status') }}
                </div>
            @endif
            
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                
                <div class="mb-4">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" 
                           class="form-control @error('email') is-invalid @enderror" 
                           id="email" 
                           name="email" 
                           value="{{ old('email') }}" 
                           required 
                           autofocus
                           placeholder="Masukkan email Anda">
                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <button type="submit" class="btn btn-reset mb-3">
                    <i class="bi bi-envelope me-2"></i>Kirim Link Reset Password
                </button>
                
                <div class="text-center">
                    <a href="{{ route('login') }}" class="text-link">
                        <i class="bi bi-arrow-left me-1"></i>Kembali ke Login
                    </a>
                </div>
            </form>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>