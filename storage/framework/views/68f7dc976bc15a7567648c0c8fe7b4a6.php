

<?php $__env->startSection('title', 'Pesanan Saya'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    body { padding-top: 0 !important; }

    .orders-hero {
        background: linear-gradient(135deg, #0D1B2A 0%, #1B3A4B 50%, #0E7A96 100%);
        padding: 80px 0 60px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    .orders-hero::before {
        content: '';
        position: absolute;
        top: -50%; right: -20%;
        width: 500px; height: 500px;
        background: radial-gradient(circle, rgba(78,184,204,0.15) 0%, transparent 70%);
        border-radius: 50%;
    }
    .orders-hero .container { position: relative; z-index: 1; }
    .orders-hero .hero-badge {
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
    .orders-hero h1 { font-size: 2rem; font-weight: 800; color: #fff; margin-bottom: 8px; }
    .orders-hero p  { color: rgba(255,255,255,0.7); }

    .orders-section { padding: 40px 0 80px; background: #F8FAFC; }

    /* ── Tab navigasi ── */
    .tab-nav {
        display: flex;
        gap: 6px;
        background: #fff;
        border: 1px solid #E2E8F0;
        border-radius: 16px;
        padding: 6px;
        margin-bottom: 28px;
        overflow-x: auto;
    }
    .tab-btn {
        flex: 1;
        min-width: 160px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 11px 20px;
        border-radius: 12px;
        border: none;
        background: transparent;
        color: #64748B;
        font-size: 0.88rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        white-space: nowrap;
        text-decoration: none;
    }
    .tab-btn .tab-count {
        background: #E2E8F0;
        color: #64748B;
        border-radius: 50px;
        padding: 1px 8px;
        font-size: 0.72rem;
        font-weight: 700;
        transition: all 0.2s;
    }
    .tab-btn.active {
        background: linear-gradient(135deg, #0D1B2A, #0E7A96);
        color: #fff;
        box-shadow: 0 4px 14px rgba(14,122,150,0.25);
    }
    .tab-btn.active .tab-count {
        background: rgba(255,255,255,0.2);
        color: #fff;
    }
    .tab-btn:hover:not(.active) {
        background: #F1F5F9;
        color: #0D1B2A;
    }

    .tab-pane { display: none; }
    .tab-pane.active { display: block; }

    /* ── Card tabel ── */
    .table-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 4px 16px rgba(0,0,0,0.04);
        border: 1px solid #E2E8F0;
    }
    .orders-table { width: 100%; border-collapse: collapse; }
    .orders-table thead th {
        background: #F8FAFC;
        padding: 14px 16px;
        font-size: 0.8rem;
        font-weight: 700;
        color: #64748B;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        border-bottom: 1px solid #E2E8F0;
    }
    .orders-table tbody td {
        padding: 14px 16px;
        font-size: 0.88rem;
        color: #475569;
        border-bottom: 1px solid #F1F5F9;
        vertical-align: middle;
    }
    .orders-table tbody tr:last-child td { border-bottom: none; }
    .orders-table tbody tr:hover { background: #F8FAFC; }

    /* Thumbnail */
    .thumb {
        width: 52px; height: 52px;
        border-radius: 10px;
        object-fit: cover;
        border: 1px solid #E2E8F0;
        display: block;
    }
    .thumb-placeholder {
        width: 52px; height: 52px;
        border-radius: 10px;
        background: linear-gradient(135deg, #EEF9FC, #D6EEF5);
        display: flex; align-items: center; justify-content: center;
        border: 1px solid #E2E8F0;
        color: #0E7A96; font-size: 1.3rem; opacity: 0.6;
    }

    /* Status badge */
    .status-badge {
        display: inline-flex; align-items: center; gap: 5px;
        padding: 4px 12px; border-radius: 50px;
        font-size: 0.76rem; font-weight: 700;
    }
    /* Apparel */
    .status-badge.menunggu  { background: #FEF3C7; color: #92400E; }
    .status-badge.disetujui { background: #D1FAE5; color: #065F46; }
    .status-badge.packing   { background: #EDE9FE; color: #5B21B6; }
    .status-badge.dikirim   { background: #DBEAFE; color: #1E40AF; }
    .status-badge.diterima  { background: #D1FAE5; color: #065F46; }
    .status-badge.ditolak   { background: #FEE2E2; color: #991B1B; }
    /* Rental */
    .status-badge.aktif     { background: #DBEAFE; color: #1E40AF; }
    .status-badge.selesai   { background: #D1FAE5; color: #065F46; }

    /* Action button */
    .btn-detail {
        display: inline-flex; align-items: center; gap: 6px;
        background: white; color: #0E7A96;
        border: 1.5px solid #0E7A96;
        padding: 7px 16px; border-radius: 50px;
        font-size: 0.82rem; font-weight: 600;
        text-decoration: none; transition: all 0.2s;
        white-space: nowrap;
    }
    .btn-detail:hover { background: #0E7A96; color: white; }

    /* Empty state */
    .empty-state { text-align: center; padding: 60px 20px; }
    .empty-state i { font-size: 64px; color: #0E7A96; opacity: 0.3; }
    .empty-state h3 { font-weight: 700; color: #0D1B2A; margin-top: 16px; }
    .empty-state p  { color: #64748B; }
    .btn-primary-custom {
        background: linear-gradient(135deg, #0E7A96, #4EB8CC);
        color: white; border: none;
        padding: 12px 28px; border-radius: 50px;
        font-weight: 600; text-decoration: none;
        display: inline-flex; align-items: center; gap: 8px;
        transition: all 0.3s;
    }
    .btn-primary-custom:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(14,122,150,0.3); color: white; }

    /* Rental detail inline */
    .rental-dates {
        font-size: 0.78rem; color: #94A3B8; margin-top: 3px;
        display: flex; align-items: center; gap: 4px;
    }

    @media (max-width: 768px) {
        .orders-hero { padding: 60px 0 40px; }
        .orders-table thead { display: none; }
        .orders-table tbody tr { display: block; margin-bottom: 12px; border: 1px solid #E2E8F0; border-radius: 12px; padding: 12px; }
        .orders-table tbody td { display: flex; justify-content: space-between; align-items: center; padding: 8px 0; border: none; font-size: 0.85rem; }
        .orders-table tbody td::before { content: attr(data-label); font-weight: 600; color: #0D1B2A; font-size: 0.78rem; }
        .orders-table tbody td[data-label="Foto"]::before { content: ''; }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<section class="orders-hero">
    <div class="container">
        <span class="hero-badge">Akun Saya</span>
        <h1>Pesanan Saya</h1>
        <p>Pantau status pesanan dan penyewaan Anda di sini</p>
    </div>
</section>

<section class="orders-section">
    <div class="container">

        <?php if(session('success')): ?>
            <div class="alert alert-success border-0 rounded-3 mb-4">
                <i class="bi bi-check-circle-fill me-2"></i><?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        
        <div class="tab-nav">
            <button class="tab-btn active" id="tab-apparel" onclick="switchTab('apparel')">
                <i class="bi bi-bag-heart"></i>
                Pesanan Apparel
                <span class="tab-count"><?php echo e($orders->total()); ?></span>
            </button>
            <button class="tab-btn" id="tab-rental" onclick="switchTab('rental')">
                <i class="bi bi-tools"></i>
                Penyewaan Studio
                <span class="tab-count"><?php echo e($rentals->total()); ?></span>
            </button>
        </div>

        
        <div class="tab-pane active" id="pane-apparel">
            <?php if($orders->count() > 0): ?>
                <div class="table-card">
                    <div class="table-responsive">
                        <table class="orders-table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Foto</th>
                                    <th>Produk</th>
                                    <th>Varian</th>
                                    <th>Qty</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $imgPath = $order->product?->images->sortBy('order')->first()?->image ?? null;
                                        $statusLabels = [
                                            'menunggu'  => 'Menunggu',
                                            'disetujui' => 'Disetujui',
                                            'packing'   => 'Dipacking',
                                            'dikirim'   => 'Dikirim',
                                            'diterima'  => 'Diterima',
                                            'ditolak'   => 'Ditolak',
                                        ];
                                    ?>
                                    <tr>
                                        <td data-label="No."><strong>#<?php echo e($order->id); ?></strong></td>
                                        <td data-label="Foto">
                                            <?php if($imgPath): ?>
                                                <img src="<?php echo e(asset('storage/' . $imgPath)); ?>"
                                                     alt="<?php echo e($order->product->name ?? ''); ?>"
                                                     class="thumb"
                                                     onerror="this.outerHTML='<div class=\'thumb-placeholder\'><i class=\'bi bi-box-seam\'></i></div>'">
                                            <?php else: ?>
                                                <div class="thumb-placeholder"><i class="bi bi-box-seam"></i></div>
                                            <?php endif; ?>
                                        </td>
                                        <td data-label="Produk"><?php echo e($order->product->name ?? '-'); ?></td>
                                        <td data-label="Varian">
                                            <?php if($order->variant): ?>
                                                <?php echo e($order->variant->size); ?>/<?php echo e($order->variant->color); ?>/<?php echo e($order->variant->sleeve_type); ?>

                                            <?php else: ?> -
                                            <?php endif; ?>
                                        </td>
                                        <td data-label="Qty"><?php echo e($order->qty); ?></td>
                                        <td data-label="Total">
                                            <?php $price = $order->variant->price ?? $order->product->price ?? 0; ?>
                                            Rp <?php echo e(number_format($price * $order->qty, 0, ',', '.')); ?>

                                        </td>
                                        <td data-label="Status">
                                            <span class="status-badge <?php echo e($order->status); ?>">
                                                <?php echo e($statusLabels[$order->status] ?? ucfirst($order->status)); ?>

                                            </span>
                                        </td>
                                        <td data-label="Tanggal"><?php echo e($order->created_at->format('d M Y')); ?></td>
                                        <td data-label="Aksi">
                                            <a href="<?php echo e(route('user.orders.show', $order)); ?>" class="btn-detail">
                                                <i class="bi bi-eye"></i> Detail
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <?php if($orders->hasPages()): ?>
                        <div class="p-3"><?php echo e($orders->links()); ?></div>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <div class="table-card">
                    <div class="empty-state">
                        <i class="bi bi-bag-x"></i>
                        <h3>Belum Ada Pesanan Apparel</h3>
                        <p>Yuk, mulai belanja kaos dan merchandise kami!</p>
                        <a href="<?php echo e(route('service.apparel')); ?>" class="btn-primary-custom mt-3">
                            <i class="bi bi-shop"></i> Lihat Produk
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        
        <div class="tab-pane" id="pane-rental">
            <?php if($rentals->count() > 0): ?>
                <div class="table-card">
                    <div class="table-responsive">
                        <table class="orders-table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Foto</th>
                                    <th>Alat</th>
                                    <th>Periode Sewa</th>
                                    <th>Durasi</th>
                                    <th>Total</th>
                                    <th>Jaminan</th>
                                    <th>Status</th>
                                    <th>Tanggal Pesan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $rentals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rental): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td data-label="No."><strong>#<?php echo e($rental->id); ?></strong></td>
                                        <td data-label="Foto">
                                            <?php if($rental->tool?->image): ?>
                                                <img src="<?php echo e(asset('storage/' . $rental->tool->image)); ?>"
                                                     alt="<?php echo e($rental->tool->name); ?>"
                                                     class="thumb"
                                                     onerror="this.outerHTML='<div class=\'thumb-placeholder\'><i class=\'bi bi-tools\'></i></div>'">
                                            <?php else: ?>
                                                <div class="thumb-placeholder"><i class="bi bi-tools"></i></div>
                                            <?php endif; ?>
                                        </td>
                                        <td data-label="Alat">
                                            <div style="font-weight:600; color:#0D1B2A;"><?php echo e($rental->tool->name ?? '-'); ?></div>
                                            <div style="font-size:0.76rem; color:#94A3B8; margin-top:2px;"><?php echo e($rental->qty); ?> unit</div>
                                        </td>
                                        <td data-label="Periode">
                                            <div style="font-size:0.85rem; font-weight:600; color:#0D1B2A;">
                                                <?php echo e($rental->tanggal_mulai->format('d M')); ?>

                                                <i class="bi bi-arrow-right" style="font-size:0.7rem; color:#94A3B8;"></i>
                                                <?php echo e($rental->tanggal_selesai->format('d M Y')); ?>

                                            </div>
                                        </td>
                                        <td data-label="Durasi"><?php echo e($rental->durasi); ?> hari</td>
                                        <td data-label="Total">
                                            <span style="font-weight:700; color:#0E7A96;">
                                                Rp <?php echo e(number_format($rental->total_harga, 0, ',', '.')); ?>

                                            </span>
                                        </td>
                                        <td data-label="Jaminan">
                                            <?php
                                                $jaminanIcon = match($rental->jenis_jaminan) {
                                                    'ktp'           => 'bi-person-vcard',
                                                    'kk'            => 'bi-people',
                                                    'sim'           => 'bi-car-front',
                                                    'kartu_pelajar' => 'bi-mortarboard',
                                                    default         => 'bi-card-list',
                                                };
                                                $jaminanShort = match($rental->jenis_jaminan) {
                                                    'ktp'           => 'KTP',
                                                    'kk'            => 'KK',
                                                    'sim'           => 'SIM',
                                                    'kartu_pelajar' => 'Kartu Pelajar',
                                                    default         => '—',
                                                };
                                            ?>
                                            <span style="display:inline-flex; align-items:center; gap:5px; font-size:0.8rem; background:#F1F5F9; color:#475569; padding:4px 10px; border-radius:50px;">
                                                <i class="bi <?php echo e($jaminanIcon); ?>"></i> <?php echo e($jaminanShort); ?>

                                            </span>
                                        </td>
                                        <td data-label="Status">
                                            <span class="status-badge <?php echo e($rental->status); ?>">
                                                <?php echo e($rental->status_label); ?>

                                            </span>
                                        </td>
                                        <td data-label="Tanggal Pesan"><?php echo e($rental->created_at->format('d M Y')); ?></td>
                                        <td data-label="Aksi">
                                            <a href="<?php echo e(route('user.rentals.show', $rental)); ?>" class="btn-detail">
                                                <i class="bi bi-eye"></i> Detail
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <?php if($rentals->hasPages()): ?>
                        <div class="p-3"><?php echo e($rentals->appends(['tab' => 'rental'])->links()); ?></div>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <div class="table-card">
                    <div class="empty-state">
                        <i class="bi bi-camera-video"></i>
                        <h3>Belum Ada Penyewaan</h3>
                        <p>Sewa peralatan studio profesional kami untuk kebutuhan shooting-mu!</p>
                        <a href="<?php echo e(route('service.studio')); ?>" class="btn-primary-custom mt-3">
                            <i class="bi bi-tools"></i> Lihat Alat Sewa
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>

    </div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    function switchTab(tab) {
        // Update tombol
        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
        document.getElementById('tab-' + tab).classList.add('active');

        // Update pane
        document.querySelectorAll('.tab-pane').forEach(p => p.classList.remove('active'));
        document.getElementById('pane-' + tab).classList.add('active');

        // Simpan ke URL tanpa reload
        history.replaceState(null, '', '?tab=' + tab);
    }

    // Buka tab sesuai URL param saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function () {
        var params = new URLSearchParams(window.location.search);
        var tab = params.get('tab');
        if (tab === 'rental') switchTab('rental');
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\qofmedia-web\resources\views/user/orders/index.blade.php ENDPATH**/ ?>