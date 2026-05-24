

<li class="nav-item dropdown" id="notif-nav-item">
    <a class="nav-link position-relative px-2" href="#" id="notif-bell"
       data-bs-toggle="dropdown" aria-expanded="false" title="Notifikasi"
       style="display:flex;align-items:center;">
        <i class="bi bi-bell" style="font-size:1.1rem;"></i>
        <span id="notif-badge"
              class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger d-none"
              style="font-size:9px;min-width:16px;padding:2px 4px;">0</span>
    </a>

    <div class="dropdown-menu dropdown-menu-end p-0 shadow"
         style="width:320px;max-width:95vw;" aria-labelledby="notif-bell">

        
        <div class="d-flex justify-content-between align-items-center px-3 py-2 border-bottom">
            <span class="fw-bold" style="font-size:14px;">Notifikasi</span>
            <a href="#" id="notif-mark-all"
               class="text-muted text-decoration-none"
               style="font-size:11px;">Tandai semua dibaca</a>
        </div>

        
        <div id="notif-list" style="max-height:340px;overflow-y:auto;">
            <div class="text-center text-muted py-4 small" id="notif-loading">
                <div class="spinner-border spinner-border-sm me-1" role="status"></div>
                Memuat...
            </div>
        </div>

        
        <div class="border-top text-center py-2" style="font-size:12px;">
            <?php if(auth()->guard()->check()): ?>
                <a href="<?php echo e(route('user.orders')); ?>" class="text-decoration-none">
                    Lihat semua pesanan →
                </a>
            <?php else: ?>
                <a href="<?php echo e(route('information.index')); ?>" class="text-decoration-none">
                    Lihat semua informasi →
                </a>
            <?php endif; ?>
        </div>
    </div>
</li>

