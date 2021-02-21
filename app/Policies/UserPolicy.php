<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $loginuser
     * @param users $user
     * @return bool
     */
    public function update(User $loginUser, User $user)
    {
        return $loginUser->id == $user->id;
    }
}
