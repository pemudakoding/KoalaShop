<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authentication\{LoginController, RegisterController};
use App\Http\Controllers\User\{AddressController, ProductController};
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('auth')
    ->name('auth.')
    ->group(function () {


        Route::post('register', [RegisterController::class, 'conventionalRegister'])
            ->name('register.conventional');

        Route::post('login', [LoginController::class, 'conventionalLogin'])
            ->name('login.conventional');
    });


Route::middleware(['auth:sanctum'])
    ->prefix('users')
    ->name('users.')
    ->group(function () {
    });


Route::middleware(['auth:sanctum'])
    ->prefix('user/address')
    ->name('user.address')
    ->group(function () {

        Route::get('', [AddressController::class, 'index'])
            ->name('index');
        Route::post('', [AddressController::class, 'store'])
            ->name('store');

        Route::get('/{userAddress:slug}', [AddressController::class, 'show'])
            ->name('index');
        Route::delete('/{userAddress:slug}', [AddressController::class, 'destroy'])
            ->name('destroy');
        Route::put('/{userAddress:slug}', [AddressController::class, 'update'])
            ->name('update');
    });

Route::middleware(['auth:sanctum'])
    ->prefix('user/product')
    ->name('user.product.')
    ->group(function () {

        Route::get('', [ProductController::class, 'index'])
            ->name('index');
        Route::post('', [ProductController::class, 'store'])
            ->name('store');

        Route::get('{product:slug}', [ProductController::class, 'show'])
            ->name('store');
        Route::put('{product:slug}', [ProductController::class, 'update'])
            ->name('update');
        Route::delete('{product:slug}', [ProductController::class, 'destroy'])
            ->name('destroy');
    });
