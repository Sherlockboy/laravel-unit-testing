<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('users')->name('users.')->group(function() {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::post('/search', [UserController::class, 'search'])->name('search');
});

Route::prefix('products')->name('products.')->group(function() {
    Route::get('/', [ProductController::class, 'index'])->name('index');
    Route::get('/scan/{product_code}', [ProductController::class, 'scan'])->name('scan');
});
