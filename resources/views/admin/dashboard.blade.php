@extends('adminlte::page')

@section('title', 'Dashboard Admin')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="mb-0" style="font-size: 1.4rem; font-weight: 700; color: #0D1B2A;">
                <i class="fas fa-th-large me-2" style="color: #0E7A96;"></i> Dashboard
            </h1>
            <ol class="breadcrumb mb-0 mt-1" style="font-size: 0.8rem; background: transparent; padding: 0;">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Overview</li>
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
    /* ============================================
       WELCOME BANNER
       ============================================ */
    .welcome-banner {
        background: linear-gradient(135deg, #0D1B2A 0%, #1B3A4B 55%, #0E7A96 100%);
        border-radius: 20px;
        padding: 32px 36px;
        position: relative;
        overflow: hidden;
        margin-bottom: 24px;
    }
    .welcome-banner::before {
        content: '';
        position: absolute;
        top: -40%; right: -10%;
        width: 400px; height: 400px;
        background: radial-gradient(circle, rgba(78,184,204,0.18) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }
    .welcome-banner::after {
        content: '';
        position: absolute;
        bottom: -50%; left: -5%;
        width: 280px; height: 280px;
        background: radial-gradient(circle, rgba(168,221,232,0.1) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }
    .welcome-banner .wb-content { position: relative; z-index: 1; }
    .welcome-banner h4 {
        color: #fff;
        font-weight: 800;
        font-size: 1.35rem;
        margin-bottom: 4px;
    }
    .welcome-banner p {
        color: rgba(255,255,255,0.65);
        font-size: 0.88rem;
        margin: 0;
    }
    .welcome-banner .wb-icon {
        position: absolute;
        right: 36px; top: 50%;
        transform: translateY(-50%);
        z-index: 1;
        font-size: 5rem;
        color: rgba(255,255,255,0.07);
    }
    .welcome-banner .wb-time {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(255,255,255,0.1);
        border: 1px solid rgba(255,255,255,0.15);
        color: #A8DDE8;
        padding: 4px 14px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
        margin-top: 12px;
        backdrop-filter: blur(8px);
    }

    /* ============================================
       STAT CARDS
       ============================================ */
    .stat-card {
        background: #fff;
        border: 1px solid #E2E8F0;
        border-radius: 18px;
        padding: 22px 22px 18px;
        display: flex;
        align-items: flex-start;
        gap: 16px;
        transition: all 0.28s cubic-bezier(0.22, 1, 0.36, 1);
        text-decoration: none;
        position: relative;
        overflow: hidden;
        margin-bottom: 0;
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
    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 32px rgba(0,0,0,0.09);
        border-color: transparent;
        text-decoration: none;
    }
    .stat-card:hover::after { opacity: 1; }

    .stat-card.blue  { --c: #0E7A96; --bg: #EEF9FC; }
    .stat-card.green { --c: #059669; --bg: #D1FAE5; }
    .stat-card.amber { --c: #D97706; --bg: #FEF3C7; }
    .stat-card.red   { --c: #DC2626; --bg: #FEE2E2; }

    .stat-card.blue::after  { background: #0E7A96; }
    .stat-card.green::after { background: #059669; }
    .stat-card.amber::after { background: #D97706; }
    .stat-card.red::after   { background: #DC2626; }

    .stat-card:hover.blue  { box-shadow: 0 12px 32px rgba(14,122,150,0.14); border-color: #4EB8CC; }
    .stat-card:hover.green { box-shadow: 0 12px 32px rgba(5,150,105,0.14);  border-color: #34D399; }
    .stat-card:hover.amber { box-shadow: 0 12px 32px rgba(217,119,6,0.14);  border-color: #FBbf24; }
    .stat-card:hover.red   { box-shadow: 0 12px 32px rgba(220,38,38,0.14);  border-color: #F87171; }

    .stat-icon {
        width: 52px; height: 52px;
        border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.3rem;
        flex-shrink: 0;
        background: var(--bg);
        color: var(--c);
        transition: transform 0.3s;
    }
    .stat-card:hover .stat-icon { transform: scale(1.1) rotate(-4deg); }

    .stat-info { flex: 1; min-width: 0; }
    .stat-number {
        font-size: 2rem;
        font-weight: 800;
        color: #0D1B2A;
        line-height: 1;
        margin-bottom: 4px;
    }
    .stat-label {
        font-size: 0.8rem;
        color: #64748B;
        font-weight: 500;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .stat-link {
        font-size: 0.72rem;
        color: var(--c);
        font-weight: 600;
        margin-top: 8px;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

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
       TABLE CARDS
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
    .dash-card-link {
        font-size: 0.78rem;
        font-weight: 600;
        color: #0E7A96;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        transition: gap 0.2s;
    }
    .dash-card-link:hover { gap: 7px; color: #0A5A70; text-decoration: none; }

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
    }
    .dash-table tbody tr {
        border-bottom: 1px solid #F8FAFC;
        transition: background 0.18s;
    }
    .dash-table tbody tr:last-child { border-bottom: none; }
    .dash-table tbody tr:hover { background: #F8FAFC; }
    .dash-table tbody td {
        padding: 12px 22px;
        font-size: 0.85rem;
        color: #0D1B2A;
        vertical-align: middle;
    }
    .dash-table .td-muted {
        font-size: 0.75rem;
        color: #94A3B8;
        margin-top: 2px;
    }

    /* Badges */
    .badge-read {
        display: inline-flex; align-items: center; gap: 4px;
        background: #D1FAE5; color: #065F46;
        padding: 3px 10px; border-radius: 50px;
        font-size: 0.72rem; font-weight: 700;
    }
    .badge-unread {
        display: inline-flex; align-items: center; gap: 4px;
        background: #FEF3C7; color: #92400E;
        padding: 3px 10px; border-radius: 50px;
        font-size: 0.72rem; font-weight: 700;
    }
    .badge-cat {
        display: inline-block;
        background: rgba(14,122,150,0.08); color: #0E7A96;
        padding: 3px 10px; border-radius: 50px;
        font-size: 0.72rem; font-weight: 700;
    }
    .btn-xs-act {
        display: inline-flex; align-items: center; justify-content: center;
        width: 30px; height: 30px;
        border-radius: 8px;
        font-size: 0.78rem;
        border: none;
        text-decoration: none;
        transition: all 0.2s;
    }
    .btn-xs-act.view  { background: rgba(14,122,150,0.08); color: #0E7A96; }
    .btn-xs-act.edit  { background: rgba(217,119,6,0.08);  color: #D97706; }
    .btn-xs-act.open  { background: rgba(5,150,105,0.08);  color: #059669; }
    .btn-xs-act:hover { filter: brightness(0.9); text-decoration: none; }

    /* Empty row */
    .empty-row td {
        text-align: center;
        padding: 40px 20px !important;
        color: #94A3B8;
        font-size: 0.85rem;
    }
    .empty-row .empty-icon-sm {
        font-size: 2rem;
        display: block;
        margin-bottom: 8px;
        opacity: 0.35;
    }

    /* ============================================
       QUICK ACTIONS
       ============================================ */
    .qa-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 14px;
    }
    .qa-btn {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding: 22px 12px;
        border-radius: 16px;
        background: #fff;
        border: 1.5px solid #E2E8F0;
        text-decoration: none;
        transition: all 0.28s cubic-bezier(0.22, 1, 0.36, 1);
        color: #0D1B2A;
    }
    .qa-btn:hover {
        border-color: transparent;
        transform: translateY(-4px);
        text-decoration: none;
        color: #fff;
    }
    .qa-btn .qa-icon {
        width: 48px; height: 48px;
        border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.2rem;
        transition: transform 0.3s;
    }
    .qa-btn:hover .qa-icon { transform: scale(1.12); }
    .qa-btn span {
        font-size: 0.8rem;
        font-weight: 700;
        text-align: center;
        line-height: 1.3;
    }

    .qa-btn.qa-blue  { --qc: #0E7A96; }
    .qa-btn.qa-green { --qc: #059669; }
    .qa-btn.qa-amber { --qc: #D97706; }
    .qa-btn.qa-slate { --qc: #475569; }

    .qa-btn.qa-blue  .qa-icon { background: #EEF9FC; color: #0E7A96; }
    .qa-btn.qa-green .qa-icon { background: #D1FAE5; color: #059669; }
    .qa-btn.qa-amber .qa-icon { background: #FEF3C7; color: #D97706; }
    .qa-btn.qa-slate .qa-icon { background: #F1F5F9; color: #475569; }

    .qa-btn.qa-blue:hover  { background: linear-gradient(135deg, #0E7A96, #4EB8CC); color: #fff; }
    .qa-btn.qa-green:hover { background: linear-gradient(135deg, #059669, #34D399); color: #fff; }
    .qa-btn.qa-amber:hover { background: linear-gradient(135deg, #D97706, #FBBF24); color: #fff; }
    .qa-btn.qa-slate:hover { background: linear-gradient(135deg, #475569, #64748B); color: #fff; }

    .qa-btn:hover .qa-icon { background: rgba(255,255,255,0.2); color: #fff; }

    /* ============================================
       SYSTEM INFO
       ============================================ */
    .sysinfo-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 14px;
    }
    .sysinfo-item {
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        border-radius: 14px;
        padding: 16px 18px;
        display: flex;
        align-items: center;
        gap: 14px;
    }
    .sysinfo-item .si-icon {
        width: 40px; height: 40px;
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1rem;
        flex-shrink: 0;
    }
    .sysinfo-item .si-label {
        font-size: 0.72rem;
        color: #94A3B8;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 2px;
    }
    .sysinfo-item .si-value {
        font-size: 0.95rem;
        font-weight: 700;
        color: #0D1B2A;
        line-height: 1.2;
    }

    /* ============================================
       RESPONSIVE
       ============================================ */
    @media (max-width: 992px) {
        .qa-grid     { grid-template-columns: repeat(2, 1fr); }
        .sysinfo-grid{ grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 576px) {
        .welcome-banner { padding: 24px 20px; }
        .welcome-banner .wb-icon { display: none; }
        .qa-grid     { grid-template-columns: repeat(2, 1fr); }
        .sysinfo-grid{ grid-template-columns: 1fr 1fr; }
    }
</style>
@endpush

@section('content')

    @if(session('success'))
        <div class="alert alert-dismissible fade show" style="border-radius: 12px; font-size: 0.88rem; border: none; background: #D1FAE5; color: #065F46; margin-bottom: 20px;">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    @endif

    {{-- ── WELCOME BANNER ── --}}
    <div class="welcome-banner">
        <div class="wb-content">
            <h4>Selamat Datang, {{ Auth::user()->name }}! 👋</h4>
            <p>Anda login sebagai Administrator QofMedia &mdash; {{ now()->isoFormat('dddd, D MMMM Y') }}</p>
            <span class="wb-time">
                <i class="fas fa-circle" style="font-size:0.45rem; animation: blink 2s infinite;"></i>
                Online &bull; {{ now()->format('H:i') }} WIB
            </span>
        </div>
        <i class="fas fa-user-shield wb-icon"></i>
    </div>

    {{-- ── STAT CARDS ── --}}
    <p class="sec-label">Ringkasan</p>
    <div class="row g-3 mb-4">
        <div class="col-6 col-lg-3">
            <a href="{{ route('admin.contacts.index') }}" class="stat-card blue d-flex">
                <div class="stat-icon"><i class="fas fa-envelope"></i></div>
                <div class="stat-info">
                    <div class="stat-number">{{ $stats['unread_contacts'] ?? 0 }}</div>
                    <div class="stat-label">Pesan Masuk</div>
                    <div class="stat-link">Lihat detail <i class="fas fa-arrow-right"></i></div>
                </div>
            </a>
        </div>
        <div class="col-6 col-lg-3">
            <a href="{{ route('admin.articles.index') }}" class="stat-card green d-flex">
                <div class="stat-icon"><i class="fas fa-newspaper"></i></div>
                <div class="stat-info">
                    <div class="stat-number">{{ $stats['total_articles'] ?? 0 }}</div>
                    <div class="stat-label">Total Artikel</div>
                    <div class="stat-link">Lihat detail <i class="fas fa-arrow-right"></i></div>
                </div>
            </a>
        </div>
        <div class="col-6 col-lg-3">
            <a href="{{ route('admin.albums.index') }}" class="stat-card amber d-flex">
                <div class="stat-icon"><i class="fas fa-images"></i></div>
                <div class="stat-info">
                    <div class="stat-number">{{ $stats['total_albums'] ?? 0 }}</div>
                    <div class="stat-label">Album Galeri</div>
                    <div class="stat-link">Lihat detail <i class="fas fa-arrow-right"></i></div>
                </div>
            </a>
        </div>
        <div class="col-6 col-lg-3">
            <a href="{{ route('admin.users.index') }}" class="stat-card red d-flex">
                <div class="stat-icon"><i class="fas fa-users"></i></div>
                <div class="stat-info">
                    <div class="stat-number">{{ $stats['total_users'] ?? 0 }}</div>
                    <div class="stat-label">Total User</div>
                    <div class="stat-link">Lihat detail <i class="fas fa-arrow-right"></i></div>
                </div>
            </a>
        </div>
    </div>

    {{-- ── TABLES ROW ── --}}
    <p class="sec-label">Aktivitas Terbaru</p>
    <div class="row g-3 mb-4">

        {{-- Pesan Terbaru --}}
        <div class="col-lg-6">
            <div class="dash-card">
                <div class="dash-card-header">
                    <div class="dash-card-title">
                        <i class="fas fa-envelope"></i> Pesan Terbaru
                    </div>
                    <a href="{{ route('admin.contacts.index') }}" class="dash-card-link">
                        Lihat semua <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
                <table class="dash-table">
                    <thead>
                        <tr>
                            <th>Pengirim</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentContacts ?? [] as $contact)
                            <tr>
                                <td>
                                    <div style="font-weight: 700; font-size: 0.85rem;">{{ $contact->name }}</div>
                                    <div class="td-muted">{{ Str::limit($contact->message, 38) }}</div>
                                </td>
                                <td>
                                    @if($contact->read_at)
                                        <span class="badge-read"><i class="fas fa-check"></i> Dibaca</span>
                                    @else
                                        <span class="badge-unread"><i class="fas fa-clock"></i> Belum</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.contacts.show', $contact) }}"
                                       class="btn-xs-act view" title="Lihat">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr class="empty-row">
                                <td colspan="3">
                                    <i class="fas fa-envelope-open-text empty-icon-sm"></i>
                                    Belum ada pesan masuk
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Artikel Terbaru --}}
        <div class="col-lg-6">
            <div class="dash-card">
                <div class="dash-card-header">
                    <div class="dash-card-title">
                        <i class="fas fa-newspaper"></i> Artikel Terbaru
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <a href="{{ route('admin.articles.create') }}"
                           style="display:inline-flex; align-items:center; gap:5px; background:#EEF9FC; color:#0E7A96; padding:5px 12px; border-radius:50px; font-size:0.75rem; font-weight:700; text-decoration:none;">
                            <i class="fas fa-plus"></i> Tambah
                        </a>
                        <a href="{{ route('admin.articles.index') }}" class="dash-card-link">
                            Lihat semua <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <table class="dash-table">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentArticles ?? [] as $article)
                            <tr>
                                <td>
                                    <div style="font-weight: 700; font-size: 0.85rem;">{{ Str::limit($article->title, 36) }}</div>
                                    <div class="td-muted"><i class="far fa-calendar-alt me-1"></i>{{ $article->created_at->format('d M Y') }}</div>
                                </td>
                                <td><span class="badge-cat">{{ $article->category }}</span></td>
                                <td style="white-space: nowrap;">
                                    <a href="{{ route('admin.articles.edit', $article) }}"
                                       class="btn-xs-act edit" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('information.show', $article->slug) }}"
                                       target="_blank"
                                       class="btn-xs-act open ms-1" title="Lihat">
                                        <i class="fas fa-external-link-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr class="empty-row">
                                <td colspan="3">
                                    <i class="fas fa-newspaper empty-icon-sm"></i>
                                    Belum ada artikel
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- ── QUICK ACTIONS ── --}}
    <p class="sec-label">Aksi Cepat</p>
    <div class="qa-grid mb-4">
        <a href="{{ route('admin.articles.create') }}" class="qa-btn qa-blue">
            <div class="qa-icon"><i class="fas fa-plus-circle"></i></div>
            <span>Tambah Artikel</span>
        </a>
        <a href="{{ route('admin.albums.create') }}" class="qa-btn qa-green">
            <div class="qa-icon"><i class="fas fa-images"></i></div>
            <span>Tambah Album</span>
        </a>
        <a href="{{ route('admin.users.index') }}" class="qa-btn qa-amber">
            <div class="qa-icon"><i class="fas fa-users-cog"></i></div>
            <span>Manajemen User</span>
        </a>
        <a href="{{ route('admin.settings.index') }}" class="qa-btn qa-slate">
            <div class="qa-icon"><i class="fas fa-cog"></i></div>
            <span>Pengaturan</span>
        </a>
    </div>

    {{-- ── SYSTEM INFO ── --}}
    <p class="sec-label">Informasi Sistem</p>
    <div class="sysinfo-grid">
        <div class="sysinfo-item">
            <div class="si-icon" style="background:#EEF9FC; color:#0E7A96;">
                <i class="fab fa-laravel"></i>
            </div>
            <div>
                <div class="si-label">Laravel</div>
                <div class="si-value">v{{ app()->version() }}</div>
            </div>
        </div>
        <div class="sysinfo-item">
            <div class="si-icon" style="background:#D1FAE5; color:#059669;">
                <i class="fas fa-database"></i>
            </div>
            <div>
                <div class="si-label">Database</div>
                <div class="si-value">MySQL</div>
            </div>
        </div>
        <div class="sysinfo-item">
            <div class="si-icon" style="background:#FEF3C7; color:#D97706;">
                <i class="fas fa-users"></i>
            </div>
            <div>
                <div class="si-label">Total User</div>
                <div class="si-value">{{ $stats['total_users'] ?? 0 }}</div>
            </div>
        </div>
        <div class="sysinfo-item">
            <div class="si-icon" style="background:#FEE2E2; color:#DC2626;">
                <i class="fas fa-clock"></i>
            </div>
            <div>
                <div class="si-label">Server Time</div>
                <div class="si-value" id="liveTime">{{ now()->format('H:i:s') }}</div>
            </div>
        </div>
    </div>

@stop

@push('js')
<style>
    @keyframes blink {
        0%, 100% { opacity: 1; }
        50%       { opacity: 0.2; }
    }
</style>
<script>
    /* Live clock */
    function pad(n) { return String(n).padStart(2, '0'); }
    function tick() {
        var d = new Date();
        var el = document.getElementById('liveTime');
        if (el) el.textContent = pad(d.getHours()) + ':' + pad(d.getMinutes()) + ':' + pad(d.getSeconds());
    }
    setInterval(tick, 1000);
    tick();
</script>
@endpush