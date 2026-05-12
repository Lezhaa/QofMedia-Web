@extends('layouts.app')

@section('title', 'Profil QofMedia')

@push('styles')
<style>
    /* ============================================
       SCROLL PROGRESS BAR
       ============================================ */
    .scroll-progress-bar {
        position: fixed;
        top: 0;
        left: 0;
        height: 3px;
        width: 0%;
        background: linear-gradient(90deg, #4EB8CC, #A8DDE8, #4EB8CC);
        background-size: 200%;
        z-index: 9999;
        transition: width 0.08s linear;
        animation: shimmerBar 3s linear infinite;
    }
    @keyframes shimmerBar {
        0%   { background-position: 0%; }
        100% { background-position: 200%; }
    }

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
        min-height: 380px;
        display: flex;
        align-items: center;
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
        width: 100%;
        will-change: opacity, transform;
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

        /* Animation start state */
        opacity: 0;
        transform: translateY(20px);
        animation: fadeUp 0.7s cubic-bezier(0.22, 1, 0.36, 1) 0.1s forwards;
    }

    .profile-hero h1 {
        font-size: clamp(2.2rem, 5vw, 3.2rem);
        font-weight: 800;
        color: #fff;
        margin-bottom: 16px;
        letter-spacing: -0.5px;
        line-height: 1.2;

        opacity: 0;
        transform: translateY(24px);
        animation: fadeUp 0.75s cubic-bezier(0.22, 1, 0.36, 1) 0.25s forwards;
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

        opacity: 0;
        transform: translateY(20px);
        animation: fadeUp 0.7s cubic-bezier(0.22, 1, 0.36, 1) 0.42s forwards;
    }



    /* ============================================
       ABOUT SECTION
       ============================================ */
    .about-section {
        padding: 80px 0;
        background: #fff;
    }

    .about-grid {
        display: grid;
        grid-template-columns: 0.9fr 1.1fr;
        gap: 60px;
        align-items: center;
    }

    .about-image-wrapper {
        position: relative;
        max-width: 360px;
        margin: 0 auto;

        /* Reveal state */
        opacity: 0;
        transform: translateX(-40px);
        transition: opacity 0.75s cubic-bezier(0.22, 1, 0.36, 1),
                    transform 0.75s cubic-bezier(0.22, 1, 0.36, 1);
        will-change: opacity, transform;
    }
    .about-image-wrapper.is-visible {
        opacity: 1;
        transform: none;
    }

    .about-image-wrapper .main-img {
        width: 100%;
        border-radius: 20px;
        box-shadow: 0 25px 60px rgba(0,0,0,0.08);
        transition: transform 0.4s ease;
    }
    .about-image-wrapper:hover .main-img { transform: scale(1.02); }

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
    .about-image-wrapper .placeholder-box i { font-size: 80px; color: #0E7A96; opacity: 0.4; }

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

    /* Stats */
    .about-stats { display: flex; gap: 20px; margin-top: 32px; }

    .stat-item {
        text-align: center;
        background: #F8FAFC;
        border-radius: 14px;
        padding: 16px 20px;
        flex: 1;
        border: 1px solid #E2E8F0;
        transition: all 0.3s;

        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.55s cubic-bezier(0.22, 1, 0.36, 1),
                    transform 0.55s cubic-bezier(0.22, 1, 0.36, 1),
                    border-color 0.3s, box-shadow 0.3s;
        will-change: opacity, transform;
    }
    .stat-item.is-visible { opacity: 1; transform: none; }
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
    .stat-item .stat-label { font-size: 0.8rem; color: #64748B; margin-top: 6px; font-weight: 500; }

    /* About content reveal */
    .about-content {
        opacity: 0;
        transform: translateX(40px);
        transition: opacity 0.75s cubic-bezier(0.22, 1, 0.36, 1) 0.1s,
                    transform 0.75s cubic-bezier(0.22, 1, 0.36, 1) 0.1s;
        will-change: opacity, transform;
    }
    .about-content.is-visible { opacity: 1; transform: none; }

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
    .about-content p { color: #475569; line-height: 1.9; font-size: 1rem; }

    /* ============================================
       VISI MISI
       ============================================ */
    .vision-section {
        padding: 80px 0;
        background: #F8FAFC;
    }

    .vision-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 30px; }

    .vision-card {
        background: #fff;
        border-radius: 20px;
        padding: 36px 32px;
        border: 1px solid #E2E8F0;
        position: relative;
        overflow: hidden;

        opacity: 0;
        transform: translateY(32px) scale(0.97);
        transition: opacity 0.65s cubic-bezier(0.22, 1, 0.36, 1),
                    transform 0.65s cubic-bezier(0.22, 1, 0.36, 1),
                    border-color 0.3s, box-shadow 0.3s;
        will-change: opacity, transform;
    }
    .vision-card.is-visible { opacity: 1; transform: none; }
    .vision-card:hover {
        border-color: #4EB8CC;
        box-shadow: 0 20px 40px rgba(14,122,150,0.08);
        transform: translateY(-4px) !important;
    }

    .vision-card .icon-circle {
        width: 56px; height: 56px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        margin-bottom: 20px;
    }
    .vision-card .icon-circle.vision { background: linear-gradient(135deg, #FEF3C7, #FDE68A); color: #D97706; }
    .vision-card .icon-circle.mission { background: linear-gradient(135deg, #DBEAFE, #BFDBFE); color: #2563EB; }

    .vision-card h3 { font-size: 1.3rem; font-weight: 700; color: #0D1B2A; margin-bottom: 12px; }
    .vision-card p { color: #64748B; line-height: 1.8; margin: 0; }

    /* ============================================
       VALUES
       ============================================ */
    .values-section {
        padding: 80px 0;
        background: #fff;
    }

    .values-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 24px; }

    .value-card {
        text-align: center;
        padding: 32px 20px;
        background: #F8FAFC;
        border-radius: 16px;
        border: 1px solid #E2E8F0;

        opacity: 0;
        transform: translateY(28px) scale(0.96);
        transition: opacity 0.6s cubic-bezier(0.22, 1, 0.36, 1),
                    transform 0.6s cubic-bezier(0.22, 1, 0.36, 1),
                    background 0.3s, border-color 0.3s, box-shadow 0.3s;
        will-change: opacity, transform;
    }
    .value-card.is-visible { opacity: 1; transform: none; }
    .value-card:hover {
        background: #fff;
        border-color: #4EB8CC;
        box-shadow: 0 12px 32px rgba(14,122,150,0.08);
        transform: translateY(-4px) !important;
    }

    .value-card .value-icon {
        width: 60px; height: 60px;
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

    .value-card h4 { font-weight: 700; color: #0D1B2A; margin-bottom: 8px; font-size: 1.05rem; }
    .value-card p  { color: #64748B; font-size: 0.9rem; line-height: 1.6; margin: 0; }

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

        opacity: 0;
        transform: translateY(40px) scale(0.98);
        transition: opacity 0.8s cubic-bezier(0.22, 1, 0.36, 1),
                    transform 0.8s cubic-bezier(0.22, 1, 0.36, 1);
        will-change: opacity, transform;
    }
    .cta-card.is-visible { opacity: 1; transform: none; }

    .cta-card::before {
        content: '';
        position: absolute;
        top: -50%; right: -20%;
        width: 400px; height: 400px;
        background: radial-gradient(circle, rgba(78,184,204,0.2) 0%, transparent 70%);
        border-radius: 50%;
    }
    .cta-card > * { position: relative; z-index: 1; }

    .cta-card h2 { color: #fff; font-weight: 800; font-size: 2rem; margin-bottom: 12px; }
    .cta-card p  { color: rgba(255,255,255,0.7); font-size: 1.05rem; margin-bottom: 28px; }

    .cta-card .btn-group { display: flex; gap: 16px; justify-content: center; flex-wrap: wrap; }

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

    /* ============================================
       SECTION HEADER – REVEAL
       ============================================ */
    .section-header { text-align: center; margin-bottom: 48px; }

    .section-header .label {
        display: inline-block;
        background: #EEF9FC;
        color: #0E7A96;
        font-weight: 700;
        font-size: 0.72rem;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        padding: 5px 14px;
        border-radius: 100px;
        margin-bottom: 10px;

        opacity: 0;
        transform: translateY(16px);
        transition: opacity 0.5s cubic-bezier(0.22, 1, 0.36, 1),
                    transform 0.5s cubic-bezier(0.22, 1, 0.36, 1);
    }
    .section-header h2 {
        font-size: 2rem;
        font-weight: 800;
        color: #0D1B2A;
        margin-bottom: 8px;

        opacity: 0;
        transform: translateY(22px);
        transition: opacity 0.6s cubic-bezier(0.22, 1, 0.36, 1) 0.08s,
                    transform 0.6s cubic-bezier(0.22, 1, 0.36, 1) 0.08s;
    }
    .section-header p {
        color: #64748B;
        max-width: 500px;
        margin: 0 auto;
        line-height: 1.6;

        opacity: 0;
        transform: translateY(14px);
        transition: opacity 0.5s cubic-bezier(0.22, 1, 0.36, 1) 0.18s,
                    transform 0.5s cubic-bezier(0.22, 1, 0.36, 1) 0.18s;
    }
    .section-header.is-visible .label,
    .section-header.is-visible h2,
    .section-header.is-visible p {
        opacity: 1;
        transform: none;
    }

    /* ============================================
       GLOBAL KEYFRAMES
       ============================================ */
    @keyframes fadeUp {
        to { opacity: 1; transform: none; }
    }
    @keyframes fadeIn {
        to { opacity: 1; }
    }

    /* ============================================
       RESPONSIVE
       ============================================ */
    @media (max-width: 992px) {
        .about-grid { grid-template-columns: 1fr; gap: 40px; }
        .values-grid { grid-template-columns: 1fr 1fr; }
        .vision-grid { grid-template-columns: 1fr; }
        .about-image-wrapper { transform: translateY(40px); }
        .about-image-wrapper.is-visible { transform: none; }
        .about-content { transform: translateY(30px); }
        .about-content.is-visible { transform: none; }
    }

    @media (max-width: 768px) {
        .profile-hero { padding: 70px 0 50px; }
        .values-grid { grid-template-columns: 1fr; }
        .cta-card { padding: 36px 24px; }
        .cta-card h2 { font-size: 1.5rem; }
        .about-stats { flex-wrap: wrap; }
    }

    /* ============================================
       REDUCED MOTION
       ============================================ */
    @media (prefers-reduced-motion: reduce) {
        .profile-hero .badge,
        .profile-hero h1,
        .profile-hero p,
        .about-image-wrapper,
        .about-content,
        .stat-item,
        .vision-card,
        .value-card,
        .cta-card,
        .section-header .label,
        .section-header h2,
        .section-header p {
            opacity: 1 !important;
            transform: none !important;
            transition: none !important;
            animation: none !important;
        }
    }
</style>
@endpush

@section('content')

{{-- SCROLL PROGRESS BAR --}}
<div class="scroll-progress-bar" id="scrollProgressBar"></div>

{{-- ============================================
     HERO SECTION
     ============================================ --}}
<section class="profile-hero" id="profileHero">
    <div class="container" id="heroContent">
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
            <div class="about-image-wrapper" id="aboutImage">
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
            <div class="about-content" id="aboutContent">
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
                <div class="about-stats" id="aboutStats">
                    <div class="stat-item">
                        <div class="stat-number" data-target="4" data-suffix="+">4+</div>
                        <div class="stat-label">Tahun Berkarya</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number" data-target="3">3</div>
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
        <div class="section-header" id="visionHeader">
            <span class="label">Arah & Tujuan</span>
            <h2>Visi & Misi</h2>
            <p>Landasan yang menjadi pedoman setiap langkah kami</p>
        </div>

        <div class="vision-grid" id="visionGrid">
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
        <div class="section-header" id="valuesHeader">
            <span class="label">Prinsip Kami</span>
            <h2>Nilai-Nilai QofMedia</h2>
            <p>Komitmen yang kami pegang dalam setiap karya</p>
        </div>

        <div class="values-grid" id="valuesGrid">
            <div class="value-card">
                <div class="value-icon"><i class="bi bi-shield-check"></i></div>
                <h4>Profesional</h4>
                <p>Kualitas dan ketepatan waktu adalah prioritas utama kami.</p>
            </div>
            <div class="value-card">
                <div class="value-icon"><i class="bi bi-heart-fill"></i></div>
                <h4>Amanah</h4>
                <p>Menjaga kepercayaan dengan integritas dan tanggung jawab.</p>
            </div>
            <div class="value-card">
                <div class="value-icon"><i class="bi bi-people-fill"></i></div>
                <h4>Kolaboratif</h4>
                <p>Bersinergi sebagai tim untuk hasil yang maksimal.</p>
            </div>
            <div class="value-card">
                <div class="value-icon"><i class="bi bi-lightbulb-fill"></i></div>
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
        <div class="cta-card" id="ctaCard">
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

@push('scripts')
<script>
(function () {
    'use strict';

    var prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    /* ── 1. SCROLL PROGRESS BAR ── */
    var progressBar = document.getElementById('scrollProgressBar');
    function updateProgress() {
        var scrollTop  = window.scrollY;
        var docHeight  = document.documentElement.scrollHeight - window.innerHeight;
        var pct        = docHeight > 0 ? (scrollTop / docHeight) * 100 : 0;
        if (progressBar) progressBar.style.width = pct.toFixed(2) + '%';
    }
    window.addEventListener('scroll', updateProgress, { passive: true });
    updateProgress();

    /* ── 2. HERO PARALLAX FADE-OUT ── */
    if (!prefersReduced) {
        var hero        = document.getElementById('profileHero');
        var heroContent = document.getElementById('heroContent');

        window.addEventListener('scroll', function () {
            if (!hero || !heroContent) return;
            var scrolled = window.scrollY;
            var heroH    = hero.offsetHeight;
            var ratio    = Math.min(scrolled / (heroH * 0.55), 1);
            var ease     = 1 - Math.pow(1 - ratio, 3);
            heroContent.style.opacity   = 1 - ease;
            heroContent.style.transform = 'translateY(' + (scrolled * 0.12) + 'px)';
        }, { passive: true });
    }

    /* ── 3. SECTION HEADERS REVEAL ── */
    var headerObserver = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                headerObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.2, rootMargin: '0px 0px -30px 0px' });

    ['visionHeader', 'valuesHeader'].forEach(function (id) {
        var el = document.getElementById(id);
        if (el) headerObserver.observe(el);
    });

    /* ── 4. ABOUT IMAGE & CONTENT REVEAL ── */
    var aboutObserver = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                aboutObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.15 });

    ['aboutImage', 'aboutContent'].forEach(function (id) {
        var el = document.getElementById(id);
        if (el) aboutObserver.observe(el);
    });

    /* ── 5. STAT ITEMS – stagger ── */
    var aboutStats = document.getElementById('aboutStats');
    if (aboutStats) {
        var statsObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (!entry.isIntersecting) return;
                var items = entry.target.querySelectorAll('.stat-item');
                items.forEach(function (item, i) {
                    if (prefersReduced) {
                        item.classList.add('is-visible');
                    } else {
                        setTimeout(function () {
                            item.classList.add('is-visible');
                        }, i * 120);
                    }
                });
                statsObserver.unobserve(entry.target);
            });
        }, { threshold: 0.2 });
        statsObserver.observe(aboutStats);
    }

    /* ── 6. STAT COUNT-UP ── */
    function animateCount(el, target, duration, suffix) {
        var start = performance.now();
        suffix = suffix || '';
        function update(now) {
            var elapsed  = now - start;
            var progress = Math.min(elapsed / duration, 1);
            var ease     = progress === 1 ? 1 : 1 - Math.pow(2, -10 * progress);
            var val      = Math.round(target * ease);
            el.textContent = val + suffix;
            if (progress < 1) requestAnimationFrame(update);
        }
        requestAnimationFrame(update);
    }

    if (aboutStats) {
        var countObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (!entry.isIntersecting) return;
                entry.target.querySelectorAll('.stat-number').forEach(function (num) {
                    var target = parseInt(num.getAttribute('data-target'), 10);
                    var suffix = num.getAttribute('data-suffix') || '';
                    if (!isNaN(target) && !prefersReduced) {
                        num.textContent = '0' + suffix;
                        animateCount(num, target, 1400, suffix);
                    }
                });
                countObserver.unobserve(entry.target);
            });
        }, { threshold: 0.5 });
        countObserver.observe(aboutStats);
    }

    /* ── 7. VISION CARDS – stagger ── */
    var visionGrid = document.getElementById('visionGrid');
    if (visionGrid) {
        var visionObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (!entry.isIntersecting) return;
                var cards = entry.target.querySelectorAll('.vision-card');
                cards.forEach(function (card, i) {
                    if (prefersReduced) {
                        card.classList.add('is-visible');
                    } else {
                        setTimeout(function () {
                            card.classList.add('is-visible');
                        }, i * 130);
                    }
                });
                visionObserver.unobserve(entry.target);
            });
        }, { threshold: 0.1 });
        visionObserver.observe(visionGrid);
    }

    /* ── 8. VALUE CARDS – stagger ── */
    var valuesGrid = document.getElementById('valuesGrid');
    if (valuesGrid) {
        var valuesObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (!entry.isIntersecting) return;
                var cards = entry.target.querySelectorAll('.value-card');
                cards.forEach(function (card, i) {
                    if (prefersReduced) {
                        card.classList.add('is-visible');
                    } else {
                        setTimeout(function () {
                            card.classList.add('is-visible');
                        }, i * 100);
                    }
                });
                valuesObserver.unobserve(entry.target);
            });
        }, { threshold: 0.1 });
        valuesObserver.observe(valuesGrid);
    }

    /* ── 9. CTA CARD REVEAL ── */
    var ctaCard = document.getElementById('ctaCard');
    if (ctaCard) {
        var ctaObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    ctaObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15 });
        ctaObserver.observe(ctaCard);
    }

})();
</script>
@endpush