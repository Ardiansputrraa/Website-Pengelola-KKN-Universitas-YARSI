<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('password');
            $table->enum('role', ['mahasiswa', 'admin', 'dpl']);
            $table->timestamps();
        });
        
    }
    

    public function down()
    {
        Schema::dropIfExists('users');
    }
};
