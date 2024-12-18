<?php

namespace App\Imports;

use App\Models\Mahasiswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MahasiswaImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Mahasiswa([
            'id_mhs'      => $row['id'],
            'nim'         => $row['nim'],
            'nama'        => $row['nama'],
            'prodi_id'    => $row['prodi'],
            'jekel'       => $row['jenis'],
            'image'       => $row['image'] ?? 'default-image.png',
        ]);
    }
}
