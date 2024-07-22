<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Crear permisos
        $permissions = [
            'ver usuarios',
            'crear usuarios',
            'editar usuarios',
            'eliminar usuarios',
            // Agrega más permisos según sea necesario
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Crear roles y asignar permisos
        $roles = [
            'Administrador' => $permissions,
            'Auditor' => ['ver usuarios'],
            'Auxiliar' => ['ver usuarios', 'crear usuarios'],
            'Medico' => [],
            'Paciente' => [],
            'Secretaria' => ['ver usuarios', 'crear usuarios', 'editar usuarios']
        ];

        foreach ($roles as $role => $rolePermissions) {
            $role = Role::create(['name' => $role]);

            foreach ($rolePermissions as $permission) {
                $role->givePermissionTo($permission);
            }
        }
    }
}
