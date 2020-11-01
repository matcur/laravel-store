<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminProductController;
use Illuminate\Support\Facades\Route;
$args = [
    'as' => 'admin.',
    'middleware' => 'auth.admin',
];
Route::group($args, function() {
    Route::get('/', [AdminDashboardController::class, 'show'])
        ->name('home');

    Route::get('products', [AdminProductController::class, 'index'])
        ->name('products.index');
});

Route::post('login', [AdminLoginController::class, 'login'])
    ->name('admin.login');

Route::get('login', [AdminLoginController::class, 'showLoginForm'])
    ->name('admin.login-form');
