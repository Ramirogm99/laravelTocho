<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VallaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [

            'alias' => $this->faker->name,
            'direccion' => $this->faker->address,
            'localidad' => $this->faker->city,
            'latitud' => $this->faker->numberBetween(36258149, 43525868)/1000000,
            'longitud' => $this->faker->numberBetween(-9313872, -1045695)/1000000,
            'tamano' => $this->faker->numberBetween(1, 10),
            'incidencias' => $this->faker->realText,
        ];
    }
}
