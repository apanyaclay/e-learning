<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;
    protected $primaryKey = 'nuptk';
    protected $fillable = [
        'nuptk',
        'user_id',
        'nama',
        'alamat',
        'no_hp',
        'jenis_kelamin',
        'tempat_lahir',
        'agama',
        'tanggal_lahir',
        'foto',
        'tentang',
    ];

    public function mataPelajaran()
    {
        return $this->hasMany(MataPelajaran::class);
    }
}
