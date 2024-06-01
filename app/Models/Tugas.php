<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    use HasFactory;
    protected $fillable = [
        "nama",
        "detail",
        "tenggat",
        "pertemuan_id",
        "guru_nuptk",
    ];
}
