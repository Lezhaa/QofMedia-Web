

<?php $__env->startSection('title', 'Produk Apparel'); ?>

<?php $__env->startSection('content_header'); ?>
    <div class="d-flex justify-content-between align-items-center">
        <h1>Produk Apparel</h1>
        <a href="<?php echo e(route('apparel.products.create')); ?>" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Produk
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
                        <th width="80">Gambar</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Tipe</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th width="100">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $products ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td>
                                <?php if($product->image): ?>
                                    <img src="<?php echo e(asset('storage/' . $product->image)); ?>" 
                                         style="width: 50px; height: 50px; object-fit: cover;">
                                <?php else: ?>
                                    <div class="bg-secondary d-flex align-items-center justify-content-center" 
                                         style="width: 50px; height: 50px;">
                                        <i class="fas fa-box text-white"></i>
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($product->name); ?></td>
                            <td><?php echo e($product->category->name ?? 'N/A'); ?></td>
                            <td>
                                <span class="badge badge-<?php echo e($product->type == 'kaos' ? 'info' : 'secondary'); ?>">
                                    <?php echo e(ucfirst($product->type)); ?>

                                </span>
                            </td>
                            <td>Rp <?php echo e(number_format($product->price, 0, ',', '.')); ?></td>
                            <td><?php echo e($product->stock); ?></td>
                            <td>
                                <a href="<?php echo e(route('apparel.products.edit', $product)); ?>" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="<?php echo e(route('apparel.products.destroy', $product)); ?>" method="POST" class="d-inline">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-danger" 
                                            onclick="return confirm('Yakin ingin menghapus produk ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <i class="fas fa-box fa-2x text-muted mb-2"></i>
                                <p class="text-muted mb-0">Belum ada produk</p>
                                <a href="<?php echo e(route('apparel.products.create')); ?>" class="btn btn-sm btn-primary mt-2">
                                    <i class="fas fa-plus"></i> Tambah Produk
                                </a>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php if(isset($products) && $products->hasPages()): ?>
            <div class="card-footer">
                <?php echo e($products->links()); ?>

            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\qofmedia-web\resources\views/apparel/products/index.blade.php ENDPATH**/ ?>