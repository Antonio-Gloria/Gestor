<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Colaborador;

class ColaboradorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vs_colaboradors = Colaborador::where('status', '=', 1)->get();
       $colaboradors = $this->cargarDT($vs_colaboradors);
       return view('colaborador.index', compact('colaboradors')); 
    }

    public function cargarDT($consulta)
    {
        $colaboradores = [];
        foreach ($consulta as $key => $value) {
            $ruta = "eliminar" . $value['id'];
            $eliminar = route('delete-colaborador', $value['id']);
            $actualizar = route('colaboradors.edit', $value['id']);
            $acciones = '
           <div class="btn-acciones">
               <div class="btn-circle">
                   <a href="' . $actualizar . '" role="button" class="btn btn-outline-success" title="Actualizar">
                       <i class="far fa-edit"></i>
                   </a>
                   
                    <a href="' . $eliminar . '" role="button" class="btn btn-outline-danger"title="Eliminar" onclick="modal('.$value['id'].')" data-bs-toggle="modal" data-bs-target="#exampleModal"">
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
