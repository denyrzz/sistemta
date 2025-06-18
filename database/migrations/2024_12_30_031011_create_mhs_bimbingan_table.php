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
        Schema::create('mhs_bimbingan', function (Blueprint $table) {
                $table->id('id_bimbingan');
                $table->unsignedBigInteger('sempro_id');
                $table->date('tanggal');
                $table->text('kegiatan')->nullable();
                $table->string('dokumentasi')->nullable();
                $table->text('komentar')->nullable();;
                $table->enum('validasi', ['0', '1'])->default('0');

                $table->foreign('sempro_id')->references('id_sempro')->on('mhs_sempro')
                ->onDelete('cascade')->onUpdate('cascade');
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bimbingan_ta');
    }
};
