

<?php $__env->startSection('title', 'Galeri ' . $year); ?>

<?php $__env->startPush('styles'); ?>
<style>
    /* Fix padding body */
    body {
        padding-top: 0 !important;
    }

    /* ============================================
       HERO MODERN
       ============================================ */
    .gallery-year-hero {
        position: relative;
        background: linear-gradient(135deg, #0D1B2A 0%, #1B3A4B 50%, #0E7A96 100%);
        padding: 100px 0 80px;
        overflow: hidden;
        text-align: center;
    }

    .gallery-year-hero::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 600px;
        height: 600px;
        background: radial-gradient(circle, rgba(78,184,204,0.15) 0%, transparent 70%);
        border-radius: 50%;
    }

    .gallery-year-hero::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -10%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(168,221,232,0.1) 0%, transparent 70%);
        border-radius: 50%;
    }

    .gallery-year-hero .container {
        position: relative;
        z-index: 1;
    }

    .breadcrumb {
        margin-bottom: 16px;
    }

    .breadcrumb-item a {
        color: rgba(255,255,255,0.6);
        text-decoration: none;
        font-size: 0.85rem;
        transition: color 0.3s;
    }

    .breadcrumb-item a:hover {
        color: #4EB8CC;
    }

    .breadcrumb-item.active {
        color: rgba(255,255,255,0.9);
        font-size: 0.85rem;
    }

    .breadcrumb-item + .breadcrumb-item::before {
        color: rgba(255,255,255,0.4);
    }

    .gallery-year-hero .badge {
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
    }

    .gallery-year-hero h1 {
        font-size: clamp(2.2rem, 5vw, 3.2rem);
        font-weight: 800;
        color: #fff;
        margin-bottom: 16px;
        letter-spacing: -0.5px;
        line-height: 1.2;
    }

    .gallery-year-hero h1 span {
        background: linear-gradient(135deg, #4EB8CC, #A8DDE8);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .gallery-year-hero p {
        color: rgba(255,255,255,0.7);
        font-size: 1.1rem;
        max-width: 550px;
        margin: 0 auto;
        line-height: 1.7;
    }

    /* ============================================
       ALBUM CARDS
       ============================================ */
    .albums-section {
        padding: 80px 0;
        background: #F8FAFC;
    }

    .section-header {
        text-align: center;
        margin-bottom: 48px;
    }

    .section-header .label {
        display: inline-block;
        color: #0E7A96;
        font-weight: 600;
        font-size: 0.8rem;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        margin-bottom: 10px;
    }

    .section-header h2 {
        font-size: 2rem;
        font-weight: 800;
        color: #0D1B2A;
        margin-bottom: 8px;
    }

    .album-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        border: 1px solid #E2E8F0;
        transition: all 0.3s;
        height: 100%;
    }

    .album-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 16px 40px rgba(14,122,150,0.1);
        border-color: #4EB8CC;
    }

    .album-card-img {
        height: 200px;
        overflow: hidden;
    }

    .album-card-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s;
    }

    .album-card:hover .album-card-img img {
        transform: scale(1.05);
    }

    .album-placeholder {
        height: 200px;
        background: linear-gradient(135deg, #EEF2FF 0%, #E0E7FF 100%);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .album-placeholder i {
        font-size: 48px;
        color: #0E7A96;
        opacity: 0.3;
    }

    .album-card .card-body {
        padding: 20px;
    }

    .album-card .card-title {
        font-weight: 700;
        color: #0D1B2A;
        font-size: 1rem;
        margin-bottom: 8px;
    }

    .album-card .card-text {
        color: #64748B;
        font-size: 0.85rem;
        line-height: 1.6;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .album-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 12px;
        padding-top: 12px;
        border-top: 1px solid #F1F5F9;
    }

    .badge-item {
        background: rgba(14,122,150,0.1);
        color: #0E7A96;
        padding: 4px 12px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .text-date {
        color: #94A3B8;
        font-size: 0.75rem;
    }

    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: white;
        color: #0E7A96;
        border: 1.5px solid #0E7A96;
        padding: 10px 24px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.9rem;
        text-decoration: none;
        transition: all 0.3s;
    }

    .btn-back:hover {
        background: #0E7A96;
        color: white;
    }

    /* ============================================
       RESPONSIVE
       ============================================ */
    @media (max-width: 768px) {
        .gallery-year-hero {
            padding: 70px 0 50px;
        }
        .album-card-img {
            height: 160px;
        }
        .album-placeholder {
            height: 160px;
        }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>


<section class="gallery-year-hero">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="<?php echo e(route('gallery.index')); ?>">Galeri</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo e($year); ?></li>
            </ol>
        </nav>
        <span class="badge">Album</span>
        <h1>Tahun <span><?php echo e($year); ?></span></h1>
        <p><?php echo e($albums->count()); ?> album tersedia</p>
    </div>
</section>


<section class="albums-section">
    <div class="container">
        <div class="row g-4">
            <?php $__empty_1 = true; $__currentLoopData = $albums; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $album): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-md-4 col-lg-3">
                    <a href="<?php echo e(route('gallery.album', ['year' => $album->year, 'slug' => $album->slug])); ?>" class="text-decoration-none">
                        <div class="album-card">
                            <?php if($album->cover_image): ?>
                                <div class="album-card-img">
                                    <img src="<?php echo e(asset('storage/' . $album->cover_image)); ?>" alt="<?php echo e($album->name); ?>" loading="lazy">
                                </div>
                            <?php else: ?>
                                <div class="album-placeholder">
                                    <i class="bi bi-images"></i>
                                </div>
                            <?php endif; ?>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo e($album->name); ?></h5>
                                <p class="card-text"><?php echo e(Str::limit($album->description, 60)); ?></p>
                                <div class="album-meta">
                                    <span class="badge-item"><?php echo e($album->items_count ?? 0); ?> Item</span>
                                    <span class="text-date"><?php echo e($album->created_at->format('d M Y')); ?></span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-12">
                    <div class="text-center py-5">
                        <i class="bi bi-folder" style="font-size: 64px; color: #0E7A96; opacity: 0.3;"></i>
                        <h4 class="mt-3 fw-bold">Belum Ada Album</h4>
                        <p class="text-muted">Belum ada album untuk tahun <?php echo e($year); ?>.</p>
                        <a href="<?php echo e(route('gallery.index')); ?>" class="btn-back mt-3">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <?php if($albums->count() > 0): ?>
            <div class="text-center mt-5">
                <a href="<?php echo e(route('gallery.index')); ?>" class="btn-back">
                    <i class="bi bi-arrow-left"></i> Pilih Tahun Lain
                </a>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\qofmedia-web\resources\views/public/gallery/year.blade.php ENDPATH**/ ?>