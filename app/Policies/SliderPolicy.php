<?php

namespace App\Policies;

use App\Model\SliderModel;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SliderPolicy
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
     * @param  \App\Model\SliderModel  $slider
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->checkPermissionAccess(config('permission.access.list_slider'));
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function change_localtion(User $user)
    {
        return $user->checkPermissionAccess(config('permission.access.change_localtion'));
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Model\SliderModel  $slider
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->checkPermissionAccess(config('permission.access.add_slider'));
    }

/**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Model\SliderModel  $slider
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->checkPermissionAccess(config('permission.access.edit_slider'));
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Model\SliderModel  $slider
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->checkPermissionAccess(config('permission.access.delete_slider'));
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Model\SliderModel  $slider
     * @return mixed
     */
    public function restore(User $user, SliderModel $slider)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Model\SliderModel  $slider
     * @return mixed
     */
    public function forceDelete(User $user, SliderModel $slider)
    {
        //
    }
}
