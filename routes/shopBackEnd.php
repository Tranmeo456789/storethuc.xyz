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
$prefixShopBackEnd = '/backend';
Route::group(['prefix' => $prefixShopBackEnd, 'namespace' => 'BackEnd', 'middleware' => ['auth']], function () { 
   
        Route::get('/danh-sach-don-vi-tinh', 'UnitController@index')->name('unit');
        Route::get('/them-don-vi-tinh', 'UnitController@form')->name('unit.add');
        Route::get('/sua-don-vi-tinh/{id}', 'UnitController@form')->name('unit.edit');
        Route::post('/luu-don-vi-tinh', 'UnitController@save')->name('unit.save');
        Route::get('/xoa-don-vi-tinh/{id}', 'UnitController@delete')->name('unit.delete');

        Route::get('/danh-sach-danh-muc-thuoc', 'CatProductController@index')->name('catProduct');
        Route::get('/them-danh-muc-thuoc', 'CatProductController@form')->name('catProduct.add');
        Route::get('/sua-danh-muc-thuoc/{id}', 'CatProductController@form')->name('catProduct.edit');
        Route::post('/luu-danh-muc-thuoc', 'CatProductController@save')->name('catProduct.save');
        Route::get('/xoa-danh-muc-thuoc/{id}', 'CatProductController@delete')->name('catProduct.delete');
        Route::get('move-{type}/{id}',   'CatProductController@move')->name('catProduct.move');

        Route::get('/danh-sach-san-pham', 'ProductController@index')->name('product');
        Route::get('/them-san-pham', 'ProductController@form')->name('product.add');
        Route::get('/sua-san-pham/{id}', 'ProductController@form')->name('backend.product.edit');
        Route::post('/luu-san-pham', 'ProductController@save')->name('product.save');
        Route::get('/xoa-san-pham/{id}', 'ProductController@delete')->name('backend.product.delete');
        Route::get('/chi-tiet-san-pham/{id}', 'ProductController@getItem')->name('product.getItem');
   
        Route::get('/danh-sach-don-hang', 'OrderController@index')->name('order');
        Route::get('/chi-tiet-don-hang/{id}', 'OrderController@detail')->name('backend.order.detail');
        Route::get('/cap-nhat-trang-thai-don-hang-{value}/{id}', 'OrderController@changeStatusOrder')->name('order.changeStatusOrder');
        Route::post('/luu-don-hang', 'OrderController@save')->name('order.save');
});
