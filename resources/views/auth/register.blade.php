<!-- resources/views/auth/register.blade.php -->
<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <!-- Muestra los errores de validación -->
        <x-validation-errors class="mb-4" />

        <!-- Formulario de Registro -->
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Campo para el Nombre -->
            <div>
                <x-label for="name" value="{{ __('Nombre') }}" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <!-- Campo para los Apellidos -->
            <div class="mt-4">
                <x-label for="apellidos" value="{{ __('Apellidos') }}" />
                <x-input id="apellidos" class="block mt-1 w-full" type="text" name="apellidos" :value="old('apellidos')" required autocomplete="apellidos" />
            </div>

            <!-- Campo para el Correo Electrónico -->
            <div class="mt-4">
                <x-label for="correoElectronico" value="{{ __('Correo Electrónico') }}" />
                <x-input id="correoElectronico" class="block mt-1 w-full" type="email" name="correoElectronico" :value="old('correoElectronico')" required autocomplete="username" />
            </div>

            <!-- Campo para el Nombre de Usuario -->
            <div class="mt-4">
                <x-label for="username" value="{{ __('Nombre de usuario') }}" />
                <x-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required autocomplete="username" />
            </div>

            <!-- Campo para la Contraseña -->
            <div class="mt-4">
                <x-label for="password" value="{{ __('Contraseña') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <!-- Campo para Confirmar Contraseña -->
            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirmar Contraseña') }}" />
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <!-- Enlaces de Navegación y Botón de Registro -->
            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('¿Ya registrado?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Registrar') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
