

<?php $__env->startSection('title', 'Pemesanan Sewa Alat'); ?>

<?php $__env->startSection('content_header'); ?>
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="mb-0" style="font-size: 1.4rem; font-weight: 700; color: #0D1B2A;">
                <i class="fas fa-calendar-check me-2" style="color: #0E7A96;"></i> Pemesanan Sewa Alat
            </h1>
            <ol class="breadcrumb mb-0 mt-1" style="font-size: 0.8rem; background: transparent; padding: 0;">
                <li class="breadcrumb-item"><a href="<?php echo e(route('studio.dashboard')); ?>">Dashboard</a></li>
                <li class="breadcrumb-item active">Pemesanan Sewa</li>
            </ol>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<style>
    .alert-success-custom {
        border-radius: 12px; border: none; background: #D1FAE5; color: #065F46;
        font-size: 0.88rem; padding: 12px 18px; display: flex; align-items: center;
        gap: 8px; margin-bottom: 20px;
    }
    .stats-bar { display: flex; gap: 12px; margin-bottom: 20px; flex-wrap: wrap; }
    .stat-chip {
        background: #fff; border: 1px solid #E2E8F0; border-radius: 12px;
        padding: 12px 18px; font-size: 0.82rem; color: #64748B;
        display: flex; align-items: center; gap: 10px; font-weight: 500; flex: 1; min-width: 130px;
    }
    .stat-chip-icon {
        width: 36px; height: 36px; border-radius: 10px;
        display: flex; align-items: center; justify-content: center; font-size: 0.9rem; flex-shrink: 0;
    }
    .stat-chip-icon.teal   { background: rgba(14,122,150,0.1);  color: #0E7A96; }
    .stat-chip-icon.amber  { background: rgba(245,158,11,0.1);  color: #F59E0B; }
    .stat-chip-icon.blue   { background: rgba(37,99,235,0.1);   color: #2563EB; }
    .stat-chip-icon.green  { background: rgba(5,150,105,0.1);   color: #059669; }
    .stat-chip-info strong { font-size: 1.1rem; font-weight: 800; color: #0D1B2A; display: block; line-height: 1.2; }
    .stat-chip-info span   { font-size: 0.75rem; color: #94A3B8; }

    .filter-bar {
        background: #fff; border: 1px solid #E2E8F0; border-radius: 14px;
        padding: 14px 20px; margin-bottom: 20px; display: flex; align-items: center; gap: 12px; flex-wrap: wrap;
    }
    .filter-bar input, .filter-bar select {
        border: 1.5px solid #E2E8F0; border-radius: 8px; padding: 8px 14px;
        font-size: 0.85rem; outline: none; color: #0D1B2A; background: #F8FAFC; transition: border-color 0.2s;
    }
    .filter-bar input  { flex: 1; min-width: 180px; }
    .filter-bar input:focus, .filter-bar select:focus { border-color: #0E7A96; background: #fff; }

    .filter-btn {
        display: inline-flex; align-items: center; gap: 6px;
        background: #0E7A96; color: #fff; padding: 8px 18px; border-radius: 8px;
        font-size: 0.85rem; font-weight: 600; border: none; cursor: pointer; text-decoration: none;
    }
    .filter-btn:hover { background: #0a6278; color: #fff; text-decoration: none; }
    .reset-btn {
        display: inline-flex; align-items: center; gap: 6px;
        background: transparent; color: #64748B; padding: 8px 14px; border-radius: 8px;
        font-size: 0.85rem; font-weight: 600; border: 1.5px solid #E2E8F0; text-decoration: none;
    }
    .reset-btn:hover { background: #F1F5F9; color: #0D1B2A; text-decoration: none; }

    .bookings-card { background: #fff; border: 1px solid #E2E8F0; border-radius: 20px; overflow: hidden; }
    .bookings-table { width: 100%; border-collapse: collapse; }
    .bookings-table thead th {
        background: #F8FAFC; font-size: 0.7rem; font-weight: 700;
        text-transform: uppercase; letter-spacing: 0.08em; color: #94A3B8;
        padding: 13px 20px; border-bottom: 1px solid #F1F5F9; white-space: nowrap;
    }
    .bookings-table tbody tr { border-bottom: 1px solid #F8FAFC; transition: background 0.15s; }
    .bookings-table tbody tr:last-child { border-bottom: none; }
    .bookings-table tbody tr:hover { background: #FAFCFE; }
    .bookings-table tbody td { padding: 13px 20px; vertical-align: middle; font-size: 0.88rem; color: #0D1B2A; }

    .pemesan-name { font-weight: 700; color: #0D1B2A; font-size: 0.88rem; }
    .pemesan-phone { font-size: 0.78rem; color: #94A3B8; }

    .tool-name { font-weight: 600; color: #0D1B2A; font-size: 0.85rem; }
    .tool-cat  { font-size: 0.72rem; color: #94A3B8; }

    .date-range { font-size: 0.82rem; color: #374151; white-space: nowrap; }
    .date-range .durasi { font-size: 0.72rem; color: #94A3B8; margin-top: 2px; }

    .harga-total { font-size: 0.88rem; font-weight: 700; color: #0E7A96; white-space: nowrap; }

    .status-badge {
        display: inline-flex; align-items: center; gap: 4px;
        padding: 4px 10px; border-radius: 50px; font-size: 0.72rem; font-weight: 700;
    }
    .status-menunggu  { background: rgba(245,158,11,0.12); color: #D97706; }
    .status-disetujui { background: rgba(14,122,150,0.1);  color: #0E7A96; }
    .status-aktif     { background: rgba(37,99,235,0.1);   color: #2563EB; }
    .status-selesai   { background: rgba(5,150,105,0.1);   color: #059669; }
    .status-ditolak   { background: rgba(220,38,38,0.1);   color: #DC2626; }

    .act-btn {
        display: inline-flex; align-items: center; justify-content: center;
        width: 32px; height: 32px; border-radius: 8px; border: none;
        font-size: 0.8rem; text-decoration: none; transition: all 0.2s; cursor: pointer;
    }
    .act-btn.view   { background: rgba(14,122,150,0.09);  color: #0E7A96; }
    .act-btn.delete { background: rgba(220,38,38,0.09);   color: #DC2626; }
    .act-btn:hover  { filter: brightness(0.88); transform: scale(1.08); text-decoration: none; }

    .empty-state { text-align: center; padding: 70px 20px; }
    .empty-icon-wrap {
        width: 80px; height: 80px; background: #EEF9FC; border-radius: 24px;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 18px; font-size: 2rem; color: #0E7A96; opacity: 0.6;
    }
    .empty-state h5 { font-weight: 700; color: #0D1B2A; margin-bottom: 6px; }
    .empty-state p  { color: #94A3B8; font-size: 0.88rem; }

    .pagination .page-link svg { display: none !important; }
    .pagination .page-item:first-child .page-link::after { content: '« Prev'; }
    .pagination .page-item:last-child  .page-link::after { content: 'Next »'; }
    .pagination { gap: 4px; flex-wrap: wrap; }
    .pagination .page-link {
        border-radius: 8px !important; padding: 7px 14px; font-size: 0.85rem; font-weight: 600;
        color: #0D1B2A; border: 1.5px solid #E2E8F0; background: #fff; transition: all 0.2s;
    }
    .pagination .page-link:hover { background: #0E7A96; color: #fff; border-color: #0E7A96; }
    .pagination .page-item.active .page-link {
        background: #0E7A96; border-color: #0E7A96; color: #fff;
        box-shadow: 0 4px 12px rgba(14,122,150,0.25);
    }
    .pagination .page-item.disabled .page-link { background: #F8FAFC; color: #CBD5E1; border-color: #E2E8F0; }
    .card-foot { padding: 14px 20px; border-top: 1px solid #F1F5F9; display: flex; justify-content: center; }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    <?php if(session('success')): ?>
        <div class="alert-success-custom">
            <i class="fas fa-check-circle"></i> <?php echo e(session('success')); ?>

            <button type="button" class="close ml-auto" data-dismiss="alert"
                    style="background:none; border:none; cursor:pointer; color:#065F46; font-size:1rem;">&times;</button>
        </div>
    <?php endif; ?>

    
    <div class="stats-bar">
        <div class="stat-chip">
            <div class="stat-chip-icon teal"><i class="fas fa-calendar-check"></i></div>
            <div class="stat-chip-info"><strong><?php echo e($stats['total']); ?></strong><span>Total Pemesanan</span></div>
        </div>
        <div class="stat-chip">
            <div class="stat-chip-icon amber"><i class="fas fa-clock"></i></div>
            <div class="stat-chip-info"><strong><?php echo e($stats['menunggu']); ?></strong><span>Menunggu</span></div>
        </div>
        <div class="stat-chip">
            <div class="stat-chip-icon blue"><i class="fas fa-tools"></i></div>
            <div class="stat-chip-info"><strong><?php echo e($stats['aktif']); ?></strong><span>Sedang Berjalan</span></div>
        </div>
        <div class="stat-chip">
            <div class="stat-chip-icon green"><i class="fas fa-check-double"></i></div>
            <div class="stat-chip-info"><strong><?php echo e($stats['selesai']); ?></strong><span>Selesai</span></div>
        </div>
    </div>

    
    <form method="GET" action="<?php echo e(route('studio.rental-bookings.index')); ?>">
        <div class="filter-bar">
            <i class="fas fa-search" style="color:#CBD5E1; font-size:0.9rem; flex-shrink:0;"></i>
            <input type="text" name="search" placeholder="Cari nama pemesan atau alat..." value="<?php echo e(request('search')); ?>">
            <select name="status">
                <option value="">Semua Status</option>
                <?php $__currentLoopData = ['menunggu'=>'Menunggu','disetujui'=>'Disetujui','aktif'=>'Sedang Berjalan','selesai'=>'Selesai','ditolak'=>'Ditolak']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($val); ?>" <?php echo e(request('status') == $val ? 'selected' : ''); ?>><?php echo e($label); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <button type="submit" class="filter-btn"><i class="fas fa-filter"></i> Filter</button>
            <?php if(request('search') || request('status')): ?>
                <a href="<?php echo e(route('studio.rental-bookings.index')); ?>" class="reset-btn">
                    <i class="fas fa-times"></i> Reset
                </a>
            <?php endif; ?>
        </div>
    </form>

    
    <div class="bookings-card">
        <?php if($bookings->isEmpty()): ?>
            <div class="empty-state">
                <div class="empty-icon-wrap"><i class="fas fa-calendar-check"></i></div>
                <h5>Belum Ada Pemesanan</h5>
                <p>Pemesanan sewa alat dari pengunjung akan muncul di sini.</p>
            </div>
        <?php else: ?>
            <div style="overflow-x: auto;">
                <table class="bookings-table">
                    <thead>
                        <tr>
                            <th style="width:40px;">#</th>
                            <th>Pemesan</th>
                            <th>Alat</th>
                            <th>Periode Sewa</th>
                            <th>Qty</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th style="width:90px; text-align:center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $bookings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $booking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td style="color:#CBD5E1; font-size:0.8rem; font-weight:600;">
                                    <?php echo e($bookings->firstItem() + $i); ?>

                                </td>
                                <td>
                                    <div class="pemesan-name"><?php echo e($booking->pemesan_name); ?></div>
                                    <div class="pemesan-phone"><?php echo e($booking->pemesan_phone); ?></div>
                                </td>
                                <td>
                                    <div class="tool-name"><?php echo e($booking->tool->name ?? '—'); ?></div>
                                    <div class="tool-cat"><?php echo e($booking->tool->category ?? ''); ?></div>
                                </td>
                                <td>
                                    <div class="date-range">
                                        <?php echo e($booking->tanggal_mulai->format('d M Y')); ?>

                                        <i class="fas fa-arrow-right" style="font-size:0.65rem; color:#CBD5E1; margin:0 4px;"></i>
                                        <?php echo e($booking->tanggal_selesai->format('d M Y')); ?>

                                    </div>
                                    <div class="date-range durasi"><?php echo e($booking->durasi); ?> hari</div>
                                </td>
                                <td style="font-size:0.85rem; font-weight:600;"><?php echo e($booking->qty); ?> unit</td>
                                <td>
                                    <div class="harga-total">
                                        Rp <?php echo e(number_format($booking->total_harga, 0, ',', '.')); ?>

                                    </div>
                                </td>
                                <td>
                                    <span class="status-badge status-<?php echo e($booking->status); ?>">
                                        <?php echo e($booking->status_label); ?>

                                    </span>
                                </td>
                                <td>
                                    <div style="display:flex; align-items:center; justify-content:center; gap:6px;">
                                        <a href="<?php echo e(route('studio.rental-bookings.show', $booking)); ?>"
                                           class="act-btn view" title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <form action="<?php echo e(route('studio.rental-bookings.destroy', $booking)); ?>"
                                              method="POST" style="margin:0;">
                                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="act-btn delete" title="Hapus"
                                                    onclick="return confirm('Yakin hapus pemesanan dari <?php echo e(addslashes($booking->pemesan_name)); ?>?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <?php if($bookings->hasPages()): ?>
                <div class="card-foot"><?php echo e($bookings->links()); ?></div>
            <?php endif; ?>
        <?php endif; ?>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\qofmedia-web\resources\views/studio/rental-bookings/index.blade.php ENDPATH**/ ?>