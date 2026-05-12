

<?php $__env->startSection('title', 'Manajemen Galeri'); ?>

<?php $__env->startSection('content_header'); ?>
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="mb-0" style="font-size: 1.4rem; font-weight: 700; color: #0D1B2A;">
                <i class="fas fa-images me-2" style="color: #0E7A96;"></i> Manajemen Galeri
            </h1>
            <ol class="breadcrumb mb-0 mt-1" style="font-size: 0.8rem; background: transparent; padding: 0;">
                <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
                <li class="breadcrumb-item active">Galeri</li>
            </ol>
        </div>
        <a href="<?php echo e(route('admin.albums.create')); ?>"
           style="display:inline-flex; align-items:center; gap:7px; background:#0E7A96; color:#fff; padding:10px 22px; border-radius:50px; font-weight:700; font-size:0.88rem; text-decoration:none; border:none; transition:all 0.3s;">
            <i class="fas fa-plus"></i> Tambah Album
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
    .albums-card {
        background: #fff;
        border: 1px solid #E2E8F0;
        border-radius: 20px;
        overflow: hidden;
    }

    /* ============================================
       TABLE
       ============================================ */
    .albums-table { width: 100%; border-collapse: collapse; }

    .albums-table thead th {
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

    .albums-table tbody tr {
        border-bottom: 1px solid #F8FAFC;
        transition: background 0.15s;
    }
    .albums-table tbody tr:last-child { border-bottom: none; }
    .albums-table tbody tr:hover { background: #FAFCFE; }

    .albums-table tbody td {
        padding: 14px 20px;
        vertical-align: middle;
        font-size: 0.88rem;
        color: #0D1B2A;
    }

    /* Thumbnail */
    .alb-thumb {
        width: 52px; height: 52px;
        border-radius: 10px;
        object-fit: cover;
        display: block;
        border: 1px solid #E2E8F0;
    }
    .alb-thumb-placeholder {
        width: 52px; height: 52px;
        border-radius: 10px;
        background: linear-gradient(135deg, #EEF9FC, #D6EEF5);
        display: flex; align-items: center; justify-content: center;
        color: #0E7A96; font-size: 1.2rem; opacity: 0.5;
        border: 1px solid #E2E8F0;
        flex-shrink: 0;
    }

    /* Name cell */
    .alb-name {
        font-weight: 700;
        color: #0D1B2A;
        font-size: 0.9rem;
        margin-bottom: 3px;
        line-height: 1.4;
    }
    .alb-slug {
        font-size: 0.76rem;
        color: #94A3B8;
        line-height: 1.5;
    }

    /* Year badge */
    .badge-year {
        display: inline-block;
        padding: 4px 12px;
        background: rgba(14,122,150,0.08);
        color: #0E7A96;
        border-radius: 50px;
        font-size: 0.72rem;
        font-weight: 700;
        white-space: nowrap;
    }

    /* Items count badge */
    .badge-items {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: rgba(14,122,150,0.06);
        color: #0E7A96;
        border-radius: 8px;
        padding: 5px 12px;
        font-size: 0.78rem;
        font-weight: 700;
        white-space: nowrap;
    }

    /* Description */
    .alb-desc {
        font-size: 0.82rem;
        color: #64748B;
        max-width: 200px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Action buttons */
    .act-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        height: 32px;
        border-radius: 8px;
        border: none;
        font-size: 0.8rem;
        text-decoration: none;
        transition: all 0.2s;
        cursor: pointer;
        white-space: nowrap;
        padding: 0 10px;
        gap: 5px;
        font-weight: 600;
    }
    .act-btn.items  { background: rgba(14,122,150,0.09);  color: #0E7A96; }
    .act-btn.edit   { background: rgba(217,119,6,0.09);   color: #D97706; width: 32px; padding: 0; justify-content: center; }
    .act-btn.view   { background: rgba(5,150,105,0.09);   color: #059669; width: 32px; padding: 0; justify-content: center; }
    .act-btn.delete { background: rgba(220,38,38,0.09);   color: #DC2626; width: 32px; padding: 0; justify-content: center; }
    .act-btn:hover  { filter: brightness(0.88); transform: scale(1.06); text-decoration: none; }

    /* ============================================
       EMPTY STATE
       ============================================ */
    .empty-state {
        text-align: center;
        padding: 70px 20px;
    }
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
       PAGINATION FIX
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

    /* Footer pagination wrapper */
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
            <i class="fas fa-images"></i>
            Total Album: <strong><?php echo e($albums->total()); ?></strong>
        </div>
        <div class="stat-chip">
            <i class="fas fa-layer-group"></i>
            Halaman ini: <strong><?php echo e($albums->count()); ?></strong>
        </div>
    </div>

    
    <div class="filter-bar">
        <i class="fas fa-search" style="color:#CBD5E1; font-size:0.9rem; flex-shrink:0;"></i>
        <input type="text" id="searchInput" placeholder="Cari nama album..." oninput="filterRows()">
        <select id="yearFilter" onchange="filterRows()">
            <option value="">Semua Tahun</option>
            <?php $__currentLoopData = $albums->pluck('year')->unique()->sortDesc(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($year); ?>"><?php echo e($year); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    
    <div class="albums-card">
        <?php if($albums->isEmpty()): ?>
            <div class="empty-state">
                <div class="empty-icon-wrap"><i class="fas fa-images"></i></div>
                <h5>Belum Ada Album</h5>
                <p>Mulai tambahkan album galeri pertama Anda.</p>
                <a href="<?php echo e(route('admin.albums.create')); ?>"
                   style="display:inline-flex; align-items:center; gap:6px; background:#0E7A96; color:#fff; padding:10px 24px; border-radius:50px; font-weight:700; font-size:0.88rem; text-decoration:none;">
                    <i class="fas fa-plus"></i> Tambah Album
                </a>
            </div>
        <?php else: ?>
            <div style="overflow-x: auto;">
                <table class="albums-table" id="albumsTable">
                    <thead>
                        <tr>
                            <th style="width:40px;">#</th>
                            <th style="width:60px;"></th>
                            <th>Nama Album</th>
                            <th>Tahun</th>
                            <th>Deskripsi</th>
                            <th>Total Item</th>
                            <th style="width:160px; text-align:center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $albums; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $album): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="alb-row"
                                data-name="<?php echo e(strtolower($album->name)); ?>"
                                data-year="<?php echo e($album->year); ?>">
                                <td style="color:#CBD5E1; font-size:0.8rem; font-weight:600;">
                                    <?php echo e($loop->iteration + ($albums->currentPage() - 1) * $albums->perPage()); ?>

                                </td>
                                <td>
                                    <?php if($album->cover_image ?? false): ?>
                                        <img src="<?php echo e(asset('storage/' . $album->cover_image)); ?>"
                                             class="alb-thumb" alt="<?php echo e($album->name); ?>">
                                    <?php else: ?>
                                        <div class="alb-thumb-placeholder">
                                            <i class="fas fa-images"></i>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td style="max-width: 220px;">
                                    <div class="alb-name"><?php echo e($album->name); ?></div>
                                    <div class="alb-slug"><?php echo e($album->slug); ?></div>
                                </td>
                                <td>
                                    <span class="badge-year"><?php echo e($album->year); ?></span>
                                </td>
                                <td style="max-width: 200px;">
                                    <div class="alb-desc">
                                        <?php echo e($album->description ?: '—'); ?>

                                    </div>
                                </td>
                                <td>
                                    <span class="badge-items">
                                        <i class="fas fa-th-large"></i> <?php echo e($album->items_count ?? 0); ?> item
                                    </span>
                                </td>
                                <td>
                                    <div style="display:flex; align-items:center; justify-content:center; gap:6px; flex-wrap: nowrap;">
                                        <a href="<?php echo e(route('admin.albums.items.index', $album)); ?>"
                                           class="act-btn items" title="Kelola Item">
                                            <i class="fas fa-th-large"></i> Item
                                        </a>
                                        <a href="<?php echo e(route('admin.albums.edit', $album)); ?>"
                                           class="act-btn edit" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="<?php echo e(route('gallery.album', ['year' => $album->year, 'slug' => $album->slug])); ?>"
                                           target="_blank"
                                           class="act-btn view" title="Lihat">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <form action="<?php echo e(route('admin.albums.destroy', $album)); ?>"
                                              method="POST" style="margin:0;">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="act-btn delete" title="Hapus"
                                                    onclick="return confirm('Yakin ingin menghapus album \'<?php echo e(addslashes($album->name)); ?>\'?\nSemua item di dalamnya juga akan dihapus.')">
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

            <?php if($albums->hasPages()): ?>
                <div class="card-foot">
                    <?php echo e($albums->links()); ?>

                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script>
function filterRows() {
    var search = document.getElementById('searchInput').value.toLowerCase();
    var year   = document.getElementById('yearFilter').value;
    document.querySelectorAll('.alb-row').forEach(function (row) {
        var matchName = row.dataset.name.includes(search);
        var matchYear = !year || row.dataset.year === year;
        row.style.display = matchName && matchYear ? '' : 'none';
    });
}
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\qofmedia-web\resources\views/admin/gallery/albums/index.blade.php ENDPATH**/ ?>