<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tag::factory()->createMany([
            ['name' => 'PHP', 'slug' => 'php'],
            ['name' => 'Laravel', 'slug' => 'laravel'],
            ['name' => 'Eloquent', 'slug' => 'eloquent'],
            ['name' => 'Tailwind', 'slug' => 'tailwindcss'],
            ['name' => 'Sécurité', 'slug' => 'securite'],
            ['name' => 'Performance', 'slug' => 'performance'],
            ['name' => 'Tests', 'slug' => 'tests'],
            ['name' => 'API', 'slug' => 'api'],
            ['name' => 'JavaScript', 'slug' => 'javascript'],
            ['name' => 'SQL', 'slug' => 'sql'],
        ]);
    }
}
