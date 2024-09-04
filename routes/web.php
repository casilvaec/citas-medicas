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
//use App\Http\Controllers\Admin\DisponibilidadMedicoController;
use App\Http\Controllers\Admin\DisponibilidadController;
use App\Http\Controllers\Admin\ConsultoriosController;
use App\Http\Controllers\Admin\ConsultorioMedicoController;
use App\Http\Controllers\Admin\CitasController;
use App\Http\Controllers\Admin\PacientesController;
use App\Http\Controllers\Dashboard\MedicoController;
use App\Http\Controllers\Dashboard\PacienteController;

use Maatwebsite\Excel\Facades\Excel;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::resource('appointments', AppointmentController::class);

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
// Route::post('register', [RegisterController::class, 'register']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('profile/update', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

// Route::middleware('auth')->group(function () {
//     Route::get('profile', function () {
//         return redirect()->route('profile.edit');
//     })->name('profile.redirect');
// });


Route::get('profile', function () {
    return redirect()->route('profile.edit');
})->name('profile.redirect');

// web.php

// RUTAS DE VISTAS PRINCIPALES SEGUN ROL

// Ruta para el dashboard del médico
Route::get('/dashboard/medico', [MedicoController::class, 'dashboard'])->name('dashboard.medico');

// Ruta para el dashboard del paciente
Route::get('/dashboard/paciente', [PacienteController::class, 'dashboard'])->name('dashboard.paciente');







Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::resource('users', UserControllerRPU::class);
Route::resource('roles', RoleControllerRPU::class);
Route::resource('permissions', PermissionControllerRPU::class);

Route::get('/patient/dashboard', [PatientController::class, 'dashboard'])->name('patient.dashboard');
Route::get('/patient/appointments/schedule', [PatientController::class, 'selectSpecialty'])->name('patient.appointments.schedule');
Route::post('/patient/appointments/schedule', [PatientController::class, 'selectDoctor'])->name('patient.appointments.selectDoctor');
Route::post('/patient/appointments/confirm', [PatientController::class, 'confirmAppointment'])->name('patient.appointments.confirm');
Route::get('/patient/appointments/cancel', [PatientController::class, 'showAppointments'])->name('patient.appointments.cancel');
Route::post('/patient/appointments/cancel', [PatientController::class, 'cancelAppointment'])->name('patient.appointments.cancelAppointment');
Route::get('/patient/profile/edit', [PatientController::class, 'editProfile'])->name('patient.profile.edit');
Route::post('/patient/profile/update', [PatientController::class, 'updateProfile'])->name('patient.profile.update');
Route::get('/patient/appointments/list', [PatientController::class, 'listAppointments'])->name('patient.appointments.list');

