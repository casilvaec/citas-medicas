
{{-- <aside class="main-sidebar sidebar-dark-primary elevation-4">
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
                                <p>Médicos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.horarios_medicos.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-clock"></i>
                                <p>Horarios</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.disponibilidad_medicos.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-calendar-alt"></i>
                                <p>Disponibilidad</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- Otros enlaces de menú -->
            </ul>
        </nav>
    </div>
</aside>

   --}}


   {{-- ESTE ULTIMO SI VALIA --}}
{{-- 
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
                                <p>Médicos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.horarios_medicos.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-clock"></i>
                                <p>Horarios</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.disponibilidad_medicos.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-calendar-alt"></i>
                                <p>Disponibilidad</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#consultoriosSubmenu" class="nav-link" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="nav-icon fas fa-clinic-medical"></i>
                        <p>Consultorios</p>
                    </a>
                    <ul class="collapse list-unstyled" id="consultoriosSubmenu">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.consultorios.index') }}">Gestión de Consultorios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.consultorio_medico.index') }}">Asignación de Consultorios</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#estadisticasSubmenu" class="nav-link" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="nav-icon fas fa-chart-bar"></i>
                        <p>Estadísticas</p>
                    </a>
                    <ul class="collapse list-unstyled" id="estadisticasSubmenu">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('consultorios.export') }}">Reporte de Consultorios en Excel</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('consultorios.exportPdf') }}">Reporte de Consultorios en PDF</a>
                        </li>
                    </ul>
                </li>
                <!-- Otros enlaces de menú -->
            </ul>
        </nav>
    </div>
</aside> --}}

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
                                <p>Médicos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.horarios_medicos.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-clock"></i>
                                <p>Horarios</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.disponibilidad_medicos.index') }}" class="nav-link">
                                <i class="nav-icon fas fa-calendar-alt"></i>
                                <p>Disponibilidad</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#consultoriosSubmenu" class="nav-link" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="nav-icon fas fa-clinic-medical"></i>
                        <p>Consultorios</p>
                    </a>
                    <ul class="collapse list-unstyled" id="consultoriosSubmenu">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.consultorios.index') }}">Gestión de Consultorios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.consultorio_medico.index') }}">Asignación de Consultorios</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#estadisticasSubmenu" class="nav-link" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                        <i class="nav-icon fas fa-chart-bar"></i>
                        <p>Estadísticas</p>
                    </a>
                    <ul class="collapse list-unstyled" id="estadisticasSubmenu">
                        <!-- Comentado para evitar errores hasta su implementación futura -->
                        <!--
                        <li class="nav-item">
                            {{-- <a class="nav-link" href="{{ route('admin.consultorios.export') }}">Reporte de Consultorios en Excel</a> --}}
                        </li>
                        <li class="nav-item">
                            {{-- <a class="nav-link" href="{{ route('admin.consultorios.exportPdf') }}">Reporte de Consultorios en PDF</a> --}}
                        </li>
                        -->
                    </ul>
                </li>
                <!-- Otros enlaces de menú -->
            </ul>
        </nav>
    </div>
</aside>
