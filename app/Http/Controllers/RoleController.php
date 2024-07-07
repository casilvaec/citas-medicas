<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    public function create()
    {
        return view('roles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles',
            'description' => 'nullable',
        ]);

        Role::create($request->all());
        return redirect()->route('roles.index')->with('success', 'Role created successfully.');
    }

    public function show($id)
    {
        $role = Role::find($id);
        return view('roles.show', compact('role'));
    }

    public function edit($id)
    {
        $role = Role::find($id);
        return view('roles.edit', compact('role'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $id,
            'description' => 'nullable',
        ]);

        $role = Role::find($id);
        $role->update($request->all());
        return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
    }

    public function destroy($id)
    {
        Role::destroy($id);
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    }
}
