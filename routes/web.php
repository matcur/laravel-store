<?php

use App\Http\Controllers\Store\CartController;
use App\Http\Controllers\Store\CategoryController;
use App\Http\Controllers\Store\HomeController;
use App\Http\Controllers\Store\OrderController;
use App\Http\Controllers\Store\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

$args = [
    'as' => 'store.',
    'prefix' => 'store',
];
Route::group($args, function() {
    Route::get('/', [HomeController::class, 'index']);

    Route::resource('products', ProductController::class)
        ->only(['show', 'create'])
        ->names('products');

    Route::resource('categories', CategoryController::class)
        ->only(['show'])
        ->names('categories');

    Route::post('cart/add', [CartController::class, 'add'])
        ->name('cart.add');
    Route::post('cart/remove', [CartController::class, 'remove'])
        ->name('cart.remove');
    Route::get('cart', [CartController::class, 'show'])
        ->name('cart.show');

    Route::get('order/pay', [OrderController::class, 'pay'])
        ->name('order.pay');
    Route::post('order/create', [OrderController::class, 'create'])
        ->name('order.create');
});

$args = [
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => ['auth:admin']
];

Auth::routes();
