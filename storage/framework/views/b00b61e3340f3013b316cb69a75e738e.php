

<?php $__env->startSection('title', 'Paket Fotografi'); ?>

<?php $__env->startSection('content_header'); ?>
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="mb-0" style="font-size: 1.4rem; font-weight: 700; color: #0D1B2A;">
                <i class="fas fa-camera me-2" style="color: #0E7A96;"></i> Paket Fotografi
            </h1>
            <ol class="breadcrumb mb-0 mt-1" style="font-size: 0.8rem; background: transparent; padding: 0;">
                <li class="breadcrumb-item"><a href="<?php echo e(route('studio.dashboard')); ?>">Dashboard</a></li>
                <li class="breadcrumb-item active">Paket Foto</li>
            </ol>
        </div>
        <a href="<?php echo e(route('studio.photo-packages.create')); ?>"
           style="display:inline-flex; align-items:center; gap:7px; background:#0E7A96; color:#fff; padding:10px 22px; border-radius:50px; font-weight:700; font-size:0.88rem; text-decoration:none; border:none; transition:all 0.3s;">
            <i class="fas fa-plus"></i> Tambah Paket
        </a>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<style>
    /* ============================================
       ALERT
       ============================================ */
    .alert-success-custom {
        border-radius: 12px;
        border: none;
        background: #D1FAE5;
        color: #065F46;
        font-size: 0.88rem;
        padding: 12px 18px;
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 20px;
    }

    /* ============================================
       STATS BAR
       ============================================ */
    .stats-bar {
        display: flex;
        gap: 12px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }
    .stat-chip {
        background: #fff;
        border: 1px solid #E2E8F0;
        border-radius: 12px;
        padding: 10px 18px;
        font-size: 0.82rem;
        color: #64748B;
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: 500;
    }
    .stat-chip strong { color: #0D1B2A; font-size: 1rem; font-weight: 700; }
    .stat-chip i { color: #0E7A96; }

    /* ============================================
       FILTER BAR
       ============================================ */
    .filter-bar {
        background: #fff;
        border: 1px solid #E2E8F0;
        border-radius: 14px;
        padding: 14px 20px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }
    .filter-bar input,
    .filter-bar select {
        border: 1.5px solid #E2E8F0;
        border-radius: 8px;
        padding: 8px 14px;
        font-size: 0.85rem;
        outline: none;
        color: #0D1B2A;
        background: #F8FAFC;
        transition: border-color 0.2s;
    }
    .filter-bar input  { flex: 1; min-width: 180px; }
    .filter-bar input:focus,
    .filter-bar select:focus { border-color: #0E7A96; background: #fff; }

    /* ============================================
       MAIN CARD
       ============================================ */
    .packages-card {
        background: #fff;
        border: 1px solid #E2E8F0;
        border-radius: 20px;
        overflow: hidden;
    }

    /* ============================================
       TABLE
       ============================================ */
    .packages-table { width: 100%; border-collapse: collapse; }

    .packages-table thead th {
        background: #F8FAFC;
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: #94A3B8;
        padding: 13px 20px;
        border-bottom: 1px solid #F1F5F9;
        white-space: nowrap;
    }

    .packages-table tbody tr {
        border-bottom: 1px solid #F8FAFC;
        transition: background 0.15s;
    }
    .packages-table tbody tr:last-child { border-bottom: none; }
    .packages-table tbody tr:hover { background: #FAFCFE; }

    .packages-table tbody td {
        padding: 14px 20px;
        vertical-align: middle;
        font-size: 0.88rem;
        color: #0D1B2A;
    }

    /* Package name */
    .pkg-name {
        font-weight: 700;
        color: #0D1B2A;
        font-size: 0.9rem;
        margin-bottom: 2px;
    }

    /* Price */
    .pkg-price {
        font-weight: 700;
        color: #0D1B2A;
        font-size: 0.88rem;
        white-space: nowrap;
    }

    /* Duration badge */
    .badge-duration {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 4px 12px;
        background: rgba(14,122,150,0.08);
        color: #0E7A96;
        border-radius: 50px;
        font-size: 0.72rem;
        font-weight: 700;
        white-space: nowrap;
    }

    /* Popular badge */
    .badge-popular {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 4px 12px;
        background: rgba(217,119,6,0.09);
        color: #D97706;
        border-radius: 50px;
        font-size: 0.72rem;
        font-weight: 700;
        white-space: nowrap;
    }
    .badge-regular {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 24px; height: 24px;
        background: #F1F5F9;
        border-radius: 6px;
        color: #CBD5E1;
        font-size: 0.75rem;
    }

    /* Action buttons */
    .act-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px; height: 32px;
        border-radius: 8px;
        border: none;
        font-size: 0.8rem;
        text-decoration: none;
        transition: all 0.2s;
        cursor: pointer;
    }
    .act-btn.edit   { background: rgba(217,119,6,0.09);  color: #D97706; }
    .act-btn.delete { background: rgba(220,38,38,0.09);  color: #DC2626; }
    .act-btn:hover  { filter: brightness(0.88); transform: scale(1.08); text-decoration: none; }

    /* ============================================
       EMPTY STATE
       ============================================ */
    .empty-state { text-align: center; padding: 70px 20px; }
    .empty-icon-wrap {
        width: 80px; height: 80px;
        background: #EEF9FC;
        border-radius: 24px;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 18px;
        font-size: 2rem;
        color: #0E7A96;
        opacity: 0.6;
    }
    .empty-state h5 { font-weight: 700; color: #0D1B2A; margin-bottom: 6px; }
    .empty-state p  { color: #94A3B8; font-size: 0.88rem; margin-bottom: 20px; }

    /* ============================================
       PAGINATION
       ============================================ */
    .pagination .page-link svg { display: none !important; }
    .pagination .page-item:first-child .page-link::after { content: '« Prev'; }
    .pagination .page-item:last-child  .page-link::after { content: 'Next »'; }

    .pagination { gap: 4px; flex-wrap: wrap; }
    .pagination .page-link {
        border-radius: 8px !important;
        padding: 7px 14px;
        font-size: 0.85rem;
        font-weight: 600;
        color: #0D1B2A;
        border: 1.5px solid #E2E8F0;
        background: #fff;
        transition: all 0.2s;
    }
    .pagination .page-link:hover { background: #0E7A96; color: #fff; border-color: #0E7A96; }
    .pagination .page-item.active .page-link {
        background: #0E7A96; border-color: #0E7A96; color: #fff;
        box-shadow: 0 4px 12px rgba(14,122,150,0.25);
    }
    .pagination .page-item.disabled .page-link {
        background: #F8FAFC; color: #CBD5E1; border-color: #E2E8F0;
    }
    .card-foot {
        padding: 14px 20px;
        border-top: 1px solid #F1F5F9;
        display: flex;
        justify-content: center;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    
    <?php if(session('success')): ?>
        <div class="alert-success-custom alert-dismissible">
            <i class="fas fa-check-circle"></i> <?php echo e(session('success')); ?>

            <button type="button" class="close ml-auto" data-dismiss="alert"
                    style="background:none; border:none; cursor:pointer; color:#065F46; font-size:1rem;">&times;</button>
        </div>
    <?php endif; ?>

    
    <div class="stats-bar">
        <div class="stat-chip">
            <i class="fas fa-camera"></i>
            Total Paket: <strong><?php echo e(isset($packages) ? $packages->total() : 0); ?></strong>
        </div>
        <div class="stat-chip">
            <i class="fas fa-star" style="color:#D97706;"></i>
            Populer: <strong style="color:#D97706;"><?php echo e(isset($packages) ? $packages->getCollection()->where('is_popular', true)->count() : 0); ?></strong>
        </div>
        <div class="stat-chip">
            <i class="fas fa-layer-group"></i>
            Halaman ini: <strong><?php echo e(isset($packages) ? $packages->count() : 0); ?></strong>
        </div>
    </div>

    
    <div class="filter-bar">
        <i class="fas fa-search" style="color:#CBD5E1; font-size:0.9rem; flex-shrink:0;"></i>
        <input type="text" id="searchInput" placeholder="Cari nama paket..." oninput="filterRows()">
        <select id="popularFilter" onchange="filterRows()">
            <option value="">Semua</option>
            <option value="populer">Populer</option>
            <option value="reguler">Reguler</option>
        </select>
    </div>

    
    <div class="packages-card">
        <?php if(($packages ?? collect())->isEmpty()): ?>
            <div class="empty-state">
                <div class="empty-icon-wrap"><i class="fas fa-camera"></i></div>
                <h5>Belum Ada Paket Fotografi</h5>
                <p>Mulai tambahkan paket fotografi pertama Anda.</p>
                <a href="<?php echo e(route('studio.photo-packages.create')); ?>"
                   style="display:inline-flex; align-items:center; gap:6px; background:#0E7A96; color:#fff; padding:10px 24px; border-radius:50px; font-weight:700; font-size:0.88rem; text-decoration:none;">
                    <i class="fas fa-plus"></i> Tambah Paket
                </a>
            </div>
        <?php else: ?>
            <div style="overflow-x: auto;">
                <table class="packages-table" id="packagesTable">
                    <thead>
                        <tr>
                            <th style="width:40px;">#</th>
                            <th>Nama Paket</th>
                            <th>Harga</th>
                            <th>Durasi</th>
                            <th>Status</th>
                            <th style="width:90px; text-align:center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="pkg-row"
                                data-name="<?php echo e(strtolower($package->name)); ?>"
                                data-popular="<?php echo e($package->is_popular ? 'populer' : 'reguler'); ?>">
                                <td style="color:#CBD5E1; font-size:0.8rem; font-weight:600;">
                                    <?php echo e($loop->iteration + ($packages->currentPage() - 1) * $packages->perPage()); ?>

                                </td>
                                <td>
                                    <div class="pkg-name"><?php echo e($package->name); ?></div>
                                </td>
                                <td>
                                    <span class="pkg-price">Rp <?php echo e(number_format($package->price, 0, ',', '.')); ?></span>
                                </td>
                                <td>
                                    <span class="badge-duration">
                                        <i class="fas fa-clock"></i> <?php echo e($package->duration); ?>

                                    </span>
                                </td>
                                <td>
                                    <?php if($package->is_popular): ?>
                                        <span class="badge-popular">
                                            <i class="fas fa-star"></i> Populer
                                        </span>
                                    <?php else: ?>
                                        <span class="badge-regular">—</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div style="display:flex; align-items:center; justify-content:center; gap:6px;">
                                        <a href="<?php echo e(route('studio.photo-packages.edit', $package)); ?>"
                                           class="act-btn edit" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="<?php echo e(route('studio.photo-packages.destroy', $package)); ?>"
                                              method="POST" style="margin:0;">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="act-btn delete" title="Hapus"
                                                    onclick="return confirm('Yakin ingin menghapus paket \'<?php echo e(addslashes($package->name)); ?>\'?')">
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

            <?php if(isset($packages) && $packages->hasPages()): ?>
                <div class="card-foot">
                    <?php echo e($packages->links()); ?>

                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script>
function filterRows() {
    var search  = document.getElementById('searchInput').value.toLowerCase();
    var popular = document.getElementById('popularFilter').value.toLowerCase();
    document.querySelectorAll('.pkg-row').forEach(function (row) {
        var matchName    = row.dataset.name.includes(search);
        var matchPopular = !popular || row.dataset.popular === popular;
        row.style.display = matchName && matchPopular ? '' : 'none';
    });
}
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\qofmedia-web\resources\views/studio/photo-packages/index.blade.php ENDPATH**/ ?>