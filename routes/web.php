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
    KriteriaVariasiMenuController,
    KriteriaJarakController,
    KriteriaHargaController,
    KriteriaRasaController,
    KriteriaFasilitasController,
    CommentController,
    BobotController,
    KategoriJamOperasionalController,
};
use App\Http\Controllers\Auth\AuthController;

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
    return view('pages.frontend.home.home');
})->name('landing-page');

Auth::routes();

Route::get('logs-error',                          [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);
Route::get('signin',                              [AuthController::class,'login'])->name('auth.login');
Route::post('store-signin',                       [AuthController::class,'loginProcess'])->name('store.login');
Route::get('signup',                              [AuthController::class,'signup'])->name('auth.signup');
Route::post('store-signup',                       [AuthController::class,'storeSignup'])->name('store.signup');
Route::post('resend-activation',                  [AuthController::class,'resendActivation'])->name('auth.store.resend-activation');
Route::get('activation/{token}',                  [AuthController::class,'activation'])->name('auth.activation');
Route::get('cari-restaurants',                    [RestaurantController::class, 'searchRestaurant'])->name('cari.restaurant');
Route::get('filter-restaurants',                  [RestaurantController::class, 'filter'])->name('filter.restaurants');
Route::get('ranking-restaurants',                 [RestaurantController::class, 'rankingRestaurants'])->name('ranking.restaurants');
Route::get('detail-restaurant/{restaurant}',      [RestaurantController::class, 'detailRestaurant'])->name('detail.restaurant');
// Auth::routes(['register' => false]);

Route::group(['middleware' => ['auth:web']], function() {
    Route::get('/home',                  [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('users',             UserController::class);
    Route::post('get-users',             [UserController::class, 'getUsers'])->name('get.users');
    Route::resource('roles',             RoleController::class);
    Route::resource('food-variaties',    FoodVariatyController::class);
    Route::resource('facilities',        FacilityController::class);
    Route::resource('restaurants',       RestaurantController::class);
    Route::post('get-restaurant',        [RestaurantController::class, 'getRestaurant'])->name('get.restaurant');
    Route::post('specify-restaurant/{$id}',        [RestaurantController::class, 'specifyRestaurant'])->name('specify.restaurant');

    Route::resource('kriterias',                    KriteriaController::class);
    Route::resource('kriteria-variasi-menu',        KriteriaVariasiMenuController::class);
    Route::resource('kriteria-jarak',               KriteriaJarakController::class);
    Route::resource('kriteria-harga',               KriteriaHargaController::class);
    Route::resource('kriteria-rasa',                KriteriaRasaController::class);
    Route::resource('kriteria-fasilitas',           KriteriaFasilitasController::class);
    Route::resource('kriteria-jam-operasional',     KategoriJamOperasionalController::class);
    Route::resource('bobot-kriteria',               BobotController::class);

    Route::resource('alternatif',               AlternatifController::class);
    Route::get('perhitungan-saw',               [AlternatifController::class, 'perhitunganSaw'])->name('perhitungan.saw');
    Route::get('normalisasi-alternatif',        [AlternatifController::class, 'normalisasiAlternatif'])->name('normalisasi.alternatif');
    Route::get('data-ranking',                  [AlternatifController::class, 'dataRanking'])->name('data.ranking');

    // Profile
    Route::get('/profile',                  [HomeController::class, 'profile'])->name('profile');
    Route::post('get-users',                [UserController::class, 'getUsers'])->name('get.users');
    Route::get('/profile/{id}/edit',        [UserController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile-update/{id}',      [UserController::class, 'updateProfile'])->name('profile.update');

    Route::get('list-approve',               [RestaurantController::class, 'listApprove'])->name('list.approve');
    Route::get('list-restaurants-rejected',  [RestaurantController::class, 'listRejected'])->name('list.rejected');
    Route::get('approve-restaurant/{id}',    [RestaurantController::class, 'approve'])->name('list.approve.restaurant');

    // Route::get('clear',                       [CacheController::class, 'clear'])->name('clear');
    Route::get('search-restaurants',          [RestaurantController::class, 'search'])->name('search.restaurants');

    Route::post('coment/store',             [CommentController::class, 'store'])->name('comment.store');
    Route::post('comment/{id}/like',        [CommentController::class, 'like'])->name('like.comment');
    Route::get('comment/{id}/likes',        [CommentController::class, 'getLikes']);
    Route::get('comment-restaurant/{id}',   [RestaurantController::class, 'commentRestaurant'])->name('comment.restaurant');
    Route::delete('delete-comment/{id}',    [RestaurantController::class, 'destroyComment'])->name('delete.comment');


    // Data Alternatif User
    Route::get('tambah-perhitungan-saw',                [AlternatifController::class, 'tambahPerhitunganSaw'])->name('tambah.perhitungan.saw');
    Route::get('list-perhitungan-saw',                  [AlternatifController::class, 'listPerhitunganSaw'])->name('list.perhitungan.saw');
    Route::post('store-perhitungan-saw',                [AlternatifController::class, 'storePerhitunganSaw'])->name('store.perhitungan.saw');
    Route::get('data-ranking-v2',                       [AlternatifController::class, 'dataRankingV2'])->name('data.ranking.v2');
    Route::get('data-noormalisasi-v2',                  [AlternatifController::class, 'dataNormalisasiV2'])->name('data.normalisasi.v2');
    Route::get('alternatif-user',                       [AlternatifController::class, 'alternatifUser'])->name('alternatif.user');
    Route::get('get-data-alternatif-user',                       [AlternatifController::class, 'getDataAlterntifUser'])->name('get.data.alternatif.user');
    Route::get('edit-alternatif-user/{id}',            [AlternatifController::class, 'editAlternatifUser'])->name('edit.alternatif.user');
    Route::put('update-alternatif-user/{id}',          [AlternatifController::class, 'updateAlternatifUser'])->name('update.alternatif.user');
    Route::delete('destroy-alternatif-user/{id}',      [AlternatifController::class, 'destroyAlternatifUser'])->name('destroy.alternatif.user');

    // Bobot User
    Route::get('list-bobot-user',                       [AlternatifController::class, 'listBobotUser'])->name('list.bobot.user');
    Route::post('store-bobot-user',                     [AlternatifController::class, 'storeBobotUser'])->name('store.bobot.user');
    Route::get('edit-bobot-user/{id}/edit',             [AlternatifController::class, 'editBobotUser'])->name('edit.bobot.user');
    Route::put('update-bobot-user/{id}',                [AlternatifController::class, 'updateBobotUser'])->name('update.bobot.user');
});
