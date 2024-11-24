<?php

namespace App\Imports;

use App\Models\Dosen;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DosenImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $status = isset($row['status']) && in_array((string)$row['status'], ['0', '1']) ? (string)$row['status'] : '0';
        $golongan = isset($row['golongan']) && in_array((string)$row['golongan'], ['1', '2', '3', '4']) ? (string)$row['golongan'] : '1';


        return new Dosen([
            'id_dosen'      => $row['id'],
            'nama_dosen'    => $row['nama'],
            'nidn'          => $row['nidn'],
            'nip'           => $row['nip'],
            'jenis_kelamin' => $row['jenis'],
            'jurusan_id'    => $row['jurusan'],
            'prodi_id'      => $row['prodi'],
            'golongan'      => $golongan,
            'email'         => $row['email'],
            'image'         => $row['image'] ?? 'default-image.png',
            'status'        => $status,
        ]);
    }
}
