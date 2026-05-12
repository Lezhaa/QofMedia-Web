@extends('layouts.app')

@section('title', 'Beranda')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush

@section('content')

    {{-- HERO SECTION --}} 
<section class="hero-section">
    <div class="container hero-content">
        <h1 class="hero-title">
            Selamat datang <br>
            <span>di QofMedia</span>
        </h1>
        <p class="hero-subtitle">
            Tim Multimedia Pondok Pesantren Tahfidzul Qur'an Nurul Huda
        </p>
        <a href="{{ $settings['hero_cta_url'] ?? route('service.studio') }}" class="btn btn-hero">
            Jelajahi Layanan <i class="bi bi-arrow-right"></i>
        </a>
    </div>

    {{-- Scroll hint --}}
    <div class="hero-scroll-hint">
        <span>Scroll</span>
        <i class="bi bi-chevron-down"></i>
    </div>
</section>

{{-- ============================================
     ABOUT / PROFILE CUPLIKAN SECTION
     ============================================ --}}
<section class="about-cuplikan-section">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-5 scroll-reveal">
                <div class="about-image-wrapper">
                    @php
                        $aboutPhoto = 'images/logo/logo-qof.png';
                        $hasPhoto = file_exists(public_path($aboutPhoto));
                    @endphp
                    @if($hasPhoto)
                        <img src="{{ asset($aboutPhoto) }}" alt="QofMedia" class="about-cuplikan-img">
                    @else
                        <div class="about-placeholder">
                            <i class="bi bi-people-fill"></i>
                        </div>
                    @endif
                    {{-- Decorative dot --}}
                    <div class="dot-pattern-cuplikan"></div>
                </div>
            </div>
            <div class="col-lg-7 scroll-reveal">
                <span class="section-label">Tentang Kami</span>
                <h2 class="about-cuplikan-title">Mengenal <span>QofMedia</span></h2>
                <p class="about-cuplikan-text">
                    <strong>QofMedia</strong> adalah tim multimedia yang berada di bawah naungan 
                    <strong>Pondok Pesantren Tahfidzul Qur'an Nurul Huda</strong>. Kami berdedikasi 
                    menyediakan layanan multimedia profesional dengan nilai-nilai islami.
                </p>
                <p class="about-cuplikan-text">
                    Didirikan sejak 2020, QofMedia hadir sebagai solusi kebutuhan multimedia 
                    bagi masyarakat, sekaligus menjadi wadah pengembangan bakat santri di bidang 
                    fotografi, videografi, dan desain grafis.
                </p>
                <div class="about-stats-cuplikan">
                    <div class="stat-item-cuplikan">
                        <span class="stat-number">4+</span>
                        <span class="stat-label">Tahun Berkarya</span>
                    </div>
                    <div class="stat-item-cuplikan">
                        <span class="stat-number">3</span>
                        <span class="stat-label">Layanan Utama</span>
                    </div>
                </div>
                <a href="{{ route('about.profile') }}" class="btn-about-cuplikan">
                    Selengkapnya Tentang Kami <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</section>

    {{-- LAYANAN SECTION --}}
<section class="service-section">
    <div class="container">
        <div class="text-center scroll-reveal">
            <h2 class="section-title">Layanan Unggulan Kami</h2>
            <p class="section-subtitle">Solusi multimedia profesional untuk kebutuhan Anda</p>
        </div>

        <div class="row g-4">

            {{-- Qof Studio --}}
            <div class="col-md-6 col-lg-4">
                <div class="service-card scroll-reveal">
                    <div class="service-icon">
                        <i class="bi bi-camera-video-fill"></i>
                    </div>
                    <h4>Qof Studio</h4>
                    <p>Layanan persewaan alat multimedia, studio foto/video, dan jasa fotografi profesional dengan peralatan modern.</p>
                    <a href="{{ route('service.studio') }}" class="service-link">
                        Selengkapnya <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>

            {{-- Qof Apparel --}}
            <div class="col-md-6 col-lg-4">
                <div class="service-card scroll-reveal">
                    <div class="service-icon">             
                        <i class="bi bi-shop"></i>
                    </div>
                    <h4>Qof Apparel</h4>
                    <p>Merchandise exclusive dengan desain islami, tersedia kaos, mug, kalender, figura, dan berbagai produk lainnya.</p>
                    <a href="{{ route('service.apparel') }}" class="service-link">
                        Selengkapnya <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>

            {{-- Galeri --}}
            <div class="col-md-6 col-lg-4">
                <div class="service-card scroll-reveal">
                    <div class="service-icon">
                        <i class="bi bi-images"></i>
                    </div>
                    <h4>Galeri Kegiatan</h4>
                    <p>Dokumentasi berbagai kegiatan dan event di Pondok Pesantren Tahfidzul Qur'an Nurul Huda.</p>
                    <a href="{{ route('gallery.index') }}" class="service-link">
                        Selengkapnya <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ============================================
     GALERI TERBARU SECTION
     ============================================ --}}
