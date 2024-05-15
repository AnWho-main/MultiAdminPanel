<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $usersData = [
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@itechniques.in',
                'username' => 'superadmin123',
                'password' => Hash::make('Admin@@001233'), // Replace 'password' with the desired password
                'role_id' => 1, // ID of the 'superadmin' role from the roles table
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@itechniques.in',
                'username' => 'admin123',
                'password' => Hash::make('Admin@@123'), // Replace 'password' with the desired password
                'role_id' => 2, // ID of the 'superadmin' role from the roles table
            ],
            [
                'name' => 'Hr',
                'email' => 'hr@itechniques.in',
                'username' => 'hr123',
                'password' => Hash::make('Hr@@123'), // Replace 'password' with the desired password
                'role_id' => 2, // ID of the 'superadmin' role from the roles table
            ]
            // Add more user data entries as needed
        ];

        foreach ($usersData as $userData) {
            $existingUser = Admin::where('email', $userData['email'])->first();

            if (!$existingUser) {
                Admin::create($userData);
                $this->command->info("User '{$userData['name']}' inserted successfully.");
            } else {
                $this->command->info("User '{$userData['name']}' already exists. Skipping insertion.");
            }
        }

        
    }
}
