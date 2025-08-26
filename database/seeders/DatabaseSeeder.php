<?php

namespace Database\Seeders;

use App\Models\Note;
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
        // User::factory(10)->create();

        User::factory()->create([
            'id'=> 1,
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password'=> bcrypt('123'),
        ]);
        User::factory(5)->create()->each(function ($user) {
        Note::factory(3)->create([
            'user_id' => $user->id,
        ]);
    });
    }
}
