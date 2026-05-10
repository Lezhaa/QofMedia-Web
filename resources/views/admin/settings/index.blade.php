@extends('adminlte::page')

@section('title', 'Pengaturan Website')

@section('content_header')
    <div>
        <h1>Pengaturan Website</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active">Pengaturan</li>
        </ol>
    </div>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle mr-1"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="row">
            <div class="col-md-8">
                
                <!-- Hero Settings -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-home mr-2"></i>
                            Pengaturan Beranda (Hero)
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="hero_title">Judul Hero</label>
                            <input type="text" class="form-control" id="hero_title" name="hero_title" 
                                   value="{{ old('hero_title', $settings['hero_title'] ?? 'Selamat Datang di QofMedia') }}">
                        </div>
                        
                        <div class="form-group">
                            <label for="hero_subtitle">Subjudul Hero</label>
                            <input type="text" class="form-control" id="hero_subtitle" name="hero_subtitle" 
                                   value="{{ old('hero_subtitle', $settings['hero_subtitle'] ?? 'Tim Multimedia Pondok Pesantren Tahfidzul Qur\'an Nurul Huda') }}">
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="hero_cta_text">Teks Tombol CTA</label>
                                    <input type="text" class="form-control" id="hero_cta_text" name="hero_cta_text" 
                                           value="{{ old('hero_cta_text', $settings['hero_cta_text'] ?? 'Jelajahi Layanan') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="hero_cta_url">URL Tombol CTA</label>
                                    <input type="text" class="form-control" id="hero_cta_url" name="hero_cta_url" 
                                           value="{{ old('hero_cta_url', $settings['hero_cta_url'] ?? '/layanan/studio') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Settings -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-phone-alt mr-2"></i>
                            Pengaturan Kontak
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="whatsapp_studio">
                                        <i class="fab fa-whatsapp text-success mr-1"></i> 
                                        Nomor WhatsApp Studio
                                    </label>
                                    <input type="text" class="form-control" id="whatsapp_studio" name="whatsapp_studio" 
                                           value="{{ old('whatsapp_studio', $settings['whatsapp_studio'] ?? '6281246943349') }}" 
                                           placeholder="Contoh: 6281234567890">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="whatsapp_apparel">
                                        <i class="fab fa-whatsapp text-success mr-1"></i> 
                                        Nomor WhatsApp Apparel
                                    </label>
                                    <input type="text" class="form-control" id="whatsapp_apparel" name="whatsapp_apparel" 
                                           value="{{ old('whatsapp_apparel', $settings['whatsapp_apparel'] ?? '6281246943349') }}" 
                                           placeholder="Contoh: 6281234567890">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="email_contact">
                                <i class="fas fa-envelope mr-1"></i> Email Kontak
                            </label>
                            <input type="email" class="form-control" id="email_contact" name="email_contact" 
                                   value="{{ old('email_contact', $settings['email_contact'] ?? 'info@qofmedia.com') }}">
                        </div>
                        
                        <div class="form-group">
                            <label for="google_maps">
                                <i class="fas fa-map-marker-alt mr-1"></i> Embed Google Maps
                            </label>
                            <textarea class="form-control" id="google_maps" name="google_maps" rows="4">{{ old('google_maps', $settings['google_maps'] ?? '') }}</textarea>
                            <small class="form-text text-muted">
                                Paste kode embed iframe dari Google Maps.
                            </small>
                        </div>
                    </div>
                </div>

                <!-- Social Media Settings -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-share-alt mr-2"></i>
                            Social Media
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="facebook">
                                        <i class="fab fa-facebook text-primary mr-1"></i> Facebook
                                    </label>
                                    <input type="url" class="form-control" id="facebook" name="facebook" 
                                           value="{{ old('facebook', $settings['facebook'] ?? '') }}" 
                                           placeholder="https://facebook.com/qofmedia">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="instagram">
                                        <i class="fab fa-instagram text-danger mr-1"></i> Instagram
                                    </label>
                                    <input type="url" class="form-control" id="instagram" name="instagram" 
                                           value="{{ old('instagram', $settings['instagram'] ?? '') }}" 
                                           placeholder="https://instagram.com/qofmedia">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="twitter">
                                        <i class="fab fa-twitter text-info mr-1"></i> Twitter/X
                                    </label>
                                    <input type="url" class="form-control" id="twitter" name="twitter" 
                                           value="{{ old('twitter', $settings['twitter'] ?? '') }}" 
                                           placeholder="https://twitter.com/qofmedia">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tiktok">
                                        <i class="fab fa-tiktok text-dark mr-1"></i> TikTok
                                    </label>
                                    <input type="url" class="form-control" id="tiktok" name="tiktok" 
                                           value="{{ old('tiktok', $settings['tiktok'] ?? '') }}" 
                                           placeholder="https://tiktok.com/@qofmedia">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="youtube">
                                        <i class="fab fa-youtube text-danger mr-1"></i> YouTube
                                    </label>
                                    <input type="url" class="form-control" id="youtube" name="youtube" 
                                           value="{{ old('youtube', $settings['youtube'] ?? '') }}" 
                                           placeholder="https://youtube.com/@qofmedia">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                
                <!-- Site Identity -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-globe mr-2"></i>
                            Identitas Website
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="site_name">Nama Website</label>
                            <input type="text" class="form-control" id="site_name" name="site_name" 
                                   value="{{ old('site_name', $settings['site_name'] ?? 'QofMedia') }}">
                        </div>
                        
                        <div class="form-group">
                            <label for="site_description">Deskripsi Website</label>
                            <textarea class="form-control" id="site_description" name="site_description" rows="3">{{ old('site_description', $settings['site_description'] ?? 'Tim Multimedia Pondok Pesantren Tahfidzul Qur\'an Nurul Huda') }}</textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="site_keywords">Keywords (SEO)</label>
                            <input type="text" class="form-control" id="site_keywords" name="site_keywords" 
                                   value="{{ old('site_keywords', $settings['site_keywords'] ?? 'qofmedia, multimedia, fotografi, videografi, apparel') }}">
                        </div>
                    </div>
                </div>
                
                <!-- Logo & Favicon -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-image mr-2"></i>
                            Logo & Favicon
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Logo Saat Ini</label>
                            <div class="mb-2">
                                @php
                                    $logoPath = $settings['site_logo'] ?? 'images/logo/logo.png';
                                @endphp
                                @if(file_exists(public_path('storage/' . $logoPath)))
                                    <img src="{{ asset('storage/' . $logoPath) }}" alt="Logo" style="max-height: 50px;">
                                @else
                                    <img src="{{ asset($logoPath) }}" alt="Logo" style="max-height: 50px;">
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="site_logo">Upload Logo Baru</label>
                            <input type="file" class="form-control" id="site_logo" name="site_logo" accept="image/*">
                            <small class="form-text text-muted">Format PNG, JPG. Maksimal 2MB.</small>
                        </div>
                        
                        <hr>
                        
                        <div class="form-group">
                            <label>Favicon Saat Ini</label>
                            <div class="mb-2">
                                @php
                                    $faviconPath = $settings['site_favicon'] ?? 'favicon.ico';
                                @endphp
                                @if(file_exists(public_path('storage/' . $faviconPath)))
                                    <img src="{{ asset('storage/' . $faviconPath) }}" alt="Favicon" style="max-height: 32px;">
                                @else
                                    <i class="fas fa-globe fa-2x"></i>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="site_favicon">Upload Favicon Baru</label>
                            <input type="file" class="form-control" id="site_favicon" name="site_favicon" accept="image/*,image/x-icon">
                            <small class="form-text text-muted">Format ICO, PNG. Maksimal 1MB.</small>
                        </div>
                    </div>
                </div>
                
                <!-- Footer Settings -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-shoe-prints mr-2"></i>
                            Pengaturan Footer
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="footer_text">Teks Footer</label>
                            <input type="text" class="form-control" id="footer_text" name="footer_text" 
                                   value="{{ old('footer_text', $settings['footer_text'] ?? '') }}" 
                                   placeholder="Contoh: Tim Multimedia PPTQ Nurul Huda">
                        </div>
                        
                        <div class="form-group">
                            <label for="footer_copyright">Copyright Text</label>
                            <input type="text" class="form-control" id="footer_copyright" name="footer_copyright" 
                                   value="{{ old('footer_copyright', $settings['footer_copyright'] ?? 'Copyright © ' . date('Y') . ' QofMedia | Powered by QofMedia') }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Submit Button -->
        <div class="card">
            <div class="card-body">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fas fa-save mr-2"></i>Simpan Semua Pengaturan
                </button>
            </div>
        </div>
    </form>
@stop

@section('css')
    <style>
        .card-header {
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .card-header .card-title {
            font-weight: 600;
            color: #1e293b;
        }
    </style>
@stop