

<?php $__env->startSection('title', 'Kelola Model/Motif Kaos'); ?>

<?php $__env->startSection('content_header'); ?>
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="mb-0" style="font-size: 1.4rem; font-weight: 700; color: #0D1B2A;">
                <i class="fas fa-paint-brush me-2" style="color: #0E7A96;"></i> Model / Motif Kaos
            </h1>
            <ol class="breadcrumb mb-0 mt-1" style="font-size: 0.8rem; background: transparent; padding: 0;">
                <li class="breadcrumb-item"><a href="<?php echo e(route('apparel.dashboard')); ?>">Dashboard</a></li>
                <li class="breadcrumb-item active">Model / Motif</li>
            </ol>
        </div>
        <button data-toggle="modal" data-target="#addModal"
            style="display:inline-flex; align-items:center; gap:8px; background: linear-gradient(135deg, #0E7A96, #4EB8CC); color:#fff; padding:10px 22px; border-radius:50px; font-weight:700; font-size:0.85rem; border:none; cursor:pointer; transition:all 0.3s; box-shadow: 0 4px 14px rgba(14,122,150,0.25);">
            <i class="fas fa-plus"></i> Tambah Model
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
       STAT CARDS
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
    .stat-card:hover { transform: translateY(-3px); border-color: transparent; }
    .stat-card:hover::after { opacity: 1; }

    .stat-card.blue  { --c:#0E7A96; --bg:#EEF9FC; }
    .stat-card.green { --c:#059669; --bg:#D1FAE5; }
    .stat-card.amber { --c:#D97706; --bg:#FEF3C7; }
    .stat-card.red   { --c:#DC2626; --bg:#FEE2E2; }

    .stat-card.blue::after  { background: #0E7A96; }
    .stat-card.green::after { background: #059669; }
    .stat-card.amber::after { background: #D97706; }
    .stat-card.red::after   { background: #DC2626; }

    .stat-card:hover.blue  { box-shadow: 0 10px 28px rgba(14,122,150,0.13); border-color: #4EB8CC; }
    .stat-card:hover.green { box-shadow: 0 10px 28px rgba(5,150,105,0.13);  border-color: #34D399; }
    .stat-card:hover.amber { box-shadow: 0 10px 28px rgba(217,119,6,0.13);  border-color: #FBBF24; }
    .stat-card:hover.red   { box-shadow: 0 10px 28px rgba(220,38,38,0.13);  border-color: #F87171; }

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
       FILTER BAR
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
       VIEW TOGGLE
       ============================================ */
    .view-toggle {
        display: flex;
        gap: 4px;
        background: #F1F5F9;
        border-radius: 50px;
        padding: 3px;
    }
    .view-toggle button {
        width: 30px; height: 30px;
        border-radius: 50px;
        border: none;
        background: transparent;
        color: #94A3B8;
        font-size: 0.82rem;
        cursor: pointer;
        transition: all 0.2s;
        display: flex; align-items: center; justify-content: center;
    }
    .view-toggle button.active {
        background: #fff;
        color: #0E7A96;
        box-shadow: 0 2px 6px rgba(0,0,0,0.08);
    }

    /* ============================================
       TABLE VIEW
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

    /* design thumbnail */
    .design-thumb {
        width: 48px; height: 48px;
        border-radius: 10px;
        object-fit: cover;
        border: 2px solid #E2E8F0;
        transition: transform 0.25s, box-shadow 0.25s;
        cursor: zoom-in;
    }
    .design-thumb:hover {
        transform: scale(1.08);
        box-shadow: 0 6px 18px rgba(0,0,0,0.12);
        border-color: #0E7A96;
    }
    .no-thumb {
        width: 48px; height: 48px;
        border-radius: 10px;
        background: #F1F5F9;
        display: flex; align-items: center; justify-content: center;
        color: #CBD5E1;
        font-size: 1.1rem;
    }

    .edition-pill {
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
       GRID VIEW
       ============================================ */
    #gridView {
        display: none;
        padding: 20px;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 16px;
    }
    #gridView.active { display: grid; }
    #tableView.hidden { display: none; }

    .model-card {
        background: #fff;
        border: 1px solid #E2E8F0;
        border-radius: 16px;
        overflow: hidden;
        transition: all 0.28s cubic-bezier(0.22, 1, 0.36, 1);
        position: relative;
    }
    .model-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 30px rgba(0,0,0,0.1);
        border-color: #4EB8CC;
    }
    .model-card-img {
        width: 100%;
        aspect-ratio: 1;
        object-fit: cover;
        display: block;
        background: #F8FAFC;
    }
    .model-card-img-placeholder {
        width: 100%;
        aspect-ratio: 1;
        background: linear-gradient(135deg, #F1F5F9, #E2E8F0);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #CBD5E1;
        font-size: 2.5rem;
    }
    .model-card-body {
        padding: 12px 14px;
    }
    .model-card-name {
        font-size: 0.88rem;
        font-weight: 700;
        color: #0D1B2A;
        margin-bottom: 4px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .model-card-edition {
        font-size: 0.75rem;
        color: #0E7A96;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 4px;
        margin-bottom: 10px;
    }
    .model-card-actions {
        display: flex;
        gap: 6px;
    }
    .model-card-actions .btn-xs-act {
        flex: 1;
        width: auto;
        height: 30px;
        border-radius: 8px;
        font-size: 0.75rem;
        gap: 4px;
    }
    .model-card-actions .btn-xs-act span { font-size: 0.72rem; font-weight: 600; }

    /* ============================================
       IMAGE PREVIEW MODAL
       ============================================ */
    #imgPreviewModal .modal-content {
        background: transparent;
        border: none;
        box-shadow: none;
    }
    #imgPreviewModal .modal-body {
        padding: 0;
        text-align: center;
    }
    #imgPreviewModal img {
        max-width: 100%;
        border-radius: 16px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.5);
    }

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
    }

    /* file upload zone */
    .upload-zone {
        border: 2px dashed #E2E8F0;
        border-radius: 14px;
        padding: 22px 16px;
        text-align: center;
        cursor: pointer;
        transition: all 0.25s;
        position: relative;
        overflow: hidden;
    }
    .upload-zone:hover, .upload-zone.dragover {
        border-color: #0E7A96;
        background: #EEF9FC;
    }
    .upload-zone input[type="file"] {
        position: absolute;
        inset: 0;
        opacity: 0;
        cursor: pointer;
        width: 100%;
        height: 100%;
    }
    .upload-zone .uz-icon {
        font-size: 1.8rem;
        color: #CBD5E1;
        margin-bottom: 8px;
        transition: color 0.25s;
    }
    .upload-zone:hover .uz-icon { color: #0E7A96; }
    .upload-zone .uz-label {
        font-size: 0.82rem;
        color: #94A3B8;
        font-weight: 600;
    }
    .upload-zone .uz-sub {
        font-size: 0.72rem;
        color: #CBD5E1;
        margin-top: 4px;
    }
    .upload-preview {
        margin-top: 10px;
        display: none;
        align-items: center;
        gap: 10px;
        padding: 8px 12px;
        background: #EEF9FC;
        border-radius: 10px;
        font-size: 0.8rem;
        color: #0E7A96;
        font-weight: 600;
    }
    .upload-preview img {
        width: 40px; height: 40px;
        border-radius: 8px;
        object-fit: cover;
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

    /* no results */
    #noResults {
        display: none;
        text-align: center;
        padding: 40px 20px;
        color: #94A3B8;
        font-size: 0.85rem;
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
        <div class="col-6 col-lg-3">
            <div class="stat-card blue">
                <div class="stat-icon"><i class="fas fa-paint-brush"></i></div>
                <div>
                    <div class="stat-number"><?php echo e($models->count()); ?></div>
                    <div class="stat-label">Total Model</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="stat-card green">
                <div class="stat-icon"><i class="fas fa-image"></i></div>
                <div>
                    <div class="stat-number"><?php echo e($models->whereNotNull('design_image')->count()); ?></div>
                    <div class="stat-label">Punya Gambar</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="stat-card amber">
                <div class="stat-icon"><i class="fas fa-layer-group"></i></div>
                <div>
                    <div class="stat-number"><?php echo e($editions->count()); ?></div>
                    <div class="stat-label">Total Edisi</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="stat-card red">
                <div class="stat-icon"><i class="fas fa-exclamation-triangle"></i></div>
                <div>
                    <div class="stat-number"><?php echo e($models->whereNull('design_image')->count()); ?></div>
                    <div class="stat-label">Tanpa Gambar</div>
                </div>
            </div>
        </div>
    </div>

    
    <p class="sec-label anim-2">Daftar Model</p>
    <div class="dash-card anim-2">

        
        <div class="dash-card-header">
            <div class="dash-card-title">
                <i class="fas fa-paint-brush"></i> Model / Motif
            </div>
            <div style="display:flex; align-items:center; gap:10px;">
                <span class="count-badge">
                    <i class="fas fa-list"></i> <?php echo e($models->count()); ?> model
                </span>
                <div class="view-toggle">
                    <button id="btnTableView" class="active" title="Tampilan Tabel">
                        <i class="fas fa-th-list"></i>
                    </button>
                    <button id="btnGridView" title="Tampilan Grid">
                        <i class="fas fa-th"></i>
                    </button>
                </div>
            </div>
        </div>

        
        <div class="filter-bar">
            <div class="search-wrap">
                <i class="fas fa-search search-icon"></i>
                <input type="text" id="searchInput" placeholder="Cari nama model...">
            </div>
            <select class="filter-select" id="filterEdition">
                <option value="">Semua Edisi</option>
                <?php $__currentLoopData = $editions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($e->name); ?>"><?php echo e($e->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <select class="filter-select" id="filterImage">
                <option value="">Semua</option>
                <option value="1">Ada Gambar</option>
                <option value="0">Tanpa Gambar</option>
            </select>
        </div>

        
        <div id="tableView">
            <div class="table-responsive">
                <table class="dash-table" id="modelsTable">
                    <thead>
                        <tr>
                            <th style="width:50px;">#</th>
                            <th>Gambar</th>
                            <th>Nama Model</th>
                            <th>Edisi</th>
                            <th style="width:100px; text-align:center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $models; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr data-name="<?php echo e(strtolower($model->name)); ?>"
                                data-edition="<?php echo e($model->edition->name ?? ''); ?>"
                                data-hasimage="<?php echo e($model->design_image ? '1' : '0'); ?>">
                                <td><span class="row-num"><?php echo e($loop->iteration); ?></span></td>
                                <td>
                                    <?php if($model->design_image): ?>
                                        <img src="<?php echo e(asset('storage/'.$model->design_image)); ?>"
                                             class="design-thumb preview-trigger"
                                             data-src="<?php echo e(asset('storage/'.$model->design_image)); ?>"
                                             data-name="<?php echo e($model->name); ?>"
                                             alt="<?php echo e($model->name); ?>">
                                    <?php else: ?>
                                        <div class="no-thumb"><i class="fas fa-image"></i></div>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div style="font-weight:700; font-size:0.88rem;"><?php echo e($model->name); ?></div>
                                    <div class="td-muted">ID #<?php echo e($model->id); ?></div>
                                </td>
                                <td>
                                    <span class="edition-pill">
                                        <i class="fas fa-layer-group" style="font-size:0.72rem;"></i>
                                        <?php echo e($model->edition->name ?? 'N/A'); ?>

                                    </span>
                                </td>
                                <td style="text-align:center; white-space:nowrap;">
                                    <button class="btn-xs-act edit edit-btn"
                                            title="Edit"
                                            data-id="<?php echo e($model->id); ?>"
                                            data-edition="<?php echo e($model->edition_id); ?>"
                                            data-name="<?php echo e($model->name); ?>"
                                            data-toggle="modal" data-target="#editModal">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="<?php echo e(route('apparel.models.destroy', $model)); ?>"
                                          method="POST" class="d-inline">
                                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn-xs-act danger" title="Hapus"
                                                onclick="return confirm('Hapus model \'<?php echo e($model->name); ?>\'?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr class="empty-row">
                                <td colspan="5">
                                    <i class="fas fa-paint-brush empty-icon-sm"></i>
                                    Belum ada model / motif kaos
                                    <div style="margin-top:10px;">
                                        <button data-toggle="modal" data-target="#addModal"
                                            style="display:inline-flex; align-items:center; gap:6px; background:#EEF9FC; color:#0E7A96; padding:8px 18px; border-radius:50px; font-size:0.8rem; font-weight:700; border:none; cursor:pointer;">
                                            <i class="fas fa-plus"></i> Tambah Model Pertama
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div id="noResults">
                <i class="fas fa-search" style="font-size:2rem; display:block; margin-bottom:10px; opacity:0.3;"></i>
                Tidak ada hasil yang cocok
            </div>
        </div>

        
        <div id="gridView">
            <?php $__empty_1 = true; $__currentLoopData = $models; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="model-card"
                     data-name="<?php echo e(strtolower($model->name)); ?>"
                     data-edition="<?php echo e($model->edition->name ?? ''); ?>"
                     data-hasimage="<?php echo e($model->design_image ? '1' : '0'); ?>">
                    <?php if($model->design_image): ?>
                        <img src="<?php echo e(asset('storage/'.$model->design_image)); ?>"
                             class="model-card-img preview-trigger"
                             data-src="<?php echo e(asset('storage/'.$model->design_image)); ?>"
                             data-name="<?php echo e($model->name); ?>"
                             alt="<?php echo e($model->name); ?>">
                    <?php else: ?>
                        <div class="model-card-img-placeholder">
                            <i class="fas fa-image"></i>
                        </div>
                    <?php endif; ?>
                    <div class="model-card-body">
                        <div class="model-card-name" title="<?php echo e($model->name); ?>"><?php echo e($model->name); ?></div>
                        <div class="model-card-edition">
                            <i class="fas fa-layer-group"></i>
                            <?php echo e($model->edition->name ?? 'N/A'); ?>

                        </div>
                        <div class="model-card-actions">
                            <button class="btn-xs-act edit edit-btn"
                                    data-id="<?php echo e($model->id); ?>"
                                    data-edition="<?php echo e($model->edition_id); ?>"
                                    data-name="<?php echo e($model->name); ?>"
                                    data-toggle="modal" data-target="#editModal">
                                <i class="fas fa-edit"></i> <span>Edit</span>
                            </button>
                            <form action="<?php echo e(route('apparel.models.destroy', $model)); ?>"
                                  method="POST" style="flex:1;">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn-xs-act danger"
                                        style="width:100%;"
                                        onclick="return confirm('Hapus model \'<?php echo e($model->name); ?>\'?')">
                                    <i class="fas fa-trash"></i> <span>Hapus</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div style="grid-column:1/-1; text-align:center; padding:48px 20px; color:#94A3B8;">
                    <i class="fas fa-paint-brush" style="font-size:2.5rem; display:block; margin-bottom:10px; opacity:0.3;"></i>
                    Belum ada model / motif kaos
                </div>
            <?php endif; ?>
        </div>

    </div>


    
    <div class="modal fade" id="addModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <form action="<?php echo e(route('apparel.models.store')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title-custom">
                            <i class="fas fa-plus-circle"></i> Tambah Model Baru
                        </div>
                        <button type="button" class="close" data-dismiss="modal"
                                style="color:#fff; opacity:0.7; font-size:1.2rem; background:none; border:none; cursor:pointer;">
                            &times;
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-form-group">
                            <label><i class="fas fa-layer-group me-1"></i> Edisi <span style="color:#DC2626;">*</span></label>
                            <select name="edition_id" class="form-control" required>
                                <option value="">— Pilih Edisi —</option>
                                <?php $__currentLoopData = $editions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($e->id); ?>"><?php echo e($e->name); ?> (<?php echo e($e->product->name ?? ''); ?>)</option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="modal-form-group">
                            <label><i class="fas fa-tag me-1"></i> Nama Model <span style="color:#DC2626;">*</span></label>
                            <input type="text" name="name" class="form-control"
                                   placeholder="contoh: Motif Batik Parang" required>
                        </div>
                        <div class="modal-form-group" style="margin-bottom:0;">
                            <label><i class="fas fa-image me-1"></i> Gambar Desain</label>
                            <div class="upload-zone" id="addUploadZone">
                                <input type="file" name="design_image"
                                       accept="image/*" id="addFileInput">
                                <div class="uz-icon"><i class="fas fa-cloud-upload-alt"></i></div>
                                <div class="uz-label">Klik atau drag gambar ke sini</div>
                                <div class="uz-sub">PNG, JPG, WEBP — Maks. 2MB</div>
                            </div>
                            <div class="upload-preview" id="addPreview">
                                <img id="addPreviewImg" src="" alt="">
                                <span id="addPreviewName"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="justify-content:flex-end; gap:10px;">
                        <button type="button" class="btn-modal-cancel" data-dismiss="modal">
                            <i class="fas fa-times"></i> Batal
                        </button>
                        <button type="submit" class="btn-modal-primary">
                            <i class="fas fa-save"></i> Simpan Model
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    
    <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <form id="editForm" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title-custom">
                            <i class="fas fa-edit"></i> Edit Model
                            <span id="editModalTitle" style="opacity:0.65; font-weight:600;"></span>
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
                            <label><i class="fas fa-layer-group me-1"></i> Edisi <span style="color:#DC2626;">*</span></label>
                            <select name="edition_id" id="editEdition" class="form-control" required>
                                <?php $__currentLoopData = $editions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($e->id); ?>"><?php echo e($e->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="modal-form-group">
                            <label><i class="fas fa-tag me-1"></i> Nama Model <span style="color:#DC2626;">*</span></label>
                            <input type="text" name="name" id="editName" class="form-control"
                                   placeholder="Nama model" required>
                        </div>
                        <div class="modal-form-group" style="margin-bottom:0;">
                            <label><i class="fas fa-image me-1"></i> Ganti Gambar <span style="color:#94A3B8; font-weight:500;">(kosongkan jika tidak diganti)</span></label>
                            <div class="upload-zone" id="editUploadZone">
                                <input type="file" name="design_image"
                                       accept="image/*" id="editFileInput">
                                <div class="uz-icon"><i class="fas fa-cloud-upload-alt"></i></div>
                                <div class="uz-label">Klik atau drag gambar baru</div>
                                <div class="uz-sub">PNG, JPG, WEBP — Maks. 2MB</div>
                            </div>
                            <div class="upload-preview" id="editPreview">
                                <img id="editPreviewImg" src="" alt="">
                                <span id="editPreviewName"></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" style="justify-content:flex-end; gap:10px;">
                        <button type="button" class="btn-modal-cancel" data-dismiss="modal">
                            <i class="fas fa-times"></i> Batal
                        </button>
                        <button type="submit" class="btn-modal-primary"
                                style="background: linear-gradient(135deg, #D97706, #FBBF24);">
                            <i class="fas fa-save"></i> Update Model
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    
    <div class="modal fade" id="imgPreviewModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content" style="background:transparent; border:none; box-shadow:none;">
                <div class="modal-body" style="padding:0; text-align:center;">
                    <img id="previewModalImg" src="" alt="" style="max-width:100%; border-radius:16px; box-shadow: 0 20px 60px rgba(0,0,0,0.5);">
                    <div id="previewModalName" style="color:#fff; margin-top:12px; font-weight:700; font-size:0.9rem; opacity:0.85;"></div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script>
    /* ── Edit Modal ── */
    $(document).on('click', '.edit-btn', function () {
        var id   = $(this).data('id');
        var name = $(this).data('name');
        $('#editEdition').val($(this).data('edition'));
        $('#editName').val(name);
        $('#editForm').attr('action', '/apparel/models/' + id);
        $('#editModalTitle').text('— ' + name);
        $('#editIdDisplay').text('#' + id);
        /* reset preview */
        $('#editPreview').hide();
        $('#editPreviewImg').attr('src', '');
        $('#editPreviewName').text('');
    });

    /* ── File upload preview (add) ── */
    $('#addFileInput').on('change', function () {
        previewFile(this, '#addPreviewImg', '#addPreviewName', '#addPreview');
    });
    /* ── File upload preview (edit) ── */
    $('#editFileInput').on('change', function () {
        previewFile(this, '#editPreviewImg', '#editPreviewName', '#editPreview');
    });

    function previewFile(input, imgSel, nameSel, wrapSel) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $(imgSel).attr('src', e.target.result);
                $(nameSel).text(input.files[0].name);
                $(wrapSel).css('display', 'flex');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    /* ── Drag-over highlight ── */
    ['addUploadZone', 'editUploadZone'].forEach(function (id) {
        var el = document.getElementById(id);
        if (!el) return;
        el.addEventListener('dragover', function (e) { e.preventDefault(); this.classList.add('dragover'); });
        el.addEventListener('dragleave', function ()  { this.classList.remove('dragover'); });
        el.addEventListener('drop',      function ()  { this.classList.remove('dragover'); });
    });

    /* ── Image preview modal ── */
    $(document).on('click', '.preview-trigger', function () {
        $('#previewModalImg').attr('src', $(this).data('src'));
        $('#previewModalName').text($(this).data('name'));
        $('#imgPreviewModal').modal('show');
    });

    /* ── View toggle (table ↔ grid) ── */
    $('#btnTableView').on('click', function () {
        $(this).addClass('active');
        $('#btnGridView').removeClass('active');
        $('#tableView').removeClass('hidden');
        $('#gridView').removeClass('active');
        localStorage.setItem('modelView', 'table');
    });
    $('#btnGridView').on('click', function () {
        $(this).addClass('active');
        $('#btnTableView').removeClass('active');
        $('#tableView').addClass('hidden');
        $('#gridView').addClass('active');
        localStorage.setItem('modelView', 'grid');
    });
    /* restore last view */
    if (localStorage.getItem('modelView') === 'grid') {
        $('#btnGridView').trigger('click');
    }

    /* ── Live filter ── */
    function filterModels() {
        var q       = $('#searchInput').val().toLowerCase();
        var edition = $('#filterEdition').val().toLowerCase();
        var hasImg  = $('#filterImage').val();

        /* table rows */
        var rows = $('#modelsTable tbody tr:not(.empty-row)');
        var vis  = 0;
        rows.each(function () {
            var $r = $(this);
            var show = true;
            if (q       && ($r.data('name') || '').indexOf(q) === -1)                   show = false;
            if (edition && ($r.data('edition') || '').toLowerCase().indexOf(edition) === -1) show = false;
            if (hasImg !== '' && String($r.data('hasimage')) !== hasImg)                 show = false;
            $r.toggle(show);
            if (show) vis++;
        });
        $('#noResults').toggle(vis === 0 && rows.length > 0);

        /* grid cards */
        $('#gridView .model-card').each(function () {
            var $c = $(this);
            var show = true;
            if (q       && ($c.data('name') || '').indexOf(q) === -1)                   show = false;
            if (edition && ($c.data('edition') || '').toLowerCase().indexOf(edition) === -1) show = false;
            if (hasImg !== '' && String($c.data('hasimage')) !== hasImg)                 show = false;
            $c.toggle(show);
        });
    }

    $('#searchInput').on('input', filterModels);
    $('#filterEdition, #filterImage').on('change', filterModels);
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\qofmedia-web\resources\views/apparel/models/index.blade.php ENDPATH**/ ?>