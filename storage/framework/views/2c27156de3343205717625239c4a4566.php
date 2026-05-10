<aside class="main-sidebar <?php echo e(config('adminlte.classes_sidebar', 'sidebar-dark-primary elevation-4')); ?>">

    
    <a href="<?php echo e(route('admin.dashboard')); ?>" class="brand-link">
        <span class="brand-text font-weight-light"><b>Qof</b>Media</span>
    </a>

    
    <div class="sidebar">
        
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <i class="fas fa-user-shield fa-3x text-white"></i>
            </div>
            <div class="info">
                <a href="#" class="d-block text-white"><?php echo e(Auth::user()->name); ?></a>
                <small class="text-muted">
                    <i class="fas fa-circle text-success" style="font-size: 8px;"></i> 
                    Administrator
                </small>
            </div>
        </div>

        
        <?php if(config('adminlte.sidebar_search', true)): ?>
            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" 
                           placeholder="Cari menu..." aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                
                
                <li class="nav-item">
                    <a href="<?php echo e(route('admin.dashboard')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                
                <li class="nav-header">MANAJEMEN KONTEN</li>
                
                <li class="nav-item">
                    <a href="<?php echo e(route('admin.home.edit')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.home.*') ? 'active' : ''); ?>">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Kelola Beranda</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo e(route('admin.albums.index')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.albums.*') ? 'active' : ''); ?>">
                        <i class="nav-icon fas fa-images"></i>
                        <p>Kelola Galeri</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo e(route('admin.articles.index')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.articles.*') ? 'active' : ''); ?>">
                        <i class="nav-icon fas fa-newspaper"></i>
                        <p>Kelola Artikel</p>
                    </a>
                </li>

                <li class="nav-header">MANAJEMEN TIM</li>

                <li class="nav-item">
                    <a href="<?php echo e(route('admin.divisions.index')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.divisions.*') ? 'active' : ''); ?>">
                        <i class="nav-icon fas fa-layer-group"></i>
                        <p>Divisi</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo e(route('admin.members.index')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.members.*') ? 'active' : ''); ?>">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Anggota Tim</p>
                    </a>
                </li>

                
                <li class="nav-header">MANAJEMEN SISTEM</li>

                <li class="nav-item">
                    <a href="<?php echo e(route('admin.contacts.index')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.contacts.*') ? 'active' : ''); ?>">
                        <i class="nav-icon fas fa-envelope"></i>
                        <p>
                            Pesan Kontak
                            <?php $unread = \App\Models\Contact::whereNull('read_at')->count(); ?>
                            <?php if($unread > 0): ?>
                                <span class="badge badge-danger right"><?php echo e($unread); ?></span>
                            <?php endif; ?>
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo e(route('admin.users.index')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.users.*') ? 'active' : ''); ?>">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Manajemen User</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo e(route('admin.settings.index')); ?>" class="nav-link <?php echo e(request()->routeIs('admin.settings.*') ? 'active' : ''); ?>">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>Pengaturan Website</p>
                    </a>
                </li>

                
                <li class="nav-header">LAYANAN</li>

                <li class="nav-item">
                    <a href="<?php echo e(route('service.studio')); ?>" class="nav-link" target="_blank">
                        <i class="nav-icon fas fa-camera"></i>
                        <p>Qof Studio</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo e(route('service.apparel')); ?>" class="nav-link" target="_blank">
                        <i class="nav-icon fas fa-tshirt"></i>
                        <p>Qof  Apparel</p>
                    </a>
                </li>

                
                <li class="nav-header mt-3">LAINNYA</li>

                <li class="nav-item">
                    <a href="<?php echo e(route('home')); ?>" class="nav-link" target="_blank">
                        <i class="nav-icon fas fa-globe"></i>
                        <p>Lihat Website</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo e(route('profile.edit')); ?>" class="nav-link">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>Edit Profil</p>
                    </a>
                </li>

                <li class="nav-item mt-3">
                    <<form method="POST" action="<?php echo e(route('logout')); ?>" id="logout-form-admin">
                        <?php echo csrf_field(); ?>
                        <a href="#" class="nav-link-modern logout-link" 
                            onclick="event.preventDefault(); document.getElementById('logout-form-admin').submit();">
                                <span class="nav-icon"><i class="fas fa-right-from-bracket"></i></span>
                                <span class="nav-text">Logout</span>
                        </a>
                    </form>
                </li>
            </ul>
        </nav>
    </div>
</aside><?php /**PATH C:\xampp\htdocs\qofmedia-web\resources\views/vendor/adminlte/partials/sidebar/sidebar-admin.blade.php ENDPATH**/ ?>