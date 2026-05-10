@extends('layouts.app')

@section('title', 'Struktur Organisasi')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
    /* Fix padding body dari layout utama */
    body {
        padding-top: 0 !important;
    }

    /* ============================================
       HERO MODERN - MENGIKUTI STYLE PROFIL
       ============================================ */
    .struktur-hero {
        position: relative;
        background: linear-gradient(135deg, #0D1B2A 0%, #1B3A4B 50%, #0E7A96 100%);
        padding: 100px 0 80px;
        overflow: hidden;
        text-align: center;
    }

    .struktur-hero::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 600px;
        height: 600px;
        background: radial-gradient(circle, rgba(78,184,204,0.15) 0%, transparent 70%);
        border-radius: 50%;
    }

    .struktur-hero::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -10%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(168,221,232,0.1) 0%, transparent 70%);
        border-radius: 50%;
    }

    .struktur-hero .container {
        position: relative;
        z-index: 1;
    }

    .struktur-hero .badge {
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

    .struktur-hero h1 {
        font-size: clamp(2.2rem, 5vw, 3.2rem);
        font-weight: 800;
        color: #fff;
        margin-bottom: 16px;
        letter-spacing: -0.5px;
        line-height: 1.2;
    }

    .struktur-hero h1 span {
        background: linear-gradient(135deg, #4EB8CC, #A8DDE8);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .struktur-hero p {
        color: rgba(255,255,255,0.7);
        font-size: 1.1rem;
        max-width: 550px;
        margin: 0 auto;
        line-height: 1.7;
    }

    /* ============================================
       DIVISION CAROUSEL SECTION
       ============================================ */
    .division-carousel-section {
        padding: 80px 0;
        background: white;
    }

    .division-carousel-section.bg-light {
        background: #F8FAFC;
    }

    /* Section Header */
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

    /* Division Badge */
    .division-badge {
        display: inline-block;
        padding: 8px 20px;
        background: rgba(14, 122, 150, 0.1);
        color: #0E7A96;
        border: 1px solid rgba(14, 122, 150, 0.2);
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.85rem;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        margin-bottom: 12px;
    }

    /* ============================================
       SWIPER / MEMBER CARD
       ============================================ */
    .member-swiper {
        padding: 30px 50px 45px;
    }

    .swiper-slide {
        text-align: center;
        transition: all 0.4s ease;
        padding: 8px 5px;
        transform: scale(0.85);
        opacity: 0.5;
    }

    .swiper-slide-active {
        transform: scale(1);
        opacity: 1;
    }

    .swiper-slide-prev,
    .swiper-slide-next {
        transform: scale(0.9);
        opacity: 0.75;
    }

    .member-photo {
        width: 180px;
        aspect-ratio: 3 / 4;
        margin: 0 auto 12px;
        border-radius: 20px;
        overflow: hidden;
        border: 3px solid transparent;
        box-shadow: 0 8px 24px rgba(0,0,0,0.06);
        transition: all 0.4s ease;
    }

    .swiper-slide-active .member-photo {
        border-color: #4EB8CC;
        box-shadow: 0 16px 40px rgba(14, 122, 150, 0.15);
    }

    .member-photo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center 20%;
    }

    .member-photo-placeholder {
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #0E7A96 0%, #4EB8CC 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 64px;
        font-weight: 700;
    }

    /* Member Info */
    .member-info {
        margin-top: 12px;
    }

    .member-name {
        font-weight: 700;
        color: #0D1B2A;
        margin-bottom: 2px;
        font-size: 0.95rem;
        transition: all 0.3s;
    }

    .swiper-slide-active .member-name {
        font-size: 1.1rem;
        margin-bottom: 6px;
    }

    .member-nickname {
        color: #0E7A96;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        opacity: 0;
        transition: all 0.3s;
        margin-bottom: 8px;
    }

    .swiper-slide-active .member-nickname {
        opacity: 1;
    }

    /* Social Media */
    .member-social {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 5px;
        opacity: 0;
        transition: all 0.3s ease;
        transform: translateY(10px);
    }

    .swiper-slide-active .member-social {
        opacity: 1;
        transform: translateY(0);
    }

    .social-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 6px 14px;
        background: #F1F5F9;
        border: 1px solid #E2E8F0;
        border-radius: 50px;
        text-decoration: none;
        font-size: 0.78rem;
        font-weight: 500;
        transition: all 0.3s ease;
        color: #475569;
    }

    .social-link i {
        font-size: 0.9rem;
    }

    .social-link:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    /* Warna khusus per platform saat hover */
    .social-link.instagram:hover {
        background: linear-gradient(45deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888);
        color: white;
        border-color: transparent;
    }

    .social-link.twitter:hover,
    .social-link.x:hover {
        background: #000000;
        color: white;
        border-color: transparent;
    }

    .social-link.linkedin:hover {
        background: #0077b5;
        color: white;
        border-color: transparent;
    }

    .social-link.github:hover {
        background: #333333;
        color: white;
        border-color: transparent;
    }

    .social-link.tiktok:hover {
        background: #000000;
        color: #00f2ea;
        border-color: transparent;
    }

    .social-link.facebook:hover {
        background: #1877f2;
        color: white;
        border-color: transparent;
    }

    .social-link.youtube:hover {
        background: #ff0000;
        color: white;
        border-color: transparent;
    }

    .social-link.whatsapp:hover {
        background: #25d366;
        color: white;
        border-color: transparent;
    }

    .social-link.telegram:hover {
        background: #26a5e4;
        color: white;
        border-color: transparent;
    }

    /* ============================================
       SWIPER NAVIGATION
       ============================================ */
    .swiper-button-next,
    .swiper-button-prev {
        width: 44px;
        height: 44px;
        background: white;
        border-radius: 50%;
        box-shadow: 0 4px 16px rgba(0,0,0,0.08);
        color: #0E7A96;
        border: 1px solid #E2E8F0;
        transition: all 0.3s;
    }

    .swiper-button-next:hover,
    .swiper-button-prev:hover {
        background: #0E7A96;
        color: white;
        border-color: #0E7A96;
    }

    .swiper-button-next::after,
    .swiper-button-prev::after {
        font-size: 14px;
        font-weight: 700;
    }

    .swiper-pagination-bullet {
        background: #CBD5E1;
        opacity: 1;
    }

    .swiper-pagination-bullet-active {
        background: #0E7A96;
        width: 28px;
        border-radius: 10px;
    }

    /* ============================================
       CTA SECTION
       ============================================ */
    .cta-join {
        padding: 80px 0;
        background: #fff;
    }

    .cta-join-card {
        background: linear-gradient(135deg, #0D1B2A 0%, #1B3A4B 50%, #0E7A96 100%);
        border-radius: 24px;
        padding: 56px 48px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .cta-join-card::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(78,184,204,0.2) 0%, transparent 70%);
        border-radius: 50%;
    }

    .cta-join-card > * {
        position: relative;
        z-index: 1;
    }

    .cta-join-card h2 {
        color: #fff;
        font-weight: 800;
        font-size: 2rem;
        margin-bottom: 12px;
    }

    .cta-join-card p {
        color: rgba(255,255,255,0.7);
        font-size: 1.05rem;
        margin-bottom: 28px;
    }

    .btn-cta-primary {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #4EB8CC;
        color: #0D1B2A;
        border: none;
        padding: 14px 32px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.95rem;
        text-decoration: none;
        transition: all 0.3s;
    }

    .btn-cta-primary:hover {
        background: #A8DDE8;
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(78,184,204,0.3);
        color: #0D1B2A;
    }

    /* ============================================
       RESPONSIVE
       ============================================ */
    @media (max-width: 992px) {
        .member-photo {
            width: 160px;
        }
        .social-link {
            padding: 5px 12px;
            font-size: 0.72rem;
        }
    }

    @media (max-width: 768px) {
        .struktur-hero {
            padding: 70px 0 50px;
        }
        .member-photo {
            width: 150px;
        }
        .member-swiper {
            padding: 20px 40px 30px;
        }
        .cta-join-card {
            padding: 36px 24px;
        }
        .cta-join-card h2 {
            font-size: 1.5rem;
        }
    }

    @media (max-width: 480px) {
        .member-photo {
            width: 130px;
        }
        .member-swiper {
            padding: 15px 35px 20px;
        }
        .social-link span {
            display: none;
        }
        .social-link {
            padding: 5px 10px;
        }
        .social-link i {
            font-size: 1rem;
            margin: 0;
        }
    }
