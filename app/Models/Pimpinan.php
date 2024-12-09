<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pimpinan extends Model
{
    use HasFactory;

    protected $table = 'pimpinan';
    protected $primaryKey = 'id_jabatan';

    public $timestamps = false;

    protected $fillable = [
        'dosen_id',
        'jabatan_id',
        'periode',
        'status_pimpinan',
    ];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_id', 'id_dosen');
    }

    public function jabatanPimpinan()
    {
        return $this->belongsTo(JabatanPimpinan::class, 'jabatan_id', 'id_jabatan'); // Adjusted to match the correct column name in your migration
    }
}
