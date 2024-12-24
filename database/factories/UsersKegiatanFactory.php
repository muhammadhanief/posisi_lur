<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UsersKegiatan>
 */
class UsersKegiatanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'kegiatan_id' => \App\Models\Kegiatan::factory(),
            'sls_id' => \App\Models\Sls::factory(),
            'email_pml' => $this->faker->unique()->safeEmail(),
        ];
    }
}