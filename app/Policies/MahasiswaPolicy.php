<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Auth\Access\AuthorizationException;

class MahasiswaPolicy
{

    public function viewDataMahasiswa(User $user): bool
    {
        if ($user->role !== 'admin') {
            throw new AuthorizationException('Anda tidak memiliki hak akses untuk melihat halaman ini.');
        }
        return true;
    }

    public function viewDetailDataMahasiswa(User $user): bool
    {
        if ($user->role !== 'admin') {
            throw new AuthorizationException('Anda tidak memiliki hak akses untuk melihat halaman ini.');
        }
        return true;
    }

    public function updateDataMahasiswa(User $user): bool
    {
        if ($user->role !== 'admin') {
            throw new AuthorizationException('Anda tidak memiliki hak akses untuk mengupdate data.');
        }
        return true;
    }

    public function deleteDataMahasiswa(User $user): bool
    {
        if ($user->role !== 'admin') {
            throw new AuthorizationException('Anda tidak memiliki hak akses untuk menghapus data.');
        }
        return true;
    }

    public function searchDataMahasiswa(User $user): bool
    {
        if ($user->role !== 'admin') {
            throw new AuthorizationException('Anda tidak memiliki hak akses untuk mencari data.');
        }
        return true;
    }

    public function downloadDataMahasiswa(User $user): bool
    {
        if ($user->role !== 'admin') {
            throw new AuthorizationException('Anda tidak memiliki hak akses untuk mendownload data.');
        }
        return true;
    }
}
