

<?php $__env->startSection('title', 'Detail Penyewaan #' . $rentalBooking->id); ?>

<?php $__env->startPush('styles'); ?>
<style>
    body { padding-top: 0 !important; }

    /* ── Hero ── */
    .rental-hero {
        background: linear-gradient(135deg, #0D1B2A 0%, #1B3A4B 50%, #0E7A96 100%);
        padding: 80px 0 60px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    .rental-hero::before {
        content: '';
        position: absolute;
        top: -50%; right: -20%;
        width: 500px; height: 500px;
        background: radial-gradient(circle, rgba(78,184,204,0.15) 0%, transparent 70%);
        border-radius: 50%;
    }
    .rental-hero .container { position: relative; z-index: 1; }
    .rental-hero .hero-badge {
        display: inline-block;
        background: rgba(255,255,255,0.1);
        color: #A8DDE8;
        padding: 6px 16px;
        border-radius: 50px;
        font-size: 0.8rem;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        margin-bottom: 16px;
        border: 1px solid rgba(255,255,255,0.2);
    }
    .rental-hero h1 { font-size: 2rem; font-weight: 800; color: #fff; margin-bottom: 8px; }
    .rental-hero p  { color: rgba(255,255,255,0.7); }

    .rental-section { padding: 40px 0 80px; background: #F8FAFC; }

    /* ── Cards ── */
    .info-card {
        background: #fff;
        border-radius: 20px;
        border: 1px solid #E2E8F0;
        box-shadow: 0 4px 16px rgba(0,0,0,0.04);
        margin-bottom: 24px;
        overflow: hidden;
    }
    .info-card-header {
        background: #F8FAFC;
        padding: 16px 24px;
        border-bottom: 1px solid #E2E8F0;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .info-card-header i {
        font-size: 1.1rem;
        color: #0E7A96;
    }
    .info-card-header h6 {
        margin: 0;
        font-weight: 700;
        font-size: 0.9rem;
        color: #0D1B2A;
        text-transform: uppercase;
        letter-spacing: 0.04em;
    }
    .info-card-body { padding: 20px 24px; }

    /* ── Info rows ── */
    .info-row {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        padding: 10px 0;
        border-bottom: 1px solid #F1F5F9;
        gap: 16px;
    }
    .info-row:last-child { border-bottom: none; padding-bottom: 0; }
    .info-row .label {
        font-size: 0.82rem;
        font-weight: 600;
        color: #64748B;
        min-width: 150px;
        flex-shrink: 0;
    }
    .info-row .value {
        font-size: 0.88rem;
        color: #0D1B2A;
        font-weight: 500;
        text-align: right;
    }

    /* ── Status badge ── */
    .status-badge {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 6px 16px; border-radius: 50px;
        font-size: 0.82rem; font-weight: 700;
    }
    .status-badge.menunggu  { background: #FEF3C7; color: #92400E; }
    .status-badge.disetujui { background: #DBEAFE; color: #1E40AF; }
    .status-badge.aktif     { background: #D1FAE5; color: #065F46; }
    .status-badge.selesai   { background: #D1FAE5; color: #065F46; }
    .status-badge.ditolak   { background: #FEE2E2; color: #991B1B; }

    /* ── Alat hero box ── */
    .alat-box {
        display: flex;
        align-items: center;
        gap: 20px;
        padding: 20px;
        background: linear-gradient(135deg, #EEF9FC, #D6EEF5);
        border-radius: 16px;
        border: 1px solid #C3E4EF;
        margin-bottom: 20px;
    }
    .alat-thumb {
        width: 80px; height: 80px;
        border-radius: 14px;
        object-fit: cover;
        border: 2px solid #fff;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        flex-shrink: 0;
    }
    .alat-thumb-placeholder {
        width: 80px; height: 80px;
        border-radius: 14px;
        background: rgba(255,255,255,0.6);
        display: flex; align-items: center; justify-content: center;
        font-size: 2rem; color: #0E7A96; flex-shrink: 0;
    }
    .alat-info h5 { font-size: 1.1rem; font-weight: 800; color: #0D1B2A; margin: 0 0 4px; }
    .alat-info p  { font-size: 0.82rem; color: #475569; margin: 0; }

    /* ── Periode visual ── */
    .periode-box {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 16px;
        padding: 20px;
        background: #F8FAFC;
        border-radius: 14px;
        border: 1px solid #E2E8F0;
        margin-bottom: 20px;
        flex-wrap: wrap;
        text-align: center;
    }
    .periode-date .date-label { font-size: 0.72rem; font-weight: 600; color: #94A3B8; text-transform: uppercase; letter-spacing: 0.05em; }
    .periode-date .date-val   { font-size: 1.05rem; font-weight: 800; color: #0D1B2A; margin-top: 2px; }
    .periode-arrow { font-size: 1.5rem; color: #0E7A96; }
    .durasi-badge {
        background: linear-gradient(135deg, #0E7A96, #4EB8CC);
        color: white;
        padding: 6px 18px;
        border-radius: 50px;
        font-size: 0.82rem;
        font-weight: 700;
        white-space: nowrap;
    }

    /* ── Total harga highlight ── */
    .total-box {
        background: linear-gradient(135deg, #0D1B2A, #0E7A96);
        border-radius: 16px;
        padding: 20px 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        color: white;
        margin-bottom: 24px;
    }
    .total-box .total-label { font-size: 0.88rem; opacity: 0.8; }
    .total-box .total-amount { font-size: 1.5rem; font-weight: 800; }

    /* ── Bukti transfer ── */
    .bukti-img {
        width: 100%;
        border-radius: 12px;
        border: 2px solid #E2E8F0;
        object-fit: contain;
        max-height: 320px;
    }
    .bukti-validated {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 6px 14px; border-radius: 50px;
        font-size: 0.78rem; font-weight: 700;
        margin-top: 10px;
    }
    .bukti-validated.yes { background: #D1FAE5; color: #065F46; }
    .bukti-validated.no  { background: #FEF3C7; color: #92400E; }

    /* ── Jaminan pill ── */
    .jaminan-pill {
        display: inline-flex; align-items: center; gap: 8px;
        background: #F1F5F9; color: #475569;
        padding: 8px 18px; border-radius: 50px;
        font-size: 0.85rem; font-weight: 600;
    }

    /* ── Catatan ── */
    .catatan-box {
        background: #FFFBEB;
        border: 1px solid #FDE68A;
        border-radius: 12px;
        padding: 14px 18px;
        font-size: 0.88rem;
        color: #78350F;
        line-height: 1.6;
    }
    .catatan-admin-box {
        background: #EFF6FF;
        border: 1px solid #BFDBFE;
        border-radius: 12px;
        padding: 14px 18px;
        font-size: 0.88rem;
        color: #1E40AF;
        line-height: 1.6;
    }

    /* ── Back button ── */
    .btn-back {
        display: inline-flex; align-items: center; gap: 8px;
        background: white; color: #0E7A96;
        border: 1.5px solid #0E7A96;
        padding: 10px 22px; border-radius: 50px;
        font-size: 0.85rem; font-weight: 600;
        text-decoration: none; transition: all 0.2s;
        margin-bottom: 24px;
    }
    .btn-back:hover { background: #0E7A96; color: white; }

    /* ── Timeline status ── */
    .timeline { list-style: none; padding: 0; margin: 0; position: relative; }
    .timeline::before {
        content: '';
        position: absolute;
        left: 16px; top: 0; bottom: 0;
        width: 2px; background: #E2E8F0;
    }
    .timeline li {
        display: flex;
        align-items: flex-start;
        gap: 16px;
        padding: 0 0 20px 0;
        position: relative;
    }
    .timeline li:last-child { padding-bottom: 0; }
    .tl-dot {
        width: 34px; height: 34px;
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-size: 0.9rem;
        flex-shrink: 0;
        position: relative; z-index: 1;
        border: 2px solid #E2E8F0;
        background: white;
        color: #94A3B8;
    }
    .tl-dot.done { background: #0E7A96; color: white; border-color: #0E7A96; }
    .tl-dot.current { background: #FEF3C7; color: #92400E; border-color: #F59E0B; }
    .tl-dot.rejected { background: #FEE2E2; color: #991B1B; border-color: #F87171; }
    .tl-content .tl-title { font-size: 0.88rem; font-weight: 700; color: #0D1B2A; }
    .tl-content .tl-desc  { font-size: 0.78rem; color: #64748B; margin-top: 2px; }

    @media (max-width: 768px) {
        .rental-hero { padding: 60px 0 40px; }
        .alat-box { flex-direction: column; text-align: center; }
        .total-box { flex-direction: column; gap: 8px; text-align: center; }
        .info-row { flex-direction: column; gap: 4px; }
        .info-row .value { text-align: left; }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<section class="rental-hero">
    <div class="container">
        <span class="hero-badge">Penyewaan Studio</span>
        <h1>Detail Penyewaan</h1>
        <p>Booking #<?php echo e($rentalBooking->id); ?> &mdash; <?php echo e($rentalBooking->created_at->format('d M Y')); ?></p>
    </div>
</section>

<section class="rental-section">
    <div class="container">

        <?php if(session('success')): ?>
            <div class="alert alert-success border-0 rounded-3 mb-4">
                <i class="bi bi-check-circle-fill me-2"></i><?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <a href="<?php echo e(route('user.orders', ['tab' => 'rental'])); ?>" class="btn-back">
            <i class="bi bi-arrow-left"></i> Kembali ke Pesanan Saya
        </a>

        <div class="row g-4">

            
            <div class="col-lg-8">

                
                <div class="info-card">
                    <div class="info-card-header">
                        <i class="bi bi-tools"></i>
                        <h6>Informasi Alat</h6>
                    </div>
                    <div class="info-card-body">
                        <div class="alat-box">
                            <?php if($rentalBooking->tool?->image): ?>
                                <img src="<?php echo e(asset('storage/' . $rentalBooking->tool->image)); ?>"
                                     alt="<?php echo e($rentalBooking->tool->name); ?>"
                                     class="alat-thumb"
                                     onerror="this.outerHTML='<div class=\'alat-thumb-placeholder\'><i class=\'bi bi-camera-video\'></i></div>'">
                            <?php else: ?>
                                <div class="alat-thumb-placeholder"><i class="bi bi-camera-video"></i></div>
                            <?php endif; ?>
                            <div class="alat-info">
                                <h5><?php echo e($rentalBooking->tool->name ?? 'Alat tidak ditemukan'); ?></h5>
                                <p><?php echo e($rentalBooking->qty); ?> unit &bull; Rp <?php echo e(number_format($rentalBooking->tool->price_per_day ?? 0, 0, ',', '.')); ?> / hari</p>
                            </div>
                        </div>

                        
                        <div class="periode-box">
                            <div class="periode-date">
                                <div class="date-label">Mulai Sewa</div>
                                <div class="date-val"><?php echo e($rentalBooking->tanggal_mulai->format('d M Y')); ?></div>
                            </div>
                            <i class="bi bi-arrow-right periode-arrow"></i>
                            <div class="periode-date">
                                <div class="date-label">Selesai Sewa</div>
                                <div class="date-val"><?php echo e($rentalBooking->tanggal_selesai->format('d M Y')); ?></div>
                            </div>
                            <span class="durasi-badge">
                                <i class="bi bi-calendar3"></i> <?php echo e($rentalBooking->durasi); ?> Hari
                            </span>
                        </div>

                        <div class="info-row">
                            <span class="label"><i class="bi bi-box2 me-1"></i> Jumlah Unit</span>
                            <span class="value"><?php echo e($rentalBooking->qty); ?> unit</span>
                        </div>
                        <div class="info-row">
                            <span class="label"><i class="bi bi-tag me-1"></i> Harga per Hari</span>
                            <span class="value">Rp <?php echo e(number_format($rentalBooking->tool->price_per_day ?? 0, 0, ',', '.')); ?></span>
                        </div>
                        <div class="info-row">
                            <span class="label"><i class="bi bi-calendar-range me-1"></i> Durasi</span>
                            <span class="value"><?php echo e($rentalBooking->durasi); ?> hari</span>
                        </div>
                    </div>
                </div>

                
                <div class="total-box">
                    <div>
                        <div class="total-label">Total Biaya Sewa</div>
                        <small style="opacity:0.6; font-size:0.75rem;">
                            <?php echo e($rentalBooking->qty); ?> unit × <?php echo e($rentalBooking->durasi); ?> hari × Rp <?php echo e(number_format($rentalBooking->tool->price_per_day ?? 0, 0, ',', '.')); ?>

                        </small>
                    </div>
                    <div class="total-amount">Rp <?php echo e(number_format($rentalBooking->total_harga, 0, ',', '.')); ?></div>
                </div>

                
                <div class="info-card">
                    <div class="info-card-header">
                        <i class="bi bi-person-circle"></i>
                        <h6>Data Pemesan</h6>
                    </div>
                    <div class="info-card-body">
                        <div class="info-row">
                            <span class="label"><i class="bi bi-person me-1"></i> Nama Pemesan</span>
                            <span class="value"><?php echo e($rentalBooking->pemesan_name); ?></span>
                        </div>
                        <div class="info-row">
                            <span class="label"><i class="bi bi-telephone me-1"></i> Nomor HP</span>
                            <span class="value"><?php echo e($rentalBooking->pemesan_phone); ?></span>
                        </div>
                        <div class="info-row">
                            <span class="label"><i class="bi bi-card-list me-1"></i> Jenis Jaminan</span>
                            <span class="value">
                                <span class="jaminan-pill">
                                    <i class="bi bi-shield-check"></i>
                                    <?php echo e($rentalBooking->jaminan_label); ?>

                                </span>
                            </span>
                        </div>
                        <div class="info-row">
                            <span class="label"><i class="bi bi-clock me-1"></i> Tanggal Pesan</span>
                            <span class="value"><?php echo e($rentalBooking->created_at->format('d M Y, H:i')); ?> WIB</span>
                        </div>

                        <?php if($rentalBooking->catatan_user): ?>
                            <div class="mt-3">
                                <p class="mb-2" style="font-size:0.82rem; font-weight:700; color:#64748B; text-transform:uppercase; letter-spacing:0.04em;">
                                    <i class="bi bi-chat-text me-1"></i> Catatan Anda
                                </p>
                                <div class="catatan-box"><?php echo e($rentalBooking->catatan_user); ?></div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                
                <?php if($rentalBooking->catatan_admin): ?>
                    <div class="info-card">
                        <div class="info-card-header">
                            <i class="bi bi-megaphone"></i>
                            <h6>Pesan dari Admin</h6>
                        </div>
                        <div class="info-card-body">
                            <div class="catatan-admin-box">
                                <i class="bi bi-info-circle me-1"></i>
                                <?php echo e($rentalBooking->catatan_admin); ?>

                            </div>
                        </div>
                    </div>
                <?php endif; ?>

            </div>

            
            <div class="col-lg-4">

                
                <div class="info-card">
                    <div class="info-card-header">
                        <i class="bi bi-activity"></i>
                        <h6>Status Penyewaan</h6>
                    </div>
                    <div class="info-card-body">
                        <div class="text-center mb-4">
                            <span class="status-badge <?php echo e($rentalBooking->status); ?>" style="font-size:0.95rem; padding:10px 24px;">
                                <?php echo e($rentalBooking->status_label); ?>

                            </span>
                        </div>

                        
                        <?php
                            $steps = [
                                'menunggu'  => ['label' => 'Menunggu Konfirmasi', 'desc' => 'Pemesanan diterima, menunggu verifikasi admin', 'icon' => 'bi-hourglass-split'],
                                'disetujui' => ['label' => 'Disetujui', 'desc' => 'Admin telah menyetujui pemesanan Anda', 'icon' => 'bi-check-circle'],
                                'aktif'     => ['label' => 'Sedang Berjalan', 'desc' => 'Alat sedang dalam masa sewa', 'icon' => 'bi-play-circle'],
                                'selesai'   => ['label' => 'Selesai', 'desc' => 'Penyewaan telah selesai', 'icon' => 'bi-flag'],
                            ];
                            $order = ['menunggu', 'disetujui', 'aktif', 'selesai'];
                            $currentIdx = array_search($rentalBooking->status, $order);
                        ?>

                        <?php if($rentalBooking->status === 'ditolak'): ?>
                            <ul class="timeline">
                                <li>
                                    <div class="tl-dot done"><i class="bi bi-check-circle"></i></div>
                                    <div class="tl-content">
                                        <div class="tl-title">Pemesanan Dikirim</div>
                                        <div class="tl-desc"><?php echo e($rentalBooking->created_at->format('d M Y')); ?></div>
                                    </div>
                                </li>
                                <li>
                                    <div class="tl-dot rejected"><i class="bi bi-x-circle"></i></div>
                                    <div class="tl-content">
                                        <div class="tl-title" style="color:#991B1B;">Ditolak</div>
                                        <div class="tl-desc">Pemesanan tidak dapat diproses</div>
                                    </div>
                                </li>
                            </ul>
                        <?php else: ?>
                            <ul class="timeline">
                                <?php $__currentLoopData = $steps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $stepIdx = array_search($key, $order);
                                        $isDone = ($currentIdx !== false && $stepIdx <= $currentIdx);
                                        $isCurrent = ($key === $rentalBooking->status);
                                    ?>
                                    <li>
                                        <div class="tl-dot <?php echo e($isCurrent ? 'current' : ($isDone ? 'done' : '')); ?>">
                                            <i class="bi <?php echo e($isDone ? 'bi-check-lg' : $step['icon']); ?>"></i>
                                        </div>
                                        <div class="tl-content">
                                            <div class="tl-title" style="<?php echo e($isCurrent ? 'color:#92400E;' : ''); ?>"><?php echo e($step['label']); ?></div>
                                            <div class="tl-desc"><?php echo e($step['desc']); ?></div>
                                        </div>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>

                
                <div class="info-card">
                    <div class="info-card-header">
                        <i class="bi bi-receipt"></i>
                        <h6>Bukti Transfer</h6>
                    </div>
                    <div class="info-card-body">
                        <?php if($rentalBooking->bukti_transfer): ?>
                            <a href="<?php echo e(asset('storage/' . $rentalBooking->bukti_transfer)); ?>" target="_blank">
                                <img src="<?php echo e(asset('storage/' . $rentalBooking->bukti_transfer)); ?>"
                                     alt="Bukti Transfer"
                                     class="bukti-img">
                            </a>
                            <div class="text-center mt-2">
                                <?php if($rentalBooking->bukti_transfer_validated): ?>
                                    <span class="bukti-validated yes">
                                        <i class="bi bi-patch-check-fill"></i> Bukti Terverifikasi
                                    </span>
                                <?php else: ?>
                                    <span class="bukti-validated no">
                                        <i class="bi bi-clock-history"></i> Menunggu Verifikasi
                                    </span>
                                <?php endif; ?>
                            </div>
                            <div class="text-center mt-2">
                                <a href="<?php echo e(asset('storage/' . $rentalBooking->bukti_transfer)); ?>"
                                   target="_blank"
                                   style="font-size:0.78rem; color:#0E7A96; text-decoration:none;">
                                    <i class="bi bi-arrows-fullscreen me-1"></i> Lihat ukuran penuh
                                </a>
                            </div>
                        <?php else: ?>
                            <div class="text-center py-4" style="color:#94A3B8;">
                                <i class="bi bi-image" style="font-size:2rem;"></i>
                                <p class="mb-0 mt-2" style="font-size:0.85rem;">Belum ada bukti transfer</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                
                <div class="info-card">
                    <div class="info-card-header">
                        <i class="bi bi-calculator"></i>
                        <h6>Ringkasan Biaya</h6>
                    </div>
                    <div class="info-card-body">
                        <div class="info-row">
                            <span class="label">Harga/hari</span>
                            <span class="value">Rp <?php echo e(number_format($rentalBooking->tool->price_per_day ?? 0, 0, ',', '.')); ?></span>
                        </div>
                        <div class="info-row">
                            <span class="label">Jumlah unit</span>
                            <span class="value"><?php echo e($rentalBooking->qty); ?> unit</span>
                        </div>
                        <div class="info-row">
                            <span class="label">Durasi</span>
                            <span class="value"><?php echo e($rentalBooking->durasi); ?> hari</span>
                        </div>
                        <div class="info-row" style="padding-top:14px; margin-top:4px; border-top:2px solid #E2E8F0; border-bottom:none;">
                            <span class="label" style="font-size:0.9rem; color:#0D1B2A; font-weight:800;">Total</span>
                            <span class="value" style="font-size:1rem; color:#0E7A96; font-weight:800;">
                                Rp <?php echo e(number_format($rentalBooking->total_harga, 0, ',', '.')); ?>

                            </span>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\qofmedia-web\resources\views/user/orders/rental-show.blade.php ENDPATH**/ ?>