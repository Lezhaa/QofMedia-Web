

<?php $__env->startSection('title', 'Edit Produk'); ?>

<?php $__env->startSection('content_header'); ?>
    <div>
        <h1>Edit Produk</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo e(route('apparel.dashboard')); ?>">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?php echo e(route('apparel.products.index')); ?>">Produk</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    
    <form action="<?php echo e(route('apparel.products.update', $product)); ?>" method="POST" enctype="multipart/form-data" id="mainForm">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="card">
            <div class="card-body">

                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="name">Nama Produk <span class="text-danger">*</span></label>
                            <input type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                   id="name" name="name" value="<?php echo e(old('name', $product->name)); ?>" required>
                            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <div class="form-group">
                            <label for="description">Deskripsi</label>
                            <textarea class="form-control <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                      id="description" name="description" rows="4"><?php echo e(old('description', $product->description)); ?></textarea>
                            <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div class="invalid-feedback"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="category_id">Kategori <span class="text-danger">*</span></label>
                            <select name="category_id" id="category_id" class="form-control" required>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category->id); ?>" <?php echo e(old('category_id', $product->category_id) == $category->id ? 'selected' : ''); ?>>
                                        <?php echo e($category->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="type">Tipe Produk <span class="text-danger">*</span></label>
                            <select name="type" id="type" class="form-control" required>
                                <option value="other" <?php echo e(old('type', $product->type) == 'other' ? 'selected' : ''); ?>>Produk Biasa</option>
                                <option value="kaos"  <?php echo e(old('type', $product->type) == 'kaos'  ? 'selected' : ''); ?>>Kaos</option>
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="price">Harga</label>
                                    <input type="number" class="form-control" name="price" value="<?php echo e(old('price', $product->price)); ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="stock">Stok</label>
                                    <input type="number" class="form-control" name="stock" value="<?php echo e(old('stock', $product->stock)); ?>" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="row mt-3">
                    <div class="col-md-6">
                        <?php if($product->image): ?>
                            <div class="mb-2">
                                <label>Gambar Saat Ini</label><br>
                                <img src="<?php echo e(asset('storage/'.$product->image)); ?>" style="max-width:150px; border-radius:8px;">
                            </div>
                        <?php endif; ?>
                        <div class="form-group">
                            <label for="image">Ganti Gambar Utama</label>
                            <input type="file" class="form-control" name="image" accept="image/*">
                            <small class="text-muted">Kosongkan jika tidak ingin mengubah</small>
                        </div>
                    </div>
                </div>

                
                <div class="card mt-3">
                    <div class="card-header">
                        <h5 class="card-title mb-0"><i class="fas fa-images"></i> Tambah Foto Galeri</h5>
                    </div>
                    <div class="card-body">
                        <div id="galleryContainer">
                            <div class="gallery-row row mb-2">
                                <div class="col-md-5">
                                    <label>Foto</label>
                                    <input type="file" name="gallery_images[]" class="form-control" accept="image/*">
                                </div>
                                <div class="col-md-5">
                                    <label>Label</label>
                                    <input type="text" name="gallery_labels[]" class="form-control" placeholder="Contoh: Motif A - Hitam">
                                </div>
                                <div class="col-md-2 d-flex align-items-end">
                                    
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-sm btn-info mt-2" id="addGalleryRow">
                            <i class="fas fa-plus"></i> Tambah Foto
                        </button>
                    </div>
                </div>

                
                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-save"></i> Update Produk
                    </button>
                    <a href="<?php echo e(route('apparel.products.index')); ?>" class="btn btn-secondary btn-lg">
                        <i class="fas fa-times"></i> Batal
                    </a>
                </div>

            </div>
        </div>
    </form>
    


    
    <?php if($product->images->count() > 0): ?>
        <div class="card mt-3">
            <div class="card-header">
                <h5 class="card-title mb-0">Galeri Saat Ini</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-2 text-center mb-3">
                            <img src="<?php echo e(asset('storage/'.$img->image)); ?>" style="width:100%; border-radius:8px;">

                            
                            <form action="<?php echo e(route('apparel.products.updateImageLabel', $img->id)); ?>" method="POST" class="mt-1">
                                <?php echo csrf_field(); ?>
                                <input type="text" name="label" value="<?php echo e($img->label); ?>"
                                       class="form-control form-control-sm text-center"
                                       style="font-size:0.75rem;">
                                <button type="submit" class="btn btn-sm btn-info mt-1 btn-block" style="font-size:0.7rem;">
                                    <i class="fas fa-check"></i> Update
                                </button>
                            </form>

                            
                            <form action="<?php echo e(route('apparel.products.deleteImage', $img->id)); ?>" method="POST"
                                  onsubmit="return confirm('Hapus foto ini?')">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button class="btn btn-sm btn-danger mt-1 btn-block" style="font-size:0.7rem;">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
    

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script>
    document.getElementById('addGalleryRow').addEventListener('click', function () {
        const container = document.getElementById('galleryContainer');
        const row = document.createElement('div');
        row.className = 'gallery-row row mb-2';
        row.innerHTML = `
            <div class="col-md-5">
                <input type="file" name="gallery_images[]" class="form-control" accept="image/*">
            </div>
            <div class="col-md-5">
                <input type="text" name="gallery_labels[]" class="form-control" placeholder="Label foto">
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="button" class="btn btn-danger btn-sm"
                        onclick="this.closest('.gallery-row').remove()">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        `;
        container.appendChild(row);
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\qofmedia-web\resources\views/apparel/products/edit.blade.php ENDPATH**/ ?>