

<?php $__env->startSection('title', 'Form Penyewaan — ' . $tool->name); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .booking-hero {
        background: linear-gradient(135deg, #0D1B2A 0%, #1B3A4B 60%, #0E7A96 100%);
        padding: 90px 0 44px;
        margin-top: -75px;   /* cancel body padding-top from layout */
        color: #fff;
    }
    @media (max-width: 992px) {
        .booking-hero { margin-top: -65px; padding-top: 80px; }
    }
    .booking-hero h1 { font-size: 1.8rem; font-weight: 800; margin-bottom: 6px; }
    .booking-hero p  { color: rgba(255,255,255,0.7); font-size: 0.95rem; }

    /* ── Tool summary card ── */
    .tool-summary-card {
        background: rgba(255,255,255,0.08);
        border: 1px solid rgba(255,255,255,0.15);
        border-radius: 16px;
        padding: 18px 20px;
        display: flex;
        align-items: center;
        gap: 16px;
        margin-top: 28px;
    }
    .tool-summary-img {
        width: 64px; height: 64px;
        border-radius: 12px;
        object-fit: cover;
        flex-shrink: 0;
        border: 1px solid rgba(255,255,255,0.2);
    }
    .tool-summary-placeholder {
        width: 64px; height: 64px;
        border-radius: 12px;
        background: rgba(255,255,255,0.1);
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
        font-size: 1.6rem; color: rgba(255,255,255,0.5);
    }
    .tool-summary-name  { font-size: 1rem; font-weight: 700; margin-bottom: 4px; }
    .tool-summary-price { font-size: 0.85rem; color: rgba(255,255,255,0.7); }
    .tool-summary-price strong { color: #fff; }

    /* ── Form section ── */
    .booking-section { padding: 48px 0 80px; background: #F8FAFC; }

    .form-wrapper {
        background: #fff;
        border: 1px solid #E2E8F0;
        border-radius: 20px;
        overflow: hidden;
        max-width: 720px;
        margin: 0 auto;
    }

    .form-header {
        background: #F8FAFC;
        border-bottom: 1px solid #F1F5F9;
        padding: 18px 28px;
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .form-header-icon {
        width: 38px; height: 38px;
        background: rgba(14,122,150,0.1);
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        color: #0E7A96; font-size: 0.95rem; flex-shrink: 0;
    }
    .form-header-title    { font-size: 0.95rem; font-weight: 700; color: #0D1B2A; margin: 0; }
    .form-header-subtitle { font-size: 0.76rem; color: #94A3B8; margin: 1px 0 0; }
    .form-body { padding: 28px; }

    /* ── Labels & inputs ── */
    .f-label {
        font-size: 0.82rem;
        font-weight: 700;
        color: #374151;
        margin-bottom: 7px;
        display: flex; align-items: center; gap: 5px;
    }
    .f-label i   { color: #CBD5E1; font-size: 0.76rem; }
    .f-label .req { color: #EF4444; font-size: 0.78rem; }

    .f-input, .f-textarea, .f-select {
        width: 100%;
        border: 1.5px solid #E2E8F0;
        border-radius: 10px;
        padding: 10px 14px;
        font-size: 0.88rem;
        color: #0D1B2A;
        background: #F8FAFC;
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
    }
    .f-input:focus, .f-textarea:focus, .f-select:focus {
        border-color: #0E7A96;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(14,122,150,0.08);
    }
    .f-input.is-invalid, .f-textarea.is-invalid, .f-select.is-invalid { border-color: #EF4444; background: #FFF9F9; }
    .f-textarea { resize: vertical; min-height: 80px; }
    .f-error { font-size: 0.76rem; color: #EF4444; margin-top: 5px; display:flex; align-items:center; gap:4px; }
    .f-hint  { font-size: 0.75rem; color: #94A3B8; margin-top: 5px; display:flex; align-items:center; gap:4px; }

    .f-grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; }
    @media (max-width: 576px) { .f-grid-2 { grid-template-columns: 1fr; } .form-body { padding: 20px 16px; } }

    /* ── Section divider ── */
    .form-section-divider {
        display: flex; align-items: center; gap: 10px;
        margin: 28px 0 20px;
    }
    .form-section-divider span {
        font-size: 0.72rem; font-weight: 700; text-transform: uppercase;
        letter-spacing: 0.07em; color: #94A3B8; white-space: nowrap;
    }
    .form-section-divider::before, .form-section-divider::after {
        content:''; flex:1; height:1px; background:#F1F5F9;
    }

    /* ── Upload bukti transfer ── */
    .upload-zone {
        border: 2px dashed #CBD5E1;
        border-radius: 12px;
        padding: 28px 20px;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s;
        background: #F8FAFC;
        position: relative;
    }
    .upload-zone:hover, .upload-zone.drag-over {
        border-color: #0E7A96;
        background: #EEF9FC;
    }
    .upload-zone.has-file {
        border-color: #059669;
        background: #F0FDF4;
    }
    .upload-zone input[type="file"] {
        position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%;
    }
    .upload-icon { font-size: 2rem; color: #CBD5E1; margin-bottom: 8px; }
    .upload-zone.has-file .upload-icon { color: #059669; }
    .upload-text { font-size: 0.88rem; font-weight: 600; color: #64748B; margin-bottom: 4px; }
    .upload-zone.has-file .upload-text { color: #059669; }
    .upload-sub  { font-size: 0.75rem; color: #94A3B8; }
    .upload-preview {
        margin-top: 14px;
        display: none;
    }
    .upload-preview img {
        max-height: 160px;
        border-radius: 10px;
        border: 1px solid #E2E8F0;
        object-fit: contain;
    }

    /* ── Pilihan jaminan ── */
    .jaminan-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
    }
    @media (max-width: 480px) { .jaminan-grid { grid-template-columns: 1fr; } }

    .jaminan-option { position: relative; }
    .jaminan-option input[type="radio"] { position: absolute; opacity: 0; width: 0; height: 0; }
    .jaminan-label {
        display: flex; align-items: center; gap: 12px;
        border: 2px solid #E2E8F0;
        border-radius: 12px;
        padding: 14px 16px;
        cursor: pointer;
        transition: all 0.2s;
        background: #F8FAFC;
        user-select: none;
    }
    .jaminan-label:hover { border-color: #BAE6F5; background: #F0FAFF; }
    .jaminan-option input:checked + .jaminan-label {
        border-color: #0E7A96;
        background: #EEF9FC;
        box-shadow: 0 0 0 3px rgba(14,122,150,0.08);
    }
    .jaminan-icon {
        width: 38px; height: 38px; border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        background: #E2E8F0; color: #64748B; font-size: 1rem; flex-shrink: 0;
        transition: all 0.2s;
    }
    .jaminan-option input:checked + .jaminan-label .jaminan-icon {
        background: rgba(14,122,150,0.15); color: #0E7A96;
    }
    .jaminan-name  { font-size: 0.85rem; font-weight: 700; color: #0D1B2A; margin-bottom: 2px; }
    .jaminan-desc  { font-size: 0.72rem; color: #94A3B8; }
    .jaminan-check {
        width: 20px; height: 20px; border-radius: 50%;
        border: 2px solid #CBD5E1; margin-left: auto; flex-shrink: 0;
        display: flex; align-items: center; justify-content: center;
        transition: all 0.2s;
    }
    .jaminan-option input:checked + .jaminan-label .jaminan-check {
        background: #0E7A96; border-color: #0E7A96;
        color: #fff; font-size: 0.65rem;
    }

    /* ── Syarat & Ketentuan ── */
    .sk-box {
        background: #F8FAFC;
        border: 1.5px solid #E2E8F0;
        border-radius: 14px;
        overflow: hidden;
    }
    .sk-header {
        padding: 14px 18px;
        background: linear-gradient(135deg, #0D1B2A, #1a3a5c);
        color: #fff;
        display: flex; align-items: center; gap: 10px;
        cursor: pointer;
    }
    .sk-header-title { font-size: 0.88rem; font-weight: 700; flex: 1; }
    .sk-header-sub   { font-size: 0.72rem; color: rgba(255,255,255,0.6); margin-top: 1px; }
    .sk-chevron { transition: transform 0.3s; color: rgba(255,255,255,0.7); }
    .sk-header.open .sk-chevron { transform: rotate(180deg); }
    .sk-body {
        padding: 18px 20px;
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.4s ease, padding 0.3s;
        padding-top: 0; padding-bottom: 0;
    }
    .sk-body.open { max-height: 600px; padding: 18px 20px; }
    .sk-item {
        display: flex; gap: 10px; margin-bottom: 10px; font-size: 0.84rem; color: #374151; line-height: 1.6;
    }
    .sk-item:last-child { margin-bottom: 0; }
    .sk-num {
        min-width: 22px; height: 22px; border-radius: 50%;
        background: rgba(14,122,150,0.12); color: #0E7A96;
        font-size: 0.7rem; font-weight: 800;
        display: flex; align-items: center; justify-content: center; flex-shrink: 0; margin-top: 1px;
    }
    .sk-warning {
        background: #FEF3C7; border: 1px solid rgba(245,158,11,0.3);
        border-radius: 10px; padding: 10px 14px;
        font-size: 0.8rem; color: #92400E;
        display: flex; gap: 8px; align-items: flex-start; margin-top: 14px;
    }

    /* ── Checkbox setuju ── */
    .agree-box {
        display: flex; align-items: flex-start; gap: 12px;
        padding: 16px 18px;
        background: #F0FDF4;
        border: 2px solid #86EFAC;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.2s;
        margin-top: 14px;
    }
    .agree-box.is-invalid {
        background: #FFF9F9; border-color: #EF4444;
    }
    .agree-checkbox {
        width: 20px; height: 20px; border-radius: 6px;
        border: 2px solid #86EFAC; background: #fff;
        flex-shrink: 0; margin-top: 1px;
        display: flex; align-items: center; justify-content: center;
        transition: all 0.2s;
    }
    .agree-box input:checked ~ .agree-content .agree-checkbox,
    .agree-box.checked .agree-checkbox {
        background: #059669; border-color: #059669; color: #fff;
    }
    .agree-text { font-size: 0.84rem; color: #065F46; font-weight: 600; line-height: 1.5; }
    .agree-text span { color: #0E7A96; text-decoration: underline; cursor: pointer; }

    /* ── Total preview ── */
    .total-preview {
        background: #EEF9FC;
        border: 1.5px solid rgba(14,122,150,0.2);
        border-radius: 12px;
        padding: 16px 18px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
        margin: 20px 0 0;
    }
    .total-label { font-size: 0.82rem; font-weight: 600; color: #0D1B2A; }
    .total-label span { display: block; font-size: 0.75rem; color: #94A3B8; font-weight: 400; }
    .total-price { font-size: 1.2rem; font-weight: 800; color: #0E7A96; }

    /* ── Form actions ── */
    .form-actions {
        display: flex; gap: 10px; flex-wrap: wrap;
        padding: 20px 28px;
        background: #F8FAFC;
        border-top: 1px solid #F1F5F9;
    }
    .btn-submit {
        display: inline-flex; align-items: center; gap: 7px;
        background: #0E7A96; color: #fff;
        padding: 11px 28px; border-radius: 50px;
        font-weight: 700; font-size: 0.9rem; border: none; cursor: pointer;
        transition: all 0.2s;
    }
    .btn-submit:hover { background: #0a6278; transform: translateY(-1px); box-shadow: 0 6px 18px rgba(14,122,150,0.28); }
    .btn-back {
        display: inline-flex; align-items: center; gap: 7px;
        background: transparent; color: #64748B;
        padding: 11px 20px; border-radius: 50px;
        font-weight: 600; font-size: 0.9rem;
        border: 1.5px solid #E2E8F0; text-decoration: none; transition: all 0.2s;
    }
    .btn-back:hover { background: #F1F5F9; color: #0D1B2A; text-decoration: none; }

    /* ── Error summary ── */
    .error-summary {
        background: #FEE2E2; color: #991B1B;
        border-radius: 12px; padding: 12px 18px;
        font-size: 0.86rem; display: flex; align-items:flex-start; gap: 8px;
        margin: 0 28px 20px;
    }
    .error-summary ul { margin: 4px 0 0; padding-left: 18px; }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>


<div class="booking-hero">
    <div class="container">
        <p style="font-size:0.8rem; color:rgba(255,255,255,0.5); margin-bottom:4px;">
            <a href="<?php echo e(route('service.studio')); ?>" style="color:rgba(255,255,255,0.5); text-decoration:none;">Studio</a>
            <i class="bi bi-chevron-right" style="font-size:0.65rem; margin:0 4px;"></i>
            Form Penyewaan
        </p>
        <h1><i class="bi bi-calendar-check me-2"></i>Form Penyewaan</h1>
        <p>Isi form di bawah untuk memesan alat studio. Tim kami akan mengonfirmasi via HP Anda.</p>

        <div class="tool-summary-card">
            <?php if($tool->image): ?>
                <img src="<?php echo e(asset('storage/' . $tool->image)); ?>" class="tool-summary-img" alt="<?php echo e($tool->name); ?>">
            <?php else: ?>
                <div class="tool-summary-placeholder"><i class="bi bi-tools"></i></div>
            <?php endif; ?>
            <div>
                <div class="tool-summary-name"><?php echo e($tool->name); ?></div>
                <div class="tool-summary-price">
                    <strong>Rp <?php echo e(number_format($tool->price_per_day, 0, ',', '.')); ?></strong> / hari
                    &nbsp;·&nbsp; Stok: <?php echo e($tool->stock); ?> unit
                    &nbsp;·&nbsp; <span class="badge bg-success" style="font-size:0.7rem;">Tersedia</span>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="booking-section">
    <div class="container">

        <div class="form-wrapper">

            <?php if($errors->any()): ?>
                <div class="error-summary">
                    <i class="bi bi-exclamation-circle" style="flex-shrink:0; margin-top:2px;"></i>
                    <div>
                        <strong>Terdapat kesalahan:</strong>
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>

            <form action="<?php echo e(route('rental.booking.store', $tool)); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>

                
                <div class="form-header">
                    <div class="form-header-icon"><i class="bi bi-person"></i></div>
                    <div>
                        <p class="form-header-title">1. Data Pemesan</p>
                        <p class="form-header-subtitle">Isi nama dan nomor HP yang bisa dihubungi</p>
                    </div>
                </div>
                <div class="form-body">
                    <div class="f-grid-2" style="margin-bottom: 18px;">
                        <div>
                            <label class="f-label" for="pemesan_name">
                                <i class="bi bi-person"></i> Nama Lengkap <span class="req">*</span>
                            </label>
                            <input type="text" class="f-input <?php $__errorArgs = ['pemesan_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                   id="pemesan_name" name="pemesan_name"
                                   value="<?php echo e(old('pemesan_name', auth()->user()?->name)); ?>"
                                   placeholder="Nama lengkap Anda" required>
                            <?php $__errorArgs = ['pemesan_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="f-error"><i class="bi bi-exclamation-circle"></i> <?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div>
                            <label class="f-label" for="pemesan_phone">
                                <i class="bi bi-telephone"></i> Nomor HP <span class="req">*</span>
                            </label>
                            <input type="text" class="f-input <?php $__errorArgs = ['pemesan_phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                   id="pemesan_phone" name="pemesan_phone"
                                   value="<?php echo e(old('pemesan_phone', auth()->user()?->phone)); ?>"
                                   placeholder="08xxxxxxxxxx" required>
                            <?php $__errorArgs = ['pemesan_phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="f-error"><i class="bi bi-exclamation-circle"></i> <?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    
                    <div class="f-grid-2" style="margin-bottom: 18px;">
                        <div>
                            <label class="f-label" for="tanggal_mulai">
                                <i class="bi bi-calendar"></i> Tanggal Mulai <span class="req">*</span>
                            </label>
                            <input type="date" class="f-input <?php $__errorArgs = ['tanggal_mulai'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                   id="tanggal_mulai" name="tanggal_mulai"
                                   value="<?php echo e(old('tanggal_mulai')); ?>"
                                   min="<?php echo e(date('Y-m-d')); ?>"
                                   onchange="updateTotal()" required>
                            <?php $__errorArgs = ['tanggal_mulai'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="f-error"><i class="bi bi-exclamation-circle"></i> <?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div>
                            <label class="f-label" for="tanggal_selesai">
                                <i class="bi bi-calendar-check"></i> Tanggal Selesai <span class="req">*</span>
                            </label>
                            <input type="date" class="f-input <?php $__errorArgs = ['tanggal_selesai'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                   id="tanggal_selesai" name="tanggal_selesai"
                                   value="<?php echo e(old('tanggal_selesai')); ?>"
                                   min="<?php echo e(date('Y-m-d')); ?>"
                                   onchange="updateTotal()" required>
                            <?php $__errorArgs = ['tanggal_selesai'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="f-error"><i class="bi bi-exclamation-circle"></i> <?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    
                    <div style="margin-bottom: 18px; max-width: 220px;">
                        <label class="f-label" for="qty">
                            <i class="bi bi-box"></i> Jumlah Unit <span class="req">*</span>
                        </label>
                        <input type="number" class="f-input <?php $__errorArgs = ['qty'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                               id="qty" name="qty"
                               value="<?php echo e(old('qty', 1)); ?>"
                               min="1" max="<?php echo e($tool->stock); ?>"
                               onchange="updateTotal()" required>
                        <div class="f-hint"><i class="bi bi-info-circle"></i> Maks. <?php echo e($tool->stock); ?> unit</div>
                        <?php $__errorArgs = ['qty'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="f-error"><i class="bi bi-exclamation-circle"></i> <?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    
                    <div>
                        <label class="f-label" for="catatan_user">
                            <i class="bi bi-chat-left-text"></i> Catatan
                            <span style="font-size:0.72rem; color:#94A3B8; font-weight:400;">(opsional)</span>
                        </label>
                        <textarea class="f-textarea <?php $__errorArgs = ['catatan_user'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                  id="catatan_user" name="catatan_user"
                                  rows="3"
                                  placeholder="Tambahkan catatan atau kebutuhan khusus..."><?php echo e(old('catatan_user')); ?></textarea>
                        <?php $__errorArgs = ['catatan_user'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="f-error"><i class="bi bi-exclamation-circle"></i> <?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    
                    <div class="total-preview" id="totalPreview">
                        <div class="total-label">
                            Estimasi Total Biaya
                            <span id="totalDesc">Pilih tanggal dan jumlah unit terlebih dahulu</span>
                        </div>
                        <div class="total-price" id="totalPrice">—</div>
                    </div>

                </div>

                
                <div class="form-header" style="border-top: 1px solid #F1F5F9;">
                    <div class="form-header-icon"><i class="bi bi-receipt"></i></div>
                    <div>
                        <p class="form-header-title">2. Bukti Transfer Pembayaran</p>
                        <p class="form-header-subtitle">Unggah foto/screenshot bukti transfer DP atau pelunasan</p>
                    </div>
                </div>
                <div class="form-body" style="padding-top: 20px;">

                    <div class="upload-zone <?php $__errorArgs = ['bukti_transfer'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="uploadZone">
                        <input type="file" name="bukti_transfer" id="buktiTransferInput"
                               accept="image/jpg,image/jpeg,image/png,image/webp"
                               onchange="handleFileChange(this)">
                        <div class="upload-icon"><i class="bi bi-cloud-arrow-up"></i></div>
                        <div class="upload-text" id="uploadText">Klik atau seret gambar ke sini</div>
                        <div class="upload-sub">Format: JPG, PNG, WEBP · Maks. 3 MB</div>
                        <div class="upload-preview" id="uploadPreview">
                            <img id="previewImg" src="" alt="Preview bukti transfer">
                        </div>
                    </div>
                    <?php $__errorArgs = ['bukti_transfer'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="f-error" style="margin-top:8px;"><i class="bi bi-exclamation-circle"></i> <?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <div class="f-hint" style="margin-top: 8px;">
                        <i class="bi bi-info-circle"></i>
                        Bukti transfer akan diverifikasi oleh tim kami. Pastikan nomor rekening dan nominal terlihat jelas.
                    </div>

                </div>

                
                <div class="form-header" style="border-top: 1px solid #F1F5F9;">
                    <div class="form-header-icon"><i class="bi bi-shield-check"></i></div>
                    <div>
                        <p class="form-header-title">3. Jaminan Penyewaan</p>
                        <p class="form-header-subtitle">Pilih dokumen yang akan Anda bawa saat pengambilan alat</p>
                    </div>
                </div>
                <div class="form-body" style="padding-top: 20px;">

                    <div style="background:#FEF3C7; border:1px solid rgba(245,158,11,0.3); border-radius:10px; padding:10px 14px; font-size:0.8rem; color:#92400E; display:flex; gap:8px; margin-bottom:18px;">
                        <i class="bi bi-exclamation-triangle-fill" style="flex-shrink:0; margin-top:1px;"></i>
                        <div>
                            Jaminan <strong>wajib dibawa secara fisik</strong> saat pengambilan alat dan akan dikembalikan setelah alat dikembalikan dalam kondisi baik.
                        </div>
                    </div>

                    <label class="f-label" style="margin-bottom: 14px;">
                        <i class="bi bi-card-list"></i> Pilih Jenis Jaminan <span class="req">*</span>
                    </label>

                    <div class="jaminan-grid">
                        <?php
                            $jaminanOptions = [
                                'ktp'           => ['icon' => 'bi-person-vcard', 'name' => 'KTP', 'desc' => 'Kartu Tanda Penduduk'],
                                'kk'            => ['icon' => 'bi-people',       'name' => 'Kartu Keluarga', 'desc' => 'KK asli atau fotokopi'],
                                'sim'           => ['icon' => 'bi-car-front',    'name' => 'SIM', 'desc' => 'Surat Izin Mengemudi (A/B/C)'],
                                'kartu_pelajar' => ['icon' => 'bi-mortarboard',  'name' => 'Kartu Pelajar', 'desc' => 'Pelajar / Mahasiswa'],
                            ];
                        ?>

                        <?php $__currentLoopData = $jaminanOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $opt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="jaminan-option">
                                <input type="radio" name="jenis_jaminan" id="jaminan_<?php echo e($value); ?>"
                                       value="<?php echo e($value); ?>"
                                       <?php echo e(old('jenis_jaminan') === $value ? 'checked' : ''); ?>>
                                <label class="jaminan-label" for="jaminan_<?php echo e($value); ?>">
                                    <div class="jaminan-icon"><i class="bi <?php echo e($opt['icon']); ?>"></i></div>
                                    <div style="flex:1;">
                                        <div class="jaminan-name"><?php echo e($opt['name']); ?></div>
                                        <div class="jaminan-desc"><?php echo e($opt['desc']); ?></div>
                                    </div>
                                    <div class="jaminan-check">
                                        <i class="bi bi-check2"></i>
                                    </div>
                                </label>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <?php $__errorArgs = ['jenis_jaminan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="f-error" style="margin-top:10px;"><i class="bi bi-exclamation-circle"></i> <?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                </div>

                
                <div class="form-header" style="border-top: 1px solid #F1F5F9;">
                    <div class="form-header-icon"><i class="bi bi-file-text"></i></div>
                    <div>
                        <p class="form-header-title">4. Syarat & Ketentuan</p>
                        <p class="form-header-subtitle">Baca dan setujui sebelum mengirim pemesanan</p>
                    </div>
                </div>
                <div class="form-body" style="padding-top: 20px;">

                    <div class="sk-box">
                        <div class="sk-header" id="skHeader" onclick="toggleSK()">
                            <div>
                                <div class="sk-header-title"><i class="bi bi-file-earmark-text me-2"></i>Syarat & Ketentuan Penyewaan Alat Studio</div>
                                <div class="sk-header-sub">Klik untuk membaca lengkap — wajib dibaca sebelum menyetujui</div>
                            </div>
                            <i class="bi bi-chevron-down sk-chevron"></i>
                        </div>
                        <div class="sk-body" id="skBody">
                            <div class="sk-item"><div class="sk-num">1</div><div>Pemesan wajib menunjukkan <strong>dokumen jaminan asli</strong> yang dipilih saat pengambilan alat. Tanpa jaminan, alat tidak akan diserahkan.</div></div>
                            <div class="sk-item"><div class="sk-num">2</div><div>Alat harus dikembalikan sesuai <strong>tanggal selesai</strong> yang tercantum. Keterlambatan pengembalian dikenakan denda <strong>Rp <?php echo e(number_format($tool->price_per_day, 0, ',', '.')); ?>/hari</strong> (sesuai harga sewa).</div></div>
                            <div class="sk-item"><div class="sk-num">3</div><div>Pemesan <strong>bertanggung jawab penuh</strong> atas kerusakan atau kehilangan alat selama masa penyewaan dan wajib mengganti sesuai nilai alat.</div></div>
                            <div class="sk-item"><div class="sk-num">4</div><div>Alat hanya boleh digunakan untuk <strong>keperluan yang sah dan tidak merusak</strong>. Dilarang dipindahtangankan kepada pihak lain tanpa izin.</div></div>
                            <div class="sk-item"><div class="sk-num">5</div><div>Bukti transfer yang diunggah akan <strong>diverifikasi oleh admin</strong>. Pemesanan baru berstatus aktif setelah konfirmasi dari tim studio.</div></div>
                            <div class="sk-item"><div class="sk-num">6</div><div>Pembatalan pemesanan yang sudah <strong>disetujui admin</strong> dapat dikenakan biaya administrasi sesuai kebijakan studio.</div></div>
                            <div class="sk-item"><div class="sk-num">7</div><div>Dokumen jaminan akan <strong>dikembalikan</strong> segera setelah alat dikembalikan dalam kondisi baik dan lengkap.</div></div>
                            <div class="sk-item"><div class="sk-num">8</div><div>Studio berhak <strong>menolak pemesanan</strong> tanpa memberikan alasan jika ditemukan indikasi penyalahgunaan.</div></div>
                            <div class="sk-warning">
                                <i class="bi bi-exclamation-triangle-fill" style="flex-shrink:0; margin-top:1px;"></i>
                                <div>Dengan menyetujui, Anda dianggap telah membaca dan memahami seluruh ketentuan di atas. Pelanggaran dapat diproses secara hukum.</div>
                            </div>
                        </div>
                    </div>

                    
                    <label class="agree-box <?php $__errorArgs = ['setuju_syarat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="agreeBox" for="setuju_syarat">
                        <input type="checkbox" name="setuju_syarat" id="setuju_syarat" value="1"
                               <?php echo e(old('setuju_syarat') ? 'checked' : ''); ?>

                               style="position:absolute; opacity:0;"
                               onchange="toggleAgreeBox(this)">
                        <div class="agree-checkbox" id="agreeCheck">
                            <i class="bi bi-check2" style="font-size:0.8rem;"></i>
                        </div>
                        <div class="agree-text">
                            Saya telah membaca, memahami, dan <strong>menyetujui</strong> seluruh Syarat & Ketentuan penyewaan alat studio QofMedia.
                        </div>
                    </label>
                    <?php $__errorArgs = ['setuju_syarat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="f-error" style="margin-top:8px;"><i class="bi bi-exclamation-circle"></i> <?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                </div>

                
                <div class="form-actions">
                    <button type="submit" class="btn-submit">
                        <i class="bi bi-send-check"></i> Kirim Pemesanan
                    </button>
                    <a href="<?php echo e(route('service.studio')); ?>" class="btn-back">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>

            </form>
        </div>

    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    var pricePerDay = <?php echo e((int) $tool->price_per_day); ?>;

    // ── Kalkulasi total ──
    function updateTotal() {
        var mulai   = document.getElementById('tanggal_mulai').value;
        var selesai = document.getElementById('tanggal_selesai').value;
        var qty     = parseInt(document.getElementById('qty').value) || 1;
        var totalEl = document.getElementById('totalPrice');
        var descEl  = document.getElementById('totalDesc');

        if (!mulai || !selesai) {
            totalEl.textContent = '—';
            descEl.textContent  = 'Pilih tanggal dan jumlah unit terlebih dahulu';
            return;
        }

        var d1 = new Date(mulai);
        var d2 = new Date(selesai);
        if (d2 < d1) { totalEl.textContent = '—'; descEl.textContent = 'Tanggal selesai tidak valid'; return; }

        var durasi = Math.max(1, Math.round((d2 - d1) / (1000 * 60 * 60 * 24)) + 1);
        var total  = pricePerDay * durasi * qty;

        totalEl.textContent = 'Rp ' + total.toLocaleString('id-ID');
        descEl.textContent  = durasi + ' hari × ' + qty + ' unit × Rp ' + pricePerDay.toLocaleString('id-ID') + '/hari';
    }

    // ── Upload preview ──
    function handleFileChange(input) {
        var zone    = document.getElementById('uploadZone');
        var preview = document.getElementById('uploadPreview');
        var img     = document.getElementById('previewImg');
        var text    = document.getElementById('uploadText');

        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                img.src = e.target.result;
                preview.style.display = 'block';
                zone.classList.add('has-file');
                text.textContent = input.files[0].name;
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            preview.style.display = 'none';
            zone.classList.remove('has-file');
            text.textContent = 'Klik atau seret gambar ke sini';
        }
    }

    // Drag & drop
    var zone = document.getElementById('uploadZone');
    zone.addEventListener('dragover',  function(e){ e.preventDefault(); zone.classList.add('drag-over'); });
    zone.addEventListener('dragleave', function()  { zone.classList.remove('drag-over'); });
    zone.addEventListener('drop',      function(e) {
        e.preventDefault(); zone.classList.remove('drag-over');
        var input = document.getElementById('buktiTransferInput');
        input.files = e.dataTransfer.files;
        handleFileChange(input);
    });

    // ── Syarat & Ketentuan toggle ──
    function toggleSK() {
        var header = document.getElementById('skHeader');
        var body   = document.getElementById('skBody');
        header.classList.toggle('open');
        body.classList.toggle('open');
    }

    // Auto-buka SK saat halaman load
    document.addEventListener('DOMContentLoaded', function() {
        toggleSK();

        // Restore agree box state on validation fail
        var cb = document.getElementById('setuju_syarat');
        if (cb && cb.checked) {
            document.getElementById('agreeCheck').style.background  = '#059669';
            document.getElementById('agreeCheck').style.borderColor = '#059669';
            document.getElementById('agreeCheck').style.color       = '#fff';
        }
    });

    // ── Checkbox agree visual ──
    function toggleAgreeBox(cb) {
        var check = document.getElementById('agreeCheck');
        if (cb.checked) {
            check.style.background  = '#059669';
            check.style.borderColor = '#059669';
            check.style.color       = '#fff';
        } else {
            check.style.background  = '#fff';
            check.style.borderColor = '#86EFAC';
            check.style.color       = 'transparent';
        }
    }
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\qofmedia-web\resources\views/public/service/studio/rental/booking-form.blade.php ENDPATH**/ ?>