@extends('adminlte::page')

@section('title', 'Item Galeri: ' . $album->name)

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="mb-0" style="font-size: 1.4rem; font-weight: 700; color: #0D1B2A;">
                <i class="fas fa-images me-2" style="color: #0E7A96;"></i> {{ $album->name }}
            </h1>
            <ol class="breadcrumb mb-0 mt-1" style="font-size: 0.8rem; background: transparent; padding: 0;">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.albums.index') }}">Album</a></li>
                <li class="breadcrumb-item active">{{ $album->name }}</li>
            </ol>
        </div>
        <div style="display:flex; gap:8px; align-items:center; flex-wrap:wrap;">
            <a href="{{ route('admin.albums.items.create', $album) }}"
               style="display:inline-flex; align-items:center; gap:7px; background:#0E7A96; color:#fff; padding:10px 20px; border-radius:50px; font-weight:700; font-size:0.88rem; text-decoration:none; border:none; transition:all 0.3s;">
                <i class="fas fa-plus"></i> Tambah Item
            </a>
            <button type="button" data-toggle="modal" data-target="#uploadMultipleModal"
                    style="display:inline-flex; align-items:center; gap:7px; background:rgba(14,122,150,0.1); color:#0E7A96; padding:10px 20px; border-radius:50px; font-weight:700; font-size:0.88rem; border:1.5px solid rgba(14,122,150,0.2); cursor:pointer; transition:all 0.3s;">
                <i class="fas fa-upload"></i> Upload Banyak
            </button>
            <a href="{{ route('admin.albums.index') }}"
               style="display:inline-flex; align-items:center; gap:7px; background:#F8FAFC; color:#64748B; padding:10px 18px; border-radius:50px; font-weight:700; font-size:0.88rem; text-decoration:none; border:1.5px solid #E2E8F0; transition:all 0.3s;">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
@stop

