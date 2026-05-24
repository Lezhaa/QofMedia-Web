<?php $__env->startSection('title', 'Kelola Order'); ?>

<?php $__env->startSection('content_header'); ?>
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="mb-0" style="font-size: 1.4rem; font-weight: 700; color: #0D1B2A;">
                <i class="fas fa-shopping-cart me-2" style="color: #0E7A96;"></i> Kelola Order
            </h1>
            <ol class="breadcrumb mb-0 mt-1" style="font-size: 0.8rem; background: transparent; padding: 0;">
                <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
                <li class="breadcrumb-item active">Order</li>
            </ol>
        </div>
        <a href="<?php echo e(route('home')); ?>" target="_blank"
           style="display:inline-flex; align-items:center; gap:7px; background:#F8FAFC; color:#64748B; padding:10px 22px; border-radius:50px; font-weight:700; font-size:0.88rem; text-decoration:none; border:1.5px solid #E2E8F0; transition:all 0.3s;">
            <i class="fas fa-globe"></i> Lihat Website
        </a>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<style>
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
       FILTER BAR (status tabs)
       ============================================ */
    .filter-bar {
        background: #fff;
        border: 1px solid #E2E8F0;
        border-radius: 14px;
        padding: 14px 20px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }
    .filter-label {
        font-size: 0.78rem;
        font-weight: 700;
        color: #94A3B8;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        margin-right: 4px;
        flex-shrink: 0;
    }
    .status-tab {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 16px;
        border-radius: 50px;
        font-size: 0.82rem;
        font-weight: 700;
        text-decoration: none;
        border: 1.5px solid #E2E8F0;
        background: #F8FAFC;
        color: #64748B;
        transition: all 0.2s;
        white-space: nowrap;
    }
    .status-tab:hover { text-decoration: none; border-color: #CBD5E1; color: #0D1B2A; background: #fff; }

    .status-tab.all.active     { background: #0E7A96; border-color: #0E7A96; color: #fff; }
    .status-tab.menunggu.active  { background: rgba(217,119,6,0.1);  border-color: #D97706; color: #D97706; }
    .status-tab.disetujui.active { background: rgba(5,150,105,0.1);  border-color: #059669; color: #059669; }
    .status-tab.ditolak.active   { background: rgba(220,38,38,0.1);  border-color: #DC2626; color: #DC2626; }

    .status-tab .tab-dot {
        width: 7px; height: 7px;
        border-radius: 50%;
        flex-shrink: 0;
    }
    .status-tab.menunggu  .tab-dot { background: #D97706; }
    .status-tab.disetujui .tab-dot { background: #059669; }
    .status-tab.ditolak   .tab-dot { background: #DC2626; }

    /* Search input inside filter bar */
    .filter-bar input {
        border: 1.5px solid #E2E8F0;
        border-radius: 8px;
        padding: 8px 14px;
        font-size: 0.85rem;
        outline: none;
        color: #0D1B2A;
        background: #F8FAFC;
        transition: border-color 0.2s;
        flex: 1;
        min-width: 180px;
    }
    .filter-bar input:focus { border-color: #0E7A96; background: #fff; }

    /* ============================================
       MAIN CARD
       ============================================ */
    .orders-card {
        background: #fff;
        border: 1px solid #E2E8F0;
        border-radius: 20px;
        overflow: hidden;
    }

    /* ============================================
       TABLE
       ============================================ */
    .orders-table { width: 100%; border-collapse: collapse; }

    .orders-table thead th {
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

    .orders-table tbody tr {
        border-bottom: 1px solid #F8FAFC;
        transition: background 0.15s;
    }
    .orders-table tbody tr:last-child { border-bottom: none; }
    .orders-table tbody tr:hover { background: #FAFCFE; }

    .orders-table tbody td {
        padding: 14px 20px;
        vertical-align: middle;
        font-size: 0.88rem;
        color: #0D1B2A;
    }

    /* Order ID */
    .order-id {
        font-size: 0.78rem;
        font-weight: 700;
        color: #94A3B8;
        font-family: monospace;
        letter-spacing: 0.03em;
    }

    /* Pemesan */
    .ord-name  { font-weight: 700; color: #0D1B2A; font-size: 0.88rem; margin-bottom: 2px; }
    .ord-phone { font-size: 0.76rem; color: #94A3B8; display: flex; align-items: center; gap: 4px; }
    .ord-phone i { font-size: 0.68rem; }

    /* Product cell */
    .ord-product { font-weight: 600; color: #0D1B2A; font-size: 0.87rem; }

    /* Qty badge */
    .badge-qty {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 28px; height: 28px;
        border-radius: 8px;
        background: rgba(14,122,150,0.08);
        color: #0E7A96;
        font-size: 0.8rem;
        font-weight: 700;
        padding: 0 8px;
    }

    /* Total */
    .ord-total { font-weight: 700; color: #0D1B2A; font-size: 0.88rem; white-space: nowrap; }

    /* Status badge */
    .badge-status {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        border-radius: 50px;
        padding: 4px 12px;
        font-size: 0.72rem;
        font-weight: 700;
        white-space: nowrap;
    }
    .badge-status .dot { width: 6px; height: 6px; border-radius: 50%; }
    .badge-status.menunggu  { background: rgba(217,119,6,0.09);  color: #D97706; }
    .badge-status.menunggu  .dot { background: #D97706; }
    .badge-status.disetujui { background: rgba(5,150,105,0.09);  color: #059669; }
    .badge-status.disetujui .dot { background: #059669; }
    .badge-status.ditolak   { background: rgba(220,38,38,0.09);  color: #DC2626; }
    .badge-status.ditolak   .dot { background: #DC2626; }
    .badge-status.default   { background: rgba(100,116,139,0.09); color: #64748B; }
    .badge-status.default   .dot { background: #94A3B8; }

    /* Date */
    .ord-date {
        font-size: 0.82rem;
        color: #64748B;
        white-space: nowrap;
        display: flex;
        align-items: center;
        gap: 5px;
    }
    .ord-date i { color: #CBD5E1; font-size: 0.75rem; }

    /* Action buttons */
    .action-group {
        display: flex;
        gap: 8px;
        align-items: center;
        justify-content: center;
    }
    .act-btn {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        height: 32px;
        border-radius: 8px;
        border: none;
        font-size: 0.8rem;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.2s;
        cursor: pointer;
        padding: 0 12px;
    }
    .act-btn.detail { background: rgba(14,122,150,0.09); color: #0E7A96; }
    .act-btn.delete { background: rgba(220,38,38,0.09); color: #DC2626; }
    .act-btn:hover  { filter: brightness(0.88); transform: scale(1.05); text-decoration: none; }

    /* Modal Delete */
    .modal-danger .modal-header {
        background: linear-gradient(135deg, #DC2626, #EF4444);
        color: white;
        border-bottom: none;
    }
    .modal-danger .modal-header .close {
        color: white;
        opacity: 0.8;
    }
    .modal-danger .modal-header .close:hover { opacity: 1; }
    .modal-danger .modal-footer .btn-danger {
        background: #DC2626;
        border: none;
    }
    .modal-danger .modal-footer .btn-danger:hover {
        background: #B91C1C;
    }

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
    .empty-state p  { color: #94A3B8; font-size: 0.88rem; }

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

    
    <?php
        $total     = isset($orders) ? $orders->total() : 0;
        $menunggu  = isset($orders) ? $orders->getCollection()->where('status','menunggu')->count()  : 0;
        $disetujui = isset($orders) ? $orders->getCollection()->where('status','disetujui')->count() : 0;
        $ditolak   = isset($orders) ? $orders->getCollection()->where('status','ditolak')->count()   : 0;
    ?>
    <div class="stats-bar">
        <div class="stat-chip">
            <i class="fas fa-shopping-cart"></i>
            Total Order: <strong><?php echo e($total); ?></strong>
        </div>
        <div class="stat-chip">
            <i class="fas fa-clock" style="color:#D97706;"></i>
            Menunggu: <strong style="color:#D97706;"><?php echo e($orders->getCollection()->where('status','menunggu')->count() ?? 0); ?></strong>
        </div>
        <div class="stat-chip">
            <i class="fas fa-check-circle" style="color:#059669;"></i>
            Disetujui: <strong style="color:#059669;"><?php echo e($orders->getCollection()->where('status','disetujui')->count() ?? 0); ?></strong>
        </div>
        <div class="stat-chip">
            <i class="fas fa-times-circle" style="color:#DC2626;"></i>
            Ditolak: <strong style="color:#DC2626;"><?php echo e($orders->getCollection()->where('status','ditolak')->count() ?? 0); ?></strong>
        </div>
    </div>

    
    <div class="filter-bar">
        <span class="filter-label"><i class="fas fa-filter"></i></span>
        <a href="<?php echo e(route('apparel.orders.index')); ?>"
           class="status-tab all <?php echo e(!request('status') ? 'active' : ''); ?>">
            Semua
        </a>
        <a href="<?php echo e(route('apparel.orders.index', ['status' => 'menunggu'])); ?>"
           class="status-tab menunggu <?php echo e(request('status') == 'menunggu' ? 'active' : ''); ?>">
            <span class="tab-dot"></span> Menunggu
        </a>
        <a href="<?php echo e(route('apparel.orders.index', ['status' => 'disetujui'])); ?>"
           class="status-tab disetujui <?php echo e(request('status') == 'disetujui' ? 'active' : ''); ?>">
            <span class="tab-dot"></span> Disetujui
        </a>
        <a href="<?php echo e(route('apparel.orders.index', ['status' => 'ditolak'])); ?>"
           class="status-tab ditolak <?php echo e(request('status') == 'ditolak' ? 'active' : ''); ?>">
            <span class="tab-dot"></span> Ditolak
        </a>
        <div style="flex:1; min-width:10px;"></div>
        <i class="fas fa-search" style="color:#CBD5E1; font-size:0.9rem; flex-shrink:0;"></i>
        <input type="text" id="searchInput" placeholder="Cari pemesan atau produk..." oninput="filterRows()">
    </div>

    
    <div class="orders-card">
        <?php if(($orders ?? collect())->isEmpty()): ?>
            <div class="empty-state">
                <div class="empty-icon-wrap"><i class="fas fa-shopping-cart"></i></div>
                <h5>Belum Ada Order</h5>
                <p>Order dari pelanggan akan muncul di sini.</p>
            </div>
        <?php else: ?>
            <div style="overflow-x: auto;">
                <table class="orders-table" id="ordersTable">
                    <thead>
                        <tr>
                            <th style="width:50px;">ID</th>
                            <th>Pemesan</th>
                            <th>Produk</th>
                            <th style="width:70px; text-align:center;">Qty</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th style="width:130px; text-align:center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $statusKey = match($order->status) {
                                    'menunggu'  => 'menunggu',
                                    'disetujui' => 'disetujui',
                                    'ditolak'   => 'ditolak',
                                    default     => 'default'
                                };
                                $statusLabel = match($order->status) {
                                    'menunggu'  => 'Menunggu',
                                    'disetujui' => 'Disetujui',
                                    'ditolak'   => 'Ditolak',
                                    default     => ucfirst($order->status)
                                };
                                $total = $order->qty * ($order->variant->price ?? $order->product->price ?? 0);
                            ?>
                            <tr class="ord-row"
                                data-name="<?php echo e(strtolower($order->pemesan_name . ' ' . ($order->product->name ?? ''))); ?>">
                                <td>
                                    <span class="order-id">#<?php echo e($order->id); ?></span>
                                </td>
                                <td>
                                    <div class="ord-name"><?php echo e($order->pemesan_name); ?></div>
                                    <div class="ord-phone">
                                        <i class="fas fa-phone"></i> <?php echo e($order->pemesan_phone); ?>

                                    </div>
                                </td>
                                <td>
                                    <div class="ord-product"><?php echo e($order->product->name ?? 'N/A'); ?></div>
                                </td>
                                <td style="text-align:center;">
                                    <span class="badge-qty"><?php echo e($order->qty); ?></span>
                                </td>
                                <td>
                                    <span class="ord-total">Rp <?php echo e(number_format($total, 0, ',', '.')); ?></span>
                                </td>
                                <td>
                                    <span class="badge-status <?php echo e($statusKey); ?>">
                                        <span class="dot"></span>
                                        <?php echo e($statusLabel); ?>

                                    </span>
                                </td>
                                <td>
                                    <div class="ord-date">
                                        <i class="fas fa-calendar-alt"></i>
                                        <?php echo e($order->created_at->format('d M Y')); ?>

                                    </div>
                                </td>
                                <td style="text-align:center;">
                                    <div class="action-group">
                                        <a href="<?php echo e(route('apparel.orders.show', $order)); ?>"
                                           class="act-btn detail" title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <button type="button" class="act-btn delete" title="Hapus"
                                                onclick="confirmDelete(<?php echo e($order->id); ?>, '<?php echo e($order->pemesan_name); ?>')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            <?php if(isset($orders) && $orders->hasPages()): ?>
                <div class="card-foot">
                    <?php echo e($orders->links()); ?>

                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>

    
    <div class="modal fade modal-danger" id="deleteModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-exclamation-triangle me-2"></i> Konfirmasi Hapus Order
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus order ini?</p>
                    <div id="deleteOrderInfo" class="mt-2 p-2 bg-light rounded" style="font-size: 0.9rem;">
                        <!-- Info order akan diisi via JS -->
                    </div>
                    <p class="text-danger mt-3 small">
                        <i class="fas fa-info-circle"></i> Tindakan ini tidak dapat dibatalkan!
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times"></i> Batal
                    </button>
                    <form id="deleteForm" method="POST" action="">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash-alt"></i> Ya, Hapus!
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script>
function filterRows() {
    var search = document.getElementById('searchInput').value.toLowerCase();
    document.querySelectorAll('.ord-row').forEach(function (row) {
        row.style.display = row.dataset.name.includes(search) ? '' : 'none';
    });
}

function confirmDelete(orderId, customerName) {
    // Set form action
    var form = document.getElementById('deleteForm');
    form.action = '/apparel/orders/' + orderId;
    
    // Set info order di modal
    var infoDiv = document.getElementById('deleteOrderInfo');
    infoDiv.innerHTML = '<i class="fas fa-receipt me-1"></i> Order #' + orderId + '<br>' +
                        '<i class="fas fa-user me-1"></i> Pemesan: <strong>' + customerName + '</strong>';
    
    // Tampilkan modal
    $('#deleteModal').modal('show');
}
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\qofmedia-web\resources\views/apparel/orders/index.blade.php ENDPATH**/ ?>