<?php

namespace App\Policies;

use App\Models\Alternatif;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AlternatifPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user, Alternatif $alternatif)
    {
        //
    }

    public function create(User $user)
    {
        //
    }

    public function update(User $user, Alternatif $alternatif)
    {
        //
    }

    public function delete(User $user, Alternatif $alternatif)
    {
        //
    }

    public function restore(User $user, Alternatif $alternatif)
    {
        //
    }

    public function forceDelete(User $user, Alternatif $alternatif)
    {
        //
    }
}
