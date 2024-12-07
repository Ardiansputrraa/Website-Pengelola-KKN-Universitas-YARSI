<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Model
{
    use HasFactory;
    protected $table = 'admin';

    protected $fillable = [
        'user_id',
        'foto',
        'nama_lengkap',
        'email',
        'nomer_whatsapp',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
