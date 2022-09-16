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
use App\Http\Controllers\CustomerOrderController;
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
        '/admin/customer' => CustomerController::class,
        '/admin/line-free' => LineFreeController::class
    ]);
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

    Route::get('customer-order', [CustomerOrderController::class, 'index'])
        ->name('customer-order.index');

    Route::get('customer-order/create', [CustomerOrderController::class, 'create'])
        ->name('customer-order.create');

    Route::post('customer-order/store', [CustomerOrderController::class, 'store'])
        ->name('customer-order.store');

    Route::post('product-sku', [CustomerOrderController::class, 'productSku'])
        ->name('product.sku');

    Route::post('free-issue', [CustomerOrderController::class, 'freeIssue'])
        ->name('product.free.issue');
});

require __DIR__ . '/auth.php';
