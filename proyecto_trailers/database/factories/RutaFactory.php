<?php

namespace Database\Factories;

use App\Models\Ruta;
use Illuminate\Database\Eloquent\Factories\Factory;

class RutaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ruta::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'descripcionRuta' => $this->faker->name(),
        ];
    }
}
