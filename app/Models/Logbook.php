<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Logbook extends Model
{
    use HasFactory;
    protected $table = 'logbook';

    protected $fillable = [
        'mahasiswa_id',
        'kelompok_kkn_id',
        'tanggal',
        'jam',
        'kegiatan',
        'tempat',
        'file_foto',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function kelompokKkn()
    {
        return $this->belongsTo(KelompokKkn::class);
    }
}
