<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dosen;
use Illuminate\Support\Facades\DB;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                "nama_dosen" => "ALDE ALANDA, S.Kom, M.T",
                "nidn" => "0025088802",
                "nip" => "198808252015041002",
                "jenis_kelamin" => "Laki-laki",
                "kode_jurusan" => "TI",
                "jurusan" => "Teknologi Informasi",
                "kode_prodi" => "3TK",
                "prodi" => "Teknik Komputer D-3",
                "email" => "alde@pnp.ac.id",
                "status" => "1",
            ],
            [
                "nama_dosen" => "ALDO ERIANDA, M.T, S.ST",
                "nidn" => "003078904",
                "nip" => "198907032019031015",
                "jenis_kelamin" => "Laki-laki",
                "kode_jurusan" => "TI",
                "jurusan" => "Teknologi Informasi",
                "kode_prodi" => "3MI",
                "prodi" => "Manajemen Informatika D-3",
                "email" => "aldo@pnp.ac.id",
                "status" => "1",
            ],
            [
                "nama_dosen" => "CIPTO PRABOWO, S.T, M.T",
                "nidn" => "0002037410",
                "nip" => "197403022008121001",
                "jenis_kelamin" => "Laki-laki",
                "kode_jurusan" => "TI",
                "jurusan" => "Teknologi Informasi",
                "kode_prodi" => "3TK",
                "prodi" => "Teknik Komputer D-3",
                "email" => "cipto@pnp.ac.id",
                "status" => "1",
            ],
            [
                "nama_dosen" => "DEDDY PRAYAMA, S.Kom, M.ISD",
                "nidn" => "0015048105",
                "nip" => "198104152006041002",
                "jenis_kelamin" => "Laki-laki",
                "kode_jurusan" => "TI",
                "jurusan" => "Teknologi Informasi",
                "kode_prodi" => "3TK",
                "prodi" => "Teknik Komputer D-3",
                "email" => "deddy@pnp.ac.id",
                "status" => "1",
            ],
        ];

        foreach ($data as $key => $value) {
            // Check if jurusan exists
            $jurusan = DB::table('jurusan')->where('kode_jurusan', $value['kode_jurusan'])->select('id_jurusan')->first();
            if (!$jurusan) {
                // Skip to the next iteration if jurusan is not found
                continue;
            }

            // Check if prodi exists
            $prodi = DB::table('prodi')->where('kode_prodi', $value['kode_prodi'])->select('id_prodi')->first();
            if (!$prodi) {
                // Skip to the next iteration if prodi is not found
                continue;
            }

            // Create new Dosen record
            $dosen = new Dosen;
            $dosen->id_dosen = array_search($value, $data) + 1;
            $dosen->nama_dosen = $value['nama_dosen'];
            $dosen->nidn = $value['nidn'];
            $dosen->nip = $value['nip'];
            $dosen->jenis_kelamin = $value['jenis_kelamin'];
            $dosen->id_jurusan = $jurusan->id_jurusan;
            $dosen->id_prodi = $prodi->id_prodi;
            $dosen->email = $value['email'];
            $dosen->status = $value['status'];
            $dosen->save();
        }
    }
}
