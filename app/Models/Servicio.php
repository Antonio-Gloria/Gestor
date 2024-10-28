<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo_servicio_id',
        'fecha',
        'hora',
        'estado',
        'tecnico_id',
        'nombre_solicitante',
        'apellido_solicitante',
        'departamento',
        'codigo',
        'contacto',
        'tipo',
        'email',
        'fechaRealizado',

    ];

    public function tiposervicio() //Esto lo agregué para ver si puedo obtener el nombre el tipo de servicio seleccionado
    {
        return $this->belongsTo(TipoServicio::class, 'tipo_servicio_id');
    }

    public function tecnico()
    {
        return $this->belongsTo(Tecnico::class, 'tecnico_id');
    }
}
