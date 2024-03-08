<?php

namespace App\Policies;

use App\Models\PriceFood;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PriceFoodPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user, PriceFood $priceFood)
    {
        //
    }

    public function create(User $user)
    {
        //
    }

    public function update(User $user, PriceFood $priceFood)
    {
        //
    }

    public function delete(User $user, PriceFood $priceFood)
    {
        //
    }

    public function restore(User $user, PriceFood $priceFood)
    {
        //
    }

    public function forceDelete(User $user, PriceFood $priceFood)
    {
        //
    }
}
