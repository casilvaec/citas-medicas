<!-- resources/views/auth/register_complete.blade.php -->
<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>
  
        <x-validation-errors class="mb-4" />
  
        <form method="POST" action="{{ route('register.complete.post') }}">
            @csrf
  
            <!-- Campos prellenados del registro inicial -->
            <div>
                <x-label for="name" value="{{ __('Nombre') }}" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $datos['name'] }}" readonly />
            </div>
  
            <div class="mt-4">
                <x-label for="apellidos" value="{{ __('Apellidos') }}" />
                <x-input id="apellidos" class="block mt-1 w-full" type="text" name="apellidos" value="{{ $datos['apellidos'] }}" readonly />
            </div>
  
            <div class="mt-4">
                <x-label for="correoElectronico" value="{{ __('Correo Electrónico') }}" />
                <x-input id="correoElectronico" class="block mt-1 w-full" type="email" name="correoElectronico" value="{{ $datos['correoElectronico'] }}" readonly />
            </div>
  
            <!-- Nuevos campos a completar -->
            <div class="mt-4">
                <x-label for="tipoIdentificacion" value="{{ __('Tipo de Identificación') }}" />
                <select id="tipoIdentificacion" name="tipoIdentificacion" class="block mt-1 w-full" required>
                    <option value="">Selecciona una opción</option>
                    @foreach($tiposIdentificacion as $tipo)
                        <option value="{{ $tipo->id }}">{{ $tipo->tipo }}</option>
                    @endforeach
                </select>
            </div>
  
            <div class="mt-4">
                <x-label for="identificacion" value="{{ __('Número de Identificación') }}" />
                <x-input id="identificacion" class="block mt-1 w-full" type="text" name="identificacion" required />
            </div>
  
            <div class="mt-4">
                <x-label for="idGenero" value="{{ __('Género') }}" />
                <select id="idGenero" name="idGenero" class="block mt-1 w-full" required>
                    <option value="">Selecciona una opción</option>
                    @foreach($generos as $genero)
                        <option value="{{ $genero->id }}">{{ $genero->nombre }}</option>
                    @endforeach
                </select>
            </div>
  
            <div class="mt-4">
                <x-label for="fechaNacimiento" value="{{ __('Fecha de Nacimiento') }}" />
                <x-input id="fechaNacimiento" class="block mt-1 w-full" type="date" name="fechaNacimiento" required />
            </div>
  
            <div class="mt-4">
                <x-label for="telefonoConvencional" value="{{ __('Teléfono Convencional') }}" />
                <x-input id="telefonoConvencional" class="block mt-1 w-full" type="text" name="telefonoConvencional" pattern="[0-9]*" />
            </div>
  
            <div class="mt-4">
                <x-label for="telefonoCelular" value="{{ __('Teléfono Celular') }}" />
                <x-input id="telefonoCelular" class="block mt-1 w-full" type="text" name="telefonoCelular" pattern="[0-9]*" />
            </div>
  
            <div class="mt-4">
                <x-label for="direccion" value="{{ __('Dirección') }}" />
                <x-input id="direccion" class="block mt-1 w-full" type="text" name="direccion" required />
            </div>
  
            <div class="mt-4">
                <x-label for="idCiudadResidencia" value="{{ __('Ciudad de Residencia') }}" />
                <select id="idCiudadResidencia" name="idCiudadResidencia" class="block mt-1 w-full" required>
                    <option value="">Selecciona una opción</option>
                    @foreach($ciudades as $ciudad)
                        <option value="{{ $ciudad->id }}">{{ $ciudad->nombre }}</option>
                    @endforeach
                </select>
            </div>
  
            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('¿Ya registrado?') }}
                </a>
  
                <x-button class="ml-4">
                    {{ __('Completar Registro') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
  </x-guest-layout>
  