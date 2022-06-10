<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        if (count(DB::table('datos')->where('nombre_fiscal', 'Saile')->get()) == 0) {
            DB::table('datos')->insert([
                'nombre_fiscal' => 'Saile',
                'd_social' => 'GRUPO DE COMUNICACION SAILE S.L.',
                'direccion' => 'C. Secunda Romana, 56',
                'localidad' => 'Córdoba',
                'provincia' => 'Córdoba',
                'CIF' => 'B14769509',
                'representante' => 'Francisco J. Elías Ordoñez',
                'codpost' => 14009,
                'telefono' => 661843906,
                'movil' => 661843906,
                'email1' => 'paco@saile.es',
                'email2' => 'info@saile.es',
                'logo' => 'saile1.jpg',

            ]);
        }
    }
}
