<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::query()->create([
            'name' => 'Admin',
            'email' => 'zawajmawadda@gmail.com',
            'password' => Hash::make('123456789'),
            'is_admin' => true,
            'admin_role' => 'main',
            'membership_number' => "000000",
        ]);
        $this->call([
            QuestionsSeeder::class,
        ]);
    }
}
