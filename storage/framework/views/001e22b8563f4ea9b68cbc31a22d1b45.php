

<?php $__env->startSection('title', 'Beranda'); ?>

<?php $__env->startPush('styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/home.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

     
<section class="hero-section">
    <div class="container hero-content">
        <h1 class="hero-title">
            Selamat datang <br>
            <span>di QofMedia</span>
        </h1>
        <p class="hero-subtitle">
            Tim Multimedia Pondok Pesantren Tahfidzul Qur'an Nurul Huda
        </p>
        <a href="<?php echo e($settings['hero_cta_url'] ?? route('service.studio')); ?>" class="btn btn-hero">
            Jelajahi Layanan <i class="bi bi-arrow-right"></i>
        </a>
    </div>

    
    <div class="hero-scroll-hint">
        <span>Scroll</span>
        <i class="bi bi-chevron-down"></i>
    </div>
</section>


<section class="about-cuplikan-section">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-5 scroll-reveal">
                <div class="about-image-wrapper">
                    <?php
                        $aboutPhoto = 'images/logo/logo-qof.png';
                        $hasPhoto = file_exists(public_path($aboutPhoto));
                    ?>
                    <?php if($hasPhoto): ?>
                        <img src="<?php echo e(asset($aboutPhoto)); ?>" alt="QofMedia" class="about-cuplikan-img">
                    <?php else: ?>
                        <div class="about-placeholder">
                            <i class="bi bi-people-fill"></i>
                        </div>
                    <?php endif; ?>
                    
                    <div class="dot-pattern-cuplikan"></div>
                </div>
            </div>
            <div class="col-lg-7 scroll-reveal">
                <span class="section-label">Tentang Kami</span>
                <h2 class="about-cuplikan-title">Mengenal <span>QofMedia</span></h2>
                <p class="about-cuplikan-text">
                    <strong>QofMedia</strong> adalah tim multimedia yang berada di bawah naungan 
                    <strong>Pondok Pesantren Tahfidzul Qur'an Nurul Huda</strong>. Kami berdedikasi 
                    menyediakan layanan multimedia profesional dengan nilai-nilai islami.
                </p>
                <p class="about-cuplikan-text">
                    Didirikan sejak 2020, QofMedia hadir sebagai solusi kebutuhan multimedia 
                    bagi masyarakat, sekaligus menjadi wadah pengembangan bakat santri di bidang 
                    fotografi, videografi, dan desain grafis.
                </p>
                <div class="about-stats-cuplikan">
                    <div class="stat-item-cuplikan">
                        <span class="stat-number">4+</span>
                        <span class="stat-label">Tahun Berkarya</span>
                    </div>
                    <div class="stat-item-cuplikan">
                        <span class="stat-number">3</span>
                        <span class="stat-label">Layanan Utama</span>
                    </div>
                </div>
                <a href="<?php echo e(route('about.profile')); ?>" class="btn-about-cuplikan">
                    Selengkapnya Tentang Kami <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</section>

    
<section class="service-section">
    <div class="container">
        <div class="text-center scroll-reveal">
            <h2 class="section-title">Layanan Unggulan Kami</h2>
            <p class="section-subtitle">Solusi multimedia profesional untuk kebutuhan Anda</p>
        </div>

        <div class="row g-4">

            
            <div class="col-md-6 col-lg-4">
                <div class="service-card scroll-reveal">
                    <div class="service-icon">
                        <i class="bi bi-camera-video-fill"></i>
                    </div>
                    <h4>Qof Studio</h4>
                    <p>Layanan persewaan alat multimedia, studio foto/video, dan jasa fotografi profesional dengan peralatan modern.</p>
                    <a href="<?php echo e(route('service.studio')); ?>" class="service-link">
                        Selengkapnya <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>

            
            <div class="col-md-6 col-lg-4">
                <div class="service-card scroll-reveal">
                    <div class="service-icon">             
                        <i class="bi bi-shop"></i>
                    </div>
                    <h4>Qof Apparel</h4>
                    <p>Merchandise exclusive dengan desain islami, tersedia kaos, mug, kalender, figura, dan berbagai produk lainnya.</p>
                    <a href="<?php echo e(route('service.apparel')); ?>" class="service-link">
                        Selengkapnya <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>

            
            <div class="col-md-6 col-lg-4">
                <div class="service-card scroll-reveal">
                    <div class="service-icon">
                        <i class="bi bi-images"></i>
                    </div>
                    <h4>Galeri Kegiatan</h4>
                    <p>Dokumentasi berbagai kegiatan dan event di Pondok Pesantren Tahfidzul Qur'an Nurul Huda.</p>
                    <a href="<?php echo e(route('gallery.index')); ?>" class="service-link">
                        Selengkapnya <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>


<?php if($latestAlbums->count() > 0): ?>
<section class="gallery-section">
    <div class="container">
        <div class="text-center scroll-reveal">
            <h2 class="section-title">Galeri Terbaru</h2>
            <p class="section-subtitle">Momen berharga dari kegiatan kami</p>
        </div>

        <div class="row g-4">
            <?php $__currentLoopData = $latestAlbums->take(4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $album): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-6 col-lg-3">
                    <a href="<?php echo e(route('gallery.album', ['year' => $album->year, 'slug' => $album->slug])); ?>" class="text-decoration-none">
                        <div class="card gallery-card border-0 h-100 scroll-reveal">
                            <?php if($album->cover_image): ?>
                                <img src="<?php echo e(asset('storage/' . $album->cover_image)); ?>"
                                     class="card-img-top"
                                     alt="<?php echo e($album->name); ?>">
                            <?php else: ?>
                                <div class="gallery-placeholder">
                                    <i class="bi bi-images"></i>
                                </div>
                            <?php endif; ?>
                            <div class="card-body">
                                <h6 class="card-title"><?php echo e($album->name); ?></h6>
                                <p class="card-text">
                                    <i class="bi bi-calendar3 me-1"></i><?php echo e($album->year); ?>

                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="text-center mt-5">
            <a href="<?php echo e(route('gallery.index')); ?>" class="btn btn-gallery">
                Lihat Semua Galeri <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>
<?php endif; ?>


<?php if(isset($latestNews) && $latestNews->count() > 0): ?>
<section class="news-section">
    <div class="container">
        <div class="text-center scroll-reveal">
            <h2 class="section-title">Berita & Pengumuman</h2>
            <p class="section-subtitle">Informasi terbaru dari QofMedia</p>
        </div>

        <div class="row g-4">
            <?php $__currentLoopData = $latestNews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-6 col-lg-4">
                    <div class="news-card <?php echo e($index === 0 ? 'highlight' : ''); ?> scroll-reveal">

                        <?php if($index === 0): ?>
                            <span class="news-badge">
                                <i class="bi bi-pin-angle-fill me-1"></i>Terbaru
                            </span>
                        <?php endif; ?>

                        <a href="<?php echo e(route('information.show', $news->slug)); ?>" class="text-decoration-none">
                            <div class="news-card-img">
                                <?php if($news->image): ?>
                                    <img src="<?php echo e(asset('storage/' . $news->image)); ?>" alt="<?php echo e($news->title); ?>">
                                <?php else: ?>
                                    <div class="news-placeholder">
                                        <i class="bi bi-newspaper"></i>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </a>

                        <div class="card-body">
                            <span class="news-category">
                                <i class="bi bi-tag me-1"></i><?php echo e($news->category); ?>

                            </span>

                            <a href="<?php echo e(route('information.show', $news->slug)); ?>" class="text-decoration-none">
                                <h5 class="news-title"><?php echo e($news->title); ?></h5>
                            </a>

                            <p class="news-excerpt">
                                <?php echo e($news->excerpt ?: Str::limit(strip_tags($news->content), 120)); ?>

                            </p>

                            <div class="news-meta">
                                <span>
                                    <i class="bi bi-calendar3"></i>
                                    <?php echo e($news->published_at->format('d M Y')); ?>

                                </span>
                                <span>
                                    <i class="bi bi-clock"></i>
                                    <?php echo e($news->published_at->diffForHumans()); ?>

                                </span>
                            </div>

                            <div class="mt-3">
                                <a href="<?php echo e(route('information.show', $news->slug)); ?>" class="news-link">
                                    Baca Selengkapnya <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="text-center mt-5">
            <a href="<?php echo e(route('information.index')); ?>" class="btn btn-gallery">
                Lihat Semua Berita <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>
<?php endif; ?>


<section class="cta-section scroll-reveal">
    <div class="container text-center">
        <h2>Siap Bekerja Sama dengan Kami?</h2>
        <p>Hubungi kami untuk informasi lebih lanjut tentang layanan multimedia kami.</p>
        <a href="<?php echo e(route('contact')); ?>" class="btn btn-cta">
            Hubungi Kami <i class="bi bi-arrow-right"></i>
        </a>
    </div>
</section>

<?php $__env->startPush('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const revealItems = document.querySelectorAll('.scroll-reveal');
        if (!revealItems.length) {
            return;
        }

        if (!('IntersectionObserver' in window)) {
            revealItems.forEach(el => el.classList.add('reveal-visible'));
            return;
        }

        const observer = new IntersectionObserver((entries, io) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('reveal-visible');
                    io.unobserve(entry.target);
                }
            });
        }, { threshold: 0.18 });

        revealItems.forEach(el => observer.observe(el));
    });
</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\qofmedia-web\resources\views/public/home.blade.php ENDPATH**/ ?>