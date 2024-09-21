@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Menú de Inicio') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h3>{{ __('Bienvenido al Sistema de Servicios') }}</h3>
                   
                    
                    <!-- boton para solicitar servicio -->
                    <a href="{{ route('servicios.create') }}" class="btn btn-primary btn-lg">
                        {{ __('Solicitar un Servicio') }}
                    </a>

                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