</style>
@endpush

@section('content')

{{-- ============================================
     HERO SECTION
     ============================================ --}}
<section class="struktur-hero">
    <div class="container">
        <span class="badge">Tim Kami</span>
        <h1>Di Balik Layar <span>QofMedia</span></h1>
        <p>Kenali tim kreatif yang siap mewujudkan ide-ide brilian Anda menjadi karya nyata</p>
    </div>
</section>

{{-- ============================================
     DIVISION SECTIONS
     ============================================ --}}
@php
    $divisions = \App\Models\Division::with(['activeMembers' => function($q) {
        $q->orderBy('division_member.order');
    }])->where('is_active', true)->orderBy('order')->get();
@endphp

@foreach($divisions as $division)
<section class="division-carousel-section {{ $loop->even ? 'bg-light' : '' }}">
    <div class="container">
        <div class="section-header">
            <span class="label">Divisi</span>
            <h2>{{ $division->name }}</h2>
            <p>{{ $division->description }}</p>
        </div>
    </div>

    @if($division->activeMembers->count() > 0)
    <div class="container">
        <div class="swiper member-swiper" id="divisionSwiper{{ $division->id }}">
            <div class="swiper-wrapper">
                @foreach($division->activeMembers as $member)
                    <div class="swiper-slide">
                        <div class="member-photo">
                            @if($member->photo_url)
                                <img src="{{ $member->photo_url }}" alt="{{ $member->name }}" loading="lazy">
                            @else
                                <div class="member-photo-placeholder">
                                    {{ strtoupper(substr($member->nickname, 0, 1)) }}
                                </div>
                            @endif
                        </div>

                        <div class="member-info">
                            <div class="member-name">{{ $member->name }}</div>
                            <div class="member-nickname">{{ $member->nickname }}</div>

                            @if($member->social_platform && $member->social_username)
                            <div class="member-social">
                                <a href="{{ $member->social_url ?? '#' }}"
                                   target="_blank"
                                   rel="noopener noreferrer"
                                   class="social-link {{ $member->social_platform }}"
                                   title="{{ ucfirst($member->social_platform) }}: {{ $member->social_username }}">
                                    <i class="bi {{ $member->social_icon ?? 'bi-share' }}"></i>
                                    <span>{{ $member->social_platform_name ?? ucfirst($member->social_platform) }}</span>
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
    @else
    <div class="container text-center py-4">
        <p class="text-muted">Belum ada anggota di divisi ini.</p>
    </div>
    @endif

