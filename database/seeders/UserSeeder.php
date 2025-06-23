<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'membership_number' => '000001',
            'name' => 'Rami Nazmi',
            'email' => 'raminazmi7@gmail.com',
            'password' => Hash::make('123456789'),
            'phone' => '1234567890',
            'gender' => 'male',
            'is_active' => true,
            'is_admin' => false,
            'status' => 'available',
            'profile_status' => 'approved'
        ]);
    }
}