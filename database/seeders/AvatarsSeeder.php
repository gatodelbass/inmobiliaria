<?php

namespace Database\Seeders;

use App\Models\Avatar;
use Illuminate\Database\Seeder;

class AvatarsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Avatar::create(['image' => 'avatars/2021-06-19_030329.png', 'status' => 'Activo']);
        Avatar::create(['image' => 'avatars/2021-06-19_030340.png', 'status' => 'Activo']);
        Avatar::create(['image' => 'avatars/2021-06-19_030351.png', 'status' => 'Activo']);
        Avatar::create(['image' => 'avatars/2021-06-19_030357.png', 'status' => 'Activo']);
        Avatar::create(['image' => 'avatars/2021-06-19_030403.png', 'status' => 'Activo']);
    }
}
