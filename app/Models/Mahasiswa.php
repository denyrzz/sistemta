<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_mahasiswa',
        'nim',
        'nama',
        'prodi_id',
        'jenis_kelamin',
        'image',

    ];

    protected $table = 'mahasiswa';

}
