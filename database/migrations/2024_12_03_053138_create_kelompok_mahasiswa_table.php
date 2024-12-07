<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKelompokMahasiswaTable extends Migration
{
    public function up()
    {
        Schema::create('kelompok_mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kelompok_kkn_id')->constrained('kelompok_kkn');
            $table->foreignId('mahasiswa_id')->constrained('mahasiswa');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kelompok_mahasiswa');
    }
}
