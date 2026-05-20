@extends('adminlte::page')

@section('title', 'Pesan Kontak')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="mb-0" style="font-size: 1.4rem; font-weight: 700; color: #0D1B2A;">
                <i class="fas fa-envelope me-2" style="color: #0E7A96;"></i> Pesan Kontak
            </h1>
            <ol class="breadcrumb mb-0 mt-1" style="font-size: 0.8rem; background: transparent; padding: 0;">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Pesan Kontak</li>
            </ol>
        </div>
        <a href="{{ route('home') }}" target="_blank"
           style="display:inline-flex; align-items:center; gap:6px; background:#fff; border:1.5px solid #E2E8F0; color:#0E7A96; padding:9px 20px; border-radius:50px; font-weight:700; font-size:0.85rem; text-decoration:none; transition:all 0.3s;">
            <i class="fas fa-globe"></i> Lihat Website
        </a>
    </div>
@stop

@push('css')
<style>
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
    .sec-label::after { content:''; flex:1; height:1px; background:#E2E8F0; }

    /* Dash Card */
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

    /* Table */
    .dash-table { width: 100%; border-collapse: collapse; }
    .dash-table thead th {
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.07em;
        color: #94A3B8;
        padding: 10px 22px;
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
    .dash-table tbody tr.unread { background: #FFFBEB; }
    .dash-table tbody tr.unread:hover { background: #FEF3C7; }
    .dash-table tbody td {
        padding: 13px 22px;
        font-size: 0.85rem;
        color: #0D1B2A;
        vertical-align: middle;
    }
    .td-muted { font-size: 0.75rem; color: #94A3B8; margin-top: 2px; }

    /* Row number */
    .row-num {
        display: inline-flex; align-items: center; justify-content: center;
        width: 28px; height: 28px;
        border-radius: 8px; background: #F1F5F9;
        color: #64748B; font-size: 0.75rem; font-weight: 700;
    }

    /* Status badges */
    .badge-read {
        display: inline-flex; align-items: center; gap: 4px;
        background: #D1FAE5; color: #065F46;
        padding: 4px 10px; border-radius: 50px;
        font-size: 0.72rem; font-weight: 700;
    }
    .badge-unread {
        display: inline-flex; align-items: center; gap: 4px;
        background: #FEF3C7; color: #92400E;
        padding: 4px 10px; border-radius: 50px;
        font-size: 0.72rem; font-weight: 700;
    }
    .unread-dot {
        display: inline-block;
        width: 7px; height: 7px;
        border-radius: 50%;
        background: #D97706;
        margin-right: 2px;
        animation: pulse 1.8s infinite;
    }
    @keyframes pulse {
        0%, 100% { opacity: 1; transform: scale(1); }
        50%       { opacity: 0.5; transform: scale(0.75); }
    }

    /* Action buttons */
    .btn-xs-act {
        display: inline-flex; align-items: center; justify-content: center;
        width: 32px; height: 32px;
        border-radius: 8px; font-size: 0.78rem;
        border: none; text-decoration: none;
        cursor: pointer; transition: all 0.2s;
    }
    .btn-xs-act.view   { background: rgba(14,122,150,0.08); color: #0E7A96; }
    .btn-xs-act.check  { background: rgba(5,150,105,0.08);  color: #059669; }
    .btn-xs-act.delete { background: rgba(220,38,38,0.08);  color: #DC2626; }
    .btn-xs-act:hover  { filter: brightness(0.88); }

    /* Empty row */
    .empty-row td {
        text-align: center;
        padding: 52px 20px !important;
        color: #94A3B8; font-size: 0.85rem;
    }
    .empty-icon-sm {
        font-size: 2.4rem; display: block;
        margin-bottom: 10px; opacity: 0.3;
    }

    /* Pagination override */
    .dash-card-footer {
        padding: 14px 22px;
        border-top: 1px solid #F1F5F9;
        background: #F8FAFC;
    }
    .dash-card-footer .pagination {
        margin: 0;
        gap: 4px;
    }
    .dash-card-footer .page-link {
        border-radius: 8px !important;
        border: 1.5px solid #E2E8F0;
        color: #0E7A96;
        font-size: 0.8rem;
        font-weight: 600;
        padding: 5px 11px;
        transition: all 0.2s;
    }
    .dash-card-footer .page-item.active .page-link {
        background: linear-gradient(135deg, #0E7A96, #4EB8CC);
        border-color: transparent;
        color: #fff;
    }
    .dash-card-footer .page-item.disabled .page-link { color: #CBD5E1; }

    /* Alert */
    .alert-custom {
        border-radius: 12px; font-size: 0.85rem;
        padding: 12px 16px; border: none; margin-bottom: 20px;
        display: flex; align-items: center; gap: 8px;
    }
    .alert-custom.success { background: #D1FAE5; color: #065F46; }
</style>
@endpush

@section('content')

    @if(session('success'))
        <div class="alert-custom success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    <p class="sec-label">Daftar Pesan Masuk</p>

    <div class="dash-card">
        <div class="dash-card-header">
            <div class="dash-card-title">
                <i class="fas fa-envelope"></i> Semua Pesan
                @php $unreadCount = $contacts->where('read_at', null)->count(); @endphp
                @if($unreadCount > 0)
                    <span style="background:#FEF3C7; color:#92400E; padding:2px 10px; border-radius:50px; font-size:0.72rem; font-weight:700;">
                        {{ $unreadCount }} belum dibaca
                    </span>
                @else
                    <span style="background:#D1FAE5; color:#065F46; padding:2px 10px; border-radius:50px; font-size:0.72rem; font-weight:700;">
                        Semua terbaca
                    </span>
                @endif
            </div>
        </div>

        <table class="dash-table">
            <thead>
                <tr>
                    <th width="50">#</th>
                    <th width="110">Status</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>No. HP</th>
                    <th>Tanggal</th>
                    <th width="120">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($contacts as $contact)
                    <tr class="{{ $contact->read_at ? '' : 'unread' }}">
                        <td><span class="row-num">{{ $loop->iteration }}</span></td>
                        <td>
                            @if($contact->read_at)
                                <span class="badge-read">
                                    <i class="fas fa-check"></i> Dibaca
                                </span>
                            @else
                                <span class="badge-unread">
                                    <span class="unread-dot"></span> Belum
                                </span>
                            @endif
                        </td>
                        <td>
                            <div style="font-weight: {{ $contact->read_at ? '600' : '700' }};">
                                {{ $contact->name }}
                            </div>
                        </td>
                        <td>
                            <div class="{{ $contact->read_at ? 'td-muted' : '' }}" style="font-size:0.82rem;">
                                {{ $contact->email }}
                            </div>
                        </td>
                        <td>
                            <div class="td-muted">{{ $contact->phone ?? '-' }}</div>
                        </td>
                        <td>
                            <div class="td-muted">
                                <i class="far fa-calendar-alt me-1"></i>{{ $contact->created_at->format('d M Y') }}
                            </div>
                            <div class="td-muted">{{ $contact->created_at->format('H:i') }} WIB</div>
                        </td>
                        <td style="white-space: nowrap;">
                            <a href="{{ route('admin.contacts.show', $contact) }}"
                               class="btn-xs-act view" title="Lihat Pesan">
                                <i class="fas fa-eye"></i>
                            </a>

                            @if(!$contact->read_at)
                                <form action="{{ route('admin.contacts.read', $contact) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn-xs-act check ms-1" title="Tandai Sudah Dibaca">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </form>
                            @endif

                            <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-xs-act delete ms-1"
                                        title="Hapus"
                                        onclick="return confirm('Yakin ingin menghapus pesan ini?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr class="empty-row">
                        <td colspan="7">
                            <i class="fas fa-envelope-open-text empty-icon-sm"></i>
                            Belum ada pesan masuk
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if($contacts->hasPages())
            <div class="dash-card-footer">
                {{ $contacts->links() }}
            </div>
        @endif
    </div>

@stop