

<?php $__env->startSection('title', 'Manajemen Album'); ?>

<?php $__env->startSection('content_header'); ?>
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1>Manajemen Album</h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
                <li class="breadcrumb-item active">Album</li>
            </ol>
        </div>
        <a href="<?php echo e(route('admin.albums.create')); ?>" class="btn btn-primary">
            <i class="fas fa-plus mr-1"></i> Tambah Album
        </a>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle mr-1"></i> <?php echo e(session('success')); ?>

            <button type="button" class="close" data-dismiss="alert">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th width="50">#</th>
                        <th width="80">Cover</th>
                        <th>Nama Album</th>
                        <th>Tahun</th>
                        <th>Deskripsi</th>
                        <th width="100">Total Item</th>
                        <th width="200">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $albums; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $album): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td>
                                <?php if($album->cover_image): ?>
                                    <img src="<?php echo e(asset('storage/' . $album->cover_image)); ?>" 
                                         alt="<?php echo e($album->name); ?>" 
                                         style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                                <?php else: ?>
                                    <div class="bg-secondary d-flex align-items-center justify-content-center" 
                                         style="width: 50px; height: 50px; border-radius: 5px;">
                                        <i class="fas fa-image text-white"></i>
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td>
                                <strong><?php echo e($album->name); ?></strong>
                                <br>
                                <small class="text-muted"><?php echo e($album->slug); ?></small>
                            </td>
                            <td><?php echo e($album->year); ?></td>
                            <td><?php echo e(Str::limit($album->description, 40) ?: '-'); ?></td>
                            <td>
                                <span class="badge badge-info">
                                    <i class="fas fa-images mr-1"></i> <?php echo e($album->items_count); ?> item
                                </span>
                            </td>
                            <td>
                                
                                <a href="<?php echo e(route('admin.albums.items.index', $album)); ?>" 
                                   class="btn btn-sm btn-primary" 
                                   title="Kelola Item">
                                    <i class="fas fa-images"></i> Item
                                </a>
                                
                                
                                <a href="<?php echo e(route('admin.albums.edit', $album)); ?>" 
                                   class="btn btn-sm btn-warning" 
                                   title="Edit Album">
                                    <i class="fas fa-edit"></i>
                                </a>
                                
                                
                                <a href="<?php echo e(route('gallery.album', ['year' => $album->year, 'slug' => $album->slug])); ?>" 
                                   class="btn btn-sm btn-info" 
                                   target="_blank" 
                                   title="Lihat di Website">
                                    <i class="fas fa-eye"></i>
                                </a>
                                
                                
                                <form action="<?php echo e(route('admin.albums.destroy', $album)); ?>" 
                                      method="POST" 
                                      class="d-inline">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" 
                                            class="btn btn-sm btn-danger" 
                                            onclick="return confirm('Yakin ingin menghapus album ini? Semua item di dalamnya juga akan dihapus.')"
                                            title="Hapus Album">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <i class="fas fa-images fa-3x text-muted mb-3"></i>
                                <p class="text-muted">Belum ada album</p>
                                <a href="<?php echo e(route('admin.albums.create')); ?>" class="btn btn-primary">
                                    <i class="fas fa-plus mr-1"></i> Tambah Album Pertama
                                </a>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php if($albums->hasPages()): ?>
            <div class="card-footer">
                <?php echo e($albums->links()); ?>

            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <style>
        .table td {
            vertical-align: middle;
        }
        
        .btn-sm {
            margin: 2px;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\qofmedia-web\resources\views/admin/gallery/albums/index.blade.php ENDPATH**/ ?>