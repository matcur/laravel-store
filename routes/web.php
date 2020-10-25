<?php

use App\Http\Controllers\Store\HomeController;
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

Route::get('/', [HomeController::class, 'index']);

$args = [
    'as' => 'store.',
    'prefix' => 'store',
];
Route::group($args, function() {
    Route::resource('products', ProductController::class)
        ->only(['index', 'show', 'create'])
        ->names('products');

    Route::resource('categories', ProductController::class)
        ->only(['index', 'show'])
        ->names('categories');
});

Auth::routes();
