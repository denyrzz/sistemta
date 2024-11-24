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
        Schema::create('usulan_pkl', function (Blueprint $table) {
            $table->bigIncrements('id_usulan_pkl');  // Use bigIncrements to auto-increment the primary key
            $table->unsignedBigInteger('mahasiswa_id');  // Unsigned to match foreign key
            $table->unsignedBigInteger('tempat_id'); // Unsigned to match foreign key
            $table->enum('konfirmasi', ['0', '1'])->default('0')->comment('0: Belum, 1: Sudah');

            // Foreign Key Constraints
            $table->foreign('mahasiswa_id')
                ->references('id_mahasiswa')
                ->on('mahasiswa')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('tempat_id')
                ->references('id_tempat')
                ->on('tempat_pkl')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usulan_pkl');
    }
};
