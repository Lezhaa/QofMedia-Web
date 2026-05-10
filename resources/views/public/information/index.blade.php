@extends('layouts.app')

@section('title', 'Informasi - QofMedia')

@push('styles')
<style>
    /* Fix padding body dari layout utama */
    body {
        padding-top: 0 !important;
    }

    /* ============================================
       HERO MODERN - MENGIKUTI STYLE PROFIL
       ============================================ */
    .info-hero {
        position: relative;
        background: linear-gradient(135deg, #0D1B2A 0%, #1B3A4B 50%, #0E7A96 100%);
        padding: 100px 0 80px;
        overflow: hidden;
        text-align: center;
    }

    .info-hero::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 600px;
        height: 600px;
        background: radial-gradient(circle, rgba(78,184,204,0.15) 0%, transparent 70%);
        border-radius: 50%;
    }

    .info-hero::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -10%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(168,221,232,0.1) 0%, transparent 70%);
        border-radius: 50%;
    }

    .info-hero .container {
        position: relative;
        z-index: 1;
    }

    .info-hero .badge {
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

    .info-hero h1 {
        font-size: clamp(2.2rem, 5vw, 3.2rem);
        font-weight: 800;
        color: #fff;
        margin-bottom: 16px;
        letter-spacing: -0.5px;
        line-height: 1.2;
    }

    .info-hero h1 span {
        background: linear-gradient(135deg, #4EB8CC, #A8DDE8);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .info-hero p {
        color: rgba(255,255,255,0.7);
        font-size: 1.1rem;
        max-width: 550px;
        margin: 0 auto;
        line-height: 1.7;
    }

    /* ============================================
       CONTENT SECTION
       ============================================ */
    .info-content {
        padding: 80px 0;
        background: #F8FAFC;
    }

    /* Filter Section */
    .filter-card {
        background: white;
        border-radius: 20px;
        padding: 28px 32px;
        border: 1px solid #E2E8F0;
        margin-bottom: 40px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.04);
    }

    .filter-card .form-label {
        font-weight: 600;
        font-size: 0.8rem;
        color: #64748B;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 8px;
    }

    .filter-card .form-select {
        border-radius: 50px;
        padding: 10px 20px;
        border: 1px solid #E2E8F0;
        background: #F8FAFC;
        font-size: 0.9rem;
        color: #0D1B2A;
        transition: all 0.3s;
    }

    .filter-card .form-select:focus {
        border-color: #4EB8CC;
        box-shadow: 0 0 0 3px rgba(78,184,204,0.1);
    }

    .btn-filter {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #0E7A96;
        color: white;
        border: none;
        padding: 10px 24px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s;
    }

    .btn-filter:hover {
        background: #0A4A60;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(14,122,150,0.2);
        color: white;
    }

    .btn-reset {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: white;
        color: #64748B;
        border: 1px solid #E2E8F0;
        padding: 10px 24px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.9rem;
        text-decoration: none;
        transition: all 0.3s;
    }

    .btn-reset:hover {
        border-color: #CBD5E0;
        color: #0D1B2A;
        background: #F8FAFC;
    }

    /* ============================================
       NEWS CARD
       ============================================ */
    .news-card-img {
        aspect-ratio: 4 / 3;
        overflow: hidden;
    }

    .news-card-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s;
    }

    .news-card:hover .news-card-img img {
        transform: scale(1.05);
    }

    .news-placeholder {
        aspect-ratio: 4 / 3;
        background: linear-gradient(135deg, #EEF2FF 0%, #E0E7FF 100%);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .news-placeholder i {
        font-size: 40px;
        color: #0E7A96;
        opacity: 0.4;
    }

    .news-card {
        border-radius: 16px;
        overflow: hidden;
        transition: all 0.3s;
        border: 1px solid #E2E8F0;
        background: white;
    }

    .news-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 16px 40px rgba(14,122,150,0.1);
        border-color: #4EB8CC;
    }

    .news-category {
        display: inline-block;
        padding: 5px 14px;
        background: rgba(14,122,150,0.08);
        color: #0E7A96;
        border-radius: 50px;
        font-size: 0.78rem;
        font-weight: 600;
        margin-bottom: 10px;
        letter-spacing: 0.02em;
    }

    .news-title {
        font-weight: 700;
        color: #0D1B2A;
        margin-bottom: 8px;
        font-size: 1.05rem;
        line-height: 1.5;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        transition: color 0.3s;
    }

    .news-title:hover {
        color: #0E7A96;
    }

    .news-excerpt {
        color: #64748B;
        font-size: 0.9rem;
        line-height: 1.7;
        margin-bottom: 12px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .news-meta {
        display: flex;
        gap: 15px;
        font-size: 0.8rem;
        color: #94A3B8;
    }

    .news-meta span {
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .news-link {
        color: #0E7A96;
        font-weight: 600;
        text-decoration: none;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        transition: gap 0.2s;
    }

    .news-link:hover {
        gap: 8px;
        color: #0A4A60;
    }

    .news-badge {
        position: absolute;
        top: 12px;
        left: 12px;
        background: #4EB8CC;
        color: #0D1B2A;
        padding: 5px 14px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 700;
        z-index: 2;
    }

    /* ============================================
       PAGINATION
       ============================================ */
    .pagination {
        gap: 8px;
    }

    .pagination .page-item .page-link {
        border-radius: 50px !important;
        padding: 10px 18px;
        color: #0D1B2A;
        border: 1px solid #E2E8F0;
        font-weight: 500;
        font-size: 0.9rem;
        transition: all 0.3s;
        background: white;
    }

    .pagination .page-item:hover .page-link {
        background: #0E7A96;
        color: white;
        border-color: #0E7A96;
        transform: translateY(-2px);
    }

    .pagination .page-item.active .page-link {
        background: #0E7A96;
        border-color: #0E7A96;
        color: white;
        box-shadow: 0 4px 12px rgba(14,122,150,0.3);
    }

    .pagination .page-item.disabled .page-link {
        background: #F8FAFC;
        color: #CBD5E1;
    }

    /* ============================================
       EMPTY STATE
       ============================================ */
    .empty-state {
        text-align: center;
        padding: 60px 0;
    }

    .empty-state i {
        font-size: 64px;
        color: #0E7A96;
        opacity: 0.3;
        margin-bottom: 16px;
    }

    .empty-state h4 {
        font-weight: 700;
        color: #0D1B2A;
        margin-bottom: 8px;
    }

    .empty-state p {
        color: #64748B;
    }

    /* ============================================
       RESPONSIVE
       ============================================ */
    @media (max-width: 768px) {
        .info-hero {
            padding: 70px 0 50px;
        }

        .info-content {
            padding: 50px 0;
        }

        .filter-card {
            padding: 20px 24px;
            border-radius: 16px;
        }

        .news-card .card-body {
            padding: 1rem;
        }

        .news-title {
            font-size: 0.95rem;
        }

        .news-excerpt {
            font-size: 0.85rem;
        }
    }
</style>
@endpush

@section('content')

{{-- ============================================
     HERO SECTION
     ============================================ --}}
<section class="info-hero">
    <div class="container">
        <span class="badge">Informasi</span>
        <h1>Berita & <span>Artikel</span></h1>
        <p>Berita, pengumuman, dan informasi terbaru seputar kegiatan QofMedia</p>
    </div>
</section>

{{-- ============================================
     CONTENT SECTION
     ============================================ --}}
<section class="info-content">
    <div class="container">
        <!-- Filter -->
        <div class="filter-card">
            <form method="GET" action="{{ route('information.index') }}">
                <div class="row g-3 align-items-end">
                    <div class="col-md-4 col-lg-3">
                        <label class="form-label">Kategori</label>
                        <select name="category" class="form-select">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                                    {{ $category }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 col-lg-3">
                        <label class="form-label">Tahun</label>
                        <select name="year" class="form-select">
                            <option value="">Semua Tahun</option>
                            @foreach($years as $year)
                                <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>
                                    {{ $year }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 col-lg-6">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn-filter">
                                <i class="bi bi-funnel"></i> Filter
                            </button>
                            <a href="{{ route('information.index') }}" class="btn-reset">
                                <i class="bi bi-arrow-repeat"></i> Reset
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Articles Grid -->
        <div class="row g-4">
            @forelse($articles as $article)
                <div class="col-md-6 col-lg-4">
                    <div class="news-card h-100">
                        <div class="position-relative">
                            <a href="{{ route('information.show', $article->slug) }}">
                                <div class="news-card-img">
                                    @if($article->image)
                                        <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" loading="lazy">
                                    @else
                                        <div class="news-placeholder">
                                            <i class="bi bi-newspaper"></i>
                                        </div>
                                    @endif
                                </div>
                            </a>
                        </div>
                        <div class="card-body p-3">
                            <div class="news-category">
                                <i class="bi bi-tag me-1"></i> {{ $article->category }}
                            </div>
                            <a href="{{ route('information.show', $article->slug) }}" class="text-decoration-none">
                                <h5 class="news-title">{{ $article->title }}</h5>
                            </a>
                            <p class="news-excerpt">
                                {{ $article->excerpt ?: Str::limit(strip_tags($article->content), 100) }}
                            </p>
                            <div class="news-meta mb-3">
                                <span>
                                    <i class="bi bi-calendar3"></i>
                                    {{ $article->published_at->format('d M Y') }}
                                </span>
                            </div>
                            <a href="{{ route('information.show', $article->slug) }}" class="news-link">
                                Baca Selengkapnya <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="empty-state">
                        <i class="bi bi-newspaper"></i>
                        <h4>Belum Ada Artikel</h4>
                        <p>Artikel dan informasi terbaru akan segera ditambahkan.</p>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($articles->hasPages())
            <div class="d-flex justify-content-center mt-5">
                {{ $articles->links() }}
            </div>
        @endif
    </div>
</section>

@endsection