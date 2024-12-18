<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JabatanPimpinan extends Model
{
    use HasFactory;

    protected $table = 'jabatan_pimpinan';

    protected $primaryKey = 'id_jabatan';

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'jabatan_pimpinan',
        'kode_jabatan',
        'status_jabatan',
    ];
}
