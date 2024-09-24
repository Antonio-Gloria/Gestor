@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Solicitud de servicios') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h3>{{ __('Bienvenido al sistema de solicitud servicios') }}</h3>
                   
                    
                    <!-- boton para solicitar servicio -->
                    <a href="{{ route('servicios.create') }}" class="btn btn-primary btn-lg">
                        {{ __('Solicitar un Servicio') }}
                    </a>
                  

                   
                </div>
            </div>
            <div class="card">
                <div class="card-header">{{ __('Gestor de servicios') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h3>{{ __('Bienvenido al sistema gestor de servicios') }}</h3>
                   
                    <a href="{{ route('servicios.index') }}" class="btn btn-primary btn-lg">
                        {{ __('Revisar servicios solicitados') }}
                    </a>

                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
