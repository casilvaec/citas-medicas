<?php

// namespace App\Http\Controllers\RPU;

// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use App\Models\User;
// use Spatie\Permission\Models\Role;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Str;

// class UserControllerRPU extends Controller
// {
//     public function index()
//     {
//         $users = User::with('roles')->get();
//         return view('rpu.users.index', compact('users'));
//     }

//     public function create()
//     {
//         $roles = Role::all();
//         return view('rpu.users.create', compact('roles'));
//     }

//     public function store(Request $request)
//     {
//         $request->validate([
//             'nombre' => 'required|string|max:255',
//             'apellidos' => 'required|string|max:255',
//             'correoElectronico' => 'required|string|email|max:255|unique:users,correoElectronico',
//             'roles' => 'required|array',
//             'roles.*' => 'exists:roles,id'
//         ]);

//         $password = Str::random(10); // Generar una contraseña aleatoria
//         $username = Str::slug($request->nombre . '-' . Str::random(5)); // Generar un nombre de usuario único

//         $user = User::create([
//             'nombre' => $request->nombre,
//             'apellidos' => $request->apellidos,
//             'correoElectronico' => $request->correoElectronico,
//             'username' => $username,
//             'password' => Hash::make($password),
//             'estadoId' => 1,
//         ]);

//         $roles = Role::whereIn('id', $request->roles)->get();
//         $user->syncRoles($roles);

//         return redirect()->route('users.index')->with('success', 'Usuario creado exitosamente. Usuario: ' . $username . ' Contraseña: ' . $password . '. Nota: Este mensaje es solo para pruebas y se eliminará cuando se implemente el envío por correo.');
//     }

//     public function edit(User $user)
//     {
//         $roles = Role::all();
//         return view('rpu.users.edit', compact('user', 'roles'));
//     }

//     public function update(Request $request, User $user)
//     {
//         $request->validate([
//             'nombre' => 'required|string|max:255',
//             'apellidos' => 'required|string|max:255',
//             'correoElectronico' => 'required|string|email|max:255|unique:users,correoElectronico,' . $user->id,
//             'roles' => 'required|array',
//             'roles.*' => 'exists:roles,id'
//         ]);

//         $user->update([
//             'nombre' => $request->nombre,
//             'apellidos' => $request->apellidos,
//             'correoElectronico' => $request->correoElectronico,
//         ]);

//         if ($request->filled('password')) {
//             $user->update([
//                 'password' => Hash::make($request->password),
//             ]);
//         }

//         $roles = Role::whereIn('id', $request->roles)->get();
//         $user->syncRoles($roles);

//         return redirect()->route('users.index')->with('success', 'Usuario actualizado exitosamente.');
//     }

//     public function destroy(User $user)
//     {
//         $user->delete();

//         return redirect()->route('users.index')->with('success', 'Usuario eliminado exitosamente.');
//     }
// }




///////////////////
// esto si valia //
///////////////////
// namespace App\Http\Controllers\RPU;

// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use App\Models\User;
// use Spatie\Permission\Models\Role;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Str;
// use App\Models\Medico;

// class UserControllerRPU extends Controller
// {
//     public function index()
//     {
//         $users = User::with('roles')->get();
//         return view('rpu.users.index', compact('users'));
//     }

//     public function create()
//     {
//         $roles = Role::all();
//         return view('rpu.users.create', compact('roles'));
//     }

//     public function store(Request $request)
//     {
//         $request->validate([
//             'nombre' => 'required|string|max:255',
//             'apellidos' => 'required|string|max:255',
//             'correoElectronico' => 'required|string|email|max:255|unique:users,correoElectronico',
//             'roles' => 'required|array',
//             'roles.*' => 'exists:roles,id'
//         ]);

//         $password = Str::random(10); // Generar una contraseña aleatoria
//         $username = Str::slug($request->nombre . '-' . Str::random(5)); // Generar un nombre de usuario único

//         $user = User::create([
//             'nombre' => $request->nombre,
//             'apellidos' => $request->apellidos,
//             'correoElectronico' => $request->correoElectronico,
//             'username' => $username,
//             'password' => Hash::make($password),
//             'estadoId' => 1,
//         ]);

//         $roles = Role::whereIn('id', $request->roles)->get();
//         $user->syncRoles($roles);

//         // Crear el registro en la tabla medicos si el usuario tiene el rol de Medico
//         if ($user->hasRole('Medico')) {
//             if (!Medico::where('usuarioId', $user->id)->exists()) {
//                 Medico::create(['usuarioId' => $user->id]);
//             }
//         }

