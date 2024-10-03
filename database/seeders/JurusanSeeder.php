<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JurusanSeeder extends Seeder
{
    public function run(): void
    {
        $dataJurusan = [
            [
                "kode_jurusan" => "AN",
                "jurusan" => "Administrasi Niaga",
            ],
            [
                "kode_jurusan" => "AK",
                "jurusan" => "Akuntansi",
            ],
            [
                "kode_jurusan" => "BI",
                "jurusan" => "Bahasa Inggris",
            ],
            [
                "kode_jurusan" => "EE",
                "jurusan" => "Teknik Elektro",
            ],
            [
                "kode_jurusan" => "ME",
                "jurusan" => "Teknik Mesin",
            ],
            [
                "kode_jurusan" => "SP",
                "jurusan" => "Teknik Sipil",
            ],
            [
                "kode_jurusan" => "TI",
                "jurusan" => "Teknologi Informasi",
            ],
        ];

        DB::table('jurusan')->insert($dataJurusan);
    }
}
