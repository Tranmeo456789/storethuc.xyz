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

        Route::get('/danh-sach-don-vi-tinh', 'UnitController@index')->name('unit')->middleware('can:list_unit');
        Route::get('/them-don-vi-tinh', 'UnitController@form')->name('unit.add')->middleware('can:add_unit');
        Route::get('/sua-don-vi-tinh/{id}', 'UnitController@form')->name('unit.edit')->middleware('can:edit_unit');
        Route::post('/luu-don-vi-tinh', 'UnitController@save')->name('unit.save');
        Route::get('/xoa-don-vi-tinh/{id}', 'UnitController@delete')->name('unit.delete')->middleware('can:delete_unit');

        Route::get('/danh-sach-mau', 'ColorController@index')->name('color')->middleware('can:list_color');
        Route::get('/them-mau', 'ColorController@form')->name('color.add')->middleware('can:add_color');
        Route::get('/sua-mau/{id}', 'ColorController@form')->name('color.edit')->middleware('can:edit_color');
        Route::post('/luu-mau', 'ColorController@save')->name('color.save');
        Route::get('/xoa-mau/{id}', 'ColorController@delete')->name('color.delete')->middleware('can:delete_color');

        Route::get('/danh-sach-danh-muc-san-pham', 'CatProductController@index')->name('catProduct')->middleware('can:list_cat_product');
        Route::get('/them-danh-muc-san-pham', 'CatProductController@form')->name('catProduct.add')->middleware('can:add_cat_product');
        Route::get('/sua-danh-muc-san-pham/{id}', 'CatProductController@form')->name('catProduct.edit')->middleware('can:edit_cat_product');
        Route::post('/luu-danh-muc-san-pham', 'CatProductController@save')->name('catProduct.save');
        Route::get('/xoa-danh-muc-san-pham/{id}', 'CatProductController@delete')->name('catProduct.delete')->middleware('can:delete_cat_product');
        Route::get('move-{type}/{id}',   'CatProductController@move')->name('catProduct.move');

        Route::get('/danh-sach-san-pham', 'ProductController@index')->name('product')->middleware('can:list_product');
        Route::get('/them-san-pham', 'ProductController@form')->name('product.add')->middleware('can:add_product');
        Route::get('/sua-san-pham/{id}', 'ProductController@form')->name('backend.product.edit')->middleware('can:edit_product');
        Route::post('/luu-san-pham', 'ProductController@save')->name('product.save');
        Route::get('/xoa-san-pham/{id}', 'ProductController@delete')->name('backend.product.delete')->middleware('can:delete_product');
        Route::get('/chi-tiet-san-pham/{id}', 'ProductController@getItem')->name('product.getItem');
   
        Route::get('/danh-sach-don-hang', 'OrderController@index')->name('order')->middleware('can:list_order');
        Route::get('/chi-tiet-don-hang/{id}', 'OrderController@detail')->name('backend.order.detail')->middleware('can:detail_order');
        Route::post('/cap-nhat-trang-thai-don-hang', 'OrderController@changeStatusOrder')->name('order.changeStatusOrder');
        Route::post('/luu-don-hang', 'OrderController@save')->name('order.save');

        Route::get('/danh-sach-trang', 'PageController@index')->name('page')->middleware('can:list_page');
        Route::get('/them-trang', 'PageController@form')->name('page.add')->middleware('can:add_page');
        Route::get('/sua-trang/{id}', 'PageController@form')->name('backend.page.edit')->middleware('can:edit_page');
        Route::post('/luu-trang', 'PageController@save')->name('page.save');
        Route::get('/xoa-trang/{id}', 'PageController@delete')->name('backend.page.delete')->middleware('can:delete_page');

        Route::get('/danh-sach-danh-muc-bai-viet', 'CatPostController@index')->name('catPost')->middleware('can:list_cat_post');
        Route::get('/them-danh-muc-bai-viet', 'CatPostController@form')->name('catPost.add')->middleware('can:add_cat_post');
        Route::get('/sua-danh-muc-bai-viet/{id}', 'CatPostController@form')->name('catPost.edit')->middleware('can:edit_cat_post');
        Route::post('/luu-danh-muc-bai-viet', 'CatPostController@save')->name('catPost.save');
        Route::get('/xoa-danh-muc-bai-viet/{id}', 'CatPostController@delete')->name('catPost.delete')->middleware('can:delete_cat_post');

        Route::get('/danh-sach-bai-viet', 'PostController@index')->name('post')->middleware('can:list_post');
        Route::get('/them-bai-viet', 'PostController@form')->name('post.add')->middleware('can:add_post');
        Route::get('/sua-bai-viet/{id}', 'PostController@form')->name('backend.post.edit')->middleware('can:edit_post');
        Route::post('/luu-bai-viet', 'PostController@save')->name('post.save');
        Route::get('/xoa-bai-viet/{id}', 'PostController@delete')->name('backend.post.delete')->middleware('can:delete_post');

        Route::get('/danh-sach-nguoi-dung', 'UserController@index')->name('user')->middleware('can:list_user');
        Route::get('/them-nguoi-dung', 'UserController@form')->name('user.add')->middleware('can:add_user');
        Route::get('/sua-nguoi-dung/{id}', 'UserController@form')->name('backend.user.edit')->middleware('can:edit_user');
        Route::post('/luu-nguoi-dung', 'UserController@save')->name('user.save');
        Route::get('/xoa-nguoi-dung/{id}', 'UserController@delete')->name('backend.user.delete')->middleware('can:delete_user');

        Route::get('/danh-sach-slider', 'SliderController@index')->name('slider')->middleware('can:list_slider');
        Route::get('/them-slider', 'SliderController@form')->name('slider.add')->middleware('can:add_slider');
        Route::get('/sua-slider/{id}', 'SliderController@form')->name('backend.slider.edit')->middleware('can:edit_slider');
        Route::post('/luu-slider', 'SliderController@save')->name('slider.save');
        Route::get('/up-vi-tri-slider/{id}', 'SliderController@up')->name('backend.slider.up')->middleware('can:change_localtion');
        Route::get('/xoa-slider/{id}', 'SliderController@delete')->name('backend.slider.delete')->middleware('can:delete_slider');
        
        Route::get('/theme-trang-chu', 'SettingController@formInfomation')->name('setting.infomation');
        Route::post('/luu-theme-trang-chu', 'SettingController@saveInfomation')->name('setting.infomation.save');

        Route::get('/danh-sach-phi-ship', 'FeeShipController@index')->name('feeShip')->middleware('can:list_unit');
        Route::get('/them-phi-ship', 'FeeShipController@form')->name('feeShip.add')->middleware('can:add_unit');
        Route::get('/sua-phi-ship/{id}', 'FeeShipController@form')->name('feeShip.edit')->middleware('can:edit_unit');
        Route::post('/luu-phi-ship', 'FeeShipController@save')->name('feeShip.save');
        Route::get('/xoa-phi-ship/{id}', 'FeeShipController@delete')->name('feeShip.delete')->middleware('can:delete_unit');

        Route::get('/danh-sach-kho-hang', 'WarehouseController@index')->name('warehouse')->middleware('can:list_unit');
        Route::get('/them-kho-hang', 'WarehouseController@form')->name('warehouse.add')->middleware('can:add_unit');
        Route::get('/sua-kho-hang/{id}', 'WarehouseController@form')->name('warehouse.edit')->middleware('can:edit_unit');
        Route::post('/luu-kho-hang', 'WarehouseController@save')->name('warehouse.save');
        Route::get('/xoa-kho-hang/{id}', 'WarehouseController@delete')->name('warehouse.delete')->middleware('can:delete_unit');
        Route::get('/thong-tin-kho-hang', 'WarehouseController@info')->name('warehouse.info');

        Route::get('/danh-sach-phieu-nhap-hang', 'ImportCouponController@index')->name('importCoupon');
        Route::get('/them-phieu-nhap-hang', 'ImportCouponController@form')->name('importCoupon.add');
        Route::get('/sua-phieu-nhap-hang/{id}', 'ImportCouponController@form')->name('importCoupon.edit');
        Route::post('/luu-phieu-nhap-hang', 'ImportCouponController@save')->name('importCoupon.save');
        Route::get('/xoa-phieu-nhap-hang/{id}', 'ImportCouponController@delete')->name('importCoupon.delete');
});
