<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->id('id_mahasiswa');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('nim')->unique();
            $table->string('nama');
            $table->unsignedBigInteger('prodi_id');
            $table->string('jenis_kelamin');
            $table->string('image')->nullable();
            $table->string('email')->unique(); // Add email
            $table->string('password'); // Add password
        });

        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->foreign('prodi_id')->references('id_prodi')->on('prodi')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->dropForeign(['prodi_id']);
        });

        Schema::dropIfExists('mahasiswa');
    }
};
