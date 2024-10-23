<?php

namespace App\Http\Controllers;

use App\Models\TipoServicio;
use Illuminate\Http\Request;

class TipoServicioController extends Controller
{

    public function __construct()
    {
        
        $this->middleware('can:tiposervicios.index')->only('index');
        $this->middleware('can:tiposervicios.create')->only('create', 'store');
        $this->middleware('can:tiposervicios.edit')->only('edit', 'update');
        $this->middleware('can:tiposervicios.delete')->only('delete-tiposervicio');
    }

    public function index()
    {
        $vs_tiposervicios = TipoServicio::where('status', '=', 1)->get();
        $tiposervicios = $this->cargarDT($vs_tiposervicios);
        return view('tiposervicio.index', compact('tiposervicios'));
    }

    public function cargarDT($consulta)
    {
        $tiposervicios = [];
        foreach ($consulta as $key => $value) {
            $ruta = "eliminar" . $value['id'];
            $eliminar = route('delete-tiposervicio', $value['id']);
            $actualizar = route('tiposervicios.edit', $value['id']);
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


            $tiposervicios[$key] = array(
                $acciones,
                $value['id'],
                $value['nombre'],
                $value['descripcion'],

            );
        }

        return $tiposervicios;
    }

    public function create()
    {
        return view('tiposervicio.create');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'nombre' => 'required',
            'descripcion' => 'required',

        ]);


        $tiposervicio = new TipoServicio();
        $tiposervicio->nombre = $request->input('nombre');
        $tiposervicio->descripcion = $request->input('descripcion');
        $tiposervicio->status = 1;

        $tiposervicio->save();
        return redirect()->route('tiposervicios.index')->with(array(
            'message' => 'El tipo de servicio se ha subido correctamente'
        ));
    }

    public function edit(string $id)
    {
        $tiposervicio = TipoServicio::findOrFail($id);
        return view('tiposervicio.edit', array(
            'tiposervicio' => $tiposervicio
        ));
    }

    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'nombre' => 'required',
            'descripcion' => 'required',
        ]);

        $tiposervicio = TipoServicio::findOrFail($id);
        $tiposervicio->nombre = $request->input('nombre');
        $tiposervicio->descripcion = $request->input('descripcion');
        $tiposervicio->save();
        return redirect()->route('tiposervicios.index')->with(array(
            'message' => 'El tipo de servicio seleccionado se ha actualizado correctamente'
        ));
    }

    public function delete_tiposervicio($tiposervicio_id)
    {
        $tiposervicio = TipoServicio::find($tiposervicio_id);
        if ($tiposervicio) {
            $tiposervicio->status = 0;
            $tiposervicio->update();
            return redirect()->route('tiposervicios.index')->with(array(
                "message" => "El tipo de servicio seleccionado se ha eliminado correctamente"
            ));
        } else {
            return redirect()->route('tiposervicios.index')->with(array(
                "message" => "El tipo de servicio que trata de eliminar no existe"
            ));
        }
    }
}
