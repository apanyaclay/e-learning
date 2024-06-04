<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JawabanTugas extends Model
{
    use HasFactory;
    protected $fillable = [
        "siswa_nisn",
        "tugas_id",
        "jawaban",
    ];
}
