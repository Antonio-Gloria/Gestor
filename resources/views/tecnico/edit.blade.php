@extends('adminlte::page')

@section('content')
    <div class="container mt-5">
        <div class="row mb-4">
            <div class="col-12">
                <h2>Editar Técnico</h2>
                <hr>
            </div>
        </div>

        <div class="card shadow">
            <div class="card-body">
                <form action="{{ route('tecnicos.update', $tecnico->id) }}" method="POST" enctype="multipart/form-data" class="col-lg-7">
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
                        <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $tecnico->nombre }}" required>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="apellido">Apellido</label>
                        <input type="text" class="form-control" id="apellido" name="apellido" value="{{ $tecnico->apellido }}" required>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $tecnico->email }}" required>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="telefono">Teléfono</label>
                        <input type="text" class="form-control" id="telefono" name="telefono" value="{{ $tecnico->telefono }}" required>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('tecnicos.index') }}" class="btn btn-outline-danger">Cancelar</a>
                        <button type="submit" class="btn btn-outline-success">Actualizar Datos del Técnico</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
