<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('auth.login');
});
/*
 route for admin 
 */
//  group rout with prefix
Route::prefix('admin')
    ->group(function () {
        // group with middleware "auth"
        Route::group(['middleware' => 'auth'], function () {
            Route::get('/dashboard', [DashboardController::class, 'index'])
                ->name('admin.dashboard.index');

            Route::resource('/category', CategoryController::class, ['as' => 'admin']);
            Route::resource('/product', ProductController::class, ['as' => 'admin']);

            Route::get('/order', [OrderController::class, 'index'])
                ->name('admin.order.index');
            Route::get('/order/{id}', [OrderController::class, 'show'])
                ->name('admin.order.show');
            Route::get('/customer', [CustomerController::class, 'index'])
                ->name('admin.customer.index');
            Route::resource('/slider', SliderController::class, ['except' => ['show', 'create', 'edit', 'update'], 'as' => 'admin']);
        });
    });