<?php $__env->startPush('scripts'); ?>
<script>
(function () {
    'use strict';

    const CSRF = document.querySelector('meta[name="csrf-token"]')?.content ?? '';

    // Peta ikon & warna per tipe notifikasi
    const TYPE_MAP = {
        announcement:          { icon: 'bi-megaphone-fill',   bg: '#0d6efd' },
        order_proof_validated: { icon: 'bi-patch-check-fill', bg: '#0dcaf0' },
        order_approved:        { icon: 'bi-hand-thumbs-up-fill', bg: '#198754' },
        order_rejected:        { icon: 'bi-x-circle-fill',    bg: '#dc3545' },
    };

    /* ── Helpers ── */
    function badge() { return document.getElementById('notif-badge'); }
    function list()  { return document.getElementById('notif-list'); }

    function timeAgo(dateStr) {
        const diff = Math.floor((Date.now() - new Date(dateStr)) / 1000);
        if (diff < 60)   return 'Baru saja';
        if (diff < 3600) return Math.floor(diff / 60) + ' mnt lalu';
        if (diff < 86400) return Math.floor(diff / 3600) + ' jam lalu';
        return new Date(dateStr).toLocaleDateString('id-ID', { day:'2-digit', month:'short' });
    }

    /* ── Fetch jumlah unread (polling) ── */
    function fetchCount() {
        fetch('<?php echo e(route("notifications.unread-count")); ?>', { credentials: 'same-origin' })
            .then(r => r.json())
            .then(d => {
                const b = badge();
                if (d.count > 0) {
                    b.textContent = d.count > 99 ? '99+' : d.count;
                    b.classList.remove('d-none');
                } else {
                    b.classList.add('d-none');
                }
            })
            .catch(() => {});
    }

    /* ── Fetch list notifikasi ── */
    function fetchList() {
        list().innerHTML = `
            <div class="text-center text-muted py-4 small">
                <div class="spinner-border spinner-border-sm me-1" role="status"></div>
                Memuat...
            </div>`;

        fetch('<?php echo e(route("notifications.index")); ?>', { credentials: 'same-origin' })
            .then(r => r.json())
            .then(items => {
                if (!items.length) {
                    list().innerHTML = `
                        <div class="text-center text-muted py-4" style="font-size:13px;">
                            <i class="bi bi-bell-slash d-block mb-1" style="font-size:1.8rem;"></i>
                            Belum ada notifikasi
                        </div>`;
                    return;
                }

                list().innerHTML = items.map(n => {
                    const m   = TYPE_MAP[n.type] ?? { icon: 'bi-bell-fill', bg: '#6c757d' };
                    const dot = n.is_read ? '' : `<span class="ms-1 rounded-circle d-inline-block bg-warning"
                                                        style="width:7px;height:7px;flex-shrink:0;"></span>`;
                    return `
                    <div class="d-flex align-items-start px-3 py-2 notif-item ${n.is_read ? '' : 'notif-unread'}"
                         data-id="${n.id}" data-url="${n.url ?? ''}"
                         onclick="window.__notifClick(this)"
                         style="cursor:pointer;border-bottom:1px solid #f0f0f0;transition:background .15s;">
                        <div class="rounded-circle d-flex align-items-center justify-content-center me-2 mt-1 flex-shrink-0"
                             style="width:34px;height:34px;background:${m.bg};">
                            <i class="bi ${m.icon} text-white" style="font-size:13px;"></i>
                        </div>
                        <div class="flex-grow-1 overflow-hidden">
                            <div class="d-flex align-items-center">
                                <span class="fw-semibold text-truncate" style="font-size:13px;">${n.title}</span>
                                ${dot}
                            </div>
                            <div class="text-muted text-truncate" style="font-size:11px;">${n.message}</div>
                            <div class="text-muted" style="font-size:10px;">${timeAgo(n.created_at)}</div>
                        </div>
                    </div>`;
                }).join('');
            })
            .catch(() => {
                list().innerHTML = `<div class="text-center text-muted py-3 small">Gagal memuat notifikasi.</div>`;
            });
    }

    /* ── Klik satu notif → tandai dibaca + redirect ── */
    window.__notifClick = function (el) {
        const id  = el.dataset.id;
        const url = el.dataset.url;

        fetch(`/notifications/${id}/read`, {
            method: 'POST',
            credentials: 'same-origin',
            headers: { 'X-CSRF-TOKEN': CSRF, 'Content-Type': 'application/json' }
        }).then(() => {
            if (url) window.location.href = url;
            else { fetchCount(); fetchList(); }
        }).catch(() => {
            if (url) window.location.href = url;
        });
    };

    /* ── Tandai semua dibaca ── */
    document.getElementById('notif-mark-all')?.addEventListener('click', function (e) {
        e.preventDefault();
        e.stopPropagation();
        fetch('<?php echo e(route("notifications.read-all")); ?>', {
            method: 'POST',
            credentials: 'same-origin',
            headers: { 'X-CSRF-TOKEN': CSRF }
        }).then(() => { fetchCount(); fetchList(); }).catch(() => {});
    });

    /* ── Buka dropdown → muat list ── */
    document.getElementById('notif-bell')?.addEventListener('click', function () {
        // Tunda sedikit agar dropdown sudah terbuka
        setTimeout(fetchList, 50);
    });

    /* ── Hover style untuk notif item ── */
    document.addEventListener('mouseover', function (e) {
        const item = e.target.closest('.notif-item');
        if (item) item.style.background = '#f8f9fa';
    });
    document.addEventListener('mouseout', function (e) {
        const item = e.target.closest('.notif-item');
        if (item) item.style.background = item.classList.contains('notif-unread') ? '#fff8e1' : '';
    });

    /* ── Init: fetch count + polling tiap 30 detik ── */
    fetchCount();
    setInterval(fetchCount, 30000);
})();
</script>

<style>
.notif-unread { background: #fff8e1 !important; }
</style>
<?php $__env->stopPush(); ?><?php /**PATH C:\xampp\htdocs\qofmedia-web\resources\views/partials/navbar-notifications.blade.php ENDPATH**/ ?>