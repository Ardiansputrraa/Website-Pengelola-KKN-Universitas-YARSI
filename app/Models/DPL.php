<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DPL extends Model
{
    use HasFactory;
    protected $table = 'dpl';

    protected $fillable = [
        'user_id',
        'foto',
        'nama_lengkap',
        'nip',
        'gelar',
        'fakultas',
        'prodi',
        'nama_bank',
        'nomer_rekening',
        'email',
        'nomer_whatsapp',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kelompokKkn()
    {
        return $this->hasMany(KelompokKkn::class);
    }
}
