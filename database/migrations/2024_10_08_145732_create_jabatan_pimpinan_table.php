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
        Schema::create('jabatan_pimpinan', function (Blueprint $table) {
            $table->bigIncrements('id_jabatan');
            $table->string('jabatan_pimpinan');
            $table->string('kode_jabatan');
            $table->enum('status_jabatan', ['0', '1'])->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
