<?php

namespace Database\Seeders;

use App\Models\Jurusan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JurusansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Jurusan::create([
            "nama"=> "IPA-1",
        ]);
        Jurusan::create([
            "nama"=> "IPA-2",
        ]);
        Jurusan::create([
            "nama"=> "IPA-3",
        ]);
        Jurusan::create([
            "nama"=> "IPS-1",
        ]);
        Jurusan::create([
            "nama"=> "IPS-2",
        ]);
        Jurusan::create([
            "nama"=> "IPS-3",
        ]);
        Jurusan::create([
            "nama"=> "Bahasa-1",
        ]);
        Jurusan::create([
            "nama"=> "Bahasa-2",
        ]);
        Jurusan::create([
            "nama"=> "Bahasa-3",
        ]);
    }
}
