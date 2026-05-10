

<?php $__env->startSection('title', 'Manajemen Anggota Tim'); ?>

<?php $__env->startSection('content_header'); ?>
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1>Manajemen Anggota Tim</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
                <li class="breadcrumb-item active">Anggota Tim</li>
            </ol>
        </div>
        <a href="<?php echo e(route('admin.members.create')); ?>" class="btn btn-primary">
            <i class="fas fa-plus mr-1"></i> Tambah Anggota
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

    <!-- Filter -->
    <div class="card">
        <div class="card-body">
            <form method="GET" class="form-inline">
                <div class="row w-100">
                    <div class="col-md-3">
                        <select name="division_id" class="form-control w-100">
                            <option value="">Semua Divisi</option>
                            <?php $__currentLoopData = $divisions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $div): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($div->id); ?>" <?php echo e(request('division_id') == $div->id ? 'selected' : ''); ?>>
                                    <?php echo e($div->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-filter mr-1"></i> Filter
                        </button>
                        <a href="<?php echo e(route('admin.members.index')); ?>" class="btn btn-secondary">Reset</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Members Table -->
    <div class="card">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="thead-light">
                    <tr>
                        <th width="60">Foto</th>
                        <th>Nama</th>
                        <th>Panggilan</th>
                        <th>Media Sosial</th>
                        <th>Divisi</th>
                        <th>Status</th>
                        <th>Urutan</th>
                        <th width="120">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <?php if($member->photo_url): ?>
                                    <img src="<?php echo e($member->photo_url); ?>" style="width: 40px; height: 40px; object-fit: cover; border-radius: 8px;">
                                <?php else: ?>
                                    <div style="width: 40px; height: 40px; border-radius: 8px; background: #6366f1; display: flex; align-items: center; justify-content: center;">
                                        <span style="color: white; font-weight: 700; font-size: 16px;">
                                            <?php echo e(strtoupper(substr($member->nickname, 0, 1))); ?>

                                        </span>
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <strong><?php echo e($member->name); ?></strong>
                                <?php if($member->position): ?>
                                    <br><small class="text-muted"><?php echo e($member->position); ?></small>
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($member->nickname); ?></td>
                            <td>
                                <?php if($member->social_platform && $member->social_username): ?>
                                    <a href="<?php echo e($member->social_url); ?>" target="_blank" class="text-decoration-none">
                                        <i class="fab fa-<?php echo e($member->social_platform); ?>"></i>
                                        <?php echo e(ucfirst($member->social_platform)); ?>

                                    </a>
                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php $__empty_2 = true; $__currentLoopData = $member->divisions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $div): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>
                                    <span class="badge badge-info mr-1 mb-1"><?php echo e($div->name); ?></span>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_2): ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($member->is_active): ?>
                                    <span class="badge badge-success">Aktif</span>
                                <?php else: ?>
                                    <span class="badge badge-secondary">Nonaktif</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($member->order); ?></td>
                            <td>
                                <a href="<?php echo e(route('admin.members.edit', $member)); ?>" class="btn btn-xs btn-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="<?php echo e(route('admin.members.destroy', $member)); ?>" method="POST" class="d-inline" 
                                      onsubmit="return confirm('Yakin hapus anggota <?php echo e($member->name); ?>?')">
                                    <?php echo csrf_field(); ?> 
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-xs btn-danger" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <i class="fas fa-users fa-3x mb-2 opacity-50"></i>
                                <p class="mb-0">Belum ada anggota tim</p>
                                <a href="<?php echo e(route('admin.members.create')); ?>" class="btn btn-sm btn-primary mt-2">
                                    <i class="fas fa-plus mr-1"></i> Tambah Anggota
                                </a>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php if($members->hasPages()): ?>
            <div class="card-footer">
                <?php echo e($members->links()); ?>

            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\qofmedia-web\resources\views/admin/members/index.blade.php ENDPATH**/ ?>