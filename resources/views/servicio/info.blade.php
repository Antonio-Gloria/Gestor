@extends('adminlte::page')

@section('css')
<link rel="stylesheet" href="{{ asset('build/assets/app.css') }}">
@endsection

@section('content')
<div class="row">
    <h2 class="text-center">Información del Servicio</h2>
    <hr>
    <br>
    
    <hr class="my-4">
    
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
                <th>Fecha:</th>
                <td>{{ $servicio->fecha }}</td>
            </tr>
            <tr>
                <th>Hora:</th>
                <td>{{ $servicio->hora }}</td>
            </tr>
            <tr>
                <th>Nombre del Solicitante:</th>
                <td>{{ $servicio->nombre_solicitante }}</td>
            </tr>
            <tr>
                <th>Apellido del Solicitante:</th>
                <td>{{ $servicio->apellido_solicitante }}</td>
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
                </td>
            </tr>
            <tr>
                <th>Descripción:</th>
                <td>{{ $servicio->descripcion ?? 'No hay descripción disponible' }}</td>
            </tr>
        </tbody>
    </table>
    
    
   
</div>
<div>
    <p class="text-right">
        <a href="{{ route('servicios.index') }}" class="btn btn-outline-primary">
            Regresar
        </a>
    </p>
</div>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
@endsection
