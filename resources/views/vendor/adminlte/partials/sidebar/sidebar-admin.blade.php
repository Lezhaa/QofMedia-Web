<aside class="main-sidebar {{ config('adminlte.classes_sidebar', 'sidebar-dark-primary elevation-4') }}">

    {{-- Brand Logo --}}
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <span class="brand-text font-weight-light"><b>Qof</b>Media</span>
    </a>

    {{-- Sidebar --}}
    <div class="sidebar">
        {{-- User Panel --}}
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <i class="fas fa-user-shield fa-3x text-white"></i>
            </div>
            <div class="info">
                <a href="#" class="d-block text-white">{{ Auth::user()->name }}</a>
                <small class="text-muted">
                    <i class="fas fa-circle text-success" style="font-size: 8px;"></i> 
                    Administrator
                </small>
            </div>
        </div>

        {{-- Sidebar Search --}}
        @if(config('adminlte.sidebar_search', true))
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
        @endif

        {{-- Sidebar Menu --}}
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                
                {{-- Dashboard --}}
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                {{-- Manajemen Konten --}}
                <li class="nav-header">MANAJEMEN KONTEN</li>
                
                <li class="nav-item">
                    <a href="{{ route('admin.home.edit') }}" class="nav-link {{ request()->routeIs('admin.home.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Kelola Beranda</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.albums.index') }}" class="nav-link {{ request()->routeIs('admin.albums.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-images"></i>
                        <p>Kelola Galeri</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.articles.index') }}" class="nav-link {{ request()->routeIs('admin.articles.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-newspaper"></i>
                        <p>Kelola Informasi</p>
                    </a>
                </li>

                <li class="nav-header">MANAJEMEN TIM</li>

                <li class="nav-item">
                    <a href="{{ route('admin.divisions.index') }}" class="nav-link {{ request()->routeIs('admin.divisions.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-layer-group"></i>
                        <p>Divisi</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.members.index') }}" class="nav-link {{ request()->routeIs('admin.members.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Anggota Tim</p>
                    </a>
                </li>

                {{-- Manajemen Sistem --}}
                <li class="nav-header">MANAJEMEN SISTEM</li>

                <li class="nav-item">
                    <a href="{{ route('admin.contacts.index') }}" class="nav-link {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-envelope"></i>
                        <p>
                            Pesan Kontak
                            @php $unread = \App\Models\Contact::whereNull('read_at')->count(); @endphp
                            @if($unread > 0)
                                <span class="badge badge-danger right">{{ $unread }}</span>
                            @endif
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Manajemen User</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.settings.index') }}" class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>Pengaturan Website</p>
                    </a>
                </li>

                {{-- Layanan --}}
                <li class="nav-header">LAYANAN</li>

                <li class="nav-item">
                    <a href="{{ route('service.studio') }}" class="nav-link" target="_blank">
                        <i class="nav-icon fas fa-camera"></i>
                        <p>Qof Studio</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('service.apparel') }}" class="nav-link" target="_blank">
                        <i class="nav-icon fas fa-tshirt"></i>
                        <p>Qof  Apparel</p>
                    </a>
                </li>

                {{-- Lainnya --}}
                <li class="nav-header mt-3">LAINNYA</li>

                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link" target="_blank">
                        <i class="nav-icon fas fa-globe"></i>
                        <p>Lihat Website</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('profile.edit') }}" class="nav-link">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>Edit Profil</p>
                    </a>
                </li>

                <li class="nav-item mt-3">
                    <<form method="POST" action="{{ route('logout') }}" id="logout-form-admin">
                        @csrf
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
</aside>