<aside class="main-sidebar <?php echo e(config('adminlte.classes_sidebar', 'sidebar-dark-primary elevation-4')); ?>">

    
    <a href="<?php echo e(route('apparel.dashboard')); ?>" class="brand-link">
        <span class="brand-text font-weight-light"><b>Qof</b> Apparel</span>
    </a>

    
    <div class="sidebar">
        
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <i class="fas fa-tshirt fa-2x text-white"></i>
            </div>
            <div class="info">
                <a href="#" class="d-block text-white"><?php echo e(Auth::user()->name); ?></a>
                <small class="text-muted">
                    <i class="fas fa-circle text-success" style="font-size: 8px;"></i> 
                    Admin Apparel
                </small>
            </div>
        </div>

        
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                
                
                <li class="nav-item">
                    <a href="<?php echo e(route('apparel.dashboard')); ?>" class="nav-link <?php echo e(request()->routeIs('apparel.dashboard') ? 'active' : ''); ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                
                <li class="nav-header">APPAREL MANAGEMENT</li>
                
                <li class="nav-item">
                    <a href="<?php echo e(route('apparel.categories.index')); ?>" class="nav-link <?php echo e(request()->routeIs('apparel.categories.*') ? 'active' : ''); ?>">
                        <i class="nav-icon fas fa-tags"></i>
                        <p>Kategori Produk</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo e(route('apparel.products.index')); ?>" class="nav-link <?php echo e(request()->routeIs('apparel.products.*') ? 'active' : ''); ?>">
                        <i class="nav-icon fas fa-box"></i>
                        <p>Semua Produk</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo e(route('apparel.orders.index')); ?>" class="nav-link <?php echo e(request()->routeIs('apparel.orders.*') ? 'active' : ''); ?>">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>
                            Kelola Order
                            <?php $waitingOrders = \App\Models\Order::where('status', 'menunggu')->count(); ?>
                            <?php if($waitingOrders > 0): ?>
                                <span class="badge badge-warning right"><?php echo e($waitingOrders); ?></span>
                            <?php endif; ?>
                        </p>
                    </a>
                </li>

                
                <li class="nav-header">MANAJEMEN KAOS</li>

                <li class="nav-item">
                    <a href="<?php echo e(route('apparel.editions.index')); ?>" class="nav-link <?php echo e(request()->routeIs('apparel.editions.*') ? 'active' : ''); ?>">
                        <i class="nav-icon fas fa-layer-group"></i>
                        <p>Kelola Edisi (Series)</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo e(route('apparel.models.index')); ?>" class="nav-link <?php echo e(request()->routeIs('apparel.models.*') ? 'active' : ''); ?>">
                        <i class="nav-icon fas fa-palette"></i>
                        <p>Kelola Model (Motif)</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo e(route('apparel.variants.index')); ?>" class="nav-link <?php echo e(request()->routeIs('apparel.variants.*') ? 'active' : ''); ?>">
                        <i class="nav-icon fas fa-sliders-h"></i>
                        <p>Kelola Varian</p>
                    </a>
                </li>

                
                <li class="nav-header">QUICK LINKS</li>

                <li class="nav-item">
                    <a href="<?php echo e(route('service.apparel')); ?>" class="nav-link" target="_blank">
                        <i class="nav-icon fas fa-eye"></i>
                        <p>Lihat Halaman Apparel</p>
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

                <li class="nav-item">
                    <form method="POST" action="<?php echo e(route('logout')); ?>" id="logout-form-apparel">
                        <?php echo csrf_field(); ?>
                        <a href="#" class="nav-link text-danger" 
                           onclick="event.preventDefault(); document.getElementById('logout-form-apparel').submit();">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>Logout</p>
                        </a>
                    </form>
                </li>
            </ul>
        </nav>
    </div>
</aside><?php /**PATH C:\xampp\htdocs\qofmedia-web\resources\views/vendor/adminlte/partials/sidebar/sidebar-apparel.blade.php ENDPATH**/ ?>