<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PermissionRole;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $insertsData = [
            ['role_id' => 1, 'permission_id'=>1, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>2, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>3, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>4, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>5, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>6, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>7, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>8, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>9, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>10, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>11, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>12, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>13, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>14, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>15, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>16, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>17, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>18, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>19, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>20, 'is_active' => 1],
            
            
            


            // Add more user data entries as needed
        ];
       

        foreach ($insertsData as $insertData) {
            $existingData = PermissionRole::where('role_id', $insertData['role_id'])
                                            ->where('permission_id', $insertData['permission_id'])
                                                    ->first();
            if (!$existingData) {
                PermissionRole::create($insertData);
                $this->command->info("PermissionRole '{$insertData['role_id']}' and '{$insertData['permission_id']}' inserted successfully.");
            } else {
                $this->command->info("PermissionRole '{$insertData['role_id']}' and '{$insertData['permission_id']}' already exists. Skipping insertion.");
            }
        }
    }
}
