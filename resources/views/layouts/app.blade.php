<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap Icons desde una CDN alternativa -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        html, body {
            height: 100%;
        }
        .container-fluid {
            height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .row.flex-grow-1 {
            flex-grow: 1;
        }
        .sidebar {
            height: 100%;
            min-height: 100vh;
        }
        .content {
            height: 100%;
            overflow-y: auto;
        }
        /* Estilo para cambiar el color de fondo en hover */
        .sidebar .nav-link:hover {
            background-color: #495057;
            color: #ffffff;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row flex-grow-1">
            <!-- Botón para mostrar/ocultar el sidebar -->
            <button class="btn btn-dark d-md-none mt-2 ms-2" id="toggleSidebarBtn">
                <i class="bi bi-list"></i> Menú
            </button>

            <!-- Sidebar -->
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-dark text-white sidebar collapse">
                <div class="position-sticky">
                    <h3 class="text-center py-3">Admin Panel</h3>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link text-white active" aria-current="page" href="{{ route('dashboard') }}">
                                <i class="bi bi-house-door-fill me-2"></i> Inicio
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('Reservation.admin') }}">
                                <i class="bi bi-speedometer2 me-2"></i> Gestionar Reservaciones
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('Reservation.index') }}">
                                <i class="bi bi-people-fill me-2"></i> Reservaciones
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('rooms.index') }}">
                                <i class="bi bi-gear-fill me-2"></i> Salas de Trabajo
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('logout') }}">
                                <i class="bi bi-box-arrow-right me-2"></i> Cerrar sesión
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Contenido Principal -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 content">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard</h1>
                </div>

                <!-- Contenido por defecto si no se pasa contenido específico -->
                @sectionMissing('content')
                    <div class="container mt-4">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">¡Bienvenido al Panel de Administración!</h3>
                                <p class="card-text">
                                    Esta es la página de inicio de tu panel de administración. Aquí puedes gestionar tus
                                    reservas, salas y otras configuraciones importantes.
                                </p>
                                <p class="card-text">
                                    Usa el menú de la izquierda para navegar a las diferentes secciones del panel.
                                </p>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Aquí se cargará el contenido específico de cada página -->
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Script para alternar la visibilidad del sidebar -->
    <script>
        document.getElementById('toggleSidebarBtn').addEventListener('click', function () {
            const sidebar = document.getElementById('sidebarMenu');
            sidebar.classList.toggle('show');
        });
    </script>
</body>

</html>
