<?php

namespace App\Policies;

use App\Models\KriteriaVariasiMenu;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class KriteriaVariasiMenuPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user, KriteriaVariasiMenu $kriteriaVariasiMenu)
    {
        //
    }

    public function create(User $user)
    {
        //
    }

    public function update(User $user, KriteriaVariasiMenu $kriteriaVariasiMenu)
    {
        //
    }

    public function delete(User $user, KriteriaVariasiMenu $kriteriaVariasiMenu)
    {
        //
    }

    public function restore(User $user, KriteriaVariasiMenu $kriteriaVariasiMenu)
    {
        //
    }

    public function forceDelete(User $user, KriteriaVariasiMenu $kriteriaVariasiMenu)
    {
        //
    }
}
