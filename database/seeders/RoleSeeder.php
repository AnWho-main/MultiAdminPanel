<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
       


        $insertsData = [
            ['name' => 'Super Admin', 'name_slug'=>'super-admin'],
            ['name' => 'Hr','name_slug'=>'hr'],
            ['name' => 'Accounts','name_slug'=>'accounts'],
            ['name' => 'Manager','name_slug'=>'manager'],
            ['name' => 'Developer','name_slug'=>'developer'],
            ['name' => 'Sr Developer','name_slug'=>'sr-developer'],
            

            // Add more user data entries as needed
        ];


        

        foreach ($insertsData as $insertData) {
            $existingData = Role::where('name', $insertData['name'])->first();

            if (!$existingData) {
                Role::create($insertData);
                $this->command->info("Role '{$insertData['name']}' inserted successfully.");
            } else {
                $this->command->info("Role '{$insertData['name']}' already exists. Skipping insertion.");
            }
        }
    }
}
