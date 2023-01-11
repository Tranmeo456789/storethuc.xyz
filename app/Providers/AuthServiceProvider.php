<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Gate::define('list_view',function($user){
        //     return $user->checkPermissionAccess(config('permission.access.list_view'));
        // });

        Gate::define('list_product','App\Policies\ProductPolicy@view');
        Gate::define('add_product','App\Policies\ProductPolicy@create');
        Gate::define('edit_product','App\Policies\ProductPolicy@update');
        Gate::define('delete_product','App\Policies\ProductPolicy@delete');
        Gate::define('add_img','App\Policies\ProductPolicy@add_img');
        Gate::define('delete_img','App\Policies\ProductPolicy@delete_img');

        Gate::define('list_cat_product','App\Policies\Product_catPolicy@view');
        Gate::define('add_cat_product','App\Policies\Product_catPolicy@create');
        Gate::define('edit_cat_product','App\Policies\Product_catPolicy@update');
        Gate::define('delete_cat_product','App\Policies\Product_catPolicy@delete');

        Gate::define('list_unit','App\Policies\UnitPolicy@view');
        Gate::define('add_unit','App\Policies\UnitPolicy@create');
        Gate::define('edit_unit','App\Policies\UnitPolicy@update');
        Gate::define('delete_unit','App\Policies\UnitPolicy@delete');

        Gate::define('list_color','App\Policies\ColorPolicy@view');
        Gate::define('add_color','App\Policies\ColorPolicy@create');
        Gate::define('edit_color','App\Policies\ColorPolicy@update');
        Gate::define('delete_color','App\Policies\ColorPolicy@delete');

        Gate::define('list_post','App\Policies\PostPolicy@view');
        Gate::define('add_post','App\Policies\PostPolicy@create');
        Gate::define('edit_post','App\Policies\PostPolicy@update');
        Gate::define('delete_post','App\Policies\PostPolicy@delete');

        Gate::define('list_cat_post','App\Policies\Post_catPolicy@view');
        Gate::define('edit_cat_post','App\Policies\Post_catPolicy@update');
        Gate::define('delete_cat_post','App\Policies\Post_catPolicy@delete');

        Gate::define('list_page','App\Policies\PagePolicy@view');
        Gate::define('add_page','App\Policies\PagePolicy@create');
        Gate::define('edit_page','App\Policies\PagePolicy@update');
        Gate::define('delete_page','App\Policies\PagePolicy@delete');

        Gate::define('list_user','App\Policies\UserPolicy@view');
        Gate::define('add_user','App\Policies\UserPolicy@create');
        Gate::define('edit_user','App\Policies\UserPolicy@update');
        Gate::define('delete_user','App\Policies\UserPolicy@delete');

        Gate::define('list_order','App\Policies\OrderPolicy@view');
        Gate::define('detail_order','App\Policies\OrderPolicy@detail');
        Gate::define('delete_order','App\Policies\OrderPolicy@delete');

        Gate::define('list_slider','App\Policies\SliderPolicy@view');
        Gate::define('change_localtion','App\Policies\SliderPolicy@change_localtion');
        Gate::define('change_status','App\Policies\SliderPolicy@change_status');
        Gate::define('delete_slider','App\Policies\SliderPolicy@delete');

        Gate::define('list_role','App\Policies\RolePolicy@view');
        Gate::define('add_role','App\Policies\RolePolicy@create');
        Gate::define('edit_role','App\Policies\RolePolicy@update');
        Gate::define('delete_role','App\Policies\RolePolicy@delete');


    }
}
