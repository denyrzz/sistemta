<?php

namespace App\Exports;

use App\Models\Dosen;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class DosenExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data_dosen = DB::table('dosen')
        ->select('*')
        ->orderBy('id_dosen')
        ->get();
    return $data_dosen;
    }

    public function headings(): array
    {
        return [
            'id',
            'nama',
            'nidn',
            'nip',
            'jenis',
            'jurusan',
            'prodi',
            'golongan',
            'email',
            'image',
            'status'
        ];
    }

}
