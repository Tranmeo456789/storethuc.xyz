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

Auth::routes(['register' => false]);
//Route::get('/', 'HomeController@index')->name('home');
//Route::get('dashboard', 'DashboardController@show')->middleware('auth');

include_once 'routes/shopBackEnd.php';
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::get('/getInfo-facebook/{social}','SocialController@getInfo');
Route::get('/check-info-facebook/{social}','SocialController@checkInfo');

Route::get('san-pham-{slug}', 'ProductController@list_product')->name('cat0.product');
// Route::get('san-pham/{slugproduct}', 'ProductController@show_detail')->name('product.detail');
Route::get('san-pham/{slug1}.html', 'ProductController@list_product1')->name('cat1.product');

Route::get('searchProduct', 'ProductController@searchProductAjax')->name('searchProductAjax');
Route::post('cart/updateCartAjax', 'CartController@updateCartAjax')->name('updateCartAjax');
Route::get('san-pham', 'ProductController@all_product');
Route::get('chi-tiet-san-pham/{slug}', 'ProductController@detail')->name('frontend.product.detail');
Route::get('tim-kiem', 'ProductController@list_search');
Route::get('thanh-toan', 'OrderController@checkout');
Route::get('mua-ngay-san-pham/{id}', 'OrderController@buynow')->name('order.buynow');
Route::get('tra-cuu-thong-tin-don-hang', 'OrderController@viewSearchPhoneOrder')->name('order.view_search_phone_order');
Route::post('kiem-tra-thong-tin-so-dien-thoai', 'OrderController@searchPhoneOrder')->name('order.search.phone_order');

Route::get('loc-don-hang-ajax/theo-trang-thai', 'OrderController@ajaxFliter')->name('order.ajaxFliter');

Route::get('xem-don-hang-chi-tiet-ajax/theo-so-dien-thoai', 'OrderController@detail')->name('order.detail');

Route::middleware('auth')->group(function(){
    Route::get('dashboard', 'DashboardController@show');
    Route::get('admin', 'DashboardController@show')->name('backend.dashboard');
        
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

    Route::get('admin/product/list_image', 'AdminProductController@list_image');
    Route::get('admin/product/add_img/{id}', 'AdminProductController@add_img')->name('product.add_img')->middleware('can:add_img');
    Route::post('admin/product/update_img/{id}', 'AdminProductController@update_img')->name('product.update_img');
    Route::get('admin/product/delete_img/{id}/{id_img}', 'AdminProductController@delete_img')->name('product.delete_img');

    Route::get('backend/danh-sach-quyen', 'RoleController@list')->name('backend.role.list')->middleware('can:list_role');
    Route::get('backend/them-quyen', 'RoleController@add')->name('backend.role.add')->middleware('can:add_role');
    Route::post('backend/luu-quyen', 'RoleController@store')->name('backend.role.store');
    Route::get('backend/sua-quyen/{id}', 'RoleController@edit')->name('backend.role.edit')->middleware('can:edit_role');
    Route::post('backend/cap-nhat-quyen/{id}', 'RoleController@update')->name('backend.role.update');
    Route::get('backend/xoa-quyen/{id}', 'RoleController@delete')->name('backend.role.delete');

});

Route::get('{slugpage}.html', 'HomeController@pages')->name('pages');
Route::get('tin-tuc', 'PostController@list')->name('posts');

Route::get('tin-tuc/{slug}.html', 'PostController@detail')->name('post.detail');

Route::get('show/cart', 'CartController@show')->name('cart.show');
Route::post('add/cart', 'CartController@add')->name('cart.add');
Route::get('saveAjax/cart', 'CartController@saveAjax')->name('cart.saveAjax');
Route::get('remove/cart/{id}', 'CartController@remove')->name('cart.remove');
Route::get('cart/destroy','CartController@destroy')->name('cart.destroy');
Route::post('cart/udate','CartController@update')->name('cart.update');
Route::post('cart/location','OrderController@locationAjax')->name('locationAjax');
Route::post('OrderSuccess','OrderController@OrderSuccess')->name('OrderSuccess');
Route::get('dat-hang-thanh-cong/{id}','OrderController@viewOrderSuccess')->name('order.success');