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
});

Route::middleware('auth:api')->prefix('v2')->group( function() {
  Route::get('retail', 'Retail@retail');
  Route::get('wholesale', 'WholeSale@wholesale');
  Route::get('price_list', 'PriceLists@priceList');
  Route::post('feed_back', 'Feedbacks@store');
  Route::get('account_detail', 'Users@accountDetail');
  Route::post('update_subscription', 'Users@updateSubscription');
});
