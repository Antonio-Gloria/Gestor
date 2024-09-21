@extends('adminlte::page')

@section('content')

    <div class="container-sm">
        <div class="container-fluid">
            <div></div>
            <h2>Solicitar un nuevo servicio</h2>
            <hr>
            <form action="{{ route('servicios.store') }}" method="post" enctype="multipart/form-data" class="col-lg-7">
                @csrf
                @method('POST')
                <!-- Protección contra ataques ya implementado en laravel  https://www.welivesecurity.com/la-es/2015/04/21/vulnerabilidad-cross-site-request-forgery-csrf/-->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form class="row g-3">

                <div class="form-group">
                    <label for="tipo_servicio_id">Tipo de servicio</label>
                    <select class="form-control" id="tipo_servicio_id" name="tipo_servicio_id" required>
                        <option value="" disabled selected>Selecciona un tipo de servicio</option>
                        @foreach($tipoServicios as $tipoServicio)
                            <option value="{{ $tipoServicio->id }}">{{ $tipoServicio->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                
                <!-- <div class="form-group"> -->

                <!--<div class="form-group">
                    <label for="fecha">Fecha</label>
                    <input type="date" class="form-control" id="fecha" name="fecha" value="{{ old('fecha') }}" />
                </div>
                <div class="form-group">
                    <label for="hora">Hora</label>
                    <input type="time" class="form-control" id="hora" name="hora" value="{{ old('hora') }}" />
                </div> -->
                <div class="container px-4 text-center">
                    <div class="row gx-5">
                      <div class="col">
                       <div class="p-1 border bg-dark">Fecha</div>
                       <input type="date" class="form-control" id="fecha" name="fecha" value="{{ old('fecha') }}" />
                      </div>
                      <div class="col">
                        <div class="p-1 border bg-dark">Hora</div>
                        <input type="time" class="form-control" id="hora" name="hora" value="{{ old('hora') }}" />
                      </div>
                    </div>
                  </div>
                <div class="form-group">
                    <label for="estado">Estado</label>
                    <input type="text" class="form-control" id="estado" name="estado" value="{{ old('estado') }}" />
                </div>
                <div class="container px-4 text-center">
                    <div class="row gx-5">
                      <div class="col">
                       <div class="p-1 border bg-dark">Nombre del solicitante</div>
                       <input type="text" class="form-control" id="nombre_solicitante" name="nombre_solicitante" value="{{ old('nombre_solicitante') }}" />
                      </div>
                      <div class="col">
                        <div class="p-1 border bg-dark">Apellido del solicitante</div>
                        <input type="text" class="form-control" id="apellido_solicitante" name="apellido_solicitante" value="{{ old('apellido_solicitante') }}" />
                      </div>
                    </div>
                  </div>
                <!-- <div class="form-group">
                    <label for="nombre_solicitante">Nombre del solicitante</label>
                    
                </div>
                <div class="form-group">
                    <label for="apellido_solicitante">Apellido del solicitante</label>
                   
                </div> -->
                <div class="form-group">
                    <label for="departamento">Departamento</label>
                    <input type="text" class="form-control" id="departamento" name="departamento" value="{{ old('departamento') }}" />
                </div>
                <div class="form-group">
                    <label for="codigo">Código</label>
                    <input type="text" class="form-control" id="codigo" name="codigo" value="{{ old('codigo') }}" />
                </div>
                <div class="form-group">
                    <label for="contacto">Contacto</label>
                    <input type="text" class="form-control" id="contacto" name="contacto" value="{{ old('contacto') }}" />
                </div>
                <div class="form-group">
                    <label for="tipo">Tipo</label>
                    <input type="text" class="form-control" id="tipo" name="tipo" value="{{ old('tipo') }}" />
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required />
                </div>
                
                <a href="{{ route('home') }}" type="submit" class="btn btn-danger">Cancelar</a>
                <button type="submit" class="btn btn-success">Agregar nuevo servicio</button>
            </form>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            // Obtener el campo de entrada de hora
            var horaInput = document.getElementById('hora');
            
            // Crear un objeto Date para obtener la hora actual
            var now = new Date();
            
            // Formatear la hora en el formato 'HH:MM'
            var hours = now.getHours().toString().padStart(2, '0');
            var minutes = now.getMinutes().toString().padStart(2, '0');
            var currentTime = hours + ':' + minutes;
            
            // Establecer el valor del campo de entrada
            horaInput.value = currentTime;
        });
    </script>

@endsection
