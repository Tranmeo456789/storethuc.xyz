<?php

namespace App\Policies;

use App\Model\UnitModel;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UnitPolicy
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
     * @param  \App\Model\UnitModel  $unit
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->checkPermissionAccess(config('permission.access.list_unit'));
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->checkPermissionAccess(config('permission.access.add_unit'));
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Model\UnitModel  $unit
     * @return mixed
     */
    public function update(User $user)
    {
        return $user->checkPermissionAccess(config('permission.access.edit_unit'));
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Model\UnitModel  $unit
     * @return mixed
     */
    public function delete(User $user)
    {
        return $user->checkPermissionAccess(config('permission.access.delete_unit'));
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Model\UnitModel  $unit
     * @return mixed
     */
    public function restore(User $user, UnitModel $unit)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Model\UnitModel  $unit
     * @return mixed
     */
    public function forceDelete(User $user, UnitModel $unit)
    {
        //
    }
}
