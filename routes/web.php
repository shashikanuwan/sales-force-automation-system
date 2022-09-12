<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\distributorController;
use App\Http\Controllers\Admin\LineFreeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RegionController;
use App\Http\Controllers\Admin\TerritoryController;
use App\Http\Controllers\Admin\ZoneController;
use App\Http\Controllers\ConversionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Distributor\DistributorDashboardController;
use App\Http\Controllers\Distributor\DistributorOrderController;
use App\Http\Controllers\HomeController;
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
        '/admin/order' => OrderController::class,
        '/admin/customer' => CustomerController::class
    ]);

    Route::get('/admin/line-free', [LineFreeController::class, 'index'])
        ->name('line.free.index');

    Route::get('/admin/line-free/create', [LineFreeController::class, 'create'])
        ->name('line.free.create');

    Route::post('/admin/line-free/store', [LineFreeController::class, 'store'])
        ->name('line.free.store');
});

Route::middleware(['auth', 'role:distributor'])->group(function () {
    Route::get('/distributor/dashboard', DistributorDashboardController::class)
        ->name('distributor.dashboard');

    Route::get('distributor/order/create', [DistributorOrderController::class, 'create'])
        ->name('distributor.order.create');

    Route::post('distributor/order/store', [DistributorOrderController::class, 'store'])
        ->name('distributor.order.store');
});

Route::middleware(['auth', 'role:admin|distributor'])->group(function () {
    Route::get('invoice/{order}', [ConversionController::class, 'index'])
        ->name('invoice.index');

    Route::get('generate-invoice/{order}', [ConversionController::class, 'generateSingleInvoice'])
        ->name('generate.invoice');

    Route::post('generate-bulk-invoice', [ConversionController::class, 'generateBulkInvoice'])
        ->name('generate.bulk.invoice');

    Route::get('export-excel', [ConversionController::class, 'exportExcel'])
        ->name('export.excel');
});

require __DIR__ . '/auth.php';
