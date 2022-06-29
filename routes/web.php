<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Gate;
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


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@index');
//  Route::get('/', function () {
//     return view('home');
// });
Auth::routes();
//Route::get('/', 'HomeController@index')->name('home');
//Route::get('dashboard', 'DashboardController@show')->middleware('auth');


//Route::get('admin/user/add', 'AdminUserController@add');
//Route::post('admin/user/store', 'AdminUserController@store');

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::get('/getInfo/facebook/{social}','SocialController@getInfo');
Route::get('/check-info-facebook/{social}','SocialController@checkInfo');


Route::get('san-pham-{slug}', 'ProductController@list_product')->name('cat0.product');
// Route::get('san-pham/{slugproduct}', 'ProductController@show_detail')->name('product.detail');
Route::get('san-pham/{slug1}', 'ProductController@list_product1')->name('cat1.product');

Route::get('searchProduct', 'ProductController@searchProductAjax')->name('searchProductAjax');
Route::post('cart/updateCartAjax', 'CartController@updateCartAjax')->name('updateCartAjax');
Route::get('san-pham', 'ProductController@all_product');
Route::get('tim-kiem', 'ProductController@list_search');
Route::get('thanh-toan', 'OrderController@checkout');
Route::middleware('auth')->group(function(){
    // Route::get('/admin', function () {
    //     return view('admin.dashboard');
    // });

    

    Route::get('dashboard', 'DashboardController@show');
    Route::get('admin', 'DashboardController@show');
        
    Route::get('admin/user/list', 'AdminUserController@list')->middleware('can:list_user');
    Route::get('admin/user/list_active', 'AdminUserController@list_active');
    Route::get('admin/user/list_trash', 'AdminUserController@list_trash');
    Route::get('admin/user/add', 'AdminUserController@add')->middleware('can:add_user');
    Route::post('admin/user/store', 'AdminUserController@store');
    Route::get('admin/user/delete/{id}', 'AdminUserController@delete')->name('delete_user');
    Route::get('admin/user/forcedelete/{id}', 'AdminUserController@forcedelete')->name('forcedelete_user');
    Route::get('admin/user/action', 'AdminUserController@action');
    Route::get('admin/user/edit/{id}', 'AdminUserController@edit')->name('user.edit')->middleware('can:edit_user');
    Route::post('admin/user/update/{id}', 'AdminUserController@update')->name('user.update');

    Route::get('admin/user/check_role', 'AdminUserController@list_roles');

    Route::get('admin/page/list', 'AdminPageController@list')->middleware('can:list_page');
    Route::get('admin/page/list_open', 'AdminPageController@list_open');
    Route::get('admin/page/list_wait', 'AdminPageController@list_wait');
    Route::get('admin/page/list_trash', 'AdminPageController@list_trash');
    Route::get('admin/page/add', 'AdminPageController@add')->middleware('can:add_page');
    // Route::get('admin/page/{slug}-{id}.html', 'AdminPageController@detail')->name('page.detail');
    Route::post('admin/page/store', 'AdminPageController@store');
    Route::get('admin/page/delete/{id}', 'AdminPageController@delete')->name('delete_page');
    Route::get('admin/page/forcedelete/{id}', 'AdminPageController@forcedelete')->name('forcedelete_page');
    Route::get('admin/page/edit/{id}', 'AdminPageController@edit')->name('page.edit')->middleware('can:edit_page');
    Route::post('admin/page/update/{id}', 'AdminPageController@update')->name('page.update');
    Route::get('admin/page/search', 'AdminPageController@search');
    Route::get('admin/page/action', 'AdminPageController@action');

    Route::get('admin/post/list', 'AdminPostController@list')->middleware('can:list_post');
    Route::get('admin/post/list_open', 'AdminPostController@list_open');
    Route::get('admin/post/list_wait', 'AdminPostController@list_wait');
    Route::get('admin/post/list_trash', 'AdminPostController@list_trash');
    Route::get('admin/post/add', 'AdminPostController@add')->middleware('can:add_post');
    Route::post('admin/post/store', 'AdminPostController@store');
    Route::get('admin/post/edit/{id}', 'AdminPostController@edit')->name('post.edit')->middleware('can:edit_post');
    Route::post('admin/post/update/{id}', 'AdminPostController@update')->name('post.update');
    Route::get('admin/post/delete/{id}', 'AdminPostController@delete')->name('post.delete');
    Route::get('admin/post/action', 'AdminPostController@action');
    Route::get('admin/post/forcedelete/{id}', 'AdminPostController@forcedelete')->name('post.forcedelete');
    
    Route::get('admin/post/cat', 'AdminPostCatController@list')->middleware('can:list_cat_post');
    Route::post('admin/post/cat/add', 'AdminPostCatController@add');
    Route::get('admin/post/cat/edit/{id}', 'AdminPostCatController@edit')->name('post_cat.edit')->middleware('can:edit_cat_post');
    Route::post('admin/post/cat/update/{id}', 'AdminPostCatController@update')->name('admin.post.cat.update');
    Route::get('admin/post/cat/delete/{id}', 'AdminPostCatController@delete')->name('post_cat.delete');

    Route::get('admin/product/cat', 'AdminProductCatController@list')->middleware('can:list_cat_product');
    Route::get('admin/product/list', 'AdminProductController@list')->middleware('can:list_product');
    Route::get('admin/product/add', 'AdminProductController@add')->middleware('can:add_product');
    Route::post('admin/product/selectCat', 'AdminProductController@selectCat');
    Route::post('admin/product/cat/add', 'AdminProductCatController@add');
    Route::get('admin/product/cat/edit/{id}', 'AdminProductCatController@edit')->name('product_cat.edit');
    Route::post('admin/product/cat/update/{id}', 'AdminProductCatController@update')->name('admin.product.cat.update');
    Route::get('admin/product/cat/delete/{id}', 'AdminProductCatController@delete')->name('product_cat.delete');

    Route::post('admin/product/store', 'AdminProductController@store');
    Route::get('admin/product/edit/{id}', 'AdminProductController@edit')->name('product.edit')->middleware('can:edit_product');
    Route::get('admin/product/delete/{id}', 'AdminProductController@delete')->name('product.delete')->middleware('can:delete_product');
    Route::get('admin/product/forcedelete/{id}', 'AdminProductController@forcedelete')->name('product.forcedelete');
    Route::post('admin/product/update/{id}', 'AdminProductController@update')->name('product.update');
    Route::get('admin/product/delete/{id}', 'AdminProductController@delete')->name('product.delete');
    Route::get('admin/product/list_still', 'AdminProductController@list_still');
    Route::get('admin/product/list_wait', 'AdminProductController@list_wait')->name('product.list_wait');
    Route::get('admin/product/list_trash', 'AdminProductController@list_trash');
    Route::get('admin/product/action', 'AdminProductController@action');
        
    Route::get('admin/product/list_color', 'AdminProductController@list_color')->middleware('can:list_color');
    Route::post('admin/product/add_color', 'AdminProductController@add_color');
    Route::get('admin/product/delete_color/{id}', 'AdminProductController@delete_color')->name('delete.color');

    Route::get('admin/product/list_image', 'AdminProductController@list_image');
    Route::get('admin/product/add_img/{id}', 'AdminProductController@add_img')->name('product.add_img')->middleware('can:add_img');
    Route::post('admin/product/update_img/{id}', 'AdminProductController@update_img')->name('product.update_img');
    Route::get('admin/product/delete_img/{id}/{id_img}', 'AdminProductController@delete_img')->name('product.delete_img');

    Route::get('admin/order/list', 'AdminOrderController@list')->middleware('can:list_order');
    Route::get('admin/order/list_complete', 'AdminOrderController@list_complete');
    Route::get('admin/order/list_move', 'AdminOrderController@list_move');
    Route::get('admin/order/list_processing', 'AdminOrderController@list_processing');
    Route::get('admin/order/list_cancel', 'AdminOrderController@list_cancel');
    Route::get('admin/order/list_trash', 'AdminOrderController@list_trash');
    //Route::get('admin/order/search_order', 'AdminOrderController@search_order');
    Route::get('admin/order/delete/{id}', 'AdminOrderController@delete')->name('order.delete');
    Route::get('admin/order/forcedelete/{id}', 'AdminOrderController@forcedelete')->name('order.forcedelete');
    Route::get('admin/order/action', 'AdminOrderController@action');
    Route::get('admin/order/detail/{id}', 'AdminOrderController@detail')->name('order.detail')->middleware('can:detail_order');
    Route::post('admin/order/update_status/{id}', 'AdminOrderController@update_status')->name('order.update_status');

    Route::get('admin/slider/list', 'AdminSliderController@list')->middleware('can:list_slider');
    Route::get('admin/slider/up/{id}', 'AdminSliderController@up')->name('slider.up')->middleware('can:change_localtion');
    Route::get('admin/slider/change_status/{id}', 'AdminSliderController@change_status')->name('slider.change_status')->middleware('can:change_status');
    Route::post('admin/slider/add', 'AdminSliderController@add')->name('admin.slider');
    Route::get('admin/slider/delete/{id}', 'AdminSliderController@forcedelete')->name('slider.delete');

    Route::get('admin/role/list', 'AdminRoleController@list')->middleware('can:list_role');
    Route::get('admin/role/add', 'AdminRoleController@add')->middleware('can:add_role');
    Route::post('admin/role/store', 'AdminRoleController@store')->name('role.store');
    Route::get('admin/role/edit/{id}', 'AdminRoleController@edit')->name('role.edit')->middleware('can:edit_role');
    Route::post('admin/role/update/{id}', 'AdminRoleController@update')->name('role.update');
    Route::get('admin/role/delete/{id}', 'AdminRoleController@delete')->name('role.delete');

});
//Route::get('{slugIntroduce}', 'HomeController@introduce')->name('introduce');
Route::get('{slugpage}', 'HomeController@pages')->name('pages');

Route::get('tin-tuc/{slugpost}.html', 'PostController@showDetail')->name('post.detail');

Route::get('show/cart', 'CartController@show')->name('cart.show');
Route::post('add/cart', 'CartController@add')->name('cart.add');
Route::get('saveAjax/cart', 'CartController@saveAjax');
Route::get('remove/cart/{id}', 'CartController@remove')->name('cart.remove');
Route::get('cart/destroy','CartController@destroy')->name('cart.destroy');
Route::post('cart/udate','CartController@update')->name('cart.update');
Route::post('cart/location','OrderController@locationAjax')->name('locationAjax');
Route::post('OrderSuccess','OrderController@OrderSuccess')->name('OrderSuccess');
Route::get('dat-hang-thanh-cong/{id}','OrderController@OrderSuccess1')->name('order.success');