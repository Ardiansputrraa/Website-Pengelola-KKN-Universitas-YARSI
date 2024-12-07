<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMahasiswaTable  extends Migration
{
    public function up()
    {
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('foto');
            $table->string('nama_lengkap')->nullable();
            $table->string('npm')->unique()->nullable();
            $table->string('fakultas')->nullable();
            $table->string('prodi')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('nomer_whatsapp')->nullable();
            $table->enum('status', ['belum terdaftar', 'diproses', 'terdaftar']);
            $table->string('file_ktm')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mahasiswa');
    }
};
