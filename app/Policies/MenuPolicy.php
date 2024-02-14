<?php

namespace App\Policies;

use App\Models\Menu;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MenuPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user, Menu $menu)
    {
        //
    }

    public function create(User $user)
    {
        //
    }

    public function update(User $user, Menu $menu)
    {
        //
    }

    public function delete(User $user, Menu $menu)
    {
        //
    }

    public function restore(User $user, Menu $menu)
    {
        //
    }

    public function forceDelete(User $user, Menu $menu)
    {
        //
    }
}
