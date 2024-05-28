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
        'mulai',
        'pertemuan_id',
        'guru_nuptk',
    ];

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_nuptk', 'nuptk');
    }
    public function pertemuan()
    {
        return $this->belongsTo(Pertemuan::class, 'pertemuan_id', 'id');
    }
}
