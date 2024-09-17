<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use App\Models\TipoServicio;
use Illuminate\Http\Request;

class ServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//Muestra los registros de la tabla
       $vs_servicios = Servicio::where('status', '=', 1)->get();
       $servicios = $this->cargarDT($vs_servicios);
       return view('servicio.index', compact('servicios')); 

    }

    public function cargarDT($consulta)
   {
       $servicios = [];
       foreach ($consulta as $key => $value) {
           $ruta = "eliminar" . $value['id'];
           $eliminar = route('delete-servicio', $value['id']);
           $actualizar = route('servicios.edit', $value['id']);
           $acciones = '
          <div class="btn-acciones">
              <div class="btn-circle">
                  <a href="' . $actualizar . '" role="button" class="btn btn-success" title="Actualizar">
                      <i class="far fa-edit"></i>
                  </a>
                  
                   <a href="' . $eliminar . '" role="button" class="btn btn-danger"title="Eliminar" onclick="modal('.$value['id'].')" data-bs-toggle="modal" data-bs-target="#exampleModal"">
                      <i class="far fa-trash-alt"></i>
                  </a>
              </div>
          </div>
';

           $servicios[$key] = array(
               $acciones,
               $value['id'],
               $value['tipo_servicio_id'],
               $value['fecha'],
               $value['hora'],
               $value['estado'],
               //$value['tecnico_id'],
               $value['nombre_solicitante'],
               $value['apellido_solicitante'],
               $value['departamento'],
               $value['codigo'],
               $value['contacto'],
               $value['tipo'],
              
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
                //'tecnico_id' => 'required|exists:tecnico,id',
                'nombre_solicitante' => 'required',
                'apellido_solicitante' => 'required',
                'departamento' => 'required',
                'codigo' => 'required',
                'contacto' => 'required',
                'tipo' => 'required'
            ]);
    
            $servicio = new Servicio();
            //$user = Auth::user();
            //$servicio->user_id = $user->id;
            $servicio->tipo_servicio_id = $request->input('tipo_servicio_id');
            $servicio->fecha = $request->input('fecha');
            $servicio->hora = $request->input('hora');
            $servicio->estado = $request->input('estado');
            //$servicio->tecnico_id = $request->input('tecnico_id');
            $servicio->nombre_solicitante = $request->input('nombre_solicitante');
            $servicio->apellido_solicitante = $request->input('apellido_solicitante');
            $servicio->departamento = $request->input('departamento');
            $servicio->codigo = $request->input('codigo');
            $servicio->contacto = $request->input('contacto');
            $servicio->tipo = $request->input('tipo');
    
            $servicio->status = 1;


            $servicio->save();
            return redirect()->route('servicios.index')->with(array(
                'message' => 'El servicio solicitado se ha agregado'
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
}
