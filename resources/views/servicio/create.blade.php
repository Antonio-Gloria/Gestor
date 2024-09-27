@extends('adminlte::page') 
<!-- Extiende la plantilla de AdminLTE. Esto es una plantilla base para el panel de administración -->

@section('content') 
<!-- Inicia la sección de contenido que se ubicará en la vista extendida -->
<div class="row">
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
</div>


    <div class="container-sm">
        <!-- Crea un contenedor pequeño para que el contenido esté centrado y con márgenes adecuados -->
        <div class="container-fluid">
            <div></div> <!-- Div vacío, tal vez reservado para algún futuro contenido o diseño -->
            <h2>Solicitar un servicio</h2> <!-- Título principal de la página -->
            <hr> <!-- Línea horizontal que separa el título del contenido -->

            <!-- Formulario para solicitar un nuevo servicio -->
            <form action="{{ route('servicios.store') }}" method="post" enctype="multipart/form-data" class="col-lg-7">
                @csrf 
                <!-- Protege el formulario contra ataques CSRF (Cross-Site Request Forgery) -->
                @method('POST') 
                <!-- Define el método POST para enviar datos del formulario -->

                <!-- Muestra errores si hay alguno en el formulario -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            <!-- Recorre los errores y los muestra en una lista -->
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Campo para seleccionar el tipo de servicio -->
                <div class="form-group">
                    <label for="tipo_servicio_id">Tipo de servicio</label>
                    <select class="form-control" id="tipo_servicio_id" name="tipo_servicio_id" required>
                        <option value="" disabled selected>Selecciona el tipo de servicio que necesitas</option>
                        @foreach($tipoServicios as $tipoServicio)
                            <!-- Recorre los tipos de servicios disponibles y crea una opción para cada uno -->
                            <option value="{{ $tipoServicio->id }}">{{ $tipoServicio->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="estado">Estado del servicio solicitado</label>
                    <input type="text" class="form-control" id="estado" name="estado" value="{{ old('estado') }}" />
                </div>
                <!-- Campos para ingresar fecha y hora -->
                <div class="container px-4 text-center">
                    <div class="row gx-5">
                      <div class="col">
                        <!-- Campo para la fecha del servicio -->
                        <div class="p-1 border bg-dark">Fecha</div>
                        <input type="date" class="form-control" id="fecha" name="fecha" value="{{ old('fecha') }}" />
                      </div>
                      <div class="col">
                        <!-- Campo para la hora del servicio -->
                        <div class="p-1 border bg-dark">Hora</div>
                        <input type="time" class="form-control" id="hora" name="hora" value="{{ old('hora') }}" />
                      </div>
                    </div>
                </div>
                <div class="container px-4 text-center">
                    <div class="row gx-5">
                      <div class="col">
                        <!-- Campo para el nombre del solicitante -->
                        <div class="p-1 border bg-dark">Nombre del solicitante</div>
                        <input type="text" class="form-control" id="nombre_solicitante" name="nombre_solicitante" value="{{ old('nombre_solicitante') }}" />
                      </div>
                      <div class="col">
                        <!-- Campo para el apellido del solicitante -->
                        <div class="p-1 border bg-dark">Apellido del solicitante</div>
                        <input type="text" class="form-control" id="apellido_solicitante" name="apellido_solicitante" value="{{ old('apellido_solicitante') }}" />
                      </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="tipo">Tipo</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="tipo" id="profesor" value="Profesor" required>
                        <label class="form-check-label" for="profesor">
                            Profesor
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="tipo" id="alumno" value="Alumno" required>
                        <label class="form-check-label" for="alumno">
                            Alumno
                        </label>
                    </div>
                </div> 
                <div class="form-group">
                    <label for="departamento">Departamento (Carrera)</label>
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
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required />
                </div>
                
                <!-- Botones de acción: cancelar y agregar nuevo servicio -->
                <a href="{{ route('home') }}" type="submit" class="btn btn-danger">Cancelar</a>
                <button type="submit" class="btn btn-success">Solicitar servicio</button>
               
                
            </form> <!-- Cierre del formulario -->

        </div>
    </div>

    <!-- Script para establecer automáticamente la hora actual en el campo 'hora' -->
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
            
            // Establecer el valor del campo de entrada de la hora con la hora actual
            horaInput.value = currentTime;
            
        });
    </script>

@endsection
