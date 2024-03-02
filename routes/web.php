<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    UserController,
    RoleController,
    FoodVariatyController,
    FacilityController,
    RestaurantController,
    KriteriaController,
    AlternatifController,
    HomeController,
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
    return redirect()->route('login');
});

Auth::routes(['register' => false]);

Route::group(['middleware' => ['auth:web']], function() {
    Route::get('/home',                  [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('users',             UserController::class);
    Route::post('get-users',             [UserController::class, 'getUsers'])->name('get.users');
    Route::resource('roles',             RoleController::class);
    Route::resource('food-variaties',    FoodVariatyController::class);
    Route::resource('facilities',        FacilityController::class);
    Route::resource('restaurants',       RestaurantController::class);
    Route::post('get-restaurant',        [RestaurantController::class, 'getRestaurant'])->name('get-restaurant');
    Route::resource('kriterias',         KriteriaController::class);
    Route::resource('alternatif',        AlternatifController::class);
    Route::get('perhitungan-saw',        [AlternatifController::class, 'perhitunganSaw'])->name('perhitungan.saw');
    Route::get('normalisasi-alternatif',        [AlternatifController::class, 'normalisasiAlternatif'])->name('normalisasi.alternatif');
    Route::get('data-ranking',          [AlternatifController::class, 'dataRanking'])->name('data.ranking');

    // Profile
    Route::get('/profile',             [HomeController::class, 'profile'])->name('profile');
    Route::post('get-users',            [UserController::class, 'getUsers'])->name('get.users');
    Route::get('/profile/{id}/edit',   [UserController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile-update/{id}',        [UserController::class, 'updateProfile'])->name('profile.update');

    Route::get('clear', [CacheController::class, 'clear'])->name('clear');
});
