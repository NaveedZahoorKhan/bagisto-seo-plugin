<?php

namespace Rastventure\SEO\Policies;

use \SEO\Models\Setting;
use Illuminate\Foundation\Auth\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SettingPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @return bool
     */
    public function before(User $user)
    {
        if (isset($user->role()->first()->name) && $user->role()->first()->name === "Administrator") {
            return true;
        }
    }

    /**
     * @param User $user
     * @return bool
     */
    public function index(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can edit the Setting.
     *
     * @param  User $user
     * @param  Setting $setting
     * @return mixed
     */
    public function edit(User $user, Setting $setting)
    {
        return false;
    }

    /**
     * Determine whether the user can update the Setting.
     *
     * @param User $user
     * @param  Setting $setting
     * @return mixed
     */
    public function update(User $user, Setting $setting)
    {
        return false;
    }

    /**
     * Determine whether the user can store the Setting.
     *
     * @param  User $user
     * @param  Setting $setting
     * @return mixed
     */
    public function store(User $user, Setting $setting)
    {
        return false;
    }

    /**
     * Determine whether the user can robotTxt the Setting.
     *
     * @param  User $user
     * @param  Setting $setting
     * @return mixed
     */
    public function robotTxt(User $user, Setting $setting)
    {
        return false;
    }

    /**
     * Determine whether the user can htaccess the Setting.
     *
     * @param  User $user
     * @param  Setting $setting
     * @return mixed
     */
    public function htaccess(User $user, Setting $setting)
    {
        return false;
    }

}
