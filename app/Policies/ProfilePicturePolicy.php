<?php

namespace App\Policies;

use App\ProfilePicture;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProfilePicturePolicy
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
     * @param  \App\ProfilePicture  $profilePicture
     * @return mixed
     */
    public function view(User $user, ProfilePicture $profilePicture)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\ProfilePicture  $profilePicture
     * @return mixed
     */
    public function update(User $user, ProfilePicture $profilePicture)
    {
        $admin = false;
        foreach ($user->roles as $role) {
            if ($role->title === "Admin") {
                $admin = true;
            }
        }
        return ($user->id === $profilePicture->user->id) || $admin;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\ProfilePicture  $profilePicture
     * @return mixed
     */
    public function delete(User $user, ProfilePicture $profilePicture)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\ProfilePicture  $profilePicture
     * @return mixed
     */
    public function restore(User $user, ProfilePicture $profilePicture)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\ProfilePicture  $profilePicture
     * @return mixed
     */
    public function forceDelete(User $user, ProfilePicture $profilePicture)
    {
        //
    }
}
