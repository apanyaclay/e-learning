<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    protected $primaryKey = 'nip';
    protected $fillable = [
        'nip',
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
}
