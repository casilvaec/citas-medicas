
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RpuController;
use App\Http\Controllers\RPU\PermissionControllerRPU;
use App\Http\Controllers\RPU\RoleControllerRPU;
use App\Http\Controllers\RPU\UserControllerRPU;
use App\Http\Controllers\Catalogo\TipoIdentificacionController;
use App\Http\Controllers\Catalogo\GeneroController;
use App\Http\Controllers\Catalogo\CiudadResidenciaController;
use App\Http\Controllers\Admin\EspecialidadesMedicasController;
use App\Http\Controllers\Admin\MedicosController;
use App\Http\Controllers\Admin\HorarioMedicoController;
use App\Http\Controllers\Admin\DisponibilidadMedicoController;

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

// Rutas de autenticación
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Rutas de registro
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Ruta adicional para el dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Ruta para cerrar sesión
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Rutas para editar y actualizar el perfil del usuario
Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('profile/update', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

// Requiere el archivo de rutas de Breeze si estás utilizando Breeze para otras rutas de autenticación
require __DIR__.'/auth.php';

// Redirigir al perfil después del registro
Route::middleware('auth')->group(function () {
    Route::get('profile', function () {
        return redirect()->route('profile.edit');
    })->name('profile.redirect');
});

// Ruta de registro inicial
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

// Rutas para la gestión de usuarios
Route::resource('users', UserControllerRPU::class);

// Rutas para la gestión de roles
Route::resource('roles', RoleControllerRPU::class);

// Rutas para la gestión de permisos
Route::resource('permissions', PermissionControllerRPU::class);

// Desactivar autenticación temporalmente para pruebas
// Ruta del dashboard del paciente
Route::get('/patient/dashboard', [PatientController::class, 'dashboard'])->name('patient.dashboard');
Route::get('/patient/appointments/schedule', [PatientController::class, 'selectSpecialty'])->name('patient.appointments.schedule');
Route::post('/patient/appointments/schedule', [PatientController::class, 'selectDoctor'])->name('patient.appointments.selectDoctor');
Route::post('/patient/appointments/confirm', [PatientController::class, 'confirmAppointment'])->name('patient.appointments.confirm');
Route::get('/patient/appointments/cancel', [PatientController::class, 'showAppointments'])->name('patient.appointments.cancel');
Route::post('/patient/appointments/cancel', [PatientController::class, 'cancelAppointment'])->name('patient.appointments.cancelAppointment');
Route::get('/patient/profile/edit', [PatientController::class, 'editProfile'])->name('patient.profile.edit');
Route::post('/patient/profile/update', [PatientController::class, 'updateProfile'])->name('patient.profile.update');
Route::get('/patient/appointments/list', [PatientController::class, 'listAppointments'])->name('patient.appointments.list');

// Datatables ejemplo
Route::get('datatable', function () {
    return view('datatable');
});

// PARA ADMINLTE
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/rpu', [RpuController::class, 'index'])->name('rpu.index');

    // Rutas para la gestión de catálogos
    Route::resource('tipos-identificacion', TipoIdentificacionController::class);
    Route::resource('generos', GeneroController::class);
    Route::resource('ciudades-residencia', CiudadResidenciaController::class, ['parameters' => ['ciudades-residencia' => 'ciudad']]);
    
    //Rutas para gestion de médicos
    Route::resource('especialidades', EspecialidadesMedicasController::class);
    Route::resource('medicos', MedicosController::class);

    //Rutas para gestion de horarios de médicos
    Route::resource('horarios_medicos', HorarioMedicoController::class);
    Route::resource('disponibilidad_medicos', DisponibilidadMedicoController::class);

    //Ruta para la búsqueda de médicos
    Route::get('/admin/medicos/search', [MedicosController::class, 'search'])->name('admin.medicos.search');

});

// Permisos
Route::resource('permissions', PermissionControllerRPU::class);

// Roles
Route::resource('roles', RoleControllerRPU::class);

// Usuarios
Route::resource('users', UserControllerRPU::class);



