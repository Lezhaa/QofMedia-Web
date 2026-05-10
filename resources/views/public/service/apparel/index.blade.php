@extends('layouts.app')

@section('title', 'Qof Apparel')

@push('styles')
<style>
    /* Fix padding body */
    body {
        padding-top: 0 !important;
    }

    /* ============================================
       HERO MODERN
       ============================================ */
    .apparel-hero {
        position: relative;
        background: linear-gradient(135deg, #0D1B2A 0%, #1B3A4B 50%, #0E7A96 100%);
        padding: 100px 0 80px;
        overflow: hidden;
        text-align: center;
    }

    .apparel-hero::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 600px;
        height: 600px;
        background: radial-gradient(circle, rgba(78,184,204,0.15) 0%, transparent 70%);
        border-radius: 50%;
    }

    .apparel-hero::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -10%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(168,221,232,0.1) 0%, transparent 70%);
        border-radius: 50%;
    }

    .apparel-hero .container {
        position: relative;
        z-index: 1;
    }

    .apparel-hero .badge {
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

    .apparel-hero h1 {
        font-size: clamp(2.2rem, 5vw, 3.2rem);
        font-weight: 800;
        color: #fff;
        margin-bottom: 16px;
        letter-spacing: -0.5px;
        line-height: 1.2;
    }

    .apparel-hero h1 span {
        background: linear-gradient(135deg, #4EB8CC, #A8DDE8);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .apparel-hero p {
        color: rgba(255,255,255,0.7);
        font-size: 1.1rem;
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.7;
    }

    /* ============================================
       CONTENT SECTION
       ============================================ */
    .apparel-section {
        padding: 80px 0;
        background: #F8FAFC;
    }

    /* ============================================
       FILTER CARD
       ============================================ */
    .filter-card {
        background: white;
        border-radius: 20px;
        padding: 24px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.04);
        border: 1px solid #E2E8F0;
        position: sticky;
        top: 90px;
    }

    .filter-title {
        font-weight: 700;
        color: #0D1B2A;
        margin-bottom: 14px;
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .filter-title i {
        color: #0E7A96;
    }

    .category-list {
        list-style: none;
        padding: 0;
        margin: 0 0 20px;
    }

    .category-list li {
        margin-bottom: 4px;
    }

    .category-list a {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 14px;
        border-radius: 12px;
        color: #475569;
        text-decoration: none;
        transition: all 0.3s;
        font-weight: 500;
        font-size: 0.9rem;
    }

    .category-list a:hover {
        background: #F8FAFC;
        color: #0E7A96;
    }

    .category-list a.active {
        background: rgba(14,122,150,0.1);
        color: #0E7A96;
        font-weight: 600;
    }

    .category-list .badge {
        background: #E2E8F0;
        color: #64748B;
        font-weight: 500;
    }

    .category-list a.active .badge {
        background: #0E7A96;
        color: white;
    }

    .sort-select {
        border-radius: 50px;
        padding: 10px 16px;
        border: 1.5px solid #E2E8F0;
        background: #F8FAFC;
        font-size: 0.85rem;
        cursor: pointer;
        width: 100%;
        color: #0D1B2A;
        transition: all 0.3s;
    }

    .sort-select:focus {
        border-color: #4EB8CC;
        box-shadow: 0 0 0 3px rgba(78,184,204,0.1);
    }

    /* ============================================
       SEARCH
       ============================================ */
    .search-box {
        position: relative;
        margin-bottom: 28px;
    }

    .search-box input {
        border-radius: 50px;
        padding: 13px 20px 13px 48px;
        border: 1.5px solid #E2E8F0;
        width: 100%;
        font-size: 0.9rem;
        background: white;
        transition: all 0.3s;
    }

    .search-box input:focus {
        border-color: #4EB8CC;
        box-shadow: 0 0 0 3px rgba(78,184,204,0.1);
        outline: none;
    }

    .search-box i {
        position: absolute;
        left: 18px;
        top: 50%;
        transform: translateY(-50%);
        color: #94A3B8;
        font-size: 1.1rem;
    }

    /* ============================================
       PRODUCT GRID
       ============================================ */
    .product-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
    }

    .product-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        transition: all 0.3s;
        border: 1px solid #E2E8F0;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .product-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 50px rgba(14,122,150,0.1);
        border-color: #4EB8CC;
    }

    .product-image {
        position: relative;
        aspect-ratio: 1 / 1;
        overflow: hidden;
    }

    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s;
    }

    .product-card:hover .product-image img {
        transform: scale(1.05);
    }

    .placeholder-img {
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #EEF2FF 0%, #E0E7FF 100%);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .placeholder-img i {
        font-size: 48px;
        color: #0E7A96;
        opacity: 0.3;
    }

    .product-badge {
        position: absolute;
        top: 12px;
        left: 12px;
        z-index: 2;
    }

    .product-category {
        position: absolute;
        top: 12px;
        right: 12px;
        z-index: 2;
    }

    .badge-tag {
        display: inline-block;
        padding: 5px 12px;
        border-radius: 50px;
        font-size: 0.72rem;
        font-weight: 600;
    }

    .badge-tag.kaos {
        background: #FEF3C7;
        color: #92400E;
    }

    .badge-tag.category {
        background: rgba(14,122,150,0.1);
        color: #0E7A96;
    }

    .product-body {
        padding: 20px;
        flex: 1;
    }

    .product-title {
        font-weight: 700;
        color: #0D1B2A;
        margin-bottom: 6px;
        font-size: 1rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .product-price {
        font-size: 1.2rem;
        font-weight: 700;
        color: #0E7A96;
        margin-bottom: 8px;
    }

    .stock-badge {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .stock-badge.available {
        background: #D1FAE5;
        color: #065F46;
    }

    .stock-badge.empty {
        background: #FEE2E2;
        color: #991B1B;
    }

    .product-footer {
        padding: 0 20px 20px;
    }

    .btn-detail {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        background: white;
        color: #0E7A96;
        border: 1.5px solid #0E7A96;
        border-radius: 50px;
        padding: 11px;
        font-weight: 600;
        font-size: 0.9rem;
        text-decoration: none;
        transition: all 0.3s;
        width: 100%;
    }

    .btn-detail:hover {
        background: #0E7A96;
        color: white;
    }

    /* Pagination */
    .pagination {
        gap: 6px;
    }

    .pagination .page-link {
        border-radius: 50px !important;
        padding: 8px 16px;
        color: #0D1B2A;
        border: 1px solid #E2E8F0;
        font-weight: 500;
        font-size: 0.85rem;
        transition: all 0.3s;
        background: white;
    }

    .pagination .page-item.active .page-link {
        background: #0E7A96;
        border-color: #0E7A96;
        color: white;
    }

    .pagination .page-link:hover {
        background: #0E7A96;
        color: white;
        border-color: #0E7A96;
    }

    /* Empty State */
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

    .btn-reset {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #0E7A96;
        color: white;
        padding: 10px 24px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.9rem;
        text-decoration: none;
        transition: all 0.3s;
    }

    .btn-reset:hover {
        background: #0A4A60;
        color: white;
    }

    /* ============================================
       RESPONSIVE
       ============================================ */
    @media (max-width: 992px) {
        .product-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .apparel-hero {
            padding: 70px 0 50px;
        }

        .apparel-section {
            padding: 50px 0;
        }

        .product-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }

        .filter-card {
            position: static;
        }
    }
</style>
@endpush

@section('content')

{{-- HERO --}}
<section class="apparel-hero">
    <div class="container">
        <span class="badge">Merchandise</span>
        <h1><span>Qof</span> Apparel</h1>
        <p>Merchandise exclusive dengan desain islami dari Pondok Pesantren Tahfidzul Qur'an Nurul Huda</p>
    </div>
</section>

{{-- PRODUCTS --}}
<section class="apparel-section">
    <div class="container">
        <div class="row">
            {{-- Sidebar --}}
            <div class="col-lg-3 mb-4">
                <div class="filter-card">
                    <h5 class="filter-title">
                        <i class="bi bi-funnel"></i> Filter Kategori
                    </h5>
                    <ul class="category-list">
                        <li>
                            <a href="{{ route('service.apparel') }}" class="{{ !request('category') ? 'active' : '' }}">
                                Semua Produk
                                <span class="badge">{{ $products->total() }}</span>
                            </a>
                        </li>
                        @foreach($categories as $category)
                            <li>
                                <a href="{{ route('service.apparel', ['category' => $category->id]) }}"
                                   class="{{ request('category') == $category->id ? 'active' : '' }}">
                                    {{ $category->name }}
                                    <span class="badge">{{ $category->products_count }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>

                    <h5 class="filter-title">
                        <i class="bi bi-arrow-down-up"></i> Urutkan
                    </h5>
                    <select class="sort-select" onchange="window.location.href=this.value">
                        <option value="{{ route('service.apparel', array_merge(request()->except('sort'), ['sort' => 'latest'])) }}"
                                {{ request('sort', 'latest') == 'latest' ? 'selected' : '' }}>
                            📅 Terbaru
                        </option>
                        <option value="{{ route('service.apparel', array_merge(request()->except('sort'), ['sort' => 'price_low'])) }}"
                                {{ request('sort') == 'price_low' ? 'selected' : '' }}>
                            ⬆️ Harga: Rendah ke Tinggi
                        </option>
                        <option value="{{ route('service.apparel', array_merge(request()->except('sort'), ['sort' => 'price_high'])) }}"
                                {{ request('sort') == 'price_high' ? 'selected' : '' }}>
                            ⬇️ Harga: Tinggi ke Rendah
                        </option>
                    </select>
                </div>
            </div>

            {{-- Products Grid --}}
            <div class="col-lg-9">
                {{-- Search --}}
                <div class="search-box">
                    <i class="bi bi-search"></i>
                    <input type="text" id="searchInput" placeholder="Cari produk..." value="{{ request('search') }}">
                </div>

                @if($products->count() > 0)
                    <div class="product-grid">
                        @foreach($products as $product)
                            <div class="product-card">
                                <div class="product-image">
                                    @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" loading="lazy">
                                    @else
                                        <div class="placeholder-img">
                                            <i class="bi bi-box"></i>
                                        </div>
                                    @endif

                                    @if($product->type == 'kaos')
                                        <div class="product-badge">
                                            <span class="badge-tag kaos">Kaos</span>
                                        </div>
                                    @endif

                                    <div class="product-category">
                                        <span class="badge-tag category">{{ $product->category->name ?? 'Produk' }}</span>
                                    </div>
                                </div>

                                <div class="product-body">
                                    <h6 class="product-title">{{ $product->name }}</h6>
                                    <div class="product-price">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </div>
                                    <span class="stock-badge {{ $product->stock > 0 ? 'available' : 'empty' }}">
                                        <i class="bi bi-{{ $product->stock > 0 ? 'check-circle' : 'x-circle' }} me-1"></i>
                                        {{ $product->stock > 0 ? 'Stok: ' . $product->stock : 'Habis' }}
                                    </span>
                                </div>

                                <div class="product-footer">
                                    <a href="{{ route('apparel.product.show', $product->id) }}" class="btn-detail">
                                        <i class="bi bi-eye"></i> Lihat Detail
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="d-flex justify-content-center mt-5">
                        {{ $products->links() }}
                    </div>
                @else
                    <div class="empty-state">
                        <i class="bi bi-box-seam"></i>
                        <h4 class="fw-bold mt-3">Tidak Ada Produk</h4>
                        <p class="text-muted mb-4">Maaf, belum ada produk yang tersedia saat ini.</p>
                        <a href="{{ route('service.apparel') }}" class="btn-reset">
                            <i class="bi bi-arrow-repeat"></i> Reset Filter
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
    let searchTimeout;
    document.getElementById('searchInput').addEventListener('input', function() {
        clearTimeout(searchTimeout);
        const searchValue = this.value;

        searchTimeout = setTimeout(() => {
            const url = new URL(window.location.href);
            if (searchValue) {
                url.searchParams.set('search', searchValue);
            } else {
                url.searchParams.delete('search');
            }
            window.location.href = url.toString();
        }, 500);
    });
</script>
@endpush