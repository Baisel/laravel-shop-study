<?php

namespace App\Policies;

use App\Models\AdminUser;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminUserPolicy
{
    use HandlesAuthorization;

    /**
     * @param AdminUser $loginUser
     * @return mixed
     */
    public function viewAny(AdminUser $loginUser)
    {
        return $loginUser->is_owner;
    }

    /**
     * @param AdminUser $loginUser
     * @param AdminUser $taget
     * @return bool
     */
    public function view(AdminUser $loginUser, AdminUser $taget)
    {
        return $loginUser->is_owner || $loginUser->id == $taget->id;
    }

    /**
     * @param AdminUser $loginUser
     * @return mixed
     */
    public function create(AdminUser $loginUser)
    {
        return $loginUser->is_owner;
    }

    /**
     * @param AdminUser $loginUser
     * @param AdminUser $adminUser
     * @return bool
     */
    public function update(AdminUser $loginUser, AdminUser $taget)
    {
        return $loginUser->is_owner || $loginUser->id == $taget->id;
    }

    /**
     * @param AdminUser $loginUser
     * @param AdminUser $adminUser
     * @return bool
     */
    public function delete(AdminUser $loginUser, AdminUser $taget)
    {
        return $loginUser->is_owner || $loginUser->id != $taget->id;
    }

    public function change(AdminUser $loginUser, AdminUser $taget)
    {
        return $loginUser->id == $taget->id;
    }
}
