<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::group(['middleware' => 'RoleAdmin'],function(){
    // Admin CRUD
    Route::get('/admin',[App\Http\Controllers\HomeController::class, 'admin']);
    Route::get('/items',[App\Http\Controllers\ItemController::class, 'create']);
    Route::post('/items',[App\Http\Controllers\ItemController::class, 'store'])->name('storeItems');
    Route::get('/items/update/{id}',[App\Http\Controllers\ItemController::class, 'edit']);
    Route::put('/items/update/{id}',[App\Http\Controllers\ItemController::class, 'update'])->name('updateItems');
    Route::delete('/items/delete/{id}',[App\Http\Controllers\ItemController::class, 'destroy']);
    Route::resource('/kategori', App\Http\Controllers\CategoryController::class);
    Route::post('/kategori/create',[App\Http\Controllers\CategoryController::class, 'create'])->name('createKategori');
    Route::delete('/kategori/delete/{id}',[App\Http\Controllers\CategoryController::class, 'destroy']);
    Route::get('/admin/invoice', [App\Http\Controllers\CheckoutController::class, 'admin_invoice'])->name('admin-invoice');
    Route::put('/admin/invoice/{id}',[App\Http\Controllers\CheckoutController::class, 'admin_update'])->name('terimaPesanan');
});

Route::group(['middleware' => 'RoleMember'],function(){
    Route::get('/member',[App\Http\Controllers\HomeController::class, 'member']);
    Route::get('/edit-profile',[App\Http\Controllers\UserController::class, 'edit'])->name('editProfile');
    Route::put('/update-profile',[App\Http\Controllers\UserController::class, 'update'])->name('updateProfile');
    Route::get('/edit-password',[App\Http\Controllers\UserController::class, 'editPassword'])->name('editPassword');
    Route::put('/update-password',[App\Http\Controllers\UserController::class, 'updatePassword'])->name('updatePassword');

});
Route::get('/items/{id}',[App\Http\Controllers\ItemController::class, 'show'])->name('showItems');


Route::group(['middleware' => 'RoleMember'],function() {
    Route::get('cart', [App\Http\Controllers\CartController::class, 'store'])->name('storeCart');
    Route::get('/cart/showCart', [App\Http\Controllers\CartController::class, 'show'])->name('showCart');
    Route::get('/cart/delete', [App\Http\Controllers\CartController::class, 'destroy'])->name('deleteCart');
    Route::get('/cart/changeQuantity', [App\Http\Controllers\CartController::class, 'update'])->name('updateCart');
});

Route::middleware(['auth'])->group(function(){
    Route::get('checkout' , [App\Http\Controllers\CheckoutController::class, 'index'])->name('checkout');
    Route::post('create-order', [App\Http\Controllers\CheckoutController::class, 'create'])->name('createOrder');
    Route::get('/invoice', [App\Http\Controllers\CheckoutController::class, 'invoice'])->name('invoice');
});
