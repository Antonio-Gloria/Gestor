@extends('adminlte::page')


@section('css')
<link rel="stylesheet" href="{{asset('build/assets/app.css')}}">

@endsection


@section('content')


    <div class="container">
        <div class="row">
            <h2>Agregar un nuevo técnico</h2>
            <hr>
            <form action="{{ route('tecnicos.store') }}" method="post" enctype="multipart/form-data" class="col-lg-7">
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

                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre') }}" />
                </div>
                <div class="form-group">
                    <label for="apellido">Apellido</label>
                    <input type="text" class="form-control" id="apellido" name="apellido" value="{{ old('apellido') }}" />
                </div>
               <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}">
                </div>
                <div class="form-group">
                    <label for="telefono">Telefono</label>
                    <input type="number" class="form-control" id="telefono" name="telefono" value="{{old('telefono')}}">
                </div>
                <a href="{{ route('tecnicos.index') }}" class="btn btn-danger">Cancelar</a>
                <button type="submit" class="btn btn-success">Agregar nuevo técnico</button>
            </form>
        </div>
    </div>


@endsection
