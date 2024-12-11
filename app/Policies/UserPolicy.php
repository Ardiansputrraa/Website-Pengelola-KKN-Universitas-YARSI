<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;


class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function viewRegister(User $user): bool
    {
        if ($user->role !== 'admin') {
            throw new AuthorizationException('Anda tidak memiliki hak akses untuk melihat halaman ini.');
        }
        return true;
    }

    public function createAccount(User $user): bool
    {

        if ($user->role !== 'admin') {
            throw new AuthorizationException('Anda tidak memiliki hak akses untuk membuat akun.');
        }
        return true;
    }
}
