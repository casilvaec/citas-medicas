<!-- resources/views/layouts/sidebar.blade.php -->
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
                  <a href="{{ route('admin.rpu.index') }}" class="nav-link">
                      <i class="nav-icon fas fa-users-cog"></i>
                      <p>Gestión de Roles y Permisos</p>
                  </a>
              </li>
              <!-- Otros enlaces de menú -->
          </ul>
      </nav>
  </div>
</aside>
