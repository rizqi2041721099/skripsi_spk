<?php

namespace App\Policies;

use App\Models\Kriteria;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class KriteriaPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user, Kriteria $kriteria)
    {
        //
    }

    public function create(User $user)
    {
        //
    }

    public function update(User $user, Kriteria $kriteria)
    {
        //
    }

    public function delete(User $user, Kriteria $kriteria)
    {
        //
    }

    public function restore(User $user, Kriteria $kriteria)
    {
        //
    }

    public function forceDelete(User $user, Kriteria $kriteria)
    {
        //
    }
}
