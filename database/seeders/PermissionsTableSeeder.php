<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            
            ['name' => 'editar_citas', 'description' => 'Permiso para editar citas'],
            ['name' => 'eliminar_citas', 'description' => 'Permiso para eliminar citas'],
            ['name' => 'ver_medicos', 'description' => 'Permiso para ver médicos'],
            ['name' => 'crear_medicos', 'description' => 'Permiso para crear médicos'],
            ['name' => 'editar_medicos', 'description' => 'Permiso para editar médicos'],
            ['name' => 'eliminar_medicos', 'description' => 'Permiso para eliminar médicos'],
            ['name' => 'ver_pacientes', 'description' => 'Permiso para ver pacientes'],
            ['name' => 'crear_pacientes', 'description' => 'Permiso para crear pacientes'],
            ['name' => 'editar_pacientes', 'description' => 'Permiso para editar pacientes'],
            ['name' => 'eliminar_pacientes', 'description' => 'Permiso para eliminar pacientes'],
            ['name' => 'ver_administradores', 'description' => 'Permiso para ver administradores'],
            ['name' => 'crear_administradores', 'description' => 'Permiso para crear administradores'],
            ['name' => 'editar_administradores', 'description' => 'Permiso para editar administradores'],
            ['name' => 'eliminar_administradores', 'description' => 'Permiso para eliminar administradores'],
            ['name' => 'ver_secretarias', 'description' => 'Permiso para ver secretarias'],
            ['name' => 'crear_secretarias', 'description' => 'Permiso para crear secretarias'],
            ['name' => 'editar_secretarias', 'description' => 'Permiso para editar secretarias'],
            ['name' => 'eliminar_secretarias', 'description' => 'Permiso para eliminar secretarias'],
            ['name' => 'asignar_roles', 'description' => 'Permiso para asignar roles'],
            ['name' => 'ver_roles', 'description' => 'Permiso para ver roles'],
            ['name' => 'crear_roles', 'description' => 'Permiso para crear roles'],
            ['name' => 'editar_roles', 'description' => 'Permiso para editar roles'],
            ['name' => 'eliminar_roles', 'description' => 'Permiso para eliminar roles'],
            ['name' => 'ver_permisos', 'description' => 'Permiso para ver permisos'],
            ['name' => 'crear_permisos', 'description' => 'Permiso para crear permisos'],
            ['name' => 'editar_permisos', 'description' => 'Permiso para editar permisos'],
            ['name' => 'eliminar_permisos', 'description' => 'Permiso para eliminar permisos']      
            // Agrega más permisos según necesites
        ];

        // Insertar permisos masivos
        foreach ($permissions as $permission) {
            Permission::create($permission);
        }

        // Insertar permisos adicionales para probar la paginación
        for ($i = 1; $i <= 100; $i++) {
            Permission::create([
                'name' => 'permiso_' . $i,
                'description' => 'Descripción del permiso ' . $i,
            ]);
        }
    }
}

