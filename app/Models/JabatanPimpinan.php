<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JabatanPimpinan extends Model
{
    use HasFactory;

    protected $table = 'jabatan_pimpinan';

    protected $primaryKey = 'id_jabatan_pimpinan';

    public $incrementing = false; // Since id is not auto-incrementing

    protected $fillable = [
        'jabatan_pimpinan',
        'kode_jabatan_pimpinan',
        'status_jabatan_pimpinan',
    ];
}
