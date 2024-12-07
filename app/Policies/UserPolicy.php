<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function viewRegister(User $user): bool
    {
        return $user->role === 'admin';
    }

    public function createAccount(User $user): bool
    {

        return $user->role === 'admin';
    }
}
