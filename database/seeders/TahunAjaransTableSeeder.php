<?php

namespace Database\Seeders;

use App\Models\TahunAjaran;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TahunAjaransTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TahunAjaran::create([
            'tahun_ajaran' => '2023/2024',
            'semester' => 'Ganjil',
            'tanggal_mulai' => '2023-07-10',
            'tanggal_selesai' => '2023-12-16',
        ]);
        TahunAjaran::create([
            'tahun_ajaran' => '2023/2024',
            'semester' => 'Genap',
            'tanggal_mulai' => '2024-01-02',
            'tanggal_selesai' => '2023-06-22',
        ]);
    }
}
