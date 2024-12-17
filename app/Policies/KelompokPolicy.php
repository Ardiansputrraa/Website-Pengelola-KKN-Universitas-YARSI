<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;

class KelompokPolicy
{
    public function viewDataKelompok(User $user): bool
    {
        if ($user->role !== 'admin') {
            throw new AuthorizationException('Anda tidak memiliki hak akses untuk melihat halaman ini.');
        }
        return true;
    }

    public function viewCreateDataKelompok(User $user): bool
    {
        if ($user->role !== 'admin') {
            throw new AuthorizationException('Anda tidak memiliki hak akses untuk melihat halaman ini.');
        }
        return true;
    }

    public function viewDetailDataKelompok(User $user): bool
    {
        if ($user->role !== 'admin') {
            throw new AuthorizationException('Anda tidak memiliki hak akses untuk melihat halaman ini.');
        }
        return true;
    }

    public function updateDataKelompok(User $user): bool
    {
        if ($user->role !== 'admin') {
            throw new AuthorizationException('Anda tidak memiliki hak akses untuk mengupdate data.');
        }
        return true;
    }

    public function deleteDataKelompok(User $user): bool
    {
        if ($user->role !== 'admin') {
            throw new AuthorizationException('Anda tidak memiliki hak akses untuk menghapus data.');
        }
        return true;
    }

    public function searchDataKelompok(User $user): bool
    {
        if ($user->role !== 'admin') {
            throw new AuthorizationException('Anda tidak memiliki hak akses untuk mencari data.');
        }
        return true;
    }

    public function downloadDataKelompok(User $user): bool
    {
        if ($user->role !== 'admin') {
            throw new AuthorizationException('Anda tidak memiliki hak akses untuk mendownload data.');
        }
        return true;
    }
}
