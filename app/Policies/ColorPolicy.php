<?php

namespace App\Policies;

use App\Model\ColorModel;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ColorPolicy
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
     * @param  \App\Model\ColorModel  $color
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->checkPermissionAccess(config('permission.access.list_color'));
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->checkPermissionAccess(config('permission.access.add_color'));
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Model\ColorModel  $color
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->checkPermissionAccess(config('permission.access.edit_color'));
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Model\ColorModel  $color
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->checkPermissionAccess(config('permission.access.delete_color'));
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Model\ColorModel  $color
     * @return mixed
     */
    public function restore(User $user, ColorModel $color)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Model\ColorModel  $color
     * @return mixed
     */
    public function forceDelete(User $user, ColorModel $color)
    {
        //
    }
}
