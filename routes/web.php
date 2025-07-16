<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsAdmin; // middleware custom
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    if (Auth::user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    return view('dashboard'); // ini view untuk user biasa
})->middleware(['auth', 'verified'])->name('dashboard');

// Route umum untuk semua user yang login
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    
    Route::get('/daftar/products', [AdminProductController::class, 'daftar'])->name('products.daftar');
    Route::get('/products/{product}', [AdminProductController::class, 'show'])->name('product.show');

    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart/data', [CartController::class, 'data'])->name('cart.data');
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.remove');

    Route::get('/checkout/{product}', [OrderController::class, 'form'])->name('checkout.form');
    Route::post('/checkout', [OrderController::class, 'store'])->name('orders.store');
    
    Route::get('/riwayat-pesanan', [OrderController::class, 'riwayatBaru'])->name('riwayat.pesanan');
    Route::patch('/riwayat-pesanan/{order}/update-status', [OrderController::class, 'updateStatus'])->name('riwayat.updateStatus');

    Route::get('/products', [AdminProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [AdminProductController::class, 'create'])->name('products.create');
    Route::post('/products', [AdminProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}', [AdminProductController::class, 'show'])->name('products.show');
    Route::get('/products/{product}/edit', [AdminProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [AdminProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [AdminProductController::class, 'destroy'])->name('products.destroy');
});

// Route khusus ADMIN menggunakan middleware IsAdmin
Route::middleware(['auth', IsAdmin::class])->group(function () {



Route::get('categories', [CategoryController::class, 'index'])->name('admin.categories');
Route::get('categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');
Route::get('categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');



});

require __DIR__.'/auth.php';
