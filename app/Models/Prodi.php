<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    use HasFactory;

    // Menentukan nama tabel
    protected $table = 'prodi';

    // Menentukan primary key dari tabel
    protected $primaryKey = 'id_prodi';

    // Menonaktifkan timestamps karena tabel `prodi` tidak memiliki kolom created_at dan updated_at
    public $timestamps = false;

    // Field yang dapat diisi
    protected $fillable = [
        'kode_prodi',
        'prodi',
        'id_jurusan',
        'jenjang',
    ];

    // Relasi ke tabel Jurusan
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan', 'id_jurusan');
    }
}
