

<?php $__env->startSection('title', 'Manajemen Alat Sewa'); ?>

<?php $__env->startSection('content_header'); ?>
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="mb-0" style="font-size: 1.4rem; font-weight: 700; color: #0D1B2A;">
                <i class="fas fa-tools me-2" style="color: #0E7A96;"></i> Manajemen Alat Sewa
            </h1>
            <ol class="breadcrumb mb-0 mt-1" style="font-size: 0.8rem;">
                <li class="breadcrumb-item"><a href="<?php echo e(route('studio.dashboard')); ?>">Dashboard</a></li>
                <li class="breadcrumb-item active">Alat Sewa</li>
            </ol>
        </div>
        <a href="<?php echo e(route('studio.tools.create')); ?>" class="btn btn-primary" style="background: #0E7A96; border-color: #0E7A96; border-radius: 50px; padding: 10px 22px; font-weight: 600; font-size: 0.88rem;">
            <i class="fas fa-plus me-1"></i> Tambah Alat
        </a>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<style>
    /* ============================================
       FIX PAGINATION – SVG ARROW TERLALU BESAR
       ============================================ */
    /* Sembunyikan SVG bawaan Laravel pagination */
    .pagination .page-link svg {
        display: none !important;
    }
    /* Ganti dengan teks biasa */
    .pagination .page-item:first-child .page-link::after { content: '« Prev'; }
    .pagination .page-item:last-child  .page-link::after { content: 'Next »'; }

    .pagination {
        gap: 4px;
        flex-wrap: wrap;
    }
    .pagination .page-link {
        border-radius: 8px !important;
        padding: 7px 14px;
        font-size: 0.85rem;
        font-weight: 600;
        color: #0D1B2A;
        border: 1px solid #E2E8F0;
        background: #fff;
        transition: all 0.2s;
        line-height: 1.5;
        min-width: unset;
    }
    .pagination .page-link:hover {
        background: #0E7A96;
        color: #fff;
        border-color: #0E7A96;
    }
    .pagination .page-item.active .page-link {
        background: #0E7A96;
        border-color: #0E7A96;
        color: #fff;
        box-shadow: 0 4px 12px rgba(14,122,150,0.25);
    }
    .pagination .page-item.disabled .page-link {
        background: #F8FAFC;
        color: #CBD5E1;
        border-color: #E2E8F0;
        pointer-events: none;
    }

    /* ============================================
       CARDS & LAYOUT
       ============================================ */
    .tool-card {
        background: #fff;
        border: 1px solid #E2E8F0;
        border-radius: 16px;
        overflow: hidden;
        transition: all 0.25s;
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    .tool-card:hover {
        border-color: #4EB8CC;
        box-shadow: 0 8px 28px rgba(14,122,150,0.10);
        transform: translateY(-3px);
    }
    .tool-card-image {
        width: 100%;
        aspect-ratio: 1 / 1;
        object-fit: cover;
        display: block;
    }
    .tool-card-placeholder {
        width: 100%;
        aspect-ratio: 1 / 1;
        background: #F1F5F9;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .tool-card-placeholder i {
        font-size: 2.5rem;
        color: #CBD5E1;
    }
    .tool-card-body {
        padding: 16px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    .badge-category {
        display: inline-block;
        padding: 3px 10px;
        background: rgba(14,122,150,0.09);
        color: #0E7A96;
        border-radius: 50px;
        font-size: 0.72rem;
        font-weight: 600;
        margin-bottom: 8px;
    }
    .badge-available {
        display: inline-block;
        padding: 3px 10px;
        background: #D1FAE5;
        color: #065F46;
        border-radius: 50px;
        font-size: 0.72rem;
        font-weight: 600;
    }
    .badge-unavailable {
        display: inline-block;
        padding: 3px 10px;
        background: #FEE2E2;
        color: #991B1B;
        border-radius: 50px;
        font-size: 0.72rem;
        font-weight: 600;
    }
    .tool-name {
        font-size: 0.95rem;
        font-weight: 700;
        color: #0D1B2A;
        margin-bottom: 4px;
        line-height: 1.3;
    }
    .tool-price {
        font-size: 1rem;
        font-weight: 700;
        color: #0E7A96;
        margin-top: auto;
        padding-top: 10px;
    }
    .tool-price small {
        font-size: 0.72rem;
        font-weight: 400;
        color: #94A3B8;
    }
    .tool-stock {
        font-size: 0.78rem;
        color: #64748B;
        margin-bottom: 12px;
    }
    .tool-actions {
        display: flex;
        gap: 8px;
        margin-top: 12px;
        border-top: 1px solid #F1F5F9;
        padding-top: 12px;
    }
    .btn-edit {
        flex: 1;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        background: rgba(14,122,150,0.08);
        color: #0E7A96;
        border: none;
        border-radius: 8px;
        padding: 8px;
        font-size: 0.82rem;
        font-weight: 600;
        text-decoration: none;
        transition: background 0.2s;
    }
    .btn-edit:hover {
        background: rgba(14,122,150,0.16);
        color: #0E7A96;
        text-decoration: none;
    }
    .btn-delete {
        flex: 1;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        background: rgba(239,68,68,0.08);
        color: #DC2626;
        border: none;
        border-radius: 8px;
        padding: 8px;
        font-size: 0.82rem;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s;
        width: 100%;
    }
    .btn-delete:hover {
        background: rgba(239,68,68,0.16);
        color: #DC2626;
    }
    .empty-state {
        text-align: center;
        padding: 80px 20px;
        background: #fff;
        border-radius: 16px;
        border: 1px solid #E2E8F0;
    }
    .empty-icon {
        width: 72px;
        height: 72px;
        background: #F1F5F9;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 16px;
    }
    .empty-icon i {
        font-size: 1.8rem;
        color: #CBD5E1;
    }
    .filter-bar {
        background: #fff;
        border: 1px solid #E2E8F0;
        border-radius: 12px;
        padding: 14px 18px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }
    .filter-bar input {
        border: 1px solid #E2E8F0;
        border-radius: 8px;
        padding: 8px 14px;
        font-size: 0.85rem;
        outline: none;
        flex: 1;
        min-width: 160px;
        color: #0D1B2A;
    }
    .filter-bar input:focus {
        border-color: #0E7A96;
    }
    .filter-bar select {
        border: 1px solid #E2E8F0;
        border-radius: 8px;
        padding: 8px 14px;
        font-size: 0.85rem;
        outline: none;
        color: #0D1B2A;
        background: #fff;
    }
    .filter-bar select:focus {
        border-color: #0E7A96;
    }
    .stats-bar {
        display: flex;
        gap: 12px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }
    .stat-chip {
        background: #fff;
        border: 1px solid #E2E8F0;
        border-radius: 10px;
        padding: 10px 16px;
        font-size: 0.82rem;
        color: #64748B;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .stat-chip strong {
        color: #0D1B2A;
        font-size: 1rem;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" style="border-radius: 12px; font-size: 0.88rem; border: none; background: #D1FAE5; color: #065F46;">
            <i class="fas fa-check-circle me-2"></i><?php echo e(session('success')); ?>

            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    <?php endif; ?>

    
    <div class="stats-bar">
        <div class="stat-chip">
            <i class="fas fa-tools" style="color: #0E7A96;"></i>
            Total Alat: <strong><?php echo e($tools->total()); ?></strong>
        </div>
        <div class="stat-chip">
            <i class="fas fa-check-circle" style="color: #10B981;"></i>
            Tersedia: <strong><?php echo e($tools->where('is_available', true)->count()); ?></strong>
        </div>
        <div class="stat-chip">
            <i class="fas fa-times-circle" style="color: #EF4444;"></i>
            Tidak Tersedia: <strong><?php echo e($tools->where('is_available', false)->count()); ?></strong>
        </div>
    </div>

    
    <div class="filter-bar">
        <i class="fas fa-search" style="color: #94A3B8; font-size: 0.9rem;"></i>
        <input type="text" id="searchInput" placeholder="Cari nama alat..." oninput="filterCards()">
        <select id="statusFilter" onchange="filterCards()">
            <option value="">Semua Status</option>
            <option value="tersedia">Tersedia</option>
            <option value="habis">Tidak Tersedia</option>
        </select>
    </div>

    
    <?php if($tools->isEmpty()): ?>
        <div class="empty-state">
            <div class="empty-icon">
                <i class="fas fa-tools"></i>
            </div>
            <h5 style="font-weight: 700; color: #0D1B2A; margin-bottom: 6px;">Belum Ada Alat Sewa</h5>
            <p style="color: #64748B; font-size: 0.88rem; margin-bottom: 20px;">Mulai tambahkan peralatan yang tersedia untuk disewa.</p>
            <a href="<?php echo e(route('studio.tools.create')); ?>" class="btn btn-primary" style="background: #0E7A96; border-color: #0E7A96; border-radius: 50px; padding: 10px 24px; font-weight: 600;">
                <i class="fas fa-plus me-1"></i> Tambah Alat Pertama
            </a>
        </div>
    <?php else: ?>
        <div class="row g-3" id="cardGrid">
            <?php $__currentLoopData = $tools; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tool): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-6 col-md-4 col-lg-3 card-item"
                     data-name="<?php echo e(strtolower($tool->name)); ?>"
                     data-status="<?php echo e($tool->is_available && $tool->stock > 0 ? 'tersedia' : 'habis'); ?>">
                    <div class="tool-card">

                        
                        <?php if($tool->image): ?>
                            <img src="<?php echo e(asset('storage/' . $tool->image)); ?>"
                                 class="tool-card-image"
                                 alt="<?php echo e($tool->name); ?>"
                                 loading="lazy">
                        <?php else: ?>
                            <div class="tool-card-placeholder">
                                <i class="fas fa-tools"></i>
                            </div>
                        <?php endif; ?>

                        <div class="tool-card-body">
                            
                            <div class="mb-1">
                                <?php if($tool->is_available && $tool->stock > 0): ?>
                                    <span class="badge-available"><i class="fas fa-circle" style="font-size: 0.5rem; vertical-align: middle;"></i> Tersedia</span>
                                <?php else: ?>
                                    <span class="badge-unavailable"><i class="fas fa-circle" style="font-size: 0.5rem; vertical-align: middle;"></i> Habis</span>
                                <?php endif; ?>
                            </div>

                            
                            <div class="tool-name"><?php echo e($tool->name); ?></div>

                            
                            <span class="badge-category"><?php echo e($tool->category); ?></span>

                            
                            <div class="tool-stock">
                                <i class="fas fa-layer-group me-1"></i> Stok: <?php echo e($tool->stock); ?> unit
                            </div>

                            
                            <div class="tool-price">
                                Rp <?php echo e(number_format($tool->price_per_day, 0, ',', '.')); ?>

                                <small>/ hari</small>
                            </div>

                            
                            <div class="tool-actions">
                                <a href="<?php echo e(route('studio.tools.edit', $tool)); ?>" class="btn-edit">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="<?php echo e(route('studio.tools.destroy', $tool)); ?>" method="POST" style="flex: 1;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn-delete"
                                            onclick="return confirm('Yakin ingin menghapus \'<?php echo e($tool->name); ?>\'?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        
        <?php if($tools->hasPages()): ?>
            <div class="mt-4 d-flex justify-content-center">
                <?php echo e($tools->links()); ?>

            </div>
        <?php endif; ?>
    <?php endif; ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script>
function filterCards() {
    const search = document.getElementById('searchInput').value.toLowerCase();
    const status = document.getElementById('statusFilter').value;
    document.querySelectorAll('.card-item').forEach(card => {
        const name = card.dataset.name;
        const cardStatus = card.dataset.status;
        const matchSearch = name.includes(search);
        const matchStatus = !status || cardStatus === status;
        card.style.display = matchSearch && matchStatus ? '' : 'none';
    });
}
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\qofmedia-web\resources\views/studio/tools/index.blade.php ENDPATH**/ ?>