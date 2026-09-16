<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ItemPenjualanController;
use App\Http\Controllers\JenisProdukController;
use App\Http\Controllers\ProfileController;


/*
|--------------------------------------------------------------------------
| Guest
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'index'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'auth'])
        ->name('login.post');

});


/*
|--------------------------------------------------------------------------
| Semua User yang sudah Login
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {


    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | Profile
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', [ProfileController::class, 'index'])
        ->name('profile');

    Route::get('/profile/edit', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::put('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');


    /*
    |--------------------------------------------------------------------------
    | Logout
    |--------------------------------------------------------------------------
    */

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');


    /*
    |--------------------------------------------------------------------------
    | User Management
    | Admin Only
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:admin')->group(function () {

        Route::get('/user', [UserController::class, 'index'])
            ->name('user.index');

        Route::get('/user/create', [UserController::class, 'create'])
            ->name('user.create');

        Route::post('/user/store', [UserController::class, 'store'])
            ->name('user.store');

        Route::get('/user/{user}/edit', [UserController::class, 'edit'])
            ->name('user.edit');

        Route::put('/user/{user}', [UserController::class, 'update'])
            ->name('user.update');

        Route::delete('/user/{user}', [UserController::class, 'destroy'])
            ->name('user.destroy');

    });


    /*
    |--------------------------------------------------------------------------
    | Produk, Jenis Produk, Penjualan
    | Admin & Kasir
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:admin,kasir')->group(function () {


        /*
        |--------------------------------------------------------------------------
        | Produk
        |--------------------------------------------------------------------------
        */

        Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
        Route::get('/produk/{id}', [ProdukController::class, 'show'])
            ->whereNumber('id')
            ->name('produk.show');


        /*
        |--------------------------------------------------------------------------
        | Jenis Produk
        |--------------------------------------------------------------------------
        */

        Route::get('/jenis-produk', [JenisProdukController::class, 'index'])
            ->name('jenis-produk.index');


        /*
        |--------------------------------------------------------------------------
        | Penjualan
        |--------------------------------------------------------------------------
        */

        Route::resource('penjualan', PenjualanController::class)
            ->only([
                'index',
                'create',
                'store',
                'show',
                'destroy'
            ]);


        /*
        |--------------------------------------------------------------------------
        | Item Penjualan
        |--------------------------------------------------------------------------
        */

        Route::resource(
            'itempenjualan',
            ItemPenjualanController::class
        );

    });

    /*
    |--------------------------------------------------------------------------
    | Pengelolaan Produk dan Jenis Produk - Admin Only
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:admin')->group(function () {
        Route::get('/produk/create', [ProdukController::class, 'create'])->name('produk.create');
        Route::post('/produk', [ProdukController::class, 'store'])->name('produk.store');
        Route::get('/produk/{id}/edit', [ProdukController::class, 'edit'])->name('produk.edit');
        Route::put('/produk/{id}', [ProdukController::class, 'update'])->name('produk.update');
        Route::delete('/produk/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');

        Route::get('/jenis-produk/create', [JenisProdukController::class, 'create'])->name('jenis-produk.create');
        Route::post('/jenis-produk', [JenisProdukController::class, 'store'])->name('jenis-produk.store');
        Route::get('/jenis-produk/{jenis_produk}/edit', [JenisProdukController::class, 'edit'])->name('jenis-produk.edit');
        Route::put('/jenis-produk/{jenis_produk}', [JenisProdukController::class, 'update'])->name('jenis-produk.update');
        Route::delete('/jenis-produk/{jenis_produk}', [JenisProdukController::class, 'destroy'])->name('jenis-produk.destroy');
    });

});
