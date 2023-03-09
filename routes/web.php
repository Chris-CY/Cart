<?php

use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
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

Route::get('/api', [ProductController::class, 'getDataFromApi']);

Route::get('/', [ProductController::class, 'index'])->name('catalogue');

Route::any('/cart/{id}', [OrderController::class, 'cart'])->name('cart');
Route::view('/cart', 'cart')->name('cart.empty');
Route::post('/add-cart', [OrderController::class, 'addCart'])->name('cart.add');
Route::post('/delete-cart', [OrderController::class, 'deleteCart'])->name('cart.delete');

Route::get('order', [OrderController::class, 'index'])->name('order.index');
Route::any('order/{id}', [OrderController::class, 'edit'])->name('order.edit');

Route::post('/notification/read', [NotificationController::class, 'read'])->name('notification.read');


