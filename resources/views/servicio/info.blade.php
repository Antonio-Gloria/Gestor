@extends('adminlte::page')

@section('content')
    <div class="row">
        <h2 class="text-center">Información del Servicio</h2>
        <hr>
        <br>
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('servicios.index') }}" class="btn btn-outline-primary me-2">Regresar a servicios</a>
            <a href="{{ route('servicios.realizado') }}" class="btn btn-outline-primary ">Regresar a servicios realizados</a>
        </div>
        <table class="table">
            <tbody>
                <tr>
                    <th>ID:</th>
                    <td>{{ $servicio->id }}</td>
                </tr>
                <tr>
                    <th>Tipo de Servicio:</th>
                    <td>{{ $servicio->tipoServicio->nombre }}</td>
                </tr>
                <tr>
                    <th>Fecha y hora:</th>
                    <td>{{ $servicio->fecha }}, {{ $servicio->hora }}</td>
                </tr>

                <tr>
                    <th>Nombre y apellido del solicitante:</th>
                    <td>{{ $servicio->nombre_solicitante }} {{ $servicio->apellido_solicitante }} </td>
                </tr>
                <tr>
                    <th>Código del solicitante:</th>
                    <td> {{ $servicio->codigo }} </td>
                </tr>
                <tr>
                    <th>Contacto:</th>
                    <td>{{ $servicio->contacto }}</td>
                </tr>
                <tr>
                    <th>Email:</th>
                    <td>{{ $servicio->email }}</td>
                </tr>
                <tr>
                    <th>Tipo:</th>
                    <td>{{ $servicio->tipo }}</td>
                </tr>
                <tr>
                    <th>Técnico:</th>
                    <td>
                        {{ $servicio->tecnico ? $servicio->tecnico->nombre : 'No asignado' }}
                        {{ $servicio->tecnico ? $servicio->tecnico->apellido : '' }}
                    </td>
                </tr>
                <tr>
                    <th>Descripción:</th>
                    <td>{{ $servicio->descripcion ?? 'No hay descripción disponible' }}</td>
                </tr>
                <tr>
                    <th>Fecha de realización</th>
                    <td>{{ $servicio->fechaRealizado ?? 'No se ha realizado'}} </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
