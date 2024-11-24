<?php

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
})->name('login');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/products/export', [App\Http\Controllers\ProductController::class, 'export'])->name('products.export');
    Route::resource('products', App\Http\Controllers\ProductController::class);
    Route::get('/profile', function () {
        return view('profile');
    });
    Route::get('/logout', [App\Http\Controllers\AuthController::class, 'logout']);
});