//         return redirect()->route('users.index')->with('success', 'Usuario creado exitosamente. Usuario: ' . $username . ' Contraseña: ' . $password . '. Nota: Este mensaje es solo para pruebas y se eliminará cuando se implemente el envío por correo.');
//     }

//     public function edit(User $user)
//     {
//         $roles = Role::all();
//         return view('rpu.users.edit', compact('user', 'roles'));
//     }

//     public function update(Request $request, User $user)
//     {
//         $request->validate([
//             'nombre' => 'required|string|max:255',
//             'apellidos' => 'required|string|max:255',
//             'correoElectronico' => 'required|string|email|max:255|unique:users,correoElectronico,' . $user->id,
//             'roles' => 'required|array',
//             'roles.*' => 'exists:roles,id'
//         ]);

//         $user->update([
//             'nombre' => $request->nombre,
//             'apellidos' => $request->apellidos,
//             'correoElectronico' => $request->correoElectronico,
//         ]);

//         if ($request->filled('password')) {
//             $user->update([
//                 'password' => Hash::make($request->password),
//             ]);
//         }

//         $roles = Role::whereIn('id', $request->roles)->get();
//         $user->syncRoles($roles);

//         // Crear el registro en la tabla medicos si el usuario tiene el rol de Medico
//         if ($user->hasRole('Medico')) {
//             if (!Medico::where('usuarioId', $user->id)->exists()) {
//                 Medico::create(['usuarioId' => $user->id]);
//             }
//         }

//         return redirect()->route('users.index')->with('success', 'Usuario actualizado exitosamente.');
//     }

//     public function destroy(User $user)
//     {
//         $user->delete();

//         return redirect()->route('users.index')->with('success', 'Usuario eliminado exitosamente.');
//     }
// }




namespace App\Http\Controllers\RPU;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Administrador;
use App\Models\Auditor;
use App\Models\Secretaria;
use App\Models\Auxiliar;
use App\Models\Medico;
use App\Models\Paciente;

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

        // Crear registros en las tablas específicas según el rol asignado
        foreach ($roles as $role) {
            switch ($role->name) {
                case 'Administrador':
                    if (!Administrador::where('usuarioId', $user->id)->exists()) {
                        Administrador::create(['usuarioId' => $user->id]);
                    }
                    break;
                case 'Auditor':
                    if (!Auditor::where('usuarioId', $user->id)->exists()) {
                        Auditor::create(['usuarioId' => $user->id]);
                    }
                    break;
                case 'Secretaria':
                    if (!Secretaria::where('usuarioId', $user->id)->exists()) {
                        Secretaria::create(['usuarioId' => $user->id]);
                    }
                    break;
                case 'Auxiliar':
                    if (!Auxiliar::where('usuarioId', $user->id)->exists()) {
                        Auxiliar::create(['usuarioId' => $user->id]);
                    }
                    break;
                case 'Paciente':
                    if (!Paciente::where('usuarioId', $user->id)->exists()) {
                        Paciente::create(['usuarioId' => $user->id]);
                    }
                    break;
                case 'Medico':
                    if (!Medico::where('usuarioId', $user->id)->exists()) {
                        Medico::create(['usuarioId' => $user->id]);
                    }
                    break;
            }
        }

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
                'password' => Hash::make($request->password)
            ]);
        }

        $roles = Role::whereIn('id', $request->roles)->get();
        $user->syncRoles($roles);

        // Actualizar registros en las tablas específicas según el rol asignado
        foreach ($roles as $role) {
            switch ($role->name) {
                case 'Administrador':
                    if (!Administrador::where('usuarioId', $user->id)->exists()) {
                        Administrador::create(['usuarioId' => $user->id]);
                    }
                    break;
                case 'Auditor':
                    if (!Auditor::where('usuarioId', $user->id)->exists()) {
                        Auditor::create(['usuarioId' => $user->id]);
                    }
                    break;
                case 'Secretaria':
                    if (!Secretaria::where('usuarioId', $user->id)->exists()) {
                        Secretaria::create(['usuarioId' => $user->id]);
                    }
                    break;
                case 'Auxiliar':
                    if (!Auxiliar::where('usuarioId', $user->id)->exists()) {
                        Auxiliar::create(['usuarioId' => $user->id]);
                    }
                    break;
                case 'Paciente':
                    if (!Paciente::where('usuarioId', $user->id)->exists()) {
                        Paciente::create(['usuarioId' => $user->id]);
                    }
                    break;
                case 'Medico':
                    if (!Medico::where('usuarioId', $user->id)->exists()) {
                        Medico::create(['usuarioId' => $user->id]);
                    }
                    break;
            }
        }

        return redirect()->route('users.index')->with('success', 'Usuario actualizado exitosamente.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'Usuario eliminado exitosamente.');
    }
}
