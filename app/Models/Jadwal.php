<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Jadwal extends Model
{
    use HasFactory;

    protected $fillable = [
        'kelas_id',
        'jurusan_id',
        'pengajar_nuptk',
        'hari',
        'jam_mulai',
        'jam_selesai',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function pengajar()
    {
        return $this->belongsTo(Pengajar::class, 'pengajar_nuptk', 'nuptk');
    }

    public static function mostScheduledDay()
    {
        $result = self::select('hari', DB::raw('count(*) as total'))
            ->groupBy('hari')
            ->orderByDesc('total')
            ->first();

        return $result ? $result->total : 0;
    }
}
