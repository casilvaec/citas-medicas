<?php

namespace App\Http\Controllers\RPU;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserControllerRPU extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        return view('rpu.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('rpu.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'correoElectronico' => 'required|string|email|max:255|unique:users,correoElectronico',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id'
        ]);

        $password = Str::random(10); // Generar una contraseña aleatoria
        $username = Str::slug($request->nombre . '-' . Str::random(5)); // Generar un nombre de usuario único

        $user = User::create([
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'correoElectronico' => $request->correoElectronico,
            'username' => $username,
            'password' => Hash::make($password),
            'estadoId' => 1,
        ]);

        $roles = Role::whereIn('id', $request->roles)->get();
        $user->syncRoles($roles);

        return redirect()->route('users.index')->with('success', 'Usuario creado exitosamente. Usuario: ' . $username . ' Contraseña: ' . $password . '. Nota: Este mensaje es solo para pruebas y se eliminará cuando se implemente el envío por correo.');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('rpu.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'correoElectronico' => 'required|string|email|max:255|unique:users,correoElectronico,' . $user->id,
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id'
        ]);

        $user->update([
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'correoElectronico' => $request->correoElectronico,
        ]);

        if ($request->filled('password')) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        $roles = Role::whereIn('id', $request->roles)->get();
        $user->syncRoles($roles);

        return redirect()->route('users.index')->with('success', 'Usuario actualizado exitosamente.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Usuario eliminado exitosamente.');
    }
}
