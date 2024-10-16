<?php

namespace App\Exports;

use App\Models\Mahasiswa;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class MahasiswaExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data_mahasiswa = DB::table('mahasiswa')
        ->select('*')
        ->orderBy('id_mhs')
        ->get();
    return $data_mahasiswa;
    }

    public function headings(): array
    {
        return [
            'id',
            'nim',
            'nama',
            'prodi',
            'jenis',
            'image',
            'created_at',
            'updated_at'
        ];
    }

}
