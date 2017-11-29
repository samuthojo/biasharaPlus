<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v2')->group( function() {
  Route::post('check_user_existence', 'Users@checkUserExistence');
  Route::post('send_user_details', 'Users@sendUserDetails');
  Route::post('check_system_existence', 'Users@checkSystemExistence');
  Route::get('/categories', 'ApiCategories@categories');
});

Route::middleware('auth:api')->prefix('v2')->group( function() {
  Route::get('retail/{country}', 'Retail@retail');
  Route::get('wholesale/{country}', 'WholeSale');
  Route::get('price_list', 'PriceLists@priceList');
  Route::post('feed_back', 'Feedbacks@store');
  Route::get('account_detail', 'Users@accountDetail');
  Route::get('app_details', 'App');
  Route::post('update_subscription', 'Users@updateSubscription');
  Route::post('receive_payment', 'Payments@store');
});
