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
Route::redirect('/', '/categories', 301);
Route::get('/categories', 'Categories@index')->name('categories.index');
Route::post('/categories', 'Categories@store')->name('categories.store');
Route::post('/categories/{category}', 'Categories@update')->name('categories.update');
Route::delete('/categories/{category}', 'Categories@destroy')->name('categories.destroy');
Route::get('/categories/{category}/products', 'Categories@products')->name('categories.products');
Route::get('/products', 'Products@index')->name('products.index');
Route::get('/priceLists', 'CmsPriceLists@index')->name('priceLists.index');
Route::get('/users', 'CmsUsers@index')->name('users.index');
Route::get('/logout', 'General@logout')->name('logout');
Route::get('/change_password', 'General@logout')->name('change_password');
