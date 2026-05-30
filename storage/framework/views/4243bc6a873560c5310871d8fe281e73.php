<aside class="main-sidebar <?php echo e(config('adminlte.classes_sidebar', 'sidebar-dark-primary elevation-4')); ?>">

    
    <a href="<?php echo e(route('studio.dashboard')); ?>" class="brand-link">
        <span class="brand-text font-weight-light"><b>Qof</b> Studio</span>
    </a>

    
    <div class="sidebar">
        
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <i class="fas fa-camera fa-2x text-white"></i>
            </div>
            <div class="info">
                <a href="#" class="d-block text-white"><?php echo e(Auth::user()->name); ?></a>
                <small class="text-muted">
                    <i class="fas fa-circle text-info" style="font-size: 8px;"></i> 
                    Admin Studio
                </small>
            </div>
        </div>

        
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                
                
                <li class="nav-item">
                    <a href="<?php echo e(route('studio.dashboard')); ?>" class="nav-link <?php echo e(request()->routeIs('studio.dashboard') ? 'active' : ''); ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                
                <li class="nav-header">STUDIO MANAGEMENT</li>
                
                <li class="nav-item">
                    <a href="<?php echo e(route('studio.tools.index')); ?>" class="nav-link <?php echo e(request()->routeIs('studio.tools.*') ? 'active' : ''); ?>">
                        <i class="nav-icon fas fa-tools"></i>
                        <p>Alat Sewa</p>
                        <?php $totalTools = \App\Models\RentalTool::count(); ?>
                        <span class="badge badge-info right"><?php echo e($totalTools); ?></span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo e(route('studio.rental-bookings.index')); ?>" class="nav-link <?php echo e(request()->routeIs('studio.rental-bookings.*') ? 'active' : ''); ?>">
                        <i class="nav-icon fas fa-calendar-check"></i>
                        <p>Pemesanan Sewa</p>
                        <?php $pendingBookings = \App\Models\RentalBooking::where('status','menunggu')->count(); ?>
                        <?php if($pendingBookings > 0): ?>
                            <span class="badge badge-warning right"><?php echo e($pendingBookings); ?></span>
                        <?php endif; ?>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo e(route('studio.packages.index')); ?>" class="nav-link <?php echo e(request()->routeIs('studio.packages.*') ? 'active' : ''); ?>">
                        <i class="nav-icon fas fa-video"></i>
                        <p>Paket Studio</p>
                        <?php $totalPackages = \App\Models\StudioPackage::count(); ?>
                        <span class="badge badge-info right"><?php echo e($totalPackages); ?></span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo e(route('studio.photo-packages.index')); ?>" class="nav-link <?php echo e(request()->routeIs('studio.photo-packages.*') ? 'active' : ''); ?>">
                        <i class="nav-icon fas fa-camera-retro"></i>
                        <p>Paket Fotografi</p>
                        <?php $totalPhoto = \App\Models\PhotoPackage::count(); ?>
                        <span class="badge badge-info right"><?php echo e($totalPhoto); ?></span>
                    </a>
                </li>

                
                <li class="nav-header">QUICK LINKS</li>

                <li class="nav-item">
                    <a href="<?php echo e(route('service.studio')); ?>" class="nav-link" target="_blank">
                        <i class="nav-icon fas fa-eye"></i>
                        <p>Lihat Halaman Studio</p>
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
                    <form method="POST" action="<?php echo e(route('logout')); ?>" id="logout-form-studio">
                    <?php echo csrf_field(); ?>
                    <a href="#" class="nav-link-modern logout-link" 
                       onclick="event.preventDefault(); document.getElementById('logout-form-studio').submit();">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>Logout</p>
                        </a>
                    </form>
                </li>
            </ul>
        </nav>
    </div>
</aside><?php /**PATH C:\xampp\htdocs\qofmedia-web\resources\views/vendor/adminlte/partials/sidebar/sidebar-studio.blade.php ENDPATH**/ ?>