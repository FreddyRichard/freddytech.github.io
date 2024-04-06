<?php

namespace Database\Factories;

use App\Models\Curso;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Curso>
 */
class CursoFactory extends Factory
{
    /**
     * Define the model's default state.
     * @var string
     * @return array<string, mixed>
     */

    protected $model = Curso::class;
    /*
    * @return array
    */ 

    public function definition()
    {
        $name = $this->faker->sentence();
        return [
            'nombre' => $name,
            'slug' => Str::slug($name, '-'),
            'descripcion' => $this->faker->paragraph(),
            'categoria' => $this->faker->randomElement(['Desarrollo web', 'Diseño web']) 
        ];
    }
}
