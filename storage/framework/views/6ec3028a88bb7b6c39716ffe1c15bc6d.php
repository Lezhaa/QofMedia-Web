

<?php $__env->startSection('title', 'Produk Apparel'); ?>

<?php $__env->startSection('content_header'); ?>
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="mb-0" style="font-size: 1.4rem; font-weight: 700; color: #0D1B2A;">
                <i class="fas fa-tshirt me-2" style="color: #0E7A96;"></i> Produk Apparel
            </h1>
            <ol class="breadcrumb mb-0 mt-1" style="font-size: 0.8rem; background: transparent; padding: 0;">
                <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
                <li class="breadcrumb-item active">Produk Apparel</li>
            </ol>
        </div>
        <a href="<?php echo e(route('apparel.products.create')); ?>"
           style="display:inline-flex; align-items:center; gap:7px; background:#0E7A96; color:#fff; padding:10px 22px; border-radius:50px; font-weight:700; font-size:0.88rem; text-decoration:none; border:none; transition:all 0.3s;">
            <i class="fas fa-plus"></i> Tambah Produk
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
    .products-card {
        background: #fff;
        border: 1px solid #E2E8F0;
        border-radius: 20px;
        overflow: hidden;
    }

    /* ============================================
       TABLE
       ============================================ */
    .products-table { width: 100%; border-collapse: collapse; }

    .products-table thead th {
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

    .products-table tbody tr {
        border-bottom: 1px solid #F8FAFC;
        transition: background 0.15s;
    }
    .products-table tbody tr:last-child { border-bottom: none; }
    .products-table tbody tr:hover { background: #FAFCFE; }

    .products-table tbody td {
        padding: 14px 20px;
        vertical-align: middle;
        font-size: 0.88rem;
        color: #0D1B2A;
    }

    /* Thumbnail */
    .prod-thumb {
        width: 52px; height: 52px;
        border-radius: 10px;
        object-fit: cover;
        display: block;
        border: 1px solid #E2E8F0;
    }
    .prod-thumb-placeholder {
        width: 52px; height: 52px;
        border-radius: 10px;
        background: linear-gradient(135deg, #EEF9FC, #D6EEF5);
        display: flex; align-items: center; justify-content: center;
        color: #0E7A96; font-size: 1.2rem; opacity: 0.5;
        border: 1px solid #E2E8F0;
        flex-shrink: 0;
    }

    /* Product name */
    .prod-name {
        font-weight: 700;
        color: #0D1B2A;
        font-size: 0.9rem;
        line-height: 1.4;
    }

    /* Category badge */
    .badge-cat {
        display: inline-block;
        padding: 4px 12px;
        background: rgba(14,122,150,0.08);
        color: #0E7A96;
        border-radius: 50px;
        font-size: 0.72rem;
        font-weight: 700;
        white-space: nowrap;
    }

    /* Type badge */
    .badge-type {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 50px;
        font-size: 0.72rem;
        font-weight: 700;
        white-space: nowrap;
        background: rgba(100,116,139,0.09);
        color: #64748B;
    }
    .badge-type.kaos { background: rgba(14,122,150,0.09); color: #0E7A96; }

    /* Price */
    .prod-price {
        font-weight: 700;
        color: #0D1B2A;
        font-size: 0.88rem;
        white-space: nowrap;
    }

    /* Stock */
    .prod-stock {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 0.82rem;
        font-weight: 600;
        white-space: nowrap;
    }
    .prod-stock.low  { color: #DC2626; }
    .prod-stock.ok   { color: #059669; }
    .prod-stock.zero { color: #94A3B8; }

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
            <i class="fas fa-tshirt"></i>
            Total Produk: <strong><?php echo e(isset($products) ? $products->total() : 0); ?></strong>
        </div>
        <div class="stat-chip">
            <i class="fas fa-box-open"></i>
            Halaman ini: <strong><?php echo e(isset($products) ? $products->count() : 0); ?></strong>
        </div>
    </div>

    
    <div class="filter-bar">
        <i class="fas fa-search" style="color:#CBD5E1; font-size:0.9rem; flex-shrink:0;"></i>
        <input type="text" id="searchInput" placeholder="Cari nama produk..." oninput="filterRows()">
        <select id="catFilter" onchange="filterRows()">
            <option value="">Semua Kategori</option>
            <?php $__currentLoopData = ($products ?? collect())->pluck('category.name')->filter()->unique()->sort(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e(strtolower($cat)); ?>"><?php echo e($cat); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <select id="typeFilter" onchange="filterRows()">
            <option value="">Semua Tipe</option>
            <?php $__currentLoopData = ($products ?? collect())->pluck('type')->filter()->unique()->sort(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e(strtolower($type)); ?>"><?php echo e(ucfirst($type)); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    
    <div class="products-card">
        <?php if(($products ?? collect())->isEmpty()): ?>
            <div class="empty-state">
                <div class="empty-icon-wrap"><i class="fas fa-tshirt"></i></div>
                <h5>Belum Ada Produk</h5>
                <p>Mulai tambahkan produk apparel pertama Anda.</p>
                <a href="<?php echo e(route('apparel.products.create')); ?>"
                   style="display:inline-flex; align-items:center; gap:6px; background:#0E7A96; color:#fff; padding:10px 24px; border-radius:50px; font-weight:700; font-size:0.88rem; text-decoration:none;">
                    <i class="fas fa-plus"></i> Tambah Produk
                </a>
            </div>
        <?php else: ?>
            <div style="overflow-x: auto;">
                <table class="products-table" id="productsTable">
                    <thead>
                        <tr>
                            <th style="width:40px;">#</th>
                            <th style="width:60px;"></th>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Tipe</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th style="width:90px; text-align:center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="prod-row"
                                data-name="<?php echo e(strtolower($product->name)); ?>"
                                data-cat="<?php echo e(strtolower($product->category->name ?? '')); ?>"
                                data-type="<?php echo e(strtolower($product->type)); ?>">
                                <td style="color:#CBD5E1; font-size:0.8rem; font-weight:600;">
                                    <?php echo e($loop->iteration + ($products->currentPage() - 1) * $products->perPage()); ?>

                                </td>
                                <td>
                                    <?php if($product->image): ?>
                                        <img src="<?php echo e(asset('storage/' . $product->image)); ?>"
                                             class="prod-thumb" alt="<?php echo e($product->name); ?>">
                                    <?php else: ?>
                                        <div class="prod-thumb-placeholder">
                                            <i class="fas fa-tshirt"></i>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="prod-name"><?php echo e($product->name); ?></div>
                                </td>
                                <td>
                                    <span class="badge-cat"><?php echo e($product->category->name ?? 'N/A'); ?></span>
                                </td>
                                <td>
                                    <span class="badge-type <?php echo e(strtolower($product->type) == 'kaos' ? 'kaos' : ''); ?>">
                                        <?php echo e(ucfirst($product->type)); ?>

                                    </span>
                                </td>
                                <td>
                                    <span class="prod-price">Rp <?php echo e(number_format($product->price, 0, ',', '.')); ?></span>
                                </td>
                                <td>
                                    <?php
                                        $stockClass = $product->stock == 0 ? 'zero' : ($product->stock <= 5 ? 'low' : 'ok');
                                        $stockIcon  = $product->stock == 0 ? 'fa-times-circle' : ($product->stock <= 5 ? 'fa-exclamation-circle' : 'fa-check-circle');
                                    ?>
                                    <span class="prod-stock <?php echo e($stockClass); ?>">
                                        <i class="fas <?php echo e($stockIcon); ?>"></i>
                                        <?php echo e($product->stock); ?>

                                    </span>
                                </td>
                                <td>
                                    <div style="display:flex; align-items:center; justify-content:center; gap:6px;">
                                        <a href="<?php echo e(route('apparel.products.edit', $product)); ?>"
                                           class="act-btn edit" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="<?php echo e(route('apparel.products.destroy', $product)); ?>"
                                              method="POST" style="margin:0;">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="act-btn delete" title="Hapus"
                                                    onclick="return confirm('Yakin ingin menghapus produk \'<?php echo e(addslashes($product->name)); ?>\'?')">
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

            <?php if(isset($products) && $products->hasPages()): ?>
                <div class="card-foot">
                    <?php echo e($products->links()); ?>

                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script>
function filterRows() {
    var search = document.getElementById('searchInput').value.toLowerCase();
    var cat    = document.getElementById('catFilter').value.toLowerCase();
    var type   = document.getElementById('typeFilter').value.toLowerCase();
    document.querySelectorAll('.prod-row').forEach(function (row) {
        var matchName = row.dataset.name.includes(search);
        var matchCat  = !cat  || row.dataset.cat  === cat;
        var matchType = !type || row.dataset.type === type;
        row.style.display = matchName && matchCat && matchType ? '' : 'none';
    });
}
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\qofmedia-web\resources\views/apparel/products/index.blade.php ENDPATH**/ ?>