

<li class="nav-item" id="notif-nav-item" style="position:relative;">

    
    <a class="nav-link position-relative px-2" href="#" id="notif-bell"
       title="Notifikasi" style="display:flex;align-items:center;">
        <i class="bi bi-bell" style="font-size:1.1rem;"></i>
        <span id="notif-badge"
              class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger d-none"
              style="font-size:9px;min-width:16px;padding:2px 4px;">0</span>
    </a>

    
    <div id="notif-panel"
         style="display:none;position:absolute;top:calc(100% + 10px);right:0;
                width:340px;max-width:92vw;z-index:9999;
                background:#fff;border-radius:16px;
                box-shadow:0 8px 32px rgba(9,24,40,0.18),0 1.5px 6px rgba(9,24,40,0.08);
                border:1px solid #E2E8F0;overflow:hidden;">

        
        <div style="display:flex;justify-content:space-between;align-items:center;
                    padding:12px 16px 10px;border-bottom:1px solid #F1F5F9;">
            <div style="display:flex;align-items:center;gap:8px;">
                <i class="bi bi-bell-fill" style="color:#0E7A96;font-size:14px;"></i>
                <span style="font-weight:700;font-size:14px;color:#0D1B2A;">Notifikasi</span>
            </div>
            <a href="#" id="notif-mark-all"
               style="font-size:11px;color:#0E7A96;font-weight:600;text-decoration:none;">
                Tandai semua dibaca
            </a>
        </div>

        
        <div id="notif-list" style="max-height:380px;overflow-y:auto;">
            <div style="text-align:center;padding:32px 16px;color:#94A3B8;font-size:13px;" id="notif-empty-state">
                <div class="spinner-border spinner-border-sm" role="status" style="color:#0E7A96;"></div>
                <div style="margin-top:8px;">Memuat...</div>
            </div>
        </div>

        
        <div style="border-top:1px solid #F1F5F9;text-align:center;padding:10px;background:#FAFCFF;">
            <?php if(auth()->guard()->check()): ?>
                <a href="<?php echo e(route('user.orders')); ?>"
                   style="font-size:12px;color:#0E7A96;font-weight:600;text-decoration:none;">
                    Lihat semua pesanan →
                </a>
            <?php else: ?>
                <a href="<?php echo e(route('information.index')); ?>"
                   style="font-size:12px;color:#0E7A96;font-weight:600;text-decoration:none;">
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

    const CSRF  = document.querySelector('meta[name="csrf-token"]')?.content ?? '';
    const bell  = document.getElementById('notif-bell');
    const panel = document.getElementById('notif-panel');
    const list  = document.getElementById('notif-list');

    /* ── Tipe ikon & warna ── */
    const TYPE_MAP = {
        announcement:           { icon: 'bi-megaphone-fill',       bg: '#0d6efd', label: 'Pengumuman' },
        order_proof_validated:  { icon: 'bi-patch-check-fill',     bg: '#0E7A96', label: 'Pesanan' },
        order_approved:         { icon: 'bi-hand-thumbs-up-fill',  bg: '#198754', label: 'Pesanan' },
        order_rejected:         { icon: 'bi-x-circle-fill',        bg: '#dc3545', label: 'Pesanan' },
        order_packing:          { icon: 'bi-box-seam-fill',        bg: '#0E7A96', label: 'Pesanan' },
        order_shipped:          { icon: 'bi-truck',                bg: '#6f42c1', label: 'Pesanan' },
        rental_proof_validated: { icon: 'bi-patch-check-fill',     bg: '#0E7A96', label: 'Sewa' },
        rental_proof_invalid:   { icon: 'bi-x-circle-fill',        bg: '#dc3545', label: 'Sewa' },
        rental_approved:        { icon: 'bi-hand-thumbs-up-fill',  bg: '#198754', label: 'Sewa' },
        rental_rejected:        { icon: 'bi-x-circle-fill',        bg: '#dc3545', label: 'Sewa' },
        rental_active:          { icon: 'bi-tools',                bg: '#6f42c1', label: 'Sewa' },
        rental_done:            { icon: 'bi-flag-fill',            bg: '#198754', label: 'Sewa' },
    };

    function timeAgo(dateStr) {
        const diff = Math.floor((Date.now() - new Date(dateStr)) / 1000);
        if (diff < 60)    return 'Baru saja';
        if (diff < 3600)  return Math.floor(diff / 60) + ' mnt lalu';
        if (diff < 86400) return Math.floor(diff / 3600) + ' jam lalu';
        return new Date(dateStr).toLocaleDateString('id-ID', { day:'2-digit', month:'short' });
    }

    function esc(str) {
        return (str ?? '').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
    }

    /* ── Badge ── */
    function updateBadge(count) {
        const b = document.getElementById('notif-badge');
        if (count > 0) {
            b.textContent = count > 99 ? '99+' : count;
            b.classList.remove('d-none');
        } else {
            b.classList.add('d-none');
        }
    }

    function fetchCount() {
        fetch('<?php echo e(route("notifications.unread-count")); ?>', { credentials: 'same-origin' })
            .then(r => r.json()).then(d => updateBadge(d.count)).catch(() => {});
    }

    /* ── Panel buka/tutup ── */
    let panelOpen = false;

    function openPanel() {
        panel.style.display = 'block';
        panelOpen = true;
        fetchList();
    }

    function closePanel() {
        panel.style.display = 'none';
        panelOpen = false;
    }

    bell.addEventListener('click', function (e) {
        e.preventDefault();
        e.stopPropagation();
        panelOpen ? closePanel() : openPanel();
    });

    // Tutup jika klik di luar panel
    document.addEventListener('click', function (e) {
        if (panelOpen && !panel.contains(e.target) && !bell.contains(e.target)) {
            closePanel();
        }
    });

    // Tutup jika Bootstrap navbar collapse menutup (mobile)
    document.addEventListener('hide.bs.collapse', function () {
        closePanel();
    });

    /* ── Render list ── */
    function fetchList() {
        list.innerHTML = `
            <div style="text-align:center;padding:32px 16px;color:#94A3B8;font-size:13px;">
                <div class="spinner-border spinner-border-sm" role="status" style="color:#0E7A96;"></div>
                <div style="margin-top:8px;">Memuat...</div>
            </div>`;

        fetch('<?php echo e(route("notifications.index")); ?>', { credentials: 'same-origin' })
            .then(r => {
                if (!r.ok) throw new Error('HTTP ' + r.status);
                return r.json();
            })
            .then(items => renderItems(items))
            .catch(() => {
                list.innerHTML = `<div style="text-align:center;padding:24px;font-size:13px;color:#94A3B8;">
                    <i class="bi bi-wifi-off" style="font-size:1.8rem;display:block;margin-bottom:8px;"></i>
                    Gagal memuat notifikasi
                </div>`;
            });
    }

    function renderItems(items) {
        if (!items.length) {
            list.innerHTML = `
                <div style="text-align:center;padding:40px 16px;color:#94A3B8;">
                    <i class="bi bi-bell-slash" style="font-size:2.2rem;display:block;margin-bottom:8px;color:#CBD5E1;"></i>
                    <div style="font-size:13px;font-weight:600;color:#64748B;">Belum ada notifikasi</div>
                    <div style="font-size:11px;margin-top:4px;">Notifikasi akan muncul di sini</div>
                </div>`;
            return;
        }

        list.innerHTML = items.map(n => {
            const m       = TYPE_MAP[n.type] ?? { icon: 'bi-bell-fill', bg: '#64748b', label: '' };
            const isUnread = !n.is_read;
            // Simpan URL mentah di dataset (tidak di-escape untuk atribut HTML biasa)
            // Gunakan data attribute lewat JS setAttribute agar aman dari quote injection
            const title   = esc(n.title ?? '');
            const message = esc(n.message ?? '');
            const hasUrl  = n.url && n.url !== '#' && n.url.trim() !== '';

            return `
            <div class="notif-item${isUnread ? ' notif-unread' : ''}"
                 data-id="${n.id}"
                 style="display:flex;align-items:flex-start;padding:12px 16px;
                        cursor:${hasUrl ? 'pointer' : 'default'};
                        border-bottom:1px solid #F1F5F9;
                        background:${isUnread ? '#FFF9EC' : '#fff'};
                        transition:background .15s;">
                <div style="width:38px;height:38px;border-radius:50%;background:${m.bg};
                            display:flex;align-items:center;justify-content:center;
                            flex-shrink:0;margin-right:12px;margin-top:2px;">
                    <i class="bi ${m.icon}" style="font-size:15px;color:#fff;"></i>
                </div>
                <div style="flex:1;min-width:0;">
                    <div style="display:flex;align-items:center;justify-content:space-between;gap:6px;">
                        <span style="font-size:13px;font-weight:${isUnread ? '700' : '600'};color:#0D1B2A;
                                     white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">${title}</span>
                        ${isUnread ? `<span style="width:8px;height:8px;border-radius:50%;
                                                  background:#f59e0b;flex-shrink:0;"></span>` : ''}
                    </div>
                    <div style="font-size:11.5px;color:#64748B;margin-top:2px;
                                white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">${message}</div>
                    <div style="font-size:10px;color:#94A3B8;margin-top:4px;">
                        ${m.label ? `<span style="background:#F1F5F9;color:#64748B;font-size:9.5px;
                                               font-weight:600;padding:1px 6px;border-radius:20px;
                                               margin-right:5px;text-transform:uppercase;">${m.label}</span>` : ''}
                        ${timeAgo(n.created_at)}
                        ${hasUrl ? `<i class="bi bi-arrow-right-short" style="color:#0E7A96;font-size:12px;"></i>` : ''}
                    </div>
                </div>
            </div>`;
        }).join('');

        // Attach URL dari JSON (bukan dari DOM attribute) agar aman
        items.forEach((n, i) => {
            const el = list.querySelectorAll('.notif-item')[i];
            if (!el) return;
            const hasUrl = n.url && n.url !== '#' && n.url.trim() !== '';
            if (hasUrl) {
                // Simpan URL asli di property JS, bukan HTML attribute
                el._notifUrl = n.url;
            }
            el.addEventListener('click', function (e) {
                e.stopPropagation();
                handleNotifClick(n.id, el._notifUrl ?? null, el);
            });
        });
    }

    /* ── Klik notif: tandai dibaca + redirect ── */
    function handleNotifClick(id, url, el) {
        // Langsung navigasi dulu jika ada URL
        const hasUrl = url && url.trim() !== '';

        // Tandai baca (fire-and-forget)
        fetch(`/notifications/${id}/read`, {
            method: 'POST',
            credentials: 'same-origin',
            headers: { 'X-CSRF-TOKEN': CSRF, 'Content-Type': 'application/json' }
        })
        .then(() => {
            // Update badge
            fetchCount();
            // Update visual item sebagai sudah dibaca
            if (el) {
                el.classList.remove('notif-unread');
                el.style.background = '#fff';
                el.style.fontWeight  = '600';
                const dot = el.querySelector('span[style*="background:#f59e0b"]');
                if (dot) dot.remove();
            }
        })
        .catch(() => {});

        // Navigasi segera (tidak menunggu fetch)
        if (hasUrl) {
            closePanel();
            window.location.href = url;
        }
    }

    /* ── Tandai semua dibaca ── */
    document.getElementById('notif-mark-all')?.addEventListener('click', function (e) {
        e.preventDefault();
        e.stopPropagation();
        fetch('<?php echo e(route("notifications.read-all")); ?>', {
            method: 'POST',
            credentials: 'same-origin',
            headers: { 'X-CSRF-TOKEN': CSRF }
        })
        .then(() => { updateBadge(0); fetchList(); })
        .catch(() => {});
    });

    /* ── Hover style ── */
    list.addEventListener('mouseover', function (e) {
        const item = e.target.closest('.notif-item');
        if (item) item.style.background = '#EFF6FF';
    });
    list.addEventListener('mouseout', function (e) {
        const item = e.target.closest('.notif-item');
        if (item) item.style.background = item.classList.contains('notif-unread') ? '#FFF9EC' : '#fff';
    });

    /* ── Init ── */
    fetchCount();
    setInterval(fetchCount, 30000);
})();
</script>

<style>
.notif-item:last-child { border-bottom: none !important; }
#notif-list::-webkit-scrollbar { width: 4px; }
#notif-list::-webkit-scrollbar-track { background: #F8FAFC; }
#notif-list::-webkit-scrollbar-thumb { background: #CBD5E1; border-radius: 4px; }
</style>
<?php $__env->stopPush(); ?><?php /**PATH C:\xampp\htdocs\qofmedia-web\resources\views/partials/navbar-notifications.blade.php ENDPATH**/ ?>