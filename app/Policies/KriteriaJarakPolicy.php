<?php

namespace App\Policies;

use App\Models\KriteriaJarak;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class KriteriaJarakPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user, KriteriaJarak $kriteriaJarak)
    {
        //
    }

    public function create(User $user)
    {
        //
    }

    public function update(User $user, KriteriaJarak $kriteriaJarak)
    {
        //
    }

    public function delete(User $user, KriteriaJarak $kriteriaJarak)
    {
        //
    }

    public function restore(User $user, KriteriaJarak $kriteriaJarak)
    {
        //
    }

    public function forceDelete(User $user, KriteriaJarak $kriteriaJarak)
    {
        //
    }
}
