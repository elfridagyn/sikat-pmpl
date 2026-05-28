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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get(
        '/profile',
        [ProfileController::class, 'index']
    )->name('profile');

    Route::put(
        '/profile/update',
        [ProfileController::class, 'update']
    )->name('profile.update');

    Route::put(
        '/profile/password',
        [ProfileController::class, 'updatePassword']
    )->name('profile.password');
});
Route::middleware(['auth'])->group(function () {

    Route::get(
        '/dashboard',
        [DashboardController::class, 'index']
    )
        ->name('dashboard');
});
Route::middleware([
    'auth',
    'checkRole:admin_aset,petugas_inventaris'
])->group(function () {

    Route::resource(
        'assets',
        AssetController::class
    );
});

// Hapus /{id} dari URI
Route::get('/assets/export/excel', [AssetController::class, 'exportExcel'])->name('assets.export.excel');
Route::get(
    '/assets/export/pdf',
    [AssetController::class, 'exportPdf']
)->name('assets.export.pdf');

Route::middleware([
    'auth',
    'checkRole:admin_aset'
])->group(function () {

    Route::resource(
        'users',
        UserController::class
    );
});

Route::resource(
    'categories',
    CategoryController::class
);

Route::get(
    '/asset-histories',
    [AssetHistoryController::class, 'index']
)->name('asset.histories');

Route::resource(
    'asset-finances',
    AssetFinanceController::class
);

Route::get(

    '/asset-finances/export/excel',

    [
        AssetFinanceController::class,
        'exportExcel'
    ]

)->name('asset-finances.export.excel');

Route::get(

    '/asset-finances/export/pdf',

    [
        AssetFinanceController::class,
        'exportPdf'
    ]

)->name('asset-finances.export.pdf');

Route::middleware([
    'auth',
    'checkRole:admin_aset'
])->group(function () {

    Route::resource(
        'users',
        UserController::class
    );
});
Route::resource(
    'assets',
    AssetController::class
)
    ->middleware('auth');
require __DIR__ . '/auth.php';
Route::middleware(['auth'])->group(function () {
    // Jalur rute penyimpanan riwayat/mutasi baru
    Route::post('assets/{id}/histories', [AssetController::class, 'storeHistory'])->name('assets.histories.store');
    Route::get('/help', function () {
        return view('help.index');
    })->name('help');

    Route::view('/privacy-policy', 'pages.privacy')
        ->name('privacy');

    Route::view('/terms-of-service', 'pages.terms')
        ->name('terms');

    // Jalur rute unduhan berkas dokumen QR Code
    Route::get('assets/{id}/download-qr', [AssetController::class, 'downloadQr'])->name('assets.download.qr');
    Route::post('/subcategories', [SubCategoryController::class, 'store'])->name('subcategories.store');
    Route::delete('/subcategories/{id}', [SubCategoryController::class, 'destroy'])->name('subcategories.destroy');
    Route::put('/assets/{asset}', [AssetController::class, 'update'])->name('assets.update');
    Route::get('/custom-reset-password', function (Request $request) {
        return view('auth.reset-password', ['request' => $request]);
    })->name('custom.password.reset');
    // Resource route bawaan sistem logistik SIKAT
    Route::resource('assets', AssetController::class);
});
