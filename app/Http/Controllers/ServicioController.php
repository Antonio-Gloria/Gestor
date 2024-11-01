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

    public function __construct()
    {
        $this->middleware('can:servicios.index')->only('index');
        $this->middleware('can:servicios.edit')->only('edit', 'update');
        $this->middleware('can:delete-servicio')->only('delete_servicio');
        $this->middleware('can:realizado-servicio')->only('realizadoServicio');
        $this->middleware('can:delete-servicio')->only('deleteServicio');
        $this->middleware('can:info-servicio')->only('infoServicio');
        $this->middleware('can:realizar-servicio')->only('realizarServicio');

    }
    public function index()
    {

        $consulta = Servicio::with('tipoServicio')->where('status', '=', 1)->get();
        $servicios = $this->cargarDT($consulta, 'index');
        $tecnicos = Tecnico::all();
        return view('servicio.index', compact('servicios', 'tecnicos'));
    }

    public function realizado()
    {

        $consulta = Servicio::with('tipoServicio')->where('status', '=', 2)->get();
        $servicios = $this->cargarDT($consulta, 'realizado');
        return view('servicio.realizado', compact('servicios'));
    }

    public function realizarServicio(Request $request)
    {
        $servicio = Servicio::find($request->servicioId);
        if (!$servicio) {
            return redirect()->route('servicios.index')->with('error', 'Servicio no encontrado.');
        }
        $servicio->status = 2;

        $tecnico = Tecnico::find($request->tecnico_id);
        if ($tecnico) {
            $servicio->tecnico_id = $tecnico->id;
        } else {
            return redirect()->route('servicios.index')->with('error', 'Técnico no encontrado.');
        }

        $servicio->descripcion = $request->descripcion;
        $servicio->fechaRealizado = now();
        
        $servicio->save();

        if ($servicio->tiposervicio) {
            $tipoServicioNombre = $servicio->tiposervicio->nombre;
        } else {
            return redirect()->route('servicios.index')->with('error', 'Tipo de servicio no encontrado.');
        }

        $data = [
            'tipo_servicio' => $tipoServicioNombre,
            'nombre_solicitante' => $servicio->nombre_solicitante,
            'apellido_solicitante' => $servicio->apellido_solicitante,
            'fecha' => $servicio->fecha,
            'descripcion' => $servicio->descripcion,
            'tecnico' => $tecnico->nombre,
            'fechaRealizado' => $servicio->fechaRealizado,
        ];

        Mail::to($servicio->email)->send(new ServicioRealizado($data));
        return redirect()->route('servicios.index')->with('message', 'Servicio realizado y correo enviado.');
    }

    public function infoServicio($id, Request $request)
    {
        $servicio = Servicio::with('tipoServicio')->find($id);
        if (!$servicio) {
            return redirect()->route('servicios.index')->with('error', 'El servicio no existe.');
        }

        $data = [
            'descripcion' => $request->session()->get('descripcion', 'No hay descripción disponible')
        ];

        return view('servicio.info', compact('servicio', 'data'));
    }

    public function cargarDT($consulta, $modo)
    {
        $servicios = [];
        foreach ($consulta as $key => $value) {
            // rutas
            $ruta = "eliminar" . $value['id'];
            $eliminar = route('delete-servicio', $value['id']);
            $info = route('info-servicio', $value['id']);

            if ($modo === 'index') {

                $acciones = '
            <div class="btn-acciones">
                <div class="btn-circle">
                    <a href="javascript:void(0);" role="button" class="btn btn-outline-success" title="Servicio realizado" data-bs-toggle="modal" data-bs-target="#modalRealizado" onclick="openRealizadoModal(' . $value['id'] . ')">
                        <i class="fas fa-fw fa-check"></i>
                    </a>
                    <a href="' . $eliminar . '" role="button" class="btn btn-outline-danger" title="Eliminar" onclick="modal(' . $value['id'] . ')" data-bs-toggle="modal" data-bs-target="#exampleModal"">
                        <i class="far fa-trash-alt"></i>
                    </a>
                    <a href="' . $info . '" role="button" class="btn btn-outline-info" title="Más información">
                        <i class="fas fa-fw fa-info"></i>
                    </a>
                </div>
            </div>
            ';
            } elseif ($modo === 'realizado') {

                $acciones = '
            <div class="btn-acciones">
                <div class="btn-circle">
                    <a href="' . $eliminar . '" role="button" class="btn btn-outline-danger" title="Eliminar" onclick="modal(' . $value['id'] . ')" data-bs-toggle="modal" data-bs-target="#exampleModal"">
                        <i class="far fa-trash-alt"></i>
                    </a>
                    <a href="' . $info . '" role="button" class="btn btn-outline-info" title="Más información">
                        <i class="fas fa-info"></i>
                    </a>
                </div>
            </div>
            ';
            }

            $servicios[$key] = array(
                $acciones,
                $value['id'],
                $value->tipoServicio->nombre,
                $value['fecha'],
                $value['hora'],
                $value['nombre_solicitante'],
                $value['apellido_solicitante'],

            );

            if ($modo !== 'index') {
                $servicios[$key][] = $value['fechaRealizado'];
            }

            if ($modo === 'index') {
                $servicios[$key][] = $value['tipo'];
            }
        }
        return $servicios;
    }

    public function create()
    {

        $tipoServicios = TipoServicio::where('status', 1)->get();
        return view('servicio.create', compact('tipoServicios'));
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'tipo_servicio_id' => 'required|exists:tipo_servicios,id',
            'fecha' => 'required',
            'hora' => 'required',
            'estado' => 'required',
            'nombre_solicitante' => 'required',
            'apellido_solicitante' => 'required',
            'departamento' => 'required',
            'codigo' => 'required|min:7|max:9',
            'contacto' => 'required|digits:10',
            'tipo' => 'required|in:Profesor,Alumno',
            'email' => [
                'required',
                'email',
                //'regex:/^[a-zA-Z0-9._%+-]+@(academicos|alumnos)\.udg\.mx$/'
            ],

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
