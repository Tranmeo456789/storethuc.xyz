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
   
        Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
        Route::get('/loc-doanh-thu-theo-thoi-gian', 'DashboardController@filterInDay')->name('dashboard.filterInDay');


        Route::get('/danh-sach-don-vi-tinh', 'UnitController@index')->name('unit');
        Route::get('/them-don-vi-tinh', 'UnitController@form')->name('unit.add');
        Route::get('/sua-don-vi-tinh/{id}', 'UnitController@form')->name('unit.edit');
        Route::post('/luu-don-vi-tinh', 'UnitController@save')->name('unit.save');
        Route::get('/xoa-don-vi-tinh/{id}', 'UnitController@delete')->name('unit.delete');

        Route::get('/danh-sach-danh-muc-san-pham', 'CatProductController@index')->name('catProduct');
        Route::get('/them-danh-muc-san-pham', 'CatProductController@form')->name('catProduct.add');
        Route::get('/sua-danh-muc-san-pham/{id}', 'CatProductController@form')->name('catProduct.edit');
        Route::post('/luu-danh-muc-san-pham', 'CatProductController@save')->name('catProduct.save');
        Route::get('/xoa-danh-muc-san-pham/{id}', 'CatProductController@delete')->name('catProduct.delete');
        Route::get('move-{type}/{id}',   'CatProductController@move')->name('catProduct.move');

        Route::get('/danh-sach-san-pham', 'ProductController@index')->name('product');
        Route::get('/them-san-pham', 'ProductController@form')->name('product.add');
        Route::get('/sua-san-pham/{id}', 'ProductController@form')->name('backend.product.edit');
        Route::post('/luu-san-pham', 'ProductController@save')->name('product.save');
        Route::get('/xoa-san-pham/{id}', 'ProductController@delete')->name('backend.product.delete');
        Route::get('/chi-tiet-san-pham/{id}', 'ProductController@getItem')->name('product.getItem');
   
        Route::get('/danh-sach-don-hang', 'OrderController@index')->name('order');
        Route::get('/chi-tiet-don-hang/{id}', 'OrderController@detail')->name('backend.order.detail');
        Route::post('/cap-nhat-trang-thai-don-hang', 'OrderController@changeStatusOrder')->name('order.changeStatusOrder');
        Route::post('/luu-don-hang', 'OrderController@save')->name('order.save');

        Route::get('/danh-sach-trang', 'PageController@index')->name('page');
        Route::get('/them-trang', 'PageController@form')->name('page.add');
        Route::get('/sua-trang/{id}', 'PageController@form')->name('backend.page.edit');
        Route::post('/luu-trang', 'PageController@save')->name('page.save');
        Route::get('/xoa-trang/{id}', 'PageController@delete')->name('backend.page.delete');
});
