<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKelompokKknTable extends Migration
{
    public function up()
    {
        Schema::create('kelompok_kkn', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kelompok');
            $table->string('lokasi')->nullable();
            $table->foreignId('dpl_id')->constrained('dpl');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kelompok_kkn');
    }
}
