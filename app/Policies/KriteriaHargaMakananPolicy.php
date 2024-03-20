<?php

namespace App\Policies;

use App\Models\KriteriaHargaMakanan;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class KriteriaHargaMakananPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user, KriteriaHargaMakanan $kriteriaHargaMakanan)
    {
        //
    }

    public function create(User $user)
    {
        //
    }

    public function update(User $user, KriteriaHargaMakanan $kriteriaHargaMakanan)
    {
        //
    }

    public function delete(User $user, KriteriaHargaMakanan $kriteriaHargaMakanan)
    {
        //
    }

    public function restore(User $user, KriteriaHargaMakanan $kriteriaHargaMakanan)
    {
        //
    }

    public function forceDelete(User $user, KriteriaHargaMakanan $kriteriaHargaMakanan)
    {
        //
    }
}
