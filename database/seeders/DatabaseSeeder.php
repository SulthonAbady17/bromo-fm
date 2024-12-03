<?php

namespace Database\Seeders;

use App\Models\Report;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(100)->create();
        Report::factory(100)->create();

        User::factory()->create([
            'name' => 'Test User',
            'is_admin' => false,
            'email' => 'test@gmail.com',
            'password' => 'password',
        ]);

        User::factory()->create([
            'name' => 'Admin',
            'is_admin' => true,
            'email' => 'admin@gmail.com',
            'password' => 'password',
        ]);
    }
}
