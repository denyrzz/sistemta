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
        "kode_prodi" => "4EC",
        "prodi" => "D4 - Teknik Elektronika",
        "id_jurusan" => "4",
        "jenjang" => "D4",
    ],
    [
        "id_prodi" => "18",
        "kode_prodi" => "3MI",
        "prodi" => "Manajemen Informatika D-3",
        "id_jurusan" => "7",
        "jenjang" => "D3",
    ],
    [
        "id_prodi" => "19",
        "kode_prodi" => "3TK",
        "prodi" => "Teknik Komputer D-3",
        "id_jurusan" => "7",
        "jenjang" => "D3",
    ],
    [
        "id_prodi" => "20",
        "kode_prodi" => "4TRPL",
        "prodi" => "Teknologi Rekayasa Perangkat Lunak",
        "id_jurusan" => "7",
        "jenjang" => "D4",
    ],
    [
        "id_prodi" => "21",
        "kode_prodi" => "3SI-TD",
        "prodi" => "D-3 SISTEM INFORMASI (TANAH DATAR)",
        "id_jurusan" => "7",
        "jenjang" => "D3",
    ],
    [
        "id_prodi" => "22",
        "kode_prodi" => "3TK-SS",
        "prodi" => "D-3 Teknik Komputer (Solok Selatan)",
        "id_jurusan" => "7",
        "jenjang" => "D3",
    ],
    [
        "id_prodi" => "23",
        "kode_prodi" => "3MI-P",
        "prodi" => "Manajemen Informatika (Pelalawan)",
        "id_jurusan" => "7",
        "jenjang" => "D3",
    ],
];

DB::table('prodi')->insert($dataProdi);

    }
}
