<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'kkm',
        'guru_nuptk',
    ];

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }
}
