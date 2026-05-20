@extends('adminlte::page')

@section('title', 'Dashboard Studio')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="mb-0" style="font-size: 1.4rem; font-weight: 700; color: #0D1B2A;">
                <i class="fas fa-video me-2" style="color: #0E7A96;"></i> Dashboard Admin Studio
            </h1>
            <ol class="breadcrumb mb-0 mt-1" style="font-size: 0.8rem; background: transparent; padding: 0;">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Studio</li>
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
       STAT CARDS — identik dengan dashboard admin
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
    .stat-card:hover.amber { box-shadow: 0 12px 32px rgba(217,119,6,0.14);  border-color: #FBBF24; }
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
       QUICK ACTIONS GRID — identik dengan dashboard admin
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

    .qa-btn.qa-blue  .qa-icon { background: #EEF9FC; color: #0E7A96; }
    .qa-btn.qa-green .qa-icon { background: #D1FAE5; color: #059669; }
    .qa-btn.qa-amber .qa-icon { background: #FEF3C7; color: #D97706; }
    .qa-btn.qa-rose  .qa-icon { background: #FEE2E2; color: #E11D48; }

    .qa-btn.qa-blue:hover  { background: linear-gradient(135deg, #0E7A96, #4EB8CC); color: #fff; }
    .qa-btn.qa-green:hover { background: linear-gradient(135deg, #059669, #34D399); color: #fff; }
    .qa-btn.qa-amber:hover { background: linear-gradient(135deg, #D97706, #FBBF24); color: #fff; }
    .qa-btn.qa-rose:hover  { background: linear-gradient(135deg, #E11D48, #FB7185); color: #fff; }

    .qa-btn:hover .qa-icon { background: rgba(255,255,255,0.2); color: #fff; }

    /* ============================================
       SECTION / DASH CARD
       ============================================ */
    .dash-card {
        background: #fff;
        border: 1px solid #E2E8F0;
        border-radius: 18px;
        overflow: hidden;
    }
    .dash-card-header {
        padding: 16px 22px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 1px solid #F1F5F9;
        background: #F8FAFC;
    }
    .dash-card-title {
        font-size: 0.9rem;
        font-weight: 700;
        color: #0D1B2A;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .dash-card-title .hdr-icon {
        width: 30px; height: 30px;
        background: rgba(14,122,150,0.1);
        border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        color: #0E7A96;
        font-size: 0.8rem;
        flex-shrink: 0;
    }
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
    .dash-card-body { padding: 22px; }

    /* ============================================
       QUICK ACTION ROWS (inside card)
       ============================================ */
    .qa-row {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 13px 16px;
        border-radius: 12px;
        border: 1.5px solid #E2E8F0;
        background: #F8FAFC;
        text-decoration: none;
        transition: all 0.2s;
        margin-bottom: 10px;
    }
    .qa-row:last-child { margin-bottom: 0; }
    .qa-row:hover {
        text-decoration: none;
        transform: translateX(4px);
        box-shadow: 0 4px 14px rgba(0,0,0,0.06);
    }
    .qa-row .qa-row-icon {
        width: 36px; height: 36px;
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 0.9rem;
        flex-shrink: 0;
    }
    .qa-row .qa-row-text strong {
        display: block;
        font-size: 0.84rem;
        font-weight: 700;
        color: #0D1B2A;
        line-height: 1.3;
    }
    .qa-row .qa-row-text span {
        font-size: 0.72rem;
        color: #94A3B8;
    }
    .qa-row .qa-row-arrow {
        margin-left: auto;
        color: #CBD5E1;
        font-size: 0.75rem;
        transition: color 0.2s, transform 0.2s;
    }
    .qa-row:hover .qa-row-arrow { color: #0E7A96; transform: translateX(3px); }

    .qa-row.teal:hover  { border-color: #0E7A96; background: rgba(14,122,150,0.04); }
    .qa-row.green:hover { border-color: #059669; background: rgba(5,150,105,0.04);  }
    .qa-row.amber:hover { border-color: #D97706; background: rgba(217,119,6,0.04);  }
    .qa-row.blue:hover  { border-color: #0284C7; background: rgba(2,132,199,0.04);  }

    .qa-row.teal  .qa-row-icon { background: rgba(14,122,150,0.1); color: #0E7A96; }
    .qa-row.green .qa-row-icon { background: rgba(5,150,105,0.1);  color: #059669; }
    .qa-row.amber .qa-row-icon { background: rgba(217,119,6,0.1);  color: #D97706; }
    .qa-row.blue  .qa-row-icon { background: rgba(2,132,199,0.1);  color: #0284C7; }

    /* ============================================
       SYSTEM INFO — identik dengan dashboard admin
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
       INFO PANEL
       ============================================ */
    .info-panel {
        background: rgba(14,122,150,0.05);
        border: 1.5px solid rgba(14,122,150,0.15);
        border-radius: 12px;
        padding: 18px 20px;
    }
    .info-panel .info-title {
        font-size: 0.88rem;
        font-weight: 700;
        color: #0D1B2A;
        margin-bottom: 6px;
        display: flex;
        align-items: center;
        gap: 7px;
    }
    .info-panel .info-title i { color: #0E7A96; }
    .info-panel .info-body {
        font-size: 0.82rem;
        color: #64748B;
        line-height: 1.7;
        margin-bottom: 12px;
    }
    .info-panel hr {
        border: none;
        border-top: 1px solid rgba(14,122,150,0.15);
        margin: 12px 0;
    }
    .info-panel .wa-row {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.84rem;
        color: #0D1B2A;
        font-weight: 500;
        flex-wrap: wrap;
    }
    .info-panel .wa-row i { color: #25D366; font-size: 1rem; }
    .info-panel .wa-row strong {
        background: rgba(37,211,102,0.1);
        color: #14793A;
        border-radius: 6px;
        padding: 2px 10px;
        font-size: 0.82rem;
        font-weight: 700;
    }

    /* ============================================
       RESPONSIVE
       ============================================ */
    @media (max-width: 992px) {
        .qa-grid      { grid-template-columns: repeat(2, 1fr); }
        .sysinfo-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 576px) {
        .welcome-banner { padding: 24px 20px; }
        .welcome-banner .wb-icon { display: none; }
        .qa-grid      { grid-template-columns: repeat(2, 1fr); }
        .sysinfo-grid { grid-template-columns: 1fr 1fr; }
    }
</style>
@endpush

@section('content')

    {{-- ── WELCOME BANNER ── --}}
    <div class="welcome-banner">
        <div class="wb-content">
            <h4>Dashboard Admin Studio 🎬</h4>
            <p>Kelola peralatan, paket studio, dan paket fotografi &mdash; {{ now()->isoFormat('dddd, D MMMM Y') }}</p>
            <span class="wb-time">
                <i class="fas fa-circle" style="font-size:0.45rem; animation: blink 2s infinite;"></i>
                Online &bull; {{ now()->format('H:i') }} WIB
            </span>
        </div>
        <i class="fas fa-video wb-icon"></i>
    </div>

    {{-- ── STAT CARDS ── --}}
    <p class="sec-label">Ringkasan</p>
    <div class="row g-3 mb-4">
        <div class="col-6 col-lg-3">
            <a href="{{ route('studio.tools.index') }}" class="stat-card blue d-flex">
                <div class="stat-icon"><i class="fas fa-tools"></i></div>
                <div class="stat-info">
                    <div class="stat-number">{{ $stats['total_tools'] ?? 0 }}</div>
                    <div class="stat-label">Total Alat</div>
                    <div class="stat-link">Kelola alat <i class="fas fa-arrow-right"></i></div>
                </div>
            </a>
        </div>
        <div class="col-6 col-lg-3">
            <a href="{{ route('studio.tools.index') }}" class="stat-card green d-flex">
                <div class="stat-icon"><i class="fas fa-check-circle"></i></div>
                <div class="stat-info">
                    <div class="stat-number">{{ $stats['available_tools'] ?? 0 }}</div>
                    <div class="stat-label">Alat Tersedia</div>
                    <div class="stat-link">Lihat detail <i class="fas fa-arrow-right"></i></div>
                </div>
            </a>
        </div>
        <div class="col-6 col-lg-3">
            <a href="{{ route('studio.packages.index') }}" class="stat-card amber d-flex">
                <div class="stat-icon"><i class="fas fa-video"></i></div>
                <div class="stat-info">
                    <div class="stat-number">{{ $stats['total_studio_packages'] ?? 0 }}</div>
                    <div class="stat-label">Paket Studio</div>
                    <div class="stat-link">Kelola paket <i class="fas fa-arrow-right"></i></div>
                </div>
            </a>
        </div>
        <div class="col-6 col-lg-3">
            <a href="{{ route('studio.photo-packages.index') }}" class="stat-card red d-flex">
                <div class="stat-icon"><i class="fas fa-camera"></i></div>
                <div class="stat-info">
                    <div class="stat-number">{{ $stats['total_photo_packages'] ?? 0 }}</div>
                    <div class="stat-label">Paket Foto</div>
                    <div class="stat-link">Kelola paket <i class="fas fa-arrow-right"></i></div>
                </div>
            </a>
        </div>
    </div>

    {{-- ── QUICK ACTIONS GRID (4 kotak) ── --}}
    <p class="sec-label">Aksi Cepat</p>
    <div class="qa-grid mb-4">
        <a href="{{ route('studio.tools.create') }}" class="qa-btn qa-blue">
            <div class="qa-icon"><i class="fas fa-plus-circle"></i></div>
            <span>Tambah Alat Baru</span>
        </a>
        <a href="{{ route('studio.packages.create') }}" class="qa-btn qa-green">
            <div class="qa-icon"><i class="fas fa-video"></i></div>
            <span>Tambah Paket Studio</span>
        </a>
        <a href="{{ route('studio.photo-packages.create') }}" class="qa-btn qa-amber">
            <div class="qa-icon"><i class="fas fa-camera"></i></div>
            <span>Tambah Paket Foto</span>
        </a>
        <a href="{{ route('service.studio') }}" target="_blank" class="qa-btn qa-rose">
            <div class="qa-icon"><i class="fas fa-eye"></i></div>
            <span>Lihat Halaman Studio</span>
        </a>
    </div>

    {{-- ── MENU NAVIGASI + INFO PANEL ── --}}
    <p class="sec-label">Navigasi & Informasi</p>
    <div class="row g-3 mb-4">

        {{-- Navigasi kelola --}}
        <div class="col-lg-7">
            <div class="dash-card">
                <div class="dash-card-header">
                    <div class="dash-card-title">
                        <div class="hdr-icon"><i class="fas fa-list"></i></div>
                        Menu Kelola
                    </div>
                </div>
                <div class="dash-card-body">
                    <a href="{{ route('studio.tools.index') }}" class="qa-row teal">
                        <div class="qa-row-icon"><i class="fas fa-tools"></i></div>
                        <div class="qa-row-text">
                            <strong>Kelola Alat Sewa</strong>
                            <span>Daftar semua peralatan studio yang tersedia</span>
                        </div>
                        <i class="fas fa-chevron-right qa-row-arrow"></i>
                    </a>
                    <a href="{{ route('studio.packages.index') }}" class="qa-row green">
                        <div class="qa-row-icon"><i class="fas fa-video"></i></div>
                        <div class="qa-row-text">
                            <strong>Kelola Paket Studio</strong>
                            <span>Paket sewa studio dengan berbagai pilihan durasi</span>
                        </div>
                        <i class="fas fa-chevron-right qa-row-arrow"></i>
                    </a>
                    <a href="{{ route('studio.photo-packages.index') }}" class="qa-row amber">
                        <div class="qa-row-icon"><i class="fas fa-camera"></i></div>
                        <div class="qa-row-text">
                            <strong>Kelola Paket Fotografi</strong>
                            <span>Paket foto profesional untuk berbagai kebutuhan</span>
                        </div>
                        <i class="fas fa-chevron-right qa-row-arrow"></i>
                    </a>
                    <a href="{{ route('service.studio') }}" target="_blank" class="qa-row blue">
                        <div class="qa-row-icon"><i class="fas fa-globe"></i></div>
                        <div class="qa-row-text">
                            <strong>Lihat Halaman Studio Publik</strong>
                            <span>Tampilan website yang dilihat oleh pengunjung</span>
                        </div>
                        <i class="fas fa-chevron-right qa-row-arrow"></i>
                    </a>
                </div>
            </div>
        </div>

        {{-- Info + System ── --}}
        <div class="col-lg-5 d-flex flex-column gap-3">

            {{-- Info Panel --}}
            <div class="dash-card">
                <div class="dash-card-header">
                    <div class="dash-card-title">
                        <div class="hdr-icon"><i class="fas fa-info-circle"></i></div>
                        Informasi Layanan
                    </div>
                </div>
                <div class="dash-card-body">
                    <div class="info-panel">
                        <div class="info-title">
                            <i class="fas fa-check-circle"></i>
                            Selamat Datang, Admin Studio!
                        </div>
                        <div class="info-body">
                            Kelola semua alat sewa, paket studio, dan paket fotografi dari menu di atas atau sidebar.
                        </div>
                        <hr>
                        <div class="wa-row">
                            <i class="fab fa-whatsapp"></i>
                            WhatsApp Studio:
                            <strong>{{ setting('whatsapp_studio', '6281246943349') }}</strong>
                        </div>
                    </div>
                </div>
            </div>

        </div>
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
                <i class="fas fa-tools"></i>
            </div>
            <div>
                <div class="si-label">Total Alat</div>
                <div class="si-value">{{ $stats['total_tools'] ?? 0 }}</div>
            </div>
        </div>
        <div class="sysinfo-item">
            <div class="si-icon" style="background:#FEF3C7; color:#D97706;">
                <i class="fas fa-box-open"></i>
            </div>
            <div>
                <div class="si-label">Total Paket</div>
                <div class="si-value">{{ ($stats['total_studio_packages'] ?? 0) + ($stats['total_photo_packages'] ?? 0) }}</div>
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
    function pad(n) { return String(n).padStart(2, '0'); }
    function tick() {
        var d  = new Date();
        var el = document.getElementById('liveTime');
        if (el) el.textContent = pad(d.getHours()) + ':' + pad(d.getMinutes()) + ':' + pad(d.getSeconds());
    }
    setInterval(tick, 1000);
    tick();
</script>
@endpush