<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@motolease.id'],
            [
                'name' => 'Admin MotoLease',
                'password' => Hash::make('admin123'),
                'nik' => '1234567890123456',
                'whatsapp' => '081234567890',
                'role' => 'admin',
                'email_verified_at' => now()
            ]
        );
    }
}
