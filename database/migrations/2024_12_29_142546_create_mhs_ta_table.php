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
        Schema::create('mhs_ta', function (Blueprint $table) {
            $table->id('id_ta');
            $table->unsignedBigInteger('mahasiswa_id');
            $table->string('proposal_final')->nullable();
            $table->string('laporan_ta')->nullable();
            $table->string('tugas_akhir')->nullable();

            $table->enum('acc_pembimbing1', ['0', '1'])->default('0')->comment('0: Belum DiACC, 1: DiACC');
            $table->enum('acc_pembimbing2', ['0', '1'])->default('0')->comment('0: Belum DiACC, 1: DiCC');

            $table->date('tanggal_sidang')->nullable();
            $table->unsignedBigInteger('ruangan_id')->nullable();
            $table->unsignedBigInteger('sesi_id')->nullable();
            $table->unsignedBigInteger('ketua_sidang')->nullable();
            $table->unsignedBigInteger('penguji1_id')->nullable();
            $table->unsignedBigInteger('penguji2_id')->nullable();
            $table->unsignedBigInteger('penguji3_id')->nullable();
            $table->string('surat_tugas')->nullable();

            $table->string('nilai_mahasiswa')->nullable();
            $table->enum('verif_berkas', ['0', '1'])->default('0')->comment('0: Belum, 1: Sudah')->nullable();
            $table->enum('keterangan', ['0', '1'])->default('0')->comment('0: Tidak Lulus Sidang, 1: Lulus Sidang');

            $table->foreign('mahasiswa_id')
            ->references('id_mahasiswa')
            ->on('mahasiswa')
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('ruangan_id')
                ->references('id_ruangan')
                ->on('ruangan')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('sesi_id')
                ->references('id_sesi')
                ->on('sesi')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('penguji1_id')
                ->references('id_dosen')
                ->on('dosen')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('penguji2_id')
                ->references('id_dosen')
                ->on('dosen')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('penguji3_id')
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
        Schema::dropIfExists('mhs_ta');
    }
};
