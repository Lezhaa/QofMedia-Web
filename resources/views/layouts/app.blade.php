<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'QofMedia') - QofMedia</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        /* ============================================
           ROOT VARIABLES - TEMA TEAL (SAMA DENGAN BERANDA)
           ============================================ */
        :root {
            --qof-primary: #0E7A96;
            --qof-secondary: #1e1b4b;
            --qof-dark: #091828;
            --qof-light: #f8fafc;
            
            /* Tambahan dari home.css */
            --accent-teal-dark:  #0A4A60;
            --accent-teal-mid:   #0E7A96;
            --accent-teal-glow:  #4EB8CC;
            --accent-teal-light: #A8DDE8;
            --text-white:        #FFFFFF;
            --text-muted:        rgba(255, 255, 255, 0.6);
            --text-dark:         #0D1B2A;
            --text-gray:         #4A5568;
            --white-bg:          #FFFFFF;
            --white-bg-soft:     #F7FAFC;
            --white-border:      #E2E8F0;
        }

        /* ============================================
           BASE LAYOUT
           ============================================ */
        html, body { height: 100%; margin: 0; }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #ffffff;
            padding-top: 75px;
            display: flex; flex-direction: column;
            min-height: 100vh;
        }

        main { flex: 1 0 auto; }

        /* ============================================
           NAVBAR
           ============================================ */
        .navbar {
            padding: 0.4rem 0;
            background: rgba(9, 24, 40, 0.92) !important;
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
            margin: 15px 30px; border-radius: 40px;
            position: fixed; top: 0; left: 0; right: 0; z-index: 1030;
            border: 1px solid rgba(255,255,255,0.1);
        }

        .navbar-brand { font-size: 1.2rem; font-weight: 700; color: white !important; padding-left: 8px; display: flex; align-items: center; }
        .navbar-brand img { max-height: 32px; width: auto; }
        .navbar-brand i { color: var(--accent-teal-glow); font-size: 1.3rem; }
        .navbar-brand span { font-size: 1.1rem; font-weight: 700; color: white; }

        .nav-link {
            color: rgba(255,255,255,0.75) !important; font-weight: 500; font-size: 0.9rem;
            padding: 0.35rem 0.8rem !important; transition: all 0.3s;
            border-radius: 30px; margin: 0 1px;
        }
        .nav-link:hover, .nav-link.active { color: white !important; background: rgba(78,184,204,0.2); }

        .dropdown-menu {
            background: rgba(9,24,40,0.95); backdrop-filter: blur(10px);
            border: none; border-radius: 12px; padding: 0.5rem;
            box-shadow: 0 20px 40px rgba(0,0,0,0.2); margin-top: 8px;
            border: 1px solid rgba(255,255,255,0.1); font-size: 0.9rem; min-width: 160px;
        }
        .dropdown-item { color: rgba(255,255,255,0.75); border-radius: 8px; padding: 0.45rem 1rem; font-weight: 500; font-size: 0.9rem; }
        .dropdown-item:hover { background: rgba(78,184,204,0.2); color: white; }

        .nav-auth-btn { padding: 0.35rem 1rem !important; border-radius: 30px; font-weight: 600; font-size: 0.85rem; margin-left: 4px; }
        .nav-login { color: white !important; border: 1.5px solid rgba(255,255,255,0.3); background: transparent; }
        .nav-login:hover { background: rgba(255,255,255,0.1) !important; }
        .nav-register { background: var(--accent-teal-glow); color: var(--qof-dark) !important; border: 1.5px solid var(--accent-teal-glow); font-weight: 700; }
        .nav-register:hover { background: var(--accent-teal-light) !important; }

        .user-dropdown-toggle {
            display: flex; align-items: center; gap: 5px;
            padding: 0.35rem 0.9rem !important;
            background: rgba(78,184,204,0.2); border-radius: 30px;
            color: white !important; font-size: 0.9rem;
        }
        .user-dropdown-toggle i { font-size: 1.1rem; color: var(--accent-teal-glow); }

        .navbar-toggler { border-color: rgba(255,255,255,0.3) !important; padding: 0.25rem 0.5rem; }
        .navbar-toggler-icon { background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(255,255,255,0.7)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e") !important; }

        /* ============================================
           HERO (Digunakan di semua halaman)
           ============================================ */
        .page-hero {
            background: linear-gradient(160deg, #091828 0%, #0D2A3E 100%);
            padding: 50px 0;
            border-radius: 0 0 40px 40px;
            margin-top: -10px;
            text-align: center;
        }
        .page-hero h1 { font-size: 2.2rem; font-weight: 700; color: var(--text-white); margin-bottom: 5px; }
        .page-hero p { color: var(--text-muted); font-size: 0.95rem; max-width: 500px; margin: 0 auto; }

        /* ============================================
           SECTION TITLE (Global)
           ============================================ */
        .section-title { font-size: 1.8rem; font-weight: 700; color: var(--text-dark); margin-bottom: 6px; }
        .section-subtitle { font-size: 0.95rem; color: var(--text-gray); margin-bottom: 30px; }

        /* ============================================
           BUTTONS
           ============================================ */
        .btn-primary {
            background: var(--accent-teal-mid); border-color: var(--accent-teal-mid);
            border-radius: 50px; padding: 10px 24px; font-weight: 600;
        }
        .btn-primary:hover { background: var(--accent-teal-dark); border-color: var(--accent-teal-dark); }
        
        .btn-outline-primary {
            color: var(--accent-teal-mid); border-color: var(--accent-teal-mid);
            border-radius: 50px; padding: 10px 24px; font-weight: 600;
        }
        .btn-outline-primary:hover { background: var(--accent-teal-mid); border-color: var(--accent-teal-mid); color: white; }

        .btn-gallery {
            display: inline-flex; align-items: center; gap: 8px;
            background: transparent; color: var(--accent-teal-mid);
            border: 1.5px solid var(--accent-teal-mid);
            padding: 10px 28px; border-radius: 50px; font-weight: 600;
            transition: all 0.3s;
        }
        .btn-gallery:hover { background: var(--accent-teal-mid); color: white; }

        .btn-wa { background: #25d366; color: white; border: none; border-radius: 50px; padding: 10px 20px; font-weight: 600; }
        .btn-wa:hover { background: #20ba5a; color: white; }

        /* ============================================
           CARD (Global)
           ============================================ */
        .card {
            border-radius: 16px; border: 1px solid var(--white-border);
            background: white; transition: all 0.3s;
        }
        .card:hover { box-shadow: 0 10px 30px rgba(0,0,0,0.06); }

        /* ============================================
           SERVICE CARD
           ============================================ */
        .service-card {
            background: white; border-radius: 16px; padding: 24px 20px; height: 100%;
            box-shadow: 0 5px 20px rgba(0,0,0,0.04); transition: all 0.3s;
            border: 1px solid var(--white-border);
        }
        .service-card:hover { transform: translateY(-4px); box-shadow: 0 15px 35px rgba(0,0,0,0.06); border-color: var(--accent-teal-glow); }
        
        .service-icon {
            width: 56px; height: 56px;
            background: rgba(14,122,150,0.1); border: 1px solid rgba(14,122,150,0.2);
            border-radius: 14px; display: flex; align-items: center; justify-content: center;
            margin-bottom: 16px;
        }
        .service-icon i { font-size: 26px; color: var(--accent-teal-mid); }

        /* ============================================
           GALLERY CARD
           ============================================ */
        .gallery-card {
            border-radius: 16px; overflow: hidden;
            border: 1px solid var(--white-border);
            background: white; height: 100%;
        }
        .gallery-card img { width: 100%; object-fit: cover; transition: transform 0.4s; }
        .gallery-card:hover img { transform: scale(1.05); }
        .gallery-placeholder {
            background: var(--white-bg-soft); display: flex;
            align-items: center; justify-content: center;
        }
        .gallery-placeholder i { font-size: 40px; color: var(--accent-teal-mid); opacity: 0.4; }

        /* ============================================
           NEWS CARD
           ============================================ */
        .news-card {
            background: #F8F9FA; border: 1px solid var(--white-border);
            border-radius: 14px; overflow: hidden; height: 100%;
            transition: all 0.3s;
        }
        .news-card:hover { transform: translateY(-4px); box-shadow: 0 10px 30px rgba(0,0,0,0.06); border-color: var(--accent-teal-glow); }
        .news-card-img { overflow: hidden; }
        .news-card-img img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s; }
        .news-card:hover .news-card-img img { transform: scale(1.05); }
        .news-placeholder { background: var(--white-bg-soft); display: flex; align-items: center; justify-content: center; }
        .news-placeholder i { font-size: 40px; color: var(--accent-teal-mid); opacity: 0.4; }

        /* ============================================
           FOOTER
           ============================================ */
        .footer {
            background: var(--qof-dark); padding: 1.2rem 0; flex-shrink: 0;
        }
        .footer-content { display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; }
        .footer-logo { flex: 0 0 auto; }
        .footer-logo img { height: 30px; width: auto; }
        .footer-copyright { flex: 1; text-align: center; color: rgba(255,255,255,0.7); font-size: 0.85rem; }
        .footer-social { flex: 0 0 auto; display: flex; gap: 12px; }
        .footer-social a {
            color: rgba(255,255,255,0.6); font-size: 1.1rem;
            display: inline-flex; align-items: center; justify-content: center;
            width: 32px; height: 32px; border-radius: 50%;
            background: rgba(255,255,255,0.05); transition: all 0.2s;
        }
        .footer-social a:hover { color: white; background: var(--accent-teal-glow); }

        /* ============================================
           BREADCRUMB
           ============================================ */
        .breadcrumb { display: flex; flex-wrap: wrap; padding: 0; margin: 0; list-style: none; background: transparent; }
        .breadcrumb-item + .breadcrumb-item::before { content: "/"; padding: 0 8px; color: #94a3b8; }
        .breadcrumb-item a { color: var(--accent-teal-mid); text-decoration: none; }
        .breadcrumb-item.active { color: #94a3b8; }

        /* ============================================
           RESPONSIVE
           ============================================ */
        @media (max-width: 992px) {
            body { padding-top: 65px; }
            .navbar { margin: 10px 15px; background: rgba(9,24,40,0.95) !important; }
            .navbar-collapse { background: rgba(9,24,40,0.95); backdrop-filter: blur(10px); border-radius: 15px; padding: 15px; margin-top: 10px; }
        }
        @media (max-width: 768px) {
            .footer-content { flex-direction: column; gap: 12px; }
            .footer-copyright { order: 2; }
            .footer-social { order: 3; }
        }
    </style>

    @stack('styles')
</head>
<body>
    @include('partials.navbar')
    <main>@yield('content')</main>
    @include('partials.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>