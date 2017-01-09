<?php

/*
|--------------------------------------------------------------------------
| Api Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Api routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your Api!
|
*/


Route::get('/product/list', 'ProductApiController@getProductList');

Route::get('/order/list/user/{user_id}', 'OrderApiController@getUserOrder'); // order history on user basis
Route::get('/order/list/distributor/{dist_id}', 'OrderApiController@getDistOrder'); // order history on distributor basis
Route::get('/order/{order_id}', 'OrderApiController@getOrder');

Route::post('/order/create', 'OrderApiController@createOrder');
Route::post('/order/update/{order_id}', 'OrderApiController@updateOrder');

Route::get('/payment/distributor/{dist_id}/', 'PaymentApiController@getPaymentList'); // payment history on distributor basis
Route::post('/payment/create', 'PaymentApiController@createPayment');