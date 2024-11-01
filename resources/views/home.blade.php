@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('build/assets/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
   

   
@endsection

@section('content')
@if (Route::has('login'))
<nav class="-mx-3 flex flex-1 justify-end">
    @auth
        <a href="{{ url('servicios') }}"
            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
            Servicios
        </a>
    @else
        <a href="{{ route('login') }}"
            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
            Iniciar sesión
        </a>

       <!-- @if (Route::has('register'))
            <a href="{{ route('register') }}"
                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                Register
            </a>
        @endif -->
    @endauth
</nav>
@endif
    <div class="overlay">
        <div class="content me-2 text-center">
            <h1>Bienvenido a Servicios CUCSH</h1>
            <p>Aquí puedes realizar una solicitud de servicio de manera rápida y sencilla</p>
        
            <div class="d-flex flex-column flex-sm-row justify-content-center gap-2">
                <a href="{{ route('servicios.create') }}" class="btn btn-outline-light">Solicitar un servicio</a>
                <a href="http://www.cucsh.udg.mx/" class="btn btn-outline-light">Ir a CUCSH</a>
            </div>
        </div>
        
    </div>
@endsection
