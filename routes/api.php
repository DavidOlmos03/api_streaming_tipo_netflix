<?php

use App\Http\Controllers\Admin\User\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\ProductAndPlanes\ProductPaypalController;
use App\Http\Controllers\Admin\ProductAndPlanes\PlanPaypalController;
use App\Http\Controllers\Admin\Streaming\StreamingGenresController;

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

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login_streaming', [AuthController::class, 'login_streaming'])->name('login_streaming');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/refresh', [AuthController::class, 'refresh'])->name('refresh');
    Route::post('/me', [AuthController::class, 'me'])->name('me');
});



//MIS RUTAS PARA EL ADMIN (Estas rutas estan protegidas)
Route::group([
    'middleware' => 'auth:api',
], function ($router) {
    Route::resource("users",UsersController::class);
    Route::post("users/{id}",[UsersController::class,"update"]);
    Route::resource("products",ProductPaypalController::class);
    Route::resource("planes",PlanPaypalController::class);
    Route::resource("genres",StreamingGenresController::class);
    Route::post("genres/{id}",[StreamingGenresController::class,"update"]);


});

// Route::group(["prefix"=>"admin"], function($router){

// });
