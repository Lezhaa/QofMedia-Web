

<?php $__env->startSection('title', 'Kontak'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    /* Fix padding body */
    body {
        padding-top: 0 !important;
    }

    /* ============================================
       HERO MODERN
       ============================================ */
    .contact-hero {
        position: relative;
        background: linear-gradient(135deg, #0D1B2A 0%, #1B3A4B 50%, #0E7A96 100%);
        padding: 100px 0 80px;
        overflow: hidden;
        text-align: center;
    }

    .contact-hero::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 600px;
        height: 600px;
        background: radial-gradient(circle, rgba(78,184,204,0.15) 0%, transparent 70%);
        border-radius: 50%;
    }

    .contact-hero::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -10%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(168,221,232,0.1) 0%, transparent 70%);
        border-radius: 50%;
    }

    .contact-hero .container {
        position: relative;
        z-index: 1;
    }

    .contact-hero .badge {
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

    .contact-hero h1 {
        font-size: clamp(2.2rem, 5vw, 3.2rem);
        font-weight: 800;
        color: #fff;
        margin-bottom: 16px;
        letter-spacing: -0.5px;
        line-height: 1.2;
    }

    .contact-hero h1 span {
        background: linear-gradient(135deg, #4EB8CC, #A8DDE8);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .contact-hero p {
        color: rgba(255,255,255,0.7);
        font-size: 1.1rem;
        max-width: 550px;
        margin: 0 auto;
        line-height: 1.7;
    }

    /* ============================================
       CONTENT SECTION
       ============================================ */
    .contact-section {
        padding: 80px 0;
        background: #F8FAFC;
    }

    /* ============================================
       FORM CARD
       ============================================ */
    .form-card {
        background: white;
        border: 1px solid #E2E8F0;
        border-radius: 20px;
        padding: 36px 32px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.04);
        height: 100%;
    }

    .form-card h3 {
        font-weight: 700;
        color: #0D1B2A;
        margin-bottom: 6px;
        font-size: 1.3rem;
    }

    .form-card > p {
        color: #64748B;
        font-size: 0.9rem;
        margin-bottom: 24px;
    }

    .form-label {
        font-weight: 600;
        font-size: 0.85rem;
        color: #0D1B2A;
        margin-bottom: 6px;
    }

    .form-card .form-control {
        border: 1.5px solid #E2E8F0;
        border-radius: 12px;
        padding: 12px 16px;
        font-size: 0.9rem;
        transition: all 0.3s;
        background: #F8FAFC;
    }

    .form-card .form-control:focus {
        border-color: #4EB8CC;
        box-shadow: 0 0 0 3px rgba(78,184,204,0.1);
        background: white;
    }

    .form-card .form-control::placeholder {
        color: #94A3B8;
    }

    .form-card .form-control.is-invalid {
        border-color: #DC2626;
    }

    .invalid-feedback {
        font-size: 0.78rem;
        font-weight: 500;
        margin-top: 4px;
    }

    .btn-submit {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: linear-gradient(135deg, #0E7A96, #4EB8CC);
        color: white;
        border: none;
        border-radius: 50px;
        padding: 13px 32px;
        font-weight: 600;
        font-size: 0.95rem;
        transition: all 0.3s;
    }

    .btn-submit:hover {
        background: linear-gradient(135deg, #0A4A60, #0E7A96);
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(14,122,150,0.3);
        color: white;
    }

    /* Alert */
    .alert-success {
        background: #D1FAE5;
        color: #065F46;
        border: none;
        border-radius: 12px;
        padding: 14px 16px;
        font-size: 0.9rem;
        font-weight: 500;
    }

    /* ============================================
       INFO CARDS
       ============================================ */
    .info-card {
        background: white;
        border: 1px solid #E2E8F0;
        border-radius: 20px;
        padding: 28px 24px;
        margin-bottom: 20px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.04);
    }

    .info-card h4 {
        font-weight: 700;
        color: #0D1B2A;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 1.05rem;
    }

    .info-card h4 i {
        color: #0E7A96;
        font-size: 1.2rem;
    }

    /* Social Links */
    .social-links {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .social-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 18px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 500;
        font-size: 0.85rem;
        transition: all 0.3s;
        border: 1.5px solid #E2E8F0;
        color: #475569;
        background: white;
    }

    .social-link:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.06);
    }

    .social-link.fb:hover {
        border-color: #1877F2;
        background: #1877F2;
        color: white;
    }

    .social-link.ig:hover {
        border-color: #E4405F;
        background: linear-gradient(45deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888);
        color: white;
    }

    .social-link.tw:hover {
        border-color: #000000;
        background: #000000;
        color: white;
    }

    .social-link.tt:hover {
        border-color: #000000;
        background: #000000;
        color: #00F2EA;
    }

    .social-link.yt:hover {
        border-color: #FF0000;
        background: #FF0000;
        color: white;
    }

    /* Map */
    .map-wrapper {
        border-radius: 20px;
        overflow: hidden;
        border: 1px solid #E2E8F0;
        margin-bottom: 20px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.04);
    }

    .map-wrapper iframe {
        width: 100%;
        height: 280px;
        border: none;
        display: block;
    }

    /* WhatsApp Card */
    .wa-card {
        background: linear-gradient(135deg, #D1FAE5, #A7F3D0);
        border: 1px solid #6EE7B7;
        border-radius: 20px;
        padding: 28px 24px;
        text-align: center;
    }

    .wa-card .wa-icon {
        font-size: 2.5rem;
        color: #25D366;
        margin-bottom: 8px;
    }

    .wa-card h5 {
        font-weight: 700;
        color: #0D1B2A;
        margin-bottom: 4px;
    }

    .wa-card p {
        color: #475569;
        font-size: 0.85rem;
        margin-bottom: 16px;
    }

    .btn-wa {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #25D366;
        color: white;
        padding: 12px 28px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.9rem;
        text-decoration: none;
        transition: all 0.3s;
    }

    .btn-wa:hover {
        background: #20BA5A;
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(37,211,102,0.3);
        color: white;
    }

    /* ============================================
       RESPONSIVE
       ============================================ */
    @media (max-width: 768px) {
        .contact-hero {
            padding: 70px 0 50px;
        }

        .contact-section {
            padding: 50px 0;
        }

        .form-card {
            padding: 24px 20px;
        }

        .social-link {
            padding: 8px 14px;
            font-size: 0.8rem;
        }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>


<section class="contact-hero">
    <div class="container">
        <span class="badge">Kontak</span>
        <h1>Hubungi <span>Kami</span></h1>
        <p>Kami siap membantu dan menjawab pertanyaan Anda</p>
    </div>
</section>


<section class="contact-section">
    <div class="container">
        <div class="row g-4">
            
            <div class="col-lg-7">
                <div class="form-card">
                    <h3>Kirim Pesan</h3>
                    <p>Silakan isi form di bawah ini, kami akan merespon secepatnya.</p>

                    <?php if(session('success')): ?>
                        <div class="alert alert-success" role="alert">
                            <i class="bi bi-check-circle-fill me-2"></i> <?php echo e(session('success')); ?>

                        </div>
                    <?php endif; ?>

                    <form action="<?php echo e(route('contact.send')); ?>" method="POST">
                        <?php echo csrf_field(); ?>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                       name="name" value="<?php echo e(old('name')); ?>" placeholder="Nama Anda" required>
                                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                       name="email" value="<?php echo e(old('email')); ?>" placeholder="email@example.com" required>
                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nomor HP / WhatsApp</label>
                            <input type="text" class="form-control <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                   name="phone" value="<?php echo e(old('phone')); ?>" placeholder="0812xxxxxx" required>
                            <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Pesan</label>
                            <textarea class="form-control <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                      name="message" rows="5" placeholder="Tulis pesan Anda..." required><?php echo e(old('message')); ?></textarea>
                            <?php $__errorArgs = ['message'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <button type="submit" class="btn btn-submit">
                            <i class="bi bi-send"></i> Kirim Pesan
                        </button>
                    </form>
                </div>
            </div>

            
            <div class="col-lg-5">
                
                <?php if(isset($settings['google_maps'])): ?>
                    <div class="map-wrapper">
                        <?php echo $settings['google_maps']; ?>

                    </div>
                <?php endif; ?>

                
                <div class="info-card">
                    <h4><i class="bi bi-share"></i> Ikuti Kami</h4>
                    <div class="social-links">
                        <?php if($settings['facebook'] ?? false): ?>
                            <a href="<?php echo e($settings['facebook']); ?>" class="social-link fb" target="_blank" rel="noopener noreferrer">
                                <i class="bi bi-facebook"></i> Facebook
                            </a>
                        <?php endif; ?>
                        <?php if($settings['instagram'] ?? false): ?>
                            <a href="<?php echo e($settings['instagram']); ?>" class="social-link ig" target="_blank" rel="noopener noreferrer">
                                <i class="bi bi-instagram"></i> Instagram
                            </a>
                        <?php endif; ?>
                        <?php if($settings['twitter'] ?? false): ?>
                            <a href="<?php echo e($settings['twitter']); ?>" class="social-link tw" target="_blank" rel="noopener noreferrer">
                                <i class="bi bi-twitter-x"></i> Twitter
                            </a>
                        <?php endif; ?>
                        <?php if($settings['tiktok'] ?? false): ?>
                            <a href="<?php echo e($settings['tiktok']); ?>" class="social-link tt" target="_blank" rel="noopener noreferrer">
                                <i class="bi bi-tiktok"></i> TikTok
                            </a>
                        <?php endif; ?>
                        <?php if($settings['youtube'] ?? false): ?>
                            <a href="<?php echo e($settings['youtube']); ?>" class="social-link yt" target="_blank" rel="noopener noreferrer">
                                <i class="bi bi-youtube"></i> YouTube
                            </a>
                        <?php endif; ?>
                    </div>
                </div>

                
                <?php
                    $waNumber = $settings['whatsapp_studio'] ?? null;
                ?>
                <?php if($waNumber): ?>
                    <div class="wa-card">
                        <div class="wa-icon">
                            <i class="bi bi-whatsapp"></i>
                        </div>
                        <h5>Butuh Respon Cepat?</h5>
                        <p>Hubungi kami langsung via WhatsApp</p>
                        <a href="https://wa.me/<?php echo e(preg_replace('/[^0-9]/', '', $waNumber)); ?>"
                           class="btn-wa" target="_blank" rel="noopener noreferrer">
                            <i class="bi bi-whatsapp"></i> Chat via WhatsApp
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\qofmedia-web\resources\views/public/contact.blade.php ENDPATH**/ ?>