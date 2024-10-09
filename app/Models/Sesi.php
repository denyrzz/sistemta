<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sesi extends Model
{
    use HasFactory;

    // Define the table name
    protected $table = 'sesi';

    // Define the primary key
    protected $primaryKey = 'id_sesi';

    // Disable timestamps if you are not using created_at and updated_at
    public $timestamps = false;

    // Define the fillable attributes
    protected $fillable = [
        'dari_jam',
        'sampai_jam',
    ];
}
