<?php
    // Obtener el ID del usuario autenticado
    //$userId = Auth::user()->id;

    // Verificar si el usuario está en la tabla medicos
    //$esMedico = \App\Models\Medico::where('usuarioId', $userId)->exists();
    // Verificar si el usuario está autenticado antes de obtener el ID
    if (Auth::check()) {
        $userId = Auth::user()->id;

        // Verificar si el usuario está en la tabla medicos
        $esMedico = \App\Models\Medico::where('usuarioId', $userId)->exists();
        $esPaciente = \App\Models\Paciente::where('usuarioId', $userId)->exists();
    } else {
        $esMedico = false; // Si no está autenticado, asumimos que no es médico
        $esPaciente = false; // Si no está autenticado, asumimos que no es paciente
    }

?>

<!-- Mostrar solo si NO es médico -->
@if(!$esMedico && !$esPaciente)



<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ url('/') }}" class="brand-link">
        <img src="{{ asset('hospital-logo.png') }}" alt="Hospital Logo" class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light">Administración</span>
    </a>
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users-cog"></i>
                        <p>
                            Gestión de Roles y Permisos
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('users.index') }}" class="nav-link">
                                <i class="fas fa-user nav-icon"></i>
                                <p>Usuarios</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('roles.index') }}" class="nav-link">
                                <i class="fas fa-user-tag nav-icon"></i>
                                <p>Roles</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('permissions.index') }}" class="nav-link">
                                <i class="fas fa-user-shield nav-icon"></i>
                                <p>Permisos</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-folder"></i>
                        <p>
                            Gestión de Catálogos
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.tipos-identificacion.index') }}" class="nav-link">
                                <i class="fas fa-id-card nav-icon"></i>
                                <p>Tipos de Identificación</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.generos.index') }}" class="nav-link">
                                <i class="fas fa-venus-mars nav-icon"></i>
                                <p>Géneros</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.ciudades-residencia.index') }}" class="nav-link">
                                <i class="fas fa-city nav-icon"></i>
                                <p>Ciudades de Residencia</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-stethoscope"></i>
                        <p>
                            Gestión Área Médica
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.especialidades.index') }}" class="nav-link">
                                <i class="fas fa-book nav-icon"></i>
                                <p>Especialidades Médicas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.medicos.index') }}" class="nav-link">
                                <i class="fas fa-user-md nav-icon"></i>
                                <p>Gestión de Especialidades a Médicos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.horarios_medicos.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-clock"></i>
                                <p>Gestión de Horarios a Médicos</p>
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="{{ route('admin.disponibilidad_medicos.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-calendar-alt"></i>
                                <p>Disponibilidad</p>
                            </a>
                        </li> --}}
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-clinic-medical"></i>
                        <p>
                            Consultorios
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.consultorios.index') }}">
                                <i class="fas fa-door-open nav-icon"></i>
                                <p>Gestión de Consultorios</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.consultorio_medico.index') }}">
                                <i class="fas fa-bed nav-icon"></i>
                                <p>Asignación de Consultorios</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-bar"></i>
                        <p>
                            Estadísticas
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav-treeview">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.consultorios.export') }}">
                                <i class="fas fa-file-excel nav-icon"></i>
                                <p>Reporte de Consultorios en Excel</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- Añadiendo la sección de Gestión de Citas -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-calendar-alt"></i>
                        <p>
                            Gestión de Citas
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.citas.create') }}" class="nav-link">
                                <i class="far fa-calendar-plus nav-icon"></i>
                                <p>Agendar Cita</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.citas.index') }}" class="nav-link">
                                <i class="far fa-calendar-check nav-icon"></i>
                                <p>Ver Citas Médicas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.citas.cancel') }}" class="nav-link">
                                <i class="far fa-calendar-times nav-icon"></i>
                                <p>Cancelar Cita</p>
                            </a>
                        </li> 
                        <li class="nav-item">
                            <a href="{{ route('admin.citas.reschedule') }}" class="nav-link">
                                <i class="far fa-calendar-alt nav-icon"></i>
                                <p>Reprogramar Cita</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- Menú Médico -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user-md"></i>
                        <p>
                            Médico
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <!-- Submenú Buscar Agenda -->
                        <li class="nav-item">
                            <a href="{{ route('medico.buscarAgendaFormulario') }}" class="nav-link">
                                <i class="fa fa-search nav-icon"></i>
                                <p>Revisar Agenda</p>
                            </a>
                        </li>
                        <!-- Submenú Historia Clínica -->
                        <li class="nav-item">
                            <a href="{{ route('medico.consultarHistoriaClinica') }}" class="nav-link">
                                <i class="fa fa-file-medical nav-icon"></i>
                                <p>Historia Clínica</p>
                            </a>
                        </li>
                    </ul>
                </li>
                        {{-- <li class="nav-item">
                            <a href="{{ route('admin.medico.agenda') }}" class="nav-link">
                                <i class="far fa-calendar-alt nav-icon"></i>
                                <p>Agenda Médica</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.medico.atencion') }}" class="nav-link">
                                <i class="far fa-clipboard nav-icon"></i>
                                <p>Registro de Atención</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('medico.historial') }}" class="nav-link">
                                <i class="far fa-file-medical nav-icon"></i>
                                <p>Historial Médico</p>
                            </a>
                        </li>   
                    </ul>
                </li> --}}
                <!-- Añadiendo la sección de Médico -->
                {{-- <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user-md"></i>
                        <p>
                            Médico
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"> --}}
                            {{-- <a href="{{ route('medico.agenda') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Revisar Agenda</p>
                            </a> --}}
                        {{-- </li>
                        <li class="nav-item"> --}}
                            {{-- <a href="{{ route('medico.atencion') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Registrar Atención</p>
                            </a> --}}
                        {{-- </li>
                        <li class="nav-item"> --}}
                            {{-- <a href="{{ route('medico.historial') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Revisar Historial</p>
                            </a> --}}
                        {{-- </li>
                    </ul>
                </li> --}}
                <!-- Otros enlaces de menú -->
            </ul>
        </nav>
    </div>
</aside>
@endif