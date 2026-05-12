

<?php $__env->startSection('title', 'Kelola Edisi Kaos'); ?>

<?php $__env->startSection('content_header'); ?>
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="mb-0" style="font-size: 1.4rem; font-weight: 700; color: #0D1B2A;">
                <i class="fas fa-layer-group me-2" style="color: #0E7A96;"></i> Edisi Kaos
            </h1>
            <ol class="breadcrumb mb-0 mt-1" style="font-size: 0.8rem; background: transparent; padding: 0;">
                <li class="breadcrumb-item"><a href="<?php echo e(route('apparel.dashboard')); ?>">Dashboard</a></li>
                <li class="breadcrumb-item active">Edisi Kaos</li>
            </ol>
        </div>
        <button data-toggle="modal" data-target="#addModal"
            style="display:inline-flex; align-items:center; gap:8px; background: linear-gradient(135deg, #0E7A96, #4EB8CC); color:#fff; padding:10px 22px; border-radius:50px; font-weight:700; font-size:0.85rem; border:none; cursor:pointer; transition:all 0.3s; box-shadow: 0 4px 14px rgba(14,122,150,0.25);">
            <i class="fas fa-plus"></i> Tambah Edisi
        </button>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<style>
    /* ============================================
       SECTION LABEL
       ============================================ */
    .sec-label {
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: #94A3B8;
        margin-bottom: 14px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .sec-label::after {
        content: '';
        flex: 1;
        height: 1px;
        background: #E2E8F0;
    }

    /* ============================================
       STAT CARDS (mini)
       ============================================ */
    .stat-card {
        background: #fff;
        border: 1px solid #E2E8F0;
        border-radius: 18px;
        padding: 20px 22px 16px;
        display: flex;
        align-items: flex-start;
        gap: 16px;
        transition: all 0.28s cubic-bezier(0.22, 1, 0.36, 1);
        position: relative;
        overflow: hidden;
    }
    .stat-card::after {
        content: '';
        position: absolute;
        bottom: 0; left: 0; right: 0;
        height: 3px;
        border-radius: 0 0 18px 18px;
        opacity: 0;
        transition: opacity 0.3s;
    }
    .stat-card:hover { transform: translateY(-3px); box-shadow: 0 10px 28px rgba(0,0,0,0.08); border-color: transparent; }
    .stat-card:hover::after { opacity: 1; }

    .stat-card.blue  { --c:#0E7A96; --bg:#EEF9FC; }
    .stat-card.green { --c:#059669; --bg:#D1FAE5; }
    .stat-card.amber { --c:#D97706; --bg:#FEF3C7; }

    .stat-card.blue::after  { background: #0E7A96; }
    .stat-card.green::after { background: #059669; }
    .stat-card.amber::after { background: #D97706; }

    .stat-card:hover.blue  { box-shadow: 0 10px 28px rgba(14,122,150,0.13); border-color: #4EB8CC; }
    .stat-card:hover.green { box-shadow: 0 10px 28px rgba(5,150,105,0.13);  border-color: #34D399; }
    .stat-card:hover.amber { box-shadow: 0 10px 28px rgba(217,119,6,0.13);  border-color: #FBBF24; }

    .stat-icon {
        width: 48px; height: 48px;
        border-radius: 13px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.2rem;
        flex-shrink: 0;
        background: var(--bg);
        color: var(--c);
        transition: transform 0.3s;
    }
    .stat-card:hover .stat-icon { transform: scale(1.1) rotate(-4deg); }
    .stat-number { font-size: 1.8rem; font-weight: 800; color: #0D1B2A; line-height: 1; margin-bottom: 3px; }
    .stat-label  { font-size: 0.78rem; color: #64748B; font-weight: 500; }

    /* ============================================
       DASH CARD
       ============================================ */
    .dash-card {
        background: #fff;
        border: 1px solid #E2E8F0;
        border-radius: 18px;
        overflow: hidden;
    }
    .dash-card-header {
        padding: 18px 22px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 1px solid #F1F5F9;
    }
    .dash-card-title {
        font-size: 0.92rem;
        font-weight: 700;
        color: #0D1B2A;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .dash-card-title i { color: #0E7A96; }

    /* ============================================
       SEARCH & FILTER BAR
       ============================================ */
    .filter-bar {
        padding: 14px 22px;
        background: #F8FAFC;
        border-bottom: 1px solid #F1F5F9;
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }
    .search-wrap {
        position: relative;
        flex: 1;
        min-width: 180px;
    }
    .search-wrap .search-icon {
        position: absolute;
        left: 12px; top: 50%;
        transform: translateY(-50%);
        color: #94A3B8;
        font-size: 0.82rem;
        pointer-events: none;
    }
    .search-wrap input {
        width: 100%;
        padding: 8px 14px 8px 34px;
        border: 1.5px solid #E2E8F0;
        border-radius: 50px;
        font-size: 0.83rem;
        color: #0D1B2A;
        background: #fff;
        transition: border-color 0.2s;
        outline: none;
    }
    .search-wrap input:focus { border-color: #0E7A96; box-shadow: 0 0 0 3px rgba(14,122,150,0.09); }
    .search-wrap input::placeholder { color: #CBD5E1; }

    .filter-select {
        padding: 8px 14px;
        border: 1.5px solid #E2E8F0;
        border-radius: 50px;
        font-size: 0.83rem;
        color: #0D1B2A;
        background: #fff;
        transition: border-color 0.2s;
        outline: none;
        cursor: pointer;
    }
    .filter-select:focus { border-color: #0E7A96; }

    .count-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: rgba(14,122,150,0.08);
        color: #0E7A96;
        padding: 6px 14px;
        border-radius: 50px;
        font-size: 0.78rem;
        font-weight: 700;
        white-space: nowrap;
    }

    /* ============================================
       TABLE
       ============================================ */
    .dash-table { width: 100%; border-collapse: collapse; }
    .dash-table thead th {
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.07em;
        color: #94A3B8;
        padding: 10px 22px;
        background: #F8FAFC;
        border-bottom: 1px solid #F1F5F9;
        white-space: nowrap;
    }
    .dash-table tbody tr {
        border-bottom: 1px solid #F8FAFC;
        transition: background 0.18s;
    }
    .dash-table tbody tr:last-child { border-bottom: none; }
    .dash-table tbody tr:hover { background: #F8FAFC; }
    .dash-table tbody td {
        padding: 13px 22px;
        font-size: 0.85rem;
        color: #0D1B2A;
        vertical-align: middle;
    }
    .td-muted { font-size: 0.75rem; color: #94A3B8; margin-top: 2px; }

    /* row number pill */
    .row-num {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 26px; height: 26px;
        border-radius: 8px;
        background: #F1F5F9;
        color: #64748B;
        font-size: 0.72rem;
        font-weight: 700;
    }

    /* product pill */
    .product-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(14,122,150,0.07);
        border: 1px solid rgba(14,122,150,0.13);
        color: #0E7A96;
        padding: 4px 12px;
        border-radius: 8px;
        font-size: 0.78rem;
        font-weight: 700;
    }

    /* year badge */
    .year-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: #FEF3C7;
        color: #92400E;
        padding: 4px 12px;
        border-radius: 8px;
        font-size: 0.78rem;
        font-weight: 700;
    }

    /* action buttons */
    .btn-xs-act {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px; height: 32px;
        border-radius: 9px;
        font-size: 0.8rem;
        border: none;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.2s;
    }
    .btn-xs-act.edit   { background: rgba(217,119,6,0.09);  color: #D97706; }
    .btn-xs-act.danger { background: rgba(220,38,38,0.09);  color: #DC2626; }
    .btn-xs-act:hover  { filter: brightness(0.88); transform: scale(1.08); }

    /* empty */
    .empty-row td {
        text-align: center;
        padding: 48px 20px !important;
        color: #94A3B8;
        font-size: 0.85rem;
    }
    .empty-icon-sm { font-size: 2.5rem; display: block; margin-bottom: 10px; opacity: 0.3; }

    /* ============================================
       MODAL
       ============================================ */
    .modal-content {
        border: none !important;
        border-radius: 20px !important;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0,0,0,0.15) !important;
    }
    .modal-header {
        background: linear-gradient(135deg, #0D1B2A 0%, #1B3A4B 55%, #0E7A96 100%);
        border: none !important;
        padding: 20px 24px !important;
    }
    .modal-title-custom {
        color: #fff;
        font-weight: 800;
        font-size: 1rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .modal-body { padding: 24px !important; }
    .modal-footer {
        border-top: 1px solid #F1F5F9 !important;
        padding: 16px 24px !important;
        gap: 10px;
    }

    .modal-form-group { margin-bottom: 18px; }
    .modal-form-group label {
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #64748B;
        margin-bottom: 7px;
        display: block;
    }
    .modal-form-group .form-control,
    .modal-form-group select.form-control {
        border: 1.5px solid #E2E8F0;
        border-radius: 12px;
        font-size: 0.87rem;
        color: #0D1B2A;
        padding: 10px 14px;
        height: auto;
        transition: border-color 0.2s;
        box-shadow: none !important;
    }
    .modal-form-group .form-control:focus,
    .modal-form-group select.form-control:focus {
        border-color: #0E7A96;
        box-shadow: 0 0 0 3px rgba(14,122,150,0.1) !important;
        outline: none;
    }

    .btn-modal-primary {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 10px 24px;
        background: linear-gradient(135deg, #0E7A96, #4EB8CC);
        color: #fff;
        border: none;
        border-radius: 50px;
        font-size: 0.87rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.25s;
    }
    .btn-modal-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(14,122,150,0.3);
        color: #fff;
    }
    .btn-modal-cancel {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        padding: 10px 20px;
        background: #fff;
        color: #64748B;
        border: 1.5px solid #E2E8F0;
        border-radius: 50px;
        font-size: 0.87rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s;
    }
    .btn-modal-cancel:hover { background: #F8FAFC; color: #0D1B2A; }

    /* ============================================
       ANIMATIONS
       ============================================ */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(14px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .anim-1 { animation: fadeInUp 0.38s ease both; }
    .anim-2 { animation: fadeInUp 0.38s 0.07s ease both; }
    .anim-3 { animation: fadeInUp 0.38s 0.14s ease both; }

    /* ============================================
       RESPONSIVE
       ============================================ */
    @media (max-width: 576px) {
        .filter-bar { gap: 8px; }
        .dash-table thead th:nth-child(2),
        .dash-table tbody td:nth-child(2) { display: none; }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    <?php if(session('success')): ?>
        <div class="alert alert-dismissible fade show"
             style="border-radius: 12px; font-size: 0.88rem; border: none; background: #D1FAE5; color: #065F46; margin-bottom: 20px;">
            <i class="fas fa-check-circle me-2"></i> <?php echo e(session('success')); ?>

            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    <?php endif; ?>

    
    <p class="sec-label anim-1">Ringkasan</p>
    <div class="row g-3 mb-4 anim-1">
        <div class="col-6 col-lg-4">
            <div class="stat-card blue">
                <div class="stat-icon"><i class="fas fa-layer-group"></i></div>
                <div>
                    <div class="stat-number"><?php echo e($editions->count()); ?></div>
                    <div class="stat-label">Total Edisi</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-4">
            <div class="stat-card green">
                <div class="stat-icon"><i class="fas fa-tshirt"></i></div>
                <div>
                    <div class="stat-number"><?php echo e($products->count()); ?></div>
                    <div class="stat-label">Total Produk</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-4">
            <div class="stat-card amber">
                <div class="stat-icon"><i class="fas fa-calendar-alt"></i></div>
                <div>
                    <div class="stat-number"><?php echo e($editions->pluck('year')->unique()->count()); ?></div>
                    <div class="stat-label">Tahun Tersedia</div>
                </div>
            </div>
        </div>
    </div>

    
    <p class="sec-label anim-2">Daftar Edisi</p>
    <div class="dash-card anim-2">

        
        <div class="dash-card-header">
            <div class="dash-card-title">
                <i class="fas fa-layer-group"></i> Edisi Kaos
            </div>
            <span class="count-badge">
                <i class="fas fa-list"></i>
                <?php echo e($editions->count()); ?> edisi
            </span>
        </div>

        
        <div class="filter-bar">
            <div class="search-wrap">
                <i class="fas fa-search search-icon"></i>
                <input type="text" id="searchInput" placeholder="Cari nama edisi...">
            </div>
            <select class="filter-select" id="filterProduct">
                <option value="">Semua Produk</option>
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($p->name); ?>"><?php echo e($p->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <select class="filter-select" id="filterYear">
                <option value="">Semua Tahun</option>
                <?php $__currentLoopData = $editions->pluck('year')->unique()->sortDesc(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($year); ?>"><?php echo e($year); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        
        <div class="table-responsive">
            <table class="dash-table" id="editionsTable">
                <thead>
                    <tr>
                        <th style="width:50px;">#</th>
                        <th>Produk</th>
                        <th>Nama Edisi</th>
                        <th>Tahun</th>
                        <th style="width:100px; text-align:center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $editions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $edition): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr data-name="<?php echo e(strtolower($edition->name)); ?>"
                            data-product="<?php echo e($edition->product->name ?? ''); ?>"
                            data-year="<?php echo e($edition->year); ?>">
                            <td>
                                <span class="row-num"><?php echo e($loop->iteration); ?></span>
                            </td>
                            <td>
                                <span class="product-pill">
                                    <i class="fas fa-tshirt" style="font-size:0.72rem;"></i>
                                    <?php echo e($edition->product->name ?? 'N/A'); ?>

                                </span>
                            </td>
                            <td>
                                <div style="font-weight: 700; font-size: 0.88rem;"><?php echo e($edition->name); ?></div>
                                <div class="td-muted">ID #<?php echo e($edition->id); ?></div>
                            </td>
                            <td>
                                <span class="year-badge">
                                    <i class="fas fa-calendar" style="font-size:0.72rem;"></i>
                                    <?php echo e($edition->year); ?>

                                </span>
                            </td>
                            <td style="text-align:center; white-space:nowrap;">
                                <button class="btn-xs-act edit edit-btn"
                                        title="Edit"
                                        data-id="<?php echo e($edition->id); ?>"
                                        data-product="<?php echo e($edition->product_id); ?>"
                                        data-name="<?php echo e($edition->name); ?>"
                                        data-year="<?php echo e($edition->year); ?>"
                                        data-toggle="modal" data-target="#editModal">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="<?php echo e(route('apparel.editions.destroy', $edition)); ?>"
                                      method="POST" class="d-inline">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn-xs-act danger" title="Hapus"
                                            onclick="return confirm('Hapus edisi \'<?php echo e($edition->name); ?>\'?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr class="empty-row">
                            <td colspan="5">
                                <i class="fas fa-layer-group empty-icon-sm"></i>
                                Belum ada edisi kaos
                                <div style="margin-top:10px;">
                                    <button data-toggle="modal" data-target="#addModal"
                                        style="display:inline-flex; align-items:center; gap:6px; background:#EEF9FC; color:#0E7A96; padding:8px 18px; border-radius:50px; font-size:0.8rem; font-weight:700; border:none; cursor:pointer;">
                                        <i class="fas fa-plus"></i> Tambah Edisi Pertama
                                    </button>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        
        <div id="noResults"
             style="display:none; text-align:center; padding: 40px 20px; color:#94A3B8; font-size:0.85rem;">
            <i class="fas fa-search" style="font-size:2rem; display:block; margin-bottom:10px; opacity:0.3;"></i>
            Tidak ada hasil yang cocok
        </div>
    </div>


    
    <div class="modal fade" id="addModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <form action="<?php echo e(route('apparel.editions.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title-custom">
                            <i class="fas fa-plus-circle"></i> Tambah Edisi Baru
                        </div>
                        <button type="button" class="close" data-dismiss="modal"
                                style="color:#fff; opacity:0.7; font-size:1.2rem; background:none; border:none; cursor:pointer;">
                            &times;
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-form-group">
                            <label><i class="fas fa-tshirt me-1"></i> Produk Kaos <span style="color:#DC2626;">*</span></label>
                            <select name="product_id" class="form-control" required>
                                <option value="">— Pilih Produk —</option>
                                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($p->id); ?>"><?php echo e($p->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="modal-form-group">
                            <label><i class="fas fa-tag me-1"></i> Nama Edisi <span style="color:#DC2626;">*</span></label>
                            <input type="text" name="name" class="form-control"
                                   placeholder="contoh: Edisi Kemerdekaan" required>
                        </div>
                        <div class="modal-form-group" style="margin-bottom:0;">
                            <label><i class="fas fa-calendar-alt me-1"></i> Tahun <span style="color:#DC2626;">*</span></label>
                            <input type="number" name="year" class="form-control"
                                   value="<?php echo e(date('Y')); ?>" min="2000" max="2099" required>
                        </div>
                    </div>
                    <div class="modal-footer" style="justify-content: flex-end;">
                        <button type="button" class="btn-modal-cancel" data-dismiss="modal">
                            <i class="fas fa-times"></i> Batal
                        </button>
                        <button type="submit" class="btn-modal-primary">
                            <i class="fas fa-save"></i> Simpan Edisi
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    
    <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <form id="editForm" method="POST">
                <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title-custom">
                            <i class="fas fa-edit"></i> Edit Edisi
                            <span id="editModalTitle" style="opacity:0.7; font-weight:600;"></span>
                        </div>
                        <button type="button" class="close" data-dismiss="modal"
                                style="color:#fff; opacity:0.7; font-size:1.2rem; background:none; border:none; cursor:pointer;">
                            &times;
                        </button>
                    </div>
                    <div class="modal-body">
                        
                        <div style="display:flex; align-items:center; gap:8px; margin-bottom:20px; padding-bottom:16px; border-bottom:1px solid #F1F5F9;">
                            <div style="width:36px;height:36px;border-radius:10px;background:#EEF9FC;color:#0E7A96;display:flex;align-items:center;justify-content:center;">
                                <i class="fas fa-hashtag" style="font-size:0.85rem;"></i>
                            </div>
                            <div>
                                <div style="font-size:0.7rem;color:#94A3B8;font-weight:700;text-transform:uppercase;letter-spacing:0.05em;">Editing ID</div>
                                <div style="font-size:0.88rem;font-weight:800;color:#0D1B2A;" id="editIdDisplay">—</div>
                            </div>
                        </div>

                        <div class="modal-form-group">
                            <label><i class="fas fa-tshirt me-1"></i> Produk Kaos <span style="color:#DC2626;">*</span></label>
                            <select name="product_id" id="editProduct" class="form-control" required>
                                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($p->id); ?>"><?php echo e($p->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="modal-form-group">
                            <label><i class="fas fa-tag me-1"></i> Nama Edisi <span style="color:#DC2626;">*</span></label>
                            <input type="text" name="name" id="editName" class="form-control"
                                   placeholder="Nama edisi" required>
                        </div>
                        <div class="modal-form-group" style="margin-bottom:0;">
                            <label><i class="fas fa-calendar-alt me-1"></i> Tahun <span style="color:#DC2626;">*</span></label>
                            <input type="number" name="year" id="editYear" class="form-control"
                                   min="2000" max="2099" required>
                        </div>
                    </div>
                    <div class="modal-footer" style="justify-content: flex-end;">
                        <button type="button" class="btn-modal-cancel" data-dismiss="modal">
                            <i class="fas fa-times"></i> Batal
                        </button>
                        <button type="submit" class="btn-modal-primary"
                                style="background: linear-gradient(135deg, #D97706, #FBBF24);">
                            <i class="fas fa-save"></i> Update Edisi
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script>
    /* ── Edit Modal ── */
    $('.edit-btn').on('click', function () {
        var id   = $(this).data('id');
        var name = $(this).data('name');
        $('#editProduct').val($(this).data('product'));
        $('#editName').val(name);
        $('#editYear').val($(this).data('year'));
        $('#editForm').attr('action', '/apparel/editions/' + id);
        $('#editModalTitle').text('— ' + name);
        $('#editIdDisplay').text('#' + id);
    });

    /* ── Live search & filter ── */
    function filterTable() {
        var q       = $('#searchInput').val().toLowerCase();
        var product = $('#filterProduct').val().toLowerCase();
        var year    = $('#filterYear').val();
        var rows    = $('#editionsTable tbody tr:not(.empty-row)');
        var visible = 0;

        rows.each(function () {
            var $tr     = $(this);
            var rowName = $tr.data('name') || '';
            var rowProd = ($tr.data('product') || '').toLowerCase();
            var rowYear = String($tr.data('year') || '');

            var show = true;
            if (q       && rowName.indexOf(q) === -1)       show = false;
            if (product && rowProd.indexOf(product) === -1)  show = false;
            if (year    && rowYear !== year)                  show = false;

            $tr.toggle(show);
            if (show) visible++;
        });

        $('#noResults').toggle(visible === 0 && rows.length > 0);
    }

    $('#searchInput').on('input', filterTable);
    $('#filterProduct, #filterYear').on('change', filterTable);
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\qofmedia-web\resources\views/apparel/editions/index.blade.php ENDPATH**/ ?>