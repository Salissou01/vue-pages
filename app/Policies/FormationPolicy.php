<?php

namespace App\Policies;

use App\Models\formation;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FormationPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, formation $formation)
    {
        return $user->id=== $formation->user_id;
    }
}
