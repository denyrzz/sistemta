<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    protected $table = 'dosen';

    protected $primaryKey = 'id_dosen';

    public $incrementing = true;

    public $timestamps = false;

    protected $fillable = [
        'nama_dosen',
        'user_id',
        'nidn',
        'nip',
        'jenis_kelamin',
        'jurusan_id',
        'prodi_id',
        'golongan',
        'email',
        'image',
        'status',
    ];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'jurusan_id', 'id_jurusan');
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id', 'id_prodi');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function mhsPkl()
    {
        return $this->hasMany(MhsPkl::class, 'dosen_pembimbing', 'id_dosen');
    }

    public function mhsPkl_penguji()
    {
        return $this->hasMany(MhsPkl::class, 'dosen_penguji', 'id_dosen');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($dosen) {
            if ($dosen->user) {
                $dosen->user->delete();
            }
        });
    }

}
