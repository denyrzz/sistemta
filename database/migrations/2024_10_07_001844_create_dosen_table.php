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
        Schema::create('dosen', function (Blueprint $table) {
            $table->id('id_dosen'); // Primary Key
            $table->string('nama_dosen');
            $table->string('nidn')->unique(); // Unique, not Primary Key
            $table->string('nip')->unique();
            $table->string('jenis_kelamin');
            $table->unsignedBigInteger('id_jurusan');
            $table->unsignedBigInteger('id_prodi');
            $table->string('email')->unique();
            $table->string('image')->nullable();
            $table->string('status')->nullable();

            // Foreign keys
            $table->foreign('id_prodi')->references('id_prodi')->on('prodi')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_jurusan')->references('id_jurusan')->on('jurusan')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dosen');
    }
};
