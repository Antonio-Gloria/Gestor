<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        // Solo el admin puede gestionar usuarios
        
        
       
    }

    public function index()
    {
        // Mostrar todos los usuarios
        $users = User::all();
        return view('user.index', compact('users'));
    }

    public function create()
    {
        $this->authorize('users.create'); // Verifica si el usuario tiene el permiso
        $roles = Role::all(); // Obtén todos los roles para el formulario
        return view('user.create', compact('roles'));
    }

    

    public function store(Request $request)
    {
        // Validación
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'role' => 'required|exists:roles,name', // Asegurarse de que el rol existe
        ]);

        // Crear el usuario
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        // Asignar el rol seleccionado al usuario
        $user->assignRole($validatedData['role']);

        return redirect()->route('users.index')->with('success', 'Usuario creado exitosamente con el rol de ' . $validatedData['role']);
    }

    public function edit(User $user)
    {
        $this->authorize('users.edit'); // Verifica si el usuario tiene el permiso para editar
        $roles = Role::all(); // Obtén todos los roles para el formulario
        return view('user.edit', compact('user', 'roles')); // Cambié 'users' a 'user'
    }
    

    public function update(Request $request, User $user)
{
    $this->authorize('users.edit'); // Verifica si el usuario tiene el permiso para editar

    // Validar los datos del formulario
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'password' => 'nullable|min:8', // Solo actualizar la contraseña si se proporciona
        'role' => 'required|exists:roles,name', // Validar que el rol existe
    ]);

    // Actualizar datos del usuario
    $user->update([
        'name' => $validatedData['name'],
        'email' => $validatedData['email'],
        'password' => $validatedData['password'] ? bcrypt($validatedData['password']) : $user->password,
    ]);

    // Sincronizar el rol del usuario
    $user->syncRoles($validatedData['role']);

    // Redirigir a la lista de usuarios con un mensaje de éxito
    return redirect()->route('users.index')->with('success', 'Usuario actualizado exitosamente'); // Cambié 'user.index' a 'users.index'
}


    public function destroy(User $user)
    {
        $this->authorize('users.delete'); // Verifica si el usuario tiene el permiso para eliminar
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Usuario eliminado exitosamente');
    }
}
