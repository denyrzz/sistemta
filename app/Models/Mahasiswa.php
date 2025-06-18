<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_mahasiswa';

    protected $fillable = [
        'id_mahasiswa',
        'user_id',
        'nim',
        'nama',
        'prodi_id',
        'jenis_kelamin',
        'email',
        'password',
        'image',
    ];

    public $timestamps = false;

    protected $table = 'mahasiswa';

    /**
     * Get the Prodi (Program Studi) associated with the Mahasiswa.
     */
    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id', 'id_prodi');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function mhs_pkl()
    {
        return $this->hasOne(MhsPkl::class, 'mahasiswa_id', 'id_mahasiswa');
    }

    public function sempro()
    {
        return $this->hasOne(MhsSempro::class, 'mahasiswa_id', 'id_mahasiswa');
    }


    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($mahasiswa) {
            if ($mahasiswa->user) {
                $mahasiswa->user->delete();
            }
        });
    }
}
