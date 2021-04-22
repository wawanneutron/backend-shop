<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
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
        });
    });
