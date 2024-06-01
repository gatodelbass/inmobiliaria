<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create(['name' => 'nature', 'icon' => 'nature.svg']);
        Category::create(['name' => 'universe', 'icon' => 'universe.svg']);
        Category::create(['name' => 'movies & tv', 'icon' => 'movies.svg']);
        Category::create(['name' => 'sports', 'icon' => 'sports.svg']);
        Category::create(['name' => 'art', 'icon' => 'art.svg']);
        Category::create(['name' => 'commerce', 'icon' => 'commerce.svg']);
        Category::create(['name' => 'culture & travel', 'icon' => 'globe.svg']);
        Category::create(['name' => 'anime', 'icon' => 'yen.svg']);
        Category::create(['name' => 'music', 'icon' => 'music.svg']);
        Category::create(['name' => 'games', 'icon' => 'games.svg']);
        Category::create(['name' => 'mechanics', 'icon' => 'mechanics.svg']);
        Category::create(['name' => 'other', 'icon' => 'other.svg']);
    }
}
