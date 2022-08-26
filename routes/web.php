<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\distributorController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RegionController;
use App\Http\Controllers\Admin\TerritoryController;
use App\Http\Controllers\Admin\ZoneController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Distributor\DistributorDashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;


Route::get('/', HomeController::class)
    ->name('welcome');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', DashboardController::class)
        ->name('dashboard');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', AdminDashboardController::class)
        ->name('admin.dashboard');

    Route::resources([
        '/admin/zone' => ZoneController::class,
        '/admin/region' => RegionController::class,
        '/admin/territory' => TerritoryController::class,
        '/admin/distributor' => distributorController::class,
        '/admin/product' => ProductController::class,
    ]);
});

Route::middleware(['auth', 'role:distributor'])->group(function () {
    Route::get('/distributor/dashboard', DistributorDashboardController::class)
        ->name('distributor.dashboard');
});

Route::middleware(['auth', 'role:admin|distributor'])->group(function () {
    Route::resource('order', OrderController::class);

    Route::get('invoice/{order}', [InvoiceController::class, 'index'])
        ->name('invoice.index');

    Route::get('generate-invoice/{order}', [InvoiceController::class, 'generateInvoice'])
        ->name('generate.invoice');

    Route::get('export-excel', [InvoiceController::class, 'exportExcel'])
        ->name('export.excel');
});

require __DIR__ . '/auth.php';
