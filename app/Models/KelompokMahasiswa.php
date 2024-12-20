<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KelompokMahasiswa extends Model
{
    use HasFactory;
    protected $table = 'kelompok_mahasiswa';

    protected $fillable = [
        'kelompok_kkn_id',
        'mahasiswa_id',
    ];

    public function kelompokKkn()
    {
        return $this->hasMany(KelompokKKN::class, 'dpl_id', 'id');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id', 'id');
    }
}
