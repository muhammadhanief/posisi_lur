<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Activity>
 */
class ActivityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'users_kegiatan_id' => \App\Models\UsersKegiatan::factory(),
            'lat' => $this->faker->latitude(),
            'long' => $this->faker->longitude(),
        ];
    }
}