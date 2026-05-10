

<?php $__env->startSection('title', 'Manajemen Artikel'); ?>

<?php $__env->startSection('content_header'); ?>
    <div class="d-flex justify-content-between align-items-center">
        <h1>Manajemen Artikel</h1>
        <a href="<?php echo e(route('admin.articles.create')); ?>" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Artikel
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
        <div class="card-body table-responsive p-0">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width="50">#</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Tanggal Publish</th>
                        <th width="150">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($article->title); ?></td>
                            <td><span class="badge badge-info"><?php echo e($article->category); ?></span></td>
                            <td>
                                <?php if($article->published_at): ?>
                                    <?php echo e(\Carbon\Carbon::parse($article->published_at)->format('d M Y')); ?>

                                <?php else: ?>
                                    <span class="text-muted">-</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="<?php echo e(route('admin.articles.edit', $article)); ?>" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="<?php echo e(route('information.show', $article->slug)); ?>" class="btn btn-sm btn-info" target="_blank">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form action="<?php echo e(route('admin.articles.destroy', $article)); ?>" method="POST" class="d-inline">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-danger" 
                                            onclick="return confirm('Yakin ingin menghapus artikel ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="text-center py-4">
                                <i class="fas fa-newspaper fa-2x text-muted mb-2"></i>
                                <p class="text-muted mb-0">Belum ada artikel</p>
                                <a href="<?php echo e(route('admin.articles.create')); ?>" class="btn btn-sm btn-primary mt-2">
                                    <i class="fas fa-plus"></i> Tambah Artikel
                                </a>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php if($articles->hasPages()): ?>
            <div class="card-footer">
                <?php echo e($articles->links()); ?>

            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\qofmedia-web\resources\views/admin/articles/index.blade.php ENDPATH**/ ?>