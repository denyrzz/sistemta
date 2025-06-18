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
        'nilai_mahasiswa',
        'status',
    ];

    public static function boot()
    {
        parent::boot();
        MhsSempro::all()->each(function ($sempro) {
            $nilaiPembimbingSatu = $sempro->nilaiPembimbing1->nilai_sempro ?? null;
            $nilaiPembimbingDua = $sempro->nilaiPembimbing2->nilai_sempro ?? null;
            $nilaiPenguji = $sempro->nilaiPenguji->nilai_sempro ?? null;

            if ($nilaiPembimbingSatu !== null && $nilaiPenguji !== null && $nilaiPembimbingDua !== null) {
                $nilaimahasiswa = (($nilaiPembimbingSatu + $nilaiPenguji + $nilaiPembimbingDua)/3);

                $sempro->nilai_mahasiswa = $nilaimahasiswa;

                $sempro->save();
            } else {
            }
        });
    }

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

    public function Penguji()
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

    public function nilaiPembimbing1()
    {
        return $this->hasOne(NilaiSempro::class, 'sempro_id', 'id_sempro')->where('status', '0');
    }

    public function nilaiPembimbing2()
    {
        return $this->hasOne(NilaiSempro::class, 'sempro_id', 'id_sempro')->where('status', '1');
    }

    public function nilaiPenguji()
    {
        return $this->hasOne(NilaiSempro::class, 'sempro_id', 'id_sempro')->where('status', '2');
    }

    public function nilaisempro()
    {
        return $this->hasOne(NilaiSempro::class, 'sempro_id');
    }

    public function bimbinganTA()
    {
        return $this->hasMany(BimbinganTA::class, 'sempro_id');
    }

}
