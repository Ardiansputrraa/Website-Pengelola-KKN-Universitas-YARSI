<?php

namespace App\Policies;

use App\Models\User;

class ProfilePolicy
{
    /**
     * Create a new policy instance.
     */
    public function viewProfile(User $user, User $profile): bool
    {
        return $user->id === $profile->id;
    }
}
