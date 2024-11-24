<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('nilai_bimbingan_pkl', function (Blueprint $table) {
            $table->id('id_nilai_bimbingan');
            $table->unsignedBigInteger('pkl_id');
            $table->double('keaktifan')->nullable();
            $table->double('komunikatif')->nullable();
            $table->double('problem_solving')->nullable();
            $table->double('nilai_bimbingan')->nullable();

            $table->foreign('pkl_id')->references('id_pkl')->on('mhs_pkl')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai_bimbingan_pkl');
    }
};
