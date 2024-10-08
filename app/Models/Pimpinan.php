<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pimpinan extends Model
{
    use HasFactory;

    protected $table = 'pimpinan';

    protected $fillable = [
        'dosen_id',
        'jabatan_pimpinan_id',
        'periode',
        'status_pimpinan',
    ];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_id', 'id_dosen');
    }

    public function jabatanPimpinan()
    {
        return $this->belongsTo(JabatanPimpinan::class, 'jabatan_pimpinan_id', 'id_jabatan_pimpinan');
    }
}
