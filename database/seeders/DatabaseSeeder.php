<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\WilayahTerkecilType;
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
            'name' => 'Muhammad Hanief',
            'hp' => '081234567890',
            'role' => 'admin',
            'password' => bcrypt('password'),
            'password_not_hashed' => 'password',
        ]);
        User::factory()->create([
            'name' => 'Mufti',
            'hp' => '111111111111',
            'role' => 'ojk',
            'password' => bcrypt('password'),
            'password_not_hashed' => 'password',
        ]);


        WilayahTerkecilType::create(
            ['name' => 'SLS (Satuan Lingkungan Setempat)']
        );
        WilayahTerkecilType::create(
            ['name' => 'BS (Blok Sensus)']
        );

        // \App\Models\User::factory(10)->create();
        // \App\Models\Kabkot::factory(1)->create();
        // \App\Models\Sls::factory(3)->create();
        // \App\Models\Kegiatan::factory(3)->create();
        // \App\Models\UsersKegiatan::factory(5)->create();
        // \App\Models\Activity::factory(5)->create();
    }
}
