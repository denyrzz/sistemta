<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_mhs',
        'nim',
        'nama',
        'prodi_id',
        'jekel',
        'image',
        
        // Add any other attributes that you want to be mass assignable
    ];

    protected $table = 'mahasiswa';

}
