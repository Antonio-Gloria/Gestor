@extends('adminlte::page')

@section('content')

    <div class="container">
        <div class="row">
            <h2>Editar técnico</h2>
            <hr>
            <form action="{{ route('tecnicos.update', $tecnico->id) }}" method="POST" enctype="multipart/form-data" class="col-lg-7">

                <!-- Protección contra ataques ya implementado en laravel  https://www.welivesecurity.com/la-es/2015/04/21/vulnerabilidad-cross-site-request-forgery-csrf/-->
                @csrf
                @method('PUT')


                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $tecnico->nombre }}" />
                </div>
                <div class="form-group">
                    <label for="apellido">Apellido</label>
                    <input type="text" class="form-control" id="apellido" name="apellido" value="{{ $tecnico->apellido }}" />
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ $tecnico->email }}">
                    </div>
                    <div class="form-group">
                        <label for="telefono">Telefono</label>
                        <input type="number" class="form-control" id="telefono" name="telefono" value="{{ $tecnico->telefono }}">
                    </div>
                <a href="{{ route('tiposervicios.index') }}" class="btn btn-danger">Cancelar</a>
                <button type="submit" class="btn btn-success">Actualizar datos del técnico</button>
            </form>
        </div>
    </div>


@endsection
