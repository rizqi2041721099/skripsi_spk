<?php

namespace App\Policies;

use App\Models\KriteriaHarga;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class KriteriaHargaPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user, KriteriaHarga $kriteriaHarga)
    {
        //
    }

    public function create(User $user)
    {
        //
    }

    public function update(User $user, KriteriaHarga $kriteriaHarga)
    {
        //
    }

    public function delete(User $user, KriteriaHarga $kriteriaHarga)
    {
        //
    }

    public function restore(User $user, KriteriaHarga $kriteriaHarga)
    {
        //
    }

    public function forceDelete(User $user, KriteriaHarga $kriteriaHarga)
    {
        //
    }
}
