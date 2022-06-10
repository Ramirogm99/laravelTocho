<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ClienteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $nombre = $this->faker->unique()->name;
        $CIF = '89204428D';
        return [
            'nombre' => $nombre,
            'd_social' => $nombre,
            'direccion' => $this->faker->address,
            'direccion_2' => $this->faker->address,
            'localidad' => $this->faker->country,
            'provincia' => $this->faker->country,
            'representante' => $this->faker->name,
            'telefono' => $this->faker->e164PhoneNumber(),
            'codpost' => $this->faker->randomNumber(5),
            'email' => $this->faker->email(),
            'CIF' => $CIF,
        ];
    }
}
