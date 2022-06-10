<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (count(DB::table('materiales')->where('tipo', 'Vinilo')->get()) == 0) {
            DB::table('materiales')->insert([
                'tipo' => 'Vinilo',
                'color' => '#8B00FF',

            ]);
            DB::table('materiales')->insert([
                'tipo' => 'Carton',
                'color' => '#FFC096',

            ]);
            DB::table('materiales')->insert([
                'tipo' => 'Lona',
                'color' => '#96F7FF',

            ]);
        }
    }
}
