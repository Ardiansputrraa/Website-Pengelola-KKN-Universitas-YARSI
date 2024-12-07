<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $table = 'mahasiswa';

    protected $fillable = [
        'user_id',
        'foto',
        'nama_lengkap',
        'npm',
        'fakultas',
        'prodi',
        'email',
        'nomer_whatsapp',
        'status',
        'file_ktm',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kelompokMahasiswa()
    {
        return $this->hasMany(KelompokMahasiswa::class);
    }

    public function logbook()
    {
        return $this->hasMany(Logbook::class);
    }
}
