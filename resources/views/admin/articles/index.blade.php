@extends('adminlte::page')

@section('title', 'Manajemen Informasi')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="mb-0" style="font-size: 1.4rem; font-weight: 700; color: #0D1B2A;">
                <i class="fas fa-newspaper me-2" style="color: #0E7A96;"></i> Manajemen Informasi
            </h1>
            <ol class="breadcrumb mb-0 mt-1" style="font-size: 0.8rem; background: transparent; padding: 0;">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Informasi</li>
            </ol>
        </div>
        <a href="{{ route('admin.articles.create') }}"
           style="display:inline-flex; align-items:center; gap:7px; background:#0E7A96; color:#fff; padding:10px 22px; border-radius:50px; font-weight:700; font-size:0.88rem; text-decoration:none; border:none; transition:all 0.3s;">
            <i class="fas fa-plus"></i> Tambah Informasi
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
    .articles-card {
        background: #fff;
        border: 1px solid #E2E8F0;
        border-radius: 20px;
        overflow: hidden;
    }

    /* ============================================
       TABLE
       ============================================ */
    .articles-table { width: 100%; border-collapse: collapse; }

    .articles-table thead th {
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

    .articles-table tbody tr {
        border-bottom: 1px solid #F8FAFC;
        transition: background 0.15s;
    }
    .articles-table tbody tr:last-child { border-bottom: none; }
    .articles-table tbody tr:hover { background: #FAFCFE; }

    .articles-table tbody td {
        padding: 14px 20px;
        vertical-align: middle;
        font-size: 0.88rem;
        color: #0D1B2A;
    }

    /* Thumbnail */
    .art-thumb {
        width: 52px; height: 52px;
        border-radius: 10px;
        object-fit: cover;
        display: block;
        border: 1px solid #E2E8F0;
    }
    .art-thumb-placeholder {
        width: 52px; height: 52px;
        border-radius: 10px;
        background: linear-gradient(135deg, #EEF9FC, #D6EEF5);
        display: flex; align-items: center; justify-content: center;
        color: #0E7A96; font-size: 1.2rem; opacity: 0.5;
        border: 1px solid #E2E8F0;
        flex-shrink: 0;
    }

    /* Title cell */
    .art-title {
        font-weight: 700;
        color: #0D1B2A;
        font-size: 0.9rem;
        margin-bottom: 3px;
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .art-excerpt {
        font-size: 0.76rem;
        color: #94A3B8;
        line-height: 1.5;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Category badge */
    .badge-cat {
        display: inline-block;
        padding: 4px 12px;
        background: rgba(14,122,150,0.08);
        color: #0E7A96;
        border-radius: 50px;
        font-size: 0.72rem;
        font-weight: 700;
        white-space: nowrap;
    }

    /* Date */
    .art-date {
        font-size: 0.82rem;
        color: #64748B;
        white-space: nowrap;
        display: flex;
        align-items: center;
        gap: 5px;
    }
    .art-date i { color: #CBD5E1; font-size: 0.75rem; }

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
    .act-btn.view   { background: rgba(5,150,105,0.09);  color: #059669; }
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

    /* Footer pagination wrapper */
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
            <button type="button" class="close ml-auto" data-dismiss="alert" style="background:none; border:none; cursor:pointer; color:#065F46; font-size:1rem;">&times;</button>
        </div>
    @endif

    {{-- Stats --}}
    <div class="stats-bar">
        <div class="stat-chip">
            <i class="fas fa-newspaper"></i>
            Total: <strong>{{ $articles->total() }}</strong>
        </div>
        <div class="stat-chip">
            <i class="fas fa-file-alt"></i>
            Halaman ini: <strong>{{ $articles->count() }}</strong>
        </div>
    </div>

    {{-- Filter --}}
    <div class="filter-bar">
        <i class="fas fa-search" style="color:#CBD5E1; font-size:0.9rem; flex-shrink:0;"></i>
        <input type="text" id="searchInput" placeholder="Cari judul artikel..." oninput="filterRows()">
        <select id="catFilter" onchange="filterRows()">
            <option value="">Semua Kategori</option>
            @foreach($articles->pluck('category')->unique()->sort() as $cat)
                <option value="{{ strtolower($cat) }}">{{ $cat }}</option>
            @endforeach
        </select>
    </div>

    {{-- Table Card --}}
    <div class="articles-card">
        @if($articles->isEmpty())
            <div class="empty-state">
                <div class="empty-icon-wrap"><i class="fas fa-newspaper"></i></div>
                <h5>Belum Ada Artikel</h5>
                <p>Mulai tambahkan artikel pertama Anda.</p>
                <a href="{{ route('admin.articles.create') }}"
                   style="display:inline-flex; align-items:center; gap:6px; background:#0E7A96; color:#fff; padding:10px 24px; border-radius:50px; font-weight:700; font-size:0.88rem; text-decoration:none;">
                    <i class="fas fa-plus"></i> Tambah Artikel
                </a>
            </div>
        @else
            <div style="overflow-x: auto;">
                <table class="articles-table" id="articlesTable">
                    <thead>
                        <tr>
                            <th style="width:40px;">#</th>
                            <th style="width:60px;"></th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Tanggal Publish</th>
                            <th style="width:110px; text-align:center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($articles as $article)
                            <tr class="art-row"
                                data-title="{{ strtolower($article->title) }}"
                                data-cat="{{ strtolower($article->category) }}">
                                <td style="color:#CBD5E1; font-size:0.8rem; font-weight:600;">
                                    {{ $loop->iteration + ($articles->currentPage() - 1) * $articles->perPage() }}
                                </td>
                                <td>
                                    @if($article->image ?? false)
                                        <img src="{{ asset('storage/' . $article->image) }}"
                                             class="art-thumb" alt="{{ $article->title }}">
                                    @else
                                        <div class="art-thumb-placeholder">
                                            <i class="fas fa-newspaper"></i>
                                        </div>
                                    @endif
                                </td>
                                <td style="max-width: 280px;">
                                    <div class="art-title">{{ $article->title }}</div>
                                    @if($article->excerpt ?? false)
                                        <div class="art-excerpt">{{ $article->excerpt }}</div>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge-cat">{{ $article->category }}</span>
                                </td>
                                <td>
                                    @if($article->published_at)
                                        <div class="art-date">
                                            <i class="fas fa-calendar-alt"></i>
                                            {{ \Carbon\Carbon::parse($article->published_at)->format('d M Y') }}
                                        </div>
                                    @else
                                        <span style="color:#CBD5E1; font-size:0.8rem;">—</span>
                                    @endif
                                </td>
                                <td>
                                    <div style="display:flex; align-items:center; justify-content:center; gap:6px;">
                                        <a href="{{ route('admin.articles.edit', $article) }}"
                                           class="act-btn edit" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('information.show', $article->slug) }}"
                                           target="_blank"
                                           class="act-btn view" title="Lihat">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <form action="{{ route('admin.articles.destroy', $article) }}"
                                              method="POST" style="margin:0;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="act-btn delete" title="Hapus"
                                                    onclick="return confirm('Yakin ingin menghapus artikel \'{{ addslashes($article->title) }}\'?')">
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

            @if($articles->hasPages())
                <div class="card-foot">
                    {{ $articles->links() }}
                </div>
            @endif
        @endif
    </div>

@stop

@push('js')
<script>
function filterRows() {
    var search = document.getElementById('searchInput').value.toLowerCase();
    var cat    = document.getElementById('catFilter').value.toLowerCase();
    document.querySelectorAll('.art-row').forEach(function (row) {
        var matchTitle = row.dataset.title.includes(search);
        var matchCat   = !cat || row.dataset.cat === cat;
        row.style.display = matchTitle && matchCat ? '' : 'none';
    });
}
</script>
@endpush