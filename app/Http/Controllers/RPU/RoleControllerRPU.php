<?php

namespace App\Http\Controllers\RPU;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleControllerRPU extends Controller
{
    public function index()
    {
        $roles = Role::with('permissions')->get();
        return view('rpu.roles.index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('rpu.roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'required|array|exists:permissions,id'
        ]);

        $role = Role::create(['name' => $request->name]);

        // Obtener solo los permisos válidos
        $validPermissions = Permission::whereIn('id', $request->permissions)->get();

        $role->syncPermissions($validPermissions);

        return redirect()->route('roles.index')->with('success', 'Rol creado exitosamente.');
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('rpu.roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
            'permissions' => 'required|array|exists:permissions,id'
        ]);

        $role->update(['name' => $request->name]);

        // Obtener solo los permisos válidos
        $validPermissions = Permission::whereIn('id', $request->permissions)->get();

        $role->syncPermissions($validPermissions);

        return redirect()->route('roles.index')->with('success', 'Rol actualizado exitosamente.');
    }

    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Rol eliminado exitosamente.');
    }
}
