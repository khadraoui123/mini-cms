<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->admin()->create([
            'name' => 'Admin Mini-CMS',
            'email' => 'admin@mini-cms.test',
        ]);

        User::factory()->author()->create([
            'name' => 'Camille Martin',
            'email' => 'camille@mini-cms.test',
        ]);

        User::factory()->author()->create([
            'name' => 'Karim Benali',
            'email' => 'karim@mini-cms.test',
        ]);

        User::factory()->author()->create([
            'name' => 'Sofia Trabelsi',
            'email' => 'sofia@mini-cms.test',
        ]);

        User::factory()->author()->create([
            'name' => 'Youssef Gharbi',
            'email' => 'youssef@mini-cms.test',
        ]);
    }
}
