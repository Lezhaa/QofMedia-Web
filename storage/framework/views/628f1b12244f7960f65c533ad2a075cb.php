

<?php $__env->startSection('title', 'Edit Produk'); ?>

<?php $__env->startSection('content_header'); ?>
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="mb-0" style="font-size: 1.4rem; font-weight: 700; color: #0D1B2A;">
                <i class="fas fa-edit me-2" style="color: #0E7A96;"></i> Edit Produk
            </h1>
            <ol class="breadcrumb mb-0 mt-1" style="font-size: 0.8rem; background: transparent; padding: 0;">
                <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?php echo e(route('apparel.dashboard')); ?>">Apparel</a></li>
                <li class="breadcrumb-item"><a href="<?php echo e(route('apparel.products.index')); ?>">Produk</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </div>
        <a href="<?php echo e(route('apparel.products.index')); ?>"
           style="display:inline-flex; align-items:center; gap:6px; background:#fff; border:1.5px solid #E2E8F0; color:#64748B; padding:9px 20px; border-radius:50px; font-weight:700; font-size:0.85rem; text-decoration:none; transition:all 0.3s;">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<style>
    /* ============================================
       SECTION LABEL
       ============================================ */
    .sec-label {
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: #94A3B8;
        margin-bottom: 14px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .sec-label::after {
        content: '';
        flex: 1;
        height: 1px;
        background: #E2E8F0;
    }

    /* ============================================
       FORM CARD
       ============================================ */
    .form-card {
        background: #fff;
        border: 1px solid #E2E8F0;
        border-radius: 18px;
        overflow: hidden;
        margin-bottom: 20px;
    }
    .form-card-header {
        padding: 16px 22px;
        border-bottom: 1px solid #F1F5F9;
        display: flex;
        align-items: center;
        gap: 10px;
        background: #F8FAFC;
    }
    .form-card-header-icon {
        width: 34px; height: 34px;
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 0.9rem;
        flex-shrink: 0;
    }
    .form-card-header-title {
        font-size: 0.9rem;
        font-weight: 700;
        color: #0D1B2A;
    }
    .form-card-header-sub {
        font-size: 0.75rem;
        color: #94A3B8;
        margin-top: 1px;
    }
    .form-card-body { padding: 22px 24px; }

    /* ============================================
       FORM ELEMENTS
       ============================================ */
    .form-label-custom {
        font-weight: 600;
        font-size: 0.8rem;
        color: #0D1B2A;
        margin-bottom: 6px;
        display: block;
    }
    .form-label-custom .required { color: #DC2626; margin-left: 2px; }

    .form-control-custom {
        width: 100%;
        border-radius: 12px;
        padding: 10px 14px;
        border: 1.5px solid #E2E8F0;
        font-size: 0.875rem;
        transition: all 0.3s;
        background: #F8FAFC;
        font-family: inherit;
        outline: none;
        color: #0D1B2A;
        appearance: none;
        -webkit-appearance: none;
    }
    .form-control-custom:focus {
        border-color: #4EB8CC;
        box-shadow: 0 0 0 3px rgba(78,184,204,0.12);
        background: #fff;
    }
    .form-control-custom::placeholder { color: #94A3B8; }
    .form-control-custom.is-invalid   { border-color: #DC2626; }
    .form-control-custom.is-invalid:focus { box-shadow: 0 0 0 3px rgba(220,38,38,0.1); }

    select.form-control-custom {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2364748B' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 14px center;
        padding-right: 36px;
    }
    textarea.form-control-custom { resize: vertical; min-height: 110px; }

    .invalid-msg {
        font-size: 0.75rem; color: #DC2626; font-weight: 500;
        margin-top: 5px; display: flex; align-items: center; gap: 4px;
    }
    .field-hint {
        font-size: 0.73rem; color: #94A3B8;
        margin-top: 5px; display: flex; align-items: center; gap: 4px;
    }

    /* Price prefix */
    .input-prefix-wrap { position: relative; }
    .input-prefix {
        position: absolute; left: 0; top: 0; bottom: 0;
        display: flex; align-items: center; padding: 0 13px;
        font-size: 0.78rem; font-weight: 700; color: #64748B;
        background: #F1F5F9;
        border-radius: 12px 0 0 12px;
        border: 1.5px solid #E2E8F0; border-right: none;
        pointer-events: none;
    }
    .input-prefix ~ .form-control-custom {
        padding-left: 50px;
        border-radius: 0 12px 12px 0;
    }

    /* ============================================
       CURRENT IMAGE PREVIEW
       ============================================ */
    .current-image-wrap {
        position: relative;
        display: inline-block;
        border-radius: 14px;
        overflow: hidden;
        border: 2px solid #E2E8F0;
    }
    .current-image-wrap img {
        width: 130px; height: 130px;
        object-fit: cover;
        display: block;
    }
    .current-image-badge {
        position: absolute; bottom: 0; left: 0; right: 0;
        background: rgba(13,27,42,0.65);
        color: #fff;
        font-size: 0.65rem;
        font-weight: 700;
        text-align: center;
        padding: 4px;
        backdrop-filter: blur(4px);
    }

    /* ============================================
       FILE UPLOAD AREA
       ============================================ */
    .file-upload-area {
        border: 2px dashed #E2E8F0;
        border-radius: 14px;
        padding: 18px 16px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s;
        background: #F8FAFC;
        position: relative;
    }
    .file-upload-area:hover { border-color: #4EB8CC; background: #EEF9FC; }
    .file-upload-area input[type="file"] {
        position: absolute; inset: 0; opacity: 0; cursor: pointer;
        width: 100%; height: 100%;
    }
    .file-upload-icon {
        width: 38px; height: 38px; border-radius: 10px;
        background: #EEF9FC; color: #0E7A96;
        display: flex; align-items: center; justify-content: center;
        font-size: 1rem; margin: 0 auto 8px;
    }
    .file-upload-text  { font-size: 0.8rem; font-weight: 600; color: #0D1B2A; margin-bottom: 2px; }
    .file-upload-hint  { font-size: 0.7rem; color: #94A3B8; }
    .file-preview      { display:none; margin-top:10px; border-radius:10px; overflow:hidden; max-height:130px; object-fit:cover; width:100%; }

    /* ============================================
       GALLERY NEW
       ============================================ */
    .gallery-item {
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        border-radius: 14px;
        padding: 14px 16px;
        margin-bottom: 10px;
        transition: all 0.2s;
    }
    .gallery-item:hover { border-color: #CBD5E1; }
    .gallery-item-label-row { display:flex; align-items:center; margin-bottom:10px; }
    .gallery-item-num {
        display: inline-flex; align-items:center; justify-content:center;
        width:22px; height:22px; border-radius:6px;
        background:#0E7A96; color:#fff;
        font-size:0.68rem; font-weight:700; margin-right:8px; flex-shrink:0;
    }
    .gallery-item-title { font-size:0.78rem; font-weight:700; color:#0D1B2A; }
    .btn-remove-gallery {
        margin-left:auto;
        display:inline-flex; align-items:center; gap:5px;
        background:rgba(220,38,38,0.08); color:#DC2626;
        border:none; border-radius:8px; padding:4px 11px;
        font-size:0.73rem; font-weight:600; cursor:pointer; transition:all 0.2s;
    }
    .btn-remove-gallery:hover { background:rgba(220,38,38,0.15); }

    .btn-add-gallery {
        display:inline-flex; align-items:center; gap:6px;
        background:rgba(14,122,150,0.08); color:#0E7A96;
        border:1.5px dashed #4EB8CC; border-radius:12px;
        padding:9px 18px; font-size:0.8rem; font-weight:700;
        cursor:pointer; transition:all 0.25s;
        width:100%; justify-content:center; margin-top:4px;
    }
    .btn-add-gallery:hover { background:#EEF9FC; border-color:#0E7A96; }

    /* ============================================
       EXISTING GALLERY
       ============================================ */
    .exist-gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(130px, 1fr));
        gap: 14px;
    }
    .exist-gallery-item {
        background: #F8FAFC;
        border: 1px solid #E2E8F0;
        border-radius: 14px;
        overflow: hidden;
        transition: all 0.2s;
    }
    .exist-gallery-item:hover { border-color: #CBD5E1; box-shadow: 0 4px 14px rgba(0,0,0,0.07); }
    .exist-gallery-item img {
        width: 100%; aspect-ratio: 1/1; object-fit: cover; display: block;
    }
    .exist-gallery-item-body { padding: 10px; }
    .exist-gallery-input {
        width: 100%; border-radius: 8px; padding: 5px 8px;
        border: 1.5px solid #E2E8F0; font-size: 0.72rem;
        font-family: inherit; outline: none; background: #fff;
        text-align: center; margin-bottom: 7px;
    }
    .exist-gallery-input:focus { border-color: #4EB8CC; box-shadow: 0 0 0 2px rgba(78,184,204,0.12); }
    .exist-gallery-actions { display: flex; gap: 6px; }
    .btn-exist-update {
        flex: 1; display:inline-flex; align-items:center; justify-content:center; gap:4px;
        background:rgba(14,122,150,0.08); color:#0E7A96;
        border:none; border-radius:7px; padding:5px;
        font-size:0.7rem; font-weight:700; cursor:pointer; transition:all 0.2s;
    }
    .btn-exist-update:hover { background:rgba(14,122,150,0.18); }
    .btn-exist-delete {
        flex: 1; display:inline-flex; align-items:center; justify-content:center; gap:4px;
        background:rgba(220,38,38,0.07); color:#DC2626;
        border:none; border-radius:7px; padding:5px;
        font-size:0.7rem; font-weight:700; cursor:pointer; transition:all 0.2s;
    }
    .btn-exist-delete:hover { background:rgba(220,38,38,0.15); }

    /* ============================================
       FORM ACTIONS
       ============================================ */
    .form-actions {
        display: flex; align-items: center; gap: 12px;
        padding: 20px 24px;
        background: #F8FAFC;
        border-top: 1px solid #F1F5F9;
        border-radius: 0 0 18px 18px;
    }
    .btn-submit {
        display:inline-flex; align-items:center; gap:7px;
        background:linear-gradient(135deg, #0E7A96, #4EB8CC);
        border:none; border-radius:12px; padding:11px 28px;
        font-weight:700; font-size:0.88rem; color:#fff;
        cursor:pointer; transition:all 0.3s;
    }
    .btn-submit:hover { transform:translateY(-2px); box-shadow:0 8px 20px rgba(14,122,150,0.3); }
    .btn-cancel {
        display:inline-flex; align-items:center; gap:7px;
        background:#fff; border:1.5px solid #E2E8F0; border-radius:12px;
        padding:10px 22px; font-weight:600; font-size:0.88rem;
        color:#64748B; text-decoration:none; transition:all 0.2s;
    }
    .btn-cancel:hover { background:#F1F5F9; color:#475569; text-decoration:none; }

    /* Alert */
    .alert-custom {
        border-radius:12px; font-size:0.85rem; padding:12px 16px;
        border:none; margin-bottom:20px;
        display:flex; align-items:center; gap:8px;
    }
    .alert-custom.error   { background:#FEE2E2; color:#991B1B; }
    .alert-custom.success { background:#D1FAE5; color:#065F46; }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    <?php if($errors->any()): ?>
        <div class="alert-custom error">
            <i class="fas fa-exclamation-triangle"></i>
            Terdapat <?php echo e($errors->count()); ?> kesalahan. Silakan periksa kembali formulir di bawah.
        </div>
    <?php endif; ?>

    <?php if(session('success')): ?>
        <div class="alert-custom success">
            <i class="fas fa-check-circle"></i> <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    
    <form action="<?php echo e(route('apparel.products.update', $product)); ?>" method="POST" enctype="multipart/form-data" id="mainForm">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        
        <p class="sec-label">Informasi Produk</p>
        <div class="row g-3 mb-2">

            
            <div class="col-lg-8">
                <div class="form-card">
                    <div class="form-card-header">
                        <div class="form-card-header-icon" style="background:#EEF9FC; color:#0E7A96;">
                            <i class="fas fa-box"></i>
                        </div>
                        <div>
                            <div class="form-card-header-title">Detail Produk</div>
                            <div class="form-card-header-sub">Nama dan deskripsi produk</div>
                        </div>
                    </div>
                    <div class="form-card-body">
                        <div class="mb-3">
                            <label class="form-label-custom">Nama Produk <span class="required">*</span></label>
                            <input type="text" name="name"
                                   class="form-control-custom <?php echo e($errors->has('name') ? 'is-invalid' : ''); ?>"
                                   value="<?php echo e(old('name', $product->name)); ?>"
                                   placeholder="Masukkan nama produk..." required>
                            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-msg"><i class="fas fa-exclamation-circle"></i> <?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div>
                            <label class="form-label-custom">Deskripsi Produk</label>
                            <textarea name="description"
                                      class="form-control-custom <?php echo e($errors->has('description') ? 'is-invalid' : ''); ?>"
                                      placeholder="Tuliskan deskripsi singkat produk..."><?php echo e(old('description', $product->description)); ?></textarea>
                            <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-msg"><i class="fas fa-exclamation-circle"></i> <?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="col-lg-4">
                <div class="form-card">
                    <div class="form-card-header">
                        <div class="form-card-header-icon" style="background:#D1FAE5; color:#059669;">
                            <i class="fas fa-sliders-h"></i>
                        </div>
                        <div>
                            <div class="form-card-header-title">Pengaturan</div>
                            <div class="form-card-header-sub">Kategori, tipe, harga & stok</div>
                        </div>
                    </div>
                    <div class="form-card-body">
                        <div class="mb-3">
                            <label class="form-label-custom">Kategori <span class="required">*</span></label>
                            <select name="category_id" class="form-control-custom" required>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category->id); ?>"
                                        <?php echo e(old('category_id', $product->category_id) == $category->id ? 'selected' : ''); ?>>
                                        <?php echo e($category->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label-custom">Tipe Produk <span class="required">*</span></label>
                            <select name="type" id="type" class="form-control-custom" required>
                                <option value="other" <?php echo e(old('type', $product->type) == 'other' ? 'selected' : ''); ?>>Produk Biasa</option>
                                <option value="kaos"  <?php echo e(old('type', $product->type) == 'kaos'  ? 'selected' : ''); ?>>Kaos (Dengan Edisi/Varian)</option>
                            </select>
                        </div>
                        <div class="row g-2">
                            <div class="col-6">
                                <label class="form-label-custom">Harga <span class="required">*</span></label>
                                <div class="input-prefix-wrap">
                                    <span class="input-prefix">Rp</span>
                                    <input type="number" name="price"
                                           class="form-control-custom <?php echo e($errors->has('price') ? 'is-invalid' : ''); ?>"
                                           value="<?php echo e(old('price', $product->price)); ?>"
                                           placeholder="0" min="0" required>
                                </div>
                                <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-msg"><i class="fas fa-exclamation-circle"></i> <?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="col-6">
                                <label class="form-label-custom">Stok <span class="required">*</span></label>
                                <input type="number" name="stock"
                                       class="form-control-custom <?php echo e($errors->has('stock') ? 'is-invalid' : ''); ?>"
                                       value="<?php echo e(old('stock', $product->stock)); ?>"
                                       placeholder="0" min="0" required>
                                <?php $__errorArgs = ['stock'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-msg"><i class="fas fa-exclamation-circle"></i> <?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <p class="sec-label">Gambar Produk</p>
        <div class="row g-3 mb-2">

            
            <div class="col-lg-4">
                <div class="form-card">
                    <div class="form-card-header">
                        <div class="form-card-header-icon" style="background:#FEF3C7; color:#D97706;">
                            <i class="fas fa-image"></i>
                        </div>
                        <div>
                            <div class="form-card-header-title">Gambar Utama</div>
                            <div class="form-card-header-sub">Kosongkan jika tidak ingin mengubah</div>
                        </div>
                    </div>
                    <div class="form-card-body">
                        <?php if($product->image): ?>
                            <div class="mb-3">
                                <div class="form-label-custom" style="margin-bottom:8px;">Gambar Saat Ini</div>
                                <div class="current-image-wrap">
                                    <img src="<?php echo e(asset('storage/'.$product->image)); ?>" alt="<?php echo e($product->name); ?>">
                                    <div class="current-image-badge">Gambar aktif</div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="file-upload-area" id="mainImageArea">
                            <input type="file" name="image" id="mainImageInput" accept="image/*">
                            <div class="file-upload-icon"><i class="fas fa-cloud-upload-alt"></i></div>
                            <div class="file-upload-text">Klik untuk ganti gambar</div>
                            <div class="file-upload-hint">JPG, PNG — Maks. 2MB</div>
                            <img id="mainImagePreview" class="file-preview" alt="Preview">
                        </div>
                        <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-msg mt-2"><i class="fas fa-exclamation-circle"></i> <?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
            </div>

            
            <div class="col-lg-8">
                <div class="form-card">
                    <div class="form-card-header">
                        <div class="form-card-header-icon" style="background:#F1F5F9; color:#475569;">
                            <i class="fas fa-plus-circle"></i>
                        </div>
                        <div>
                            <div class="form-card-header-title">Tambah Foto Galeri</div>
                            <div class="form-card-header-sub">Upload foto baru ke galeri produk</div>
                        </div>
                    </div>
                    <div class="form-card-body">
                        <div class="field-hint mb-3">
                            <i class="fas fa-info-circle"></i>
                            Upload foto dengan variasi motif/warna berbeda dan beri label untuk setiap foto.
                        </div>
                        <div id="galleryContainer"></div>
                        <button type="button" class="btn-add-gallery" id="addGalleryRow">
                            <i class="fas fa-plus"></i> Tambah Foto Galeri
                        </button>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="form-card">
            <div class="form-actions">
                <button type="submit" class="btn-submit">
                    <i class="fas fa-save"></i> Update Produk
                </button>
                <a href="<?php echo e(route('apparel.products.index')); ?>" class="btn-cancel">
                    <i class="fas fa-times"></i> Batal
                </a>
            </div>
        </div>

    </form>
    


    
    <?php if(isset($product->images) && $product->images->count() > 0): ?>
        <p class="sec-label mt-2">Galeri Saat Ini</p>
        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-header-icon" style="background:#EEF9FC; color:#0E7A96;">
                    <i class="fas fa-images"></i>
                </div>
                <div>
                    <div class="form-card-header-title">Foto Galeri Aktif</div>
                    <div class="form-card-header-sub"><?php echo e($product->images->count()); ?> foto tersimpan — edit label atau hapus</div>
                </div>
            </div>
            <div class="form-card-body">
                <div class="exist-gallery-grid">
                    <?php $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="exist-gallery-item">
                            <img src="<?php echo e(asset('storage/'.$img->image)); ?>" alt="<?php echo e($img->label); ?>">
                            <div class="exist-gallery-item-body">

                                
                                <form action="<?php echo e(route('apparel.products.updateImageLabel', $img->id)); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <input type="text" name="label"
                                           value="<?php echo e($img->label); ?>"
                                           class="exist-gallery-input"
                                           placeholder="Label foto...">
                                    <div class="exist-gallery-actions">
                                        <button type="submit" class="btn-exist-update">
                                            <i class="fas fa-check"></i> Simpan
                                        </button>

                                        
                                        <button type="button"
                                                class="btn-exist-delete"
                                                onclick="deleteImage(<?php echo e($img->id); ?>)">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>

        
        <?php $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <form id="deleteImageForm<?php echo e($img->id); ?>"
                  action="<?php echo e(route('apparel.products.deleteImage', $img->id)); ?>"
                  method="POST" style="display:none;">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
            </form>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
    

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script>
    /* ── Preview gambar utama ── */
    document.getElementById('mainImageInput').addEventListener('change', function () {
        const file = this.files[0];
        if (!file) return;
        const preview = document.getElementById('mainImagePreview');
        preview.src = URL.createObjectURL(file);
        preview.style.display = 'block';
        document.querySelector('#mainImageArea .file-upload-text').textContent = file.name;
    });

    /* ── Gallery builder ── */
    let galleryCount = 0;

    function createGalleryItem(num) {
        const item = document.createElement('div');
        item.className = 'gallery-item';
        item.innerHTML = `
            <div class="gallery-item-label-row">
                <span class="gallery-item-num">${num}</span>
                <span class="gallery-item-title">Foto #${num}</span>
                <button type="button" class="btn-remove-gallery" onclick="removeGallery(this)">
                    <i class="fas fa-trash"></i> Hapus
                </button>
            </div>
            <div class="row g-2">
                <div class="col-md-6">
                    <label class="form-label-custom">Foto</label>
                    <input type="file" name="gallery_images[]" class="form-control-custom"
                           style="padding:7px 12px; cursor:pointer;" accept="image/*">
                </div>
                <div class="col-md-6">
                    <label class="form-label-custom">Label <span style="color:#94A3B8;font-weight:400;">(Motif/Warna)</span></label>
                    <input type="text" name="gallery_labels[]" class="form-control-custom"
                           placeholder="Contoh: Motif A - Hitam">
                </div>
            </div>
        `;
        return item;
    }

    function removeGallery(btn) {
        btn.closest('.gallery-item').remove();
        renumberGallery();
    }

    function renumberGallery() {
        document.querySelectorAll('#galleryContainer .gallery-item').forEach((item, i) => {
            const n = i + 1;
            item.querySelector('.gallery-item-num').textContent = n;
            item.querySelector('.gallery-item-title').textContent = `Foto #${n}`;
        });
    }

    document.getElementById('addGalleryRow').addEventListener('click', function () {
        galleryCount++;
        document.getElementById('galleryContainer').appendChild(createGalleryItem(galleryCount));
    });

    /* ── Hapus foto galeri existing ── */
    function deleteImage(id) {
        if (!confirm('Yakin ingin menghapus foto ini?')) return;
        document.getElementById('deleteImageForm' + id).submit();
    }
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\qofmedia-web\resources\views/apparel/products/edit.blade.php ENDPATH**/ ?>