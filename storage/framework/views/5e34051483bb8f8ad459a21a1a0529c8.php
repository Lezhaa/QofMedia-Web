

<?php $__env->startSection('title', 'Struktur Organisasi'); ?>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<style>
    /* ============================================
       SCROLL PROGRESS BAR
       ============================================ */
    .scroll-progress-bar {
        position: fixed;
        top: 0; left: 0;
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

    /* ============================================
       HERO
       ============================================ */
    .struktur-hero {
        position: relative;
        background: linear-gradient(135deg, #0D1B2A 0%, #1B3A4B 50%, #0E7A96 100%);
        padding: 100px 0 80px;
        margin-top: -75px;          /* overlap navbar — was missing */
        overflow: hidden;
        text-align: center;
        min-height: 360px;
        display: flex;
        align-items: center;
    }

    .struktur-hero::before {
        content: '';
        position: absolute;
        top: -50%; right: -20%;
        width: 600px; height: 600px;
        background: radial-gradient(circle, rgba(78,184,204,0.15) 0%, transparent 70%);
        border-radius: 50%;
    }

    .struktur-hero::after {
        content: '';
        position: absolute;
        bottom: -30%; left: -10%;
        width: 400px; height: 400px;
        background: radial-gradient(circle, rgba(168,221,232,0.1) 0%, transparent 70%);
        border-radius: 50%;
    }

    .struktur-hero .container {
        position: relative;
        z-index: 1;
        width: 100%;
        will-change: opacity, transform;
    }

    .struktur-hero .badge {
        display: inline-block;
        background: rgba(255,255,255,0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.2);
        color: #A8DDE8;
        padding: 6px 16px;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 500;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        margin-bottom: 20px;

        opacity: 0;
        transform: translateY(20px);
        animation: fadeUp 0.7s cubic-bezier(0.22, 1, 0.36, 1) 0.1s forwards;
    }

    .struktur-hero h1 {
        font-size: clamp(2.2rem, 5vw, 3.2rem);
        font-weight: 800;
        color: #fff;
        margin-bottom: 16px;
        letter-spacing: -0.5px;
        line-height: 1.2;

        opacity: 0;
        transform: translateY(24px);
        animation: fadeUp 0.75s cubic-bezier(0.22, 1, 0.36, 1) 0.25s forwards;
    }

    .struktur-hero h1 span {
        background: linear-gradient(135deg, #4EB8CC, #A8DDE8);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .struktur-hero p {
        color: rgba(255,255,255,0.7);
        font-size: 1.1rem;
        max-width: 550px;
        margin: 0 auto;
        line-height: 1.7;

        opacity: 0;
        transform: translateY(20px);
        animation: fadeUp 0.7s cubic-bezier(0.22, 1, 0.36, 1) 0.42s forwards;
    }

    /* Scroll hint */
    .scroll-hint-s {
        position: absolute;
        bottom: 22px; left: 50%;
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
        opacity: 0;
        animation: fadeIn 0.6s ease 1s forwards;
    }
    .scroll-bar-s {
        width: 1px; height: 32px;
        background: linear-gradient(to bottom, rgba(78,184,204,0.6), transparent);
        animation: drop 2s ease infinite;
    }
    @keyframes drop {
        0%     { transform: scaleY(0); transform-origin: top; }
        50%    { transform: scaleY(1); transform-origin: top; }
        50.01% { transform: scaleY(1); transform-origin: bottom; }
        100%   { transform: scaleY(0); transform-origin: bottom; }
    }

    /* ============================================
       SECTION HEADER — consistent with other pages
       ============================================ */
    .section-header {
        text-align: center;
        margin-bottom: 48px;
    }

    .section-header .label {
        display: inline-block;
        background: #EEF9FC;       /* chip style — was plain text before */
        color: #0E7A96;
        font-weight: 700;
        font-size: 0.72rem;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        padding: 5px 14px;
        border-radius: 100px;
        margin-bottom: 12px;

        opacity: 0;
        transform: translateY(16px);
        transition: opacity 0.5s cubic-bezier(0.22, 1, 0.36, 1),
                    transform 0.5s cubic-bezier(0.22, 1, 0.36, 1);
    }

    .section-header h2 {
        font-size: 2rem;
        font-weight: 800;
        color: #0D1B2A;
        margin-bottom: 8px;

        opacity: 0;
        transform: translateY(22px);
        transition: opacity 0.6s cubic-bezier(0.22, 1, 0.36, 1) 0.08s,
                    transform 0.6s cubic-bezier(0.22, 1, 0.36, 1) 0.08s;
    }

    .section-header p {
        color: #64748B;
        max-width: 500px;
        margin: 0 auto;
        line-height: 1.6;

        opacity: 0;
        transform: translateY(14px);
        transition: opacity 0.5s cubic-bezier(0.22, 1, 0.36, 1) 0.18s,
                    transform 0.5s cubic-bezier(0.22, 1, 0.36, 1) 0.18s;
    }

    .section-header.is-visible .label,
    .section-header.is-visible h2,
    .section-header.is-visible p {
        opacity: 1;
        transform: none;
    }

    /* ============================================
       DIVISION SECTIONS
       ============================================ */
    .division-section {
        padding: 80px 0;
        background: #fff;
    }

    .division-section.bg-alt {
        background: #F8FAFC;
    }

    /* Swiper wrapper reveal */
    .swiper-reveal {
        opacity: 0;
        transform: translateY(32px);
        transition: opacity 0.7s cubic-bezier(0.22, 1, 0.36, 1),
                    transform 0.7s cubic-bezier(0.22, 1, 0.36, 1);
        will-change: opacity, transform;
    }
    .swiper-reveal.is-visible {
        opacity: 1;
        transform: none;
    }

    /* ============================================
       SWIPER / MEMBER CARD
       ============================================ */
    .member-swiper {
        padding: 30px 50px 50px;
    }

    .swiper-slide {
        text-align: center;
        transition: transform 0.4s ease, opacity 0.4s ease;
        padding: 8px 5px;
        transform: scale(0.85);
        opacity: 0.5;
    }

    .swiper-slide-active {
        transform: scale(1);
        opacity: 1;
    }

    .swiper-slide-prev,
    .swiper-slide-next {
        transform: scale(0.9);
        opacity: 0.75;
    }

    .member-photo {
        width: 180px;
        aspect-ratio: 3 / 4;
        margin: 0 auto 12px;
        border-radius: 20px;
        overflow: hidden;
        border: 3px solid transparent;
        box-shadow: 0 8px 24px rgba(0,0,0,0.06);
        transition: border-color 0.4s ease, box-shadow 0.4s ease;
    }

    .swiper-slide-active .member-photo {
        border-color: #4EB8CC;
        box-shadow: 0 16px 40px rgba(14,122,150,0.15);
    }

    .member-photo img {
        width: 100%; height: 100%;
        object-fit: cover;
        object-position: center 20%;
        display: block;
    }

    .member-photo-placeholder {
        width: 100%; height: 100%;
        background: linear-gradient(135deg, #0E7A96 0%, #4EB8CC 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 64px;
        font-weight: 700;
    }

    /* Member Info */
    .member-info { margin-top: 12px; }

    .member-name {
        font-weight: 700;
        color: #0D1B2A;
        margin-bottom: 2px;
        font-size: 0.95rem;
        transition: font-size 0.3s, margin-bottom 0.3s;
    }

    .swiper-slide-active .member-name {
        font-size: 1.1rem;
        margin-bottom: 6px;
    }

    .member-nickname {
        color: #0E7A96;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        opacity: 0;
        margin-bottom: 8px;
        transition: opacity 0.3s;
    }

    .swiper-slide-active .member-nickname { opacity: 1; }

    /* Social */
    .member-social {
        display: flex;
        justify-content: center;
        margin-top: 5px;
        opacity: 0;
        transform: translateY(10px);
        transition: opacity 0.3s ease, transform 0.3s ease;
    }

    .swiper-slide-active .member-social {
        opacity: 1;
        transform: translateY(0);
    }

    .social-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 6px 14px;
        background: #F1F5F9;
        border: 1px solid #E2E8F0;
        border-radius: 50px;
        text-decoration: none;
        font-size: 0.78rem;
        font-weight: 500;
        color: #475569;
        transition: all 0.3s ease;
    }

    .social-link i { font-size: 0.9rem; }

    .social-link:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
    .social-link.instagram:hover { background: linear-gradient(45deg,#f09433,#e6683c,#dc2743,#cc2366,#bc1888); color:#fff; border-color:transparent; }
    .social-link.twitter:hover,
    .social-link.x:hover          { background:#000; color:#fff; border-color:transparent; }
    .social-link.linkedin:hover    { background:#0077b5; color:#fff; border-color:transparent; }
    .social-link.github:hover      { background:#333; color:#fff; border-color:transparent; }
    .social-link.tiktok:hover      { background:#000; color:#00f2ea; border-color:transparent; }
    .social-link.facebook:hover    { background:#1877f2; color:#fff; border-color:transparent; }
    .social-link.youtube:hover     { background:#ff0000; color:#fff; border-color:transparent; }
    .social-link.whatsapp:hover    { background:#25d366; color:#fff; border-color:transparent; }
    .social-link.telegram:hover    { background:#26a5e4; color:#fff; border-color:transparent; }

    /* ============================================
       SWIPER NAVIGATION
       ============================================ */
    .swiper-button-next,
    .swiper-button-prev {
        width: 44px; height: 44px;
        background: #fff;
        border-radius: 50%;
        box-shadow: 0 4px 16px rgba(0,0,0,0.08);
        color: #0E7A96;
        border: 1px solid #E2E8F0;
        transition: all 0.3s;
    }

    .swiper-button-next:hover,
    .swiper-button-prev:hover {
        background: #0E7A96;
        color: #fff;
        border-color: #0E7A96;
    }

    .swiper-button-next::after,
    .swiper-button-prev::after { font-size: 14px; font-weight: 700; }

    .swiper-pagination-bullet { background: #CBD5E1; opacity: 1; }
    .swiper-pagination-bullet-active {
        background: #0E7A96;
        width: 28px;
        border-radius: 10px;
    }

    /* Empty state */
    .empty-members {
        text-align: center;
        padding: 40px 0;
        color: #94A3B8;
        font-size: 0.95rem;
    }

    /* ============================================
       CTA SECTION
       ============================================ */
    .cta-join { padding: 80px 0; background: #fff; }

    .cta-join-card {
        background: linear-gradient(135deg, #0D1B2A 0%, #1B3A4B 50%, #0E7A96 100%);
        border-radius: 24px;
        padding: 56px 48px;
        text-align: center;
        position: relative;
        overflow: hidden;

        opacity: 0;
        transform: translateY(40px) scale(0.98);
        transition: opacity 0.8s cubic-bezier(0.22, 1, 0.36, 1),
                    transform 0.8s cubic-bezier(0.22, 1, 0.36, 1);
        will-change: opacity, transform;
    }

    .cta-join-card.is-visible { opacity: 1; transform: none; }

    .cta-join-card::before {
        content: '';
        position: absolute;
        top: -50%; right: -20%;
        width: 400px; height: 400px;
        background: radial-gradient(circle, rgba(78,184,204,0.2) 0%, transparent 70%);
        border-radius: 50%;
    }

    .cta-join-card > * { position: relative; z-index: 1; }

    .cta-join-card h2 { color: #fff; font-weight: 800; font-size: 2rem; margin-bottom: 12px; }
    .cta-join-card p  { color: rgba(255,255,255,0.7); font-size: 1.05rem; margin-bottom: 28px; }

    .btn-cta-primary {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #4EB8CC;
        color: #0D1B2A;
        border: none;
        padding: 14px 32px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 0.95rem;
        text-decoration: none;
        transition: all 0.3s;
    }

    .btn-cta-primary:hover {
        background: #A8DDE8;
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(78,184,204,0.3);
        color: #0D1B2A;
    }

    /* ============================================
       GLOBAL KEYFRAMES
       ============================================ */
    @keyframes fadeUp  { to { opacity: 1; transform: none; } }
    @keyframes fadeIn  { to { opacity: 1; } }

    /* ============================================
       RESPONSIVE
       ============================================ */
    @media (max-width: 992px) {
        .member-photo { width: 160px; }
        .social-link  { padding: 5px 12px; font-size: 0.72rem; }
    }

    @media (max-width: 768px) {
        .struktur-hero  { padding: 70px 0 50px; }
        .member-photo   { width: 150px; }
        .member-swiper  { padding: 20px 40px 35px; }
        .cta-join-card  { padding: 36px 24px; }
        .cta-join-card h2 { font-size: 1.5rem; }
    }

    @media (max-width: 480px) {
        .member-photo  { width: 130px; }
        .member-swiper { padding: 15px 35px 25px; }
        .social-link span  { display: none; }
        .social-link { padding: 5px 10px; }
        .social-link i { font-size: 1rem; margin: 0; }
    }

    /* ============================================
       REDUCED MOTION
       ============================================ */
    @media (prefers-reduced-motion: reduce) {
        .struktur-hero .badge,
        .struktur-hero h1,
        .struktur-hero p,
        .scroll-hint-s,
        .section-header .label,
        .section-header h2,
        .section-header p,
        .swiper-reveal,
        .cta-join-card {
            opacity: 1 !important;
            transform: none !important;
            transition: none !important;
            animation: none !important;
        }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>


<div class="scroll-progress-bar" id="scrollProgressBar"></div>


<section class="struktur-hero" id="strukturHero">
    <div class="container">
        <span class="badge">Tim Kami</span>
        <h1>Di Balik Layar <span>QofMedia</span></h1>
        <p>Kenali tim kreatif yang siap mewujudkan ide-ide brilian Anda menjadi karya nyata</p>
    </div>

    <div class="scroll-hint-s">
        <span>Scroll</span>
        <div class="scroll-bar-s"></div>
    </div>
</section>


<?php
    $divisions = \App\Models\Division::with(['activeMembers' => function ($q) {
        $q->orderBy('division_member.order');
    }])->where('is_active', true)->orderBy('order')->get();
?>

<?php $__currentLoopData = $divisions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $division): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<section class="division-section <?php echo e($index % 2 !== 0 ? 'bg-alt' : ''); ?>"
         data-division="<?php echo e($division->id); ?>">
    <div class="container">
        
        <div class="section-header js-section-header">
            <span class="label">Divisi</span>
            <h2><?php echo e($division->name); ?></h2>
            <?php if($division->description): ?>
                <p><?php echo e($division->description); ?></p>
            <?php endif; ?>
        </div>

        <?php if($division->activeMembers->count() > 0): ?>
            
            <div class="swiper member-swiper swiper-reveal js-swiper-reveal"
                 id="swiper-div-<?php echo e($division->id); ?>">
                <div class="swiper-wrapper">
                    <?php $__currentLoopData = $division->activeMembers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="swiper-slide">
                            <div class="member-photo">
                                <?php if($member->photo_url): ?>
                                    <img src="<?php echo e($member->photo_url); ?>"
                                         alt="<?php echo e($member->name); ?>" loading="lazy">
                                <?php else: ?>
                                    <div class="member-photo-placeholder">
                                        <?php echo e(strtoupper(substr($member->nickname ?: $member->name, 0, 1))); ?>

                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="member-info">
                                <div class="member-name"><?php echo e($member->name); ?></div>
                                <?php if($member->nickname): ?>
                                    <div class="member-nickname"><?php echo e($member->nickname); ?></div>
                                <?php endif; ?>

                                <?php if($member->social_platform && $member->social_username): ?>
                                    <div class="member-social">
                                        <a href="<?php echo e($member->social_url ?? '#'); ?>"
                                           target="_blank"
                                           rel="noopener noreferrer"
                                           class="social-link <?php echo e($member->social_platform); ?>">
                                            <i class="bi <?php echo e($member->social_icon ?? 'bi-share'); ?>"></i>
                                            <span><?php echo e($member->social_platform_name ?? ucfirst($member->social_platform)); ?></span>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
        <?php else: ?>
            <div class="empty-members">
                <i class="bi bi-people" style="font-size:2rem; display:block; margin-bottom:8px; opacity:.35;"></i>
                Belum ada anggota di divisi ini.
            </div>
        <?php endif; ?>
    </div>
</section>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


<section class="cta-join">
    <div class="container">
        <div class="cta-join-card" id="ctaJoinCard">
            <h2>Ingin Bergabung dengan Tim Kami?</h2>
            <p>QofMedia selalu membuka kesempatan bagi yang ingin mengembangkan bakat di bidang multimedia. Mari berkarya bersama!</p>
            <a href="<?php echo e(route('contact')); ?>" class="btn-cta-primary">
                <i class="bi bi-envelope"></i> Hubungi Kami
            </a>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
(function () {
    'use strict';

    var prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    /* ── 1. SCROLL PROGRESS BAR ── */
    var progressBar = document.getElementById('scrollProgressBar');
    function updateProgress() {
        var scrollTop = window.scrollY;
        var docHeight = document.documentElement.scrollHeight - window.innerHeight;
        var pct = docHeight > 0 ? (scrollTop / docHeight) * 100 : 0;
        if (progressBar) progressBar.style.width = pct.toFixed(2) + '%';
    }
    window.addEventListener('scroll', updateProgress, { passive: true });
    updateProgress();

    /* ── 2. HERO PARALLAX FADE-OUT ── */
    if (!prefersReduced) {
        var hero        = document.getElementById('strukturHero');
        var heroContent = hero ? hero.querySelector('.container') : null;

        window.addEventListener('scroll', function () {
            if (!hero || !heroContent) return;
            var scrolled = window.scrollY;
            var heroH    = hero.offsetHeight;
            var ratio    = Math.min(scrolled / (heroH * 0.55), 1);
            var ease     = 1 - Math.pow(1 - ratio, 3);
            heroContent.style.opacity   = 1 - ease;
            heroContent.style.transform = 'translateY(' + (scrolled * 0.12) + 'px)';
        }, { passive: true });
    }

    /* ── 3. SECTION HEADER REVEAL ── */
    var headerObserver = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                headerObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.2, rootMargin: '0px 0px -30px 0px' });

    document.querySelectorAll('.js-section-header').forEach(function (el) {
        headerObserver.observe(el);
    });

    /* ── 4. SWIPER WRAPPER REVEAL ── */
    var swiperRevealObserver = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                swiperRevealObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.08 });

    document.querySelectorAll('.js-swiper-reveal').forEach(function (el) {
        swiperRevealObserver.observe(el);
    });

    /* ── 5. SWIPER INIT ── */
    // Fix: use the element's own id to scope navigation/pagination selectors
    document.querySelectorAll('.member-swiper').forEach(function (el) {
        var id = '#' + el.id;   // e.g. "#swiper-div-1"

        new Swiper(id, {
            slidesPerView   : 1,
            centeredSlides  : true,
            loop            : true,
            spaceBetween    : 30,
            breakpoints: {
                480  : { slidesPerView: 2, spaceBetween: 20 },
                768  : { slidesPerView: 3, spaceBetween: 25 },
                992  : { slidesPerView: 4, spaceBetween: 30 },
                1200 : { slidesPerView: 5, spaceBetween: 35 },
            },
            navigation: {
                nextEl: id + ' .swiper-button-next',
                prevEl: id + ' .swiper-button-prev',
            },
            pagination: {
                el        : id + ' .swiper-pagination',
                clickable : true,
            },
            autoplay: {
                delay               : 3500,
                disableOnInteraction: false,
                pauseOnMouseEnter   : true,   // pause when user hovers
            },
        });
    });

    /* ── 6. CTA CARD REVEAL ── */
    var ctaCard = document.getElementById('ctaJoinCard');
    if (ctaCard) {
        var ctaObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                    ctaObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.15 });
        ctaObserver.observe(ctaCard);
    }

})();
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\qofmedia-web\resources\views/public/about/structure.blade.php ENDPATH**/ ?>