@extends('adminlte::page')

@section('title', 'Paket Studio')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="mb-0" style="font-size: 1.4rem; font-weight: 700; color: #0D1B2A;">
                <i class="fas fa-box-open me-2" style="color: #0E7A96;"></i> Paket Studio
            </h1>
            <ol class="breadcrumb mb-0 mt-1" style="font-size: 0.8rem; background: transparent; padding: 0;">
                <li class="breadcrumb-item"><a href="{{ route('studio.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Paket Studio</li>
            </ol>
        </div>
        <a href="{{ route('studio.packages.create') }}"
           style="display:inline-flex; align-items:center; gap:7px; background:#0E7A96; color:#fff; padding:10px 22px; border-radius:50px; font-weight:700; font-size:0.88rem; text-decoration:none; transition:all 0.3s;">
            <i class="fas fa-plus"></i> Tambah Paket
        </a>
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
        padding: 14px 20px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }
    .filter-bar input,
    .filter-bar select {
        border: 1.5px solid #E2E8F0;
        border-radius: 8px;
        padding: 8px 14px;
        font-size: 0.85rem;
        outline: none;
        color: #0D1B2A;
        background: #F8FAFC;
        transition: border-color 0.2s;
    }
    .filter-bar input  { flex: 1; min-width: 180px; }
    .filter-bar input:focus,
    .filter-bar select:focus { border-color: #0E7A96; background: #fff; }

    /* ============================================
       MAIN CARD
       ============================================ */
    .packages-card {
        background: #fff;
        border: 1px solid #E2E8F0;
        border-radius: 20px;
        overflow: hidden;
    }

    /* ============================================
       TABLE
       ============================================ */
    .packages-table { width: 100%; border-collapse: collapse; }

    .packages-table thead th {
        background: #F8FAFC;
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: #94A3B8;
        padding: 13px 20px;
        border-bottom: 1px solid #F1F5F9;
        white-space: nowrap;
    }

    .packages-table tbody tr {
        border-bottom: 1px solid #F8FAFC;
        transition: background 0.15s;
    }
    .packages-table tbody tr:last-child { border-bottom: none; }
    .packages-table tbody tr:hover { background: #FAFCFE; }

    .packages-table tbody td {
        padding: 16px 20px;
        vertical-align: middle;
        font-size: 0.88rem;
        color: #0D1B2A;
    }

    /* Package name */
    .pkg-name {
        font-weight: 700;
        color: #0D1B2A;
        font-size: 0.92rem;
        margin-bottom: 3px;
        line-height: 1.4;
    }
    .pkg-desc {
        font-size: 0.76rem;
        color: #94A3B8;
        line-height: 1.5;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
        max-width: 220px;
    }

    /* Type badge */
    .badge-type {
        display: inline-block;
        padding: 4px 12px;
        background: rgba(14,122,150,0.08);
        color: #0E7A96;
        border-radius: 50px;
        font-size: 0.72rem;
        font-weight: 700;
        white-space: nowrap;
    }

    /* Price */
    .pkg-price {
        font-size: 0.95rem;
        font-weight: 700;
        color: #059669;
        white-space: nowrap;
    }
    .pkg-price small {
        font-size: 0.72rem;
        color: #94A3B8;
        font-weight: 400;
    }

    /* Duration */
    .pkg-duration {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 0.82rem;
        color: #64748B;
        white-space: nowrap;
    }
    .pkg-duration i { color: #CBD5E1; font-size: 0.75rem; }

    /* Facilities list */
    .facility-list {
        list-style: none;
        padding: 0; margin: 0;
        display: flex;
        flex-direction: column;
        gap: 3px;
    }
    .facility-list li {
        font-size: 0.78rem;
        color: #475569;
        display: flex;
        align-items: center;
        gap: 5px;
    }
    .facility-list li i {
        color: #10B981;
        font-size: 0.65rem;
        flex-shrink: 0;
    }
    .facility-list .more {
        color: #94A3B8;
        font-size: 0.72rem;
        font-style: italic;
    }

    /* Action buttons */
    .act-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px; height: 32px;
        border-radius: 8px;
        border: none;
        font-size: 0.8rem;
        text-decoration: none;
        transition: all 0.2s;
        cursor: pointer;
    }
    .act-btn.edit   { background: rgba(217,119,6,0.09);  color: #D97706; }
    .act-btn.delete { background: rgba(220,38,38,0.09);  color: #DC2626; }
    .act-btn:hover  { filter: brightness(0.88); transform: scale(1.08); text-decoration: none; }

    /* ============================================
       EMPTY STATE
       ============================================ */
    .empty-state {
        text-align: center;
        padding: 70px 20px;
    }
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
       PAGINATION FIX
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
        padding: 14px 20px;
        border-top: 1px solid #F1F5F9;
        display: flex;
        justify-content: center;
    }
</style>
@endpush

@section('content')

    {{-- Alert --}}
    @if(session('success'))
        <div class="alert-success-custom">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="close ml-auto" data-dismiss="alert"
                    style="background:none; border:none; cursor:pointer; color:#065F46; font-size:1rem; margin-left:auto;">&times;</button>
        </div>
    @endif

    {{-- Stats --}}
    <div class="stats-bar">
        <div class="stat-chip">
            <i class="fas fa-box-open"></i>
            Total Paket: <strong>{{ $packages->total() }}</strong>
        </div>
        <div class="stat-chip">
            <i class="fas fa-tags"></i>
            Tipe Unik: <strong>{{ $packages->pluck('type')->unique()->count() }}</strong>
        </div>
    </div>

    {{-- Filter --}}
    <div class="filter-bar">
        <i class="fas fa-search" style="color:#CBD5E1; font-size:0.9rem; flex-shrink:0;"></i>
        <input type="text" id="searchInput" placeholder="Cari nama paket..." oninput="filterRows()">
        <select id="typeFilter" onchange="filterRows()">
            <option value="">Semua Tipe</option>
            @foreach($packages->pluck('type')->unique()->sort() as $type)
                <option value="{{ strtolower($type) }}">{{ $type }}</option>
            @endforeach
        </select>
    </div>

    {{-- Table Card --}}
    <div class="packages-card">
        @if($packages->isEmpty())
            <div class="empty-state">
                <div class="empty-icon-wrap"><i class="fas fa-box-open"></i></div>
                <h5>Belum Ada Paket Studio</h5>
                <p>Mulai tambahkan paket studio pertama Anda.</p>
                <a href="{{ route('studio.packages.create') }}"
                   style="display:inline-flex; align-items:center; gap:6px; background:#0E7A96; color:#fff; padding:10px 24px; border-radius:50px; font-weight:700; font-size:0.88rem; text-decoration:none;">
                    <i class="fas fa-plus"></i> Tambah Paket
                </a>
            </div>
        @else
            <div style="overflow-x: auto;">
                <table class="packages-table" id="packagesTable">
                    <thead>
                        <tr>
                            <th style="width:40px;">#</th>
                            <th>Nama Paket</th>
                            <th>Tipe</th>
                            <th>Harga</th>
                            <th>Durasi</th>
                            <th>Fasilitas</th>
                            <th style="width:90px; text-align:center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($packages as $index => $package)
                            <tr class="pkg-row"
                                data-name="{{ strtolower($package->name) }}"
                                data-type="{{ strtolower($package->type) }}">

                                {{-- No --}}
                                <td style="color:#CBD5E1; font-size:0.8rem; font-weight:600;">
                                    {{ $packages->firstItem() + $index }}
                                </td>

                                {{-- Nama --}}
                                <td style="max-width: 240px;">
                                    <div class="pkg-name">{{ $package->name }}</div>
                                    @if($package->description)
                                        <div class="pkg-desc">{{ $package->description }}</div>
                                    @endif
                                </td>

                                {{-- Tipe --}}
                                <td>
                                    <span class="badge-type">{{ $package->type }}</span>
                                </td>

                                {{-- Harga --}}
                                <td>
                                    <div class="pkg-price">
                                        Rp {{ number_format($package->price, 0, ',', '.') }}
                                    </div>
                                </td>

                                {{-- Durasi --}}
                                <td>
                                    <span class="pkg-duration">
                                        <i class="fas fa-clock"></i>
                                        {{ $package->duration }}
                                    </span>
                                </td>

                                {{-- Fasilitas --}}
                                <td>
                                    @if(is_array($package->facilities) && count($package->facilities) > 0)
                                        <ul class="facility-list">
                                            @foreach(array_slice($package->facilities, 0, 3) as $facility)
                                                <li>
                                                    <i class="fas fa-check-circle"></i>
                                                    {{ $facility }}
                                                </li>
                                            @endforeach
                                            @if(count($package->facilities) > 3)
                                                <li class="more">
                                                    +{{ count($package->facilities) - 3 }} lainnya
                                                </li>
                                            @endif
                                        </ul>
                                    @else
                                        <span style="color:#CBD5E1; font-size:0.8rem;">—</span>
                                    @endif
                                </td>

                                {{-- Aksi --}}
                                <td>
                                    <div style="display:flex; align-items:center; justify-content:center; gap:6px;">
                                        <a href="{{ route('studio.packages.edit', $package) }}"
                                           class="act-btn edit" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('studio.packages.destroy', $package) }}"
                                              method="POST" style="margin:0;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="act-btn delete" title="Hapus"
                                                    onclick="return confirm('Yakin ingin menghapus paket \'{{ addslashes($package->name) }}\'?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($packages->hasPages())
                <div class="card-foot">
                    {{ $packages->links() }}
                </div>
            @endif
        @endif
    </div>

@stop

@push('js')
<script>
function filterRows() {
    var search = document.getElementById('searchInput').value.toLowerCase();
    var type   = document.getElementById('typeFilter').value.toLowerCase();
    document.querySelectorAll('.pkg-row').forEach(function (row) {
        var matchName = row.dataset.name.includes(search);
        var matchType = !type || row.dataset.type === type;
        row.style.display = matchName && matchType ? '' : 'none';
    });
}
</script>
@endpush