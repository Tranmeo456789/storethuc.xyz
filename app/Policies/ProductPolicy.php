<?php

namespace App\Policies;

use App\Model\ProductModel;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Model\ProductModel  $product
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->checkPermissionAccess(config('permission.access.list_product'));
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->checkPermissionAccess(config('permission.access.add_product'));
    }
    public function add_img(User $user)
    {
        return $user->checkPermissionAccess(config('permission.access.add_img'));
    }
    public function delete_img(User $user)
    {
        return $user->checkPermissionAccess(config('permission.access.delete_img'));
    }
    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Model\ProductModel  $product
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->checkPermissionAccess(config('permission.access.edit_product'));
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Model\ProductModel  $product
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->checkPermissionAccess(config('permission.access.delete_product'));
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Model\ProductModel  $product
     * @return mixed
     */
    public function restore(User $user, ProductModel $product)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Model\ProductModel  $product
     * @return mixed
     */
    public function forceDelete(User $user, ProductModel $product)
    {
        //
    }
}
