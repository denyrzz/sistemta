<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MhsLogbook extends Model
{
    use HasFactory;

    protected $table = 'mhs_logbook';
    protected $primaryKey = 'id_logbook';
    public $timestamps = false;

    protected $fillable = [
        'pkl_id',
        'tgl_awal',
        'tgl_akhir',
        'kegiatan',
        'dokumentasi',
        'komentar',
        'validasi',
    ];

    public function mhspkl()
    {
        return $this->belongsTo(MhsPkl::class, 'pkl_id', 'id_pkl');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id', 'id_mahasiswa');
    }
}
