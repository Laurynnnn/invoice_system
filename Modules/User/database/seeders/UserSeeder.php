<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Modules\User\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Check if there's no admin user
        if (!User::where('role', 'admin')->exists()) {
            User::create([
                'name' => 'Emr Admin',
                'email' => 'laurynk@gmail.com',
                'username' => 'admin',
                'role' => 'admin',
                'password' => Hash::make('#Admin@20'), // Set a password
            ]);
        }
    }
}
