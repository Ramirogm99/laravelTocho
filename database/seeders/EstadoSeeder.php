<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (count(DB::table('estados')->where('nombre', 'Alquilada')->get()) == 0) {
            DB::table('estados')->insert([
                'nombre' => 'Alquilada',
                'color' => '#FF3434',
            ]);
            DB::table('estados')->insert([
                'nombre' => 'Reservada',
                'color' => '#ffc107',
            ]);
        }
    }
}
