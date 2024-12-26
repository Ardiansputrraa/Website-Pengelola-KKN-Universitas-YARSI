<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogbookTable extends Migration
{
    public function up()
    {
        Schema::create('logbook', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id')->constrained('mahasiswa');
            $table->foreignId('kelompok_kkn_id')->constrained('kelompok_kkn');
            $table->date('tanggal');
            $table->string('jam');
            $table->string('kegiatan');
            $table->string('tempat');
            $table->string('file_foto')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('logbook');
    }
}

