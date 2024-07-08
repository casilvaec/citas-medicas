<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController; // Asegúrate de importar el controlador

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aquí es donde puedes registrar rutas web para tu aplicación. Estas
| rutas se cargan por el RouteServiceProvider dentro de un grupo que
| contiene el grupo de middleware "web". ¡Crea algo grandioso!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
})->name('home');

// Ruta para el recurso appointments
Route::resource('appointments', AppointmentController::class);

// Rutas de autenticación (manejadas por el RegisterController)
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Ruta adicional para el dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Ruta para cerrar sesión
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Ruta para editar el perfil del usuario
Route::middleware('auth')->group(function () {
    // Rutas protegidas que requieren autenticación
    Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Requiere el archivo de rutas de Breeze si estás utilizando Breeze para otras rutas de autenticación
require __DIR__.'/auth.php';

// Redirigir al perfil después del registro
Route::middleware('auth')->group(function () {
    Route::get('profile', function () {
        return redirect()->route('profile.edit');
    })->name('profile.redirect');
});


Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/register/complete', [RegisteredUserController::class, 'showCompleteForm'])->name('register.complete');
Route::post('/register/complete', [RegisteredUserController::class, 'completeRegistration'])->name('register.complete.post');