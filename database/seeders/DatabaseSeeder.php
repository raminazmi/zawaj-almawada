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
            'email' => 'mahmoudalmallahi90@gmail.com',
            'password' => Hash::make('123456'),
            'is_admin' => true
        ]);
        User::query()->create([
            'name' => 'رامي',
            'email' => 'raminazmi7@gmail.com',
            'password' => Hash::make('123456'),
            'is_admin' => false,
            'gender' => 'male'
        ]);
        User::query()->create([
            'name' => 'حمدية',
            'email' => 'hamdinazmi11@gmail.com',
            'password' => Hash::make('123456'),
            'is_admin' => false,
            'gender' => 'female'
        ]);
        $this->call([
            QuestionsSeeder::class,
        ]);
    }
}
