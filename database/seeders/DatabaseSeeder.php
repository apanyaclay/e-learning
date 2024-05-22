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
            UsersTableSeeder::class,
            JurusansTableSeeder::class,
            KelasTableSeeder::class,
            SiswasTableSeeder::class,
            MataPelajaransTableSeeder::class,
            PengajarsTableSeeder::class,
            AdminsTableSeeder::class,
            JadwalsTableSeeder::class,
        ]);
    }
}
