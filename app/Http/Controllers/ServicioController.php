<?php

namespace App\Http\Controllers;

use App\Mail\ServicioSolicitado;
use App\Models\Servicio;
use App\Models\TipoServicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
//Muestra los registros de la tabla
       $vs_servicios = Servicio::with( 'tipoServicio')->where('status', '=', 1)->get();
       $servicios = $this->cargarDT($vs_servicios);
       return view('servicio.index', compact('servicios')); 

    }

    public function realizado()
{
    // Muestra los registros de la tabla con la relación 'tipoServicio' cargada
    $vs_servicios = Servicio::with('tipoServicio')->where('status', '=', 2)->get();
    $servicios = $this->cargarDT1($vs_servicios);
    return view('servicio.realizado', compact('servicios'));
}

    public function infoServicio($id)
{
    // Obtener el servicio seleccionado usando el ID
    $servicio = Servicio::with('tipoServicio')->find($id);
    
    // Verificar si el servicio existe
    if (!$servicio) {
        return redirect()->route('servicios.index')->with('error', 'El servicio no existe.');
    }

    // Retornar la vista con la información del servicio
    return view('servicio.info', compact('servicio'));
}





public function cargarDT($consulta) //index
{
    $servicios = [];
    foreach ($consulta as $key => $value) {
        $ruta = "eliminar" . $value['id'];
        $eliminar = route('delete-servicio', $value['id']);
        $realizado = route('realizado-servicio', $value['id']);
        $info = route('info-servicio', $value['id']);
        $acciones = '
            <div class="btn-acciones">
                <div class="btn-circle">
                    <a href="' . $realizado . '" role="button" class="btn btn-success" title="Servicio realizado">
                        <i class="fas fa-fw fa-check"></i>
                    </a>
                    <a href="' . $eliminar . '" role="button" class="btn btn-danger" title="Eliminar" onclick="modal(' . $value['id'] . ')" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="far fa-trash-alt"></i>
                    </a>
                    <a href="' . $info . '" role="button" class="btn btn-info" title="Más información" onclick="modal(' . $value['id'] . ')" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="fas fa-fw fa-info"></i>
                    </a>
                </div>
            </div>
        ';

        $servicios[$key] = array(
            $acciones,
            $value['id'],
            $value->tipoServicio->nombre,
            $value['fecha'],
            $value['hora'],
            $value['nombre_solicitante'],
            $value['apellido_solicitante'],
        );
    }

    return $servicios;
}

public function cargarDT1($consulta)   //realizado
{
    $servicios = [];
    foreach ($consulta as $key => $value) {
        $ruta = "eliminar" . $value['id'];
        $eliminar = route('delete-servicio', $value['id']);
        $info = route('info-servicio', $value['id']);
        $acciones = '
            <div class="btn-acciones">
                <div class="btn-circle">
                    
                    <a href="' . $eliminar . '" role="button" class="btn btn-danger" title="Eliminar" onclick="modal(' . $value['id'] . ')" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="far fa-trash-alt"></i>
                    </a>
                    <a href="' . $info . '" role="button" class="btn btn-info" title="Más información" onclick="modal(' . $value['id'] . ')" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="fas fa-fw fa-info"></i>
                    </a>
                </div>
            </div>
        ';

        $servicios[$key] = array(
            $acciones,
            $value['id'],
            $value->tipoServicio->nombre,
            $value['fecha'],
            $value['hora'],
            $value['nombre_solicitante'],
            $value['apellido_solicitante'],
        );
    }

    return $servicios;
}
  
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $tipoServicios = TipoServicio::where('status', 1)->get(); 
        return view('servicio.create', compact('tipoServicios'));
    }

    /**
     * Store a newly created resource in storage.
     */
      
    Public function store(Request $request)
    {
        //validación de campos requeridos
        $this->validate($request, [
            'tipo_servicio_id' => 'required|exists:tipo_servicios,id',
            'fecha' => 'required',
            'hora' => 'required',
            'estado' => 'required',
            'nombre_solicitante' => 'required',
            'apellido_solicitante' => 'required',
            'departamento' => 'required',
            'codigo' => 'required',
            'contacto' => 'required',
            'tipo' => 'required',
            'email' => 'required|email', 
        ]);
    
        $servicio = new Servicio();
        $servicio->tipo_servicio_id = $request->input('tipo_servicio_id');
        $servicio->fecha = $request->input('fecha');
        $servicio->hora = $request->input('hora');
        $servicio->estado = $request->input('estado');
        $servicio->nombre_solicitante = $request->input('nombre_solicitante');
        $servicio->apellido_solicitante = $request->input('apellido_solicitante');
        $servicio->departamento = $request->input('departamento');
        $servicio->codigo = $request->input('codigo');
        $servicio->contacto = $request->input('contacto');
        $servicio->tipo = $request->input('tipo');
        $servicio->email = $request->input('email');
        $servicio->status = 1;
    
        $servicio->save();
    
        // Enviar el correo de confirmación
        Mail::to($servicio->email)->send(new ServicioSolicitado($servicio));
   
             return redirect()->route('servicios.create')->with(array(
                "message" => "Servicio solicitado exitosamente, se te ha enviado un correo con tu servicio solicitado"
        ));
    }
    
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function delete_servicio($servicio_id)
    {
        $servicio = Servicio::find($servicio_id);
        if ($servicio) {
            $servicio->status = 0;
            $servicio->update();
            return redirect()->route('servicios.index')->with(array(
                "message" => "Servicio eliminado"
            ));
        } else {
            return redirect()->route('servicios.index')->with(array(
                "message" => "Este servicio ya no existe"
            ));
        }
        
    }

    public function realizado_servicio($servicio_id)
    {
        $servicio = Servicio::find($servicio_id);
        if ($servicio) {
            $servicio->status = 2;
            $servicio->update();
            return redirect()->route('servicios.index')->with(array(
                "message" => "Servicio realizado"
            ));
        } else {
            return redirect()->route('servicios.index')->with(array(
                "message" => "Este servicio ya no existe"
            ));
        }
    }
}