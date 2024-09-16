<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'all_user', 'title' => 'View all users']);
        Permission::create(['name' => 'add_user', 'title' => 'Add new user']);
        Permission::create(['name' => 'view_user', 'title' => 'View user detail']);
        Permission::create(['name' => 'edit_user', 'title' => 'Edit user']);
        Permission::create(['name' => 'delete_user', 'title' => 'Delete user']);
    }
}
