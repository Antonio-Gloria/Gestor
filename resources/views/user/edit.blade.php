@extends('adminlte::page')

@section('content')
    <h1>Editar usuario</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data" class="col-lg-7">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
        </div>
        
        <div class="form-group">
            <label for="email" class="form-label">Correo Electrónico</label>
            <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
        </div>

        <div class="form-group">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" name="password" class="form-control" value="{{ $user->password }}" required>
        </div>

        <div class="form-group">
            <label for="role" class="form-label">Rol</label>
            <select name="role" class="form-control" required>
                @foreach ($roles as $role)
                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Editar Usuario</button>
    </form>
@endsection
