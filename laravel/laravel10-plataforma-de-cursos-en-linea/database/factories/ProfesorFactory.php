<?php

namespace Database\Factories;

use App\Models\Profesor;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


class ProfesorFactory extends Factory
{
    /**
     * Define the model's default state.
     * @var string
     * @return array<string, mixed>
     */

    protected $model = Profesor::class;
    /*
    * @return array
    */ 

    public function definition()
    {
        $name = $this->faker->sentence();
        return [
            'nombres' => $this->faker->firstName(),
            'apellidos' => $this->faker->lastName(),
            'curso' => $this->faker->randomElement(['Curso']),
            'nivel' => $this->faker->randomElement(['Primaria', 'Secundaria']) 
        ];
    }
}
