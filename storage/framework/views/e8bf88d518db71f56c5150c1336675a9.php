

<?php $__env->startSection('title', 'Tambah Item ke ' . $album->name); ?>

<?php $__env->startSection('content_header'); ?>
    <div>
        <h1>Tambah Item ke Album: <?php echo e($album->name); ?></h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?php echo e(route('admin.albums.index')); ?>">Album</a></li>
            <li class="breadcrumb-item"><a href="<?php echo e(route('admin.albums.items.index', $album)); ?>"><?php echo e($album->name); ?></a></li>
            <li class="breadcrumb-item active">Tambah Item</li>
        </ol>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-upload mr-2"></i>
                        Upload Foto/Video
                    </h3>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('admin.albums.items.store', $album)); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        
                        <div class="form-group">
                            <label for="type">Tipe Item <span class="text-danger">*</span></label>
                            <select name="type" id="type" class="form-control <?php $__errorArgs = ['type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                <option value="foto" <?php echo e(old('type') == 'foto' ? 'selected' : ''); ?>>📷 Foto</option>
                                <option value="video" <?php echo e(old('type') == 'video' ? 'selected' : ''); ?>>🎬 Video</option>
                            </select>
                            <?php $__errorArgs = ['type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        
                        <div class="form-group">
                            <label for="file">Pilih File <span class="text-danger">*</span></label>
                            <input type="file" 
                                   class="form-control <?php $__errorArgs = ['file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                   id="file" 
                                   name="file" 
                                   required 
                                   accept="image/*,video/*">
                            <small class="form-text text-muted">
                                <i class="fas fa-info-circle mr-1"></i>
                                Foto: JPG, PNG, GIF (maks 20MB) | Video: MP4, MOV, AVI (maks 20MB)
                            </small>
                            <?php $__errorArgs = ['file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        
                        <div class="form-group">
                            <label for="caption">Caption (Opsional)</label>
                            <input type="text" 
                                   class="form-control <?php $__errorArgs = ['caption'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                   id="caption" 
                                   name="caption" 
                                   value="<?php echo e(old('caption')); ?>" 
                                   placeholder="Deskripsi singkat foto/video">
                            <small class="form-text text-muted">Maksimal 255 karakter</small>
                            <?php $__errorArgs = ['caption'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        
                        <hr>
                        
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle mr-2"></i>
                            <strong>Info:</strong> File akan disimpan di server.
                            <ul class="mb-0 mt-2">
                                <li>Foto dan Video maksimal 20MB</li>
                                <li>Format yang didukung: JPG, PNG, GIF, MP4, MOV, AVI</li>
                                <li>Maksimal 100 item per album</li>
                            </ul>
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save mr-1"></i> Simpan Item
                            </button>
                            <a href="<?php echo e(route('admin.albums.items.index', $album)); ?>" class="btn btn-secondary">
                                <i class="fas fa-times mr-1"></i> Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-info-circle mr-2"></i>
                        Info Album
                    </h3>
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        <?php if($album->cover_image): ?>
                            <img src="<?php echo e(asset('storage/' . $album->cover_image)); ?>" 
                                 alt="<?php echo e($album->name); ?>" 
                                 class="img-fluid rounded" 
                                 style="max-height: 150px;">
                        <?php else: ?>
                            <div class="bg-secondary d-flex align-items-center justify-content-center" 
                                 style="height: 150px; border-radius: 10px;">
                                <i class="fas fa-image text-white fa-3x"></i>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <table class="table table-sm">
                        <tr>
                            <th width="100">Nama</th>
                            <td><?php echo e($album->name); ?></td>
                        </tr>
                        <tr>
                            <th>Tahun</th>
                            <td><?php echo e($album->year); ?></td>
                        </tr>
                        <tr>
                            <th>Total Item</th>
                            <td>
                                <span class="badge <?php echo e($album->items->count() >= 100 ? 'badge-warning' : 'badge-info'); ?>">
                                    <?php echo e($album->items->count()); ?> / 100 item
                                </span>
                            </td>
                        </tr>
                        <?php if($album->description): ?>
                            <tr>
                                <th>Deskripsi</th>
                                <td><small><?php echo e($album->description); ?></small></td>
                            </tr>
                        <?php endif; ?>
                    </table>
                </div>
                <div class="card-footer">
                    <a href="<?php echo e(route('admin.albums.items.index', $album)); ?>" class="btn btn-outline-secondary btn-sm btn-block">
                        <i class="fas fa-images mr-1"></i> Lihat Semua Item
                    </a>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-upload mr-2"></i>
                        Upload Banyak Sekaligus
                    </h3>
                </div>
                <div class="card-body">
                    <p class="small text-muted">Ingin upload banyak file sekaligus?</p>
                    <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#uploadMultipleModal">
                        <i class="fas fa-upload mr-1"></i> Upload Banyak
                    </button>
                </div>
            </div>
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

<?php $__env->startSection('css'); ?>
    <style>
        .card-header {
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>
        // Preview file name when selected
        $('#file').on('change', function() {
            var fileName = $(this).val().split('\\').pop();
            if (fileName) {
                $(this).next('.form-text').html(
                    '<i class="fas fa-check-circle text-success mr-1"></i>' + 
                    'File dipilih: ' + fileName
                );
            }
        });
        
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
<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\qofmedia-web\resources\views/admin/gallery/items/create.blade.php ENDPATH**/ ?>