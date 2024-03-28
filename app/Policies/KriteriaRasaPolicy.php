<?php

namespace App\Policies;

use App\Models\KriteriaRasa;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class KriteriaRasaPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user, KriteriaRasa $kriteriaRasa)
    {
        //
    }

    public function create(User $user)
    {
        //
    }

    public function update(User $user, KriteriaRasa $kriteriaRasa)
    {
        //
    }

    public function delete(User $user, KriteriaRasa $kriteriaRasa)
    {
        //
    }

    public function restore(User $user, KriteriaRasa $kriteriaRasa)
    {
        //
    }

    public function forceDelete(User $user, KriteriaRasa $kriteriaRasa)
    {
        //
    }
}
