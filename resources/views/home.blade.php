@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('build/assets/app.css')}}">

@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <!-- Card para la solicitud de servicios -->
            <div class="card mb-4 shadow-sm border-0">
                <div class="card-header bg-primary text-white text-center">
                    <h4>{{ __('Solicitud de Servicios') }}</h4>
                </div>
                <div class="card-body text-center">
                    <p class="lead">{{ __('Bienvenido al sistema de solicitud de servicios') }}</p>

                    <!-- Botón grande y llamativo para solicitar un servicio -->
                    <a href="{{ route('servicios.create') }}" class="btn btn-success btn-lg mt-3">
                        <i class="fas fa-plus-circle"></i> {{ __('Solicitar un Servicio') }}
                    </a>
                </div>
            </div>

            <!-- Card para el gestor de servicios -->
            <div class="card shadow-sm border-0">
                <div class="card-header bg-dark text-white text-center">
                    <h4>{{ __('Gestor de Servicios') }}</h4>
                </div>
                <div class="card-body text-center">
                    <p class="lead">{{ __('Revisa el estado y la información de los servicios solicitados') }}</p>

                    <!-- Botón grande para revisar servicios solicitados -->
                    <a href="{{ route('servicios.index') }}" class="btn btn-info btn-lg mt-3">
                        <i class="fas fa-list"></i> {{ __('Revisar Servicios Solicitados') }}
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
