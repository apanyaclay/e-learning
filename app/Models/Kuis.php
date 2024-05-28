<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kuis extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'tenggat',
        'durasi',
        'pertemuan_id',
        'guru_nuptk',
    ];
}
