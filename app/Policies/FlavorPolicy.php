<?php

namespace App\Policies;

use App\Models\Flavor;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FlavorPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user, Flavor $flavor)
    {
        //
    }

    public function create(User $user)
    {
        //
    }

    public function update(User $user, Flavor $flavor)
    {
        //
    }

    public function delete(User $user, Flavor $flavor)
    {
        //
    }

    public function restore(User $user, Flavor $flavor)
    {
        //
    }

    public function forceDelete(User $user, Flavor $flavor)
    {
        //
    }
}
