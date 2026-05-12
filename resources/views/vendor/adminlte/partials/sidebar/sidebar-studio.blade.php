<aside class="main-sidebar {{ config('adminlte.classes_sidebar', 'sidebar-dark-primary elevation-4') }}">

    {{-- Brand Logo --}}
    <a href="{{ route('studio.dashboard') }}" class="brand-link">
        <span class="brand-text font-weight-light"><b>Qof</b> Studio</span>
    </a>

    {{-- Sidebar --}}
    <div class="sidebar">
        {{-- User Panel --}}
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <i class="fas fa-camera fa-2x text-white"></i>
            </div>
            <div class="info">
                <a href="#" class="d-block text-white">{{ Auth::user()->name }}</a>
                <small class="text-muted">
                    <i class="fas fa-circle text-info" style="font-size: 8px;"></i> 
                    Admin Studio
                </small>
            </div>
        </div>

        {{-- Sidebar Menu --}}
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                
                {{-- Dashboard --}}
                <li class="nav-item">
                    <a href="{{ route('studio.dashboard') }}" class="nav-link {{ request()->routeIs('studio.dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                {{-- Menu Studio --}}
                <li class="nav-header">STUDIO MANAGEMENT</li>
                
                <li class="nav-item">
                    <a href="{{ route('studio.tools.index') }}" class="nav-link {{ request()->routeIs('studio.tools.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tools"></i>
                        <p>Alat Sewa</p>
                        @php $totalTools = \App\Models\RentalTool::count(); @endphp
                        <span class="badge badge-info right">{{ $totalTools }}</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('studio.packages.index') }}" class="nav-link {{ request()->routeIs('studio.packages.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-video"></i>
                        <p>Paket Studio</p>
                        @php $totalPackages = \App\Models\StudioPackage::count(); @endphp
                        <span class="badge badge-info right">{{ $totalPackages }}</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('studio.photo-packages.index') }}" class="nav-link {{ request()->routeIs('studio.photo-packages.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-camera-retro"></i>
                        <p>Paket Fotografi</p>
                        @php $totalPhoto = \App\Models\PhotoPackage::count(); @endphp
                        <span class="badge badge-info right">{{ $totalPhoto }}</span>
                    </a>
                </li>

                {{-- Quick Links --}}
                <li class="nav-header">QUICK LINKS</li>

                <li class="nav-item">
                    <a href="{{ route('service.studio') }}" class="nav-link" target="_blank">
                        <i class="nav-icon fas fa-eye"></i>
                        <p>Lihat Halaman Studio</p>
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

                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}" id="logout-form-studio">
                    @csrf
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
</aside>