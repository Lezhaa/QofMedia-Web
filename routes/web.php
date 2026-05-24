<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\StudioPublicController;
use App\Http\Controllers\ApparelPublicController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Studio\DashboardController as StudioDashboardController;
use App\Http\Controllers\Apparel\DashboardController as ApparelDashboardController;
use App\Http\Controllers\User\OrderController as UserOrderController;
use App\Http\Controllers\Admin\AlbumController;
use App\Http\Controllers\Admin\GalleryItemController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Studio\ToolController;
use App\Http\Controllers\Studio\StudioPackageController;
use App\Http\Controllers\Studio\PhotoPackageController;
use App\Http\Controllers\Apparel\CategoryController;
use App\Http\Controllers\Apparel\ProductController;
use App\Http\Controllers\Apparel\OrderController as ApparelOrderController;
use App\Http\Controllers\Apparel\FinanceController;
use App\Http\Controllers\Apparel\EditionController;
use App\Http\Controllers\Apparel\ModelController;
use App\Http\Controllers\Apparel\VariantController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('/tentang/profil', [PublicController::class, 'profil'])->name('about.profile');
Route::get('/tentang/struktur', [PublicController::class, 'struktur'])->name('about.structure');
Route::get('/informasi', [PublicController::class, 'informasi'])->name('information.index');
Route::get('/informasi/{slug}', [PublicController::class, 'informasiDetail'])->name('information.show');
Route::get('/galeri', [PublicController::class, 'galeri'])->name('gallery.index');
Route::get('/galeri/{year}', [PublicController::class, 'galeriYear'])->name('gallery.year');
Route::get('/galeri/{year}/{slug}', [PublicController::class, 'galeriAlbum'])->name('gallery.album');
Route::get('/layanan/studio', [StudioPublicController::class, 'index'])->name('service.studio');
Route::get('/layanan/apparel', [ApparelPublicController::class, 'index'])->name('service.apparel');
Route::get('/layanan/apparel/product/{id}', [ApparelPublicController::class, 'show'])->name('apparel.product.show');
Route::get('/kontak', [PublicController::class, 'kontak'])->name('contact');
Route::post('/kontak', [PublicController::class, 'sendContact'])->name('contact.send');

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        $user = auth()->user();

        if ($user->hasRole('admin_qofmedia')) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->hasRole('admin_studio')) {
            return redirect()->route('studio.dashboard');
        } elseif ($user->hasRole('admin_apparel')) {
            return redirect()->route('apparel.dashboard');
        }

        return redirect()->route('home');
    })->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/password', [ProfileController::class, 'updatePassword'])->name('password.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Riwayat order user
    Route::prefix('account')->name('user.')->group(function () {
        Route::get('/orders', [UserOrderController::class, 'index'])->name('orders');
        Route::get('/orders/{order}', [UserOrderController::class, 'show'])->name('orders.show');
    });

    // Order — hanya transfer manual
    Route::post('/order', [OrderController::class, 'store'])->name('order.store');
});

/*
|--------------------------------------------------------------------------
| Admin QofMedia Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin_qofmedia'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::get('/home', [AdminDashboardController::class, 'homeEdit'])->name('home.edit');
        Route::post('/home', [AdminDashboardController::class, 'homeUpdate'])->name('home.update');

        Route::resource('divisions', App\Http\Controllers\Admin\DivisionController::class);
        Route::resource('members', App\Http\Controllers\Admin\MemberController::class);
        Route::resource('albums', AlbumController::class);

        Route::prefix('albums/{album}/items')->name('albums.items.')->group(function () {
            Route::get('/', [GalleryItemController::class, 'index'])->name('index');
            Route::get('/create', [GalleryItemController::class, 'create'])->name('create');
            Route::post('/', [GalleryItemController::class, 'store'])->name('store');
            Route::delete('/{item}', [GalleryItemController::class, 'destroy'])->name('destroy');
            Route::post('/upload-multiple', [GalleryItemController::class, 'uploadMultiple'])->name('upload-multiple');
        });

        Route::resource('articles', ArticleController::class);

        Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
        Route::get('/contacts/{contact}', [ContactController::class, 'show'])->name('contacts.show');
        Route::post('/contacts/{contact}/read', [ContactController::class, 'markAsRead'])->name('contacts.read');
        Route::delete('/contacts/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');

        Route::resource('users', UserController::class);
        Route::post('/users/{user}/assign-role', [UserController::class, 'assignRole'])->name('users.assign-role');

        Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
        Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
    });

/*
|--------------------------------------------------------------------------
| Admin Studio Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin_studio'])
    ->prefix('studio')
    ->name('studio.')
    ->group(function () {
        Route::get('/dashboard', [StudioDashboardController::class, 'index'])->name('dashboard');
        Route::resource('tools', ToolController::class);
        Route::resource('packages', StudioPackageController::class);
        Route::resource('photo-packages', PhotoPackageController::class);
    });

/*
|--------------------------------------------------------------------------
| Admin Apparel Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin_apparel'])
    ->prefix('apparel')
    ->name('apparel.')
    ->group(function () {

        Route::get('/dashboard', [ApparelDashboardController::class, 'index'])->name('dashboard');

        // Produk & Kategori
        Route::resource('categories', CategoryController::class);
        Route::resource('products', ProductController::class);
        Route::post('/products/image/{id}/label', [ProductController::class, 'updateImageLabel'])->name('products.updateImageLabel');
        Route::delete('/products/image/{id}', [ProductController::class, 'deleteImage'])->name('products.deleteImage');

        // Order Management
        Route::resource('orders', ApparelOrderController::class)
            ->except(['create', 'store', 'edit', 'update']);
        
        // Validasi bukti transfer (tahap 1)
        Route::post('/orders/{order}/validate-proof', [ApparelOrderController::class, 'validateProof'])->name('orders.validate-proof');
        
        // Approve / Reject order (tahap 2)
        Route::post('/orders/{order}/approve', [ApparelOrderController::class, 'approve'])->name('orders.approve');
        Route::post('/orders/{order}/reject', [ApparelOrderController::class, 'reject'])->name('orders.reject');

        // Laporan Keuangan & Analitik
        Route::get('/finance', [FinanceController::class, 'index'])->name('finance.index');
        
        // Export Laporan Keuangan (Excel & PDF)
        Route::get('/finance/export-excel', [FinanceController::class, 'exportExcel'])->name('finance.export-excel');
        Route::get('/finance/export-pdf', [FinanceController::class, 'exportPdf'])->name('finance.export-pdf');

        // Kaos Management
        Route::resource('editions', EditionController::class);
        Route::resource('models', ModelController::class);
        Route::resource('variants', VariantController::class);
    });

/*
|--------------------------------------------------------------------------
| Auth Routes (Laravel Breeze)
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';