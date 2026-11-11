<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Akun testing siswa
        User::updateOrCreate(
            ['email' => 'siswa@test.com'],
            [
                'name' => 'Siswa Testing',
                'password' => Hash::make('Siswa12345'),
                'email_verified_at' => now(),
            ]
        );
    }
}