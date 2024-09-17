<?php

namespace App\Http\Controllers;

use App\Models\TipoServicio;
use Illuminate\Http\Request;

class TipoServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//Muestra los registros de la tabla
       $vs_tiposervicios = TipoServicio::where('status', '=', 1)->get();
       $tiposervicios = $this->cargarDT($vs_tiposervicios);
       return view('tiposervicio.index', compact('tiposervicios')); //->with('tiposervicios', $tiposervicios);


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
                  <a href="' . $actualizar . '" role="button" class="btn btn-success" title="Actualizar">
                      <i class="far fa-edit"></i>
                  </a>
                  
                   <a href="' . $eliminar . '" role="button" class="btn btn-danger"title="Eliminar" onclick="modal('.$value['id'].')" data-bs-toggle="modal" data-bs-target="#exampleModal"">
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



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tiposervicio.create');
    }

    /**
     * Store a newly created resource in storage.
     */
Public function store(Request $request)
{
//validación de campos requeridos
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
        $tiposervicio = TipoServicio::findOrFail($id);
        return view('tiposervicio.edit', array(
            'tiposervicio' => $tiposervicio
        ));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'nombre' => 'required',
            'descripcion' => 'required',
        ]);


        //$user = Auth::user();
        $tiposervicio = TipoServicio::findOrFail($id);
        $tiposervicio->nombre = $request->input('nombre');
        $tiposervicio->descripcion = $request->input('descripcion');
        //$tiposervicio->status = 1;

        $tiposervicio->save();
        return redirect()->route('tiposervicios.index')->with(array(
            'message' => 'El tipo de servicio selleccionado se ha actualizado correctamente'
        ));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function delete_tiposervicio($tiposervicio_id)
    {
        $tiposervicio = TipoServicio::find($tiposervicio_id);
        if ($tiposervicio) {
            $tiposervicio->status = 0;
            $tiposervicio->update();
            return redirect()->route('tiposervicios.index')->with(array(
                "message" => "El tipo de servicio sellecionado se ha eliminado correctamente"
            ));
        } else {
            return redirect()->route('tiposervicios.index')->with(array(
                "message" => "El tipo de servicio que trata de eliminar no existe"
            ));
        }
    }

}
