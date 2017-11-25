<?php

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

Route::view('terms', 'terms');

Route::get('/', 'Categories@index');
Route::get('/categories', 'Categories@index')->name('categories.index');
Route::post('/categories', 'Categories@store')->name('categories.store');
Route::post('/categories/{category}', 'Categories@update')->name('categories.update');
Route::delete('/categories/{category}', 'Categories@destroy')->name('categories.destroy');
Route::get('/categories/{category}/products', 'Categories@products')->name('categories.products');
Route::get('/categories/{category}/products/{product}/prices', 'Categories@productPrices')->name('categories.productPrices');

Route::get('/products', 'Products@index')->name('products.index');
Route::post('/products', 'Products@store')->name('products.store');
Route::post('/products/{product}', 'Products@update')->name('products.update');
Route::get('/products/{product}/product_details', 'Products@productDetails')->name('products.productDetails');
Route::delete('/products/{product}', 'Products@destroy')->name('products.destroy');
Route::get('/products/{product}/prices', 'Products@prices')->name('products.prices');

Route::post('/prices/{price}', 'CmsPrices@update')->name('CmsPrices.update');
Route::post('/prices', 'CmsPrices@store')->name('CmsPrices.store');

Route::get('/priceLists', 'CmsPriceLists@index')->name('priceLists.index');
Route::get('/users', 'CmsUsers@index')->name('users.index');
Route::get('/logout', 'General@logout')->name('logout');
Route::get('/change_password', 'General@logout')->name('change_password');
