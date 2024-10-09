<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataProdi = [

    [
        "id_prodi" => "7",
        "kode_prodi" => "EC",
        "prodi" => "Teknik Elektronika",
        "id_jurusan" => "4",
        "jenjang" => "D4",
    ],
    [
        "id_prodi" => "18",
        "kode_prodi" => "MI",
        "prodi" => "Manajemen Informatika",
        "id_jurusan" => "7",
        "jenjang" => "D3",
    ],
    [
        "id_prodi" => "19",
        "kode_prodi" => "TK",
        "prodi" => "Teknik Komputer",
        "id_jurusan" => "7",
        "jenjang" => "D3",
    ],
    [
        "id_prodi" => "20",
        "kode_prodi" => "TRPL",
        "prodi" => "Teknologi Rekayasa Perangkat Lunak",
        "id_jurusan" => "7",
        "jenjang" => "D4",
    ],
    [
        "id_prodi" => "21",
        "kode_prodi" => "SI-TD",
        "prodi" => "SISTEM INFORMASI (TANAH DATAR)",
        "id_jurusan" => "7",
        "jenjang" => "D3",
    ],
    [
        "id_prodi" => "22",
        "kode_prodi" => "TK-SS",
        "prodi" => "Teknik Komputer (Solok Selatan)",
        "id_jurusan" => "7",
        "jenjang" => "D3",
    ],
    [
        "id_prodi" => "23",
        "kode_prodi" => "MI-P",
        "prodi" => "Manajemen Informatika (Pelalawan)",
        "id_jurusan" => "7",
        "jenjang" => "D3",
    ],
];

DB::table('prodi')->insert($dataProdi);

    }
}
