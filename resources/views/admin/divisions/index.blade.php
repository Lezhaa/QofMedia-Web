@extends('adminlte::page')

@section('title', 'Manajemen Divisi')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="mb-0" style="font-size: 1.4rem; font-weight: 700; color: #0D1B2A;">
                <i class="fas fa-layer-group me-2" style="color: #0E7A96;"></i> Manajemen Divisi
            </h1>
            <ol class="breadcrumb mb-0 mt-1" style="font-size: 0.8rem; background: transparent; padding: 0;">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Divisi</li>
            </ol>
        </div>
        <a href="{{ route('admin.divisions.create') }}"
           style="display:inline-flex; align-items:center; gap:7px; background:#0E7A96; color:#fff; padding:10px 22px; border-radius:50px; font-weight:700; font-size:0.88rem; text-decoration:none; border:none; transition:all 0.3s;">
            <i class="fas fa-plus"></i> Tambah Divisi
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
    .divisions-card {
        background: #fff;
        border: 1px solid #E2E8F0;
        border-radius: 20px;
        overflow: hidden;
    }

    /* ============================================
       TABLE
       ============================================ */
    .divisions-table { width: 100%; border-collapse: collapse; }

    .divisions-table thead th {
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

    .divisions-table tbody tr {
        border-bottom: 1px solid #F8FAFC;
        transition: background 0.15s;
    }
    .divisions-table tbody tr:last-child { border-bottom: none; }
    .divisions-table tbody tr:hover { background: #FAFCFE; }

    .divisions-table tbody td {
        padding: 14px 20px;
        vertical-align: middle;
        font-size: 0.88rem;
        color: #0D1B2A;
    }

    /* Division name cell */
    .div-name {
        font-weight: 700;
        color: #0D1B2A;
        font-size: 0.9rem;
        margin-bottom: 3px;
        line-height: 1.4;
    }
    .div-desc {
        font-size: 0.76rem;
        color: #94A3B8;
        line-height: 1.5;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Slug badge */
    .badge-slug {
        display: inline-block;
        padding: 4px 10px;
        background: #F1F5F9;
        color: #64748B;
        border-radius: 6px;
        font-size: 0.72rem;
        font-weight: 600;
        font-family: 'Courier New', monospace;
        letter-spacing: 0.02em;
        white-space: nowrap;
    }

    /* Instagram link */
    .ig-link {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 0.82rem;
        color: #C026D3;
        text-decoration: none;
        font-weight: 500;
    }
    .ig-link:hover { color: #a21caf; text-decoration: none; }
    .ig-link i { font-size: 0.88rem; }

    /* Member count badge */
    .badge-member {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 5px 12px;
        background: rgba(14,122,150,0.08);
        color: #0E7A96;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 700;
        white-space: nowrap;
    }
    .badge-member i { font-size: 0.7rem; }

    /* Status badge */
    .badge-active {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 4px 12px;
        background: rgba(5,150,105,0.1);
        color: #059669;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 700;
        white-space: nowrap;
    }
    .badge-inactive {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 4px 12px;
        background: rgba(100,116,139,0.1);
        color: #64748B;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 700;
        white-space: nowrap;
    }
    .status-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        display: inline-block;
        flex-shrink: 0;
    }
    .dot-active   { background: #059669; }
    .dot-inactive { background: #94A3B8; }

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
        <div class="alert-success-custom alert-dismissible">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="close ml-auto" data-dismiss="alert"
                    style="background:none; border:none; cursor:pointer; color:#065F46; font-size:1rem;">&times;</button>
        </div>
    @endif

    {{-- Stats --}}
    <div class="stats-bar">
        <div class="stat-chip">
            <i class="fas fa-layer-group"></i>
            Total Divisi: <strong>{{ $divisions->total() }}</strong>
        </div>
        <div class="stat-chip">
            <i class="fas fa-check-circle"></i>
            Aktif: <strong>{{ $divisions->where('is_active', true)->count() }}</strong>
        </div>
        <div class="stat-chip">
            <i class="fas fa-users"></i>
            Halaman ini: <strong>{{ $divisions->count() }}</strong>
        </div>
    </div>

    {{-- Filter --}}
    <div class="filter-bar">
        <i class="fas fa-search" style="color:#CBD5E1; font-size:0.9rem; flex-shrink:0;"></i>
        <input type="text" id="searchInput" placeholder="Cari nama divisi..." oninput="filterRows()">
        <select id="statusFilter" onchange="filterRows()">
            <option value="">Semua Status</option>
            <option value="aktif">Aktif</option>
            <option value="nonaktif">Nonaktif</option>
        </select>
    </div>

    {{-- Table Card --}}
    <div class="divisions-card">
        @if($divisions->isEmpty())
            <div class="empty-state">
                <div class="empty-icon-wrap"><i class="fas fa-layer-group"></i></div>
                <h5>Belum Ada Divisi</h5>
                <p>Mulai tambahkan divisi pertama Anda.</p>
                <a href="{{ route('admin.divisions.create') }}"
                   style="display:inline-flex; align-items:center; gap:6px; background:#0E7A96; color:#fff; padding:10px 24px; border-radius:50px; font-weight:700; font-size:0.88rem; text-decoration:none;">
                    <i class="fas fa-plus"></i> Tambah Divisi
                </a>
            </div>
        @else
            <div style="overflow-x: auto;">
                <table class="divisions-table" id="divisionsTable">
                    <thead>
                        <tr>
                            <th style="width:40px;">#</th>
                            <th>Nama Divisi</th>
                            <th>Slug</th>
                            <th>Instagram</th>
                            <th style="width:120px;">Jml Member</th>
                            <th style="width:100px;">Status</th>
                            <th style="width:100px; text-align:center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($divisions as $division)
                            <tr class="div-row"
                                data-name="{{ strtolower($division->name) }}"
                                data-status="{{ $division->is_active ? 'aktif' : 'nonaktif' }}">
                                <td style="color:#CBD5E1; font-size:0.8rem; font-weight:600;">
                                    {{ $loop->iteration + ($divisions->currentPage() - 1) * $divisions->perPage() }}
                                </td>
                                <td style="max-width: 240px;">
                                    <div class="div-name">{{ $division->name }}</div>
                                    @if($division->description)
                                        <div class="div-desc">{{ $division->description }}</div>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge-slug">{{ $division->slug }}</span>
                                </td>
                                <td>
                                    @if($division->instagram)
                                        <a href="https://instagram.com/{{ ltrim($division->instagram, '@') }}"
                                           target="_blank" class="ig-link">
                                            <i class="fab fa-instagram"></i>
                                            {{ $division->instagram }}
                                        </a>
                                    @else
                                        <span style="color:#CBD5E1; font-size:0.82rem;">—</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge-member">
                                        <i class="fas fa-users"></i>
                                        {{ $division->members_count }} member
                                    </span>
                                </td>
                                <td>
                                    @if($division->is_active)
                                        <span class="badge-active">
                                            <span class="status-dot dot-active"></span> Aktif
                                        </span>
                                    @else
                                        <span class="badge-inactive">
                                            <span class="status-dot dot-inactive"></span> Nonaktif
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <div style="display:flex; align-items:center; justify-content:center; gap:6px;">
                                        <a href="{{ route('admin.divisions.edit', $division) }}"
                                           class="act-btn edit" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.divisions.destroy', $division) }}"
                                              method="POST" style="margin:0;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="act-btn delete" title="Hapus"
                                                    onclick="return confirm('Yakin hapus divisi \'{{ addslashes($division->name) }}\'? Semua member di dalamnya juga akan terhapus.')">
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

            @if($divisions->hasPages())
                <div class="card-foot">
                    {{ $divisions->links() }}
                </div>
            @endif
        @endif
    </div>

@stop

@push('js')
<script>
function filterRows() {
    var search = document.getElementById('searchInput').value.toLowerCase();
    var status = document.getElementById('statusFilter').value.toLowerCase();
    document.querySelectorAll('.div-row').forEach(function (row) {
        var matchName   = row.dataset.name.includes(search);
        var matchStatus = !status || row.dataset.status === status;
        row.style.display = matchName && matchStatus ? '' : 'none';
    });
}
</script>
@endpush