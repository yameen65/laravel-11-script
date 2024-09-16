<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user1 = new User();
        $user1->username = 'admin';
        $user1->first_name = 'admin';
        $user1->last_name = 'admin';
        $user1->about = "This is little bit more about my self. I'm the admin of this website.";
        $user1->email = 'admin@gmail.com';
        $user1->password = Hash::make('admin123');
        $user1->email_verified_at = now();
        $user1->created_at = now();
        $user1->save();
        $user1->assignRole('admin');
        $user1->file()->create(['name' => 'profile.jpg', 'path' => 'users/profile.png', 'type' => 'profile']);
    }
}
