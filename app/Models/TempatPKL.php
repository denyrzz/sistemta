<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempatPkl extends Model
{
    use HasFactory;

    protected $table = 'tempat_pkl';
    protected $primaryKey = 'id_tempat';
    public $timestamps = false;

    protected $fillable = [
        'nama_perusahaan',
        'alamat',
        'kontak',
        'kuota',
        'status',
    ];

    public function usulanPkl()
    {
        return $this->hasMany(UsulanPkl::class, 'tempat_id', 'id_tempat');
    }
}
