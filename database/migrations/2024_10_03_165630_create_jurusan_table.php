<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jurusan', function (Blueprint $table) {
            $table->id('id_jurusan'); // Menggunakan auto-increment
            $table->string('kode_jurusan');
            $table->string('jurusan');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jurusan');
    }
};