<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $primaryKey = 'nisn';
    protected $fillable = [
        "nisn",
        "user_id",
        "kelas_id",
        "jurusan_id",
        "nama_siswa",
        "alamat",
        "jenis_kelamin",
        "tempat_lahir",
        "agama",
        "tanggal_lahir",
        "foto",
        "tentang",
    ];
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'jurusan_id', 'id');
    }
}
