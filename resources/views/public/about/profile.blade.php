@extends('layouts.app')

@section('title', 'Profil QofMedia')

@push('styles')
<style>
    /* ============================================
       HERO MODERN - FULL WIDTH DENGAN OVERLAY GRADIENT
       ============================================ */
    .profile-hero {
        position: relative;
        background: linear-gradient(135deg, #0D1B2A 0%, #1B3A4B 50%, #0E7A96 100%);
        padding: 100px 0 80px;
        margin-top: -75px;
        overflow: hidden;
        text-align: center;
    }
    
    /* Ornamen geometris modern */
    .profile-hero::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 600px;
        height: 600px;
        background: radial-gradient(circle, rgba(78,184,204,0.15) 0%, transparent 70%);
        border-radius: 50%;
    }
    
    .profile-hero::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -10%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(168,221,232,0.1) 0%, transparent 70%);
        border-radius: 50%;
    }
    
    .profile-hero .container {
        position: relative;
        z-index: 1;
    }
    
    .profile-hero .badge {
        display: inline-block;
        background: rgba(255,255,255,0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.2);
        color: #A8DDE8;
        padding: 6px 16px;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 500;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        margin-bottom: 20px;
    }
    
    .profile-hero h1 {
        font-size: clamp(2.2rem, 5vw, 3.2rem);
        font-weight: 800;
        color: #fff;
        margin-bottom: 16px;
        letter-spacing: -0.5px;
        line-height: 1.2;
    }
    
    .profile-hero h1 span {
        background: linear-gradient(135deg, #4EB8CC, #A8DDE8);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .profile-hero p {
        color: rgba(255,255,255,0.7);
        font-size: 1.1rem;
        max-width: 550px;
        margin: 0 auto;
        line-height: 1.7;
    }
    
    /* ============================================
       ABOUT SECTION - CARD MODERN DENGAN SHADOW HALUS
       ============================================ */
    .about-section {
        padding: 80px 0;
        background: #fff;
    }
    
    .about-grid {
        display: grid;
        grid-template-columns:  0.9fr 1.1fr;
        gap: 60px;
        align-items: center;
    }
    
    .about-image-wrapper {
        position: relative;
        max-width: 360px;
        margin: 0 auto;
    }
    
    .about-image-wrapper .main-img {
        width: 100%;
        border-radius: 20px;
        box-shadow: 0 25px 60px rgba(0,0,0,0.08);
        transition: transform 0.4s ease;
    }
    
    .about-image-wrapper:hover .main-img {
        transform: scale(1.02);
    }
    
    .about-image-wrapper .placeholder-box {
        width: 100%;
        aspect-ratio: 4/3;
        background: linear-gradient(135deg, #EEF2FF 0%, #E0E7FF 100%);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 25px 60px rgba(0,0,0,0.06);
    }
    
    .about-image-wrapper .placeholder-box i {
        font-size: 80px;
        color: #0E7A96;
        opacity: 0.4;
    }
    
    /* Decorative dot pattern */
    .about-image-wrapper .dot-pattern {
        position: absolute;
        width: 120px;
        height: 120px;
        background-image: radial-gradient(#4EB8CC 2px, transparent 2px);
        background-size: 16px 16px;
        top: -20px;
        right: -20px;
        z-index: -1;
        opacity: 0.6;
    }
    
    /* Stats mini cards */
    .about-stats {
        display: flex;
        gap: 20px;
        margin-top: 32px;
    }
    
    .stat-item {
        text-align: center;
        background: #F8FAFC;
        border-radius: 14px;
        padding: 16px 20px;
        flex: 1;
        border: 1px solid #E2E8F0;
        transition: all 0.3s;
    }
    
    .stat-item:hover {
        border-color: #4EB8CC;
        box-shadow: 0 8px 24px rgba(14,122,150,0.08);
    }
    
    .stat-item .stat-number {
        font-size: 1.8rem;
        font-weight: 700;
        color: #0E7A96;
        line-height: 1;
    }
    
    .stat-item .stat-label {
        font-size: 0.8rem;
        color: #64748B;
        margin-top: 6px;
        font-weight: 500;
    }
    
    .about-content .section-label {
        display: inline-block;
        color: #0E7A96;
        font-weight: 600;
        font-size: 0.85rem;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        margin-bottom: 12px;
    }
    
    .about-content h2 {
        font-size: 2rem;
        font-weight: 700;
        color: #0D1B2A;
        margin-bottom: 20px;
        line-height: 1.3;
    }
    
    .about-content p {
        color: #475569;
        line-height: 1.9;
        font-size: 1rem;
    }
    
    /* ============================================
       VISI MISI - CARD DENGAN IKON BESAR
       ============================================ */
    .vision-section {
        padding: 80px 0;
        background: #F8FAFC;
    }
    
    .vision-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
    }
    
    .vision-card {
        background: #fff;
        border-radius: 20px;
        padding: 36px 32px;
        border: 1px solid #E2E8F0;
        transition: all 0.3s;
        position: relative;
        overflow: hidden;
    }
    
    .vision-card:hover {
        border-color: #4EB8CC;
        box-shadow: 0 20px 40px rgba(14,122,150,0.08);
        transform: translateY(-4px);
    }
    
    .vision-card .icon-circle {
        width: 56px;
        height: 56px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        margin-bottom: 20px;
    }
    
    .vision-card .icon-circle.vision {
        background: linear-gradient(135deg, #FEF3C7, #FDE68A);
        color: #D97706;
    }
    
    .vision-card .icon-circle.mission {
        background: linear-gradient(135deg, #DBEAFE, #BFDBFE);
        color: #2563EB;
    }
    
    .vision-card h3 {
        font-size: 1.3rem;
        font-weight: 700;
        color: #0D1B2A;
        margin-bottom: 12px;
    }
    
    .vision-card p {
        color: #64748B;
        line-height: 1.8;
        margin: 0;
    }
    
    /* ============================================
       VALUES - GRID MODERN
       ============================================ */
    .values-section {
        padding: 80px 0;
        background: #fff;
    }
    
    .values-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 24px;
    }
    
    .value-card {
        text-align: center;
        padding: 32px 20px;
        background: #F8FAFC;
        border-radius: 16px;
        border: 1px solid #E2E8F0;
        transition: all 0.3s;
    }
    
    .value-card:hover {
        background: #fff;
        border-color: #4EB8CC;
        box-shadow: 0 12px 32px rgba(14,122,150,0.08);
        transform: translateY(-4px);
    }
    
    .value-card .value-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 16px;
        font-size: 24px;
    }
    
    .value-card:nth-child(1) .value-icon { background: #EEF2FF; color: #4F46E5; }
    .value-card:nth-child(2) .value-icon { background: #FEE2E2; color: #DC2626; }
    .value-card:nth-child(3) .value-icon { background: #D1FAE5; color: #059669; }
    .value-card:nth-child(4) .value-icon { background: #FEF3C7; color: #D97706; }
    
    .value-card h4 {
        font-weight: 700;
        color: #0D1B2A;
        margin-bottom: 8px;
        font-size: 1.05rem;
    }
    
    .value-card p {
        color: #64748B;
        font-size: 0.9rem;
        line-height: 1.6;
        margin: 0;
    }
    
    
    /* ============================================
       CTA MODERN
       ============================================ */
    .cta-modern {
        padding: 80px 0;
        background: #fff;
    }
    
    .cta-card {
        background: linear-gradient(135deg, #0D1B2A 0%, #1B3A4B 50%, #0E7A96 100%);
        border-radius: 24px;
        padding: 56px 48px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    
    .cta-card::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(78,184,204,0.2) 0%, transparent 70%);
        border-radius: 50%;
    }
    
    .cta-card > * {
        position: relative;
        z-index: 1;
    }
    
    .cta-card h2 {
        color: #fff;
        font-weight: 800;
        font-size: 2rem;
        margin-bottom: 12px;
    }
    
    .cta-card p {
        color: rgba(255,255,255,0.7);
        font-size: 1.05rem;
        margin-bottom: 28px;
    }
    
    .cta-card .btn-group {
        display: flex;
        gap: 16px;
        justify-content: center;
        flex-wrap: wrap;
    }
    
    .btn-cta-primary {
        background: #4EB8CC;
        color: #0D1B2A;
        border: none;
        padding: 14px 32px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.95rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s;
    }
    
    .btn-cta-primary:hover {
        background: #A8DDE8;
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(78,184,204,0.3);
        color: #0D1B2A;
    }
    
    .btn-cta-outline {
        background: transparent;
        color: #fff;
        border: 2px solid rgba(255,255,255,0.3);
        padding: 14px 32px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.95rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s;
    }
    
    .btn-cta-outline:hover {
        border-color: #fff;
        background: rgba(255,255,255,0.1);
        color: #fff;
    }
    
    /* Section Header Global */
    .section-header {
        text-align: center;
        margin-bottom: 48px;
    }
    
    .section-header .label {
        display: inline-block;
        color: #0E7A96;
        font-weight: 600;
        font-size: 0.8rem;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        margin-bottom: 10px;
    }
    
    .section-header h2 {
        font-size: 2rem;
        font-weight: 800;
        color: #0D1B2A;
        margin-bottom: 8px;
    }
    
    .section-header p {
        color: #64748B;
        max-width: 500px;
        margin: 0 auto;
        line-height: 1.6;
    }
    
    /* ============================================
       RESPONSIVE
       ============================================ */
    @media (max-width: 992px) {
        .about-grid {
            grid-template-columns: 1fr;
            gap: 40px;
        }
        
        .values-grid {
            grid-template-columns: 1fr 1fr;
        }
        
        .vision-grid {
            grid-template-columns: 1fr;
        }
    }
    
    @media (max-width: 768px) {
        .profile-hero {
            padding: 70px 0 50px;
        }
        
        .values-grid {
            grid-template-columns: 1fr;
        }
        
        .cta-card {
            padding: 36px 24px;
        }
        
        .cta-card h2 {
            font-size: 1.5rem;
        }
        
        .about-stats {
            flex-wrap: wrap;
        }
    }
</style>
@endpush

@section('content')

{{-- ============================================
     HERO SECTION
     ============================================ --}}
<section class="profile-hero">
    <div class="container">
        <span class="badge">Tentang Kami</span>
        <h1>Mengenal <span>QofMedia</span></h1>
        <p>Tim multimedia profesional di bawah naungan Pondok Pesantren Tahfidzul Qur'an Nurul Huda yang mengintegrasikan teknologi modern dengan nilai-nilai islami.</p>
    </div>
</section>

{{-- ============================================
     ABOUT SECTION
     ============================================ --}}
<section class="about-section">
    <div class="container">
        <div class="about-grid">
            {{-- Foto --}}
            <div class="about-image-wrapper">
                <div class="dot-pattern"></div>
                @php
                    $aboutPhoto = 'images/logo/logo-qof.png';
                    $hasPhoto = file_exists(public_path($aboutPhoto));
                @endphp
                @if($hasPhoto)
                    <img src="{{ asset($aboutPhoto) }}" alt="Tim QofMedia" class="main-img">
                @else
                    <div class="placeholder-box">
                        <i class="bi bi-people-fill"></i>
                    </div>
                @endif
            </div>
            
            {{-- Konten --}}
            <div class="about-content">
                <span class="section-label">Siapa Kami?</span>
                <h2>Tim Kreatif di Balik QofMedia</h2>
                
                @if($page && $page->content)
                    {!! $page->content !!}
                @else
                    <p>
                        <strong>QofMedia</strong> hadir sebagai unit multimedia Pondok Pesantren 
                        Tahfidzul Qur'an Nurul Huda sejak 2020. Kami menggabungkan keahlian teknis 
                        dengan semangat kreativitas santri untuk menghasilkan karya yang profesional 
                        dan bermakna.
                    </p>
                    <p>
                        Lebih dari sekadar penyedia jasa, kami adalah komunitas kreatif yang terus 
                        bertumbuh. Setiap anggota tim kami dibekali keterampilan di bidang fotografi, 
                        videografi, desain grafis, dan produksi konten digital.
                    </p>
                @endif
                
                {{-- Stats --}}
                <div class="about-stats">
                    <div class="stat-item">
                        <div class="stat-number">4+</div>
                        <div class="stat-label">Tahun Berkarya</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">100+</div>
                        <div class="stat-label">Klien Puas</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">3</div>
                        <div class="stat-label">Layanan Utama</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============================================
     VISI & MISI SECTION
     ============================================ --}}
<section class="vision-section">
    <div class="container">
        <div class="section-header">
            <span class="label">Arah & Tujuan</span>
            <h2>Visi & Misi</h2>
            <p>Landasan yang menjadi pedoman setiap langkah kami</p>
        </div>
        
        <div class="vision-grid">
            <div class="vision-card">
                <div class="icon-circle vision">
                    <i class="bi bi-star-fill"></i>
                </div>
                <h3>Visi</h3>
                <p>Menjadi tim multimedia terdepan yang mengintegrasikan profesionalisme dengan nilai-nilai islami, serta menjadi wadah pengembangan kreativitas santri di era digital.</p>
            </div>
            
            <div class="vision-card">
                <div class="icon-circle mission">
                    <i class="bi bi-bullseye"></i>
                </div>
                <h3>Misi</h3>
                <p>Memberikan layanan multimedia berkualitas dengan harga terjangkau, mengembangkan potensi santri, dan mendukung dakwah melalui konten kreatif yang inspiratif.</p>
            </div>
        </div>
    </div>
</section>

{{-- ============================================
     VALUES SECTION
     ============================================ --}}
<section class="values-section">
    <div class="container">
        <div class="section-header">
            <span class="label">Prinsip Kami</span>
            <h2>Nilai-Nilai QofMedia</h2>
            <p>Komitmen yang kami pegang dalam setiap karya</p>
        </div>
        
        <div class="values-grid">
            <div class="value-card">
                <div class="value-icon">
                    <i class="bi bi-shield-check"></i>
                </div>
                <h4>Profesional</h4>
                <p>Kualitas dan ketepatan waktu adalah prioritas utama kami.</p>
            </div>
            
            <div class="value-card">
                <div class="value-icon">
                    <i class="bi bi-heart-fill"></i>
                </div>
                <h4>Amanah</h4>
                <p>Menjaga kepercayaan dengan integritas dan tanggung jawab.</p>
            </div>
            
            <div class="value-card">
                <div class="value-icon">
                    <i class="bi bi-people-fill"></i>
                </div>
                <h4>Kolaboratif</h4>
                <p>Bersinergi sebagai tim untuk hasil yang maksimal.</p>
            </div>
            
            <div class="value-card">
                <div class="value-icon">
                    <i class="bi bi-lightbulb-fill"></i>
                </div>
                <h4>Inovatif</h4>
                <p>Terus belajar mengikuti perkembangan teknologi terkini.</p>
            </div>
        </div>
    </div>
</section>


{{-- ============================================
     CTA SECTION
     ============================================ --}}
<section class="cta-modern">
    <div class="container">
        <div class="cta-card">
            <h2>Siap Bekerja Sama dengan Kami?</h2>
            <p>Percayakan kebutuhan multimedia Anda kepada tim profesional kami. Konsultasikan ide Anda sekarang juga!</p>
            <div class="btn-group">
                <a href="{{ route('contact') }}" class="btn-cta-primary">
                    <i class="bi bi-whatsapp"></i> Hubungi Kami
                </a>
                <a href="{{ route('service.studio') }}" class="btn-cta-outline">
                    Jelajahi Layanan <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</section>

@endsection