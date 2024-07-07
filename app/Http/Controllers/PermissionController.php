<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all();
        return view('permissions.index', compact('permissions'));
    }

    public function create()
    {
        return view('permissions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions',
            'description' => 'nullable',
        ]);

        Permission::create($request->all());
        return redirect()->route('permissions.index')->with('success', 'Permission created successfully.');
    }

    public function show($id)
    {
        $permission = Permission::find($id);
        return view('permissions.show', compact('permission'));
    }

    public function edit($id)
    {
        $permission = Permission::find($id);
        return view('permissions.edit', compact('permission'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name,' . $id,
            'description' => 'nullable',
        ]);

        $permission = Permission::find($id);
        $permission->update($request->all());
        return redirect()->route('permissions.index')->with('success', 'Permission updated successfully.');
    }

    public function destroy($id)
    {
        Permission::destroy($id);
        return redirect()->route('permissions.index')->with('success', 'Permission deleted successfully.');
    }
}

