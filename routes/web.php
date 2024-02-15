<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    UserController,
    RoleController,
    FoodVariatyController
};
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => ['auth:web']], function() {
    Route::get('/home',                  [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('users',             UserController::class);
    Route::post('get-users',             [UserController::class, 'getUsers'])->name('get.users');
    Route::resource('roles',             RoleController::class);
    Route::resource('food-variaties',    FoodVariatyController::class);

});
