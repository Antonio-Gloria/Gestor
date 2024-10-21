<?php

namespace Database\Factories;

use App\Models\Tecnico;
use Illuminate\Database\Eloquent\Factories\Factory;

class TecnicoFactory extends Factory
{
    protected $model = Tecnico::class;

    public function definition()
    {
        return [
            // Definir los campos con datos falsos aquí
            'nombre' => $this->faker->name,
            'apellido' => $this->faker->lastName,
            'telefono' => $this->faker->phoneNumber,
            'email' => $this->faker->safeEmail,
            'status' => 1
        ];
    }
}
