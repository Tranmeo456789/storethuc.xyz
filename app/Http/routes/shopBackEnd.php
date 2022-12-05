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

//shop tdoctor
$prefixShopBackEnd = '/admin';
Route::group(['prefix' => $prefixShopBackEnd, 'namespace' => '\BackEnd', 'middleware' => ['auth']], function () { 
   
        Route::get('/danh-sach-don-vi-tinh', 'UnitController@index')->name('unit');
        Route::get('/them-don-vi-tinh', 'UnitController@form')->name('unit.add');
        Route::get('/sua-don-vi-tinh/{id}', 'UnitController@form')->name('unit.edit');
        Route::post('/luu-don-vi-tinh', 'UnitController@save')->name('unit.save');
        Route::get('/xoa-don-vi-tinh/{id}', 'UnitController@delete')->name('unit.delete');
   
});
