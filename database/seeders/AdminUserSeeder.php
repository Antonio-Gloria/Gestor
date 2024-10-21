<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Asegúrate de que el rol Admin exista
        $role = Role::findByName('Admin');

        // Crea un nuevo usuario
        $user = User::create([
            'name' => 'Daniel Antonio',
            'email' => 'elafrox1991@gmail.com',  // Cambia el correo electrónico
            'password' => bcrypt('1234567'), // Cambia la contraseña
        ]);

        // Asigna el rol Admin al nuevo usuario
        $user->assignRole($role);
    }
}
