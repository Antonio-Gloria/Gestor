@extends('layouts.app1')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
        </div>

        <div class="card shadow-lg">
            <div class="card-body">
                <h2 class="text-center mb-4">Solicitar un Servicio</h2>
                <hr>

                <form action="{{ route('servicios.store') }}" method="POST" enctype="multipart/form-data" class="px-3">
                    @csrf

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="form-group mb-3">
                        <label for="tipo_servicio_id" class="form-label">Tipo de servicio</label>
                        <select class="form-control" id="tipo_servicio_id" name="tipo_servicio_id" required>
                            <option value="" disabled selected>Selecciona el tipo de servicio</option>
                            @foreach ($tipoServicios as $tipoServicio)
                                <option value="{{ $tipoServicio->id }}">{{ $tipoServicio->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="estado" class="form-label">Descripción de lo que necesitas</label>
                        <input type="text" class="form-control" id="estado" name="estado" value="{{ old('estado') }}"
                            required>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="fecha" class="form-label">Fecha</label>
                            <input type="date" class="form-control" id="fecha" name="fecha"
                                value="{{ old('fecha') }}">
                        </div>
                        <div class="col-md-6">
                            <label for="hora" class="form-label">Hora</label>
                            <input type="time" class="form-control" id="hora" name="hora"
                                value="{{ old('hora') }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nombre_solicitante" class="form-label">Nombre del solicitante</label>
                            <input type="text" class="form-control" id="nombre_solicitante" name="nombre_solicitante"
                                value="{{ old('nombre_solicitante') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="apellido_solicitante" class="form-label">Apellido del solicitante</label>
                            <input type="text" class="form-control" id="apellido_solicitante" name="apellido_solicitante"
                                value="{{ old('apellido_solicitante') }}" required>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label">Tipo</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tipo" id="profesor" value="Profesor"
                                required>
                            <label class="form-check-label" for="profesor">Profesor</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tipo" id="alumno" value="Alumno"
                                required>
                            <label class="form-check-label" for="alumno">Alumno</label>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label for="departamento" class="form-label">Departamento (Carrera)</label>
                        <input type="text" class="form-control" id="departamento" name="departamento"
                            value="{{ old('departamento') }}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="codigo" class="form-label">Código</label>
                        <input type="text" class="form-control" id="codigo" name="codigo" placeholder="7 a 9 dígitos"
                            value="{{ old('codigo') }}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="contacto" class="form-label">Número de contacto</label>
                        <input type="text" class="form-control" id="contacto" name="contacto"
                            placeholder="Ingresa los 10 dígitos" value="{{ old('contacto') }}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="email" class="form-label">Correo institucional</label>
                        <input type="email" class="form-control" id="email" name="email"
                            placeholder="Ej: luis@academicos.udg.mx" value="{{ old('email') }}" required>
                    </div>

                    <div class="d-flex justify-content-between mt-4">
                        <a href="{{ route('home') }}" class="btn btn-outline-danger me-2">Cancelar</a>
                        <button type="submit" class="btn btn-outline-success me-2">Solicitar servicio</button>
                        <a href="http://www.cucsh.udg.mx/" class="btn btn-outline-dark">Ir a CUCSH</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const horaInput = document.getElementById('hora');
            const now = new Date();
            horaInput.value = now.toTimeString().split(' ')[0].substring(0, 5);
            horaInput.readOnly = true;
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fechaInput = document.getElementById('fecha');
            fechaInput.value = new Date().toISOString().split('T')[0];
            fechaInput.readOnly = true;
        });
    </script>
@endsection
