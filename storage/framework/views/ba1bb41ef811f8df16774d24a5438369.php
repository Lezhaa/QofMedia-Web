

<?php $__env->startSection('title', 'Kelola Order'); ?>

<?php $__env->startSection('content_header'); ?>
    <div class="d-flex justify-content-between align-items-center">
        <h1>Kelola Order</h1>
        <a href="<?php echo e(route('home')); ?>" class="btn btn-outline-secondary" target="_blank">
            <i class="fas fa-globe"></i> Lihat Website
        </a>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Filter Status</h3>
        </div>
        <div class="card-body">
            <div class="btn-group">
                <a href="<?php echo e(route('apparel.orders.index')); ?>" class="btn btn-outline-secondary <?php echo e(!request('status') ? 'active' : ''); ?>">
                    Semua
                </a>
                <a href="<?php echo e(route('apparel.orders.index', ['status' => 'menunggu'])); ?>" class="btn btn-outline-warning <?php echo e(request('status') == 'menunggu' ? 'active' : ''); ?>">
                    Menunggu
                </a>
                <a href="<?php echo e(route('apparel.orders.index', ['status' => 'disetujui'])); ?>" class="btn btn-outline-success <?php echo e(request('status') == 'disetujui' ? 'active' : ''); ?>">
                    Disetujui
                </a>
                <a href="<?php echo e(route('apparel.orders.index', ['status' => 'ditolak'])); ?>" class="btn btn-outline-danger <?php echo e(request('status') == 'ditolak' ? 'active' : ''); ?>">
                    Ditolak
                </a>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body table-responsive p-0">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Pemesan</th>
                        <th>No. HP</th>
                        <th>Produk</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $orders ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>#<?php echo e($order->id); ?></td>
                            <td><?php echo e($order->pemesan_name); ?></td>
                            <td><?php echo e($order->pemesan_phone); ?></td>
                            <td><?php echo e($order->product->name ?? 'N/A'); ?></td>
                            <td><?php echo e($order->qty); ?></td>
                            <td>Rp <?php echo e(number_format($order->qty * ($order->variant->price ?? $order->product->price ?? 0), 0, ',', '.')); ?></td>
                            <td>
                                <?php
                                    $badgeClass = match($order->status) {
                                        'menunggu' => 'warning',
                                        'disetujui' => 'success',
                                        'ditolak' => 'danger',
                                        default => 'secondary'
                                    };
                                    $statusLabel = match($order->status) {
                                        'menunggu' => 'Menunggu',
                                        'disetujui' => 'Disetujui',
                                        'ditolak' => 'Ditolak',
                                        default => $order->status
                                    };
                                ?>
                                <span class="badge badge-<?php echo e($badgeClass); ?>">
                                    <?php echo e($statusLabel); ?>

                                </span>
                            </td>
                            <td><?php echo e($order->created_at->format('d M Y')); ?></td>
                            <td>
                                <a href="<?php echo e(route('apparel.orders.show', $order)); ?>" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="9" class="text-center py-4">
                                <i class="fas fa-shopping-cart fa-2x text-muted mb-2"></i>
                                <p class="text-muted mb-0">Belum ada order</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php if(isset($orders) && $orders->hasPages()): ?>
            <div class="card-footer">
                <?php echo e($orders->links()); ?>

            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\qofmedia-web\resources\views/apparel/orders/index.blade.php ENDPATH**/ ?>