<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MhsNilaiBimbinganPkl extends Model
{
    use HasFactory;


    protected $table = 'nilai_bimbingan_pkl';
    protected $primaryKey = 'id_nilai_bimbingan';
    public $timestamps = false;

    protected $fillable = [
        'pkl_id',
        'keaktifan',
        'komunikatif',
        'problem_solving',
        'nilai_bimbingan',
    ];

    public function mhsPkl()
    {
        return $this->belongsTo(MhsPkl::class, 'pkl_id', 'id_pkl');
    }

}