</section>
@endforeach

{{-- ============================================
     CTA SECTION
     ============================================ --}}
<section class="cta-join">
    <div class="container">
        <div class="cta-join-card">
            <h2>Ingin Bergabung dengan Tim Kami?</h2>
            <p>QofMedia selalu membuka kesempatan bagi yang ingin mengembangkan bakat di bidang multimedia. Mari berkarya bersama!</p>
            <a href="{{ route('contact') }}" class="btn-cta-primary">
                <i class="bi bi-envelope"></i> Hubungi Kami
            </a>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.member-swiper').forEach(el => {
            new Swiper('#' + el.id, {
                slidesPerView: 1,
                centeredSlides: true,
                loop: true,
                spaceBetween: 30,
                breakpoints: {
                    480: { slidesPerView: 2, spaceBetween: 20 },
                    768: { slidesPerView: 3, spaceBetween: 25 },
                    992: { slidesPerView: 4, spaceBetween: 30 },
                    1200: { slidesPerView: 5, spaceBetween: 35 }
                },
                navigation: {
                    nextEl: '#' + el.id + ' .swiper-button-next',
                    prevEl: '#' + el.id + ' .swiper-button-prev',
                },
                pagination: {
                    el: '#' + el.id + ' .swiper-pagination',
                    clickable: true,
                },
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                },
            });
        });
    });
</script>
@endpush

