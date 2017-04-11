<?php
/**
 * Created by PhpStorm.
 * User: trees
 * Date: 12/9/16
 * Time: 4:21 PM
 */

Route::get('/distributor/list', 'DistributorDetailController@getDetailsList');
Route::get('/distributor/{distributor_id}', 'DistributorDetailController@getDetails');

Route::post('/distributor/create', 'DistributorDetailController@createDetails');
Route::post('/distributor/address', 'DistributorAddressController@createAddress');
Route::post('/distributor/address/update/{update_id}', 'DistributorAddressController@updateAddress');
Route::post('/distributor/tracking', 'DistributorTrackingController@createTracking');
Route::post('/distributor/minute', 'DistributorMinuteController@createMinute');

// customer document
Route::post('/customer/document/create', 'CustomerDocumentApiController@create');

// customer area
Route::post('/customer/area/create', 'CustomerAreaApiController@create');
Route::put('/customer/area/{id}/edit', 'CustomerAreaApiController@edit');
Route::delete('/customer/area/{id}/delete', 'CustomerAreaApiController@delete');