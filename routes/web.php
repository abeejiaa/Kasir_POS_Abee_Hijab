<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CashierController;
use App\Http\Controllers\Admin\ProductVariantController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\StockController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Kasir\DashboardController as KasirDashboardController;
use App\Http\Controllers\Kasir\KasirTransaksiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');

    Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

    Route::get('/products/{product}/variants', [ProductVariantController::class, 'index'])->name('products.variants.index');
    Route::get('/products/{product}/variants/create', [ProductVariantController::class, 'create'])->name('products.variants.create');
    Route::post('/products/{product}/variants', [ProductVariantController::class, 'store'])->name('products.variants.store');

    Route::get('/variants/{variant}/edit', [ProductVariantController::class, 'edit'])->name('variants.edit');
    Route::put('/variants/{variant}', [ProductVariantController::class, 'update'])->name('variants.update');
    Route::delete('/variants/{variant}', [ProductVariantController::class, 'destroy'])->name('variants.destroy');

    Route::get('/cashiers', [CashierController::class, 'index'])->name('cashiers.index');
    Route::get('/cashiers/create', [CashierController::class, 'create'])->name('cashiers.create');
    Route::post('/cashiers', [CashierController::class, 'store'])->name('cashiers.store');
    Route::get('/cashiers/{user}/edit', [CashierController::class, 'edit'])->name('cashiers.edit');
    Route::put('/cashiers/{user}', [CashierController::class, 'update'])->name('cashiers.update');
    Route::delete('/cashiers/{user}', [CashierController::class, 'destroy'])->name('cashiers.destroy');

    Route::get('/stocks', [StockController::class, 'index'])->name('stocks.index');

    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/transactions/{transaction}', [TransactionController::class, 'show'])->name('transactions.show');

    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
});

Route::middleware(['auth', 'role:kasir'])->prefix('kasir')->name('kasir.')->group(function () {
    Route::get('/dashboard', [KasirDashboardController::class, 'index'])->name('dashboard');

    Route::get('/transaksi', [KasirTransaksiController::class, 'index'])->name('transaksi');
    Route::post('/transaksi', [KasirTransaksiController::class, 'store'])->name('transaksi.store');
    Route::get('/transaksi/{transaction}/nota', [KasirTransaksiController::class, 'receipt'])
    ->name('transaksi.receipt');

    Route::get('/riwayat', [KasirTransaksiController::class, 'history'])->name('riwayat');
    Route::get('/riwayat/{transaction}', [KasirTransaksiController::class, 'show'])->name('riwayat.show');
});