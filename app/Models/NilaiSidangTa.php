<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiSidangTa extends Model
{
    use HasFactory;

    protected $table = 'nilai_sidang_ta';

    protected $primaryKey = 'id_nilai_sidang';

    public $timestamps = false;

    protected $fillable = [
        'ta_id',
        'sikap_penampilan',
        'komunikasi_sistematika',
        'penguasaan_materi',
        'identifikasi_masalah',
        'relevansi_teori',
        'metode_algoritma',
        'hasil_pembahasan',
        'kesimpulan_saran',
        'bahasa_tata_tulis',
        'kesesuaian_fungsional',
        'nilai_sidang',
        'formalitas',
        'status'
    ];

    public function mhs_ta()
    {
        return $this->belongsTo(MhsTa::class, 'ta_id', 'id_ta');
    }
}
