<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KelompokKKN extends Model
{
    use HasFactory;
    protected $table = 'kelompok_kkn';

    protected $fillable = [
        'nama_kelompok',
        'lokasi',
        'dpl_id',
    ];

    public function dpl()
    {
        return $this->belongsTo(Dpl::class, 'dpl_id', 'id');
    }

    public function kelompokMahasiswa()
    {
        return $this->hasMany(KelompokMahasiswa::class, 'kelompok_kkn_id', 'id');
    }

    public function logbook()
    {
        return $this->hasMany(Logbook::class);
    }

    public function dokumen()
    {
        return $this->hasMany(Dokumen::class);
    }
}

