<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'username' => 'Admin',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role'=> 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        User::create([
            'username' => 'John Doe',
            'email' => 'john.doe@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role'=> 'pengajar',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        User::create([
            'username' => 'Jane Smith',
            'email' => 'jane.smith@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role'=> 'siswa',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
