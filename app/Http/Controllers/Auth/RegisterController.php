<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \App\Http\Requests\RegisterRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(RegisterRequest $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'correoElectronico' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'tipoIdentificacion' => ['required', 'string'],
            'identificacion' => ['required', 'string', 'max:255'],
            'apellidos' => ['required', 'string', 'max:255'],
            'idGenero' => ['required', 'integer'],
            'fechaNacimiento' => ['required', 'date'],
            'telefonoConvencional' => ['nullable', 'string', 'max:20'],
            'telefonoCelular' => ['nullable', 'string', 'max:20'],
            'direccion' => ['required', 'string', 'max:255'],
            'idCiudadResidencia' => ['required', 'integer'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'correoElectronico' => $data['correoElectronico'],
            'password' => Hash::make($data['password']),
            'tipoIdentificacion' => $data['tipoIdentificacion'],
            'identificacion' => $data['identificacion'],
            'apellidos' => $data['apellidos'],
            'idGenero' => $data['idGenero'],
            'fechaNacimiento' => $data['fechaNacimiento'],
            'telefonoConvencional' => $data['telefonoConvencional'],
            'telefonoCelular' => $data['telefonoCelular'],
            'direccion' => $data['direccion'],
            'idCiudadResidencia' => $data['idCiudadResidencia'],
            'idEstadoUsuario' => 0, // Asignar usuario como inactivo por defecto
        ]);
    }
}










