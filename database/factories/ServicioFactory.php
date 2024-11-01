<?php

namespace Database\Factories;

use App\Models\Servicio;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Servicio>
 */
class ServicioFactory extends Factory
{
    protected $model = Servicio::class;
    public function definition()
    {
        return [
            
            'tipo_servicio_id' => 1,
            'fecha' => date('Y-m-d', strtotime('-' . rand(3, 10) . ' days')), 
            'hora' => $this->faker->time,
            'estado' => $this->faker->name,
            'tecnico_id'=>null,
            'nombre_solicitante' => $this->faker->name,
            'apellido_solicitante' => $this->faker->lastName,
            'departamento' => $this->faker->randomNumber,
            'codigo' => $this->faker->randomNumber,
            'contacto' => $this->faker->phoneNumber,
            'tipo' => $this->faker->title,
            'status' => 2,
            'fechaRealizado' => date('Y-m-d', strtotime('-' . rand(1, 3
            ) . ' days')), 
            'email' => $this->faker->email,
            'descripcion' => $this->faker->text
        ];
        
        
    }
}
