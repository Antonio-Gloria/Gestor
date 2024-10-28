<?php

namespace App\Http\Controllers;

use App\Models\Tecnico;
use Illuminate\Http\Request;

class TecnicoController extends Controller
{

    public function __construct()
    {
        
        $this->middleware('can:tecnicos.index')->only('index');
        $this->middleware('can:tecnicos.create')->only('create', 'store');
        $this->middleware('can:tecnicos.edit')->only('edit', 'update');
        $this->middleware('can:tecnicos.delete')->only('delete-tecnico');
    }

    public function index()
    {
        $vs_tecnicos = Tecnico::where('status', '=', 1)->get();
        $tecnicos = $this->cargarDT($vs_tecnicos);
        return view('tecnico.index', compact('tecnicos'));
    }

    public function cargarDT($consulta)
    {
        $tecnicos = [];
        foreach ($consulta as $key => $value) {
            $ruta = "eliminar" . $value['id'];
            $eliminar = route('delete-tecnico', $value['id']);
            $actualizar = route('tecnicos.edit', $value['id']);
            $acciones = '
           <div class="btn-acciones">
               <div class="btn-circle">
                   <a href="' . $actualizar . '" role="button" class="btn btn-outline-success" title="Actualizar">
                       <i class="far fa-edit"></i>
                   </a>
                   
                    <a href="' . $eliminar . '" role="button" class="btn btn-outline-danger"title="Eliminar" onclick="modal(' . $value['id'] . ')" data-bs-toggle="modal" data-bs-target="#exampleModal"">
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
    public function create()
    {
        return view('tecnico.create');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'nombre' => 'required',
            'apellido' => 'required',
            'email' => 'required',
            'telefono' => 'required',

        ]);


        $tecnico = new Tecnico();
        $tecnico->nombre = $request->input('nombre');
        $tecnico->apellido = $request->input('apellido');
        $tecnico->email = $request->input('email');
        $tecnico->telefono = $request->input('telefono');
        $tecnico->status = 1;

        $tecnico->save();
        return redirect()->route('tecnicos.index')->with(array(
            'message' => 'El técnico se ha agregado correctamente'
        ));
    }

    public function edit(string $id)
    {
        $tecnico = Tecnico::findOrFail($id);
        return view('tecnico.edit', array(
            'tecnico' => $tecnico
        ));
    }

    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'nombre' => 'required',
            'apellido' => 'required',
            'email' => 'required',
            'telefono' => 'required',
        ]);

        $tecnico = Tecnico::findOrFail($id);
        $tecnico->nombre = $request->input('nombre');
        $tecnico->apellido = $request->input('apellido');
        $tecnico->email = $request->input('email');
        $tecnico->telefono = $request->input('telefono');

        $tecnico->save();
        return redirect()->route('tecnicos.index')->with(array(
            'message' => 'El técnico seleccionado se ha actualizado correctamente'
        ));
    }

    public function delete_tecnico($tecnico_id)
    {
        $tecnico = Tecnico::find($tecnico_id);
        if ($tecnico) {
            $tecnico->status = 0;
            $tecnico->update();
            return redirect()->route('tecnicos.index')->with(array(
                "message" => "El técnico seleccionado se ha eliminado correctamente"
            ));
        } else {
            return redirect()->route('tecnicos.index')->with(array(
                "message" => "El técnico que trata de eliminar no existe"
            ));
        }
    }
}
