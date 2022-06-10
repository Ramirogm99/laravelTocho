<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {

        $this->call([
            EmpresaSeeder::class,
            UserSeeder::class,
            ClienteSeeder::class,
            VallaSeeder::class,
            EstadoSeeder::class,
            MaterialSeeder::class,

        ]);

    }
}
