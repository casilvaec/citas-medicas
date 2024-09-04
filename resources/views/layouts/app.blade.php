<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Hospital Isidro Ayora') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="{{ asset('css/adminlte/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/adminlte/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/adminlte/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="{{ asset('plugins/adminlte/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/adminlte/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/adminlte/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        @include('layouts.navbar')

        <!-- Enlace de Logout que redirige directamente al login -->
        {{-- <a href="{{ url('/login') }}" class="nav-link">
            Logout
        </a> --}}

        {{-- <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>

        <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a> --}}
        <!-- Enlace de Logout Simplificado -->
        {{-- <a href="{{ route('login') }}" class="nav-link">Logout</a> --}}

        <!-- Main Sidebar Container -->
        @include('layouts.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Mensajes de Confirmación -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('info'))
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    {{ session('info') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('warning'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{ session('warning') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </div>

        <!-- Footer -->
        @include('layouts.footer')
    </div>
    
    @stack('modals')

    @livewireScripts

    <!-- AdminLTE JS -->
    <script src="{{ asset('plugins/adminlte/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/adminlte/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/adminlte/adminlte.min.js') }}"></script>
    
    <!-- DataTables JS -->
    <script src="{{ asset('plugins/adminlte/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/adminlte/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/adminlte/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/adminlte/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/adminlte/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/adminlte/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/adminlte/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/adminlte/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/adminlte/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/adminlte/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/adminlte/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/adminlte/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    
    
    
        
    @stack('scripts')
</body>
</html>

