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

Route::view('/login', 'login');

Auth::routes();

Route::middleware('auth')->group(function () {
  Route::get('/', 'Categories@index')->name('home');
  Route::get('/categories', 'Categories@index')->name('categories.index');
  Route::get('/all_categories', 'Categories@categories')->name('categories.categories');
  Route::post('/categories', 'Categories@store')->name('categories.store');
  Route::post('/categories/{category}', 'Categories@update')->name('categories.update');
  Route::delete('/categories/{category}', 'Categories@destroy')->name('categories.destroy');
  Route::get('/categories/{category}/products', 'Categories@products')->name('categories.products');
  Route::post('/categories/{category}/products', 'Categories@addProduct')->name('categories.addProduct');
  Route::post('/categories/{category}/products/{product}', 'Categories@updateProduct')->name('categories.updateProduct');
  Route::delete('/categories/{category}/products/{product}', 'Categories@deleteProduct')->name('categories.deleteProduct');
  Route::get('/categories/{category}/products/{product}/prices', 'Categories@productPrices')->name('categories.productPrices');
});

Route::middleware('auth')->group(function () {
  Route::get('/products', 'Products@index')->name('products.index');
  Route::post('/products', 'Products@store')->name('products.store');
  Route::post('/products/{product}', 'Products@update')->name('products.update');
  Route::get('/products/{product}/product_details', 'Products@productDetails')->name('products.productDetails');
  Route::delete('/products/{product}', 'Products@destroy')->name('products.destroy');
  Route::get('/products/{product}/prices', 'Products@prices')->name('products.prices');
  Route::get('/all_products', 'Products@products');

  Route::post('/prices/{price}', 'CmsPrices@update')->name('CmsPrices.update');
  Route::post('/prices', 'CmsPrices@store')->name('CmsPrices.store');
  Route::get('/all_prices', 'CmsPrices@prices');
});

Route::middleware('auth')->group(function () {
  Route::get('/pricelists', 'CmsPricelists@index')->name('cms_pricelists.index');
  Route::post('/pricelists', 'CmsPricelists@store')->name('cms_pricelists.store');
  Route::post('/pricelists/{pricelist}', 'CmsPricelists@update')->name('cms_pricelists.update');
  Route::delete('/pricelists/{pricelist}', 'CmsPricelists@destroy')->name('cms_pricelists.destroy');
  Route::get('/all_pricelists', 'CmsPricelists@pricelists');

  Route::get('/users', 'CmsUsers@index')->name('users.index');
  Route::get('/all_users', 'CmsUsers@users')->name('users.users');
  Route::get('/users/{user}/payments', 'CmsUsers@userPayments')->name('users.userPayments');
});

Route::middleware('auth')->group(function () {
  Route::get('/versions', 'Versions@index')->name('versions.index');
  Route::get('/versions/{version}/version_details', 'Versions@versionDetails')->name('versions.versionDetails');
  Route::post('/versions', 'Versions@store')->name('versions.store');
  Route::post('/versions/{version}', 'Versions@update')->name('versions.update');
});

Route::middleware('auth')->group(function () {
  Route::get('/bundles', 'Bundles@index')->name('bundles.index');
  Route::post('/bundles/{bundle}', 'Bundles@update')->name('bundles.update');

  Route::get('/feedback', 'CmsFeedback@index')->name('cms_feedback.index');

  Route::view('/notifications', 'notifications')->name('notifications');
  Route::post('/notifications', 'Notifications@sendNotification');
});

Route::middleware('auth')->group(function () {
  Route::get('/pay_bill_numbers', 'PayBillNumbers@index');
  Route::post('/pay_bill_numbers', 'PayBillNumbers@store');
  Route::post('/pay_bill_numbers/{payBillNumber}', 'PayBillNumbers@update');
  Route::delete('/pay_bill_numbers/{payBillNumber}', 'PayBillNumbers@destroy');

  Route::view('/send_payments', 'send_payments')->name('payments_page');
  Route::post('/send_payments', 'CmsPayments@store')->name('post_payments');

  Route::get('/all_payments', 'CmsPayments@payments')->name('all_payments');

  Route::view('/change_password', 'change_password')->name('change_password');
});
