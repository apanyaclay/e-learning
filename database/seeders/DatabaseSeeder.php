<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            JurusansTableSeeder::class,
            KelasTableSeeder::class,
            UsersTableSeeder::class,
            AdminsTableSeeder::class,
            GurusTableSeeder::class,
            MataPelajaransTableSeeder::class,
            SiswasTableSeeder::class,
            TahunAjaransTableSeeder::class,
            JadwalsTableSeeder::class,
            EbooksTableSeeder::class,
            MaterisTableSeeder::class,
            PertemuansTableSeeder::class,
            KuisTableSeeder::class,
            SoalsTableSeeder::class,
        ]);
    }
}
