@extends('adminlte::page')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Crear un Nuevo Servicio</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('tiposervicios.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre"
                                    value="{{ old('nombre') }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <input type="text" class="form-control" id="descripcion" name="descripcion"
                                    value="{{ old('descripcion') }}" required>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('tiposervicios.index') }}" class="btn btn-outline-danger">Cancelar</a>
                                <button type="submit" class="btn btn-outline-success">Agregar Nuevo Tipo de
                                    Servicio</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
