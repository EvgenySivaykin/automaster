<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AutoserviceController as A;
use App\Http\Controllers\MechanicController as M;
use App\Http\Controllers\ServiceController as S;
use App\Http\Controllers\FrontController as F;
use App\Http\Controllers\OrderController as O;

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

Route::get('/', [F::class, 'home'])->name('start')->middleware('roles:A|C');
// Route::get('/mechanics/{autoservice}', [F::class, 'autoserviceMechanics'])->name('autoservice-mechanics')->middleware('roles:A|C');
Route::get('/cat/{autoservice}', [F::class, 'showCatMechanics'])->name('show-cats-mechanics')->middleware('roles:A|C');
Route::get('/choose/{mechanic}', [F::class, 'choose'])->name('choose')->middleware('roles:A|C');
Route::get('/cart', [F::class, 'cart'])->name('cart')->middleware('roles:A|C');
Route::post('/cart', [F::class, 'updateCart'])->name('update-cart')->middleware('roles:A|C');
Route::post('/add-to-cart/', [F::class, 'addToCart'])->name('add-to-cart')->middleware('roles:A|C');
Route::post('/make-order', [F::class, 'makeOrder'])->name('make-order')->middleware('roles:A|C');

//вставка из-за рейтинга ниже:
Route::put('/update-rating/{mechanic}', [M::class, 'update_rating'])->name('update_rating')->middleware('roles:A|C');
//конец вставки

Route::prefix('admin/autoservices')->name('autoservices-')->group(function () {
    Route::get('/', [A::class, 'index'])->name('index')->middleware('roles:A');
    Route::get('/create', [A::class, 'create'])->name('create')->middleware('roles:A');
    Route::post('/create', [A::class, 'store'])->name('store')->middleware('roles:A');
    Route::get('/edit/{autoservice}', [A::class, 'edit'])->name('edit')->middleware('roles:A');
    Route::put('/edit/{autoservice}', [A::class, 'update'])->name('update')->middleware('roles:A');
    Route::delete('/delete/{autoservice}', [A::class, 'destroy'])->name('delete')->middleware('roles:A');
});

Route::prefix('admin/mechanics')->name('mechanics-')->group(function () {
    Route::get('/', [M::class, 'index'])->name('index')->middleware('roles:A');
    Route::get('/create', [M::class, 'create'])->name('create')->middleware('roles:A');
    Route::post('/create', [M::class, 'store'])->name('store')->middleware('roles:A');
    Route::get('/edit/{mechanic}', [M::class, 'edit'])->name('edit')->middleware('roles:A');
    Route::put('/edit/{mechanic}', [M::class, 'update'])->name('update')->middleware('roles:A');
    Route::delete('/delete/{mechanic}', [M::class, 'destroy'])->name('delete')->middleware('roles:A');
});

Route::prefix('admin/operations')->name('operations-')->group(function () {
    Route::get('/', [S::class, 'index'])->name('index')->middleware('roles:A');
    Route::get('/create', [S::class, 'create'])->name('create')->middleware('roles:A');
    Route::post('/create', [S::class, 'store'])->name('store')->middleware('roles:A');
    Route::get('/edit/{service}', [S::class, 'edit'])->name('edit')->middleware('roles:A');
    Route::put('/edit/{service}', [S::class, 'update'])->name('update')->middleware('roles:A');
    Route::delete('/delete/{service}', [S::class, 'destroy'])->name('delete')->middleware('roles:A');
});

Route::prefix('admin/orders')->name('orders-')->group(function () {
    Route::get('/', [O::class, 'index'])->name('index')->middleware('roles:A');
    Route::put('/edit/{order}', [O::class, 'update'])->name('update')->middleware('roles:A');
    Route::delete('/delete/{order}', [O::class, 'destroy'])->name('delete')->middleware('roles:A');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');