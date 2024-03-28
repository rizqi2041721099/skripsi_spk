<?php

namespace App\Policies;

use App\Models\KriteriaFasilitas;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class KriteriaFasilitasPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user, KriteriaFasilitas $kriteriaFasilitas)
    {
        //
    }

    public function create(User $user)
    {
        //
    }

    public function update(User $user, KriteriaFasilitas $kriteriaFasilitas)
    {
        //
    }

    public function delete(User $user, KriteriaFasilitas $kriteriaFasilitas)
    {
        //
    }

    public function restore(User $user, KriteriaFasilitas $kriteriaFasilitas)
    {
        //
    }

    public function forceDelete(User $user, KriteriaFasilitas $kriteriaFasilitas)
    {
        //
    }
}
