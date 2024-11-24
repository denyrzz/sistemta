<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsulanPkl extends Model
{
    use HasFactory;

    protected $table = 'usulan_pkl';
    protected $primaryKey = 'id_usulan_pkl';
    public $timestamps = false;

    protected $fillable = [
        'mahasiswa_id',
        'tempat_id',
        'konfirmasi',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id', 'id_mahasiswa');
    }

    public function perusahaan()
    {
        return $this->belongsTo(TempatPkl::class, 'tempat_id', 'id_tempat');
    }
}
