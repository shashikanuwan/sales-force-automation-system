<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ZoneController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Distributor\DistributorDashboardController;
use App\Http\Controllers\HomeController;
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

    Route::resource('/admin/zone', ZoneController::class);
});

Route::middleware(['auth', 'role:distributor'])->group(function () {
    Route::get('/distributor/dashboard', DistributorDashboardController::class)
        ->name('distributor.dashboard');
});

require __DIR__.'/auth.php';
