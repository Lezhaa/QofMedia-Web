@extends('layouts.app')

@section('title', $album->name)

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />
<style>
    /* Fix padding body */
    body {
        padding-top: 0 !important;
    }

    /* ============================================
       HERO MODERN
       ============================================ */
    .album-hero {
        position: relative;
        background: linear-gradient(135deg, #0D1B2A 0%, #1B3A4B 50%, #0E7A96 100%);
        padding: 100px 0 80px;
        overflow: hidden;
        text-align: center;
    }

    .album-hero::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 600px;
        height: 600px;
        background: radial-gradient(circle, rgba(78,184,204,0.15) 0%, transparent 70%);
        border-radius: 50%;
    }

    .album-hero::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -10%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(168,221,232,0.1) 0%, transparent 70%);
        border-radius: 50%;
    }

    .album-hero .container {
        position: relative;
        z-index: 1;
    }

    .breadcrumb {
        margin-bottom: 16px;
    }

    .breadcrumb-item a {
        color: rgba(255,255,255,0.6);
        text-decoration: none;
        font-size: 0.85rem;
        transition: color 0.3s;
    }

    .breadcrumb-item a:hover {
        color: #4EB8CC;
    }

    .breadcrumb-item.active {
        color: rgba(255,255,255,0.9);
        font-size: 0.85rem;
    }

    .breadcrumb-item + .breadcrumb-item::before {
        color: rgba(255,255,255,0.4);
    }

    .album-hero .badge {
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

    .album-hero h1 {
        font-size: clamp(2rem, 5vw, 2.6rem);
        font-weight: 800;
        color: #fff;
        margin-bottom: 16px;
        letter-spacing: -0.5px;
        line-height: 1.2;
    }

    .album-hero h1 span {
        background: linear-gradient(135deg, #4EB8CC, #A8DDE8);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .album-hero p {
        color: rgba(255,255,255,0.7);
        font-size: 1.1rem;
        max-width: 550px;
        margin: 0 auto;
        line-height: 1.7;
    }

    /* ============================================
       MASONRY GRID
       ============================================ */
    .masonry-section {
        padding: 80px 0;
        background: #fff;
    }

    .masonry-grid {
        column-count: 4;
        column-gap: 20px;
    }

    .masonry-item {
        break-inside: avoid;
        margin-bottom: 20px;
        display: inline-block;
        width: 100%;
    }

    .masonry-item img {
        width: 100%;
        height: auto;
        border-radius: 16px;
        transition: all 0.3s;
        cursor: pointer;
        display: block;
    }

    .masonry-item img:hover {
        transform: scale(1.02);
        box-shadow: 0 16px 40px rgba(0,0,0,0.12);
    }

    .masonry-item video {
        width: 100%;
        border-radius: 16px;
        display: block;
    }

    .masonry-caption {
        padding: 8px 5px;
        font-size: 0.85rem;
        color: #64748B;
        line-height: 1.5;
    }

    /* Lightbox */
    .glightbox-clean .gslide-image img {
        max-width: 80vw !important;
        max-height: 80vh !important;
        width: auto !important;
        height: auto !important;
        border-radius: 10px;
    }

    .glightbox-clean .goverlay {
        background: rgba(9, 24, 40, 0.95) !important;
    }

    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: white;
        color: #0E7A96;
        border: 1.5px solid #0E7A96;
        padding: 10px 24px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.9rem;
        text-decoration: none;
        transition: all 0.3s;
    }

    .btn-back:hover {
        background: #0E7A96;
        color: white;
    }

    /* ============================================
       RESPONSIVE
       ============================================ */
    @media (max-width: 992px) {
        .masonry-grid {
            column-count: 3;
        }
    }

    @media (max-width: 768px) {
        .album-hero {
            padding: 70px 0 50px;
        }
        .masonry-grid {
            column-count: 2;
            column-gap: 14px;
        }
        .masonry-item {
            margin-bottom: 14px;
        }
    }

    @media (max-width: 480px) {
        .masonry-grid {
            column-count: 1;
        }
    }
</style>
@endpush

@section('content')

{{-- HERO --}}
<section class="album-hero">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="{{ route('gallery.index') }}">Galeri</a></li>
                <li class="breadcrumb-item"><a href="{{ route('gallery.year', $album->year) }}">{{ $album->year }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $album->name }}</li>
            </ol>
        </nav>
        <span class="badge">{{ $album->year }}</span>
        <h1>{{ $album->name }}</h1>
        <p>{{ $album->description }}</p>
    </div>
</section>

{{-- MASONRY GRID --}}
<section class="masonry-section">
    <div class="container">
        @if($album->items->count() > 0)
            <div class="masonry-grid">
                @foreach($album->items as $item)
                    <div class="masonry-item">
                        @if($item->type == 'foto')
                            <a href="{{ asset('storage/' . $item->file_path) }}"
                               class="glightbox"
                               data-gallery="album-{{ $album->id }}"
                               data-description="{{ $item->caption }}">
                                <img src="{{ asset('storage/' . $item->file_path) }}"
                                     alt="{{ $item->caption }}"
                                     loading="lazy">
                            </a>
                            @if($item->caption)
                                <div class="masonry-caption">{{ $item->caption }}</div>
                            @endif
                        @else
                            <video controls preload="metadata" style="width: 100%; border-radius: 16px;">
                                <source src="{{ asset('storage/' . $item->file_path) }}" type="video/mp4">
                            </video>
                            @if($item->caption)
                                <div class="masonry-caption">
                                    <i class="bi bi-camera-video me-1"></i> {{ $item->caption }}
                                </div>
                            @endif
                        @endif
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-5">
                <a href="{{ route('gallery.year', $album->year) }}" class="btn-back">
                    <i class="bi bi-arrow-left"></i> Kembali ke Album {{ $album->year }}
                </a>
            </div>
        @else
            <div class="text-center py-5">
                <i class="bi bi-camera" style="font-size: 64px; color: #0E7A96; opacity: 0.3;"></i>
                <h4 class="mt-3 fw-bold">Belum Ada Foto/Video</h4>
                <p class="text-muted">Belum ada item dalam album ini.</p>
                <a href="{{ route('gallery.year', $album->year) }}" class="btn-back mt-3">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        @endif
    </div>
</section>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
<script>
    const lightbox = GLightbox({
        selector: '.glightbox',
        touchNavigation: true,
        loop: true,
        autoplayVideos: false,
        zoomable: true,
        draggable: true
    });
</script>
@endpush