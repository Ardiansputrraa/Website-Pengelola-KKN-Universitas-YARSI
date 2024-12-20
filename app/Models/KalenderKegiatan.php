<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KalenderKegiatan extends Model
{
    protected $table = 'kalender_kegiatan';

    protected $fillable = [
        'tanggal',
        'waktu',
        'kegiatan',
    ];
}
