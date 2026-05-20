@extends('adminlte::page')

@section('title', 'Manajemen User')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="mb-0" style="font-size: 1.4rem; font-weight: 700; color: #0D1B2A;">
                <i class="fas fa-users me-2" style="color: #0E7A96;"></i> Manajemen User
            </h1>
            <ol class="breadcrumb mb-0 mt-1" style="font-size: 0.8rem; background: transparent; padding: 0;">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">User</li>
            </ol>
        </div>
        <a href="{{ route('admin.users.create') }}"
           style="display:inline-flex; align-items:center; gap:7px; background:#0E7A96; color:#fff; padding:10px 22px; border-radius:50px; font-weight:700; font-size:0.88rem; text-decoration:none; border:none; transition:all 0.3s;">
            <i class="fas fa-plus"></i> Tambah User
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
        margin-bottom: 16px;
    }
    .alert-error-custom {
        border-radius: 12px;
        border: none;
        background: #FEE2E2;
        color: #991B1B;
        font-size: 0.88rem;
        padding: 12px 18px;
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 16px;
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
        padding: 12px 18px;
        font-size: 0.82rem;
        color: #64748B;
        display: flex;
        align-items: center;
        gap: 10px;
        font-weight: 500;
        flex: 1;
        min-width: 120px;
    }
    .stat-chip-icon {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.9rem;
        flex-shrink: 0;
    }
    .stat-chip-icon.teal    { background: rgba(14,122,150,0.1);  color: #0E7A96; }
    .stat-chip-icon.blue    { background: rgba(37,99,235,0.1);   color: #2563EB; }
    .stat-chip-icon.green   { background: rgba(5,150,105,0.1);   color: #059669; }
    .stat-chip-icon.amber   { background: rgba(217,119,6,0.1);   color: #D97706; }
    .stat-chip-icon.slate   { background: rgba(100,116,139,0.1); color: #64748B; }

    .stat-chip-info strong  { font-size: 1.1rem; font-weight: 800; color: #0D1B2A; display: block; line-height: 1.2; }
    .stat-chip-info span    { font-size: 0.75rem; color: #94A3B8; }

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
    .filter-bar input       { flex: 1; min-width: 200px; }
    .filter-bar input:focus,
    .filter-bar select:focus { border-color: #0E7A96; background: #fff; }

    .filter-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #0E7A96;
        color: #fff;
        padding: 8px 18px;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 600;
        border: none;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.2s;
        white-space: nowrap;
    }
    .filter-btn:hover { background: #0a6278; color: #fff; text-decoration: none; }

    .reset-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: transparent;
        color: #64748B;
        padding: 8px 14px;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 600;
        border: 1.5px solid #E2E8F0;
        text-decoration: none;
        transition: all 0.2s;
        white-space: nowrap;
    }
    .reset-btn:hover { background: #F1F5F9; color: #0D1B2A; text-decoration: none; }

    /* ============================================
       MAIN CARD
       ============================================ */
    .users-card {
        background: #fff;
        border: 1px solid #E2E8F0;
        border-radius: 20px;
        overflow: hidden;
    }

    /* ============================================
       TABLE
       ============================================ */
    .users-table { width: 100%; border-collapse: collapse; }

    .users-table thead th {
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

    .users-table tbody tr {
        border-bottom: 1px solid #F8FAFC;
        transition: background 0.15s;
    }
    .users-table tbody tr:last-child { border-bottom: none; }
    .users-table tbody tr:hover { background: #FAFCFE; }

    .users-table tbody td {
        padding: 13px 20px;
        vertical-align: middle;
        font-size: 0.88rem;
        color: #0D1B2A;
    }

    /* Avatar + name */
    .user-avatar {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: linear-gradient(135deg, #0E7A96, #0a6278);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 0.82rem;
        font-weight: 700;
        flex-shrink: 0;
        text-transform: uppercase;
    }
    .user-name {
        font-weight: 700;
        color: #0D1B2A;
        font-size: 0.88rem;
        line-height: 1.3;
    }

    /* Email */
    .user-email {
        font-size: 0.82rem;
        color: #64748B;
    }

    /* Phone */
    .user-phone {
        font-size: 0.82rem;
        color: #64748B;
        white-space: nowrap;
    }

    /* Role badges */
    .role-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 4px 10px;
        border-radius: 50px;
        font-size: 0.72rem;
        font-weight: 700;
        white-space: nowrap;
        margin: 1px;
    }
    .role-admin   { background: rgba(37,99,235,0.1);   color: #2563EB; }
    .role-studio  { background: rgba(5,150,105,0.1);   color: #059669; }
    .role-apparel { background: rgba(217,119,6,0.1);   color: #D97706; }
    .role-user    { background: rgba(100,116,139,0.1); color: #64748B; }
    .role-other   { background: rgba(14,122,150,0.1);  color: #0E7A96; }

    /* Date */
    .user-date {
        font-size: 0.82rem;
        color: #64748B;
        white-space: nowrap;
        display: flex;
        align-items: center;
        gap: 5px;
    }
    .user-date i { color: #CBD5E1; font-size: 0.75rem; }

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

    /* ============================================
       ACTIVE FILTERS TAG
       ============================================ */
    .active-filter-tag {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(14,122,150,0.08);
        color: #0E7A96;
        padding: 4px 12px;
        border-radius: 50px;
        font-size: 0.78rem;
        font-weight: 600;
    }

    @media (max-width: 640px) {
        .stats-bar { gap: 8px; }
        .stat-chip { min-width: 140px; }
    }
</style>
@endpush

@section('content')

    {{-- Alerts --}}
    @if(session('success'))
        <div class="alert-success-custom">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
            <button type="button" class="close ml-auto" data-dismiss="alert"
                    style="background:none; border:none; cursor:pointer; color:#065F46; font-size:1rem;">&times;</button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert-error-custom">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
            <button type="button" class="close ml-auto" data-dismiss="alert"
                    style="background:none; border:none; cursor:pointer; color:#991B1B; font-size:1rem;">&times;</button>
        </div>
    @endif

    {{-- Stats Bar --}}
    <div class="stats-bar">
        <div class="stat-chip">
            <div class="stat-chip-icon teal"><i class="fas fa-users"></i></div>
            <div class="stat-chip-info">
                <strong>{{ $stats['total'] }}</strong>
                <span>Total User</span>
            </div>
        </div>
        <div class="stat-chip">
            <div class="stat-chip-icon blue"><i class="fas fa-user-shield"></i></div>
            <div class="stat-chip-info">
                <strong>{{ $stats['admin'] }}</strong>
                <span>Admin</span>
            </div>
        </div>
        <div class="stat-chip">
            <div class="stat-chip-icon green"><i class="fas fa-camera"></i></div>
            <div class="stat-chip-info">
                <strong>{{ $stats['studio'] }}</strong>
                <span>Studio</span>
            </div>
        </div>
        <div class="stat-chip">
            <div class="stat-chip-icon amber"><i class="fas fa-tshirt"></i></div>
            <div class="stat-chip-info">
                <strong>{{ $stats['apparel'] }}</strong>
                <span>Apparel</span>
            </div>
        </div>
        <div class="stat-chip">
            <div class="stat-chip-icon slate"><i class="fas fa-user"></i></div>
            <div class="stat-chip-info">
                <strong>{{ $stats['user'] }}</strong>
                <span>User Biasa</span>
            </div>
        </div>
    </div>

    {{-- Filter Bar --}}
    <form method="GET" action="{{ route('admin.users.index') }}">
        <div class="filter-bar">
            <i class="fas fa-search" style="color:#CBD5E1; font-size:0.9rem; flex-shrink:0;"></i>
            <input type="text" name="search"
                   placeholder="Cari nama atau email..."
                   value="{{ request('search') }}">
            <select name="role">
                <option value="">Semua Role</option>
                @foreach($roles as $role)
                    <option value="{{ $role->name }}" {{ request('role') == $role->name ? 'selected' : '' }}>
                        {{ ucfirst(str_replace('_', ' ', $role->name)) }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="filter-btn">
                <i class="fas fa-filter"></i> Filter
            </button>
            @if(request('search') || request('role'))
                <a href="{{ route('admin.users.index') }}" class="reset-btn">
                    <i class="fas fa-times"></i> Reset
                </a>
            @endif
        </div>
    </form>

    {{-- Active filter tag --}}
    @if(request('search') || request('role'))
        <div style="margin-bottom: 14px; display:flex; align-items:center; gap:8px; flex-wrap:wrap;">
            <span style="font-size:0.78rem; color:#94A3B8;">Filter aktif:</span>
            @if(request('search'))
                <span class="active-filter-tag">
                    <i class="fas fa-search" style="font-size:0.68rem;"></i>
                    "{{ request('search') }}"
                </span>
            @endif
            @if(request('role'))
                <span class="active-filter-tag">
                    <i class="fas fa-tag" style="font-size:0.68rem;"></i>
                    {{ ucfirst(str_replace('_', ' ', request('role'))) }}
                </span>
            @endif
            <span style="font-size:0.78rem; color:#94A3B8;">— {{ $users->total() }} hasil ditemukan</span>
        </div>
    @endif

    {{-- Table Card --}}
    <div class="users-card">
        @if($users->isEmpty())
            <div class="empty-state">
                <div class="empty-icon-wrap"><i class="fas fa-users"></i></div>
                <h5>Tidak Ada User Ditemukan</h5>
                <p>
                    @if(request('search') || request('role'))
                        Coba ubah kata kunci atau filter pencarian Anda.
                    @else
                        Mulai tambahkan user pertama Anda.
                    @endif
                </p>
                @if(!request('search') && !request('role'))
                    <a href="{{ route('admin.users.create') }}"
                       style="display:inline-flex; align-items:center; gap:6px; background:#0E7A96; color:#fff; padding:10px 24px; border-radius:50px; font-weight:700; font-size:0.88rem; text-decoration:none;">
                        <i class="fas fa-plus"></i> Tambah User
                    </a>
                @else
                    <a href="{{ route('admin.users.index') }}"
                       style="display:inline-flex; align-items:center; gap:6px; background:#64748B; color:#fff; padding:10px 24px; border-radius:50px; font-weight:700; font-size:0.88rem; text-decoration:none;">
                        <i class="fas fa-times"></i> Hapus Filter
                    </a>
                @endif
            </div>
        @else
            <div style="overflow-x: auto;">
                <table class="users-table">
                    <thead>
                        <tr>
                            <th style="width:40px;">#</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No. HP</th>
                            <th>Role</th>
                            <th>Tanggal Daftar</th>
                            <th style="width:90px; text-align:center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $index => $user)
                            <tr>
                                <td style="color:#CBD5E1; font-size:0.8rem; font-weight:600;">
                                    {{ $users->firstItem() + $index }}
                                </td>
                                <td>
                                    <div style="display:flex; align-items:center; gap:10px;">
                                        <div class="user-avatar">
                                            {{ mb_substr($user->name, 0, 2) }}
                                        </div>
                                        <div class="user-name">{{ $user->name }}</div>
                                    </div>
                                </td>
                                <td>
                                    <span class="user-email">{{ $user->email }}</span>
                                </td>
                                <td>
                                    <span class="user-phone">
                                        {{ $user->phone ?? '—' }}
                                    </span>
                                </td>
                                <td>
                                    @foreach($user->roles as $role)
                                        @php
                                            $roleClass = match($role->name) {
                                                'admin_qofmedia' => 'role-admin',
                                                'admin_studio'   => 'role-studio',
                                                'admin_apparel'  => 'role-apparel',
                                                'user'           => 'role-user',
                                                default          => 'role-other'
                                            };
                                            $roleIcon = match($role->name) {
                                                'admin_qofmedia' => 'fa-user-shield',
                                                'admin_studio'   => 'fa-camera',
                                                'admin_apparel'  => 'fa-tshirt',
                                                'user'           => 'fa-user',
                                                default          => 'fa-tag'
                                            };
                                            $roleName = match($role->name) {
                                                'admin_qofmedia' => 'Admin',
                                                'admin_studio'   => 'Studio',
                                                'admin_apparel'  => 'Apparel',
                                                'user'           => 'User',
                                                default          => $role->name
                                            };
                                        @endphp
                                        <span class="role-badge {{ $roleClass }}">
                                            <i class="fas {{ $roleIcon }}" style="font-size:0.65rem;"></i>
                                            {{ $roleName }}
                                        </span>
                                    @endforeach
                                </td>
                                <td>
                                    <div class="user-date">
                                        <i class="fas fa-calendar-alt"></i>
                                        {{ $user->created_at->format('d M Y') }}
                                    </div>
                                </td>
                                <td>
                                    <div style="display:flex; align-items:center; justify-content:center; gap:6px;">
                                        <a href="{{ route('admin.users.edit', $user) }}"
                                           class="act-btn edit" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @if($user->id !== auth()->id())
                                            <form action="{{ route('admin.users.destroy', $user) }}"
                                                  method="POST" style="margin:0;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="act-btn delete" title="Hapus"
                                                        onclick="return confirm('Yakin ingin menghapus user \'{{ addslashes($user->name) }}\'?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        @else
                                            {{-- Placeholder agar layout tidak geser --}}
                                            <span style="width:32px; display:inline-block;"></span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($users->hasPages())
                <div class="card-foot">
                    {{ $users->links() }}
                </div>
            @endif
        @endif
    </div>

@stop