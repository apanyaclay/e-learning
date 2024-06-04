<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiTugas extends Model
{
    use HasFactory;
    protected $fillable = [
        "nilai",
        "tugas_id",
        "siswa_nisn",
        "komentar",
    ];
}
