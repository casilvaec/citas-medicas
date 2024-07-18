<!-- resources/views/layouts/sidebar.blade.php -->
{{-- <aside class="main-sidebar sidebar-dark-primary elevation-4">
  <a href="{{ url('/') }}" class="brand-link">
      {{-- <img src="{{ asset('img/adminlte/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"> --}}
      {{-- <img src="{{ asset('hospital-logo.png') }}" alt="Hospital Logo" class="brand-image img-circle elevation-3">
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
                  <a href="{{ route('admin.rpu.index') }}" class="nav-link">
                      <i class="nav-icon fas fa-users-cog"></i>
                      <p>Gestión de Roles y Permisos</p>
                  </a>
              </li>
              <!-- Otros enlaces de menú -->
          </ul>
      </nav>
  </div>
</aside> --}} --}}


<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ url('/') }}" class="brand-link">
        {{-- <img src="{{ asset('img/adminlte/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"> --}}
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
                <!-- Otros enlaces de menú -->
            </ul>
        </nav>
    </div>
</aside>
  