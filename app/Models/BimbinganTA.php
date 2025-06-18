<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BimbinganTA extends Model
{
    use HasFactory;

    protected $table = 'mhs_bimbingan';
    protected $primaryKey = 'id_bimbingan';
    public $timestamps = false;

    protected $fillable = [
        'sempro_id',
        'tanggal',
        'kegiatan',
        'dokumentasi',
        'komentar',
        'validasi',
    ];

    public function sempro()
    {
        return $this->belongsTo(MhsSempro::class,'sempro_id', 'id_sempro');
    }
}
