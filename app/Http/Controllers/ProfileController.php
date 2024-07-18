<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\TipoIdentificacion;
use App\Models\Genero;
use App\Models\CiudadResidencia;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Muestra el formulario de perfil del usuario.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();
        $tiposIdentificacion = TipoIdentificacion::all();
        $generos = Genero::all();
        $ciudades = CiudadResidencia::all();

        return view('profile.edit', compact('user', 'tiposIdentificacion', 'generos', 'ciudades'));
    }

    /**
     * Actualiza la información del perfil del usuario.
     */
    public function update(Request $request): RedirectResponse
    {
        // Validar los datos del formulario
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . Auth::id()],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'tipoIdentificacion' => ['required', 'string'],
            'apellidos' => ['required', 'string', 'max:255'],
            'idGenero' => ['required', 'integer'],
            'fechaNacimiento' => ['required', 'date'],
            'telefonoConvencional' => ['nullable', 'string', 'max:20', 'regex:/^[0-9]+$/'],
            'telefonoCelular' => ['nullable', 'string', 'max:20', 'regex:/^[0-9]+$/'],
            'direccion' => ['required', 'string', 'max:255'],
            'idCiudadResidencia' => ['required', 'integer'],
        ];

        // Validaciones específicas para cada tipo de identificación
        if ($request->tipoIdentificacion === 'Cédula') {
            $rules['identificacion'] = ['required', 'string', 'size:10', 'regex:/^[0-9]+$/'];
        } elseif ($request->tipoIdentificacion === 'Pasaporte') {
            $rules['identificacion'] = ['required', 'string', 'max:20'];
        } else {
            $rules['identificacion'] = ['required', 'string', 'max:13', 'regex:/^[0-9]+$/'];
        }

        $customMessages = [
            'identificacion.regex' => 'Debe ingresar números.',
            'telefonoConvencional.regex' => 'Debe ingresar números.',
            'telefonoCelular.regex' => 'Debe ingresar números.'
        ];

        $request->validate($rules, $customMessages);

        // Obtener el usuario autenticado
        $user = Auth::user();
        // Actualizar los campos del usuario
        $user->name = $request->name;
        $user->email = $request->email;
        $user->tipoIdentificacion = $request->tipoIdentificacion;
        $user->identificacion = $request->identificacion;
        $user->apellidos = $request->apellidos;
        $user->idGenero = $request->idGenero;
        $user->fechaNacimiento = $request->fechaNacimiento;
        $user->telefonoConvencional = $request->telefonoConvencional;
        $user->telefonoCelular = $request->telefonoCelular;
        $user->direccion = $request->direccion;
        $user->idCiudadResidencia = $request->idCiudadResidencia;
        $user->idEstadoUsuario = 2; // Asignar usuario como activo

        // Actualizar la contraseña si se proporciona
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        // Si el correo electrónico cambia, marcar email_verified_at como null
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Guardar los cambios en la base de datos
        $user->save();

        // Redirigir a la página de edición de perfil con un mensaje de éxito
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Elimina la cuenta del usuario.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Validar la contraseña del usuario
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        // Obtener el usuario autenticado
        $user = $request->user();

        // Cerrar sesión
        Auth::logout();

        // Eliminar el usuario
        $user->delete();

        // Invalidar la sesión
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirigir a la página de inicio
        return Redirect::to('/');
    }
}
