<?php

// namespace App\Http\Controllers\RPU;

// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use Spatie\Permission\Models\Permission;

// class PermissionControllerRPU extends Controller
// {
//     public function index()
//     {
//         $permissions = Permission::all();
//         return view('rpu.permissions.index.permissions.RPU', compact('permissions'));
//     }

//     public function create()
//     {
//         return view('rpu.permissions.create.permissions.RPU');
//     }

//     public function store(Request $request)
//     {
//         $request->validate([
//             'name' => 'required|unique:permissions,name',
//             'description' => 'nullable',
//         ]);

//         Permission::create($request->only('name', 'description'));

//         return redirect()->route('permissions.index')->with('success', 'Permiso creado exitosamente.');
//     }

//     public function edit(Permission $permission)
//     {
//         return view('rpu.permissions.edit.permissions.RPU', compact('permission'));
//     }

//     public function update(Request $request, Permission $permission)
//     {
//         $request->validate([
//             'name' => 'required|unique:permissions,name,' . $permission->id,
//             'description' => 'nullable',
//         ]);

//         $permission->update($request->only('name', 'description'));

//         return redirect()->route('permissions.index')->with('success', 'Permiso actualizado exitosamente.');
//     }

//     public function destroy(Permission $permission)
//     {
//         $permission->delete();

//         return redirect()->route('permissions.index')->with('success', 'Permiso eliminado exitosamente.');
//     }
// }



namespace App\Http\Controllers\RPU;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionControllerRPU extends Controller
{
    public function index()
    {
        $permissions = Permission::all();
        return view('rpu.permissions.index', compact('permissions'));
    }

    public function create()
    {
        return view('rpu.permissions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name',
            'description' => 'nullable',
        ]);

        Permission::create($request->only('name', 'description'));

        return redirect()->route('permissions.index')->with('success', 'Permiso creado exitosamente.');
    }

    public function edit(Permission $permission)
    {
        return view('rpu.permissions.edit', compact('permission'));
    }

    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name,' . $permission->id,
            'description' => 'nullable',
        ]);

        $permission->update($request->only('name', 'description'));

        return redirect()->route('permissions.index')->with('success', 'Permiso actualizado exitosamente.');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();

        return redirect()->route('permissions.index')->with('success', 'Permiso eliminado exitosamente.');
    }
}

