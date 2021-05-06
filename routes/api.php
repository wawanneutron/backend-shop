<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/* 
    Route API Auth
*/

Route::post('/login', [AuthController::class, 'login'])
    ->name('api.customer.login');
Route::post('/register', [AuthController::class, 'register'])
    ->name('api.customer.register');
Route::get('/user', [AuthController::class, 'getUser'])
    ->name('api.customer.user');

// routes order
Route::get('/order', [OrderController::class, 'index'])
    ->name('api.order.index');
Route::get('/order/{snap_token?}', [OrderControlller::class, 'show'])
    ->name('api.order.show');

// routs category
Route::get('/category', [CategoryController::class, 'index'])
    ->name('api.category.index');
Route::get('/category/{slug?}', [CategoryController::class, 'show'])
    ->name('api.category.show');
Route::get('/category-header', [CategoryController::class, 'index'])
    ->name('api.category.index');

// routs products
Route::get('/products', [ProductController::class, 'index'])
    ->name('api.product.index');
Route::get('/product/{slug?}', [ProductController::class, 'show'])
    ->name('api.product.show');

// routs Cart
Route::get('/cart', [CartController::class, 'index'])
    ->name('api.cart.index');
Route::post('/cart', [CartController::class, 'addToCart'])
    ->name('api.cart.addToCart');
Route::get('/cart/total', [CartController::class, 'cartTotalPrice'])
    ->name('api.cart.total');
Route::get('/cart/total-weight', [CartController::class, 'cartTotalWeight'])
    ->name('api.cart.weight');
Route::post('/cart/remove', [CartController::class, 'removeCart'])
    ->name('api.cart.remove');
Route::post('/cart/remove-all', [CartController::class, 'removeAllCart'])
    ->name('api.cart.removeAll');

// routes Raja Ongkir
Route::get('/rajaongkir/provinces', [RajaOngkirController::class, 'getProvinces'])
    ->name('customer.rajaongkir.getProvinces');
Route::get('/rajaongkir/cities', [RajaOngkirController::class, 'getCities'])
    ->name('customer.rajaongkir.getCities');
Route::post('/rajaongkir/check-ongkir', [RajaOngkirController::class, 'checkOngkir'])
    ->name('customer.rajaongkir.checkOngkir');
