<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Verifikasi Email - QofMedia</title>
    
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
        
        .verify-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
            max-width: 500px;
            width: 100%;
        }
        
        .verify-header {
            background: linear-gradient(135deg, #1b263b 0%, #0d1b2a 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        
        .verify-body {
            padding: 40px;
        }
        
        .btn-verify {
            background: linear-gradient(135deg, #6f42c1 0%, #5a3396 100%);
            border: none;
            border-radius: 10px;
            padding: 12px 30px;
            font-weight: 600;
            color: white;
        }
        
        .btn-verify:hover {
            color: white;
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
    <div class="verify-card">
        <div class="verify-header">
            <h2>✉️ Verifikasi Email</h2>
            <p class="mb-0 mt-2">Konfirmasi alamat email Anda</p>
        </div>
        
        <div class="verify-body">
            <div class="mb-4">
                <p>Terima kasih telah mendaftar! Sebelum memulai, mohon verifikasi alamat email Anda dengan mengklik link yang baru saja kami kirimkan ke email Anda.</p>
                <p>Jika Anda tidak menerima email, kami akan dengan senang hati mengirimkan ulang.</p>
            </div>
            
            @if(session('status') == 'verification-link-sent')
                <div class="alert alert-success mb-4">
                    Link verifikasi baru telah dikirim ke alamat email yang Anda gunakan saat mendaftar.
                </div>
            @endif
            
            <div class="d-flex justify-content-between align-items-center">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="btn btn-verify">
                        <i class="bi bi-envelope me-2"></i>Kirim Ulang Email Verifikasi
                    </button>
                </form>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline-secondary">
                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>