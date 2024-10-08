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
            $table->id('id_mhs');
            $table->string('nim')->unique();
            $table->string('nama');
            $table->unsignedBigInteger('prodi_id');
            $table->string('jekel');
            $table->string('image')->nullable();
            $table->timestamps();
        });

        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->foreign('prodi_id')->references('id_prodi')->on('prodi')
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
