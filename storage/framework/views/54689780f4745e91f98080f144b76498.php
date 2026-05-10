

<?php $__env->startSection('title', $product->name); ?>

<?php $__env->startPush('styles'); ?>
<style>
    body { padding-top: 0 !important; }

    .breadcrumb-section { background: #F8FAFC; padding: 16px 0; border-bottom: 1px solid #E2E8F0; }
    .breadcrumb { margin-bottom: 0; }
    .breadcrumb-item a { color: #64748B; text-decoration: none; font-size: 0.85rem; }
    .breadcrumb-item a:hover { color: #0E7A96; }
    .breadcrumb-item.active { color: #0E7A96; font-size: 0.85rem; font-weight: 500; }

    .detail-section { padding: 60px 0 80px; background: #fff; }
    .btn-back { display: inline-flex; align-items: center; gap: 8px; color: #64748B; text-decoration: none; font-weight: 500; font-size: 0.9rem; margin-bottom: 28px; }
    .btn-back:hover { color: #0E7A96; }

    .product-gallery { margin-bottom: 20px; }
    .main-image-wrapper {
        border-radius: 20px; overflow: hidden; border: 1px solid #E2E8F0;
        aspect-ratio: 1/1; position: relative; background: #F8FAFC;
    }
    .main-image-wrapper img { width: 100%; height: 100%; object-fit: cover; display: block; }
    .placeholder-detail-img { width: 100%; height: 100%; background: linear-gradient(135deg, #EEF2FF, #E0E7FF); display: flex; align-items: center; justify-content: center; }
    .placeholder-detail-img i { font-size: 80px; color: #0E7A96; opacity: 0.3; }

    .thumbnail-strip { display: flex; gap: 12px; margin-top: 14px; overflow-x: auto; padding-bottom: 6px; }
    .thumbnail-wrapper { text-align: center; flex-shrink: 0; }
    .thumbnail-item {
        width: 72px; height: 72px; border-radius: 12px; overflow: hidden;
        cursor: pointer; border: 2px solid #E2E8F0; transition: all 0.2s; position: relative;
    }
    .thumbnail-item img { width: 100%; height: 100%; object-fit: cover; }
    .thumbnail-item.active { border-color: #0E7A96; box-shadow: 0 0 0 3px rgba(14,122,150,0.2); }
    .thumbnail-item.disabled { opacity: 0.35; cursor: not-allowed; }
    .thumbnail-item .oos-badge {
        position: absolute; inset: 0; background: rgba(0,0,0,0.55);
        display: none; align-items: center; justify-content: center;
        color: white; font-size: 0.6rem; font-weight: 700;
    }
    .thumbnail-item.disabled .oos-badge { display: flex; }
    .thumbnail-label { font-size: 0.68rem; margin-top: 5px; color: #64748B; max-width: 72px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }

    .product-info-card { background: white; border-radius: 20px; padding: 32px; box-shadow: 0 10px 40px rgba(0,0,0,0.04); border: 1px solid #E2E8F0; }
    .badge-category { display: inline-block; padding: 6px 14px; border-radius: 50px; font-size: 0.78rem; font-weight: 600; margin-bottom: 16px; }
    .badge-category.main { background: rgba(14,122,150,0.1); color: #0E7A96; }
    .badge-category.type { background: #FEF3C7; color: #92400E; }
    .product-title-detail { font-weight: 800; color: #0D1B2A; margin-bottom: 4px; font-size: 1.6rem; }
    .sold-info { font-size: 0.8rem; color: #94A3B8; margin-bottom: 8px; }
    .product-price-large { font-size: 2rem; font-weight: 700; color: #0E7A96; margin-bottom: 16px; }

    .variant-section { margin-bottom: 18px; }
    .variant-label { font-weight: 600; font-size: 0.8rem; color: #0D1B2A; margin-bottom: 8px; display: flex; align-items: center; gap: 8px; }
    .variant-label .selected-value { font-weight: 400; color: #0E7A96; }
    .variant-pills { display: flex; flex-wrap: wrap; gap: 8px; }
    .variant-pill {
        border: 1.5px solid #E2E8F0; background: white; padding: 10px 18px;
        border-radius: 10px; cursor: pointer; font-size: 0.82rem; font-weight: 500;
        transition: all 0.2s; color: #475569; text-align: center; min-width: 50px;
    }
    .variant-pill:hover { border-color: #4EB8CC; }
    .variant-pill.active { border-color: #0E7A96; background: rgba(14,122,150,0.05); color: #0E7A96; font-weight: 600; }
    .variant-pill.disabled { opacity: 0.35; cursor: not-allowed; text-decoration: line-through; pointer-events: none; }
    .color-dot { width: 18px; height: 18px; border-radius: 50%; display: inline-block; border: 2px solid rgba(0,0,0,0.1); margin-right: 6px; vertical-align: middle; }

    .stock-info-bar { display: flex; align-items: center; gap: 12px; padding: 12px 16px; background: #F8FAFC; border-radius: 12px; margin: 16px 0; }
    .stock-tag { display: inline-flex; align-items: center; gap: 5px; padding: 5px 12px; border-radius: 6px; font-size: 0.8rem; font-weight: 600; }
    .stock-tag.ready { background: #D1FAE5; color: #065F46; }
    .stock-tag.low { background: #FEF3C7; color: #92400E; }
    .stock-tag.out { background: #FEE2E2; color: #991B1B; }

    .divider { border-top: 1px solid #E2E8F0; margin: 20px 0; }
    .description-title { font-weight: 700; color: #0D1B2A; margin-bottom: 12px; font-size: 1.05rem; }
    .description-text { color: #64748B; line-height: 1.9; font-size: 0.95rem; margin-bottom: 24px; }

    .action-buttons { display: flex; gap: 12px; flex-wrap: wrap; margin-top: 20px; }
    .btn-order { background: linear-gradient(135deg, #0E7A96, #4EB8CC); color: white; border: none; border-radius: 50px; padding: 14px 32px; font-weight: 600; font-size: 1rem; cursor: pointer; display: inline-flex; align-items: center; gap: 8px; }
    .btn-order:hover { background: #0A4A60; color: white; }
    .btn-back-outline { border: 1.5px solid #E2E8F0; background: white; color: #475569; border-radius: 50px; padding: 14px 24px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; }
    .btn-back-outline:hover { border-color: #0E7A96; color: #0E7A96; }

    .related-section { margin-top: 60px; padding-top: 40px; border-top: 1px solid #E2E8F0; }
    .related-title { font-weight: 800; color: #0D1B2A; margin-bottom: 24px; font-size: 1.4rem; }
    .related-card { background: white; border-radius: 16px; overflow: hidden; border: 1px solid #E2E8F0; transition: all 0.3s; }
    .related-card:hover { transform: translateY(-5px); box-shadow: 0 16px 40px rgba(14,122,150,0.1); border-color: #4EB8CC; }
    .related-card-img { aspect-ratio: 1/1; overflow: hidden; }
    .related-card-img img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s; }
    .related-card:hover .related-card-img img { transform: scale(1.05); }
    .related-placeholder { aspect-ratio: 1/1; background: linear-gradient(135deg, #EEF2FF, #E0E7FF); display: flex; align-items: center; justify-content: center; }
    .related-placeholder i { font-size: 36px; color: #0E7A96; opacity: 0.3; }
    .related-card .card-body { padding: 14px 16px; }
    .related-card .card-title { font-weight: 700; color: #0D1B2A; font-size: 0.9rem; }
    .related-card .card-price { font-weight: 700; color: #0E7A96; font-size: 0.9rem; }

    .modal .form-control { border: 1.5px solid #E2E8F0; border-radius: 10px; padding: 10px 14px; font-size: 0.9rem; }
    .modal .form-control:focus { border-color: #4EB8CC; box-shadow: 0 0 0 3px rgba(78,184,204,0.1); }
    .btn-cancel-modal { border: 1.5px solid #E2E8F0; background: white; color: #475569; border-radius: 50px; padding: 10px 24px; font-weight: 600; }
    .btn-submit-modal { background: linear-gradient(135deg, #0E7A96, #4EB8CC); color: white; border: none; border-radius: 50px; padding: 10px 24px; font-weight: 600; }

    @media (max-width: 768px) {
        .detail-section { padding: 40px 0 60px; }
        .product-title-detail { font-size: 1.3rem; }
        .product-price-large { font-size: 1.5rem; }
        .action-buttons { flex-direction: column; }
        .btn-order, .btn-back-outline { justify-content: center; width: 100%; }
        .product-info-card { padding: 20px; }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>


<section class="breadcrumb-section">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Beranda</a></li>
                <li class="breadcrumb-item"><a href="<?php echo e(route('service.apparel')); ?>">Qof Apparel</a></li>
                <li class="breadcrumb-item active"><?php echo e($product->name); ?></li>
            </ol>
        </nav>
    </div>
</section>


<section class="detail-section">
    <div class="container">
        <a href="<?php echo e(route('service.apparel')); ?>" class="btn-back">
            <i class="bi bi-arrow-left"></i> Kembali ke Daftar Produk
        </a>

        <div class="row g-5">
            
            <div class="col-lg-5">
                <div class="product-gallery">
                    <div class="main-image-wrapper" id="mainImageWrapper">
                        <?php
                            $firstImage = $product->images->first();
                            $mainSrc = $firstImage ? asset('storage/'.$firstImage->image) : ($product->image ? asset('storage/'.$product->image) : '');
                        ?>
                        <?php if($mainSrc): ?>
                            <img id="mainImage" src="<?php echo e($mainSrc); ?>" alt="<?php echo e($product->name); ?>">
                        <?php else: ?>
                            <div class="placeholder-detail-img"><i class="bi bi-box"></i></div>
                        <?php endif; ?>
                    </div>

                    <?php if($product->images->count() > 0): ?>
                        <div class="thumbnail-strip" id="thumbnailStrip">
                            <?php $__currentLoopData = $product->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="thumbnail-wrapper">
                                    <div class="thumbnail-item <?php echo e($loop->first ? 'active' : ''); ?>"
                                         data-image="<?php echo e(asset('storage/'.$img->image)); ?>"
                                         data-label="<?php echo e($img->label); ?>"
                                         onclick="switchImage(this)">
                                        <img src="<?php echo e(asset('storage/'.$img->image)); ?>" alt="<?php echo e($img->label); ?>">
                                        <div class="oos-badge">Habis</div>
                                    </div>
                                    <?php if($img->label): ?>
                                        <div class="thumbnail-label"><?php echo e($img->label); ?></div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            
            <div class="col-lg-7">
                <div class="product-info-card">
                    <div class="mb-2">
                        <span class="badge-category main"><?php echo e($product->category->name ?? 'Produk'); ?></span>
                        <?php if($product->type == 'kaos'): ?>
                            <span class="badge-category type ms-2">Kaos</span>
                        <?php endif; ?>
                    </div>

                    <h1 class="product-title-detail"><?php echo e($product->name); ?></h1>
                    <div class="sold-info">10RB+ Terjual</div>
                    <div class="product-price-large" id="productPrice">Rp <?php echo e(number_format($product->price, 0, ',', '.')); ?></div>

                    <?php if($product->type === 'kaos' && $editions->count() > 0): ?>
                        
                        <div class="variant-section">
                            <span class="variant-label">Series: <span class="selected-value" id="selEditionLabel">Pilih</span></span>
                            <div class="variant-pills">
                                <?php $__currentLoopData = $editions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $edition): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <button class="variant-pill edition-pill" data-edition="<?php echo e($edition->id); ?>" onclick="selectEdition('<?php echo e($edition->id); ?>', this)"><?php echo e($edition->name); ?></button>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>

                        
                        <div class="variant-section">
                            <span class="variant-label">Motif: <span class="selected-value" id="selModelLabel">Pilih</span></span>
                            <div class="variant-pills" id="modelPills">
                                <?php $__currentLoopData = $models; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $model): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <button class="variant-pill model-pill"
                                            data-model="<?php echo e($model->id); ?>"
                                            data-edition="<?php echo e($model->edition_id); ?>"
                                            data-image="<?php echo e($model->design_image ? asset('storage/'.$model->design_image) : ''); ?>"
                                            onclick="selectModel('<?php echo e($model->id); ?>', this)"
                                            style="display:none;"><?php echo e($model->name); ?></button>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>

                        
                        <div class="variant-section">
                            <span class="variant-label">Warna: <span class="selected-value" id="selColorLabel">Pilih</span></span>
                            <div class="variant-pills" id="colorPills">
                                <?php $__currentLoopData = $colors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <button class="variant-pill color-pill" data-color="<?php echo e($color); ?>" onclick="selectColor('<?php echo e($color); ?>', this)">
                                        <span class="color-dot" style="background:<?php echo e(strtolower($color)); ?>;"></span><?php echo e(ucfirst($color)); ?>

                                    </button>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>

                        
                        <div class="variant-section">
                            <span class="variant-label">Ukuran: <span class="selected-value" id="selSizeLabel">Pilih</span></span>
                            <div class="variant-pills" id="sizePills">
                                <?php $__currentLoopData = $sizes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $size): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <button class="variant-pill size-pill" data-size="<?php echo e($size); ?>" onclick="selectSize('<?php echo e($size); ?>', this)"><?php echo e($size); ?></button>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>

                        
                        <div class="variant-section">
                            <span class="variant-label">Lengan:</span>
                            <div class="variant-pills">
                                <button class="variant-pill sleeve-pill active" data-sleeve="pendek" onclick="selectSleeve('pendek', this)">Pendek</button>
                                <button class="variant-pill sleeve-pill" data-sleeve="panjang" onclick="selectSleeve('panjang', this)">Panjang</button>
                            </div>
                        </div>

                        <div class="stock-info-bar" id="stockInfoBar">
                            <span class="stock-tag out" id="stockTag">Pilih varian</span>
                            <span class="ms-auto text-muted small" id="variantPriceDisplay"></span>
                        </div>
                    <?php else: ?>
                        <div class="stock-info-bar">
                            <span class="stock-tag <?php echo e($product->stock > 0 ? 'ready' : 'out'); ?>">
                                <?php echo e($product->stock > 0 ? 'Stok: '.$product->stock.' pcs' : 'Stok Habis'); ?>

                            </span>
                        </div>
                    <?php endif; ?>

                    <div class="divider"></div>
                    <h5 class="description-title">Deskripsi</h5>
                    <p class="description-text"><?php echo e($product->description ?: 'Tidak ada deskripsi.'); ?></p>

                    <div class="action-buttons">
                        <?php if(auth()->guard()->check()): ?>
                            <button type="button" class="btn-order" data-bs-toggle="modal" data-bs-target="#orderModal">
                                <i class="bi bi-cart-plus"></i> Pesan Sekarang
                            </button>
                        <?php else: ?>
                            <a href="<?php echo e(route('login')); ?>" class="btn-order">
                                <i class="bi bi-box-arrow-in-right"></i> Login untuk Memesan
                            </a>
                        <?php endif; ?>
                        <a href="<?php echo e(route('service.apparel')); ?>" class="btn-back-outline">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>

        
        <?php if(isset($relatedProducts) && $relatedProducts->count() > 0): ?>
            <div class="related-section">
                <h3 class="related-title">Produk Terkait</h3>
                <div class="row g-4">
                    <?php $__currentLoopData = $relatedProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $related): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-3 col-6">
                            <a href="<?php echo e(route('apparel.product.show', $related->id)); ?>" class="text-decoration-none">
                                <div class="related-card">
                                    <div class="related-card-img">
                                        <?php if($related->image): ?>
                                            <img src="<?php echo e(asset('storage/' . $related->image)); ?>" alt="<?php echo e($related->name); ?>" loading="lazy">
                                        <?php else: ?>
                                            <div class="related-placeholder"><i class="bi bi-box"></i></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="card-body">
                                        <h6 class="card-title"><?php echo e($related->name); ?></h6>
                                        <p class="card-price mb-0">Rp <?php echo e(number_format($related->price, 0, ',', '.')); ?></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php endif; ?>

    </div>
</section>


<?php if(auth()->guard()->check()): ?>
<div class="modal fade" id="orderModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 rounded-4">
            <form action="<?php echo e(route('order.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
                <input type="hidden" name="variant_id" id="modalVariantId">
                <div class="modal-header px-4 pt-4 pb-3 border-0">
                    <h5 class="modal-title fw-bold"><i class="bi bi-cart-plus me-2" style="color:#0E7A96;"></i>Form Pemesanan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body px-4">
                    <div class="alert" style="background:#F0FDFA; border:1px solid #99F6E4; border-radius:12px; padding:12px 16px;">
                        <strong>Pesanan:</strong>
                        <div id="orderSummary" class="mt-1 small text-muted"><?php echo e($product->name); ?></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Nama <span class="text-danger">*</span></label>
                            <input type="text" name="pemesan_name" class="form-control" value="<?php echo e(Auth::user()->name); ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">HP/WA <span class="text-danger">*</span></label>
                            <input type="text" name="pemesan_phone" class="form-control" value="<?php echo e(Auth::user()->phone); ?>" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Alamat <span class="text-danger">*</span></label>
                        <textarea name="alamat" class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Jumlah</label>
                            <input type="number" name="qty" id="modalQty" class="form-control" min="1" value="1" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Total</label>
                            <input type="text" id="modalTotal" class="form-control bg-light" readonly value="Rp <?php echo e(number_format($product->price, 0, ',', '.')); ?>">
                        </div>
                    </div>
                    <div class="mb-2">
                        <label class="form-label fw-semibold">Catatan</label>
                        <textarea name="catatan_user" class="form-control" rows="2" placeholder="..."></textarea>
                    </div>
                </div>
                <div class="modal-footer px-4 pb-4 pt-3 border-0">
                    <button type="button" class="btn-cancel-modal" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-submit-modal"><i class="bi bi-send me-2"></i> Kirim Pesanan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    const variants = <?php echo json_encode($variants, 15, 512) ?>;
    const lc = (s) => (s || '').trim().toLowerCase();

    let selEdition = null, selModel = null, selColor = null, selSize = null, selSleeve = 'pendek';

    function selectEdition(id, btn) {
        document.querySelectorAll('.edition-pill').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        selEdition = id;
        document.getElementById('selEditionLabel').textContent = btn.textContent.trim();

        // Tampilkan hanya motif dari edition ini
        document.querySelectorAll('.model-pill').forEach(b => {
            b.style.display = b.dataset.edition == id ? '' : 'none';
            b.classList.remove('active');
        });

        selModel = null; selColor = null; selSize = null;
        document.getElementById('selModelLabel').textContent = 'Pilih';
        document.getElementById('selColorLabel').textContent = 'Pilih';
        document.getElementById('selSizeLabel').textContent  = 'Pilih';
        updateAll();
    }

    function selectModel(id, btn) {
        document.querySelectorAll('.model-pill').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        selModel = id;
        document.getElementById('selModelLabel').textContent = btn.textContent.trim();
        if (btn.dataset.image) switchMainImage(btn.dataset.image);
        updateAll();
    }

    function selectColor(color, btn) {
        document.querySelectorAll('.color-pill').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        selColor = color;
        document.getElementById('selColorLabel').textContent = color;
        updateAll();
    }

    function selectSize(size, btn) {
        document.querySelectorAll('.size-pill').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        selSize = size;
        document.getElementById('selSizeLabel').textContent = size;
        updateAll();
    }

    function selectSleeve(sleeve, btn) {
        document.querySelectorAll('.sleeve-pill').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        selSleeve = sleeve;
        updateAll();
    }

    function switchMainImage(src) {
        const img = document.getElementById('mainImage');
        if (img) img.src = src;
    }

    function switchImage(item) {
        if (item.classList.contains('disabled')) return;
        document.querySelectorAll('.thumbnail-item').forEach(t => t.classList.remove('active'));
        item.classList.add('active');
        switchMainImage(item.dataset.image);
    }

    function updateAll() {
        // --- Size pills: disable jika tidak ada stok untuk kombinasi model+warna+sleeve ---
        document.querySelectorAll('.size-pill').forEach(btn => {
            const hasStock = variants.some(v =>
                (selModel ? v.model_id == selModel : true) &&
                (selColor ? lc(v.color) === lc(selColor) : true) &&
                v.size === btn.dataset.size &&
                v.sleeve_type === selSleeve &&
                v.stock > 0
            );
            btn.classList.toggle('disabled', (selModel || selColor) && !hasStock);
        });

        // --- Color pills: disable jika tidak ada stok untuk kombinasi model+ukuran+sleeve ---
        document.querySelectorAll('.color-pill').forEach(btn => {
            const hasStock = variants.some(v =>
                (selModel ? v.model_id == selModel : true) &&
                (selSize ? v.size === selSize : true) &&
                v.sleeve_type === selSleeve &&
                lc(v.color) === lc(btn.dataset.color) &&
                v.stock > 0
            );
            btn.classList.toggle('disabled', (selModel || selSize) && !hasStock);
        });

        // --- Thumbnail: disable HANYA jika warna tersebut habis total (tanpa peduli size/sleeve) ---
        document.querySelectorAll('.thumbnail-item').forEach(item => {
            const label = item.dataset.label || '';
            const parts = label.split('-').map(s => s.trim());
            const labelWarna = parts.length > 1 ? parts[parts.length - 1] : label;

            // Cek apakah warna ini masih punya stok di varian manapun
            const hasAnyStock = variants.some(v =>
                (selModel ? v.model_id == selModel : true) &&
                lc(v.color) === lc(labelWarna) &&
                v.stock > 0
            );

            item.classList.toggle('disabled', !hasAnyStock);
        });

        // --- Cari varian yang cocok ---
        const v = variants.find(v =>
            (selModel ? v.model_id == selModel : true) &&
            (selColor ? lc(v.color) === lc(selColor) : true) &&
            (selSize ? v.size === selSize : true) &&
            v.sleeve_type === selSleeve
        );

        const stockTag       = document.getElementById('stockTag');
        const priceDisplay   = document.getElementById('variantPriceDisplay');
        const priceEl        = document.getElementById('productPrice');
        const modalVariant   = document.getElementById('modalVariantId');
        const modalQty       = document.getElementById('modalQty');

        if (v) {
            stockTag.textContent  = v.stock > 0 ? 'Stok: ' + v.stock + ' pcs' : 'Stok Habis';
            stockTag.className    = 'stock-tag ' + (v.stock > 5 ? 'ready' : v.stock > 0 ? 'low' : 'out');
            priceDisplay.textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(v.price);
            priceEl.textContent      = 'Rp ' + new Intl.NumberFormat('id-ID').format(v.price);
            if (modalVariant) modalVariant.value = v.id;
            if (modalQty)     modalQty.max = v.stock;
            updateModalTotal(v.price);
        } else {
            stockTag.textContent  = 'Pilih varian';
            stockTag.className    = 'stock-tag out';
            priceDisplay.textContent = '';
            if (modalVariant) modalVariant.value = '';
        }

        updateOrderSummary();
    }

    function updateOrderSummary() {
        let text = '<?php echo e($product->name); ?>';
        <?php if($product->type === 'kaos'): ?>
            if (selEdition) text += ' | Series: ' + (document.querySelector('.edition-pill.active')?.textContent?.trim() || '');
            if (selModel)   text += ' | Motif: '  + (document.querySelector('.model-pill.active')?.textContent?.trim() || '');
            if (selColor)   text += ' | Warna: '  + selColor;
            if (selSize)    text += ' | Size: '   + selSize;
            text += ' | Lengan: ' + (selSleeve === 'pendek' ? 'Pendek' : 'Panjang');
        <?php endif; ?>
        const el = document.getElementById('orderSummary');
        if (el) el.textContent = text;
    }

    document.getElementById('modalQty')?.addEventListener('input', function () {
        updateModalTotal();
    });

    function updateModalTotal(priceOverride) {
        const qty = parseInt(document.getElementById('modalQty')?.value) || 1;
        let price = priceOverride || <?php echo e($product->price); ?>;
        <?php if($product->type === 'kaos'): ?>
            const v = variants.find(v =>
                (selModel ? v.model_id == selModel : true) &&
                lc(v.color) === lc(selColor || '') &&
                v.size === selSize &&
                v.sleeve_type === selSleeve
            );
            if (v) price = v.price;
        <?php endif; ?>
        const totalEl = document.getElementById('modalTotal');
        if (totalEl) totalEl.value = 'Rp ' + new Intl.NumberFormat('id-ID').format(qty * price);
    }
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\qofmedia-web\resources\views/public/service/apparel/product-show.blade.php ENDPATH**/ ?>