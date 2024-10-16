@extends('layouts.app1')

@section('content') 
<!-- Contenedor principal con márgenes adecuados -->
<div class="container my-5">
    <div class="row justify-content-center">
        <!-- Mensaje de éxito si hay uno en la sesión -->
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
    </div>

    <!-- Tarjeta centrada para el formulario -->
    <div class="card shadow-lg">
        <div class="card-body">
            <h2 class="text-center mb-4">Solicitar un Servicio</h2>
            <hr>

            <!-- Formulario de solicitud de servicio -->
            <form action="{{ route('servicios.store') }}" method="post" enctype="multipart/form-data" class="px-3">
                @csrf
                @method('POST')

                <!-- Muestra errores en caso de existir -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Tipo de servicio -->
                <div class="form-group mb-3">
                    <label for="tipo_servicio_id" class="form-label">Tipo de servicio</label>
                    <select class="form-control" id="tipo_servicio_id" name="tipo_servicio_id" required>
                        <option value="" disabled selected>Selecciona el tipo de servicio</option>
                        @foreach($tipoServicios as $tipoServicio)
                            <option value="{{ $tipoServicio->id }}">{{ $tipoServicio->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Estado del servicio -->
                <div class="form-group mb-3">
                    <label for="estado" class="form-label">Descripción de lo que necesitas</label>
                    <input type="text" class="form-control" id="estado" name="estado" value="{{ old('estado') }}" required>
                </div>

                <!-- Fecha y hora -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="fecha" class="form-label">Fecha</label>
                        <input type="date" class="form-control" id="fecha" name="fecha" value="{{ old('fecha') }}">
                    </div>
                    <div class="col-md-6">
                        <label for="hora" class="form-label">Hora</label>
                        <input type="time" class="form-control" id="hora" name="hora" value="{{ old('hora') }}">
                    </div>
                </div>

                <!-- Nombre y apellido del solicitante -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="nombre_solicitante" class="form-label">Nombre del solicitante</label>
                        <input type="text" class="form-control" id="nombre_solicitante" name="nombre_solicitante" value="{{ old('nombre_solicitante') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label for="apellido_solicitante" class="form-label">Apellido del solicitante</label>
                        <input type="text" class="form-control" id="apellido_solicitante" name="apellido_solicitante" value="{{ old('apellido_solicitante') }}" required>
                    </div>
                </div>

                <!-- Tipo: Profesor o Alumno -->
                <div class="form-group mb-3">
                    <label class="form-label">Tipo</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="tipo" id="profesor" value="Profesor" required>
                        <label class="form-check-label" for="profesor">Profesor</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="tipo" id="alumno" value="Alumno" required>
                        <label class="form-check-label" for="alumno">Alumno</label>
                    </div>
                </div>

                <!-- Departamento y código -->
                <div class="form-group mb-3">
                    <label for="departamento" class="form-label">Departamento (Carrera)</label>
                    <input type="text" class="form-control" id="departamento" name="departamento" value="{{ old('departamento') }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="codigo" class="form-label">Código</label>
                    <input type="text" class="form-control" id="codigo" name="codigo" placeholder="7 a 9 digitos" value="{{ old('codigo') }}" required>
                </div>

                <!-- Contacto y Email -->
                <div class="form-group mb-3">
                    <label for="contacto" class="form-label">Número de contacto</label>
                    <input type="text" class="form-control" id="contacto" name="contacto" placeholder="Ingresa los 10 digitos" value="{{ old('contacto') }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="email" class="form-label">Correo institucional</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Ej: luis@academicos.udg.mx" value="{{ old('email') }}" required>
                </div>

                <!-- Botones de acción -->
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('home') }}" class="btn btn-outline-danger me-2">Cancelar</a>
                    <button type="submit" class="btn btn-outline-success me-2">Solicitar servicio</button>
                    <div class="back-link">
                        <a href="http://www.cucsh.udg.mx/" class="btn btn-outline-dark me-2">Ir a CUCSH</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        var horaInput = document.getElementById('hora');
        var now = new Date();
        var hours = now.getHours().toString().padStart(2, '0');
        var minutes = now.getMinutes().toString().padStart(2, '0');
        horaInput.value = `${hours}:${minutes}`;
        horaInput.readOnly=true;
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var fechaInput = document.getElementById('fecha');
        var today = new Date().toISOString().split('T')[0];
        fechaInput.value = today;
        fechaInput.readOnly = true;
    });
</script>
@endsection
