<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempatPkl extends Model
{
    use HasFactory;

    protected $table = 'tempat_pkl'; // Pastikan nama tabel benar
    protected $primaryKey = 'id_tempat'; // Pastikan ini adalah primary key
    public $timestamps = false; // Atur ke true jika menggunakan timestamps

    protected $fillable = [
        'nama_perusahaan',
        'alamat',
        'kontak',
        'kuota',
        'status', // Tambahkan jika perlu
    ];

    public function usulanPkl()
    {
        return $this->hasMany(UsulanPkl::class, 'tempat_id', 'id_tempat');
    }
}
