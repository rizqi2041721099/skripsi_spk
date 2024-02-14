<?php

namespace App\Policies;

use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RestaurantPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user, Restaurant $restaurant)
    {
        //
    }

    public function create(User $user)
    {
        //
    }

    public function update(User $user, Restaurant $restaurant)
    {
        //
    }

    public function delete(User $user, Restaurant $restaurant)
    {
        //
    }

    public function restore(User $user, Restaurant $restaurant)
    {
        //
    }

    public function forceDelete(User $user, Restaurant $restaurant)
    {
        //
    }
}
