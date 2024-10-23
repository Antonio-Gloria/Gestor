<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        
        $this->middleware('can:users.index')->only('index');
        $this->middleware('can:users.create')->only('create', 'store');
        $this->middleware('can:users.edit')->only('edit', 'update');
        $this->middleware('can:users.delete')->only('destroy');
        $this->middleware('can:users.dashboard')->only('dashboard');
    }

    public function dashboard()
    {
        return view('dashboard');
    }
    

    public function index()
    {
        $vs_users = User::all();
        $users = $this->cargarDT($vs_users);
        return view('user.index', compact('users'));
    }


    public function cargarDT($consulta)
{
    $usuarios = [];
    foreach ($consulta as $key => $value) {
        $ruta = "eliminar" . $value['id'];
        $eliminar = route('users.destroy', $value['id']);
        $actualizar = route('users.edit', $value['id']);

        $acciones = '
        <div class="btn-acciones">
            <div class="btn-circle">
                <a href="' . $actualizar . '" role="button" class="btn btn-outline-success" title="Actualizar">
                    <i class="far fa-edit"></i>
                </a>
                <a href="' . $eliminar . '" role="button" class="btn btn-outline-danger" title="Eliminar" onclick="modal(' . $value['id'] . ')" data-bs-toggle="modal" data-bs-target="#deleteModal">
                    <i class="far fa-trash-alt"></i>
                </a>
            </div>
        </div>';

        $roles = implode(', ', $value->getRoleNames()->toArray());

        $usuarios[$key] = array(
            $acciones,
            $value['id'],
            $value['name'],
            $value['email'],
            $roles
        );
    }

    return $usuarios;
}


    public function create()
    {
        $this->authorize('users.create'); 
        $roles = Role::all(); 
        return view('user.create', compact('roles'));
    }

    public function store(Request $request)
    {
  
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'role' => 'required|exists:roles,name', 
        ]);

       
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        $user->assignRole($validatedData['role']);

        return redirect()->route('users.index')->with('success', 'Usuario creado exitosamente con el rol de ' . $validatedData['role']);
    }

    public function edit(User $user)
    {
        $this->authorize('users.edit'); 
        $roles = Role::all();
        return view('user.edit', compact('user', 'roles')); 
    }
    
    public function update(Request $request, User $user)
{
    $this->authorize('users.edit'); 

    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'password' => 'nullable|min:8', 
        'role' => 'required|exists:roles,name', 
    ]);

    $user->update([
        'name' => $validatedData['name'],
        'email' => $validatedData['email'],
        'password' => $validatedData['password'] ? bcrypt($validatedData['password']) : $user->password,
    ]);

    $user->syncRoles($validatedData['role']);

    return redirect()->route('users.index')->with('success', 'Usuario actualizado exitosamente'); 
}


    public function destroy(User $user)
    {
        $this->authorize('users.delete'); 
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Usuario eliminado exitosamente');
    }
}
