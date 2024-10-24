@extends('adminlte::page')

@section('content')
    <div class="container mt-5">
        <div class="row mb-4">
            <div class="col-12">
                <h1>Editar usuario</h1>
                <hr>
            </div>
        </div>

        <div class="card shadow">
            <div class="card-body">
                <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data"
                    class="col-lg-7">
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
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" name="password" class="form-control" value="{{ $user->password }}" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="role" class="form-label">Rol</label>
                        <select name="role" class="form-control" required>
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('users.index') }}" class="btn btn-outline-danger">Cancelar</a>
                        <button type="submit" class="btn btn-outline-success">Actualizar Usuario</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
