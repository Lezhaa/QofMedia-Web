<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Dynamic AdminLTE Menu based on role
        \View::composer('adminlte::page', function ($view) {
            if (Auth::check()) {
                $user = Auth::user();
                $menu = [];
                
                if ($user->hasRole('admin_qofmedia')) {
                    $menu = $this->getAdminQofmediaMenu();
                } elseif ($user->hasRole('admin_studio')) {
                    $menu = $this->getAdminStudioMenu();
                } elseif ($user->hasRole('admin_apparel')) {
                    $menu = $this->getAdminApparelMenu();
                }
                
                config(['adminlte.menu' => $menu]);
            }
        });
        
        // Set default dashboard URL based on role
        \View::composer('adminlte::partials.navbar.user-menu', function ($view) {
            if (Auth::check()) {
                $user = Auth::user();
                $dashboardUrl = route('home');
                
                if ($user->hasRole('admin_qofmedia')) {
                    $dashboardUrl = route('admin.dashboard');
                } elseif ($user->hasRole('admin_studio')) {
                    $dashboardUrl = route('studio.dashboard');
                } elseif ($user->hasRole('admin_apparel')) {
                    $dashboardUrl = route('apparel.dashboard');
                }
                
                config(['adminlte.dashboard_url' => $dashboardUrl]);
            }
        });
    }
    
    private function getAdminQofmediaMenu()
{
    return [
        // Header User Info di Sidebar (Custom)
        [
            'text' => 'user_header',
            'header' => true,
        ],
        [
            'text' => 'Dashboard',
            'url' => route('admin.dashboard'),
            'icon' => 'fas fa-tachometer-alt',
        ],
        [
            'text' => 'MAIN NAVIGATION',
            'header' => true,
        ],
        [
            'text' => 'Kelola Beranda',
            'url' => route('admin.home.edit'),
            'icon' => 'fas fa-home',
        ],
        [
            'text' => 'Kelola Galeri',
            'url' => route('admin.albums.index'),
            'icon' => 'fas fa-images',
        ],
        [
            'text' => 'Kelola Artikel',
            'url' => route('admin.articles.index'),
            'icon' => 'fas fa-newspaper',
        ],
        [
            'text' => 'Pesan Kontak',
            'url' => route('admin.contacts.index'),
            'icon' => 'fas fa-envelope',
            'label' => \App\Models\Contact::whereNull('read_at')->count(),
            'label_color' => 'danger',
        ],
        [
            'text' => 'ADMINISTRATION',
            'header' => true,
        ],
        [
            'text' => 'Manajemen User',
            'url' => route('admin.users.index'),
            'icon' => 'fas fa-users',
        ],
        [
            'text' => 'Pengaturan',
            'url' => route('admin.settings.index'),
            'icon' => 'fas fa-cog',
        ],
        [
            'text' => 'QUICK LINKS',
            'header' => true,
        ],
        [
            'text' => 'Qof Studio',
            'url' => route('service.studio'),
            'icon' => 'fas fa-camera',
            'target' => '_blank',
        ],
        [
            'text' => 'Qof Apparel',
            'url' => route('service.apparel'),
            'icon' => 'fas fa-tshirt',
            'target' => '_blank',
        ],
        [
            'text' => 'Lihat Website',
            'url' => route('home'),
            'icon' => 'fas fa-globe',
            'target' => '_blank',
        ],
    ];
}
    
    private function getAdminStudioMenu()
    {
        return [
            [
                'text' => 'Dashboard',
                'url' => route('studio.dashboard'),
                'icon' => 'fas fa-tachometer-alt',
            ],
            [
                'text' => 'Kelola Alat Sewa',
                'url' => route('studio.tools.index'),
                'icon' => 'fas fa-tools',
            ],
            [
                'text' => 'Kelola Paket Studio',
                'url' => route('studio.packages.index'),
                'icon' => 'fas fa-video',
            ],
            [
                'text' => 'Kelola Paket Foto',
                'url' => route('studio.photo-packages.index'),
                'icon' => 'fas fa-camera',
            ],
            [
                'text' => 'WEBSITE',
                'header' => true,
            ],
            [
                'text' => 'Lihat Website',
                'url' => route('home'),
                'icon' => 'fas fa-globe',
                'target' => '_blank',
            ],
        ];
    }
    
    private function getAdminApparelMenu()
    {
        return [
            [
                'text' => 'Dashboard',
                'url' => route('apparel.dashboard'),
                'icon' => 'fas fa-tachometer-alt',
            ],
            [
                'text' => 'Kategori Produk',
                'url' => route('apparel.categories.index'),
                'icon' => 'fas fa-tags',
            ],
            [
                'text' => 'Produk',
                'url' => route('apparel.products.index'),
                'icon' => 'fas fa-box',
            ],
            [
                'text' => 'Kelola Order',
                'url' => route('apparel.orders.index'),
                'icon' => 'fas fa-shopping-cart',
            ],
            [
                'text' => 'WEBSITE',
                'header' => true,
            ],
            [
                'text' => 'Lihat Website',
                'url' => route('home'),
                'icon' => 'fas fa-globe',
                'target' => '_blank',
            ],
        ];
    }
}