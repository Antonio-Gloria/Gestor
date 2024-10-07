@extends('layouts.app1')

@section('css')
<link rel="stylesheet" href="{{ asset('build/assets/app.css') }}">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="content me-0">
    <style >
        body {
            background: url("https://tse4.mm.bing.net/th?id=OIP.AmjCR1h1J_u7lBClC2J0HwAAAA&pid=Api&P=0&h=180") no-repeat center center fixed;
            background-size: contain;
            margin: 0;
            padding: 0;
            
        }

        .overlay {
            background-color: rgba(0, 0, 0, 0.7); /* Filtro negro semitransparente */
            height: 100vh; /* Cubrir la pantalla completa */
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            text-align: center;
        }

        .overlay h1 {
            font-size: 3rem;
            color: #fff;
            margin-bottom: 1rem;
        }

        .overlay p {
            font-size: 1.2rem;
            color: #dcdcdc;
            margin-bottom: 2rem;
        }

        .overlay .btn {
            padding: 10px 30px;
            font-size: 1.1rem;
            border-radius: 50px;
        }

        .btn-light {
            background-color: #fff;
            color: #333;
            border: none;
        }

        .btn-light:hover {
            background-color: #f8f9fa;
            color: #007bff;
        }

        .back-link {
            position: absolute;
            bottom: 20px;
            right: 20px;
        }

        .back-link a {
            font-size: 1rem;
            color: #fff;
        }
    </style>

    <div class="overlay">
        <div class="content me-2">
            <h1>Bienvenido a Servicios CUCSH</h1>
            <p >Aquí puedes realizar una solicitud de servicio de manera rápida y sencilla</p>
            
            <a href="{{ route('servicios.create') }}" class="btn btn-light me-2">Solicitar un servicio</a>
            <a href="http://www.cucsh.udg.mx/" class="btn btn-outline-light me-2">Ir a CUCSH</a>
        </div>
    </div>

   
</div>
@endsection
