<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Seeder;

class TypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Type::create(['type' => 'casa']);
        Type::create(['type' => 'apartamento']);
        Type::create(['type' => 'oficina']);
        Type::create(['type' => 'bodega']);
        Type::create(['type' => 'apartaestudio']);
    }
}
