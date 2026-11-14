<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
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
