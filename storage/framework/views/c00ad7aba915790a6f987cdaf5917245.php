

<?php $__env->startSection('title', 'Pesan Kontak'); ?>

<?php $__env->startSection('content_header'); ?>
    <div class="d-flex justify-content-between align-items-center">
        <h1>Pesan Kontak</h1>
        <a href="<?php echo e(route('home')); ?>" class="btn btn-outline-secondary" target="_blank">
            <i class="fas fa-globe"></i> Lihat Website
        </a>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <?php echo e(session('success')); ?>

            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Daftar Pesan Masuk</h3>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width="50">#</th>
                        <th width="50">Status</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No. HP</th>
                        <th>Tanggal</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $contacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="<?php echo e($contact->read_at ? '' : 'table-warning'); ?>">
                            <td><?php echo e($loop->iteration); ?></td>
                            <td>
                                <?php if($contact->read_at): ?>
                                    <span class="badge badge-success" title="Sudah dibaca">
                                        <i class="fas fa-check"></i>
                                    </span>
                                <?php else: ?>
                                    <span class="badge badge-warning" title="Belum dibaca">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <strong><?php echo e($contact->name); ?></strong>
                            </td>
                            <td><?php echo e($contact->email); ?></td>
                            <td><?php echo e($contact->phone); ?></td>
                            <td><?php echo e($contact->created_at->format('d M Y H:i')); ?></td>
                            <td>
                                <a href="<?php echo e(route('admin.contacts.show', $contact)); ?>" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i> Lihat
                                </a>
                                <?php if(!$contact->read_at): ?>
                                    <form action="<?php echo e(route('admin.contacts.read', $contact)); ?>" method="POST" class="d-inline">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="btn btn-sm btn-success" title="Tandai sudah dibaca">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                <?php endif; ?>
                                <form action="<?php echo e(route('admin.contacts.destroy', $contact)); ?>" method="POST" class="d-inline">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-danger" 
                                            onclick="return confirm('Yakin ingin menghapus pesan ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <i class="fas fa-envelope-open-text fa-2x text-muted mb-2"></i>
                                <p class="text-muted mb-0">Belum ada pesan masuk</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php if($contacts->hasPages()): ?>
            <div class="card-footer">
                <?php echo e($contacts->links()); ?>

            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\qofmedia-web\resources\views/admin/contacts/index.blade.php ENDPATH**/ ?>