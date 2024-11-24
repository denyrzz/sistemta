<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiSidangPkl extends Model
{
    use HasFactory;

    protected $table = 'nilai_sidang_pkl';
    protected $primaryKey = 'id_nilai_pkl';
    public $timestamps = false;

    protected $fillable = [
        'pkl_id',
        'bahasa',
        'analisis',
        'sikap',
        'komunikasi',
        'penyajian',
        'penguasaan',
        'nilai_sidang',
        'status'
    ];

    public function mhspkl()
    {
        return $this->belongsTo(MhsPkl::class, 'pkl_id', 'id_pkl');
    }
}
