<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            ],
        ];
        foreach ($data as $key => $value) {
            $id_jurusan = DB::table('jurusan')->where('kode_jurusan', $value['kode_jurusan'])->select('id_jurusan')->first()->id_jurusan;
            $id_prodi = DB::table('prodi')->where('kode_prodi', $value['kode_prodi'])->select('id_prodi')->first()->id_prodi;
            $dosen = new Dosen;
            $dosen->id_dosen = array_search($value, $data) + 1;
            $dosen->nama_dosen = $value['nama_dosen'];
            $dosen->nidn = $value['nidn'];
            $dosen->nip = $value['nip'];
            $dosen->jenis_kelamin = $value['jenis_kelamin'];
            $dosen->id_jurusan = $id_jurusan;
            $dosen->id_prodi = $id_prodi;
            $dosen->email = $value['email'];
            $dosen->save();
        }
    }
}
