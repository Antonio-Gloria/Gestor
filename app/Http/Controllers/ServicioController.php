<?php

namespace App\Http\Controllers;

use App\Mail\ServicioSolicitado;
use App\Mail\ServicioRealizado;
use App\Models\Servicio;
use App\Models\Tecnico;
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
       $tecnicos = Tecnico::all();
       return view('servicio.index', compact('servicios', 'tecnicos')); 

    }

    public function realizado()
{
    
    $vs_servicios = Servicio::with('tipoServicio')->where('status', '=', 2)->get();
    $servicios = $this->cargarDT1($vs_servicios);
    return view('servicio.realizado', compact('servicios'));
}

public function realizarServicio(Request $request)
{
    // Buscar el servicio por ID
    $servicio = Servicio::find($request->servicioId);
    if (!$servicio) {
        return redirect()->route('servicios.index')->with('error', 'Servicio no encontrado.');
    }

    // Cambiar el estado del servicio
    $servicio->status = 2;

    // Asignar el técnico al servicio
    $tecnico = Tecnico::find($request->tecnico_id);
    if ($tecnico) {
        $servicio->tecnico_id = $tecnico->id; // Guardar el ID del técnico
    } else {
        return redirect()->route('servicios.index')->with('error', 'Técnico no encontrado.');
    }

    // Guardar la descripción en la tabla servicios
    $servicio->descripcion = $request->descripcion;

    // Guardar el servicio actualizado
    $servicio->save();

    // Verificar si el servicio tiene tipo de servicio asignado
    if ($servicio->tiposervicio) {
        $tipoServicioNombre = $servicio->tiposervicio->nombre;
    } else {
        return redirect()->route('servicios.index')->with('error', 'Tipo de servicio no encontrado.');
    }

    // Preparar los datos para enviar el correo
    $data = [
        'tipo_servicio' => $tipoServicioNombre,
        'nombre_solicitante' => $servicio->nombre_solicitante,
        'apellido_solicitante' => $servicio->apellido_solicitante,
        'fecha' => $servicio->fecha,
        'descripcion' => $servicio->descripcion, // Descripción ahora guardada en la tabla
        'tecnico' => $tecnico->nombre, // Nombre del técnico elegido
    ];

    // Enviar correo con los detalles del servicio realizado
    Mail::to($servicio->email)->send(new ServicioRealizado($data));

    // Redirigir con un mensaje de éxito
    return redirect()->route('servicios.index')->with('message', 'Servicio realizado y correo enviado.');
}


public function infoServicio($id, Request $request)
{
    $servicio = Servicio::with('tipoServicio')->find($id);
    if (!$servicio) {
        return redirect()->route('servicios.index')->with('error', 'El servicio no existe.');
    }

    // Recuperar la descripción de la sesión
    $data = [
        'descripcion' => $request->session()->get('descripcion', 'No hay descripción disponible')
    ];

    return view('servicio.info', compact('servicio', 'data'));
}


public function cargarDT($consulta) //index
{
    $servicios = [];
    foreach ($consulta as $key => $value) {
        $eliminar = route('delete-servicio', $value['id']);
        $info = route('info-servicio', $value['id']);
        $acciones = '
        <div class="btn-acciones">
            <div class="btn-circle">
                <a href="javascript:void(0);" role="button" class="btn btn-outline-success" title="Servicio realizado" data-bs-toggle="modal" data-bs-target="#modalRealizado" onclick="openRealizadoModal(' . $value['id'] . ')">
                    <i class="fas fa-fw fa-check"></i>
                </a>
                <a href="' . $eliminar . '" role="button" class="btn btn-outline-danger" title="Eliminar" >
                    <i class="far fa-trash-alt"></i>
                </a>
                <a href="' . $info . '" role="button" class="btn btn-outline-info" title="Más información">
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
            $value['tipo'],
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
                   <a href="' . $eliminar . '" role="button" class="btn btn-outline-danger" title="Eliminar" >
                    <i class="far fa-trash-alt"></i>
                </a>
                     <a href="' . $info . '" role="button" class="btn btn-outline-info" title="Más información">
                    <i class="fas fa-info"></i>
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

    public function create()
    {
        
        $tipoServicios = TipoServicio::where('status', 1)->get(); 
        return view('servicio.create', compact('tipoServicios'));
    }

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
            'tipo' => 'required|in:Profesor,Alumno',
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
    
        Mail::to($servicio->email)->send(new ServicioSolicitado($servicio));
   
             return redirect()->route('servicios.create')->with(array(
                "message" => "Servicio solicitado exitosamente, se te ha enviado un correo con los datos del servicio que solicitaste"
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

    
}