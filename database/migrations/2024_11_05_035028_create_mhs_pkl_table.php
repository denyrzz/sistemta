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
        Schema::create('mhs_pkl', function (Blueprint $table) {
            $table->id('id_pkl');
            $table->unsignedBigInteger('mahasiswa_id');
            $table->unsignedBigInteger('tempat_id')->nullable();
            $table->unsignedBigInteger('ruangan_id')->nullable();
            $table->unsignedBigInteger('sesi_id')->nullable();
            $table->year('tahun_pkl')->nullable();
            $table->unsignedBigInteger('dosen_pembimbing')->nullable();
            $table->unsignedBigInteger('dosen_penguji')->nullable();
            $table->string('pembimbing_industri')->nullable();
            $table->double('nilai_pembimbing_industri')->nullable();
            $table->string('dokument_nilai_industri')->nullable();
            $table->text('judul')->nullable();
            $table->string('dokument_pkl')->nullable();
            $table->string('dokument_pkl_revisi')->nullable();
            $table->date('tanggal_sidang')->nullable();
            $table->enum('verif_berkas', ['0', '1'])->default('0')->comment('0: Belum, 1: Sudah')->nullable();


            $table->foreign('mahasiswa_id')->references('id_mahasiswa')->on('mahasiswa')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('tempat_id')->references('id_tempat')->on('tempat_pkl')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('sesi_id')->references('id_sesi')->on('sesi')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('ruangan_id')->references('id_ruangan')->on('ruangan')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('dosen_pembimbing')->references('id_dosen')->on('dosen')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('dosen_penguji')->references('id_dosen')->on('dosen')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mhs_pkl');
    }
};
