<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;

    protected $table = 'ruangan';

    public $timestamps = false;

    protected $primaryKey = 'id';

    protected $fillable = [
        'nama_ruangan',
        'no_ruangan'
    ];
}
