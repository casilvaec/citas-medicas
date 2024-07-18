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
        $request->validate([
            'tipoIdentificacionId' => 'required|exists:tipos_identificacion,id',
            'identificacion' => 'required|string|max:255',
            'generoId' => 'required|exists:generos,id',
            'ciudadResidenciaId' => 'required|exists:ciudades,id',
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'correoElectronico' => 'required|string|email|max:255|unique:users,correoElectronico,' . Auth::id(),
            'username' => 'required|string|max:255|unique:users,username,' . Auth::id(),
            'telefonoConvencional' => 'nullable|string|max:20|regex:/^[0-9]+$/',
            'telefonoCelular' => 'nullable|string|max:20|regex:/^[0-9]+$/',
            'direccion' => 'nullable|string|max:255',
            'fechaNacimiento' => 'nullable|date',
            'password' => 'nullable|string|min:8|confirmed',
        ], [
            'telefonoConvencional.regex' => 'Debe ingresar números.',
            'telefonoCelular.regex' => 'Debe ingresar números.',
        ]);

        $user = Auth::user();

        // Actualizar los campos del usuario
        $user->tipoIdentificacionId = $request->tipoIdentificacionId;
       
        $user->generoId = $request->generoId;
        $user->ciudadResidenciaId = $request->ciudadResidenciaId;
        $user->nombre = $request->nombre;
        $user->apellidos = $request->apellidos;
        $user->correoElectronico = $request->correoElectronico;
        $user->username = $request->username;
        $user->telefonoConvencional = $request->telefonoConvencional;
        $user->telefonoCelular = $request->telefonoCelular;
        $user->direccion = $request->direccion;
        $user->fechaNacimiento = $request->fechaNacimiento;
        $user->estadoId = 2; // Actualiza el estado del usuario a activo

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Si el correo electrónico cambia, marcar email_verified_at como null
        if ($user->isDirty('correoElectronico')) {
            $user->email_verified_at = null;
        }

        $user->save();

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
