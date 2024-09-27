<?php

namespace App\Http\Controllers;

use App\Models\Tecnico;
use Illuminate\Http\Request;

class TecnicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//Muestra los registros de la tabla
       $vs_tecnicos = Tecnico::get();
       $tecnicos = $this->cargarDT($vs_tecnicos);
       return view('tecnico.index', compact('tecnicos')); 
    }

    public function cargarDT($consulta)
    {
        $tecnico = [];
        foreach ($consulta as $key => $value) {
            $ruta = "eliminar" . $value['id'];
            $eliminar = route('delete-tecnico', $value['id']);
            $actualizar = route('tecnicos.edit', $value['id']);
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
 
            $tecnicos[$key] = array(
                $acciones,
                $value['id'],
                $value['nombre'],
                $value['apellido'],
                $value['email'],
                $value['telefono'],
               
            );
        }
 
        return $tecnicos;
    }
 
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tecnico.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    Public function store(Request $request)
{
//validación de campos requeridos
$this->validate($request, [
            'nombre' => 'required',
            'apellido' => 'required',
            'email'=> 'required',
            'telefono' => 'required',
           
        ]);


        $tecnico = new Tecnico();
        $tecnico->nombre = $request->input('nombre');
        $tecnico->apellido = $request->input('apellido');
        $tecnico->email = $request->input('email');
        $tecnico->telefono = $request->input('telefono');

        $tecnico->save();
        return redirect()->route('tecnicos.index')->with(array(
            'message' => 'El técnico se ha agregado correctamente'
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
