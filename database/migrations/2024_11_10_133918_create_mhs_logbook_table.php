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
        Schema::create('mhs_logbook', function (Blueprint $table) {
            $table->id('id_logbook');
            $table->unsignedBigInteger('pkl_id');
            $table->date('tgl_awal');
            $table->date('tgl_akhir');
            $table->text('kegiatan')->nullable();
            $table->string('dokumentasi')->nullable();
            $table->text('komentar');
            $table->enum('validasi', ['0', '1'])->default('0');

            $table->foreign('pkl_id')->references('id_pkl')->on('mhs_pkl')
            ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mhs_logbook');
    }
};
