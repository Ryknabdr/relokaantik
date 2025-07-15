<?php

// Import semua controller dan helper yang dibutuhkan
use Livewire\Volt\Volt;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\AdminAuthController;

// ===============================
// Route Halaman Utama (Frontend)
// ===============================

// Halaman landing / home
Route::get('/', [HomepageController::class, 'index'])->name('home');

// Halaman daftar semua produk
Route::get('products', [HomepageController::class, 'products']);

// Halaman detail produk berdasarkan slug
Route::get('product/{slug}', [HomepageController::class, 'product'])->name('product.show');

// Halaman semua kategori
Route::get('categories', [HomepageController::class, 'categories']);

// Halaman detail kategori berdasarkan slug
Route::get('category/{slug}', [HomepageController::class, 'category']);

// ===============================
// Route Cart & Checkout
// ===============================

// Halaman keranjang belanja
Route::get('cart', [HomepageController::class, 'cart'])->name('cart.index');

// Halaman checkout
Route::get('checkout', [HomepageController::class, 'checkout'])->name('checkout.index');

// Proses checkout (POST data pesanan)
Route::post('checkout/process', [HomepageController::class, 'processCheckout'])->name('checkout.process');

// ===============================
// Route Halaman Statis
// ===============================

// Halaman tentang kami
Route::get('about', function () {
    return view('about');
})->name('about');

// Halaman kontak
Route::get('contact', function () {
    return view('contact');
})->name('contact');

// ===============================
// Route Cart dengan Middleware Customer Login
// ===============================

Route::group(['middleware' => ['is_customer_login']], function () {
    Route::controller(CartController::class)->group(function () {
        // Tambah item ke cart
        Route::post('cart/add', 'add')->name('cart.add');

        // Hapus item dari cart
        Route::delete('cart/remove/{id}', 'remove')->name('cart.remove');

        // Update item di cart (jumlah)
        Route::patch('cart/update/{id}', 'update')->name('cart.update');
    });
});

// ===============================
// Route Otentikasi Customer
// ===============================

Route::group(['prefix' => 'customer'], function () {
    Route::controller(CustomerAuthController::class)->group(function () {
        // Route yang hanya bisa diakses jika belum login customer
        Route::group(['middleware' => 'check_customer_login'], function () {
            // Tampilkan halaman login
            Route::get('login', 'login')->name('customer.login');

            // Aksi login
            Route::post('login', 'store_login')->name('customer.store_login');

            // Tampilkan halaman register
            Route::get('register', 'register')->name('customer.register');

            // Aksi register
            Route::post('register', 'store_register')->name('customer.store_register');
        });

        // Logout customer (POST)
        Route::post('logout', 'logout')->name('customer.logout');
    });
});

// ===============================
// Route Dashboard Admin/User menggunakan prefix
// ===============================

Route::group(['prefix' => 'dashboard', 'middleware' => ['auth', 'verified']], function () {
    // Halaman dashboard utama
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // CRUD kategori produk
    Route::resource('categories', ProductCategoryController::class);

    // CRUD produk
    Route::resource('products', ProductController::class);

    // CRUD tema (jika ada pengaturan tampilan frontend)
    Route::resource('themes', ThemeController::class);

    // Sinkronisasi data produk (mungkin untuk API atau update stok)
    Route::post('products/sync/{id}', [ProductController::class, 'sync'])->name('products.sync');

    // Sinkronisasi data kategori
    Route::post('category/sync/{id}', [ProductCategoryController::class, 'sync'])->name('category.sync');
});

// ===============================
// Route Otentikasi Admin
// ===============================

Route::prefix('admin')->group(function () {
    // Tampilkan form login admin
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');

    // Proses login admin
    Route::post('login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

    // Logout admin
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    // Tampilkan form register admin
    Route::get('register', [AdminAuthController::class, 'showRegisterForm'])->name('admin.register');

    // Proses register admin
    Route::post('register', [AdminAuthController::class, 'register'])->name('admin.register.submit');
});

// ===============================
// Route Settings (User Setting Page via Livewire Volt)
// ===============================

Route::middleware(['auth'])->group(function () {
    // Redirect default settings ke profile
    Route::redirect('settings', 'settings/profile');

    // Halaman profile
    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');

    // Halaman ubah password
    Volt::route('settings/password', 'settings.password')->name('settings.password');

    // Halaman pengaturan tampilan
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

// ===============================
// Include Auth Route Bawaan Laravel
// ===============================

require __DIR__ . '/auth.php';
