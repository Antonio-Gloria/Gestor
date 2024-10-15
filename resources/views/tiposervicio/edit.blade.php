@extends('adminlte::page')

@section('content')
    <div class="container mt-5">
        <div class="row mb-4">
            <div class="col-12">
                <h2>Editar Tipo de Servicio</h2>
                <hr>
            </div>
        </div>

        <div class="card shadow">
            <div class="card-body">
                <form action="{{ route('tiposervicios.update', $tiposervicio->id) }}" method="POST"
                    enctype="multipart/form-data" class="col-lg-7">
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

                    <div class="form-group mb-3">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre"
                            value="{{ $tiposervicio->nombre }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="descripcion">Descripción</label>
                        <input type="text" class="form-control" id="descripcion" name="descripcion"
                            value="{{ $tiposervicio->descripcion }}" required>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('tiposervicios.index') }}" class="btn btn-outline-danger">Cancelar</a>
                        <button type="submit" class="btn btn-outline-success">Actualizar Tipo de Servicio</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
