<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // roles
        $admin = Role::create(['name' => 'Admin']);
        $colaborador = Role::create(['name' => 'Colaborador']);

        // permisos
        Permission::create(['name' => 'home']);
        Permission::create(['name' => 'servicios.index'])->syncRoles($admin, $colaborador);
        Permission::create(['name' => 'servicios.store'])->syncRoles($admin, $colaborador);
        Permission::create(['name' => 'servicios.show'])->syncRoles($admin, $colaborador);
        Permission::create(['name' => 'servicios.edit'])->syncRoles($admin, $colaborador);
        Permission::create(['name' => 'servicios.update'])->syncRoles($admin);
        Permission::create(['name' => 'servicios.destroy'])->syncRoles($admin);
        Permission::create(['name' => 'tiposervicios.index'])->syncRoles($admin);
        Permission::create(['name' => 'tiposervicios.create'])->syncRoles($admin);
        Permission::create(['name' => 'tiposervicios.edit'])->syncRoles($admin);
        Permission::create(['name' => 'tiposervicios.destroy'])->syncRoles($admin);
        Permission::create(['name' => 'tecnicos.index'])->syncRoles($admin);
        Permission::create(['name' => 'tecnicos.create'])->syncRoles($admin);
        Permission::create(['name' => 'tecnicos.edit'])->syncRoles($admin);
        Permission::create(['name' => 'tecnicos.destroy'])->syncRoles($admin);
        Permission::create(['name' => 'realizado-servicio'])->syncRoles($admin, $colaborador);
        Permission::create(['name' => 'delete-servicio'])->syncRoles($admin);
        Permission::create(['name' => 'info-servicio'])->syncRoles($admin);
        Permission::create(['name' => 'realizar-servicio'])->syncRoles($admin, $colaborador);
        Permission::create(['name' => 'users.dashboard'])->syncRoles($admin);
        Permission::create(['name' => 'users.index'])->syncRoles($admin);
        Permission::create(['name' => 'users.create'])->syncRoles($admin);
        Permission::create(['name' => 'users.edit'])->syncRoles($admin);
        Permission::create(['name' => 'users.delete'])->syncRoles($admin);
        Permission::create(['name' => 'assign.roles'])->syncRoles($admin);

    }
}
