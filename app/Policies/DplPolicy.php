<?php

namespace App\Policies;

use App\Models\Dpl;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;

class DplPolicy
{
    public function viewDataDpl(User $user): bool
    {
        if ($user->role !== 'admin') {
            throw new AuthorizationException('Anda tidak memiliki hak akses untuk melihat halaman ini.');
        }
        return true;
    }

    public function viewDetailDataDpl(User $user): bool
    {
        if ($user->role !== 'admin') {
            throw new AuthorizationException('Anda tidak memiliki hak akses untuk melihat halaman ini.');
        }
        return true;
    }

    public function updateDataDpl(User $user): bool
    {
        if ($user->role !== 'admin') {
            throw new AuthorizationException('Anda tidak memiliki hak akses untuk mengupdate data.');
        }
        return true;
    }

    public function deleteDataDpl(User $user): bool
    {
        if ($user->role !== 'admin') {
            throw new AuthorizationException('Anda tidak memiliki hak akses untuk menghapus data.');
        }
        return true;
    }

    public function searchDataDpl(User $user): bool
    {
        if ($user->role !== 'admin') {
            throw new AuthorizationException('Anda tidak memiliki hak akses untuk mencari data.');
        }
        return true;
    }

    public function downloadDataDpl(User $user): bool
    {
        if ($user->role !== 'admin') {
            throw new AuthorizationException('Anda tidak memiliki hak akses untuk mendownload data.');
        }
        return true;
    }
}
