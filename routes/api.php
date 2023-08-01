<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', 'Api\RegisterController@register');

//login create token
Route::post('login', 'Api\LoginController@login');
// list product
Route::get('product', 'Api\ProductController@index');
// refresh token
Route::post('refresh-token', 'Api\LoginController@refreshToken');
//delete token
Route::delete('delete-token', 'Api\LoginController@deleteToken');
//cart
Route::get('cart/count', 'Api\CartController@count');
Route::post('cart/add', 'Api\CartController@add');
Route::get('cart/detail', 'Api\CartController@detail');
Route::post('cart/update', 'Api\CartController@update');
Route::post('cart/confirm', 'Api\CartController@confirm');

//return info when reload page in reatjs
Route::get('me', 'Api\LoginController@reactjsReload');
Route::get('user-list', 'Api\UserController@list');

Route::group(['middleware' => 'CheckToken'], function() {
    Route::delete('delete-user/{idUser}', 'Api\UserController@delete');
});