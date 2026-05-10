

<?php $__env->startSection('title', 'Item Galeri: ' . $album->name); ?>

<?php $__env->startSection('content_header'); ?>
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1>Item Galeri: <?php echo e($album->name); ?></h1>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?php echo e(route('admin.albums.index')); ?>">Album</a></li>
                <li class="breadcrumb-item active"><?php echo e($album->name); ?></li>
            </ol>
        </div>
        <div>
            <a href="<?php echo e(route('admin.albums.items.create', $album)); ?>" class="btn btn-primary">
                <i class="fas fa-plus mr-1"></i> Tambah Item
            </a>
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#uploadMultipleModal">
                <i class="fas fa-upload mr-1"></i> Upload Banyak
            </button>
            <a href="<?php echo e(route('admin.albums.index')); ?>" class="btn btn-secondary">
                <i class="fas fa-arrow-left mr-1"></i> Kembali
            </a>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle mr-1"></i> <?php echo e(session('success')); ?>

            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    <?php endif; ?>
    
    <?php if(session('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="fas fa-exclamation-circle mr-1"></i> <?php echo e(session('error')); ?>

            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-body">
            <?php if($items->count() > 0): ?>
                <div class="row">
                    <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-3 col-sm-4 col-6 mb-3">
                            <div class="card h-100">
                                <div class="position-relative">
                                    <?php if($item->type == 'foto'): ?>
                                        <img src="<?php echo e($item->file_url ?? asset('images/no-image.png')); ?>" 
                                             class="card-img-top" 
                                             alt="<?php echo e($item->caption ?? 'Foto'); ?>"
                                             loading="lazy"
                                             style="height: 180px; object-fit: cover;"
                                             onerror="this.onerror=null; this.src='<?php echo e(asset('images/no-image.png')); ?>';">
                                    <?php else: ?>
                                        <div class="bg-dark d-flex align-items-center justify-content-center" 
                                             style="height: 180px;">
                                            <i class="fas fa-video text-white fa-3x"></i>
                                        </div>
                                    <?php endif; ?>
                                    <span class="position-absolute top-0 end-0 m-2">
                                        <span class="badge badge-<?php echo e($item->type == 'foto' ? 'info' : 'warning'); ?>">
                                            <?php echo e($item->type == 'foto' ? 'Foto' : 'Video'); ?>

                                        </span>
                                    </span>
                                </div>
                                <div class="card-body p-2">
                                    <?php if($item->caption): ?>
                                        <p class="small mb-2"><?php echo e(Str::limit($item->caption, 40)); ?></p>
                                    <?php endif; ?>
                                    <p class="small text-muted mb-2"><?php echo e($item->formatted_size ?? '-'); ?></p>
                                    <div class="btn-group w-100" role="group">
                                        <a href="<?php echo e($item->file_url ?? '#'); ?>" target="_blank" class="btn btn-xs btn-outline-info" title="Lihat">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <form action="<?php echo e(route('admin.albums.items.destroy', [$album, $item])); ?>" method="POST" class="d-inline">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-xs btn-outline-danger" 
                                                    onclick="return confirm('Yakin ingin menghapus item ini?')" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                
                <?php if($items->hasPages()): ?>
                    <div class="mt-3">
                        <?php echo e($items->links()); ?>

                    </div>
                <?php endif; ?>
            <?php else: ?>
                <div class="text-center py-5">
                    <i class="fas fa-images fa-3x text-muted mb-3"></i>
                    <h5>Belum ada item di album ini</h5>
                    <p class="text-muted">Upload foto atau video untuk memulai.</p>
                    <a href="<?php echo e(route('admin.albums.items.create', $album)); ?>" class="btn btn-primary">
                        <i class="fas fa-plus mr-1"></i> Tambah Item Pertama
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Upload Multiple Modal -->
    <div class="modal fade" id="uploadMultipleModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="<?php echo e(route('admin.albums.items.upload-multiple', $album)); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="fas fa-upload mr-2"></i>
                            Upload Banyak File ke <?php echo e($album->name); ?>

                        </h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="modal_type">Tipe File <span class="text-danger">*</span></label>
                            <select name="type" id="modal_type" class="form-control" required>
                                <option value="foto">📷 Foto</option>
                                <option value="video">🎬 Video</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="modal_files">Pilih File <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" name="files[]" multiple required accept="image/*,video/*">
                            <small class="form-text text-muted">
                                Anda dapat memilih banyak file sekaligus (maks 20MB per file).
                            </small>
                        </div>
                        <?php if($album->items->count() >= 100): ?>
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle mr-1"></i>
                                Album sudah mencapai batas 100 item. Upload akan dibatasi.
                            </div>
                        <?php else: ?>
                            <div class="alert alert-info small">
                                <i class="fas fa-info-circle mr-1"></i>
                                File akan disimpan di server. Maksimal 100 item per album.
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success" <?php echo e($album->items->count() >= 100 ? 'disabled' : ''); ?>>
                            <i class="fas fa-upload mr-1"></i> Upload Semua
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>
        // Show file count for multiple upload
        $('input[name="files[]"]').on('change', function() {
            var count = this.files.length;
            $(this).next('.form-text').html(
                '<i class="fas fa-check-circle text-success mr-1"></i>' + 
                count + ' file dipilih'
            );
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\qofmedia-web\resources\views/admin/gallery/items/index.blade.php ENDPATH**/ ?>