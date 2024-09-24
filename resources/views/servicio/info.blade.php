@extends('adminlte::page')

@section('css')
<link rel="stylesheet" href="{{asset('build/assets/app.css')}}">
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="{{asset('build/assets/app.js')}}"></script>
@endsection

@section('content')
    <div class="container">
        <h1>Información de Servicios</h1>
        <hr>
        <br>
        <p align="right">
           
            <a href="{{ route('servicios.index') }}" class="btn btn-primary">
                Regresar
            </a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tipo de Servicio</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Estado</th>
                    <th>Solicitante</th>
                    <th>Departamento</th>
                    <th>Código</th>
                    <th>Contacto</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach($servicios as $servicio)
                <tr>
                    <td>{{ $servicio[0] }}</td> <!-- ID Servicio -->
                    <td>{{ $servicio[1] }}</td> <!-- Tipo de Servicio -->
                    <td>{{ $servicio[2] }}</td> <!-- Fecha -->
                    <td>{{ $servicio[3] }}</td> <!-- Hora -->
                    <td>{{ $servicio[4] }}</td> <!-- Estado -->
                    <td>{{ $servicio[5] }}</td> <!-- Solicitante -->
                    <td>{{ $servicio[7] }}</td> <!-- Departamento -->
                    <td>{{ $servicio[8] }}</td> <!-- Código -->
                    <td>{{ $servicio[9] }}</td> <!-- Contacto -->
                    <td>{{ $servicio[11] }}</td> <!-- Email -->
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
