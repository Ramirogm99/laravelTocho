<?php

namespace Database\Seeders;

use App\Models\Valla;
use DB;
use Illuminate\Database\Seeder;

class VallaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {

        Valla::factory()->times(10)->create();

        DB::table('vallas')->insert([
            'alias' => 'Explanada Top Level S.L.',
            'direccion' => 'Calle Helsinki 6',
            'localidad' => 'Córdoba',
            'latitud' => '37.9001041',
            'longitud' => '-4.7333211',
            'tamano' => '5',
            'norte' => 'ejemploValla.jpg',
            'sur' => 'ejemploValla1.jpg',
            'este' => 'ejemploValla2.jpg',
            'oeste' => 'ejemploValla.jpg',
            'incidencias' => 'Esta valla esta en buen estado',
            'tamano' => '5'
        ]);

        DB::table('vallas')->insert([
            'alias' => 'Hipercor',
            'direccion' => 'Ronda de cordoba, 1',
            'localidad' => 'Córdoba',
            'latitud' => '37.8924005',
            'longitud' => '-4.8090173913974175',
            'tamano' => '5',
            'norte' => 'hipercor.jpg',
            'sur' => 'hipercor1.jpg',
            'este' => 'hipercor2.jpg',
            'oeste' => 'hipercor.jpg',
            'incidencias' => 'Esta valla esta en buen estado',
            'tamano' => '5'
        ]);

        DB::table('vallas')->insert([
            'alias' => 'Las delicias',
            'direccion' => 'Cañada real Mesetas, 1',
            'localidad' => 'Córdoba',
            'latitud' => '37.88396348633628',
            'longitud' => '-4.8047555212935364',
            'tamano' => '5',
            'norte' => 'delicias.jpg',
            'sur' => 'delicias1.jpg',
            'este' => 'delicias1.jpg',
            'oeste' => 'delicias.jpg',
            'incidencias' => 'Esta valla esta en buen estado',
            'tamano' => '5'
        ]);

    }
}
