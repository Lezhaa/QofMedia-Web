@extends('adminlte::page')

@section('title', 'Kelola Varian Kaos')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="mb-0" style="font-size: 1.4rem; font-weight: 700; color: #0D1B2A;">
                <i class="fas fa-swatchbook me-2" style="color: #0E7A96;"></i> Varian Kaos
            </h1>
            <ol class="breadcrumb mb-0 mt-1" style="font-size: 0.8rem; background: transparent; padding: 0;">
                <li class="breadcrumb-item"><a href="{{ route('apparel.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Varian</li>
            </ol>
        </div>
        <button data-toggle="modal" data-target="#addModal"
            style="display:inline-flex; align-items:center; gap:8px; background: linear-gradient(135deg, #0E7A96, #4EB8CC); color:#fff; padding:10px 22px; border-radius:50px; font-weight:700; font-size:0.85rem; border:none; cursor:pointer; transition:all 0.3s; box-shadow: 0 4px 14px rgba(14,122,150,0.25);">
            <i class="fas fa-plus"></i> Tambah Varian
        </button>
    </div>
@stop

@push('css')
<style>
    /* ============================================
       SECTION LABEL
       ============================================ */
    .sec-label {
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: #94A3B8;
        margin-bottom: 14px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .sec-label::after {
        content: '';
        flex: 1;
        height: 1px;
        background: #E2E8F0;
    }

    /* ============================================
       STAT CARDS
       ============================================ */
    .stat-card {
        background: #fff;
        border: 1px solid #E2E8F0;
        border-radius: 18px;
        padding: 20px 22px 16px;
        display: flex;
        align-items: flex-start;
        gap: 16px;
        transition: all 0.28s cubic-bezier(0.22, 1, 0.36, 1);
        position: relative;
        overflow: hidden;
    }
    .stat-card::after {
        content: '';
        position: absolute;
        bottom: 0; left: 0; right: 0;
        height: 3px;
        border-radius: 0 0 18px 18px;
        opacity: 0;
        transition: opacity 0.3s;
    }
    .stat-card:hover { transform: translateY(-3px); border-color: transparent; }
    .stat-card:hover::after { opacity: 1; }

    .stat-card.blue  { --c:#0E7A96; --bg:#EEF9FC; }
    .stat-card.green { --c:#059669; --bg:#D1FAE5; }
    .stat-card.amber { --c:#D97706; --bg:#FEF3C7; }
    .stat-card.red   { --c:#DC2626; --bg:#FEE2E2; }
    .stat-card.slate { --c:#475569; --bg:#F1F5F9; }

    .stat-card.blue::after  { background: #0E7A96; }
    .stat-card.green::after { background: #059669; }
    .stat-card.amber::after { background: #D97706; }
    .stat-card.red::after   { background: #DC2626; }
    .stat-card.slate::after { background: #475569; }

    .stat-card:hover.blue  { box-shadow: 0 10px 28px rgba(14,122,150,0.13); border-color: #4EB8CC; }
    .stat-card:hover.green { box-shadow: 0 10px 28px rgba(5,150,105,0.13);  border-color: #34D399; }
    .stat-card:hover.amber { box-shadow: 0 10px 28px rgba(217,119,6,0.13);  border-color: #FBBF24; }
    .stat-card:hover.red   { box-shadow: 0 10px 28px rgba(220,38,38,0.13);  border-color: #F87171; }
    .stat-card:hover.slate { box-shadow: 0 10px 28px rgba(71,85,105,0.13);  border-color: #94A3B8; }

    .stat-icon {
        width: 48px; height: 48px;
        border-radius: 13px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.2rem;
        flex-shrink: 0;
        background: var(--bg);
        color: var(--c);
        transition: transform 0.3s;
    }
    .stat-card:hover .stat-icon { transform: scale(1.1) rotate(-4deg); }
    .stat-number { font-size: 1.8rem; font-weight: 800; color: #0D1B2A; line-height: 1; margin-bottom: 3px; }
    .stat-label  { font-size: 0.78rem; color: #64748B; font-weight: 500; }

    /* ============================================
       DASH CARD
       ============================================ */
    .dash-card {
        background: #fff;
        border: 1px solid #E2E8F0;
        border-radius: 18px;
        overflow: hidden;
    }
    .dash-card-header {
        padding: 18px 22px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 1px solid #F1F5F9;
    }
    .dash-card-title {
        font-size: 0.92rem;
        font-weight: 700;
        color: #0D1B2A;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .dash-card-title i { color: #0E7A96; }

    /* ============================================
       FILTER BAR
       ============================================ */
    .filter-bar {
        padding: 14px 22px;
        background: #F8FAFC;
        border-bottom: 1px solid #F1F5F9;
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }
    .search-wrap {
        position: relative;
        flex: 1;
        min-width: 160px;
    }
    .search-wrap .search-icon {
        position: absolute;
        left: 12px; top: 50%;
        transform: translateY(-50%);
        color: #94A3B8;
        font-size: 0.82rem;
        pointer-events: none;
    }
    .search-wrap input {
        width: 100%;
        padding: 8px 14px 8px 34px;
        border: 1.5px solid #E2E8F0;
        border-radius: 50px;
        font-size: 0.83rem;
        color: #0D1B2A;
        background: #fff;
        transition: border-color 0.2s;
        outline: none;
    }
    .search-wrap input:focus { border-color: #0E7A96; box-shadow: 0 0 0 3px rgba(14,122,150,0.09); }
    .search-wrap input::placeholder { color: #CBD5E1; }

    .filter-select {
        padding: 8px 14px;
        border: 1.5px solid #E2E8F0;
        border-radius: 50px;
        font-size: 0.83rem;
        color: #0D1B2A;
        background: #fff;
        transition: border-color 0.2s;
        outline: none;
        cursor: pointer;
    }
    .filter-select:focus { border-color: #0E7A96; }

    .count-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: rgba(14,122,150,0.08);
        color: #0E7A96;
        padding: 6px 14px;
        border-radius: 50px;
        font-size: 0.78rem;
        font-weight: 700;
        white-space: nowrap;
    }

    /* ============================================
       TABLE
       ============================================ */
    .dash-table { width: 100%; border-collapse: collapse; }
    .dash-table thead th {
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.07em;
        color: #94A3B8;
        padding: 10px 16px;
        background: #F8FAFC;
        border-bottom: 1px solid #F1F5F9;
        white-space: nowrap;
    }
    .dash-table tbody tr {
        border-bottom: 1px solid #F8FAFC;
        transition: background 0.18s;
    }
    .dash-table tbody tr:last-child { border-bottom: none; }
    .dash-table tbody tr:hover { background: #F8FAFC; }
    .dash-table tbody td {
        padding: 12px 16px;
        font-size: 0.84rem;
        color: #0D1B2A;
        vertical-align: middle;
    }
    .td-muted { font-size: 0.74rem; color: #94A3B8; margin-top: 2px; }

    .row-num {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 26px; height: 26px;
        border-radius: 8px;
        background: #F1F5F9;
        color: #64748B;
        font-size: 0.72rem;
        font-weight: 700;
    }

    /* size badge */
    .size-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 32px; height: 28px;
        padding: 0 8px;
        border-radius: 8px;
        font-size: 0.75rem;
        font-weight: 800;
        background: linear-gradient(135deg, #0E7A96, #4EB8CC);
        color: #fff;
        letter-spacing: 0.03em;
    }

    /* color swatch */
    .color-swatch {
        display: inline-flex;
        align-items: center;
        gap: 7px;
    }
    .color-dot {
        width: 14px; height: 14px;
        border-radius: 50%;
        border: 2px solid rgba(0,0,0,0.08);
        flex-shrink: 0;
    }

    /* sleeve pill */
    .sleeve-pill {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 3px 10px;
        border-radius: 8px;
        font-size: 0.75rem;
        font-weight: 700;
    }
    .sleeve-pill.pendek { background: #EEF9FC; color: #0E7A96; }
    .sleeve-pill.panjang { background: #F1F5F9; color: #475569; }

    /* stock indicator */
    .stock-wrap {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .stock-bar-bg {
        flex: 1;
        height: 5px;
        border-radius: 99px;
        background: #F1F5F9;
        overflow: hidden;
        min-width: 40px;
    }
    .stock-bar-fill {
        height: 100%;
        border-radius: 99px;
        transition: width 0.4s;
    }
    .stock-val {
        font-size: 0.82rem;
        font-weight: 700;
        color: #0D1B2A;
        min-width: 24px;
        text-align: right;
    }

    /* price */
    .price-val {
        font-size: 0.88rem;
        font-weight: 700;
        color: #059669;
    }

    /* action buttons */
    .btn-xs-act {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px; height: 32px;
        border-radius: 9px;
        font-size: 0.8rem;
        border: none;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.2s;
    }
    .btn-xs-act.edit   { background: rgba(217,119,6,0.09);  color: #D97706; }
    .btn-xs-act.danger { background: rgba(220,38,38,0.09);  color: #DC2626; }
    .btn-xs-act:hover  { filter: brightness(0.88); transform: scale(1.08); }

    /* empty */
    .empty-row td {
        text-align: center;
        padding: 48px 20px !important;
        color: #94A3B8;
        font-size: 0.85rem;
    }
    .empty-icon-sm { font-size: 2.5rem; display: block; margin-bottom: 10px; opacity: 0.3; }

    /* no results */
    #noResults {
        display: none;
        text-align: center;
        padding: 40px 20px;
        color: #94A3B8;
        font-size: 0.85rem;
    }

    /* ============================================
       PAGINATION
       ============================================ */
    .dash-pagination {
        padding: 14px 22px;
        border-top: 1px solid #F1F5F9;
        display: flex;
        align-items: center;
        justify-content: flex-end;
    }
    .dash-pagination .pagination {
        margin: 0;
    }
    .dash-pagination .page-link {
        border-radius: 8px !important;
        border: 1.5px solid #E2E8F0;
        color: #0E7A96;
        font-size: 0.8rem;
        font-weight: 600;
        padding: 5px 11px;
        margin: 0 2px;
        transition: all 0.2s;
    }
    .dash-pagination .page-link:hover { background: #EEF9FC; border-color: #0E7A96; }
    .dash-pagination .page-item.active .page-link {
        background: linear-gradient(135deg, #0E7A96, #4EB8CC);
        border-color: transparent;
        color: #fff;
    }
    .dash-pagination .page-item.disabled .page-link { opacity: 0.4; }

    /* ============================================
       MODAL BASE
       ============================================ */
    .modal-content {
        border: none !important;
        border-radius: 20px !important;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0,0,0,0.15) !important;
    }
    .modal-header {
        background: linear-gradient(135deg, #0D1B2A 0%, #1B3A4B 55%, #0E7A96 100%);
        border: none !important;
        padding: 20px 24px !important;
    }
    .modal-title-custom {
        color: #fff;
        font-weight: 800;
        font-size: 1rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .modal-body   { padding: 0 !important; }
    .modal-footer {
        border-top: 1px solid #F1F5F9 !important;
        padding: 14px 24px !important;
    }

    /* ============================================
       MODAL ADD — BULK BUILDER
       ============================================ */
    .bulk-config {
        padding: 20px 24px;
        background: #F8FAFC;
        border-bottom: 1px solid #F1F5F9;
    }
    .bulk-config-label {
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.07em;
        color: #94A3B8;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .bulk-config-label i { color: #0E7A96; }

    .cfg-group { }
    .cfg-group label {
        font-size: 0.72rem;
        font-weight: 700;
        color: #64748B;
        text-transform: uppercase;
        letter-spacing: 0.04em;
        margin-bottom: 5px;
        display: block;
    }
    .cfg-group .form-control,
    .cfg-group select.form-control {
        border: 1.5px solid #E2E8F0;
        border-radius: 11px;
        font-size: 0.85rem;
        color: #0D1B2A;
        padding: 8px 12px;
        height: auto;
        background: #fff;
        box-shadow: none !important;
        transition: border-color 0.2s;
    }
    .cfg-group .form-control:focus,
    .cfg-group select.form-control:focus {
        border-color: #0E7A96;
        box-shadow: 0 0 0 3px rgba(14,122,150,0.09) !important;
    }

    .btn-add-row {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 9px 20px;
        background: linear-gradient(135deg, #0E7A96, #4EB8CC);
        color: #fff;
        border: none;
        border-radius: 50px;
        font-size: 0.83rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.25s;
        margin-top: 16px;
        box-shadow: 0 4px 12px rgba(14,122,150,0.2);
    }
    .btn-add-row:hover { transform: translateY(-2px); box-shadow: 0 7px 18px rgba(14,122,150,0.3); }

    .bulk-table-wrap {
        padding: 20px 24px;
    }
    .bulk-table-hint {
        text-align: center;
        padding: 32px 20px;
        color: #94A3B8;
        font-size: 0.83rem;
        border: 2px dashed #E2E8F0;
        border-radius: 14px;
    }
    .bulk-table-hint i { font-size: 1.8rem; display: block; margin-bottom: 8px; opacity: 0.35; }

    /* bulk inline table */
    .bulk-tbl { width: 100%; border-collapse: collapse; }
    .bulk-tbl thead th {
        font-size: 0.68rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        color: #94A3B8;
        padding: 8px 10px;
        background: #F8FAFC;
        border-bottom: 1px solid #F1F5F9;
        white-space: nowrap;
    }
    .bulk-tbl tbody tr { border-bottom: 1px solid #F8FAFC; }
    .bulk-tbl tbody td { padding: 8px 10px; vertical-align: middle; font-size: 0.83rem; }

    .bulk-input {
        width: 100%;
        padding: 6px 10px;
        border: 1.5px solid #E2E8F0;
        border-radius: 9px;
        font-size: 0.82rem;
        color: #0D1B2A;
        background: #fff;
        outline: none;
        transition: border-color 0.2s;
    }
    .bulk-input:focus { border-color: #0E7A96; box-shadow: 0 0 0 2px rgba(14,122,150,0.09); }
    .bulk-input::placeholder { color: #CBD5E1; }

    .btn-row-del {
        width: 28px; height: 28px;
        border: none;
        border-radius: 8px;
        background: rgba(220,38,38,0.09);
        color: #DC2626;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 0.78rem;
        transition: all 0.2s;
    }
    .btn-row-del:hover { background: #DC2626; color: #fff; }

    /* ============================================
       MODAL EDIT FORM
       ============================================ */
    .edit-modal-body {
        padding: 24px;
    }
    .modal-form-group { margin-bottom: 16px; }
    .modal-form-group label {
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #64748B;
        margin-bottom: 6px;
        display: block;
    }
    .modal-form-group .form-control,
    .modal-form-group select.form-control {
        border: 1.5px solid #E2E8F0;
        border-radius: 12px;
        font-size: 0.87rem;
        color: #0D1B2A;
        padding: 10px 14px;
        height: auto;
        box-shadow: none !important;
        transition: border-color 0.2s;
    }
    .modal-form-group .form-control:focus,
    .modal-form-group select.form-control:focus {
        border-color: #0E7A96;
        box-shadow: 0 0 0 3px rgba(14,122,150,0.1) !important;
    }

    /* split row */
    .form-row-split { display: flex; gap: 14px; }
    .form-row-split .modal-form-group { flex: 1; }

    /* color preview in edit */
    .color-preview-wrap {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .color-preview-wrap input { flex: 1; }
    .color-preview-dot {
        width: 32px; height: 32px;
        border-radius: 9px;
        border: 2px solid #E2E8F0;
        flex-shrink: 0;
        transition: background 0.2s;
    }

    .btn-modal-primary {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 10px 24px;
        background: linear-gradient(135deg, #0E7A96, #4EB8CC);
        color: #fff;
        border: none;
        border-radius: 50px;
        font-size: 0.87rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.25s;
    }
    .btn-modal-primary:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(14,122,150,0.3); color: #fff; }

    .btn-modal-amber {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 10px 24px;
        background: linear-gradient(135deg, #D97706, #FBBF24);
        color: #fff;
        border: none;
        border-radius: 50px;
        font-size: 0.87rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.25s;
    }
    .btn-modal-amber:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(217,119,6,0.3); color: #fff; }

    .btn-modal-cancel {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 10px 20px;
        background: #fff;
        color: #64748B;
        border: 1.5px solid #E2E8F0;
        border-radius: 50px;
        font-size: 0.87rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s;
    }
    .btn-modal-cancel:hover { background: #F8FAFC; color: #0D1B2A; }

    /* ============================================
       ANIMATIONS
       ============================================ */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(14px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .anim-1 { animation: fadeInUp 0.38s ease both; }
    .anim-2 { animation: fadeInUp 0.38s 0.07s ease both; }
    .anim-3 { animation: fadeInUp 0.38s 0.14s ease both; }
</style>
@endpush

@section('content')

    @if(session('success'))
        <div class="alert alert-dismissible fade show"
             style="border-radius:12px; font-size:0.88rem; border:none; background:#D1FAE5; color:#065F46; margin-bottom:20px;">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

    {{-- ── STAT CARDS ── --}}
    <p class="sec-label anim-1">Ringkasan</p>
    <div class="row g-3 mb-4 anim-1">
        <div class="col-6 col-lg" style="min-width:0;">
            <div class="stat-card blue">
                <div class="stat-icon"><i class="fas fa-swatchbook"></i></div>
                <div>
                    <div class="stat-number">{{ $variants->total() }}</div>
                    <div class="stat-label">Total Varian</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg" style="min-width:0;">
            <div class="stat-card green">
                <div class="stat-icon"><i class="fas fa-boxes"></i></div>
                <div>
                    <div class="stat-number">{{ $variants->sum('stock') }}</div>
                    <div class="stat-label">Total Stok</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg" style="min-width:0;">
            <div class="stat-card amber">
                <div class="stat-icon"><i class="fas fa-exclamation-triangle"></i></div>
                <div>
                    <div class="stat-number">{{ $variants->where('stock', '<=', 5)->count() }}</div>
                    <div class="stat-label">Stok Menipis</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg" style="min-width:0;">
            <div class="stat-card red">
                <div class="stat-icon"><i class="fas fa-times-circle"></i></div>
                <div>
                    <div class="stat-number">{{ $variants->where('stock', 0)->count() }}</div>
                    <div class="stat-label">Stok Habis</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg" style="min-width:0;">
            <div class="stat-card slate">
                <div class="stat-icon"><i class="fas fa-paint-brush"></i></div>
                <div>
                    <div class="stat-number">{{ $models->count() }}</div>
                    <div class="stat-label">Total Model</div>
                </div>
            </div>
        </div>
    </div>

    {{-- ── TABLE CARD ── --}}
    <p class="sec-label anim-2">Daftar Varian</p>
    <div class="dash-card anim-2">

        {{-- Header --}}
        <div class="dash-card-header">
            <div class="dash-card-title">
                <i class="fas fa-swatchbook"></i> Varian Kaos
            </div>
            <span class="count-badge">
                <i class="fas fa-list"></i>
                {{ $variants->total() }} varian
            </span>
        </div>

        {{-- Filter Bar --}}
        <div class="filter-bar">
            <div class="search-wrap">
                <i class="fas fa-search search-icon"></i>
                <input type="text" id="searchInput" placeholder="Cari warna atau model...">
            </div>
            <select class="filter-select" id="filterSize">
                <option value="">Semua Size</option>
                @foreach(['S','M','L','XL','XXL'] as $s)
                    <option value="{{ $s }}">{{ $s }}</option>
                @endforeach
            </select>
            <select class="filter-select" id="filterSleeve">
                <option value="">Semua Lengan</option>
                <option value="pendek">Pendek</option>
                <option value="panjang">Panjang</option>
            </select>
            <select class="filter-select" id="filterStock">
                <option value="">Semua Stok</option>
                <option value="low">Stok Menipis (≤5)</option>
                <option value="out">Habis (0)</option>
                <option value="ok">Tersedia (>5)</option>
            </select>
        </div>

        {{-- Table --}}
        <div class="table-responsive">
            <table class="dash-table" id="variantsTable">
                <thead>
                    <tr>
                        <th style="width:46px;">#</th>
                        <th>Model</th>
                        <th>Size</th>
                        <th>Warna</th>
                        <th>Lengan</th>
                        <th>Stok</th>
                        <th>Harga</th>
                        <th style="width:90px; text-align:center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($variants as $v)
                        @php
                            $stock      = $v->stock;
                            $stockColor = $stock == 0  ? '#DC2626'
                                        : ($stock <= 5  ? '#D97706' : '#059669');
                            $stockPct   = min(100, ($stock / 50) * 100);
                            $colorNames = [
                                'hitam'=>'#1a1a1a','putih'=>'#f5f5f5','merah'=>'#e53e3e',
                                'biru'=>'#3182ce','hijau'=>'#38a169','kuning'=>'#d69e2e',
                                'orange'=>'#dd6b20','ungu'=>'#805ad5','pink'=>'#d53f8c',
                                'abu'=>'#718096','abu-abu'=>'#718096','coklat'=>'#744210',
                                'navy'=>'#1a365d','tosca'=>'#0E7A96','cream'=>'#f5f0e0',
                            ];
                            $colorKey   = strtolower(trim($v->color));
                            $dotColor   = $colorNames[$colorKey] ?? '#94A3B8';
                        @endphp
                        <tr data-name="{{ strtolower($v->color . ' ' . ($v->model->name ?? '')) }}"
                            data-size="{{ $v->size }}"
                            data-sleeve="{{ $v->sleeve_type }}"
                            data-stock="{{ $stock }}">
                            <td><span class="row-num">{{ $loop->iteration }}</span></td>
                            <td>
                                <div style="font-weight:700; font-size:0.86rem;">{{ $v->model->name ?? 'N/A' }}</div>
                                <div class="td-muted">ID #{{ $v->id }}</div>
                            </td>
                            <td><span class="size-badge">{{ $v->size }}</span></td>
                            <td>
                                <div class="color-swatch">
                                    <span class="color-dot" style="background:{{ $dotColor }};"></span>
                                    <span style="font-weight:600;">{{ $v->color }}</span>
                                </div>
                            </td>
                            <td>
                                <span class="sleeve-pill {{ $v->sleeve_type }}">
                                    <i class="fas fa-tshirt" style="font-size:0.7rem;"></i>
                                    {{ $v->sleeve_type == 'pendek' ? 'Pendek' : 'Panjang' }}
                                </span>
                            </td>
                            <td>
                                <div class="stock-wrap">
                                    <span class="stock-val" style="color:{{ $stockColor }};">{{ $stock }}</span>
                                    <div class="stock-bar-bg">
                                        <div class="stock-bar-fill"
                                             style="width:{{ $stockPct }}%; background:{{ $stockColor }};"></div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="price-val">Rp {{ number_format($v->price, 0, ',', '.') }}</span>
                            </td>
                            <td style="text-align:center; white-space:nowrap;">
                                <button class="btn-xs-act edit edit-btn"
                                        title="Edit"
                                        data-id="{{ $v->id }}"
                                        data-model="{{ $v->model_id }}"
                                        data-size="{{ $v->size }}"
                                        data-color="{{ $v->color }}"
                                        data-sleeve="{{ $v->sleeve_type }}"
                                        data-stock="{{ $v->stock }}"
                                        data-price="{{ $v->price }}"
                                        data-toggle="modal" data-target="#editModal">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="{{ route('apparel.variants.destroy', $v) }}"
                                      method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-xs-act danger" title="Hapus"
                                            onclick="return confirm('Hapus varian ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr class="empty-row">
                            <td colspan="8">
                                <i class="fas fa-swatchbook empty-icon-sm"></i>
                                Belum ada varian kaos
                                <div style="margin-top:10px;">
                                    <button data-toggle="modal" data-target="#addModal"
                                        style="display:inline-flex; align-items:center; gap:6px; background:#EEF9FC; color:#0E7A96; padding:8px 18px; border-radius:50px; font-size:0.8rem; font-weight:700; border:none; cursor:pointer;">
                                        <i class="fas fa-plus"></i> Tambah Varian Pertama
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div id="noResults" style="display:none; text-align:center; padding:40px 20px; color:#94A3B8; font-size:0.85rem;">
            <i class="fas fa-search" style="font-size:2rem; display:block; margin-bottom:10px; opacity:0.3;"></i>
            Tidak ada varian yang cocok
        </div>

        {{-- Pagination --}}
        @if($variants->hasPages())
            <div class="dash-pagination">
                {{ $variants->links() }}
            </div>
        @endif

    </div>


    {{-- ══════════════════════════════════════════
         MODAL TAMBAH BULK
         ══════════════════════════════════════════ --}}
    <div class="modal fade" id="addModal" tabindex="-1">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <form action="{{ route('apparel.variants.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <div class="modal-title-custom">
                            <i class="fas fa-plus-circle"></i> Tambah Varian Sekaligus
                        </div>
                        <button type="button" class="close" data-dismiss="modal"
                                style="color:#fff; opacity:0.7; font-size:1.2rem; background:none; border:none; cursor:pointer;">
                            &times;
                        </button>
                    </div>

                    <div class="modal-body">
                        {{-- Config strip --}}
                        <div class="bulk-config">
                            <div class="bulk-config-label">
                                <i class="fas fa-sliders-h"></i> Konfigurasi Default Baris Baru
                            </div>
                            <div class="row g-2">
                                <div class="col-md-4 col-sm-6">
                                    <div class="cfg-group">
                                        <label><i class="fas fa-paint-brush me-1"></i> Model / Motif</label>
                                        <select id="bulkModel" class="form-control">
                                            <option value="">— Pilih Model —</option>
                                            @foreach($models as $m)
                                                <option value="{{ $m->id }}">{{ $m->name }} ({{ $m->edition->name ?? '' }})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-3">
                                    <div class="cfg-group">
                                        <label><i class="fas fa-ruler me-1"></i> Size</label>
                                        <select id="bulkSize" class="form-control">
                                            <option value="">—</option>
                                            <option>S</option><option>M</option><option>L</option>
                                            <option>XL</option><option>XXL</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-3">
                                    <div class="cfg-group">
                                        <label><i class="fas fa-tshirt me-1"></i> Lengan</label>
                                        <select id="bulkSleeve" class="form-control">
                                            <option value="">—</option>
                                            <option value="pendek">Pendek</option>
                                            <option value="panjang">Panjang</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-6">
                                    <div class="cfg-group">
                                        <label><i class="fas fa-boxes me-1"></i> Stok Default</label>
                                        <input type="number" id="bulkStock" class="form-control" value="10" min="0">
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-6">
                                    <div class="cfg-group">
                                        <label><i class="fas fa-tag me-1"></i> Harga Default</label>
                                        <input type="number" id="bulkPrice" class="form-control" value="90000" min="0">
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn-add-row" onclick="addBulkRow()">
                                <i class="fas fa-plus"></i> Tambah Baris
                            </button>
                        </div>

                        {{-- Bulk table --}}
                        <div class="bulk-table-wrap">
                            <div id="bulkHint" class="bulk-table-hint">
                                <i class="fas fa-table"></i>
                                Pilih Model, Size & Lengan di atas, lalu klik <strong>Tambah Baris</strong>.
                                Isi warna untuk setiap baris sebelum menyimpan.
                            </div>
                            <div id="bulkTableWrap" style="display:none;">
                                <table class="bulk-tbl">
                                    <thead>
                                        <tr>
                                            <th>Model</th>
                                            <th>Size</th>
                                            <th>Lengan</th>
                                            <th>Warna <span style="color:#DC2626;">*</span></th>
                                            <th>Stok</th>
                                            <th>Harga (Rp)</th>
                                            <th style="width:40px;"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="bulkTableBody"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer" style="justify-content:space-between;">
                        <span style="font-size:0.8rem; color:#94A3B8; font-weight:600;">
                            <i class="fas fa-layer-group me-1"></i>
                            <span id="rowCount">0</span> varian akan ditambahkan
                        </span>
                        <div style="display:flex; gap:10px;">
                            <button type="button" class="btn-modal-cancel" data-dismiss="modal">
                                <i class="fas fa-times"></i> Batal
                            </button>
                            <button type="submit" class="btn-modal-primary">
                                <i class="fas fa-save"></i> Simpan Semua
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    {{-- ══════════════════════════════════════════
         MODAL EDIT
         ══════════════════════════════════════════ --}}
    <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <form id="editForm" method="POST">
                @csrf @method('PUT')
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title-custom">
                            <i class="fas fa-edit"></i> Edit Varian
                            <span id="editModalTitle" style="opacity:0.65; font-weight:600;"></span>
                        </div>
                        <button type="button" class="close" data-dismiss="modal"
                                style="color:#fff; opacity:0.7; font-size:1.2rem; background:none; border:none; cursor:pointer;">
                            &times;
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="edit-modal-body">
                            {{-- ID badge --}}
                            <div style="display:flex; align-items:center; gap:8px; margin-bottom:20px; padding-bottom:16px; border-bottom:1px solid #F1F5F9;">
                                <div style="width:36px;height:36px;border-radius:10px;background:#EEF9FC;color:#0E7A96;display:flex;align-items:center;justify-content:center;">
                                    <i class="fas fa-hashtag" style="font-size:0.85rem;"></i>
                                </div>
                                <div>
                                    <div style="font-size:0.7rem;color:#94A3B8;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;">Editing ID</div>
                                    <div style="font-size:0.88rem;font-weight:800;color:#0D1B2A;" id="editIdDisplay">—</div>
                                </div>
                            </div>

                            <div class="modal-form-group">
                                <label><i class="fas fa-paint-brush me-1"></i> Model <span style="color:#DC2626;">*</span></label>
                                <select name="model_id" id="editModel" class="form-control" required>
                                    @foreach($models as $m)
                                        <option value="{{ $m->id }}">{{ $m->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-row-split">
                                <div class="modal-form-group">
                                    <label><i class="fas fa-ruler me-1"></i> Size <span style="color:#DC2626;">*</span></label>
                                    <select name="size" id="editSize" class="form-control" required>
                                        @foreach(['S','M','L','XL','XXL'] as $s)
                                            <option value="{{ $s }}">{{ $s }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="modal-form-group">
                                    <label><i class="fas fa-tshirt me-1"></i> Lengan <span style="color:#DC2626;">*</span></label>
                                    <select name="sleeve_type" id="editSleeve" class="form-control" required>
                                        <option value="pendek">Pendek</option>
                                        <option value="panjang">Panjang</option>
                                    </select>
                                </div>
                            </div>

                            <div class="modal-form-group">
                                <label><i class="fas fa-palette me-1"></i> Warna <span style="color:#DC2626;">*</span></label>
                                <div class="color-preview-wrap">
                                    <input type="text" name="color" id="editColor" class="form-control"
                                           placeholder="Contoh: Hitam" required
                                           oninput="updateColorDot(this.value)">
                                    <div class="color-preview-dot" id="editColorDot"></div>
                                </div>
                            </div>

                            <div class="form-row-split" style="margin-bottom:0;">
                                <div class="modal-form-group" style="margin-bottom:0;">
                                    <label><i class="fas fa-boxes me-1"></i> Stok <span style="color:#DC2626;">*</span></label>
                                    <input type="number" name="stock" id="editStock" class="form-control" min="0" required>
                                </div>
                                <div class="modal-form-group" style="margin-bottom:0;">
                                    <label><i class="fas fa-tag me-1"></i> Harga (Rp) <span style="color:#DC2626;">*</span></label>
                                    <input type="number" name="price" id="editPrice" class="form-control" min="0" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="justify-content:flex-end; gap:10px;">
                        <button type="button" class="btn-modal-cancel" data-dismiss="modal">
                            <i class="fas fa-times"></i> Batal
                        </button>
                        <button type="submit" class="btn-modal-amber">
                            <i class="fas fa-save"></i> Update Varian
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@stop

@push('js')
<script>
    /* ═══════════════════════════════════
       BULK ADD LOGIC
    ═══════════════════════════════════ */
    function addBulkRow() {
        var model  = document.getElementById('bulkModel');
        var size   = document.getElementById('bulkSize');
        var sleeve = document.getElementById('bulkSleeve');
        var stock  = document.getElementById('bulkStock').value;
        var price  = document.getElementById('bulkPrice').value;

        if (!model.value || !size.value || !sleeve.value) {
            // shake the config section softly
            var cfg = document.querySelector('.bulk-config');
            cfg.style.background = '#FEF3C7';
            setTimeout(function(){ cfg.style.background = '#F8FAFC'; }, 600);
            alert('Pilih Model, Size, dan Lengan terlebih dahulu!');
            return;
        }

        var modelText  = model.options[model.selectedIndex].text;
        var sizeVal    = size.value;
        var sleeveVal  = sleeve.value;
        var sleeveText = sleeveVal === 'pendek' ? 'Pendek' : 'Panjang';
        var sleeveClass= sleeveVal;

        /* show table, hide hint */
        document.getElementById('bulkHint').style.display   = 'none';
        document.getElementById('bulkTableWrap').style.display = '';

        var tbody = document.getElementById('bulkTableBody');
        var tr    = document.createElement('tr');
        tr.innerHTML = `
            <td>
                <div style="font-weight:700; font-size:0.82rem; max-width:160px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;" title="${modelText}">${modelText}</div>
                <input type="hidden" name="model_id[]" value="${model.value}">
            </td>
            <td>
                <span style="display:inline-flex;align-items:center;justify-content:center;min-width:32px;height:28px;padding:0 8px;border-radius:8px;font-size:0.75rem;font-weight:800;background:linear-gradient(135deg,#0E7A96,#4EB8CC);color:#fff;">${sizeVal}</span>
                <input type="hidden" name="size[]" value="${sizeVal}">
            </td>
            <td>
                <span style="display:inline-flex;align-items:center;gap:5px;padding:3px 10px;border-radius:8px;font-size:0.75rem;font-weight:700;background:${sleeveClass==='pendek'?'#EEF9FC':'#F1F5F9'};color:${sleeveClass==='pendek'?'#0E7A96':'#475569'};">
                    <i class="fas fa-tshirt" style="font-size:0.7rem;"></i> ${sleeveText}
                </span>
                <input type="hidden" name="sleeve_type[]" value="${sleeveVal}">
            </td>
            <td>
                <input type="text" name="color[]" class="bulk-input" placeholder="Hitam, Putih, Merah…" required style="min-width:120px;">
            </td>
            <td>
                <input type="number" name="stock[]" class="bulk-input" value="${stock}" min="0" required style="min-width:64px;">
            </td>
            <td>
                <input type="number" name="price[]" class="bulk-input" value="${price}" min="0" required style="min-width:100px;">
            </td>
            <td style="text-align:center;">
                <button type="button" class="btn-row-del" onclick="removeBulkRow(this)" title="Hapus baris">
                    <i class="fas fa-times"></i>
                </button>
            </td>
        `;
        tbody.appendChild(tr);
        updateRowCount();

        /* auto-focus warna input */
        tr.querySelector('input[name="color[]"]').focus();
    }

    function removeBulkRow(btn) {
        btn.closest('tr').remove();
        updateRowCount();
        var tbody = document.getElementById('bulkTableBody');
        if (tbody.children.length === 0) {
            document.getElementById('bulkHint').style.display   = '';
            document.getElementById('bulkTableWrap').style.display = 'none';
        }
    }

    function updateRowCount() {
        var count = document.getElementById('bulkTableBody').children.length;
        document.getElementById('rowCount').textContent = count;
    }

    /* reset bulk table when modal closed */
    $('#addModal').on('hidden.bs.modal', function () {
        document.getElementById('bulkTableBody').innerHTML = '';
        document.getElementById('bulkHint').style.display   = '';
        document.getElementById('bulkTableWrap').style.display = 'none';
        document.getElementById('rowCount').textContent = '0';
        document.getElementById('bulkModel').value  = '';
        document.getElementById('bulkSize').value   = '';
        document.getElementById('bulkSleeve').value = '';
    });


    /* ═══════════════════════════════════
       EDIT MODAL
    ═══════════════════════════════════ */
    var colorMap = {
        'hitam':'#1a1a1a','putih':'#f5f5f5','merah':'#e53e3e','biru':'#3182ce',
        'hijau':'#38a169','kuning':'#d69e2e','orange':'#dd6b20','ungu':'#805ad5',
        'pink':'#d53f8c','abu':'#718096','abu-abu':'#718096','coklat':'#744210',
        'navy':'#1a365d','tosca':'#0E7A96','cream':'#f5f0e0'
    };

    function updateColorDot(val) {
        var key  = val.trim().toLowerCase();
        var dot  = document.getElementById('editColorDot');
        dot.style.background = colorMap[key] || '#E2E8F0';
    }

    $(document).on('click', '.edit-btn', function () {
        var id    = $(this).data('id');
        var color = $(this).data('color');
        $('#editModel').val($(this).data('model'));
        $('#editSize').val($(this).data('size'));
        $('#editColor').val(color);
        $('#editSleeve').val($(this).data('sleeve'));
        $('#editStock').val($(this).data('stock'));
        $('#editPrice').val($(this).data('price'));
        $('#editForm').attr('action', '/apparel/variants/' + id);
        $('#editModalTitle').text('— #' + id);
        $('#editIdDisplay').text('#' + id);
        updateColorDot(color);
    });


    /* ═══════════════════════════════════
       LIVE FILTER
    ═══════════════════════════════════ */
    function filterVariants() {
        var q      = $('#searchInput').val().toLowerCase();
        var size   = $('#filterSize').val();
        var sleeve = $('#filterSleeve').val();
        var stock  = $('#filterStock').val();

        var rows = $('#variantsTable tbody tr:not(.empty-row)');
        var vis  = 0;

        rows.each(function () {
            var $r     = $(this);
            var show   = true;
            var stkVal = parseInt($r.data('stock'));

            if (q      && ($r.data('name') || '').indexOf(q) === -1)   show = false;
            if (size   && $r.data('size')   !== size)                  show = false;
            if (sleeve && $r.data('sleeve') !== sleeve)                show = false;
            if (stock === 'low' && !(stkVal > 0 && stkVal <= 5))       show = false;
            if (stock === 'out' && stkVal !== 0)                       show = false;
            if (stock === 'ok'  && stkVal <= 5)                        show = false;

            $r.toggle(show);
            if (show) vis++;
        });

        $('#noResults').toggle(vis === 0 && rows.length > 0);
    }

    $('#searchInput').on('input', filterVariants);
    $('#filterSize, #filterSleeve, #filterStock').on('change', filterVariants);
</script>
@endpush