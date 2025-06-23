<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::create([
            'name' => 'Admin One',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'position' => 'Manager',
            'phoneNumber' => '0123456789',
            'profilePhoto' => null,
            'adminCode' => 'ADM001',
        ]);
    }
}
