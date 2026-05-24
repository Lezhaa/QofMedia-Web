<?php $__env->startSection('title', 'Detail Order #' . $order->id); ?>

<?php $__env->startSection('content_header'); ?>
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="mb-0" style="font-size: 1.4rem; font-weight: 700; color: #0D1B2A;">
                <i class="fas fa-receipt me-2" style="color: #0E7A96;"></i> Detail Order
                <span style="color:#0E7A96;">#<?php echo e($order->id); ?></span>
            </h1>
            <ol class="breadcrumb mb-0 mt-1" style="font-size: 0.8rem; background: transparent; padding: 0;">
                <li class="breadcrumb-item"><a href="<?php echo e(route('apparel.dashboard')); ?>">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?php echo e(route('apparel.orders.index')); ?>">Order</a></li>
                <li class="breadcrumb-item active">Detail #<?php echo e($order->id); ?></li>
            </ol>
        </div>
        <a href="<?php echo e(route('apparel.orders.index')); ?>"
           style="display:inline-flex; align-items:center; gap:7px; background:#F8FAFC; color:#64748B; padding:10px 22px; border-radius:50px; font-weight:700; font-size:0.88rem; text-decoration:none; border:1.5px solid #E2E8F0; transition:all 0.3s;">
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
    .sec-label::after { content: ''; flex: 1; height: 1px; background: #E2E8F0; }

    /* ============================================
       ORDER BANNER
       ============================================ */
    .order-banner {
        background: linear-gradient(135deg, #0D1B2A 0%, #1B3A4B 55%, #0E7A96 100%);
        border-radius: 20px;
        padding: 28px 32px;
        position: relative;
        overflow: hidden;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
    }
    .order-banner::before {
        content: '';
        position: absolute;
        top: -40%; right: -10%;
        width: 350px; height: 350px;
        background: radial-gradient(circle, rgba(78,184,204,0.18) 0%, transparent 70%);
        border-radius: 50%;
        pointer-events: none;
    }
    .order-banner .ob-content { position: relative; z-index: 1; }
    .order-banner h4 { color: #fff; font-weight: 800; font-size: 1.2rem; margin-bottom: 4px; }
    .order-banner p  { color: rgba(255,255,255,0.65); font-size: 0.85rem; margin: 0; }
    .ob-meta { display: flex; align-items: center; gap: 8px; margin-top: 12px; flex-wrap: wrap; }
    .ob-chip {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(255,255,255,0.1);
        border: 1px solid rgba(255,255,255,0.15);
        color: #A8DDE8;
        padding: 4px 14px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    .ob-chip.menunggu  { background: rgba(217,119,6,0.35);  border-color: rgba(251,191,36,0.4);  color: #fff; }
    .ob-chip.disetujui { background: rgba(5,150,105,0.35);  border-color: rgba(52,211,153,0.4);  color: #fff; }
    .ob-chip.packing   { background: rgba(14,122,150,0.45);  border-color: rgba(78,184,204,0.5);  color: #fff; }
    .ob-chip.dikirim   { background: rgba(124,58,237,0.35);  border-color: rgba(167,139,250,0.4); color: #fff; }
    .ob-chip.diterima  { background: rgba(5,150,105,0.5);   border-color: rgba(52,211,153,0.5);  color: #fff; }
    .ob-chip.ditolak   { background: rgba(220,38,38,0.35);  border-color: rgba(248,113,113,0.4); color: #fff; }
    .ob-total { position: relative; z-index: 1; text-align: right; flex-shrink: 0; }
    .ob-total-label  { font-size: 0.72rem; color: rgba(255,255,255,0.55); font-weight: 600; text-transform: uppercase; letter-spacing: 0.07em; margin-bottom: 4px; }
    .ob-total-amount { font-size: 1.8rem; font-weight: 800; color: #fff; line-height: 1; }
    .ob-total-sub    { font-size: 0.73rem; color: rgba(255,255,255,0.45); margin-top: 4px; }

    /* ============================================
       DASH CARD — sama dengan sistem lain
       ============================================ */
    .dash-card {
        background: #fff;
        border: 1px solid #E2E8F0;
        border-radius: 18px;
        overflow: hidden;
        margin-bottom: 20px;
    }
    .dash-card-header {
        padding: 16px 22px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom: 1px solid #F1F5F9;
        background: #F8FAFC;
    }
    .dash-card-title {
        font-size: 0.9rem;
        font-weight: 700;
        color: #0D1B2A;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .dash-card-title .hdr-icon {
        width: 30px; height: 30px;
        background: rgba(14,122,150,0.1);
        border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        color: #0E7A96;
        font-size: 0.8rem;
        flex-shrink: 0;
    }
    .dash-card-body { padding: 22px; }

    /* ============================================
       INFO TABLE
       ============================================ */
    .info-table { width: 100%; border-collapse: collapse; }
    .info-table tr { border-bottom: 1px solid #F8FAFC; transition: background 0.15s; }
    .info-table tr:last-child { border-bottom: none; }
    .info-table tr:hover { background: #FAFCFE; }
    .info-table th {
        width: 150px;
        padding: 13px 22px;
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        color: #94A3B8;
        vertical-align: top;
        white-space: nowrap;
    }
    .info-table td {
        padding: 13px 22px;
        font-size: 0.88rem;
        color: #0D1B2A;
        font-weight: 500;
        vertical-align: middle;
    }

    /* ============================================
       BADGES & PILLS
       ============================================ */
    .status-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 14px;
        border-radius: 50px;
        font-size: 0.78rem;
        font-weight: 700;
    }
    .status-pill .dot { width: 7px; height: 7px; border-radius: 50%; }
    .status-pill.menunggu  { background: #FEF3C7; color: #92400E; }
    .status-pill.menunggu  .dot { background: #D97706; animation: blink 2s infinite; }
    .status-pill.disetujui { background: #D1FAE5; color: #065F46; }
    .status-pill.disetujui .dot { background: #059669; }
    .status-pill.packing   { background: #EEF9FC; color: #0E7A96; }
    .status-pill.packing   .dot { background: #0E7A96; animation: blink 2s infinite; }
    .status-pill.dikirim   { background: #EDE9FE; color: #5B21B6; }
    .status-pill.dikirim   .dot { background: #7C3AED; }
    .status-pill.diterima  { background: #D1FAE5; color: #065F46; }
    .status-pill.diterima  .dot { background: #059669; }
    .status-pill.ditolak   { background: #FEE2E2; color: #991B1B; }
    .status-pill.ditolak   .dot { background: #DC2626; }

    .pay-pill {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 4px 12px;
        border-radius: 50px;
        font-size: 0.72rem;
        font-weight: 700;
    }
    .pay-pill.unpaid  { background: #F1F5F9; color: #64748B; }
    .pay-pill.pending { background: #FEF3C7; color: #92400E; }
    .pay-pill.paid    { background: #D1FAE5; color: #065F46; }
    .pay-pill.failed  { background: #FEE2E2; color: #991B1B; }

    .badge-proof {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 4px 12px;
        border-radius: 50px;
        font-size: 0.7rem;
        font-weight: 700;
    }
    .badge-proof.valid   { background: #D1FAE5; color: #065F46; }
    .badge-proof.invalid { background: #FEE2E2; color: #991B1B; }
    .badge-proof.pending { background: #FEF3C7; color: #92400E; }

    /* ============================================
       PRODUCT CARD
       ============================================ */
    .product-block { display: flex; gap: 18px; align-items: flex-start; padding: 20px 22px; }
    .product-thumb {
        width: 96px; height: 96px;
        border-radius: 14px;
        object-fit: cover;
        border: 1px solid #E2E8F0;
        flex-shrink: 0;
    }
    .product-thumb-placeholder {
        width: 96px; height: 96px;
        border-radius: 14px;
        background: linear-gradient(135deg, #EEF9FC, #D6EEF5);
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0;
        border: 1px solid #E2E8F0;
        font-size: 2rem;
        color: #0E7A96;
        opacity: 0.4;
    }
    .product-name     { font-size: 1rem; font-weight: 800; color: #0D1B2A; margin-bottom: 3px; }
    .product-category { font-size: 0.72rem; color: #94A3B8; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 10px; }
    .variant-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 4px 12px;
        border-radius: 8px;
        font-size: 0.75rem;
        font-weight: 700;
        background: #F1F5F9;
        color: #475569;
        margin-right: 6px;
        margin-bottom: 4px;
    }
    .price-row {
        display: flex;
        align-items: center;
        gap: 14px;
        margin-top: 12px;
        padding-top: 12px;
        border-top: 1px solid #F1F5F9;
        flex-wrap: wrap;
    }
    .price-unit { font-size: 0.82rem; color: #64748B; }
    .price-unit strong { color: #0D1B2A; }
    .qty-badge {
        background: #EEF9FC;
        color: #0E7A96;
        padding: 4px 12px;
        border-radius: 8px;
        font-size: 0.82rem;
        font-weight: 700;
    }
    .price-total { font-size: 1.1rem; font-weight: 800; color: #059669; margin-left: auto; }

    /* ============================================
       PROOF CARD
       ============================================ */
    .proof-box {
        border: 2px dashed #BAE6F5;
        border-radius: 14px;
        padding: 20px;
        background: #F0FDFF;
        text-align: center;
    }
    .proof-img { max-width: 100%; max-height: 280px; border-radius: 12px; border: 1px solid #E2E8F0; object-fit: contain; }
    .proof-caption {
        margin-top: 10px;
        font-size: 0.78rem;
        color: #0E7A96;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
    }
    .proof-empty {
        padding: 40px 20px;
        text-align: center;
        color: #94A3B8;
    }
    .proof-empty i { font-size: 2.5rem; opacity: 0.25; display: block; margin-bottom: 10px; }
    .proof-empty p { font-size: 0.85rem; margin: 0; }

    /* ============================================
       VALIDATION FORM
       ============================================ */
    .val-divider {
        margin: 20px 0 16px;
        padding-top: 16px;
        border-top: 2px dashed #BAE6F5;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
    }
    .val-divider-label {
        display: flex;
        align-items: center;
        gap: 7px;
        font-size: 0.85rem;
        font-weight: 700;
        color: #0D1B2A;
    }
    .val-divider-label i { color: #0E7A96; }

    .field-label-sm {
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #64748B;
        margin-bottom: 6px;
        display: block;
    }
    .field-select, .field-textarea-sm {
        width: 100%;
        border: 1.5px solid #E2E8F0;
        border-radius: 10px;
        padding: 9px 13px;
        font-size: 0.85rem;
        color: #0D1B2A;
        background: #F8FAFC;
        outline: none;
        transition: all 0.2s;
        font-family: inherit;
        appearance: none;
    }
    .field-select:focus, .field-textarea-sm:focus {
        border-color: #0E7A96;
        background: #fff;
        box-shadow: 0 0 0 3px rgba(14,122,150,0.08);
    }
    .field-textarea-sm { resize: none; }

    /* ============================================
       CALLOUTS (catatan)
       ============================================ */
    .callout-user {
        background: #F0F9FF;
        border: 1px solid #BAE6F5;
        border-left: 4px solid #0E7A96;
        border-radius: 12px;
        padding: 13px 16px;
        font-size: 0.88rem;
        color: #0D1B2A;
        line-height: 1.6;
        font-style: italic;
    }
    .callout-admin {
        background: #EEF9FC;
        border: 1px solid #BAE6F5;
        border-left: 4px solid #0E7A96;
        border-radius: 12px;
        padding: 13px 16px;
        font-size: 0.86rem;
        color: #0A4A62;
        line-height: 1.6;
    }
    .callout-label {
        font-size: 0.68rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.07em;
        opacity: 0.6;
        margin-bottom: 4px;
    }

    /* ============================================
       INLINE ALERT BANNERS
       ============================================ */
    .inline-alert {
        border-radius: 10px;
        padding: 11px 14px;
        font-size: 0.82rem;
        font-weight: 600;
        display: flex;
        align-items: flex-start;
        gap: 8px;
        margin-bottom: 14px;
    }
    .inline-alert.warn { background: #FEF3C7; color: #92400E; }
    .inline-alert.info { background: rgba(14,122,150,0.08); color: #0E7A96; }
    .inline-alert.success { background: #D1FAE5; color: #065F46; }
    .inline-alert.danger  { background: #FEE2E2; color: #991B1B; }

    /* ============================================
       ACTION BUTTONS
       ============================================ */
    .btn-validate {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        width: 100%;
        padding: 10px 16px;
        background: #0E7A96;
        color: #fff;
        border: none;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.2s;
        margin-top: 14px;
    }
    .btn-validate:hover { background: #0A4A62; color: #fff; transform: translateY(-1px); }

    .btn-approve {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        width: 100%;
        padding: 12px 20px;
        background: linear-gradient(135deg, #059669, #34D399);
        color: #fff;
        border: none;
        border-radius: 50px;
        font-size: 0.88rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.25s;
        margin-bottom: 10px;
    }
    .btn-approve:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(5,150,105,0.3); color: #fff; }

    .btn-reject {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        width: 100%;
        padding: 12px 20px;
        background: linear-gradient(135deg, #DC2626, #F87171);
        color: #fff;
        border: none;
        border-radius: 50px;
        font-size: 0.88rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.25s;
    }
    .btn-reject:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(220,38,38,0.3); color: #fff; }

    .btn-packing {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        width: 100%;
        padding: 12px 20px;
        background: linear-gradient(135deg, #0E7A96, #4EB8CC);
        color: #fff;
        border: none;
        border-radius: 50px;
        font-size: 0.88rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.25s;
        margin-bottom: 10px;
        text-decoration: none;
    }
    .btn-packing:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(14,122,150,0.3); color: #fff; }

    .btn-kirim {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        width: 100%;
        padding: 12px 20px;
        background: linear-gradient(135deg, #7C3AED, #A78BFA);
        color: #fff;
        border: none;
        border-radius: 50px;
        font-size: 0.88rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.25s;
        margin-bottom: 10px;
    }
    .btn-kirim:hover { transform: translateY(-2px); box-shadow: 0 8px 24px rgba(124,58,237,0.3); color: #fff; }

    .tracking-box {
        background: #EDE9FE;
        border: 1px solid #C4B5FD;
        border-radius: 12px;
        padding: 12px 16px;
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 14px;
    }
    .tracking-box i { color: #7C3AED; font-size: 1.1rem; flex-shrink: 0; }
    .tracking-box .tracking-label { font-size: 0.68rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.06em; color: #7C3AED; margin-bottom: 2px; }
    .tracking-box .tracking-code { font-size: 1rem; font-weight: 800; color: #5B21B6; font-family: monospace; letter-spacing: 0.05em; }

    .btn-wa {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background: #25D366;
        color: #fff;
        padding: 4px 12px;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 700;
        text-decoration: none;
        margin-left: 8px;
        transition: all 0.2s;
        vertical-align: middle;
    }
    .btn-wa:hover { background: #1ebe5d; color: #fff; }

    /* ============================================
       USER CARD
       ============================================ */
    .user-avatar-wrap {
        width: 48px; height: 48px;
        border-radius: 14px;
        background: linear-gradient(135deg, #0E7A96, #4EB8CC);
        display: flex; align-items: center; justify-content: center;
        color: #fff;
        font-size: 1.2rem;
        font-weight: 800;
        flex-shrink: 0;
    }
    .user-info-row {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 11px 0;
        border-bottom: 1px solid #F8FAFC;
    }
    .user-info-row:last-child { border-bottom: none; padding-bottom: 0; }
    .uir-icon {
        width: 30px; height: 30px;
        border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        font-size: 0.75rem;
        flex-shrink: 0;
        margin-top: 1px;
        background: #F1F5F9;
        color: #64748B;
    }
    .uir-label { font-size: 0.68rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: #94A3B8; margin-bottom: 2px; }
    .uir-value { font-size: 0.85rem; font-weight: 600; color: #0D1B2A; }

    /* ============================================
       SUMMARY ROWS
       ============================================ */
    .sum-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 0;
        font-size: 0.88rem;
    }
    .sum-row .sum-label { color: #64748B; }
    .sum-row .sum-value { font-weight: 700; color: #0D1B2A; }
    .sum-row.total { border-top: 1px solid #F1F5F9; padding-top: 14px; margin-top: 4px; }
    .sum-row.total .sum-label { font-weight: 700; color: #0D1B2A; font-size: 0.9rem; }
    .sum-row.total .sum-value { font-size: 1.3rem; font-weight: 800; color: #059669; }

    /* ============================================
       TIMELINE
       ============================================ */
    .timeline { padding: 20px 22px; }
    .tl-item {
        display: flex;
        gap: 14px;
        position: relative;
        padding-bottom: 20px;
    }
    .tl-item:last-child { padding-bottom: 0; }
    .tl-item:last-child .tl-line { display: none; }
    .tl-spine { display: flex; flex-direction: column; align-items: center; flex-shrink: 0; }
    .tl-dot {
        width: 32px; height: 32px;
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 0.78rem;
        font-weight: 700;
        flex-shrink: 0;
    }
    .tl-line { flex: 1; width: 2px; background: #F1F5F9; margin-top: 6px; min-height: 16px; }
    .tl-body  { flex: 1; padding-top: 4px; }
    .tl-title { font-size: 0.85rem; font-weight: 700; color: #0D1B2A; margin-bottom: 2px; }
    .tl-time  { font-size: 0.75rem; color: #94A3B8; font-weight: 500; }

    /* ============================================
       ANIMATION
       ============================================ */
    @keyframes blink { 0%,100%{opacity:1;} 50%{opacity:0.3;} }
    @keyframes fadeInUp { from{opacity:0; transform:translateY(14px);} to{opacity:1; transform:translateY(0);} }
    .anim-1 { animation: fadeInUp 0.38s ease both; }
    .anim-2 { animation: fadeInUp 0.38s 0.07s ease both; }
    .anim-3 { animation: fadeInUp 0.38s 0.14s ease both; }
    .anim-4 { animation: fadeInUp 0.38s 0.21s ease both; }

    @media(max-width:768px) {
        .ob-total { display: none; }
        .info-table th { width: 110px; }
        .product-block { flex-direction: column; }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>


<?php if(session('success')): ?>
    <div style="border-radius:12px; font-size:0.88rem; border:none; background:#D1FAE5; color:#065F46; padding:12px 18px; display:flex; align-items:center; gap:8px; margin-bottom:20px;">
        <i class="fas fa-check-circle"></i> <?php echo e(session('success')); ?>

        <button type="button" class="close ml-auto" data-dismiss="alert" style="background:none; border:none; cursor:pointer; color:#065F46; font-size:1rem;">&times;</button>
    </div>
<?php endif; ?>
<?php if(session('error')): ?>
    <div style="border-radius:12px; font-size:0.88rem; border:none; background:#FEE2E2; color:#991B1B; padding:12px 18px; display:flex; align-items:center; gap:8px; margin-bottom:20px;">
        <i class="fas fa-exclamation-circle"></i> <?php echo e(session('error')); ?>

        <button type="button" class="close ml-auto" data-dismiss="alert" style="background:none; border:none; cursor:pointer; color:#991B1B; font-size:1rem;">&times;</button>
    </div>
<?php endif; ?>

<?php
    $statusClass = match($order->status) {
        'menunggu'  => 'menunggu',
        'disetujui' => 'disetujui',
        'packing'   => 'packing',
        'dikirim'   => 'dikirim',
        'diterima'  => 'diterima',
        'ditolak'   => 'ditolak',
        default     => 'menunggu'
    };
    $statusIcon = match($order->status) {
        'menunggu'  => 'fa-clock',
        'disetujui' => 'fa-check-circle',
        'packing'   => 'fa-box-open',
        'dikirim'   => 'fa-truck',
        'diterima'  => 'fa-home',
        'ditolak'   => 'fa-times-circle',
        default     => 'fa-clock'
    };
    $unitPrice  = $order->variant->price ?? $order->product->price ?? 0;
    $totalCalc  = $order->qty * $unitPrice;
    $proofStatus = $order->payment_proof_validated ?? 'pending';

    $product = $order->product;
    $productImage = null;
    if ($product) {
        if ($product->images && $product->images->count() > 0) {
            $productImage = asset('storage/' . $product->images->first()->image);
        } elseif ($product->image) {
            $productImage = asset('storage/' . $product->image);
        }
    }
?>


<div class="order-banner anim-1">
    <div class="ob-content">
        <h4><i class="fas fa-box-open me-2" style="opacity:0.8;"></i>Order #<?php echo e($order->id); ?></h4>
        <p><?php echo e($order->pemesan_name); ?> &bull; <?php echo e($product->name ?? 'N/A'); ?></p>
        <div class="ob-meta">
            <span class="ob-chip"><i class="fas fa-calendar-alt"></i><?php echo e($order->created_at->format('d M Y, H:i')); ?> WIB</span>
            <span class="ob-chip <?php echo e($statusClass); ?>"><i class="fas <?php echo e($statusIcon); ?>"></i><?php echo e($order->status_label); ?></span>
            <span class="ob-chip"><i class="fas fa-university"></i>Transfer Manual</span>
            <span class="ob-chip"><i class="fas fa-box"></i><?php echo e($order->qty); ?> pcs</span>
        </div>
    </div>
    <div class="ob-total">
        <div class="ob-total-label">Total Harga</div>
        <div class="ob-total-amount">Rp <?php echo e(number_format($totalCalc, 0, ',', '.')); ?></div>
        <div class="ob-total-sub"><?php echo e($order->qty); ?> pcs &times; Rp <?php echo e(number_format($unitPrice, 0, ',', '.')); ?></div>
    </div>
</div>

<div class="row g-3">

    
    <div class="col-lg-8">

        
        <p class="sec-label anim-2">Produk Dipesan</p>
        <div class="dash-card anim-2">
            <div class="dash-card-header">
                <div class="dash-card-title">
                    <div class="hdr-icon"><i class="fas fa-tshirt"></i></div>
                    Detail Produk
                </div>
                <?php if($product): ?>
                    <a href="<?php echo e(route('apparel.products.show', $product->id)); ?>"
                       style="font-size:0.78rem; color:#0E7A96; font-weight:700; text-decoration:none; display:inline-flex; align-items:center; gap:5px;">
                        <i class="fas fa-external-link-alt"></i> Lihat Produk
                    </a>
                <?php endif; ?>
            </div>
            <div class="product-block">
                <?php if($productImage): ?>
                    <img src="<?php echo e($productImage); ?>" alt="<?php echo e($product->name); ?>" class="product-thumb">
                <?php else: ?>
                    <div class="product-thumb-placeholder"><i class="fas fa-tshirt"></i></div>
                <?php endif; ?>
                <div style="flex:1;">
                    <div class="product-name"><?php echo e($product->name ?? 'Produk tidak ditemukan'); ?></div>
                    <div class="product-category"><i class="fas fa-tag me-1"></i><?php echo e($product->category->name ?? 'Uncategorized'); ?></div>
                    <?php if($order->variant): ?>
                        <div>
                            <span class="variant-badge"><i class="fas fa-ruler-combined"></i> <?php echo e($order->variant->size); ?></span>
                            <span class="variant-badge"><i class="fas fa-palette"></i> <?php echo e($order->variant->color); ?></span>
                            <span class="variant-badge"><i class="fas fa-tshirt"></i> Lengan <?php echo e(ucfirst($order->variant->sleeve_type)); ?></span>
                        </div>
                    <?php endif; ?>
                    <div class="price-row">
                        <div class="price-unit">Harga satuan: <strong>Rp <?php echo e(number_format($unitPrice, 0, ',', '.')); ?></strong></div>
                        <span class="qty-badge"><i class="fas fa-times me-1"></i><?php echo e($order->qty); ?> pcs</span>
                        <div class="price-total">Rp <?php echo e(number_format($totalCalc, 0, ',', '.')); ?></div>
                    </div>
                </div>
            </div>
        </div>

        
        <p class="sec-label anim-2">Informasi Pesanan</p>
        <div class="dash-card anim-2">
            <div class="dash-card-header">
                <div class="dash-card-title">
                    <div class="hdr-icon"><i class="fas fa-clipboard-list"></i></div>
                    Rincian Pesanan
                </div>
                <span style="font-size:0.75rem; color:#94A3B8; font-weight:600; font-family:monospace;">#<?php echo e($order->id); ?></span>
            </div>
            <table class="info-table">
                <tr>
                    <th>Pemesan</th>
                    <td><strong><?php echo e($order->pemesan_name); ?></strong></td>
                </tr>
                <tr>
                    <th>No. HP / WA</th>
                    <td>
                        <?php echo e($order->pemesan_phone); ?>

                        <a href="https://wa.me/<?php echo e(preg_replace('/[^0-9]/', '', $order->pemesan_phone)); ?>"
                           class="btn-wa" target="_blank">
                            <i class="fab fa-whatsapp"></i> Chat WA
                        </a>
                    </td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td>
                        <?php echo e($order->alamat_detail ?? $order->alamat ?? '—'); ?>

                        <?php if($order->kab_kota): ?>
                            <br><span style="font-size:0.78rem; color:#94A3B8;"><?php echo e($order->kab_kota); ?><?php echo e($order->provinsi ? ', '.$order->provinsi : ''); ?></span>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <th>Jumlah</th>
                    <td><span style="font-size:1.1rem; font-weight:800;"><?php echo e($order->qty); ?></span> pcs</td>
                </tr>
                <tr>
                    <th>Total Harga</th>
                    <td><span style="font-size:1.2rem; font-weight:800; color:#059669;">Rp <?php echo e(number_format($totalCalc, 0, ',', '.')); ?></span></td>
                </tr>
                <tr>
                    <th>Metode Bayar</th>
                    <td><span class="pay-pill pending"><i class="fas fa-university me-1"></i> Transfer Manual</span></td>
                </tr>
                <tr>
                    <th>Status Order</th>
                    <td><span class="status-pill <?php echo e($statusClass); ?>"><span class="dot"></span><?php echo e($order->status_label); ?></span></td>
                </tr>
                <tr>
                    <th>Status Bayar</th>
                    <td><span class="pay-pill <?php echo e($order->payment_status ?? 'unpaid'); ?>"><?php echo e($order->payment_status_label); ?></span></td>
                </tr>
            </table>

            <?php if($order->catatan_user): ?>
                <div style="padding:14px 22px; border-top:1px solid #F1F5F9;">
                    <div class="callout-user">
                        <div class="callout-label"><i class="fas fa-comment-alt me-1"></i> Catatan Pemesan</div>
                        <?php echo e($order->catatan_user); ?>

                    </div>
                </div>
            <?php endif; ?>
            <?php if($order->catatan_admin): ?>
                <div style="padding:0 22px 14px;">
                    <div class="callout-admin">
                        <div class="callout-label"><i class="fas fa-user-shield me-1"></i> Catatan Admin</div>
                        <?php echo e($order->catatan_admin); ?>

                    </div>
                </div>
            <?php endif; ?>
        </div>

        
        <p class="sec-label anim-3">Bukti Pembayaran</p>
        <div class="dash-card anim-3">
            <div class="dash-card-header">
                <div class="dash-card-title">
                    <div class="hdr-icon"><i class="fas fa-file-invoice-dollar"></i></div>
                    Bukti Transfer dari Pemesan
                </div>
                <?php if($order->payment_proof): ?>
                    <a href="<?php echo e(asset('storage/' . $order->payment_proof)); ?>" target="_blank"
                       style="display:inline-flex; align-items:center; gap:6px; background:#0E7A96; color:#fff; padding:7px 16px; border-radius:50px; font-size:0.78rem; font-weight:700; text-decoration:none;">
                        <i class="fas fa-expand-alt"></i> Buka Penuh
                    </a>
                <?php endif; ?>
            </div>
            <div class="dash-card-body">
                <?php if($order->payment_proof): ?>
                    <div class="proof-box">
                        <img src="<?php echo e(asset('storage/' . $order->payment_proof)); ?>" class="proof-img">
                        <div class="proof-caption">
                            <i class="fas fa-check-circle"></i> Bukti pembayaran sudah dikirim
                        </div>
                    </div>

                    
                    <div class="val-divider">
                        <div class="val-divider-label">
                            <i class="fas fa-check-double"></i> Validasi Bukti Transfer
                        </div>
                        <span class="badge-proof <?php echo e($proofStatus); ?>">
                            <?php if($proofStatus == 'valid'): ?>   <i class="fas fa-check-circle"></i> Valid
                            <?php elseif($proofStatus == 'invalid'): ?> <i class="fas fa-times-circle"></i> Tidak Valid
                            <?php else: ?>                          <i class="fas fa-clock"></i> Pending
                            <?php endif; ?>
                        </span>
                    </div>

                    <form action="<?php echo e(route('apparel.orders.validate-proof', $order)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="field-label-sm">Status Validasi</label>
                                <div style="position:relative;">
                                    <select name="payment_proof_validated" class="field-select" style="padding-right:36px;">
                                        <option value="pending" <?php echo e($proofStatus == 'pending'  ? 'selected' : ''); ?>>⏳ Pending (Belum Diverifikasi)</option>
                                        <option value="valid"   <?php echo e($proofStatus == 'valid'    ? 'selected' : ''); ?>>✅ Valid (Bukti Sesuai)</option>
                                        <option value="invalid" <?php echo e($proofStatus == 'invalid'  ? 'selected' : ''); ?>>❌ Tidak Valid (Bukti Bermasalah)</option>
                                    </select>
                                    <i class="fas fa-chevron-down" style="position:absolute; right:12px; top:50%; transform:translateY(-50%); color:#CBD5E1; font-size:0.7rem; pointer-events:none;"></i>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="field-label-sm">Catatan Validasi</label>
                                <textarea name="catatan_admin" class="field-textarea-sm" rows="2"
                                          placeholder="Nominal sesuai / rekening tidak sesuai..."><?php echo e($order->catatan_admin); ?></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn-validate">
                            <i class="fas fa-save"></i> Simpan Validasi
                        </button>
                    </form>

                <?php else: ?>
                    <div class="proof-empty">
                        <i class="fas fa-image"></i>
                        <p>Belum ada bukti pembayaran yang dikirim</p>
                    </div>
                <?php endif; ?>

                <?php if($order->payment_message): ?>
                    <div style="margin-top:16px;">
                        <div class="callout-user">"<?php echo e($order->payment_message); ?>"</div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        
        <p class="sec-label anim-3">Riwayat Status</p>
        <div class="dash-card anim-3" style="margin-bottom:0;">
            <div class="dash-card-header">
                <div class="dash-card-title">
                    <div class="hdr-icon"><i class="fas fa-history"></i></div>
                    Timeline Order
                </div>
            </div>
            <div class="timeline">
                <div class="tl-item">
                    <div class="tl-spine">
                        <div class="tl-dot" style="background:#EEF9FC; color:#0E7A96;"><i class="fas fa-plus"></i></div>
                        <div class="tl-line"></div>
                    </div>
                    <div class="tl-body">
                        <div class="tl-title">Order Dibuat</div>
                        <div class="tl-time"><?php echo e($order->created_at->format('d M Y, H:i')); ?> WIB</div>
                    </div>
                </div>

                <?php if($order->payment_proof): ?>
                <div class="tl-item">
                    <div class="tl-spine">
                        <div class="tl-dot" style="background:#FEF3C7; color:#D97706;"><i class="fas fa-file-upload"></i></div>
                        <div class="tl-line"></div>
                    </div>
                    <div class="tl-body">
                        <div class="tl-title">Bukti Pembayaran Dikirim</div>
                        <div class="tl-time">Pemesan sudah mengirim bukti pembayaran</div>
                    </div>
                </div>
                <?php endif; ?>

                <?php if($proofStatus != 'pending'): ?>
                <div class="tl-item">
                    <div class="tl-spine">
                        <div class="tl-dot" style="background:<?php echo e($proofStatus == 'valid' ? '#D1FAE5' : '#FEE2E2'); ?>; color:<?php echo e($proofStatus == 'valid' ? '#059669' : '#DC2626'); ?>;">
                            <i class="fas <?php echo e($proofStatus == 'valid' ? 'fa-check' : 'fa-times'); ?>"></i>
                        </div>
                        <div class="tl-line"></div>
                    </div>
                    <div class="tl-body">
                        <div class="tl-title" style="color:<?php echo e($proofStatus == 'valid' ? '#059669' : '#DC2626'); ?>;">
                            Bukti Transfer <?php echo e($proofStatus == 'valid' ? 'Valid' : 'Tidak Valid'); ?>

                        </div>
                        <div class="tl-time">Admin telah memverifikasi bukti pembayaran</div>
                        <?php if($proofStatus == 'invalid' && $order->catatan_admin): ?>
                            <div class="tl-time" style="color:#DC2626;">Catatan: <?php echo e($order->catatan_admin); ?></div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>

                <?php if(in_array($order->status, ['disetujui', 'packing', 'dikirim', 'diterima'])): ?>
                <div class="tl-item">
                    <div class="tl-spine">
                        <div class="tl-dot" style="background:#D1FAE5; color:#059669;"><i class="fas fa-check"></i></div>
                        <div class="tl-line"></div>
                    </div>
                    <div class="tl-body">
                        <div class="tl-title" style="color:#059669;">Pesanan Disetujui</div>
                        <div class="tl-time"><?php echo e($order->paid_at ? $order->paid_at->format('d M Y, H:i').' WIB' : $order->updated_at->format('d M Y, H:i').' WIB'); ?></div>
                    </div>
                </div>
                <?php endif; ?>

                <?php if(in_array($order->status, ['packing', 'dikirim', 'diterima'])): ?>
                <div class="tl-item">
                    <div class="tl-spine">
                        <div class="tl-dot" style="background:#EEF9FC; color:#0E7A96;"><i class="fas fa-box-open"></i></div>
                        <div class="tl-line"></div>
                    </div>
                    <div class="tl-body">
                        <div class="tl-title" style="color:#0E7A96;">Sedang Dipacking</div>
                        <div class="tl-time"><?php echo e($order->packing_at ? \Carbon\Carbon::parse($order->packing_at)->format('d M Y, H:i').' WIB' : '-'); ?></div>
                    </div>
                </div>
                <?php endif; ?>

                <?php if(in_array($order->status, ['dikirim', 'diterima'])): ?>
                <div class="tl-item">
                    <div class="tl-spine">
                        <div class="tl-dot" style="background:#EDE9FE; color:#7C3AED;"><i class="fas fa-truck"></i></div>
                        <div class="tl-line"></div>
                    </div>
                    <div class="tl-body">
                        <div class="tl-title" style="color:#7C3AED;">Pesanan Dikirim</div>
                        <div class="tl-time"><?php echo e($order->shipped_at ? \Carbon\Carbon::parse($order->shipped_at)->format('d M Y, H:i').' WIB' : '-'); ?></div>
                        <?php if($order->tracking_number): ?>
                            <div class="tl-time" style="margin-top:5px; background:#EDE9FE; padding:5px 10px; border-radius:8px; display:inline-flex; align-items:center; gap:5px;">
                                <i class="fas fa-barcode" style="color:#7C3AED;"></i>
                                <span style="font-family:monospace; font-weight:700; color:#5B21B6;"><?php echo e($order->tracking_number); ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>

                <?php if($order->status == 'diterima'): ?>
                <div class="tl-item">
                    <div class="tl-spine">
                        <div class="tl-dot" style="background:#D1FAE5; color:#059669;"><i class="fas fa-home"></i></div>
                    </div>
                    <div class="tl-body">
                        <div class="tl-title" style="color:#059669;">Pesanan Diterima</div>
                        <div class="tl-time"><?php echo e($order->received_at ? \Carbon\Carbon::parse($order->received_at)->format('d M Y, H:i').' WIB' : '-'); ?></div>
                    </div>
                </div>
                <?php elseif($order->status == 'ditolak'): ?>
                <div class="tl-item">
                    <div class="tl-spine">
                        <div class="tl-dot" style="background:#FEE2E2; color:#DC2626;"><i class="fas fa-times"></i></div>
                    </div>
                    <div class="tl-body">
                        <div class="tl-title" style="color:#DC2626;">Pesanan Ditolak</div>
                        <div class="tl-time"><?php echo e($order->updated_at->format('d M Y, H:i')); ?> WIB</div>
                        <?php if($order->catatan_admin): ?>
                            <div class="tl-time" style="color:#DC2626;">Alasan: <?php echo e($order->catatan_admin); ?></div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    
    <div class="col-lg-4">

        
        <?php if(in_array($order->status, ['menunggu', 'disetujui', 'packing'])): ?>
        <p class="sec-label anim-2">Aksi Admin</p>
        <div class="dash-card anim-2">
            <div class="dash-card-header" style="background:linear-gradient(135deg,#F0FDFF,#EEF9FC);">
                <div class="dash-card-title">
                    <div class="hdr-icon"><i class="fas fa-gavel"></i></div>
                    <?php if($order->status == 'menunggu'): ?> Konfirmasi Pesanan
                    <?php elseif($order->status == 'disetujui'): ?> Proses Packing
                    <?php elseif($order->status == 'packing'): ?> Kirim Pesanan
                    <?php endif; ?>
                </div>
            </div>
            <div class="dash-card-body">

                
                <?php if($order->status == 'menunggu'): ?>
                    <?php if(!$order->payment_proof): ?>
                        <div class="inline-alert warn">
                            <i class="fas fa-exclamation-triangle" style="flex-shrink:0; margin-top:1px;"></i>
                            <span>Pemesan belum mengunggah bukti pembayaran.</span>
                        </div>
                    <?php elseif($proofStatus == 'valid'): ?>
                        <div class="inline-alert success">
                            <i class="fas fa-check-circle" style="flex-shrink:0; margin-top:1px;"></i>
                            <span>Bukti sudah divalidasi sebagai <strong>VALID</strong>. Silakan setujui pesanan.</span>
                        </div>
                        <form action="<?php echo e(route('apparel.orders.approve', $order)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="field-group" style="margin-bottom:14px;">
                                <label class="field-label-sm">Catatan Persetujuan <span style="color:#94A3B8;">(opsional)</span></label>
                                <textarea name="catatan_admin" class="field-textarea-sm" rows="2"
                                          placeholder="Transfer sudah dikonfirmasi..."></textarea>
                            </div>
                            <button type="submit" class="btn-approve"
                                    onclick="return confirm('Setujui pesanan ini? Stok akan otomatis dikurangi.')">
                                <i class="fas fa-check-circle"></i> Setujui Pesanan
                            </button>
                        </form>
                    <?php elseif($proofStatus == 'invalid'): ?>
                        <div class="inline-alert danger">
                            <i class="fas fa-times-circle" style="flex-shrink:0; margin-top:1px;"></i>
                            <span>Bukti divalidasi sebagai <strong>TIDAK VALID</strong>. Silakan tolak pesanan.</span>
                        </div>
                        <form action="<?php echo e(route('apparel.orders.reject', $order)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="field-group" style="margin-bottom:14px;">
                                <label class="field-label-sm">Alasan Penolakan <span style="color:#DC2626;">*</span></label>
                                <textarea name="catatan_admin" class="field-textarea-sm" rows="2"
                                          placeholder="Nominal tidak sesuai / transfer tidak ditemukan" required></textarea>
                            </div>
                            <button type="submit" class="btn-reject"
                                    onclick="return confirm('Tolak pesanan ini?')">
                                <i class="fas fa-times-circle"></i> Tolak Pesanan
                            </button>
                        </form>
                    <?php else: ?>
                        <div class="inline-alert warn">
                            <i class="fas fa-clock" style="flex-shrink:0; margin-top:1px;"></i>
                            <span>Bukti transfer <strong>belum divalidasi</strong>. Validasi bukti terlebih dahulu di bagian kiri.</span>
                        </div>
                    <?php endif; ?>

                
                <?php elseif($order->status == 'disetujui'): ?>
                    <div class="inline-alert success">
                        <i class="fas fa-check-circle" style="flex-shrink:0; margin-top:1px;"></i>
                        <span>Pesanan sudah disetujui. Konfirmasi bahwa pesanan sedang dipacking.</span>
                    </div>
                    <form action="<?php echo e(route('apparel.orders.packing', $order)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn-packing"
                                onclick="return confirm('Konfirmasi pesanan ini sedang dipacking?')">
                            <i class="fas fa-box-open"></i> Konfirmasi Sedang Dipacking
                        </button>
                    </form>

                
                <?php elseif($order->status == 'packing'): ?>
                    <div class="inline-alert info">
                        <i class="fas fa-box-open" style="flex-shrink:0; margin-top:1px;"></i>
                        <span>Pesanan sedang dipacking. Masukkan kode resi dan tandai sudah dikirim.</span>
                    </div>
                    <form action="<?php echo e(route('apparel.orders.kirim', $order)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div style="margin-bottom:12px;">
                            <label class="field-label-sm">Kode Resi / Nomor Tracking <span style="color:#DC2626;">*</span></label>
                            <input type="text" name="tracking_number" class="field-select"
                                   placeholder="Contoh: JNE-1234567890, SICEPAT-ABC123"
                                   style="font-family:monospace; font-weight:700; letter-spacing:0.05em;"
                                   required>
                        </div>
                        <div style="margin-bottom:14px;">
                            <label class="field-label-sm">Catatan Pengiriman <span style="color:#94A3B8;">(opsional)</span></label>
                            <textarea name="catatan_admin" class="field-textarea-sm" rows="2"
                                      placeholder="Nama kurir, estimasi tiba, dll..."></textarea>
                        </div>
                        <button type="submit" class="btn-kirim"
                                onclick="return confirm('Tandai pesanan ini sudah dikirim?')">
                            <i class="fas fa-truck"></i> Tandai Sudah Dikirim
                        </button>
                    </form>
                <?php endif; ?>

            </div>
        </div>
        <?php endif; ?>

        
        <?php if(in_array($order->status, ['dikirim', 'diterima']) && $order->tracking_number): ?>
        <p class="sec-label anim-2">Info Pengiriman</p>
        <div class="dash-card anim-2">
            <div class="dash-card-header">
                <div class="dash-card-title">
                    <div class="hdr-icon"><i class="fas fa-truck"></i></div>
                    Detail Pengiriman
                </div>
            </div>
            <div class="dash-card-body">
                <div class="tracking-box">
                    <i class="fas fa-barcode"></i>
                    <div>
                        <div class="tracking-label">Nomor Resi</div>
                        <div class="tracking-code"><?php echo e($order->tracking_number); ?></div>
                    </div>
                </div>
                <?php if($order->shipped_at): ?>
                    <div style="font-size:0.8rem; color:#64748B;">
                        <i class="fas fa-calendar-check" style="color:#7C3AED; margin-right:5px;"></i>
                        Dikirim pada <?php echo e(\Carbon\Carbon::parse($order->shipped_at)->format('d M Y, H:i')); ?> WIB
                    </div>
                <?php endif; ?>
                <?php if($order->status == 'diterima' && $order->received_at): ?>
                    <div style="font-size:0.8rem; color:#059669; margin-top:6px;">
                        <i class="fas fa-home" style="margin-right:5px;"></i>
                        Diterima pemesan pada <?php echo e(\Carbon\Carbon::parse($order->received_at)->format('d M Y, H:i')); ?> WIB
                    </div>
                <?php endif; ?>
                <?php if($order->catatan_admin): ?>
                    <div style="margin-top:12px;">
                        <div class="callout-admin">
                            <div class="callout-label"><i class="fas fa-sticky-note me-1"></i> Catatan Pengiriman</div>
                            <?php echo e($order->catatan_admin); ?>

                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php endif; ?>

        
        <p class="sec-label anim-3">Informasi Pemesan</p>
        <div class="dash-card anim-3">
            <div class="dash-card-header">
                <div class="dash-card-title">
                    <div class="hdr-icon"><i class="fas fa-user-circle"></i></div>
                    Akun Pemesan
                </div>
            </div>
            <div class="dash-card-body">
                <div style="display:flex; align-items:center; gap:12px; margin-bottom:16px; padding-bottom:14px; border-bottom:1px solid #F1F5F9;">
                    <div class="user-avatar-wrap"><?php echo e(strtoupper(substr($order->user->name ?? 'U', 0, 1))); ?></div>
                    <div>
                        <div style="font-weight:700; color:#0D1B2A; font-size:0.9rem;"><?php echo e($order->user->name ?? 'N/A'); ?></div>
                        <div style="font-size:0.78rem; color:#94A3B8;"><?php echo e($order->user->email ?? 'N/A'); ?></div>
                    </div>
                </div>
                <div class="user-info-row">
                    <div class="uir-icon"><i class="fas fa-calendar"></i></div>
                    <div><div class="uir-label">Tanggal Order</div><div class="uir-value"><?php echo e($order->created_at->format('d M Y, H:i')); ?></div></div>
                </div>
                <div class="user-info-row">
                    <div class="uir-icon"><i class="fas fa-sync-alt"></i></div>
                    <div><div class="uir-label">Update Terakhir</div><div class="uir-value"><?php echo e($order->updated_at->diffForHumans()); ?></div></div>
                </div>
            </div>
        </div>

        
        <p class="sec-label anim-4">Ringkasan Harga</p>
        <div class="dash-card anim-4">
            <div class="dash-card-header">
                <div class="dash-card-title">
                    <div class="hdr-icon"><i class="fas fa-calculator"></i></div>
                    Kalkulasi
                </div>
            </div>
            <div class="dash-card-body">
                <div class="sum-row">
                    <span class="sum-label">Harga Satuan</span>
                    <span class="sum-value">Rp <?php echo e(number_format($unitPrice, 0, ',', '.')); ?></span>
                </div>
                <div class="sum-row">
                    <span class="sum-label">Jumlah</span>
                    <span class="sum-value"><?php echo e($order->qty); ?> pcs</span>
                </div>
                <div class="sum-row total">
                    <span class="sum-label">Total</span>
                    <span class="sum-value">Rp <?php echo e(number_format($totalCalc, 0, ',', '.')); ?></span>
                </div>
            </div>
        </div>

    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\qofmedia-web\resources\views/apparel/orders/show.blade.php ENDPATH**/ ?>