<?php

use App\Http\Controllers\sale_cake;
use Illuminate\Support\Facades\Route;



Route::get('/', [sale_cake::class, 'getIndex']);


Route::get('/product/{id}', [sale_cake::class, 'getProduct']);

Route::get('/shopping_cart', [sale_cake::class, 'shopping_cart']);

Route::get('product_type/{type}', 'App\Http\Controllers\sale_cake@product_type');

/****************************Đăng kí */
Route::get('/signup', [sale_cake::class, 'signup']);
Route::post('/signup',  [sale_cake::class, 'postSignup'] )->name('dangki');
/************Đăng nhập */

Route::post('/postLogin',[sale_cake::class, 'postLogin']);

Route::get('/login', [sale_cake::class, 'login']);
/***********Đăng xuất */
Route::get('/logout', [sale_cake::class, 'postLogout']);

Route::get('/pricing', [sale_cake::class, 'pricing']);

Route::get('/contact', [sale_cake::class, 'contact']);

Route::get('/checkout', [sale_cake::class, 'checkout']);

Route::get('/about', [sale_cake::class, 'about']);

Route::get('/getProduct', [travel::class, 'getProduct']);

// giỏ hàng

Route::get('add-to-cart/{id}', [sale_cake::class, 'getAddtoCart']);
Route::get('del-cart/{id}', [sale_cake::class, 'getDelItemCart']);


// Route::resource('produ', sale_cake::class);


/***admin */
Route::get('/admin', [sale_cake::class, 'getIndexAdmin']);

Route::get('/add-form', [sale_cake::class, 'getAdminAdd']);

Route::post('/admin-add', [sale_cake::class, 'postAddProduct']);

Route::get('/admin-edit-form/{id}', [sale_cake::class, 'editProduct']);

Route::post('/admin-edit', [sale_cake::class, 'postEditProduct']);

Route::post('/adminDelete/{id}', [sale_cake::class, 'postDeleteProduct']);



/*****Đặt hàng******* */
Route::get('/dat-hang',  [sale_cake::class, 'getCheckout']);
Route::post('/dat-hang',  [sale_cake::class, 'postCheckout']);


Route::get('/export', [sale_cake::class,'export']);
