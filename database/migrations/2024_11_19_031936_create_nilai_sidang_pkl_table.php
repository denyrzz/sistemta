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
        Schema::create('nilai_sidang_pkl', function (Blueprint $table) {
            $table->id('id_nilai_pkl');
            $table->unsignedBigInteger('pkl_id');
            $table->double('bahasa')->nullable();
            $table->double('analisis')->nullable();
            $table->double('sikap')->nullable();
            $table->double('komunikasi')->nullable();
            $table->double('penyajian')->nullable();
            $table->double('penguasaan')->nullable();
            $table->double('nilai_sidang')->nullable();
            $table->enum('status', ['0', '1']);

            $table->foreign('pkl_id')->references('id_pkl')->on('mhs_pkl')
            ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai_sidang_pkl');
    }
};
