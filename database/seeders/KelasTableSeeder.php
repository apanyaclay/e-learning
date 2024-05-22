<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kelas::create([
            "nama"=> "10",
        ]);
        Kelas::create([
            "nama"=> "11",
        ]);
        Kelas::create([
            "nama"=> "12",
        ]);
    }
}
