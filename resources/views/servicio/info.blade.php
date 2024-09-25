@extends('adminlte::page')

@section('css')
<link rel="stylesheet" href="{{asset('build/assets/app.css')}}">
@endsection

@section('content')
<div class="container">
    <h1>Información del Servicio</h1>
    <hr>
    <br>
    <table class="table">
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
        <!-- Agregar más información según sea necesario -->
    </table>

    <p align="right">
        <a href="{{ route('servicios.index') }}" class="btn btn-primary">
            Regresar
        </a>
    </p>
</div>
@endsection
