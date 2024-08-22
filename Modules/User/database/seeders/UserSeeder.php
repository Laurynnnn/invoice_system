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
        if (!User::where('email', 'laurynk@gmail.com')->exists()) {
            $adminUser = User::create([
                'name' => 'Emr Admin',
                'email' => 'laurynk@gmail.com',
                'username' => 'admin',
                'password' => Hash::make('#Admin@20'), // Set a password
            ]);

            // Assign the 'Admin' role to the user
            $adminUser->assignRole('Admin');
        }

    }
}
