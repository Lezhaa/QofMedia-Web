<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            @php
                $logoPath = setting('site_logo', 'images/logo/logo-qof-light.png');
            @endphp
            @if(file_exists(public_path($logoPath)))
                <img src="{{ asset($logoPath) }}" alt="QofMedia">
            @else
                <i class="bi bi-camera-reels-fill me-1"></i>
                <span>QofMedia</span>
            @endif
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" style="padding: 0.25rem 0.5rem;">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('about.*') ? 'active' : '' }}" href="#" data-bs-toggle="dropdown">
                        Tentang
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('about.profile') }}">Profil</a></li>
                        <li><a class="dropdown-item" href="{{ route('about.structure') }}">Struktur</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('information.*') ? 'active' : '' }}" href="{{ route('information.index') }}">Informasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('gallery.*') ? 'active' : '' }}" href="{{ route('gallery.index') }}">Galeri</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('service.*') ? 'active' : '' }}" href="#" data-bs-toggle="dropdown">
                        Layanan
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('service.studio') }}">Studio</a></li>
                        <li><a class="dropdown-item" href="{{ route('service.apparel') }}">Apparel</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Kontak</a>
                </li>
            </ul>
            
            <ul class="navbar-nav ms-auto">
                @auth
                    @php
                        $user = Auth::user();
                        $isAdmin = $user->hasAnyRole(['admin_qofmedia', 'admin_studio', 'admin_apparel']);
                    @endphp
                    
                    @if($isAdmin)
                        {{-- Admin: Tampilkan link ke dashboard --}}
                        <li class="nav-item dropdown">
                            <a class="nav-link user-dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle"></i>
                                <span>{{ Str::limit($user->name, 10) }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                @if($user->hasRole('admin_qofmedia'))
                                    <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2 me-2"></i>Dashboard Admin</a></li>
                                @elseif($user->hasRole('admin_studio'))
                                    <li><a class="dropdown-item" href="{{ route('studio.dashboard') }}"><i class="bi bi-speedometer2 me-2"></i>Dashboard Studio</a></li>
                                @elseif($user->hasRole('admin_apparel'))
                                    <li><a class="dropdown-item" href="{{ route('apparel.dashboard') }}"><i class="bi bi-speedometer2 me-2"></i>Dashboard Apparel</a></li>
                                @endif
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="bi bi-person me-2"></i>Profil</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="bi bi-box-arrow-right me-2"></i>Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        {{-- User Biasa: Tampilkan menu Pesanan Saya --}}
                        <li class="nav-item dropdown">
                            <a class="nav-link user-dropdown-toggle" href="#" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle"></i>
                                <span>{{ Str::limit($user->name, 10) }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('user.orders') }}"><i class="bi bi-bag me-2"></i>Pesanan Saya</a></li>
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="bi bi-person me-2"></i>Profil</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="bi bi-box-arrow-right me-2"></i>Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                @else
                    <li class="nav-item">
                        <a class="nav-link nav-auth-btn nav-login" href="{{ route('login') }}">Masuk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-auth-btn nav-register" href="{{ route('register') }}">Daftar</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>