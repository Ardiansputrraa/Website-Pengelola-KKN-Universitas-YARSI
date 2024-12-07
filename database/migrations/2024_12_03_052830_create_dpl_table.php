<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDplTable extends Migration
{
    public function up()
    {
        Schema::create('dpl', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('foto');
            $table->string('nama_lengkap')->nullable();
            $table->string('nip')->unique()->nullable();
            $table->string('gelar')->nullable();
            $table->string('fakultas')->nullable();
            $table->string('prodi')->nullable();
            $table->string('nama_bank')->nullable();
            $table->string('nomer_rekening')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('nomer_whatsapp')->nullable();
            $table->enum('status', ['belum terdaftar', 'terdaftar']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dpl');
    }
}