Route::get('datatable', function () {
    return view('datatable');
});

Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/rpu', [RpuController::class, 'index'])->name('rpu.index');

    Route::resource('tipos-identificacion', TipoIdentificacionController::class);
    Route::resource('generos', GeneroController::class);
    Route::resource('ciudades-residencia', CiudadResidenciaController::class, ['parameters' => ['ciudades-residencia' => 'ciudad']]);

    Route::resource('especialidades', EspecialidadesMedicasController::class);
    Route::resource('medicos', MedicosController::class);

    //Route::delete('medicos/{medicoId}/especialidades/{especialidadId}', [MedicosController::class, 'destroy'])->name('medicos.especialidades.destroy');

    Route::resource('horarios_medicos', HorarioMedicoController::class);
    Route::resource('disponibilidad_medicos', DisponibilidadController::class);
    Route::get('disponibilidad/fetch', [DisponibilidadController::class, 'fetch'])->name('disponibilidad.fetch');

    Route::get('/medicos/search', [MedicosController::class, 'search'])->name('medicos.search');

    // Route::resource('consultorios', ConsultoriosController::class);
    Route::get('consultorios/export', [ConsultoriosController::class, 'export'])->name('consultorios.export');
    Route::resource('consultorios', ConsultoriosController::class);

    Route::resource('consultorio_medico', ConsultorioMedicoController::class);

    Route::get('consultorios/estadisticas', [ConsultoriosController::class, 'estadisticas'])->name('consultorios.estadisticas');

    // Route::resource('citas', CitasController::class)->except(['show']);
    // Route::get('citas/fetch_medicos', [CitasController::class, 'fetchMedicos'])->name('citas.fetch_medicos');
    // Route::get('citas/fetch_disponibilidad', [CitasController::class, 'fetchDisponibilidad'])->name('citas.fetch_disponibilidad');

    // Route::get('citas/{id}/cancel', [CitasController::class, 'cancel'])->name('citas.cancel');
    // Route::get('citas/{id}/reschedule', [CitasController::class, 'reschedule'])->name('citas.reschedule');

    Route::get('/citas/agendar', [CitasController::class, 'agendar'])->name('citas.create'); // Para agendar citas
    
    // Ruta para ver todas las citas médicas
    //Route::get('/citas/ver', [CitasController::class, 'verCitasMedicas'])->name('citas.ver');
    
    Route::get('/citas', [CitasController::class, 'index'])->name('citas.index'); // Para ver las citas
    Route::get('/citas/cancel', [CitasController::class, 'cancel'])->name('citas.cancel'); // Para cancelar citas
    // Ruta para cancelar una cita específica
    Route::post('/citas/cancelar/{id}', [CitasController::class, 'cancelarCita'])->name('citas.cancelar');
    Route::get('/citas/reschedule/', [CitasController::class, 'reschedule'])->name('citas.reschedule'); // Para mostrar la vista de reprogramación
    Route::put('/citas/update/{id}', [CitasController::class, 'update'])->name('citas.update'); // Para actualizar la cita reprogramada
    Route::get('/admin/citas/reprogramar/{id}', [CitasController::class, 'reprogramar'])->name('citas.reprogramar');
    Route::get('/admin/citas/confirmacionReprogramacion/{id}', [CitasController::class, 'confirmacionReprogramacion'])->name('admin.citas.confirmacionReprogramacion');


    Route::get('/citas/obtener-especialidades', [CitasController::class, 'obtenerEspecialidades']);
    // Definir la ruta para crear un nuevo paciente
    Route::get('/pacientes/create', [PacientesController::class, 'create'])->name('pacientes.create');

    Route::post('/citas/buscar-paciente', [CitasController::class, 'buscarPaciente'])->name('citas.buscarPaciente');
    
    Route::get('/citas/seleccionar-paciente/{id}', [CitasController::class, 'seleccionarPaciente'])->name('citas.seleccionarPaciente');
    Route::get('/citas/especialidad', [CitasController::class, 'seleccionarEspecialidad'])->name('citas.especialidad');
    Route::post('/citas/medicos', [CitasController::class, 'mostrarMedicos'])->name('citas.medicos');
    Route::post('/citas/mostrar-dia', [CitasController::class, 'mostrarDia'])->name('citas.mostrarDia');

    Route::post('/citas/mostrar-calendario', [CitasController::class, 'mostrarCalendario'])->name('citas.mostrarCalendario');
    // Route::post('/citas/confirmacion', [CitasController::class, 'confirmarCita'])->name('citas.confirmarCita');
    Route::get('/citas/confirmacion/{cita_id}', [CitasController::class, 'mostrarConfirmacion'])->name('citas.confirmacion');


    Route::get('disponibilidad/generar/{medico_id}/{meses?}', [DisponibilidadController::class, 'generarDisponibilidadMasiva'])->name('disponibilidad.generar');
    
        
    Route::get('/citas/seleccionar-medico/{usuarioId}', [DisponibilidadController::class, 'seleccionarMedico'])->name('admin.citas.seleccionar-medico');
    
    // Route::get('/obtener-medico-id/{usuarioId}', [MedicosController::class, 'obtenerMedicoId'])->name('admin.obtenerMedicoId');

    // Ruta para mostrar las disponibilidades por días
    // Devuelve la disponibilidad diaria de un médico específico, agrupada por fecha. Se utiliza en el calendario mensual para colorear los días según su disponibilidad.
    Route::get('disponibilidad/dias/{usuarioId}', [DisponibilidadController::class, 'mostrarDisponibilidadDias'])->name('disponibilidad.dias');

    // Nueva ruta para mostrar la disponibilidad por días utilizando medico_id directamente
    Route::get('disponibilidad/dias-medico/{medico_id}', [DisponibilidadController::class, 'mostrarDisponibilidadDiasPorMedico'])->name('disponibilidad.dias.medico');

    // Ruta para mostrar las disponibilidades por horarios en un día específico
    // devuelve los horarios disponibles en un día específico para un médico determinado. Se utiliza cuando se hace clic en un día específico del calendario para mostrar los horarios disponibles en ese día.
    Route::get('disponibilidad/horarios/{usuario_id}/{fecha}', [DisponibilidadController::class, 'mostrarDisponibilidadHorarios'])->name('disponibilidad.horarios');

    // Gestiona la reserva de una cita, marcando la disponibilidad como ocupada
    Route::post('disponibilidad/reservar', [DisponibilidadController::class, 'reservarCita'])->name('disponibilidad.reservar');
});











