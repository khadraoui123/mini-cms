<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::factory()->createMany([
            ['name' => 'Laravel', 'slug' => 'laravel'],
            ['name' => 'Frontend', 'slug' => 'frontend'],
            ['name' => 'Base de données', 'slug' => 'base-de-donnees'],
        ]);
    }
}
