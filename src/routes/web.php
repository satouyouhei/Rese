<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MyPageController;
use App\Http\Controllers\ManagementScreenController;
use App\Http\Controllers\AdminController;

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

Route::middleware('auth')->group(function () {
    Route::middleware('verified')->group(function () {

        Route::get('/logout', [AuthController::class,'destroy']);

        Route::get('/mypage',[MyPageController::class,'index']);
        Route::get('/mypage/favorite/add/{shop}',[MyPageController::class,'store'])->name('favorite.add');
        Route::DELETE('/mypage/favorite/delete/{shop}',[MyPageController::class,'favoriteDestroy'])->name('favorite.delete');
        Route::get('/mypage/reservation/edit/{reservation}',[MyPageController::class,'edit'])->name('reservation.edit');
        Route::post('/mypage/reservation/update/{reservation}',[MyPageController::class,'update'])->name('reservation.update');
        Route::DELETE('/mypage/reservation/delete/{reservation}',[MyPageController::class,'reservationDestroy'])->name('reservation.delete');
    
    });
});

Route::get('/',[ShopController::class, 'getIndex']);
Route::get('/detail/{shop_id}',[ShopController::class,'detail']);
Route::get('/search',[ShopController::class,'search']);
Route::post('/reserve/{shop_id}',[ShopController::class,'store'])->name('reservation');
Route::view('/done','done');

Route::get('/login', [AuthController::class,'getLogin'])->name('login');
Route::post('/login', [AuthController::class,'postLogin']);
Route::get('/register', [AuthController::class,'getRegister']);
Route::post('/register', [AuthController::class,'postRegister']);
Route::view('/thanks', 'thanks');


Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::controller(AdminController::class)->group(function () {
        Route::post('/register/shopRepresentative','register');
        Route::view('/register','admin.register_shopRepresentative');
    });
});

Route::middleware(['auth', 'role:shop'])->prefix('shop')->group(function () {
    Route::controller(ManagementScreenController::class)->group(function () {
        Route::get('/shop-edit', 'editShow');
        Route::post('/shop-edit', 'create_and_edit')->name('shopEdit');
        Route::get('/confirm/shop-reservation', 'reservationShow');
        Route::patch('/update/shop-reservation', 'update');
        Route::delete('/destroy/shop-reservation', 'destroy');
    });
});

// Route::get('/', function () {
//     return view('welcome');
// });
