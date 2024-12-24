<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SumberDaya extends Model
{
    protected $table = 'sumber_daya';

    protected $fillable = [
        'path',
        'judul',
        'tipe_file',
        'size',
    ];
}
