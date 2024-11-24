<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sesi extends Model
{
    use HasFactory;

    protected $table = 'sesi';

    protected $primaryKey = 'id_sesi';

    public $timestamps = false;

    protected $fillable = [
        'sesi',
        'jam',
    ];
}
