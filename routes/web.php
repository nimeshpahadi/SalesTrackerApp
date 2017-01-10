<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


Auth::routes();

Route::get('/', function () {
    return view('home');
});

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

Route::get('/home', 'HomeController@index');
Route::resource('/role', 'RoleController');
Route::resource('/user', 'UserController');
Route::resource('/distributor', 'DistributorController');
Route::resource('/product', 'ProductController');

// inventory
Route::resource('/stock', 'StockController');


//guarantee
Route::get('/guarantee/{id}', 'DistributorController@createguarantee')->name('distributor_guarantee');
Route::post('/guarantee', 'DistributorController@guarentee_store')->name('guarantee_store');
Route::get('/guarantee/{id}/edit', 'DistributorController@editguarantee')->name('guarantee_edit');
Route::put('/guarantee/{id}/update', 'DistributorController@updateguarantee')->name('guarantee_update');

//address
Route::get('/address/{id}', 'DistributorController@createaddress')->name("distributor_address");
Route::post('/address', 'DistributorController@addAddress')->name('add_distributor_address');
Route::get('/address/{id}/edit  ', 'DistributorController@editaddress')->name('edit_distributor_address');
Route::put('/address/{id}/update', 'DistributorController@updateaddress')->name('update_distributor_address');
Route::delete('/address/{id}/delete', 'DistributorController@destroy_address')->name('delete_distributor_address');

// tracking
Route::get('/tracking/{id}  ', 'DistributorController@createtracking')->name("distributor_tracking");
Route::post('/tracking', 'DistributorController@addTracking')->name("tracking_store");

// minute
Route::post('/minute', 'DistributorController@storeMinute')->name("minute_store");

//product
Route::put('/product/{id}/pricechange', 'ProductController@updateprice')->name("change_price");


// inventory
Route::get('/stockin', 'StockController@stockin')->name('stockin');
Route::get('/stockout', 'StockController@stockout')->name('stockout');
Route::get('/stockin/history/warehouse={wid}/product={pid}', 'StockController@stockinWarehouse')->name('stockinHistory');
Route::get('/stockout/history/warehouse={wid}/product={pid}', 'StockController@stockoutWarehouse')->name('stockoutHistory');


// order
Route::resource('/order','OrderController');

//payment
Route::get('warehouse/{id}/orders', 'StockController@orderwarehouse')->name("orderwarehouse");
Route::post('order/billing', 'OrderController@orderBilling')->name("add_order_billing");
Route::get('payment/distributor={id}', 'OrderController@createPayment')->name("create_payment");
Route::post('order/payment', 'OrderController@orderPayment')->name("add_order_payment");
Route::post('order/approval', 'OrderController@orderapproval')->name("add_order_approval");
Route::put('order/approval/{id}/update', 'OrderController@orderapprovalupdate')->name("update_order_approval");

Route::post('order/approval/admin', 'OrderController@salesAdminApproval')->name("sales_admin_approval");



Route::get('order', 'OrderController@filterOrder')->name("filter_order");
Route::post('orderout', 'OrderController@orderOut')->name("sendToWarehouse");


//dispatch
Route::post('order/dispatch', 'OrderController@orderdispatch')->name("dispatch");

//order approval
Route::resource('/orderApproval','OrderApprovalController');

//password change
Route::get('/user/{id}/password', 'Auth\RegisterController@password')->name("password");
Route::get('/user/{id}/resetpassword', 'Auth\RegisterController@passwordreset')->name("passwordreset");
Route::patch('/user/{id}/password', 'Auth\RegisterController@changepassword')->name("changepassword");
Route::patch('/user/{id}/reset/password', 'Auth\RegisterController@resetpassword')->name("resetpassword");

Route::get('/distributor/{id}/minute/location', 'DistributorController@minuteMap')->name("minute_location");
Route::get('/distributor/{id}/visit/location', 'DistributorController@visitMap')->name("visit_location");
Route::get('/distributor/status/list', 'DistributorController@distributorStatus')->name("status_list");
Route::get('/distributor/status/edit/{id}', 'DistributorController@editStatus')->name("status_edit");

Route::get('/customer/list', 'CustomerApprovalController@index');
Route::get('customer/sale/create', 'CustomerApprovalController@createSaleApprove')->name('customerApprove');
Route::get('customer/sale/update', 'CustomerApprovalController@updateSaleApprove')->name('customerApproveUpdate');
Route::post('customer/sale/reject', 'CustomerApprovalController@createSaleReject')->name('customerReject');

Route::get('/customer/admin/list', 'CustomerApprovalController@adminCustomerList');
Route::get('customer/admin/create', 'CustomerApprovalController@createAdminApprove')->name('customerAdminApprove');
Route::post('customer/admin/reject', 'CustomerApprovalController@createAdminReject')->name('customerAdminReject');

Route::get('/customer/account/list', 'CustomerApprovalController@accountCustomerList');
Route::get('customer/account/update', 'CustomerApprovalController@updateAccountApprove')->name('customerAccountApprove');

