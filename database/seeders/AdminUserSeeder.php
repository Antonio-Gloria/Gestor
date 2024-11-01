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
        $role = Role::findByName('Admin');
        
        $user = User::create([
            'name' => 'Daniel Antonio',
            'email' => 'elafrox1991@gmail.com',  
            'password' => bcrypt('1234567'), 
        ]);

        $user->assignRole($role);
    }
}
