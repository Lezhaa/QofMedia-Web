

<?php $__env->startSection('title', 'Manajemen Divisi'); ?>

<?php $__env->startSection('content_header'); ?>
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1>Manajemen Divisi</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
                <li class="breadcrumb-item active">Divisi</li>
            </ol>
        </div>
        <a href="<?php echo e(route('admin.divisions.create')); ?>" class="btn btn-primary">
            <i class="fas fa-plus mr-1"></i> Tambah Divisi
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
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width="50">#</th>
                        <th>Nama Divisi</th>
                        <th>Slug</th>
                        <th>Instagram</th>
                        <th width="100">Jml Member</th>
                        <th width="80">Status</th>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $divisions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $division): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td>
                                <strong><?php echo e($division->name); ?></strong>
                                <?php if($division->description): ?>
                                    <br><small class="text-muted"><?php echo e(Str::limit($division->description, 50)); ?></small>
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($division->slug); ?></td>
                            <td><?php echo e($division->instagram ?? '-'); ?></td>
                            <td>
                                <span class="badge badge-info"><?php echo e($division->members_count); ?> member</span>
                            </td>
                            <td>
                                <?php if($division->is_active): ?>
                                    <span class="badge badge-success">Aktif</span>
                                <?php else: ?>
                                    <span class="badge badge-secondary">Nonaktif</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?php echo e(route('admin.divisions.edit', $division)); ?>" class="btn btn-xs btn-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="<?php echo e(route('admin.divisions.destroy', $division)); ?>" method="POST" class="d-inline">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-xs btn-danger" 
                                            onclick="return confirm('Yakin hapus divisi ini? Semua member di dalamnya juga akan terhapus.')" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">
                                <i class="fas fa-layer-group fa-2x mb-2 opacity-50"></i>
                                <p>Belum ada divisi</p>
                                <a href="<?php echo e(route('admin.divisions.create')); ?>" class="btn btn-sm btn-primary">
                                    <i class="fas fa-plus mr-1"></i> Tambah Divisi
                                </a>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php if($divisions->hasPages()): ?>
            <div class="card-footer"><?php echo e($divisions->links()); ?></div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\qofmedia-web\resources\views/admin/divisions/index.blade.php ENDPATH**/ ?>