<?php

namespace App\Models;

use App\Http\Controllers\NilaiSidangPklController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MhsPkl extends Model
{
    use HasFactory;

    // Define the table name if it's not the default pluralized form
    protected $table = 'mhs_pkl';

    // Define the primary key if it's not the default 'id'
    protected $primaryKey = 'id_pkl';

    public $timestamps = false;
    // Specify the attributes that are mass assignable
    protected $fillable = [
        'mahasiswa_id',
        'tempat_id',
        'ruangan_id',
        'sesi_id',
        'tahun_pkl',
        'dosen_pembimbing',
        'pembimbing_industri',
        'nilai_pembimbing_industri',
        'dokument_nilai_industri',
        'nilai_bimbingan',
        'judul',
        'dokument_pkl',
        'dokument_pkl_revisi',
        'dosen_penguji',
        'tanggal_sidang',
        'verif_berkas',
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id', 'id_mahasiswa');
    }

    public function tempat()
    {
        return $this->belongsTo(TempatPkl::class, 'tempat_id', 'id_tempat');
    }

    public function sesi()
    {
        return $this->belongsTo(Sesi::class, 'sesi_id', 'id_sesi');
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'ruangan_id', 'id_ruangan');
    }

    public function dosenpembimbing()
    {
        return $this->belongsTo(dosen::class, 'dosen_pembimbing', 'id_dosen');
    }

    public function dosenpenguji()
    {
        return $this->belongsTo(dosen::class, 'dosen_penguji', 'id_dosen');
    }

    public function logbook()
    {
        return $this->hasMany(MhsLogbook::class, 'pkl_id');
    }

    public function nilaiPembimbing()
    {
        return $this->hasOne(NilaiSidangPkl::class, 'pkl_id', 'id_pkl')->where('status', '0');
    }

    public function nilaiPenguji()
    {
        return $this->hasOne(NilaiSidangPkl::class, 'pkl_id', 'id_pkl')->where('status', '1');
    }

}
