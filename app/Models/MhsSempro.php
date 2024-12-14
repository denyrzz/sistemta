<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MhsSempro extends Model
{
    use HasFactory;

    protected $table = 'mhs_sempro';

    protected $primaryKey = 'id_sempro';

    public $timestamps = false;

    protected $fillable = [
        'mahasiswa_id',
        'judul',
        'file_sempro',
        'pembimbing_satu',
        'pembimbing_dua',
        'penguji',
        'tanggal_sempro',
        'ruangan_id',
        'sesi_id',
        'status',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id', 'id_mahasiswa');
    }

    public function pembimbingSatu()
    {
        return $this->belongsTo(Dosen::class, 'pembimbing_satu', 'id_dosen');
    }

    public function pembimbingDua()
    {
        return $this->belongsTo(Dosen::class, 'pembimbing_dua', 'id_dosen');
    }

    public function penguji()
    {
        return $this->belongsTo(Dosen::class, 'penguji', 'id_dosen');
    }

    public function sesi()
    {
        return $this->belongsTo(Sesi::class, 'sesi_id', 'id_sesi');
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id', 'id_ruangan');
    }

}
