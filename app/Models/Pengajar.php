<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajar extends Model
{
    use HasFactory;
    protected $primaryKey = 'nuptk';
    protected $fillable = [
        'nuptk',
        'user_id',
        'mata_pelajaran_id',
        'nama_pengajar',
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
        return $this->belongsTo(MataPelajaran::class, 'mata_pelajaran_id', 'id');
    }
}
