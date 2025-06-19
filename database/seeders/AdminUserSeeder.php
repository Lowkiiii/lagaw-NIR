<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'usertype' => 0, // 0 for admin
        ]);

        // Update an existing user to be admin (optional)
        // This will update the first user in the database to be an admin
        // User::where('id', 1)->update(['usertype' => 0]);
    }
}
