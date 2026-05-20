@extends('adminlte::page')

@section('title', 'Pengaturan Website')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="mb-0" style="font-size: 1.4rem; font-weight: 700; color: #0D1B2A;">
                <i class="fas fa-cog me-2" style="color: #0E7A96;"></i> Pengaturan Website
            </h1>
            <ol class="breadcrumb mb-0 mt-1" style="font-size: 0.8rem; background: transparent; padding: 0;">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Pengaturan</li>
            </ol>
        </div>
        <button form="settingsForm" type="submit" 
                style="display:inline-flex; align-items:center; gap:7px; background:#0E7A96; color:#fff; padding:10px 22px; border-radius:50px; font-weight:700; font-size:0.88rem; border:none; cursor:pointer; box-shadow:0 4px 14px rgba(14,122,150,0.28); transition:all 0.25s;">
            <i class="fas fa-save"></i> Simpan Semua
        </button>
    </div>
@stop

@push('css')
<style>
    /* ============================================
       LAYOUT
       ============================================ */
    .settings-grid {
        display: grid;
        grid-template-columns: 1fr 340px;
        gap: 20px;
        align-items: start;
    }
    @media (max-width: 960px) {
        .settings-grid { grid-template-columns: 1fr; }
    }

    /* ============================================
       SECTION CARD
       ============================================ */
    .section-card {
        background: #fff;
        border: 1px solid #E2E8F0;
        border-radius: 20px;
        overflow: hidden;
        margin-bottom: 20px;
    }
    .section-card:last-child { margin-bottom: 0; }

    .section-card-header {
        padding: 16px 24px;
        border-bottom: 1px solid #F1F5F9;
        display: flex; align-items: center; gap: 10px;
    }
    .section-card-header .icon-wrap {
        width: 34px; height: 34px;
        background: rgba(14,122,150,0.09);
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        color: #0E7A96; font-size: 0.85rem; flex-shrink: 0;
    }
    .section-card-header h6 {
        margin: 0; font-size: 0.88rem; font-weight: 700; color: #0D1B2A;
    }
    .section-card-body { padding: 24px; }

    /* ============================================
       FORM FIELDS
       ============================================ */
    .field-group { margin-bottom: 18px; }
    .field-group:last-child { margin-bottom: 0; }

    .field-label {
        display: block;
        font-size: 0.78rem; font-weight: 700;
        text-transform: uppercase; letter-spacing: 0.06em;
        color: #94A3B8; margin-bottom: 7px;
    }
    .field-label .req { color: #EF4444; margin-left: 2px; }
    .field-label .lbl-icon { margin-right: 4px; }

    .field-input {
        width: 100%;
        border: 1.5px solid #E2E8F0; border-radius: 10px;
        padding: 10px 14px; font-size: 0.88rem;
        color: #0D1B2A; background: #F8FAFC; outline: none;
        transition: border-color 0.2s, background 0.2s, box-shadow 0.2s;
        box-sizing: border-box;
    }
    .field-input:focus {
        border-color: #0E7A96; background: #fff;
        box-shadow: 0 0 0 3px rgba(14,122,150,0.10);
    }
    textarea.field-input { resize: vertical; min-height: 90px; line-height: 1.6; }
    .field-hint { font-size: 0.76rem; color: #94A3B8; margin-top: 5px; margin-bottom: 0; }

    /* ============================================
       TWO-COL INSIDE CARD
       ============================================ */
    .two-col {
        display: grid; grid-template-columns: 1fr 1fr; gap: 16px;
    }
    @media (max-width: 600px) { .two-col { grid-template-columns: 1fr; } }

    /* ============================================
       SOCIAL MEDIA ROWS
       ============================================ */
    .social-item {
        display: flex; align-items: center; gap: 10px;
        padding: 10px 14px;
        border: 1.5px solid #E2E8F0; border-radius: 12px;
        background: #F8FAFC; margin-bottom: 10px;
        transition: border-color 0.2s, background 0.2s;
    }
    .social-item:last-child { margin-bottom: 0; }
    .social-item:focus-within {
        border-color: #0E7A96; background: #fff;
        box-shadow: 0 0 0 3px rgba(14,122,150,0.08);
    }
    .social-item .s-icon {
        font-size: 1.1rem; flex-shrink: 0; width: 22px;
        text-align: center;
    }
    .social-item .s-label {
        font-size: 0.78rem; font-weight: 700; color: #64748B;
        min-width: 72px; flex-shrink: 0;
    }
    .social-item input {
        flex: 1; border: none; outline: none;
        background: transparent; font-size: 0.85rem; color: #0D1B2A;
    }
    .social-item input::placeholder { color: #CBD5E1; }

    /* ============================================
       LOGO / FAVICON PREVIEW
       ============================================ */
    .asset-preview-row {
        display: flex; align-items: center; gap: 16px;
        padding: 14px 16px;
        background: #F8FAFC; border: 1.5px dashed #E2E8F0;
        border-radius: 12px; margin-bottom: 12px;
        transition: border-color 0.2s;
    }
    .asset-preview-row:hover { border-color: #0E7A96; }
    .asset-preview-box {
        width: 56px; height: 56px; border-radius: 10px;
        background: #fff; border: 1px solid #E2E8F0;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0; overflow: hidden;
    }
    .asset-preview-box img { max-width: 100%; max-height: 100%; object-fit: contain; }
    .asset-preview-box i { color: #CBD5E1; font-size: 1.4rem; }
    .asset-meta strong {
        display: block; font-size: 0.82rem;
        font-weight: 700; color: #0D1B2A; margin-bottom: 2px;
    }
    .asset-meta span { font-size: 0.74rem; color: #94A3B8; }

    .asset-divider {
        border: none; border-top: 1px dashed #E2E8F0; margin: 20px 0;
    }

    /* ============================================
       MAPS TEXTAREA SPECIAL
       ============================================ */
    .maps-wrap { position: relative; }
    .maps-wrap .field-input { font-family: monospace; font-size: 0.78rem; min-height: 100px; }
    .maps-badge {
        position: absolute; top: 10px; right: 10px;
        background: rgba(14,122,150,0.09); color: #0E7A96;
        font-size: 0.68rem; font-weight: 700; padding: 3px 8px;
        border-radius: 6px; pointer-events: none;
    }

    /* ============================================
       ACTION BAR
       ============================================ */
    .action-bar {
        background: #fff; border: 1px solid #E2E8F0;
        border-radius: 16px; padding: 18px 24px;
        display: flex; align-items: center;
        justify-content: space-between; gap: 12px;
        margin-top: 20px; flex-wrap: wrap;
    }
    .action-bar .left-info {
        font-size: 0.82rem; color: #94A3B8;
        display: flex; align-items: center; gap: 8px;
    }
    .action-bar .left-info i { color: #CBD5E1; }
    .btn-save {
        display: inline-flex; align-items: center; gap: 8px;
        background: #0E7A96; color: #fff; padding: 11px 28px;
        border-radius: 50px; font-weight: 700; font-size: 0.88rem;
        border: none; cursor: pointer; transition: all 0.25s;
        box-shadow: 0 4px 14px rgba(14,122,150,0.28);
    }
    .btn-save:hover {
        background: #0a5a70; color: #fff;
        box-shadow: 0 6px 20px rgba(14,122,150,0.38);
        transform: translateY(-1px);
    }

    /* ============================================
       ALERT
       ============================================ */
    .alert-success-custom {
        border-radius: 12px; border: none;
        background: #D1FAE5; color: #065F46;
        font-size: 0.88rem; padding: 12px 18px;
        display: flex; align-items: center; gap: 8px;
        margin-bottom: 20px;
    }

    /* ============================================
       SECTION DIVIDER LABEL
       ============================================ */
    .sub-divider {
        display: flex; align-items: center; gap: 10px;
        margin: 20px 0 16px;
    }
    .sub-divider span {
        font-size: 0.72rem; font-weight: 700; text-transform: uppercase;
        letter-spacing: 0.07em; color: #CBD5E1; white-space: nowrap;
    }
    .sub-divider::before, .sub-divider::after {
        content: ''; flex: 1; height: 1px; background: #F1F5F9;
    }
</style>
@endpush

@section('content')

    {{-- Alert --}}
    @if(session('success'))
        <div class="alert-success-custom">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="close ml-auto" data-dismiss="alert"
                    style="background:none; border:none; cursor:pointer; color:#065F46; font-size:1rem;">&times;</button>
        </div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" id="settingsForm">
        @csrf

        <div class="settings-grid">

            {{-- ==================== KOLOM KIRI ==================== --}}
            <div>

                {{-- Hero / Beranda --}}
                <div class="section-card">
                    <div class="section-card-header">
                        <div class="icon-wrap"><i class="fas fa-home"></i></div>
                        <h6>Pengaturan Beranda (Hero)</h6>
                    </div>
                    <div class="section-card-body">

                        <div class="field-group">
                            <label class="field-label" for="hero_title">Judul Hero</label>
                            <input type="text" id="hero_title" name="hero_title" class="field-input"
                                   value="{{ old('hero_title', $settings['hero_title'] ?? 'Selamat Datang di QofMedia') }}"
                                   placeholder="Judul utama halaman beranda">
                        </div>

                        <div class="field-group">
                            <label class="field-label" for="hero_subtitle">Subjudul Hero</label>
                            <input type="text" id="hero_subtitle" name="hero_subtitle" class="field-input"
                                   value="{{ old('hero_subtitle', $settings['hero_subtitle'] ?? 'Tim Multimedia Pondok Pesantren Tahfidzul Qur\'an Nurul Huda') }}"
                                   placeholder="Subjudul atau tagline singkat">
                        </div>

                        <div class="two-col">
                            <div class="field-group" style="margin-bottom:0;">
                                <label class="field-label" for="hero_cta_text">Teks Tombol CTA</label>
                                <input type="text" id="hero_cta_text" name="hero_cta_text" class="field-input"
                                       value="{{ old('hero_cta_text', $settings['hero_cta_text'] ?? 'Jelajahi Layanan') }}"
                                       placeholder="Contoh: Jelajahi Layanan">
                            </div>
                            <div class="field-group" style="margin-bottom:0;">
                                <label class="field-label" for="hero_cta_url">URL Tombol CTA</label>
                                <input type="text" id="hero_cta_url" name="hero_cta_url" class="field-input"
                                       value="{{ old('hero_cta_url', $settings['hero_cta_url'] ?? '/layanan/studio') }}"
                                       placeholder="/layanan/studio">
                            </div>
                        </div>

                    </div>
                </div>

                {{-- Kontak --}}
                <div class="section-card">
                    <div class="section-card-header">
                        <div class="icon-wrap"><i class="fas fa-phone-alt"></i></div>
                        <h6>Pengaturan Kontak</h6>
                    </div>
                    <div class="section-card-body">

                        <div class="two-col">
                            <div class="field-group">
                                <label class="field-label" for="whatsapp_studio">
                                    <i class="fab fa-whatsapp lbl-icon" style="color:#25D366;"></i> WhatsApp Studio
                                </label>
                                <input type="text" id="whatsapp_studio" name="whatsapp_studio" class="field-input"
                                       value="{{ old('whatsapp_studio', $settings['whatsapp_studio'] ?? '6281246943349') }}"
                                       placeholder="6281234567890">
                                <p class="field-hint">Sertakan kode negara, tanpa +</p>
                            </div>
                            <div class="field-group">
                                <label class="field-label" for="whatsapp_apparel">
                                    <i class="fab fa-whatsapp lbl-icon" style="color:#25D366;"></i> WhatsApp Apparel
                                </label>
                                <input type="text" id="whatsapp_apparel" name="whatsapp_apparel" class="field-input"
                                       value="{{ old('whatsapp_apparel', $settings['whatsapp_apparel'] ?? '6281246943349') }}"
                                       placeholder="6281234567890">
                                <p class="field-hint">Sertakan kode negara, tanpa +</p>
                            </div>
                        </div>

                        <div class="field-group">
                            <label class="field-label" for="email_contact">
                                <i class="fas fa-envelope lbl-icon" style="color:#0E7A96;"></i> Email Kontak
                            </label>
                            <input type="email" id="email_contact" name="email_contact" class="field-input"
                                   value="{{ old('email_contact', $settings['email_contact'] ?? 'info@qofmedia.com') }}"
                                   placeholder="info@qofmedia.com">
                        </div>

                        <div class="field-group" style="margin-bottom:0;">
                            <label class="field-label" for="google_maps">
                                <i class="fas fa-map-marker-alt lbl-icon" style="color:#EF4444;"></i> Embed Google Maps
                            </label>
                            <div class="maps-wrap">
                                <textarea id="google_maps" name="google_maps"
                                          class="field-input"
                                          placeholder='<iframe src="https://maps.google.com/..." ...></iframe>'>{{ old('google_maps', $settings['google_maps'] ?? '') }}</textarea>
                                <span class="maps-badge">iframe</span>
                            </div>
                            <p class="field-hint">Paste kode embed iframe dari Google Maps.</p>
                        </div>

                    </div>
                </div>

                {{-- Social Media --}}
                <div class="section-card">
                    <div class="section-card-header">
                        <div class="icon-wrap"><i class="fas fa-share-alt"></i></div>
                        <h6>Media Sosial</h6>
                    </div>
                    <div class="section-card-body">

                        <div class="social-item">
                            <i class="fab fa-facebook s-icon" style="color:#1877F2;"></i>
                            <span class="s-label">Facebook</span>
                            <input type="url" name="facebook"
                                   value="{{ old('facebook', $settings['facebook'] ?? '') }}"
                                   placeholder="https://facebook.com/qofmedia">
                        </div>

                        <div class="social-item">
                            <i class="fab fa-instagram s-icon" style="color:#C13584;"></i>
                            <span class="s-label">Instagram</span>
                            <input type="url" name="instagram"
                                   value="{{ old('instagram', $settings['instagram'] ?? '') }}"
                                   placeholder="https://instagram.com/qofmedia">
                        </div>

                        <div class="social-item">
                            <i class="fab fa-twitter s-icon" style="color:#1DA1F2;"></i>
                            <span class="s-label">Twitter / X</span>
                            <input type="url" name="twitter"
                                   value="{{ old('twitter', $settings['twitter'] ?? '') }}"
                                   placeholder="https://twitter.com/qofmedia">
                        </div>

                        <div class="social-item">
                            <i class="fab fa-tiktok s-icon" style="color:#010101;"></i>
                            <span class="s-label">TikTok</span>
                            <input type="url" name="tiktok"
                                   value="{{ old('tiktok', $settings['tiktok'] ?? '') }}"
                                   placeholder="https://tiktok.com/@qofmedia">
                        </div>

                        <div class="social-item">
                            <i class="fab fa-youtube s-icon" style="color:#FF0000;"></i>
                            <span class="s-label">YouTube</span>
                            <input type="url" name="youtube"
                                   value="{{ old('youtube', $settings['youtube'] ?? '') }}"
                                   placeholder="https://youtube.com/@qofmedia">
                        </div>

                    </div>
                </div>

            </div>

            {{-- ==================== KOLOM KANAN (SIDEBAR) ==================== --}}
            <div>

                {{-- Identitas Website --}}
                <div class="section-card">
                    <div class="section-card-header">
                        <div class="icon-wrap"><i class="fas fa-globe"></i></div>
                        <h6>Identitas Website</h6>
                    </div>
                    <div class="section-card-body">

                        <div class="field-group">
                            <label class="field-label" for="site_name">Nama Website</label>
                            <input type="text" id="site_name" name="site_name" class="field-input"
                                   value="{{ old('site_name', $settings['site_name'] ?? 'QofMedia') }}"
                                   placeholder="QofMedia">
                        </div>

                        <div class="field-group">
                            <label class="field-label" for="site_description">Deskripsi Website</label>
                            <textarea id="site_description" name="site_description"
                                      class="field-input" style="min-height:80px;"
                                      placeholder="Deskripsi singkat website...">{{ old('site_description', $settings['site_description'] ?? 'Tim Multimedia Pondok Pesantren Tahfidzul Qur\'an Nurul Huda') }}</textarea>
                        </div>

                        <div class="field-group" style="margin-bottom:0;">
                            <label class="field-label" for="site_keywords">Keywords (SEO)</label>
                            <input type="text" id="site_keywords" name="site_keywords" class="field-input"
                                   value="{{ old('site_keywords', $settings['site_keywords'] ?? 'qofmedia, multimedia, fotografi, videografi, apparel') }}"
                                   placeholder="kata1, kata2, kata3">
                            <p class="field-hint">Pisahkan dengan koma.</p>
                        </div>

                    </div>
                </div>

                {{-- Logo & Favicon --}}
                <div class="section-card">
                    <div class="section-card-header">
                        <div class="icon-wrap"><i class="fas fa-image"></i></div>
                        <h6>Logo & Favicon</h6>
                    </div>
                    <div class="section-card-body">

                        {{-- Logo --}}
                        @php $logoPath = $settings['site_logo'] ?? 'images/logo/logo.png'; @endphp
                        <div class="asset-preview-row">
                            <div class="asset-preview-box">
                                @if(file_exists(public_path('storage/' . $logoPath)))
                                    <img src="{{ asset('storage/' . $logoPath) }}" alt="Logo">
                                @else
                                    <img src="{{ asset($logoPath) }}" alt="Logo"
                                         onerror="this.parentElement.innerHTML='<i class=\'fas fa-image\'></i>'">
                                @endif
                            </div>
                            <div class="asset-meta">
                                <strong>Logo Saat Ini</strong>
                                <span>PNG, JPG · maks 2MB</span>
                            </div>
                        </div>
                        <div class="field-group">
                            <label class="field-label" for="site_logo">Upload Logo Baru</label>
                            <input type="file" id="site_logo" name="site_logo"
                                   class="field-input" accept="image/*"
                                   onchange="previewAsset(this, 'logoPreview')">
                            <p class="field-hint">Kosongkan jika tidak ingin mengganti.</p>
                        </div>

                        <hr class="asset-divider">

                        {{-- Favicon --}}
                        @php $faviconPath = $settings['site_favicon'] ?? 'favicon.ico'; @endphp
                        <div class="asset-preview-row">
                            <div class="asset-preview-box">
                                @if(file_exists(public_path('storage/' . $faviconPath)))
                                    <img src="{{ asset('storage/' . $faviconPath) }}" alt="Favicon">
                                @else
                                    <i class="fas fa-globe" style="color:#CBD5E1; font-size:1.3rem;"></i>
                                @endif
                            </div>
                            <div class="asset-meta">
                                <strong>Favicon Saat Ini</strong>
                                <span>ICO, PNG · maks 1MB</span>
                            </div>
                        </div>
                        <div class="field-group" style="margin-bottom:0;">
                            <label class="field-label" for="site_favicon">Upload Favicon Baru</label>
                            <input type="file" id="site_favicon" name="site_favicon"
                                   class="field-input" accept="image/*,image/x-icon">
                            <p class="field-hint">Kosongkan jika tidak ingin mengganti.</p>
                        </div>

                    </div>
                </div>

                {{-- Footer --}}
                <div class="section-card">
                    <div class="section-card-header">
                        <div class="icon-wrap"><i class="fas fa-shoe-prints"></i></div>
                        <h6>Pengaturan Footer</h6>
                    </div>
                    <div class="section-card-body">

                        <div class="field-group">
                            <label class="field-label" for="footer_text">Teks Footer</label>
                            <input type="text" id="footer_text" name="footer_text" class="field-input"
                                   value="{{ old('footer_text', $settings['footer_text'] ?? '') }}"
                                   placeholder="Contoh: Tim Multimedia PPTQ Nurul Huda">
                        </div>

                        <div class="field-group" style="margin-bottom:0;">
                            <label class="field-label" for="footer_copyright">Copyright</label>
                            <input type="text" id="footer_copyright" name="footer_copyright" class="field-input"
                                   value="{{ old('footer_copyright', $settings['footer_copyright'] ?? 'Copyright © ' . date('Y') . ' QofMedia | Powered by QofMedia') }}"
                                   placeholder="Copyright © 2025 QofMedia">
                        </div>

                    </div>
                </div>

            </div>
        </div>

        {{-- Action Bar --}}
        <div class="action-bar">
            <div class="left-info">
                <i class="fas fa-info-circle"></i>
                Perubahan akan diterapkan segera setelah disimpan.
            </div>
            <button type="submit" class="btn-save">
                <i class="fas fa-save"></i> Simpan Semua Pengaturan
            </button>
        </div>

    </form>

@stop

@push('js')
<script>
    function previewAsset(input, previewId) {
        if (!input.files || !input.files[0]) return;
        const reader = new FileReader();
        reader.onload = function(e) {
            const box = input.closest('.section-card-body').querySelector('.asset-preview-box');
            if (box) {
                box.innerHTML = '<img src="' + e.target.result + '" style="max-width:100%;max-height:100%;object-fit:contain;">';
            }
        };
        reader.readAsDataURL(input.files[0]);
    }
</script>
@endpush