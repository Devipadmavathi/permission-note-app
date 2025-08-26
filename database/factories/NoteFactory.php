<?php

namespace Database\Factories;

use App\Models\Note;
use Illuminate\Database\Eloquent\Factories\Factory;

class NoteFactory extends Factory
{
    protected $model = Note::class;

    public function definition(): array
    {
        return [
            'title'   => $this->faker->sentence(),   // ✅ add this
            'content' => $this->faker->paragraph(),
            'user_id' => 1, // or dynamic user id if seeding users
        ];
    }
}
