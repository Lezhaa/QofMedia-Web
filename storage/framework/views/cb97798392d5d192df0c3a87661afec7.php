<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="<?php echo e(route('home')); ?>">
    <?php
        $logoPath = \App\Models\Setting::where('key', 'site_logo')->value('value');
        $logoFullPath = $logoPath ? public_path('storage/' . $logoPath) : null;
        $defaultLogo = 'images/logo/logo-qof-light.png';
    ?>
    
    <?php if($logoPath && file_exists($logoFullPath)): ?>
        <img src="<?php echo e(asset('storage/' . $logoPath)); ?>" alt="QofMedia">
    <?php elseif(file_exists(public_path($defaultLogo))): ?>
        <img src="<?php echo e(asset($defaultLogo)); ?>" alt="QofMedia">
    <?php else: ?>
        <i class="bi bi-camera-reels-fill me-1"></i>
        <span>QofMedia</span>
    <?php endif; ?>
</a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" style="padding: 0.25rem 0.5rem;">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->routeIs('home') ? 'active' : ''); ?>" href="<?php echo e(route('home')); ?>">Beranda</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?php echo e(request()->routeIs('about.*') ? 'active' : ''); ?>" href="#" data-bs-toggle="dropdown">
                        Tentang
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?php echo e(route('about.profile')); ?>">Profil</a></li>
                        <li><a class="dropdown-item" href="<?php echo e(route('about.structure')); ?>">Struktur</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->routeIs('information.*') ? 'active' : ''); ?>" href="<?php echo e(route('information.index')); ?>">Informasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->routeIs('gallery.*') ? 'active' : ''); ?>" href="<?php echo e(route('gallery.index')); ?>">Galeri</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?php echo e(request()->routeIs('service.*') ? 'active' : ''); ?>" href="#" data-bs-toggle="dropdown">
                        Layanan
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?php echo e(route('service.studio')); ?>">Studio</a></li>
                        <li><a class="dropdown-item" href="<?php echo e(route('service.apparel')); ?>">Apparel</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->routeIs('contact') ? 'active' : ''); ?>" href="<?php echo e(route('contact')); ?>">Kontak</a>
                </li>
            </ul>
            
            <ul class="navbar-nav ms-auto">
                <?php if(auth()->guard()->check()): ?>
                    <?php
                        $user = Auth::user();
                        $isAdmin = $user->hasAnyRole(['admin_qofmedia', 'admin_studio', 'admin_apparel']);
                    ?>
                    
                    <?php if($isAdmin): ?>
                        
                        <li class="nav-item dropdown">
                            <a class="nav-link user-dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle"></i>
                                <span><?php echo e(Str::limit($user->name, 10)); ?></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <?php if($user->hasRole('admin_qofmedia')): ?>
                                    <li><a class="dropdown-item" href="<?php echo e(route('admin.dashboard')); ?>"><i class="bi bi-speedometer2 me-2"></i>Dashboard Admin</a></li>
                                <?php elseif($user->hasRole('admin_studio')): ?>
                                    <li><a class="dropdown-item" href="<?php echo e(route('studio.dashboard')); ?>"><i class="bi bi-speedometer2 me-2"></i>Dashboard Studio</a></li>
                                <?php elseif($user->hasRole('admin_apparel')): ?>
                                    <li><a class="dropdown-item" href="<?php echo e(route('apparel.dashboard')); ?>"><i class="bi bi-speedometer2 me-2"></i>Dashboard Apparel</a></li>
                                <?php endif; ?>
                                <li><a class="dropdown-item" href="<?php echo e(route('profile.edit')); ?>"><i class="bi bi-person me-2"></i>Profil</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="bi bi-box-arrow-right me-2"></i>Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    <?php else: ?>
                        
                        <li class="nav-item dropdown">
                            <a class="nav-link user-dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle"></i>
                                <span><?php echo e(Str::limit($user->name, 10)); ?></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="<?php echo e(route('user.orders')); ?>"><i class="bi bi-bag me-2"></i>Pesanan Saya</a></li>
                                <li><a class="dropdown-item" href="<?php echo e(route('profile.edit')); ?>"><i class="bi bi-person me-2"></i>Profil</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="bi bi-box-arrow-right me-2"></i>Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link nav-auth-btn nav-login" href="<?php echo e(route('login')); ?>">Masuk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-auth-btn nav-register" href="<?php echo e(route('register')); ?>">Daftar</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav><?php /**PATH C:\xampp\htdocs\qofmedia-web\resources\views/partials/navbar.blade.php ENDPATH**/ ?>