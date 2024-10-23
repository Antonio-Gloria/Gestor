<?php

namespace Database\Factories;

use App\Models\TipoServicio;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tiposervicio>
 */
class TiposervicioFactory extends Factory
{

    protected $model = TipoServicio::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre' => $this->faker->name,
            'descripcion' => $this->faker->text,
            'status' => 1
        ];
    }
}
