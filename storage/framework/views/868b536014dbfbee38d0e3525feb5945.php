

<?php $__env->startSection('title', 'Paket Studio'); ?>

<?php $__env->startSection('content_header'); ?>
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1>Paket Studio</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(route('studio.dashboard')); ?>">Dashboard</a></li>
                <li class="breadcrumb-item active">Paket Studio</li>
            </ol>
        </div>
        <a href="<?php echo e(route('studio.packages.create')); ?>" class="btn btn-primary">
            <i class="fas fa-plus mr-1"></i> Tambah Paket
        </a>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle mr-1"></i> <?php echo e(session('success')); ?>

            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="50">#</th>
                            <th>Nama Paket</th>
                            <th>Tipe</th>
                            <th>Harga</th>
                            <th>Durasi</th>
                            <th>Fasilitas</th>
                            <th width="120">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td><?php echo e($packages->firstItem() + $index); ?></td>
                                <td>
                                    <strong><?php echo e($package->name); ?></strong>
                                    <br>
                                    <small class="text-muted"><?php echo e(Str::limit($package->description, 40)); ?></small>
                                </td>
                                <td><span class="badge badge-info"><?php echo e($package->type); ?></span></td>
                                <td>Rp <?php echo e(number_format($package->price, 0, ',', '.')); ?></td>
                                <td><?php echo e($package->duration); ?></td>
                                <td>
                                    <?php if(is_array($package->facilities) && count($package->facilities) > 0): ?>
                                        <ul class="list-unstyled mb-0 small">
                                            <?php $__currentLoopData = array_slice($package->facilities, 0, 3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $facility): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li><i class="fas fa-check text-success mr-1"></i> <?php echo e($facility); ?></li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php if(count($package->facilities) > 3): ?>
                                                <li class="text-muted">+<?php echo e(count($package->facilities) - 3); ?> lainnya</li>
                                            <?php endif; ?>
                                        </ul>
                                    <?php else: ?>
                                        <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?php echo e(route('studio.packages.edit', $package)); ?>" class="btn btn-xs btn-warning" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="<?php echo e(route('studio.packages.destroy', $package)); ?>" method="POST" class="d-inline">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-xs btn-danger" 
                                                onclick="return confirm('Yakin ingin menghapus paket ini?')" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="7" class="text-center py-4 text-muted">
                                    <i class="fas fa-video fa-2x mb-2 opacity-50"></i>
                                    <p>Belum ada paket studio</p>
                                    <a href="<?php echo e(route('studio.packages.create')); ?>" class="btn btn-sm btn-primary">
                                        <i class="fas fa-plus mr-1"></i> Tambah Paket
                                    </a>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php if($packages->hasPages()): ?>
            <div class="card-footer">
                <?php echo e($packages->links()); ?>

            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\qofmedia-web\resources\views/studio/packages/index.blade.php ENDPATH**/ ?>