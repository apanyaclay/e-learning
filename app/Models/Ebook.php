<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ebook extends Model
{
    use HasFactory;
    protected $table ='e-books';
    protected $fillable = [
        'judul',
        'file',
        'guru_nuptk',
    ];

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_nuptk', 'nuptk');
    }
}