@if($latestAlbums->count() > 0)
<section class="gallery-section">
    <div class="container">
        <div class="text-center scroll-reveal">
            <h2 class="section-title">Galeri Terbaru</h2>
            <p class="section-subtitle">Momen berharga dari kegiatan kami</p>
        </div>

        <div class="row g-4">
            @foreach($latestAlbums->take(4) as $album)
                <div class="col-md-6 col-lg-3">
                    <a href="{{ route('gallery.album', ['year' => $album->year, 'slug' => $album->slug]) }}" class="text-decoration-none">
                        <div class="card gallery-card border-0 h-100 scroll-reveal">
                            @if($album->cover_image)
                                <img src="{{ asset('storage/' . $album->cover_image) }}"
                                     class="card-img-top"
                                     alt="{{ $album->name }}">
                            @else
                                <div class="gallery-placeholder">
                                    <i class="bi bi-images"></i>
                                </div>
                            @endif
                            <div class="card-body">
                                <h6 class="card-title">{{ $album->name }}</h6>
                                <p class="card-text">
                                    <i class="bi bi-calendar3 me-1"></i>{{ $album->year }}
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-5">
            <a href="{{ route('gallery.index') }}" class="btn btn-gallery">
                Lihat Semua Galeri <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>
@endif

{{-- ============================================
     BERITA & PENGUMUMAN SECTION
     ============================================ --}}
@if(isset($latestNews) && $latestNews->count() > 0)
<section class="news-section">
    <div class="container">
        <div class="text-center scroll-reveal">
            <h2 class="section-title">Berita & Pengumuman</h2>
            <p class="section-subtitle">Informasi terbaru dari QofMedia</p>
        </div>

        <div class="row g-4">
            @foreach($latestNews as $index => $news)
                <div class="col-md-6 col-lg-4">
                    <div class="news-card {{ $index === 0 ? 'highlight' : '' }} scroll-reveal">

                        @if($index === 0)
                            <span class="news-badge">
                                <i class="bi bi-pin-angle-fill me-1"></i>Terbaru
                            </span>
                        @endif

                        <a href="{{ route('information.show', $news->slug) }}" class="text-decoration-none">
                            <div class="news-card-img">
                                @if($news->image)
                                    <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}">
                                @else
                                    <div class="news-placeholder">
                                        <i class="bi bi-newspaper"></i>
                                    </div>
                                @endif
                            </div>
                        </a>

                        <div class="card-body">
                            <span class="news-category">
                                <i class="bi bi-tag me-1"></i>{{ $news->category }}
                            </span>

                            <a href="{{ route('information.show', $news->slug) }}" class="text-decoration-none">
                                <h5 class="news-title">{{ $news->title }}</h5>
                            </a>

                            <p class="news-excerpt">
                                {{ $news->excerpt ?: Str::limit(strip_tags($news->content), 120) }}
                            </p>

                            <div class="news-meta">
                                <span>
                                    <i class="bi bi-calendar3"></i>
                                    {{ $news->published_at->format('d M Y') }}
                                </span>
                                <span>
                                    <i class="bi bi-clock"></i>
                                    {{ $news->published_at->diffForHumans() }}
                                </span>
                            </div>

                            <div class="mt-3">
                                <a href="{{ route('information.show', $news->slug) }}" class="news-link">
                                    Baca Selengkapnya <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center mt-5">
            <a href="{{ route('information.index') }}" class="btn btn-gallery">
                Lihat Semua Berita <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>
@endif

{{-- ============================================
     CTA SECTION
     ============================================ --}}
<section class="cta-section scroll-reveal">
    <div class="container text-center">
        <h2>Siap Bekerja Sama dengan Kami?</h2>
        <p>Hubungi kami untuk informasi lebih lanjut tentang layanan multimedia kami.</p>
        <a href="{{ route('contact') }}" class="btn btn-cta">
            Hubungi Kami <i class="bi bi-arrow-right"></i>
        </a>
    </div>
</section>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const revealItems = document.querySelectorAll('.scroll-reveal');
        if (!revealItems.length) {
            return;
        }

        if (!('IntersectionObserver' in window)) {
            revealItems.forEach(el => el.classList.add('reveal-visible'));
            return;
        }

        const observer = new IntersectionObserver((entries, io) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('reveal-visible');
                    io.unobserve(entry.target);
                }
            });
        }, { threshold: 0.18 });

        revealItems.forEach(el => observer.observe(el));
    });
</script>
@endpush

@endsection