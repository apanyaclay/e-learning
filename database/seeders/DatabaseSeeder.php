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
            // SiswasTableSeeder::class,
            // GurusTableSeeder::class,
            MataPelajaransTableSeeder::class,
            AdminsTableSeeder::class,
            JadwalsTableSeeder::class,
            EbooksTableSeeder::class,
            MaterisTableSeeder::class,
            PertemuansTableSeeder::class,
            KuisTableSeeder::class,
            SoalsTableSeeder::class,
        ]);
    }
}
