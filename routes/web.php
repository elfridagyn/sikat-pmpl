<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AssetHistoryController;
use App\Http\Controllers\AssetFinanceController;
use App\Http\Controllers\SubCategoryController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// --- GUEST ROUTES ---
Route::get('/', function () {
    return view('welcome');
});

// --- AUTHENTICATED ROUTES (Semua User Login) ---
Route::middleware(['auth'])->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile Management
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
    Route::get('/custom-reset-password', function (Request $request) {
        return view('auth.reset-password', ['request' => $request]);
    })->name('custom.password.reset');

    // Pages & General Features
    Route::get('/help', function () {
        return view('help.index');
    })->name('help');
    
    Route::view('/privacy-policy', 'pages.privacy')->name('privacy');
    Route::view('/terms-of-service', 'pages.terms')->name('terms');
    
    Route::get('/asset-histories', [AssetHistoryController::class, 'index'])->name('asset.histories');
    Route::post('assets/{id}/histories', [AssetController::class, 'storeHistory'])->name('assets.histories.store');
    Route::get('assets/{id}/download-qr', [AssetController::class, 'downloadQr'])->name('assets.download.qr');

    // Categories & Subcategories
    Route::resource('categories', CategoryController::class);
    Route::post('/subcategories', [SubCategoryController::class, 'store'])->name('subcategories.store');
    Route::delete('/subcategories/{id}', [SubCategoryController::class, 'destroy'])->name('subcategories.destroy');

    // --- ROLE: ADMIN ASET & PETUGAS INVENTARIS ---
    Route::middleware(['checkRole:admin_aset,petugas_inventaris'])->group(function () {
        
        // Kelola Aset (Resource & Export)
        Route::get('/assets/export/excel', [AssetController::class, 'exportExcel'])->name('assets.export.excel');
        Route::get('/assets/export/pdf', [AssetController::class, 'exportPdf'])->name('assets.export.pdf');
        Route::resource('assets', AssetController::class);
        Route::put('/assets/{asset}', [AssetController::class, 'update'])->name('assets.update');

        // PENTING: Sekarang Petugas Inventaris & Admin Aset Bisa Akses Keuangan di sini
        Route::get('/asset-finances/export/excel', [AssetFinanceController::class, 'exportExcel'])->name('asset-finances.export.excel');
        Route::get('/asset-finances/export/pdf', [AssetFinanceController::class, 'exportPdf'])->name('asset-finances.export.pdf');
        Route::resource('asset-finances', AssetFinanceController::class);
    });

    // --- ROLE: HANYA ADMIN ASET ---
    Route::middleware(['checkRole:admin_aset'])->group(function () {
        // User Management
        Route::resource('users', UserController::class);
    });

});

require __DIR__ . '/auth.php';