@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('build/assets/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

   
@endsection

@section('content')
    <div class="overlay">
        <div class="content me-2">
            <h1>Bienvenido a Servicios CUCSH</h1>
            <p>Aquí puedes realizar una solicitud de servicio de manera rápida y sencilla</p>

            <a href="{{ route('servicios.create') }}" class="btn btn-outline-light me-2">Solicitar un servicio</a>
            <a href="http://www.cucsh.udg.mx/" class="btn btn-outline-light me-2">Ir a CUCSH</a>
        </div>
    </div>
@endsection
