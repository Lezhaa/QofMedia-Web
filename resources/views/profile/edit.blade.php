@extends('layouts.app')

@section('title', 'Edit Profil')

@section('content')
<!-- Hero Section - Lebih Kecil -->
<section class="profile-hero py-4">
    <div class="container">
        <div class="profile-hero-content">
            <h1 class="profile-hero-title" style="font-size: 2rem;">Edit Profil</h1>
            <p class="profile-hero-subtitle" style="font-size: 1rem;">Perbarui informasi profil Anda</p>
        </div>
    </div>
</section>

<!-- Form Section - Kurangi padding top -->
<section class="py-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card shadow-sm border-0" style="border-radius: 20px;">
                    <div class="card-body p-4">
                        @if(session('status') === 'profile-updated')
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="bi bi-check-circle-fill me-2"></i>Profil berhasil diperbarui!
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if(session('status') === 'password-updated')
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="bi bi-check-circle-fill me-2"></i>Password berhasil diubah!
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif
                        
                        <form method="POST" action="{{ route('profile.update') }}">
                            @csrf
                            @method('PATCH')
                            
                            <div class="mb-3">
                                <label for="name" class="form-label fw-semibold">Nama Lengkap</label>
                                <input type="text" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name', $user->name) }}" 
                                       required
                                       style="border-radius: 10px; padding: 10px 15px;">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="email" class="form-label fw-semibold">Email</label>
                                <input type="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email', $user->email) }}" 
                                       required
                                       style="border-radius: 10px; padding: 10px 15px;">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                
                                @if(!$user->hasVerifiedEmail())
                                    <div class="mt-2">
                                        <small class="text-warning">
                                            <i class="bi bi-exclamation-triangle-fill me-1"></i>
                                            Email belum diverifikasi. 
                                            <form method="POST" action="{{ route('verification.send') }}" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-link btn-sm p-0" style="color: var(--qof-primary);">
                                                    Kirim ulang verifikasi
                                                </button>
                                            </form>
                                        </small>
                                    </div>
                                @endif
                            </div>
                            
                            <div class="mb-4">
                                <label for="phone" class="form-label fw-semibold">Nomor HP/WhatsApp</label>
                                <input type="text" 
                                       class="form-control @error('phone') is-invalid @enderror" 
                                       id="phone" 
                                       name="phone" 
                                       value="{{ old('phone', $user->phone) }}"
                                       placeholder="Contoh: 08123456789"
                                       style="border-radius: 10px; padding: 10px 15px;">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary px-4" style="border-radius: 30px; padding: 10px 24px;">
                                    <i class="bi bi-check-lg me-2"></i>Simpan Perubahan
                                </button>
                                <a href="{{ route('home') }}" class="btn btn-outline-secondary px-4" style="border-radius: 30px; padding: 10px 24px;">
                                    Batal
                                </a>
                            </div>
                        </form>
                        
                        <hr class="my-4">
                        
                        <!-- Update Password -->
                        <h5 class="fw-bold mb-3">Ubah Password</h5>
                        <form method="POST" action="{{ route('password.update') }}" class="mb-4">
                            @csrf
                            @method('PUT')
                            
                            <div class="mb-3">
                                <label for="current_password" class="form-label fw-semibold">Password Saat Ini</label>
                                <input type="password" 
                                       class="form-control @error('current_password') is-invalid @enderror" 
                                       id="current_password" 
                                       name="current_password" 
                                       required
                                       style="border-radius: 10px; padding: 10px 15px;">
                                @error('current_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="password" class="form-label fw-semibold">Password Baru</label>
                                <input type="password" 
                                       class="form-control @error('password') is-invalid @enderror" 
                                       id="password" 
                                       name="password" 
                                       required
                                       style="border-radius: 10px; padding: 10px 15px;">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label fw-semibold">Konfirmasi Password</label>
                                <input type="password" 
                                       class="form-control" 
                                       id="password_confirmation" 
                                       name="password_confirmation" 
                                       required
                                       style="border-radius: 10px; padding: 10px 15px;">
                            </div>
                            
                            <button type="submit" class="btn btn-warning px-4" style="border-radius: 30px; padding: 10px 24px;">
                                <i class="bi bi-key me-2"></i>Ubah Password
                            </button>
                        </form>
                        
                        <hr class="my-4">
                        
                        <!-- Delete Account -->
                        <h5 class="text-danger fw-bold mb-3">Hapus Akun</h5>
                        <p class="text-muted small">Setelah akun Anda dihapus, semua data akan hilang secara permanen.</p>
                        
                        <button type="button" class="btn btn-outline-danger px-4" data-bs-toggle="modal" data-bs-target="#deleteAccountModal" style="border-radius: 30px; padding: 10px 24px;">
                            <i class="bi bi-trash me-2"></i>Hapus Akun
                        </button>
                        
                        <!-- Delete Account Modal -->
                        <div class="modal fade" id="deleteAccountModal" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content" style="border-radius: 20px;">
                                    <div class="modal-header border-0">
                                        <h5 class="modal-title text-danger fw-bold">Konfirmasi Hapus Akun</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <form method="POST" action="{{ route('profile.destroy') }}">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-body">
                                            <p>Apakah Anda yakin ingin menghapus akun? Tindakan ini tidak dapat dibatalkan.</p>
                                            <div class="mb-3">
                                                <label for="delete_password" class="form-label fw-semibold">Masukkan Password Anda</label>
                                                <input type="password" 
                                                       class="form-control @error('password', 'userDeletion') is-invalid @enderror" 
                                                       id="delete_password" 
                                                       name="password" 
                                                       required
                                                       style="border-radius: 10px; padding: 10px 15px;">
                                                @error('password', 'userDeletion')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="modal-footer border-0">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 30px;">Batal</button>
                                            <button type="submit" class="btn btn-danger" style="border-radius: 30px;">Hapus Akun</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection