<?php

// database/seeders/DatabaseSeeder.php
namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Permmision;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            ['id' => 1, 'name' => 'Gestionar Salas'],
            ['id' => 2, 'name' => 'Agregar Reserva'],
            ['id' => 3, 'name' => 'Gestionar Reservas'],
        ];

        foreach ($permissions as $permission) {
            Permission::create(['id' => $permission['id'], 'name' => $permission['name']]);
        }

        if (!Role::where('name', 'Administrador')->exists()) {
            $admin = Role::create(['id' => 1, 'name' => 'Administrador']);
            $admin->permissions()->attach([1, 2, 3]);
        }

        if (!Role::where('name', 'Cliente')->exists()) {
            $client = Role::create(['id' => 2, 'name' => 'Cliente']);
            $client->permissions()->attach([2]);
        }

        if (!User::where('name', 'administrador')->exists()) {
            User::create([
                'role_id' => 1,
                'name' => 'administrador',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('123456789'),
            ]);
        }
    }
}

