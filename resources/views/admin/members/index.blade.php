@extends('adminlte::page')

@section('title', 'Manajemen Anggota Tim')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="mb-0" style="font-size: 1.4rem; font-weight: 700; color: #0D1B2A;">
                <i class="fas fa-users me-2" style="color: #0E7A96;"></i> Manajemen Anggota Tim
            </h1>
            <ol class="breadcrumb mb-0 mt-1" style="font-size: 0.8rem; background: transparent; padding: 0;">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Anggota Tim</li>
            </ol>
        </div>
        <a href="{{ route('admin.members.create') }}"
           style="display:inline-flex; align-items:center; gap:7px; background:#0E7A96; color:#fff; padding:10px 22px; border-radius:50px; font-weight:700; font-size:0.88rem; text-decoration:none; border:none; transition:all 0.3s;">
            <i class="fas fa-plus"></i> Tambah Anggota
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
    .members-card {
        background: #fff;
        border: 1px solid #E2E8F0;
        border-radius: 20px;
        overflow: hidden;
    }

    /* ============================================
       TABLE
       ============================================ */
    .members-table { width: 100%; border-collapse: collapse; }

    .members-table thead th {
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

    .members-table tbody tr {
        border-bottom: 1px solid #F8FAFC;
        transition: background 0.15s;
    }
    .members-table tbody tr:last-child { border-bottom: none; }
    .members-table tbody tr:hover { background: #FAFCFE; }

    .members-table tbody td {
        padding: 14px 20px;
        vertical-align: middle;
        font-size: 0.88rem;
        color: #0D1B2A;
    }

    /* Avatar */
    .mem-avatar {
        width: 52px; height: 52px;
        border-radius: 10px;
        object-fit: cover;
        display: block;
        border: 1px solid #E2E8F0;
    }
    .mem-avatar-initial {
        width: 52px; height: 52px;
        border-radius: 10px;
        background: linear-gradient(135deg, #0E7A96, #0a5a70);
        display: flex; align-items: center; justify-content: center;
        color: #fff;
        font-size: 1.1rem;
        font-weight: 700;
        flex-shrink: 0;
        letter-spacing: -0.02em;
    }

    /* Name cell */
    .mem-name {
        font-weight: 700;
        color: #0D1B2A;
        font-size: 0.9rem;
        margin-bottom: 3px;
        line-height: 1.4;
    }
    .mem-position {
        font-size: 0.76rem;
        color: #94A3B8;
        line-height: 1.5;
    }

    /* Nickname */
    .mem-nickname {
        font-size: 0.83rem;
        color: #64748B;
        font-weight: 500;
    }

    /* Division badge */
    .badge-div {
        display: inline-block;
        padding: 3px 10px;
        background: rgba(14,122,150,0.08);
        color: #0E7A96;
        border-radius: 50px;
        font-size: 0.7rem;
        font-weight: 700;
        white-space: nowrap;
        margin: 2px 2px 2px 0;
    }

    /* Status badge */
    .badge-status {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        border-radius: 50px;
        padding: 4px 12px;
        font-size: 0.72rem;
        font-weight: 700;
        white-space: nowrap;
    }
    .badge-status.active   { background: rgba(5,150,105,0.09); color: #059669; }
    .badge-status.inactive { background: rgba(100,116,139,0.09); color: #64748B; }
    .badge-status .dot {
        width: 6px; height: 6px;
        border-radius: 50%;
    }
    .badge-status.active   .dot { background: #059669; }
    .badge-status.inactive .dot { background: #94A3B8; }

    /* Social link */
    .mem-social {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 0.82rem;
        color: #0E7A96;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.2s;
    }
    .mem-social:hover { color: #0a5a70; text-decoration: none; }

    /* Order badge */
    .badge-order {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 28px; height: 28px;
        border-radius: 8px;
        background: #F1F5F9;
        color: #64748B;
        font-size: 0.78rem;
        font-weight: 700;
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
            <button type="button" class="close ml-auto" data-dismiss="alert"
                    style="background:none; border:none; cursor:pointer; color:#065F46; font-size:1rem;">&times;</button>
        </div>
    @endif

    {{-- Stats --}}
    <div class="stats-bar">
        <div class="stat-chip">
            <i class="fas fa-users"></i>
            Total Anggota: <strong>{{ $members->total() }}</strong>
        </div>
        <div class="stat-chip">
            <i class="fas fa-user-check"></i>
            Halaman ini: <strong>{{ $members->count() }}</strong>
        </div>
    </div>

    {{-- Filter --}}
    <div class="filter-bar">
        <i class="fas fa-search" style="color:#CBD5E1; font-size:0.9rem; flex-shrink:0;"></i>
        <input type="text" id="searchInput" placeholder="Cari nama atau panggilan..." oninput="filterRows()">
        <select id="divFilter" onchange="filterRows()">
            <option value="">Semua Divisi</option>
            @foreach($divisions as $div)
                <option value="{{ strtolower($div->name) }}">{{ $div->name }}</option>
            @endforeach
        </select>
        <select id="statusFilter" onchange="filterRows()">
            <option value="">Semua Status</option>
            <option value="aktif">Aktif</option>
            <option value="nonaktif">Nonaktif</option>
        </select>
    </div>

    {{-- Table Card --}}
    <div class="members-card">
        @if($members->isEmpty())
            <div class="empty-state">
                <div class="empty-icon-wrap"><i class="fas fa-users"></i></div>
                <h5>Belum Ada Anggota Tim</h5>
                <p>Mulai tambahkan anggota tim pertama Anda.</p>
                <a href="{{ route('admin.members.create') }}"
                   style="display:inline-flex; align-items:center; gap:6px; background:#0E7A96; color:#fff; padding:10px 24px; border-radius:50px; font-weight:700; font-size:0.88rem; text-decoration:none;">
                    <i class="fas fa-plus"></i> Tambah Anggota
                </a>
            </div>
        @else
            <div style="overflow-x: auto;">
                <table class="members-table" id="membersTable">
                    <thead>
                        <tr>
                            <th style="width:40px;">#</th>
                            <th style="width:60px;"></th>
                            <th>Nama</th>
                            <th>Panggilan</th>
                            <th>Divisi</th>
                            <th>Media Sosial</th>
                            <th>Status</th>
                            <th style="width:60px; text-align:center;">Urutan</th>
                            <th style="width:90px; text-align:center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($members as $member)
                            @php
                                $divNames = $member->divisions->pluck('name')->map(fn($n) => strtolower($n))->implode(' ');
                                $statusLabel = $member->is_active ? 'aktif' : 'nonaktif';
                            @endphp
                            <tr class="mem-row"
                                data-name="{{ strtolower($member->name . ' ' . $member->nickname) }}"
                                data-div="{{ $divNames }}"
                                data-status="{{ $statusLabel }}">
                                <td style="color:#CBD5E1; font-size:0.8rem; font-weight:600;">
                                    {{ $loop->iteration + ($members->currentPage() - 1) * $members->perPage() }}
                                </td>
                                <td>
                                    @if($member->photo_url)
                                        <img src="{{ $member->photo_url }}"
                                             class="mem-avatar" alt="{{ $member->name }}">
                                    @else
                                        <div class="mem-avatar-initial">
                                            {{ strtoupper(substr($member->nickname ?? $member->name, 0, 1)) }}
                                        </div>
                                    @endif
                                </td>
                                <td style="max-width: 200px;">
                                    <div class="mem-name">{{ $member->name }}</div>
                                    @if($member->position)
                                        <div class="mem-position">{{ $member->position }}</div>
                                    @endif
                                </td>
                                <td>
                                    <span class="mem-nickname">{{ $member->nickname }}</span>
                                </td>
                                <td style="max-width: 180px;">
                                    @forelse($member->divisions as $div)
                                        <span class="badge-div">{{ $div->name }}</span>
                                    @empty
                                        <span style="color:#CBD5E1; font-size:0.8rem;">—</span>
                                    @endforelse
                                </td>
                                <td>
                                    @if($member->social_platform && $member->social_username)
                                        <a href="{{ $member->social_url }}" target="_blank" class="mem-social">
                                            <i class="fab fa-{{ $member->social_platform }}"></i>
                                            {{ ucfirst($member->social_platform) }}
                                        </a>
                                    @else
                                        <span style="color:#CBD5E1; font-size:0.8rem;">—</span>
                                    @endif
                                </td>
                                <td>
                                    @if($member->is_active)
                                        <span class="badge-status active">
                                            <span class="dot"></span> Aktif
                                        </span>
                                    @else
                                        <span class="badge-status inactive">
                                            <span class="dot"></span> Nonaktif
                                        </span>
                                    @endif
                                </td>
                                <td style="text-align:center;">
                                    <span class="badge-order">{{ $member->order }}</span>
                                </td>
                                <td>
                                    <div style="display:flex; align-items:center; justify-content:center; gap:6px;">
                                        <a href="{{ route('admin.members.edit', $member) }}"
                                           class="act-btn edit" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.members.destroy', $member) }}"
                                              method="POST" style="margin:0;"
                                              onsubmit="return confirm('Yakin ingin menghapus anggota \'{{ addslashes($member->name) }}\'?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="act-btn delete" title="Hapus">
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

            @if($members->hasPages())
                <div class="card-foot">
                    {{ $members->links() }}
                </div>
            @endif
        @endif
    </div>

@stop

@push('js')
<script>
function filterRows() {
    var search = document.getElementById('searchInput').value.toLowerCase();
    var div    = document.getElementById('divFilter').value.toLowerCase();
    var status = document.getElementById('statusFilter').value.toLowerCase();

    document.querySelectorAll('.mem-row').forEach(function (row) {
        var matchName   = row.dataset.name.includes(search);
        var matchDiv    = !div    || row.dataset.div.includes(div);
        var matchStatus = !status || row.dataset.status === status;
        row.style.display = matchName && matchDiv && matchStatus ? '' : 'none';
    });
}
</script>
@endpush