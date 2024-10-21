@extends('adminlte::page')

@section('content')
    <h1>Crear nuevo usuario</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" name="name" class="form-control" value="{{old('name')}}" required>
        </div>
      
        <div class="form-group">
            <label for="email" class="form-label">Correo Electrónico</label>
            <input type="email" name="email" class="form-control" value="{{old('email')}}" required>
        </div>

        <div class="form-group">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" name="password" class="form-control" value="{{old('password')}}" required>
        </div>

        <div class="form-group">
            <label for="role" class="form-label">Rol</label>
            <select name="role" class="form-control" required>
                @foreach($roles as $role)
                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Crear Usuario</button>
    </form>
@endsection
