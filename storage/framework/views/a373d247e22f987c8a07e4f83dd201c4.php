

<?php $__env->startSection('title', 'Galeri'); ?>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />
<style>
    body { padding-top: 0 !important; }

    /* ============ SCROLL PROGRESS BAR ============ */
    .scroll-progress-bar {
        position: fixed;
        top: 0;
        left: 0;
        height: 3px;
        width: 0%;
        background: linear-gradient(90deg, #4EB8CC, #A8DDE8, #4EB8CC);
        background-size: 200%;
        z-index: 9999;
        transition: width 0.08s linear;
        animation: shimmerBar 3s linear infinite;
    }
    @keyframes shimmerBar {
        0%   { background-position: 0%; }
        100% { background-position: 200%; }
    }

    /* ============ HERO CINEMATIC ============ */
    .gal-hero {
        position: relative;
        background: #080E18;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        padding: 0;
    }

    /* Foto-foto melayang di background */
    .gal-hero-bg {
        position: absolute;
        inset: 0;
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 8px;
        padding: 8px;
        opacity: 0.18;
        transform: rotate(-3deg) scale(1.15);
        pointer-events: none;
        will-change: transform;
    }
    .gal-hero-bg-col {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }
    .gal-hero-bg-col:nth-child(even) { margin-top: -40px; }
    .gal-hero-bg img {
        width: 100%;
        aspect-ratio: 3/4;
        object-fit: cover;
        border-radius: 12px;
    }
    .gal-hero-bg .ph-box {
        width: 100%;
        aspect-ratio: 3/4;
        background: linear-gradient(135deg, #0E7A96, #1B3A4B);
        border-radius: 12px;
    }

    /* Dark overlay */
    .gal-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(ellipse at center, rgba(8,14,24,0.6) 0%, rgba(8,14,24,0.92) 70%);
        z-index: 1;
    }

    .gal-hero .container {
        position: relative;
        z-index: 2;
        text-align: center;
        will-change: opacity, transform;
    }

    .gal-hero-eye {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border: 1px solid rgba(78,184,204,0.35);
        background: rgba(78,184,204,0.07);
        backdrop-filter: blur(12px);
        color: #4EB8CC;
        padding: 7px 20px;
        border-radius: 100px;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 0.14em;
        text-transform: uppercase;
        margin-bottom: 28px;
    }
    .gal-hero-eye::before {
        content: '';
        width: 6px; height: 6px;
        background: #4EB8CC;
        border-radius: 50%;
        animation: blink 2.5s infinite;
    }
    @keyframes blink {
        0%, 100% { opacity: 1; }
        50%       { opacity: 0.2; }
    }

    .gal-hero h1 {
        font-size: clamp(3rem, 7vw, 5.5rem);
        font-weight: 900;
        color: #fff;
        letter-spacing: -2px;
        line-height: 1;
        margin-bottom: 24px;
    }
    .gal-hero h1 em {
        font-style: normal;
        background: linear-gradient(90deg, #4EB8CC, #A8DDE8 60%, #4EB8CC);
        background-size: 200%;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        animation: shimmer 4s linear infinite;
    }
    @keyframes shimmer {
        0%   { background-position: 0%; }
        100% { background-position: 200%; }
    }

    .gal-hero p {
        color: rgba(255,255,255,0.45);
        font-size: 1.05rem;
        max-width: 440px;
        margin: 0 auto 48px;
        line-height: 1.7;
    }

    /* counter strip */
    .gal-counter {
        display: inline-flex;
        border: 1px solid rgba(255,255,255,0.07);
        border-radius: 20px;
        overflow: hidden;
        background: rgba(255,255,255,0.03);
        backdrop-filter: blur(10px);
    }
    .gal-counter-item {
        padding: 18px 32px;
        text-align: center;
    }
    .gal-counter-item + .gal-counter-item { border-left: 1px solid rgba(255,255,255,0.07); }
    .gal-counter-item .num {
        font-size: 1.8rem;
        font-weight: 800;
        color: #fff;
        line-height: 1;
        display: block;
    }
    .gal-counter-item .lbl {
        font-size: 0.7rem;
        color: rgba(255,255,255,0.35);
        margin-top: 5px;
        letter-spacing: 0.1em;
        text-transform: uppercase;
    }

    /* Scroll hint */
    .scroll-hint {
        position: absolute;
        bottom: 28px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 2;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 6px;
        color: rgba(255,255,255,0.2);
        font-size: 0.68rem;
        letter-spacing: 0.12em;
        text-transform: uppercase;
    }
    .scroll-bar {
        width: 1px; height: 36px;
        background: linear-gradient(to bottom, rgba(78,184,204,0.6), transparent);
        animation: drop 2s ease infinite;
    }
    @keyframes drop {
        0%      { transform: scaleY(0); transform-origin: top; }
        50%     { transform: scaleY(1); transform-origin: top; }
        50.01%  { transform: scaleY(1); transform-origin: bottom; }
        100%    { transform: scaleY(0); transform-origin: bottom; }
    }

    /* ============ SECTION LABEL ============ */
    .sec-chip {
        display: inline-block;
        background: #EEF9FC;
        color: #0E7A96;
        padding: 5px 14px;
        border-radius: 100px;
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        margin-bottom: 14px;
    }

    /* ============ HIGHLIGHT MASONRY ============ */
    .highlight-sec {
        padding: 100px 0 60px;
        background: #fff;
    }

    .hl-head { margin-bottom: 48px; }
    .hl-head h2 {
        font-size: 2rem;
        font-weight: 800;
        color: #0D1B2A;
        letter-spacing: -0.5px;
        margin-bottom: 6px;
    }
    .hl-head p { color: #94A3B8; font-size: 0.95rem; }

    /* Bento masonry */
    .bento-grid {
        display: grid;
        grid-template-columns: repeat(12, 1fr);
        grid-auto-rows: 200px;
        gap: 12px;
    }

    .bento-item {
        position: relative;
        overflow: hidden;
        border-radius: 18px;
        cursor: pointer;
        /* Scroll animation start state */
        opacity: 0;
        transform: translateY(32px) scale(0.97);
        transition: opacity 0.65s cubic-bezier(0.22, 1, 0.36, 1),
                    transform 0.65s cubic-bezier(0.22, 1, 0.36, 1);
        will-change: opacity, transform;
    }
    .bento-item.is-visible {
        opacity: 1;
        transform: none;
    }

    /* Layout pattern */
    .bento-item:nth-child(1) { grid-column: span 5; grid-row: span 2; }
    .bento-item:nth-child(2) { grid-column: span 4; grid-row: span 1; }
    .bento-item:nth-child(3) { grid-column: span 3; grid-row: span 1; }
    .bento-item:nth-child(4) { grid-column: span 3; grid-row: span 2; }
    .bento-item:nth-child(5) { grid-column: span 4; grid-row: span 1; }
    .bento-item:nth-child(6) { grid-column: span 5; grid-row: span 1; }
    .bento-item:nth-child(7) { grid-column: span 4; grid-row: span 1; }
    .bento-item:nth-child(8) { grid-column: span 8; grid-row: span 1; }

    .bento-item img {
        width: 100%; height: 100%;
        object-fit: cover;
        transition: transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        display: block;
    }
    .bento-item:hover img { transform: scale(1.08); }

    .bento-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(8,14,24,0.85) 0%, rgba(8,14,24,0) 50%);
        opacity: 0;
        transition: opacity 0.35s;
        display: flex;
        align-items: flex-end;
        padding: 18px;
    }
    .bento-item:hover .bento-overlay { opacity: 1; }

    .bento-caption { color: #fff; }
    .bento-caption .bc-title {
        font-size: 0.88rem;
        font-weight: 600;
        margin-bottom: 3px;
        line-height: 1.3;
    }
    .bento-caption .bc-sub {
        font-size: 0.72rem;
        color: rgba(255,255,255,0.55);
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .bento-zoom {
        position: absolute;
        top: 14px; right: 14px;
        width: 36px; height: 36px;
        background: rgba(255,255,255,0.15);
        backdrop-filter: blur(8px);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 14px;
        opacity: 0;
        transition: opacity 0.3s, transform 0.3s;
        transform: scale(0.8);
    }
    .bento-item:hover .bento-zoom {
        opacity: 1;
        transform: scale(1);
    }

    .bento-placeholder {
        width: 100%; height: 100%;
        background: linear-gradient(135deg, #EEF9FC, #D6EEF5);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .bento-placeholder i { font-size: 36px; color: #0E7A96; opacity: 0.3; }

    /* ============ SECTION HEADING ANIMATIONS ============ */
    .hl-head .sec-chip,
    .year-head .sec-chip {
        opacity: 0;
        transform: translateY(16px);
        transition: opacity 0.5s cubic-bezier(0.22, 1, 0.36, 1),
                    transform 0.5s cubic-bezier(0.22, 1, 0.36, 1);
    }
    .hl-head h2,
    .year-head h2 {
        opacity: 0;
        transform: translateY(22px);
        transition: opacity 0.6s cubic-bezier(0.22, 1, 0.36, 1) 0.08s,
                    transform 0.6s cubic-bezier(0.22, 1, 0.36, 1) 0.08s;
    }
    .hl-head p,
    .year-head p {
        opacity: 0;
        transform: translateY(16px);
        transition: opacity 0.5s cubic-bezier(0.22, 1, 0.36, 1) 0.18s,
                    transform 0.5s cubic-bezier(0.22, 1, 0.36, 1) 0.18s;
    }
    .hl-head.is-visible .sec-chip,
    .year-head.is-visible .sec-chip,
    .hl-head.is-visible h2,
    .year-head.is-visible h2,
    .hl-head.is-visible p,
    .year-head.is-visible p {
        opacity: 1;
        transform: none;
    }

    /* ============ YEAR SECTION ============ */
    .year-sec {
        padding: 60px 0 100px;
        background: #F8FAFC;
    }

    .year-head { margin-bottom: 48px; }
    .year-head h2 {
        font-size: 2rem;
        font-weight: 800;
        color: #0D1B2A;
        letter-spacing: -0.5px;
        margin-bottom: 6px;
    }
    .year-head p { color: #94A3B8; font-size: 0.95rem; }

    .year-cards-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 20px;
    }

    .yr-card {
        position: relative;
        border-radius: 24px;
        overflow: hidden;
        aspect-ratio: 3/2;
        text-decoration: none;
        display: block;
        background: #0D1B2A;
        /* Hover transition — transform handled by JS class for animation interop */
        transition: opacity 0.6s cubic-bezier(0.22, 1, 0.36, 1),
                    transform 0.6s cubic-bezier(0.22, 1, 0.36, 1),
                    box-shadow 0.35s;
        opacity: 0;
        transform: translateY(40px);
        will-change: opacity, transform;
    }
    .yr-card.is-visible {
        opacity: 1;
        transform: translateY(0);
    }
    .yr-card.is-visible:hover {
        transform: translateY(-6px) !important;
        box-shadow: 0 24px 48px rgba(14,122,150,0.2);
    }

    .yr-card-bg {
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, #0D1B2A, #0E7A96);
        opacity: 1;
        transition: opacity 0.35s;
    }
    .yr-card-bg::after {
        content: '';
        position: absolute;
        inset: 0;
        background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='4'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.06'/%3E%3C/svg%3E");
        opacity: 0.5;
    }
    .yr-card:nth-child(2) .yr-card-bg { background: linear-gradient(135deg, #1B3A4B, #0A4A60); }
    .yr-card:nth-child(3) .yr-card-bg { background: linear-gradient(135deg, #0E4A5A, #0E7A96); }
    .yr-card:nth-child(4) .yr-card-bg { background: linear-gradient(135deg, #0D1B2A, #1B3A4B); }

    .yr-card-body {
        position: absolute;
        inset: 0;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        padding: 24px;
        z-index: 1;
    }

    .yr-num {
        font-size: 3.5rem;
        font-weight: 900;
        color: #fff;
        letter-spacing: -2px;
        line-height: 1;
        margin-bottom: 4px;
    }

    .yr-meta {
        display: flex;
        align-items: center;
        gap: 8px;
        color: rgba(255,255,255,0.5);
        font-size: 0.78rem;
        font-weight: 500;
    }
    .yr-meta .yr-dot {
        width: 5px; height: 5px;
        background: #4EB8CC;
        border-radius: 50%;
    }

    .yr-arrow {
        position: absolute;
        top: 20px; right: 20px;
        width: 38px; height: 38px;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 14px;
        transition: background 0.3s, transform 0.3s;
    }
    .yr-card.is-visible:hover .yr-arrow {
        background: rgba(78,184,204,0.3);
        transform: rotate(-45deg);
    }

    /* Empty state */
    .empty-state {
        text-align: center;
        padding: 60px 0;
    }
    .empty-state .empty-icon {
        width: 90px; height: 90px;
        background: #EEF9FC;
        border-radius: 28px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 24px;
        font-size: 40px;
        color: #0E7A96;
        opacity: 0.6;
    }
    .empty-state h4 { font-weight: 700; color: #0D1B2A; margin-bottom: 8px; }
    .empty-state p  { color: #94A3B8; font-size: 0.9rem; }

    /* ============ GLIGHTBOX CUSTOM ============ */
    .glightbox-clean .gslide-image img {
        max-width: 85vw !important;
        max-height: 85vh !important;
        width: auto !important;
        height: auto !important;
        border-radius: 16px;
    }
    .glightbox-clean .goverlay { background: rgba(8,14,24,0.97) !important; }
    .glightbox-clean .gnext,
    .glightbox-clean .gprev {
        background: rgba(255,255,255,0.08) !important;
        border-radius: 50% !important;
        backdrop-filter: blur(10px);
    }

    /* ============ RESPONSIVE ============ */
    @media (max-width: 1024px) {
        .bento-item:nth-child(1) { grid-column: span 6; }
        .bento-item:nth-child(2) { grid-column: span 6; }
        .bento-item:nth-child(3) { grid-column: span 6; }
        .bento-item:nth-child(4) { grid-column: span 6; }
        .bento-item:nth-child(5) { grid-column: span 6; }
        .bento-item:nth-child(6) { grid-column: span 6; }
        .bento-item:nth-child(7) { grid-column: span 6; }
        .bento-item:nth-child(8) { grid-column: span 6; }
    }

    @media (max-width: 768px) {
        .gal-hero h1 { letter-spacing: -1px; }
        .gal-counter-item { padding: 14px 20px; }
        .bento-grid {
            grid-template-columns: 1fr 1fr;
            grid-auto-rows: 160px;
        }
        .bento-item { grid-column: span 1 !important; grid-row: span 1 !important; }
        .year-cards-grid { grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 480px) {
        .bento-grid { grid-template-columns: 1fr; grid-auto-rows: 200px; }
        .year-cards-grid { grid-template-columns: 1fr; }
    }

    /* ============ REDUCED MOTION ============ */
    @media (prefers-reduced-motion: reduce) {
        .bento-item,
        .yr-card,
        .hl-head .sec-chip, .hl-head h2, .hl-head p,
        .year-head .sec-chip, .year-head h2, .year-head p {
            opacity: 1 !important;
            transform: none !important;
            transition: none !important;
            filter: none !important;
        }
        .gal-hero .container {
            opacity: 1 !important;
            transform: none !important;
        }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>


<div class="scroll-progress-bar" id="scrollProgressBar"></div>


<section class="gal-hero" id="gal-hero">

    
    <div class="gal-hero-bg" id="heroBg">
        <?php $bgPhotos = $highlightPhotos ?? collect(); ?>
        <?php for($col = 0; $col < 5; $col++): ?>
            <div class="gal-hero-bg-col">
                <?php for($row = 0; $row < 4; $row++): ?>
                    <?php $p = $bgPhotos->get($col * 4 + $row); ?>
                    <?php if($p): ?>
                        <img src="<?php echo e(asset('storage/' . $p->file_path)); ?>" alt="">
                    <?php else: ?>
                        <div class="ph-box"></div>
                    <?php endif; ?>
                <?php endfor; ?>
            </div>
        <?php endfor; ?>
    </div>

    <div class="container" id="heroContent">
        <div class="gal-hero-eye">Dokumentasi</div>
        <h1>Galeri <em>Kegiatan</em></h1>
        <p>Momen berharga dari setiap kegiatan dan event di Pondok Pesantren Tahfidzul Qur'an Nurul Huda.</p>

        <div class="gal-counter" id="galCounter">
            <div class="gal-counter-item">
                <span class="num" data-target="<?php echo e($highlightPhotos->count()); ?>" data-suffix="+"><?php echo e($highlightPhotos->count()); ?>+</span>
                <div class="lbl">Foto Terbaru</div>
            </div>
            <div class="gal-counter-item">
                <span class="num" data-target="<?php echo e($years->count()); ?>"><?php echo e($years->count()); ?></span>
                <div class="lbl">Tahun</div>
            </div>
            <div class="gal-counter-item">
                <span class="num" data-target="<?php echo e(\App\Models\Album::count()); ?>"><?php echo e(\App\Models\Album::count()); ?></span>
                <div class="lbl">Album</div>
            </div>
        </div>
    </div>

    <div class="scroll-hint">
        <span>Scroll</span>
        <div class="scroll-bar"></div>
    </div>
</section>


<?php if($highlightPhotos->count() > 0): ?>
<section class="highlight-sec">
    <div class="container">
        <div class="hl-head" id="hlHead">
            <span class="sec-chip">Sorotan</span>
            <h2>Foto Terbaru</h2>
            <p>Momen terkini dari kegiatan kami</p>
        </div>

        <div class="bento-grid" id="bentoGrid">
            <?php $__currentLoopData = $highlightPhotos->take(8); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bento-item">
                    <a href="<?php echo e(asset('storage/' . $photo->file_path)); ?>"
                       class="glightbox"
                       data-gallery="highlight"
                       data-description="<?php echo e($photo->caption); ?>">
                        <img src="<?php echo e(asset('storage/' . $photo->file_path)); ?>"
                             alt="<?php echo e($photo->caption); ?>" loading="lazy">
                    </a>
                    <div class="bento-zoom"><i class="bi bi-zoom-in"></i></div>
                    <div class="bento-overlay">
                        <div class="bento-caption">
                            <div class="bc-title"><?php echo e(Str::limit($photo->caption, 40) ?: 'Foto Kegiatan'); ?></div>
                            <div class="bc-sub">
                                <i class="bi bi-folder2" style="font-size:11px;"></i>
                                <?php echo e($photo->album->name ?? 'Album'); ?>

                                <?php if($photo->album->year ?? false): ?>
                                    &middot; <?php echo e($photo->album->year); ?>

                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php endif; ?>


<section class="year-sec">
    <div class="container">
        <div class="year-head" id="yearHead">
            <span class="sec-chip">Album</span>
            <h2>Pilih Tahun</h2>
            <p>Jelajahi momen berdasarkan tahun kegiatan</p>
        </div>

        <?php if($years->count() > 0): ?>
            <div class="year-cards-grid" id="yearGrid">
                <?php $__currentLoopData = $years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('gallery.year', $year)); ?>" class="yr-card">
                        <div class="yr-card-bg"></div>
                        <div class="yr-card-body">
                            <div class="yr-num"><?php echo e($year); ?></div>
                            <div class="yr-meta">
                                <span class="yr-dot"></span>
                                <?php echo e(\App\Models\Album::where('year', $year)->count()); ?> Album
                            </div>
                        </div>
                        <div class="yr-arrow"><i class="bi bi-arrow-right"></i></div>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php else: ?>
            <div class="empty-state">
                <div class="empty-icon"><i class="bi bi-images"></i></div>
                <h4>Belum Ada Galeri</h4>
                <p>Album galeri akan segera ditambahkan.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
<script>
    /* ────────────────────────────────────────────
       GLightbox
    ──────────────────────────────────────────── */
    GLightbox({
        selector: '.glightbox',
        touchNavigation: true,
        loop: true,
        autoplayVideos: false,
        zoomable: true,
        draggable: true,
        openEffect: 'fade',
        closeEffect: 'fade',
    });

    /* ────────────────────────────────────────────
       SCROLL ANIMATIONS
    ──────────────────────────────────────────── */
    (function () {
        'use strict';

        /* Respect prefers-reduced-motion */
        const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

        /* ── 1. SCROLL PROGRESS BAR ── */
        const progressBar = document.getElementById('scrollProgressBar');
        function updateProgress() {
            const scrollTop  = window.scrollY;
            const docHeight  = document.documentElement.scrollHeight - window.innerHeight;
            const pct        = docHeight > 0 ? (scrollTop / docHeight) * 100 : 0;
            if (progressBar) progressBar.style.width = pct.toFixed(2) + '%';
        }
        window.addEventListener('scroll', updateProgress, { passive: true });
        updateProgress();

        /* ── 2. HERO PARALLAX & FADE-OUT ── */
        if (!prefersReduced) {
            const heroBg      = document.getElementById('heroBg');
            const heroContent = document.getElementById('heroContent');
            const hero        = document.getElementById('gal-hero');

            window.addEventListener('scroll', function () {
                const scrolled = window.scrollY;

                /* Parallax pada background foto */
                if (heroBg) {
                    heroBg.style.transform =
                        'rotate(-3deg) scale(1.15) translateY(' + (scrolled * 0.22) + 'px)';
                }

                /* Fade-out & translateY pada teks hero */
                if (heroContent && hero) {
                    const heroH  = hero.offsetHeight;
                    const ratio  = Math.min(scrolled / (heroH * 0.5), 1);
                    const ease   = 1 - Math.pow(1 - ratio, 3);
                    heroContent.style.opacity   = 1 - ease;
                    heroContent.style.transform = 'translateY(' + (scrolled * 0.15) + 'px)';
                }
            }, { passive: true });
        }

        /* ── 3. SECTION HEADINGS REVEAL ── */
        var headObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    headObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.2, rootMargin: '0px 0px -40px 0px' });

        ['hlHead', 'yearHead'].forEach(function (id) {
            var el = document.getElementById(id);
            if (el) headObserver.observe(el);
        });

        /* ── 4. BENTO ITEMS – stagger ── */
        var bentoGrid = document.getElementById('bentoGrid');
        if (bentoGrid) {
            var bentoObserver = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    if (!entry.isIntersecting) return;
                    var items = entry.target.querySelectorAll('.bento-item');
                    items.forEach(function (item, i) {
                        if (prefersReduced) {
                            item.classList.add('is-visible');
                        } else {
                            setTimeout(function () {
                                item.classList.add('is-visible');
                            }, i * 90);
                        }
                    });
                    bentoObserver.unobserve(entry.target);
                });
            }, { threshold: 0.06 });
            bentoObserver.observe(bentoGrid);
        }

        /* ── 5. YEAR CARDS – stagger ── */
        var yearGrid = document.getElementById('yearGrid');
        if (yearGrid) {
            var yearObserver = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    if (!entry.isIntersecting) return;
                    var cards = entry.target.querySelectorAll('.yr-card');
                    cards.forEach(function (card, i) {
                        if (prefersReduced) {
                            card.classList.add('is-visible');
                        } else {
                            setTimeout(function () {
                                card.classList.add('is-visible');
                            }, i * 110);
                        }
                    });
                    yearObserver.unobserve(entry.target);
                });
            }, { threshold: 0.06 });
            yearObserver.observe(yearGrid);
        }

        /* ── 6. COUNTER COUNT-UP ── */
        function animateCount(el, target, duration, suffix) {
            var start     = performance.now();
            suffix        = suffix || '';
            function update(now) {
                var elapsed  = now - start;
                var progress = Math.min(elapsed / duration, 1);
                /* easeOutExpo */
                var ease     = progress === 1 ? 1 : 1 - Math.pow(2, -10 * progress);
                var val      = Math.round(target * ease);
                el.textContent = val + suffix;
                if (progress < 1) requestAnimationFrame(update);
            }
            requestAnimationFrame(update);
        }

        var galCounter = document.getElementById('galCounter');
        if (galCounter) {
            var counterObserver = new IntersectionObserver(function (entries) {
                entries.forEach(function (entry) {
                    if (!entry.isIntersecting) return;
                    entry.target.querySelectorAll('.num').forEach(function (num) {
                        var target = parseInt(num.getAttribute('data-target'), 10);
                        var suffix = num.getAttribute('data-suffix') || '';
                        if (!isNaN(target) && !prefersReduced) {
                            num.textContent = '0' + suffix;
                            animateCount(num, target, 1500, suffix);
                        }
                    });
                    counterObserver.unobserve(entry.target);
                });
            }, { threshold: 0.6 });
            counterObserver.observe(galCounter);
        }

    })();
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\qofmedia-web\resources\views/public/gallery/index.blade.php ENDPATH**/ ?>