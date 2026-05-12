

<?php $__env->startSection('title', 'Manajemen Anggota Tim'); ?>

<?php $__env->startSection('content_header'); ?>
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="mb-0" style="font-size: 1.4rem; font-weight: 700; color: #0D1B2A;">
                <i class="fas fa-users me-2" style="color: #0E7A96;"></i> Manajemen Anggota Tim
            </h1>
            <ol class="breadcrumb mb-0 mt-1" style="font-size: 0.8rem; background: transparent; padding: 0;">
                <li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>">Dashboard</a></li>
                <li class="breadcrumb-item active">Anggota Tim</li>
            </ol>
        </div>
        <a href="<?php echo e(route('admin.members.create')); ?>"
           style="display:inline-flex; align-items:center; gap:7px; background:#0E7A96; color:#fff; padding:10px 22px; border-radius:50px; font-weight:700; font-size:0.88rem; text-decoration:none; border:none; transition:all 0.3s;">
            <i class="fas fa-plus"></i> Tambah Anggota
        </a>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<style>
    /* ============================================
       ALERT
       ============================================ */
    .alert-success-custom {
        border-radius: 12px;
        border: none;
        background: #D1FAE5;
        color: #065F46;
        font-size: 0.88rem;
        padding: 12px 18px;
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 20px;
    }

    /* ============================================
       STATS BAR
       ============================================ */
    .stats-bar {
        display: flex;
        gap: 12px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }
    .stat-chip {
        background: #fff;
        border: 1px solid #E2E8F0;
        border-radius: 12px;
        padding: 10px 18px;
        font-size: 0.82rem;
        color: #64748B;
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: 500;
    }
    .stat-chip strong { color: #0D1B2A; font-size: 1rem; font-weight: 700; }
    .stat-chip i { color: #0E7A96; }

    /* ============================================
       FILTER BAR
       ============================================ */
    .filter-bar {
        background: #fff;
        border: 1px solid #E2E8F0;
        border-radius: 14px;
        padding: 14px 20px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }
    .filter-bar input,
    .filter-bar select {
        border: 1.5px solid #E2E8F0;
        border-radius: 8px;
        padding: 8px 14px;
        font-size: 0.85rem;
        outline: none;
        color: #0D1B2A;
        background: #F8FAFC;
        transition: border-color 0.2s;
    }
    .filter-bar input  { flex: 1; min-width: 180px; }
    .filter-bar input:focus,
    .filter-bar select:focus { border-color: #0E7A96; background: #fff; }

    /* ============================================
       MAIN CARD
       ============================================ */
    .members-card {
        background: #fff;
        border: 1px solid #E2E8F0;
        border-radius: 20px;
        overflow: hidden;
    }

    /* ============================================
       TABLE
       ============================================ */
    .members-table { width: 100%; border-collapse: collapse; }

    .members-table thead th {
        background: #F8FAFC;
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: #94A3B8;
        padding: 13px 20px;
        border-bottom: 1px solid #F1F5F9;
        white-space: nowrap;
    }

    .members-table tbody tr {
        border-bottom: 1px solid #F8FAFC;
        transition: background 0.15s;
    }
    .members-table tbody tr:last-child { border-bottom: none; }
    .members-table tbody tr:hover { background: #FAFCFE; }

    .members-table tbody td {
        padding: 14px 20px;
        vertical-align: middle;
        font-size: 0.88rem;
        color: #0D1B2A;
    }

    /* Avatar */
    .mem-avatar {
        width: 52px; height: 52px;
        border-radius: 10px;
        object-fit: cover;
        display: block;
        border: 1px solid #E2E8F0;
    }
    .mem-avatar-initial {
        width: 52px; height: 52px;
        border-radius: 10px;
        background: linear-gradient(135deg, #0E7A96, #0a5a70);
        display: flex; align-items: center; justify-content: center;
        color: #fff;
        font-size: 1.1rem;
        font-weight: 700;
        flex-shrink: 0;
        letter-spacing: -0.02em;
    }

    /* Name cell */
    .mem-name {
        font-weight: 700;
        color: #0D1B2A;
        font-size: 0.9rem;
        margin-bottom: 3px;
        line-height: 1.4;
    }
    .mem-position {
        font-size: 0.76rem;
        color: #94A3B8;
        line-height: 1.5;
    }

    /* Nickname */
    .mem-nickname {
        font-size: 0.83rem;
        color: #64748B;
        font-weight: 500;
    }

    /* Division badge */
    .badge-div {
        display: inline-block;
        padding: 3px 10px;
        background: rgba(14,122,150,0.08);
        color: #0E7A96;
        border-radius: 50px;
        font-size: 0.7rem;
        font-weight: 700;
        white-space: nowrap;
        margin: 2px 2px 2px 0;
    }

    /* Status badge */
    .badge-status {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        border-radius: 50px;
        padding: 4px 12px;
        font-size: 0.72rem;
        font-weight: 700;
        white-space: nowrap;
    }
    .badge-status.active   { background: rgba(5,150,105,0.09); color: #059669; }
    .badge-status.inactive { background: rgba(100,116,139,0.09); color: #64748B; }
    .badge-status .dot {
        width: 6px; height: 6px;
        border-radius: 50%;
    }
    .badge-status.active   .dot { background: #059669; }
    .badge-status.inactive .dot { background: #94A3B8; }

    /* Social link */
    .mem-social {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 0.82rem;
        color: #0E7A96;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.2s;
    }
    .mem-social:hover { color: #0a5a70; text-decoration: none; }

    /* Order badge */
    .badge-order {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 28px; height: 28px;
        border-radius: 8px;
        background: #F1F5F9;
        color: #64748B;
        font-size: 0.78rem;
        font-weight: 700;
    }

    /* Action buttons */
    .act-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px; height: 32px;
        border-radius: 8px;
        border: none;
        font-size: 0.8rem;
        text-decoration: none;
        transition: all 0.2s;
        cursor: pointer;
    }
    .act-btn.edit   { background: rgba(217,119,6,0.09);  color: #D97706; }
    .act-btn.delete { background: rgba(220,38,38,0.09);  color: #DC2626; }
    .act-btn:hover  { filter: brightness(0.88); transform: scale(1.08); text-decoration: none; }

    /* ============================================
       EMPTY STATE
       ============================================ */
    .empty-state {
        text-align: center;
        padding: 70px 20px;
    }
    .empty-icon-wrap {
        width: 80px; height: 80px;
        background: #EEF9FC;
        border-radius: 24px;
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 18px;
        font-size: 2rem;
        color: #0E7A96;
        opacity: 0.6;
    }
    .empty-state h5 { font-weight: 700; color: #0D1B2A; margin-bottom: 6px; }
    .empty-state p  { color: #94A3B8; font-size: 0.88rem; margin-bottom: 20px; }

    /* ============================================
       PAGINATION FIX
       ============================================ */
    .pagination .page-link svg { display: none !important; }
    .pagination .page-item:first-child .page-link::after { content: '« Prev'; }
    .pagination .page-item:last-child  .page-link::after { content: 'Next »'; }

    .pagination { gap: 4px; flex-wrap: wrap; }
    .pagination .page-link {
        border-radius: 8px !important;
        padding: 7px 14px;
        font-size: 0.85rem;
        font-weight: 600;
        color: #0D1B2A;
        border: 1.5px solid #E2E8F0;
        background: #fff;
        transition: all 0.2s;
    }
    .pagination .page-link:hover { background: #0E7A96; color: #fff; border-color: #0E7A96; }
    .pagination .page-item.active .page-link {
        background: #0E7A96; border-color: #0E7A96; color: #fff;
        box-shadow: 0 4px 12px rgba(14,122,150,0.25);
    }
    .pagination .page-item.disabled .page-link {
        background: #F8FAFC; color: #CBD5E1; border-color: #E2E8F0;
    }

    /* Footer pagination wrapper */
    .card-foot {
        padding: 14px 20px;
        border-top: 1px solid #F1F5F9;
        display: flex;
        justify-content: center;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    
    <?php if(session('success')): ?>
        <div class="alert-success-custom alert-dismissible">
            <i class="fas fa-check-circle"></i> <?php echo e(session('success')); ?>

            <button type="button" class="close ml-auto" data-dismiss="alert"
                    style="background:none; border:none; cursor:pointer; color:#065F46; font-size:1rem;">&times;</button>
        </div>
    <?php endif; ?>

    
    <div class="stats-bar">
        <div class="stat-chip">
            <i class="fas fa-users"></i>
            Total Anggota: <strong><?php echo e($members->total()); ?></strong>
        </div>
        <div class="stat-chip">
            <i class="fas fa-user-check"></i>
            Halaman ini: <strong><?php echo e($members->count()); ?></strong>
        </div>
    </div>

    
    <div class="filter-bar">
        <i class="fas fa-search" style="color:#CBD5E1; font-size:0.9rem; flex-shrink:0;"></i>
        <input type="text" id="searchInput" placeholder="Cari nama atau panggilan..." oninput="filterRows()">
        <select id="divFilter" onchange="filterRows()">
            <option value="">Semua Divisi</option>
            <?php $__currentLoopData = $divisions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $div): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e(strtolower($div->name)); ?>"><?php echo e($div->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <select id="statusFilter" onchange="filterRows()">
            <option value="">Semua Status</option>
            <option value="aktif">Aktif</option>
            <option value="nonaktif">Nonaktif</option>
        </select>
    </div>

    
    <div class="members-card">
        <?php if($members->isEmpty()): ?>
            <div class="empty-state">
                <div class="empty-icon-wrap"><i class="fas fa-users"></i></div>
                <h5>Belum Ada Anggota Tim</h5>
                <p>Mulai tambahkan anggota tim pertama Anda.</p>
                <a href="<?php echo e(route('admin.members.create')); ?>"
                   style="display:inline-flex; align-items:center; gap:6px; background:#0E7A96; color:#fff; padding:10px 24px; border-radius:50px; font-weight:700; font-size:0.88rem; text-decoration:none;">
                    <i class="fas fa-plus"></i> Tambah Anggota
                </a>
            </div>
        <?php else: ?>
            <div style="overflow-x: auto;">
                <table class="members-table" id="membersTable">
                    <thead>
                        <tr>
                            <th style="width:40px;">#</th>
                            <th style="width:60px;"></th>
                            <th>Nama</th>
                            <th>Panggilan</th>
                            <th>Divisi</th>
                            <th>Media Sosial</th>
                            <th>Status</th>
                            <th style="width:60px; text-align:center;">Urutan</th>
                            <th style="width:90px; text-align:center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $divNames = $member->divisions->pluck('name')->map(fn($n) => strtolower($n))->implode(' ');
                                $statusLabel = $member->is_active ? 'aktif' : 'nonaktif';
                            ?>
                            <tr class="mem-row"
                                data-name="<?php echo e(strtolower($member->name . ' ' . $member->nickname)); ?>"
                                data-div="<?php echo e($divNames); ?>"
                                data-status="<?php echo e($statusLabel); ?>">
                                <td style="color:#CBD5E1; font-size:0.8rem; font-weight:600;">
                                    <?php echo e($loop->iteration + ($members->currentPage() - 1) * $members->perPage()); ?>

                                </td>
                                <td>
                                    <?php if($member->photo_url): ?>
                                        <img src="<?php echo e($member->photo_url); ?>"
                                             class="mem-avatar" alt="<?php echo e($member->name); ?>">
                                    <?php else: ?>
                                        <div class="mem-avatar-initial">
                                            <?php echo e(strtoupper(substr($member->nickname ?? $member->name, 0, 1))); ?>

                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td style="max-width: 200px;">
                                    <div class="mem-name"><?php echo e($member->name); ?></div>
                                    <?php if($member->position): ?>
                                        <div class="mem-position"><?php echo e($member->position); ?></div>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <span class="mem-nickname"><?php echo e($member->nickname); ?></span>
                                </td>
                                <td style="max-width: 180px;">
                                    <?php $__empty_1 = true; $__currentLoopData = $member->divisions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $div): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <span class="badge-div"><?php echo e($div->name); ?></span>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <span style="color:#CBD5E1; font-size:0.8rem;">—</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($member->social_platform && $member->social_username): ?>
                                        <a href="<?php echo e($member->social_url); ?>" target="_blank" class="mem-social">
                                            <i class="fab fa-<?php echo e($member->social_platform); ?>"></i>
                                            <?php echo e(ucfirst($member->social_platform)); ?>

                                        </a>
                                    <?php else: ?>
                                        <span style="color:#CBD5E1; font-size:0.8rem;">—</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($member->is_active): ?>
                                        <span class="badge-status active">
                                            <span class="dot"></span> Aktif
                                        </span>
                                    <?php else: ?>
                                        <span class="badge-status inactive">
                                            <span class="dot"></span> Nonaktif
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td style="text-align:center;">
                                    <span class="badge-order"><?php echo e($member->order); ?></span>
                                </td>
                                <td>
                                    <div style="display:flex; align-items:center; justify-content:center; gap:6px;">
                                        <a href="<?php echo e(route('admin.members.edit', $member)); ?>"
                                           class="act-btn edit" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="<?php echo e(route('admin.members.destroy', $member)); ?>"
                                              method="POST" style="margin:0;"
                                              onsubmit="return confirm('Yakin ingin menghapus anggota \'<?php echo e(addslashes($member->name)); ?>\'?')">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="act-btn delete" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            <?php if($members->hasPages()): ?>
                <div class="card-foot">
                    <?php echo e($members->links()); ?>

                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script>
function filterRows() {
    var search = document.getElementById('searchInput').value.toLowerCase();
    var div    = document.getElementById('divFilter').value.toLowerCase();
    var status = document.getElementById('statusFilter').value.toLowerCase();

    document.querySelectorAll('.mem-row').forEach(function (row) {
        var matchName   = row.dataset.name.includes(search);
        var matchDiv    = !div    || row.dataset.div.includes(div);
        var matchStatus = !status || row.dataset.status === status;
        row.style.display = matchName && matchDiv && matchStatus ? '' : 'none';
    });
}
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('adminlte::page', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\qofmedia-web\resources\views/admin/members/index.blade.php ENDPATH**/ ?>