@push('css')
<style>
    /* ============================================
       ALERT
       ============================================ */
    .alert-success-custom {
        border-radius: 12px;
        border: none;
        background: #D1FAE5;
        color: #065F46;
        font-size: 0.88rem;
        padding: 12px 18px;
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 20px;
    }

    .alert-danger-custom {
        border-radius: 12px;
        border: none;
        background: #FEE2E2;
        color: #991B1B;
        font-size: 0.88rem;
        padding: 12px 18px;
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 20px;
    }

    /* ============================================
       STATS BAR
       ============================================ */
    .stats-bar {
        display: flex;
        gap: 12px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }
    .stat-chip {
        background: #fff;
        border: 1px solid #E2E8F0;
        border-radius: 12px;
        padding: 10px 18px;
        font-size: 0.82rem;
        color: #64748B;
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: 500;
    }
    .stat-chip strong { color: #0D1B2A; font-size: 1rem; font-weight: 700; }
    .stat-chip i { color: #0E7A96; }

    /* ============================================
       FILTER BAR
       ============================================ */
    .filter-bar {
        background: #fff;
        border: 1px solid #E2E8F0;
        border-radius: 14px;
        padding: 12px 20px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }
    .filter-tab {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 16px;
        border-radius: 50px;
        font-size: 0.82rem;
        font-weight: 700;
        cursor: pointer;
        border: 1.5px solid #E2E8F0;
        background: #F8FAFC;
        color: #64748B;
        transition: all 0.2s;
        user-select: none;
    }
    .filter-tab.active, .filter-tab:hover {
        border-color: #0E7A96;
        background: rgba(14,122,150,0.08);
        color: #0E7A96;
    }
    .filter-bar input {
        border: 1.5px solid #E2E8F0;
        border-radius: 8px;
        padding: 7px 14px;
        font-size: 0.85rem;
        outline: none;
        color: #0D1B2A;
        background: #F8FAFC;
        transition: border-color 0.2s;
        flex: 1;
        min-width: 160px;
    }
    .filter-bar input:focus { border-color: #0E7A96; background: #fff; }

    /* ============================================
       MAIN CARD
       ============================================ */
    .gallery-card {
        background: #fff;
        border: 1px solid #E2E8F0;
        border-radius: 20px;
        overflow: hidden;
    }

    .gallery-card-body { padding: 24px; }

    /* ============================================
       ITEM GRID
       ============================================ */
    .items-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(190px, 1fr));
        gap: 16px;
    }

    /* Item card */
    .item-card {
        border: 1px solid #E2E8F0;
        border-radius: 14px;
        overflow: hidden;
        background: #fff;
        transition: all 0.2s;
        display: flex;
        flex-direction: column;
    }
    .item-card:hover {
        box-shadow: 0 8px 24px rgba(14,122,150,0.1);
        border-color: #CBD5E1;
        transform: translateY(-2px);
    }

    /* Thumbnail */
    .item-thumb {
        position: relative;
        width: 100%;
        padding-top: 68%;
        overflow: hidden;
        background: #F1F5F9;
        flex-shrink: 0;
    }
    .item-thumb img {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }
    .item-thumb .video-placeholder {
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, #1E293B, #0D1B2A);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 8px;
        color: rgba(255,255,255,0.5);
        font-size: 0.75rem;
        font-weight: 600;
    }
    .item-thumb .video-placeholder i { font-size: 1.8rem; color: rgba(255,255,255,0.3); }

    /* Type badge over image */
    .item-type-badge {
        position: absolute;
        top: 8px;
        right: 8px;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 3px 10px;
        border-radius: 50px;
        font-size: 0.68rem;
        font-weight: 700;
        backdrop-filter: blur(6px);
    }
    .item-type-badge.foto  { background: rgba(14,122,150,0.85); color: #fff; }
    .item-type-badge.video { background: rgba(217,119,6,0.85);  color: #fff; }

    /* Item info */
    .item-info {
        padding: 10px 12px;
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 4px;
    }
    .item-caption {
        font-size: 0.8rem;
        font-weight: 600;
        color: #0D1B2A;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .item-meta {
        font-size: 0.72rem;
        color: #94A3B8;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    /* Item actions */
    .item-actions {
        display: flex;
        border-top: 1px solid #F1F5F9;
        padding: 8px 12px;
        gap: 6px;
    }
    .act-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex: 1;
        height: 30px;
        border-radius: 8px;
        border: none;
        font-size: 0.78rem;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.2s;
        cursor: pointer;
        gap: 4px;
    }
    .act-btn.view   { background: rgba(5,150,105,0.09);  color: #059669; }
    .act-btn.delete { background: rgba(220,38,38,0.09);  color: #DC2626; }
    .act-btn:hover  { filter: brightness(0.88); transform: scale(1.04); text-decoration: none; }

    /* ============================================
       EMPTY STATE
       ============================================ */
    .empty-state { text-align: center; padding: 70px 20px; }
    .empty-icon-wrap {
        width: 80px; height: 80px;
        background: #EEF9FC;
        border-radius: 24px;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 18px;
        font-size: 2rem;
        color: #0E7A96;
        opacity: 0.6;
    }
    .empty-state h5 { font-weight: 700; color: #0D1B2A; margin-bottom: 6px; }
    .empty-state p  { color: #94A3B8; font-size: 0.88rem; margin-bottom: 20px; }

    /* ============================================
       PAGINATION
       ============================================ */
    .pagination .page-link svg { display: none !important; }
    .pagination .page-item:first-child .page-link::after { content: '« Prev'; }
    .pagination .page-item:last-child  .page-link::after { content: 'Next »'; }

    .pagination { gap: 4px; flex-wrap: wrap; }
    .pagination .page-link {
        border-radius: 8px !important;
        padding: 7px 14px;
        font-size: 0.85rem;
        font-weight: 600;
        color: #0D1B2A;
        border: 1.5px solid #E2E8F0;
        background: #fff;
        transition: all 0.2s;
    }
    .pagination .page-link:hover { background: #0E7A96; color: #fff; border-color: #0E7A96; }
    .pagination .page-item.active .page-link {
        background: #0E7A96; border-color: #0E7A96; color: #fff;
        box-shadow: 0 4px 12px rgba(14,122,150,0.25);
    }
    .pagination .page-item.disabled .page-link {
        background: #F8FAFC; color: #CBD5E1; border-color: #E2E8F0;
    }
    .card-foot {
        padding: 14px 24px;
        border-top: 1px solid #F1F5F9;
        display: flex;
        justify-content: center;
    }

    /* ============================================
       UPLOAD MODAL
       ============================================ */
    .modal-content {
        border: none;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 25px 60px rgba(0,0,0,0.15);
    }
    .modal-header-custom {
        background: #F8FAFC;
        border-bottom: 1px solid #F1F5F9;
        padding: 18px 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .modal-header-custom h5 {
        margin: 0;
        font-size: 0.95rem;
        font-weight: 700;
        color: #0D1B2A;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .modal-header-custom h5 .modal-icon {
        width: 32px; height: 32px;
        background: rgba(14,122,150,0.1);
        border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        color: #0E7A96;
        font-size: 0.85rem;
    }
    .modal-header-custom .btn-close-custom {
        background: none;
        border: none;
        color: #94A3B8;
        font-size: 1.1rem;
        cursor: pointer;
        padding: 4px;
        transition: color 0.2s;
    }
    .modal-header-custom .btn-close-custom:hover { color: #DC2626; }

    .modal-body-custom { padding: 24px; }
    .modal-footer-custom {
        padding: 16px 24px;
        border-top: 1px solid #F1F5F9;
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 10px;
    }

    /* Modal field */
    .modal-field { margin-bottom: 18px; }
    .modal-label {
        display: block;
        font-size: 0.78rem;
        font-weight: 700;
        color: #0D1B2A;
        margin-bottom: 7px;
        letter-spacing: 0.02em;
    }
    .modal-label .required { color: #DC2626; margin-left: 3px; }
    .modal-select,
    .modal-input {
        width: 100%;
        border: 1.5px solid #E2E8F0;
        border-radius: 10px;
        padding: 10px 14px;
        font-size: 0.88rem;
        color: #0D1B2A;
        background: #F8FAFC;
        outline: none;
        transition: all 0.2s;
        font-family: inherit;
        appearance: none;
    }
    .modal-select:focus, .modal-input:focus {
        border-color: #0E7A96;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(14,122,150,0.08);
    }

    /* File drop zone */
    .file-drop-zone {
        border: 1.5px dashed #CBD5E1;
        border-radius: 12px;
        background: #F8FAFC;
        padding: 28px 20px;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s;
        position: relative;
    }
    .file-drop-zone:hover, .file-drop-zone.dragover {
        border-color: #0E7A96;
        background: rgba(14,122,150,0.04);
    }
    .file-drop-zone input[type="file"] {
        position: absolute;
        inset: 0;
        opacity: 0;
        cursor: pointer;
        width: 100%;
        height: 100%;
    }
    .file-drop-zone .dz-icon {
        width: 44px; height: 44px;
        background: rgba(14,122,150,0.1);
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        color: #0E7A96;
        font-size: 1.1rem;
        margin: 0 auto 12px;
    }
    .file-drop-zone p { margin: 0; font-size: 0.85rem; font-weight: 600; color: #64748B; }
    .file-drop-zone span { font-size: 0.75rem; color: #94A3B8; }
    #fileCountBadge {
        display: none;
        margin-top: 10px;
        font-size: 0.78rem;
        font-weight: 700;
        color: #059669;
        background: rgba(5,150,105,0.09);
        border-radius: 50px;
        padding: 4px 14px;
    }

    /* Modal alert */
    .modal-alert {
        border-radius: 10px;
        padding: 11px 14px;
        font-size: 0.8rem;
        font-weight: 600;
        display: flex;
        align-items: flex-start;
        gap: 8px;
        margin-top: 14px;
    }
    .modal-alert.warn { background: #FEF3C7; color: #92400E; }
    .modal-alert.info { background: rgba(14,122,150,0.08); color: #0E7A96; }

    /* Modal buttons */
    .btn-modal-save {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: #0E7A96;
        color: #fff;
        padding: 10px 24px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.88rem;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
    }
    .btn-modal-save:hover { background: #0a5a70; color: #fff; }
    .btn-modal-save:disabled { opacity: 0.5; cursor: not-allowed; }
    .btn-modal-cancel {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        background: #F8FAFC;
        color: #64748B;
        padding: 10px 20px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.88rem;
        border: 1.5px solid #E2E8F0;
        cursor: pointer;
        transition: all 0.2s;
    }
    .btn-modal-cancel:hover { background: #F1F5F9; color: #0D1B2A; }
</style>
@endpush

@section('content')

    {{-- Alerts --}}
    @if(session('success'))
        <div class="alert-success-custom alert-dismissible">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="close ml-auto" data-dismiss="alert"
                    style="background:none; border:none; cursor:pointer; color:#065F46; font-size:1rem;">&times;</button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert-danger-custom alert-dismissible">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            <button type="button" class="close ml-auto" data-dismiss="alert"
                    style="background:none; border:none; cursor:pointer; color:#991B1B; font-size:1rem;">&times;</button>
        </div>
    @endif

    {{-- Stats --}}
    <div class="stats-bar">
        <div class="stat-chip">
            <i class="fas fa-images"></i>
            Total Item: <strong>{{ $items->total() }}</strong>
        </div>
        <div class="stat-chip">
            <i class="fas fa-camera"></i>
            Foto: <strong>{{ $items->getCollection()->where('type','foto')->count() }}</strong>
        </div>
        <div class="stat-chip">
            <i class="fas fa-video"></i>
            Video: <strong>{{ $items->getCollection()->where('type','video')->count() }}</strong>
        </div>
        @if($album->year)
        <div class="stat-chip">
            <i class="fas fa-calendar-alt"></i>
            Tahun: <strong>{{ $album->year }}</strong>
        </div>
        @endif
    </div>

    {{-- Filter bar --}}
    <div class="filter-bar">
        <span style="font-size:0.78rem; font-weight:700; color:#94A3B8; text-transform:uppercase; letter-spacing:0.06em; flex-shrink:0;">
            <i class="fas fa-filter"></i>
        </span>
        <span class="filter-tab active" onclick="filterItems('all', this)">Semua</span>
        <span class="filter-tab" onclick="filterItems('foto', this)"><i class="fas fa-camera"></i> Foto</span>
        <span class="filter-tab" onclick="filterItems('video', this)"><i class="fas fa-video"></i> Video</span>
        <div style="flex:1; min-width:10px;"></div>
        <i class="fas fa-search" style="color:#CBD5E1; font-size:0.9rem; flex-shrink:0;"></i>
        <input type="text" id="captionSearch" placeholder="Cari caption..." oninput="searchItems()">
    </div>

    {{-- Gallery card --}}
    <div class="gallery-card">
        @if($items->count() > 0)
            <div class="gallery-card-body">
                <div class="items-grid" id="itemsGrid">
                    @foreach($items as $item)
                        <div class="item-card" data-type="{{ $item->type }}" data-caption="{{ strtolower($item->caption ?? '') }}">
                            {{-- Thumbnail --}}
                            <div class="item-thumb">
                                @if($item->type == 'foto')
                                    <img src="{{ $item->file_url ?? asset('images/no-image.png') }}"
                                         alt="{{ $item->caption ?? 'Foto' }}"
                                         loading="lazy"
                                         onerror="this.onerror=null;this.src='{{ asset('images/no-image.png') }}';">
                                @else
                                    <div class="video-placeholder">
                                        <i class="fas fa-play-circle"></i>
                                        <span>Video</span>
                                    </div>
                                @endif
                                <span class="item-type-badge {{ $item->type }}">
                                    <i class="fas fa-{{ $item->type == 'foto' ? 'camera' : 'video' }}"></i>
                                    {{ $item->type == 'foto' ? 'Foto' : 'Video' }}
                                </span>
                            </div>

                            {{-- Info --}}
                            <div class="item-info">
                                @if($item->caption)
                                    <div class="item-caption">{{ $item->caption }}</div>
                                @else
                                    <div class="item-caption" style="color:#CBD5E1; font-style:italic;">Tanpa caption</div>
                                @endif
                                <div class="item-meta">
                                    <i class="fas fa-hdd"></i>
                                    {{ $item->formatted_size ?? '—' }}
                                </div>
                            </div>

                            {{-- Actions --}}
                            <div class="item-actions">
                                <a href="{{ $item->file_url ?? '#' }}" target="_blank"
                                   class="act-btn view" title="Lihat">
                                    <i class="fas fa-eye"></i> Lihat
                                </a>
                                <form action="{{ route('admin.albums.items.destroy', [$album, $item]) }}"
                                      method="POST" style="flex:1; display:flex;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="act-btn delete" title="Hapus" style="flex:1;"
                                            onclick="return confirm('Yakin ingin menghapus item ini?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Empty filtered state --}}
                <div id="emptyFilter" style="display:none; text-align:center; padding:40px 20px;">
                    <div style="color:#CBD5E1; font-size:1.8rem; margin-bottom:10px;"><i class="fas fa-search"></i></div>
                    <p style="color:#94A3B8; font-size:0.88rem; margin:0;">Tidak ada item yang cocok.</p>
                </div>
            </div>

            @if($items->hasPages())
                <div class="card-foot">
                    {{ $items->links() }}
                </div>
            @endif

        @else
            <div class="empty-state">
                <div class="empty-icon-wrap"><i class="fas fa-images"></i></div>
                <h5>Belum Ada Item</h5>
                <p>Upload foto atau video untuk memulai album ini.</p>
                <a href="{{ route('admin.albums.items.create', $album) }}"
                   style="display:inline-flex; align-items:center; gap:6px; background:#0E7A96; color:#fff; padding:10px 24px; border-radius:50px; font-weight:700; font-size:0.88rem; text-decoration:none;">
                    <i class="fas fa-plus"></i> Tambah Item Pertama
                </a>
            </div>
        @endif
    </div>

    {{-- ── Upload Multiple Modal ── --}}
    <div class="modal fade" id="uploadMultipleModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('admin.albums.items.upload-multiple', $album) }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Header --}}
                    <div class="modal-header-custom">
                        <h5>
                            <span class="modal-icon"><i class="fas fa-upload"></i></span>
                            Upload Banyak File ke "{{ $album->name }}"
                        </h5>
                        <button type="button" class="btn-close-custom" data-dismiss="modal">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>

                    {{-- Body --}}
                    <div class="modal-body-custom">

                        {{-- Tipe --}}
                        <div class="modal-field">
                            <label class="modal-label">
                                Tipe File <span class="required">*</span>
                            </label>
                            <div style="position:relative;">
                                <select name="type" id="modal_type" class="modal-select" required
                                        style="padding-right:38px;">
                                    <option value="foto">📷 Foto</option>
                                    <option value="video">🎬 Video</option>
                                </select>
                                <i class="fas fa-chevron-down" style="position:absolute; right:14px; top:50%; transform:translateY(-50%); color:#CBD5E1; font-size:0.7rem; pointer-events:none;"></i>
                            </div>
                        </div>

                        {{-- File drop zone --}}
                        <div class="modal-field">
                            <label class="modal-label">
                                Pilih File <span class="required">*</span>
                            </label>
                            <div class="file-drop-zone" id="dropZone">
                                <input type="file" name="files[]" id="modalFiles"
                                       multiple required accept="image/*,video/*"
                                       onchange="updateFileCount(this)">
                                <div class="dz-icon"><i class="fas fa-cloud-upload-alt"></i></div>
                                <p>Klik atau seret file ke sini</p>
                                <span>Pilih banyak file sekaligus — maks. 20MB per file</span>
                                <div id="fileCountBadge"><i class="fas fa-check-circle"></i> <span id="fileCountText"></span></div>
                            </div>
                        </div>

                        {{-- Alerts --}}
                        @if($album->items->count() >= 100)
                            <div class="modal-alert warn">
                                <i class="fas fa-exclamation-triangle" style="flex-shrink:0; margin-top:1px;"></i>
                                <span>Album sudah mencapai batas 100 item. Upload akan dibatasi.</span>
                            </div>
                        @else
                            <div class="modal-alert info">
                                <i class="fas fa-info-circle" style="flex-shrink:0; margin-top:1px;"></i>
                                <span>File akan disimpan di server. Maksimal <strong>100 item</strong> per album.
                                    Sisa slot: <strong>{{ 100 - $album->items->count() }}</strong> item.</span>
                            </div>
                        @endif

                    </div>

                    {{-- Footer --}}
                    <div class="modal-footer-custom">
                        <button type="button" class="btn-modal-cancel" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn-modal-save"
                                {{ $album->items->count() >= 100 ? 'disabled' : '' }}>
                            <i class="fas fa-upload"></i> Upload Semua
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>

@stop

@push('js')
<script>
    /* ── Filter by type ── */
    function filterItems(type, el) {
        document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active'));
        el.classList.add('active');
        applyFilters();
    }

    function searchItems() { applyFilters(); }

    function applyFilters() {
        const activeTab = document.querySelector('.filter-tab.active');
        const type      = activeTab ? activeTab.getAttribute('onclick').match(/'([^']+)'/)?.[1] : 'all';
        const search    = document.getElementById('captionSearch').value.toLowerCase();
        const cards     = document.querySelectorAll('.item-card');
        let   visible   = 0;

        cards.forEach(card => {
            const matchType    = type === 'all' || card.dataset.type === type;
            const matchCaption = card.dataset.caption.includes(search);
            const show         = matchType && matchCaption;
            card.style.display = show ? '' : 'none';
            if (show) visible++;
        });

        document.getElementById('emptyFilter').style.display = visible === 0 ? 'block' : 'none';
    }

    /* ── File count badge ── */
    function updateFileCount(input) {
        const badge    = document.getElementById('fileCountBadge');
        const countTxt = document.getElementById('fileCountText');
        if (input.files.length > 0) {
            countTxt.textContent = input.files.length + ' file dipilih';
            badge.style.display  = 'inline-flex';
            badge.style.alignItems = 'center';
            badge.style.gap = '5px';
        } else {
            badge.style.display = 'none';
        }
    }
</script>
@endpush