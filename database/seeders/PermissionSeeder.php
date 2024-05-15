<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {


        $insertsData = [
            ['name' => 'manage_dashboard', 'name_slug'=>'manage-dasboard'],
            ['name' => 'dashboard_total_admin_user', 'name_slug'=>'dashboard-total-admin-user'],
            ['name' => 'dashboard_total_users', 'name_slug'=>'dashboard-total-users'],
            ['name' => 'dashboard_total_roles', 'name_slug'=>'dashboard-total-roles'],
            ['name' => 'dashboard_total_permissions', 'name_slug'=>'dashboard-total-permissions'],
            
            
            
            ['name' => 'manage_roles', 'name_slug'=>'manage-roles'],
            ['name' => 'create_roles', 'name_slug'=>'create-roles'],
            ['name' => 'edit_roles', 'name_slug'=>'edit-roles'],
            ['name' => 'delete_roles', 'name_slug'=>'delete-roles'],
            ['name' => 'show_roles', 'name_slug'=>'show-roles'],

            ['name' => 'manage_permissions', 'name_slug'=>'manage-permissions'],
            ['name' => 'create_permissions', 'name_slug'=>'create-permissions'],
            ['name' => 'edit_permissions', 'name_slug'=>'edit-permissions'],
            ['name' => 'delete_permissions', 'name_slug'=>'delete-permissions'],
            ['name' => 'show_permissions', 'name_slug'=>'show-permissions'],

            ['name' => 'manage_users', 'name_slug'=>'manage-users'],
            ['name' => 'create_users', 'name_slug'=>'create-users'],
            ['name' => 'edit_users', 'name_slug'=>'edit-users'],
            ['name' => 'delete_users', 'name_slug'=>'delete-users'],
            ['name' => 'show_users', 'name_slug'=>'show-users'],

            

            
            


            // Add more user data entries as needed
        ];


        

        foreach ($insertsData as $insertData) {
            $existingData = Permission::where('name', $insertData['name'])->first();

            if (!$existingData) {
                Permission::create($insertData);
                $this->command->info("Permission '{$insertData['name']}' inserted successfully.");
            } else {
                $this->command->info("Permission '{$insertData['name']}' already exists. Skipping insertion.");
            }
        }
    }
}
