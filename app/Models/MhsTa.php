<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MhsTa extends Model
{
    use HasFactory;

    protected $table = 'mhs_ta';

    protected $primaryKey = 'id_ta';

    public $timestamps = false;

    protected $fillable = [
        'mahasiswa_id',
        'proposal_final',
        'laporan_ta',
        'tugas_akhir',
        'acc_pembimbing1',
        'acc_pembimbing2',
        'dosen_pembimbing1',
        'dosen_pembimbing2',
        'tanggal_sidang',
        'ruangan_id',
        'sesi_id',
        'ketua_sidang',
        'penguji1_id',
        'penguji2_id',
        'penguji3_id',
        'surat_tugas',
        'nilai_mahasiswa',
        'keterangan',
    ];

    public static function boot()
    {
        parent::boot();
        MhsTa::all()->each(function ($ta) {
            $nilaiPembimbingSatu = $ta->nilaiPembimbing1->nilai_sidang ?? null;
            $nilaiPembimbingDua = $ta->nilaiPembimbing2->nilai_sidang ?? null;
            $nilaiPenguji1 = $ta->nilaiPenguji1->nilai_sidang ?? null;
            $nilaiPenguji2 = $ta->nilaiPenguji2->nilai_sidang ?? null;
            $nilaiPenguji3 = $ta->nilaiPenguji3->nilai_sidang ?? null;

            if ($nilaiPembimbingSatu !== null && $nilaiPenguji1 && $nilaiPenguji2 && $nilaiPenguji3 !== null && $nilaiPembimbingDua !== null) {
                $nilaimahasiswa = ((($nilaiPembimbingSatu + $nilaiPembimbingDua) + $nilaiPenguji1 + $nilaiPenguji2 +$nilaiPenguji3)/4);
                $ta->nilai_mahasiswa = $nilaimahasiswa;

                $ta->save();
            } else {
            }
        });
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id', 'id_mahasiswa');
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id', 'id_ruangan');
    }

    public function sesi()
    {
        return $this->belongsTo(Sesi::class, 'sesi_id', 'id_sesi');
    }

    public function ketuasidang()
    {
        return $this->belongsTo(Dosen::class, 'ketua_sidang', 'id_dosen');
    }

    public function dosenPembimbing1()
    {
        return $this->belongsTo(Dosen::class, 'dosen_pembimbing1', 'id_dosen');
    }

    public function dosenPembimbing2()
    {
        return $this->belongsTo(Dosen::class, 'dosen_pembimbing2', 'id_dosen');
    }

    public function penguji1()
    {
        return $this->belongsTo(Dosen::class, 'penguji1_id', 'id_dosen');
    }

    public function penguji2()
    {
        return $this->belongsTo(Dosen::class, 'penguji2_id', 'id_dosen');
    }

    public function penguji3()
    {
        return $this->belongsTo(Dosen::class, 'penguji3_id', 'id_dosen');
    }

    public function sempro()
    {
        return $this->belongsTo(MhsSempro::class, 'sempro_id', 'id_sempro');
    }

    public function mhssempro()
    {
        return $this->belongsTo(MhsSempro::class, 'mahasiswa_id', 'mahasiswa_id');
    }

    public function nilaiPembimbing1()
    {
        return $this->hasOne(NilaiSidangTa::class, 'ta_id', 'id_ta')->where('status', '0');
    }

    public function nilaiPembimbing2()
    {
        return $this->hasOne(NilaiSidangTa::class, 'ta_id', 'id_ta')->where('status', '1');
    }

    public function nilaiPenguji1()
    {
        return $this->hasOne(NilaiSidangTa::class, 'ta_id', 'id_ta')->where('status', '2');
    }

    public function nilaiPenguji2()
    {
        return $this->hasOne(NilaiSidangTa::class, 'ta_id', 'id_ta')->where('status', '3');
    }

    public function nilaiPenguji3()
    {
        return $this->hasOne(NilaiSidangTa::class, 'ta_id', 'id_ta')->where('status', '4');
    }
}