// Rutas específicas para el médico fuera del prefijo 'admin'
Route::prefix('medico')->name('medico.')->group(function () {

    // Mostrar el formulario de búsqueda
    // Route::get('/buscar-medico', function () {
    //     return view('medico.buscar_medico');
    // })->name('buscarMedico');

    // Ruta para la vista de búsqueda de agenda de un médico
    Route::get('/buscar-agenda', [MedicosController::class, 'mostrarFormularioBuscarAgenda'])->name('buscarAgendaFormulario');
    
    // Ruta para procesar la búsqueda de agenda de un médico por su identificación
    Route::get('/agenda/buscar', [MedicosController::class, 'buscarAgendaPorIdentificacion'])->name('buscarAgenda');

    // Procesar la búsqueda del médico por número de identificación
    //Route::get('/buscar-medico/resultado', [MedicosController::class, 'buscarMedico'])->name('buscarMedicoResultado');
       
    //Route::get('/buscar-agenda', [MedicosController::class, 'buscarAgenda'])->name('buscarMedico');


    // Ruta para mostrar la agenda del médico. El {medico_id} se pasa como parámetro para identificar al médico y mostrar sus citas.
    Route::get('/agenda/{medico_id}', [MedicosController::class, 'agenda'])->name('medico.agenda');

    // Ruta para atender una cita. redirigir al médico a la vista de atención para una cita específica. El {cita_id} es el identificador único de la cita que se va a atender.
    Route::get('/atender/{cita_id}', [MedicosController::class, 'atenderCita'])->name('atenderCita');
    
    // Ruta para registrar la atención al paciente. Recibe el {cita_id} para saber a qué cita pertenece la atención registrada.
    Route::post('/registrar-atencion/{cita_id}', [MedicosController::class, 'registrarAtencion'])->name('registrarAtencion');

    // Ruta para buscar y mostrar la historia clínica de un paciente
    Route::get('/historias-clinicas', [MedicosController::class, 'consultarHistoriaClinica'])->name('consultarHistoriaClinica');

});


// Route::prefix('medico')->name('medico.')->group(function() {
//     Route::get('agenda', [MedicoController::class, 'agenda'])->name('agenda');
//     Route::get('atencion', [MedicoController::class, 'atencion'])->name('atencion');
//     Route::get('historial/{paciente_id}', [MedicoController::class, 'historial'])->name('historial');
//     Route::post('atencion/registrar', [MedicoController::class, 'registrarAtencion'])->name('registrarAtencion');
// });

