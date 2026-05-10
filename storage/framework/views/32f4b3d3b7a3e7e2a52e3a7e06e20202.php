

<?php $__env->startSection('title', 'Qof Studio'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    /* Fix padding body */
    body {
        padding-top: 0 !important;
    }

    /* ============================================
       HERO MODERN
       ============================================ */
    .studio-hero {
        position: relative;
        background: linear-gradient(135deg, #0D1B2A 0%, #1B3A4B 50%, #0E7A96 100%);
        padding: 100px 0 60px;
        overflow: hidden;
        text-align: center;
    }

    .studio-hero::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 600px;
        height: 600px;
        background: radial-gradient(circle, rgba(78,184,204,0.15) 0%, transparent 70%);
        border-radius: 50%;
    }

    .studio-hero::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -10%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(168,221,232,0.1) 0%, transparent 70%);
        border-radius: 50%;
    }

    .studio-hero .container {
        position: relative;
        z-index: 1;
    }

    .studio-hero .badge {
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

    .studio-hero h1 {
        font-size: clamp(2.2rem, 5vw, 3.2rem);
        font-weight: 800;
        color: #fff;
        margin-bottom: 16px;
        letter-spacing: -0.5px;
        line-height: 1.2;
    }

    .studio-hero h1 span {
        background: linear-gradient(135deg, #4EB8CC, #A8DDE8);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .studio-hero p {
        color: rgba(255,255,255,0.7);
        font-size: 1.1rem;
        max-width: 550px;
        margin: 0 auto;
        line-height: 1.7;
    }

    /* ============================================
       TABS MODERN
       ============================================ */
    .tabs-section {
        margin-top: -30px;
        position: relative;
        z-index: 10;
        padding-bottom: 20px;
    }

    .tabs-wrapper {
        background: white;
        border-radius: 60px;
        padding: 8px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.08);
        display: inline-flex;
        gap: 4px;
        flex-wrap: wrap;
        justify-content: center;
    }

    .tabs-wrapper .nav-link {
        border: none !important;
        border-radius: 50px !important;
        padding: 12px 28px !important;
        font-weight: 600;
        font-size: 0.9rem;
        color: #64748B !important;
        background: transparent !important;
        transition: all 0.3s;
        white-space: nowrap;
    }

    .tabs-wrapper .nav-link:hover {
        color: #0E7A96 !important;
        background: rgba(14,122,150,0.06) !important;
    }

    .tabs-wrapper .nav-link.active {
        background: linear-gradient(135deg, #0E7A96, #4EB8CC) !important;
        color: white !important;
        box-shadow: 0 4px 16px rgba(14,122,150,0.3);
    }

    /* ============================================
       SECTION HEADER
       ============================================ */
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

    .section-header p {
        color: #64748B;
        max-width: 500px;
        margin: 0 auto;
        line-height: 1.6;
    }

    /* ============================================
       CONTENT SECTION
       ============================================ */
    .content-section {
        padding: 40px 0 80px;
        background: #F8FAFC;
    }

    /* ============================================
       SERVICE CARD
       ============================================ */
    .service-card {
        background: white;
        border-radius: 20px;
        padding: 28px 24px;
        height: 100%;
        box-shadow: 0 4px 16px rgba(0,0,0,0.04);
        transition: all 0.3s;
        border: 1px solid #E2E8F0;
        position: relative;
        overflow: hidden;
    }

    .service-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 50px rgba(14,122,150,0.1);
        border-color: #4EB8CC;
    }

    .service-card .card-image {
        width: 100%;
        height: 200px;
        border-radius: 14px;
        object-fit: cover;
        margin-bottom: 16px;
    }

    .card-placeholder {
        width: 100%;
        height: 200px;
        border-radius: 14px;
        background: linear-gradient(135deg, #EEF2FF 0%, #E0E7FF 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 16px;
    }

    .card-placeholder i {
        font-size: 48px;
        color: #0E7A96;
        opacity: 0.3;
    }

    .service-icon-circle {
        width: 56px;
        height: 56px;
        background: linear-gradient(135deg, #0E7A96, #4EB8CC);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 16px;
    }

    .service-icon-circle i {
        font-size: 24px;
        color: white;
    }

    .badge-stock {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .badge-stock.available {
        background: #D1FAE5;
        color: #065F46;
    }

    .badge-stock.unavailable {
        background: #FEE2E2;
        color: #991B1B;
    }

    .badge-category {
        display: inline-block;
        padding: 4px 12px;
        background: rgba(14,122,150,0.08);
        color: #0E7A96;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .badge-popular {
        position: absolute;
        top: 16px;
        right: 16px;
        background: linear-gradient(135deg, #F59E0B, #FBBF24);
        color: #0D1B2A;
        padding: 5px 14px;
        border-radius: 50px;
        font-size: 0.72rem;
        font-weight: 700;
        z-index: 2;
    }

    .price-tag {
        font-size: 1.3rem;
        font-weight: 700;
        color: #0E7A96;
        margin-bottom: 4px;
    }

    .price-tag small {
        font-size: 0.78rem;
        font-weight: 400;
        color: #64748B;
    }

    .feature-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .feature-list li {
        padding: 8px 0;
        color: #475569;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 0.88rem;
        border-bottom: 1px solid #F1F5F9;
    }

    .feature-list li:last-child {
        border-bottom: none;
    }

    .feature-list li i {
        color: #10B981;
        font-size: 1rem;
        flex-shrink: 0;
    }

    .btn-wa {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        background: #25D366;
        color: white;
        border: none;
        border-radius: 50px;
        padding: 12px 24px;
        font-weight: 600;
        font-size: 0.9rem;
        width: 100%;
        text-decoration: none;
        transition: all 0.3s;
    }

    .btn-wa:hover {
        background: #20BA5A;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(37,211,102,0.3);
    }

    .btn-disabled {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: #E2E8F0;
        color: #94A3B8;
        border: none;
        border-radius: 50px;
        padding: 12px 24px;
        font-weight: 600;
        font-size: 0.9rem;
        width: 100%;
        cursor: not-allowed;
    }

    /* ============================================
       WHY US
       ============================================ */
    .why-us-section {
        padding: 80px 0;
        background: white;
    }

    .why-us-card {
        text-align: center;
        padding: 24px 16px;
        transition: all 0.3s;
    }

    .why-us-icon {
        width: 64px;
        height: 64px;
        background: linear-gradient(135deg, rgba(14,122,150,0.1), rgba(78,184,204,0.1));
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 16px;
        font-size: 28px;
        color: #0E7A96;
    }

    .why-us-card h5 {
        font-weight: 700;
        color: #0D1B2A;
        margin-bottom: 6px;
        font-size: 1rem;
    }

    .why-us-card p {
        color: #64748B;
        font-size: 0.85rem;
        margin: 0;
    }

    /* ============================================
       CTA
       ============================================ */
    .cta-studio {
        padding: 80px 0;
        background: white;
    }

    .cta-studio-card {
        background: linear-gradient(135deg, #0D1B2A 0%, #1B3A4B 50%, #0E7A96 100%);
        border-radius: 24px;
        padding: 56px 48px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .cta-studio-card::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(78,184,204,0.2) 0%, transparent 70%);
        border-radius: 50%;
    }

    .cta-studio-card > * {
        position: relative;
        z-index: 1;
    }

    .cta-studio-card h2 {
        color: #fff;
        font-weight: 800;
        font-size: 2rem;
        margin-bottom: 12px;
    }

    .cta-studio-card p {
        color: rgba(255,255,255,0.7);
        font-size: 1.05rem;
        margin-bottom: 28px;
    }

    .btn-cta-wa {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: #25D366;
        color: white;
        padding: 16px 36px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 1rem;
        text-decoration: none;
        transition: all 0.3s;
    }

    .btn-cta-wa:hover {
        background: #20BA5A;
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(37,211,102,0.3);
        color: white;
    }

    /* ============================================
       RESPONSIVE
       ============================================ */
    @media (max-width: 768px) {
        .studio-hero {
            padding: 70px 0 40px;
        }

        .tabs-wrapper .nav-link {
            padding: 10px 18px !important;
            font-size: 0.8rem;
        }

        .cta-studio-card {
            padding: 36px 24px;
        }

        .cta-studio-card h2 {
            font-size: 1.5rem;
        }

        .service-card {
            padding: 20px 16px;
        }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>


<section class="studio-hero">
    <div class="container">
        <span class="badge">Layanan</span>
        <h1><span>Qof</span> Studio</h1>
        <p>Layanan multimedia profesional untuk kebutuhan fotografi dan videografi Anda</p>
    </div>
</section>


<section class="tabs-section">
    <div class="container text-center">
        <div class="tabs-wrapper">
            <ul class="nav" id="studioTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="rental-tab" data-bs-toggle="tab" data-bs-target="#rental" type="button">
                        <i class="bi bi-tools me-2"></i>Persewaan Alat
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="studio-package-tab" data-bs-toggle="tab" data-bs-target="#studio-package" type="button">
                        <i class="bi bi-building me-2"></i>Paket Studio
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="photo-tab" data-bs-toggle="tab" data-bs-target="#photo" type="button">
                        <i class="bi bi-camera me-2"></i>Jasa Fotografi
                    </button>
                </li>
            </ul>
        </div>
    </div>
</section>


<section class="content-section">
    <div class="container">
        <div class="tab-content" id="studioTabContent">

            
            <div class="tab-pane fade show active" id="rental" role="tabpanel">
                <div class="section-header">
                    <span class="label">Katalog</span>
                    <h2>Persewaan Alat Multimedia</h2>
                    <p>Peralatan profesional yang tersedia untuk disewa</p>
                </div>

                <div class="row g-4">
                    <?php $__empty_1 = true; $__currentLoopData = $tools; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tool): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="service-card h-100">
                                <?php if($tool->image): ?>
                                    <img src="<?php echo e(asset('storage/' . $tool->image)); ?>" class="card-image" alt="<?php echo e($tool->name); ?>" loading="lazy">
                                <?php else: ?>
                                    <div class="card-placeholder">
                                        <i class="bi bi-tools"></i>
                                    </div>
                                <?php endif; ?>

                                <span class="badge-stock <?php echo e($tool->is_available && $tool->stock > 0 ? 'available' : 'unavailable'); ?>">
                                    <?php echo e($tool->is_available && $tool->stock > 0 ? 'Tersedia' : 'Habis'); ?>

                                </span>

                                <h5 class="fw-bold mb-1"><?php echo e($tool->name); ?></h5>
                                <span class="badge-category"><?php echo e($tool->category); ?></span>
                                <p class="text-muted small mb-2"><?php echo e(Str::limit($tool->description, 80)); ?></p>

                                <div class="price-tag">
                                    Rp <?php echo e(number_format($tool->price_per_day, 0, ',', '.')); ?> <small>/ hari</small>
                                </div>
                                <p class="small text-muted mb-3">Stok: <?php echo e($tool->stock); ?></p>

                                <?php if($tool->is_available && $tool->stock > 0): ?>
                                    <a href="https://wa.me/<?php echo e($whatsappNumber ?? '6281246943349'); ?>?text=<?php echo e(urlencode('Halo, saya tertarik menyewa ' . $tool->name)); ?>"
                                       class="btn-wa" target="_blank">
                                        <i class="bi bi-whatsapp"></i> Sewa Alat Ini
                                    </a>
                                <?php else: ?>
                                    <button class="btn-disabled" disabled>Stok Habis</button>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="col-12 text-center py-5">
                            <i class="bi bi-tools" style="font-size: 64px; color: #0E7A96; opacity: 0.3;"></i>
                            <h4 class="mt-3 fw-bold">Belum Ada Alat</h4>
                            <p class="text-muted">Alat studio akan segera tersedia.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            
            <div class="tab-pane fade" id="studio-package" role="tabpanel">
                <div class="section-header">
                    <span class="label">Paket</span>
                    <h2>Paket Studio</h2>
                    <p>Pilihan paket shooting sesuai kebutuhan Anda</p>
                </div>

                <div class="row g-4">
                    <?php $__empty_1 = true; $__currentLoopData = $studioPackages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="col-md-6">
                            <div class="service-card h-100 text-center">
                                <div class="service-icon-circle">
                                    <i class="bi bi-camera-reels-fill"></i>
                                </div>
                                <h5 class="fw-bold"><?php echo e($package->name); ?></h5>
                                <span class="badge-category"><?php echo e($package->type ?? 'Studio'); ?></span>
                                <p class="text-muted small mb-2"><?php echo e($package->description); ?></p>
                                <div class="price-tag mb-1">Rp <?php echo e(number_format($package->price, 0, ',', '.')); ?></div>
                                <p class="small text-muted mb-3">Durasi: <?php echo e($package->duration); ?></p>

                                <?php $facilities = is_string($package->facilities) ? json_decode($package->facilities, true) : $package->facilities; ?>
                                <?php if(!empty($facilities) && is_array($facilities)): ?>
                                    <ul class="feature-list mb-3 text-start">
                                        <?php $__currentLoopData = $facilities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $facility): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li><i class="bi bi-check-circle-fill"></i> <?php echo e($facility); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                <?php endif; ?>

                                <a href="https://wa.me/<?php echo e($whatsappNumber ?? '6281246943349'); ?>?text=<?php echo e(urlencode('Halo, saya tertarik paket ' . $package->name)); ?>"
                                   class="btn-wa" target="_blank">
                                    <i class="bi bi-whatsapp"></i> Booking Sekarang
                                </a>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="col-12 text-center py-5">
                            <i class="bi bi-camera-reels" style="font-size: 64px; color: #0E7A96; opacity: 0.3;"></i>
                            <h4 class="mt-3 fw-bold">Belum Ada Paket</h4>
                            <p class="text-muted">Paket studio akan segera tersedia.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            
            <div class="tab-pane fade" id="photo" role="tabpanel">
                <div class="section-header">
                    <span class="label">Fotografi</span>
                    <h2>Jasa Fotografi</h2>
                    <p>Dokumentasi profesional untuk momen spesial Anda</p>
                </div>

                <div class="row g-4">
                    <?php $__empty_1 = true; $__currentLoopData = $photoPackages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="service-card h-100 text-center">
                                <?php if($package->is_popular ?? false): ?>
                                    <span class="badge-popular">
                                        <i class="bi bi-star-fill me-1"></i>POPULER
                                    </span>
                                <?php endif; ?>

                                <div class="service-icon-circle">
                                    <i class="bi bi-camera-fill"></i>
                                </div>
                                <h5 class="fw-bold"><?php echo e($package->name); ?></h5>
                                <div class="price-tag mb-1">Rp <?php echo e(number_format($package->price, 0, ',', '.')); ?></div>
                                <p class="small text-muted mb-2"><?php echo e($package->duration); ?></p>
                                <p class="text-muted small mb-2"><?php echo e($package->description); ?></p>

                                <?php $features = is_string($package->features) ? json_decode($package->features, true) : $package->features; ?>
                                <?php if(!empty($features) && is_array($features)): ?>
                                    <ul class="feature-list mb-3 text-start">
                                        <?php $__currentLoopData = $features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li><i class="bi bi-check-circle-fill"></i> <?php echo e($feature); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                <?php endif; ?>

                                <a href="https://wa.me/<?php echo e($whatsappNumber ?? '6281246943349'); ?>?text=<?php echo e(urlencode('Halo, saya tertarik ' . $package->name)); ?>"
                                   class="btn-wa" target="_blank">
                                    <i class="bi bi-whatsapp"></i> Pilih Paket
                                </a>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="col-12 text-center py-5">
                            <i class="bi bi-camera-fill" style="font-size: 64px; color: #0E7A96; opacity: 0.3;"></i>
                            <h4 class="mt-3 fw-bold">Belum Ada Paket</h4>
                            <p class="text-muted">Paket fotografi akan segera tersedia.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="why-us-section">
    <div class="container">
        <div class="section-header">
            <span class="label">Keunggulan</span>
            <h2>Mengapa Memilih Qof Studio?</h2>
            <p>Keunggulan layanan studio kami</p>
        </div>

        <div class="row g-4">
            <div class="col-6 col-md-3">
                <div class="why-us-card">
                    <div class="why-us-icon"><i class="bi bi-tools"></i></div>
                    <h5>Peralatan Modern</h5>
                    <p>Alat terbaru berkualitas tinggi</p>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="why-us-card">
                    <div class="why-us-icon"><i class="bi bi-people-fill"></i></div>
                    <h5>Tim Profesional</h5>
                    <p>Fotografer berpengalaman</p>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="why-us-card">
                    <div class="why-us-icon"><i class="bi bi-clock-history"></i></div>
                    <h5>Tepat Waktu</h5>
                    <p>Sesuai jadwal yang disepakati</p>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="why-us-card">
                    <div class="why-us-icon"><i class="bi bi-shield-check"></i></div>
                    <h5>Harga Terjangkau</h5>
                    <p>Kualitas premium harga bersahabat</p>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="cta-studio">
    <div class="container">
        <div class="cta-studio-card">
            <h2>Siap untuk Shooting?</h2>
            <p>Hubungi kami sekarang untuk konsultasi dan pemesanan</p>
            <a href="https://wa.me/<?php echo e($whatsappNumber ?? '6285156073776'); ?>" target="_blank" class="btn-cta-wa">
                <i class="bi bi-whatsapp"></i> Chat via WhatsApp
            </a>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\qofmedia-web\resources\views/public/service/studio.blade.php ENDPATH**/ ?>