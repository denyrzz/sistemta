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
        Schema::create('nilai_sidang_ta', function (Blueprint $table) {
            $table->id('id_nilai_sidang');
            $table->unsignedBigInteger('ta_id');
            $table->unsignedBigInteger('dosen_id');
            $table->string('pendahuluan')->nullable();
            $table->string('pustaka')->nullable();
            $table->string('penelitian')->nullable();
            $table->string('bahasa')->nullable();
            $table->string('presentasi')->nullable();
            $table->string('nilai_sidang')->nullable();
            $table->enum('status', ['0', '1', '2', '3', '4'])->nullable();

            $table->foreign('ta_id')
                ->references('id_ta')
                ->on('mhs_ta')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('dosen_id')
                ->references('id_dosen')
                ->on('dosen')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai_sidang_ta');
    }
};
