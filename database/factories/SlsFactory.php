<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sls>
 */
class SlsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'kabkot_id' => \App\Models\Kabkot::factory(),
            'kode' => $this->faker->unique()->randomNumber(6),
        ];
    }
}