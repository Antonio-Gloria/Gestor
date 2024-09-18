@extends('adminlte::page')

@section('content')

    <div class="container">
        <div class="row">
            <h2>Editar tipo de servicio</h2>
            <hr>
            <form action="{{ route('tiposervicios.update', $tiposervicio->id) }}" method="POST" enctype="multipart/form-data" class="col-lg-7">

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
                    <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $tiposervicio->nombre }}" />
                </div>
                <div class="form-group">
                    <label for="description">Descripción</label>
                    <input type="text" class="form-control" id="descripcion" name="descripcion" value="{{ $tiposervicio->descripcion }}" />
                </div>
               
                <a href="{{ route('tiposervicios.index') }}" class="btn btn-danger">Cancelar</a>
                <button type="submit" class="btn btn-success">Actualizar tipo de servicio</button>
            </form>
        </div>
    </div>


@endsection
