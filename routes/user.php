<?php
/**
 * Created by PhpStorm.
 * User: trees
 * Date: 12/9/16
 * Time: 2:55 PM
 */


Route::get('/user/{user_id}', 'UserApiController@getId');
Route::post('/login', 'UserApiController@showLogin');
Route::post('/user/location/create', 'UserLocationController@createUserLocation');