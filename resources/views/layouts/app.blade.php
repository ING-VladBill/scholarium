<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Scholarium') - Colegio Santa María de Jesús</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --vinotinto-oscuro: #5C1A33;
            --vinotinto-medio: #8B2E52;
            --dorado: #D4AF37;
            --dorado-claro: #F4E4C1;
            --gris-claro: #F8F9FA;
            --gris-oscuro: #343A40;
        }
        
        * {
            font-family: 'Inter', sans-serif;
        }
        
        body {
            background-color: var(--gris-claro);
            color: var(--gris-oscuro);
        }
        
        /* Navbar */
        .navbar-scholarium {
            background: linear-gradient(135deg, #6B1C3D 0%, #8B2E52 100%); box-shadow: 0 2px 10px rgba(212, 175, 55, 0.3);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .navbar-scholarium .navbar-brand {
            color: var(--dorado) !important;
            font-weight: 700;
            font-size: 1.5rem;
        }
        
        .navbar-scholarium .nav-link {
            color: rgba(255,255,255,0.9) !important;
            font-weight: 500;
            transition: color 0.3s;
            margin: 0 0.5rem;
        }
        
        .navbar-scholarium .nav-link:hover {
            color: var(--dorado) !important;
        }
        
        .navbar-scholarium .nav-link.active {
            color: var(--dorado) !important;
        }
        
        /* Botones */
        .btn-primary {
            background: linear-gradient(135deg, #6B1C3D 0%, #8B2E52 100%); box-shadow: 0 2px 10px rgba(212, 175, 55, 0.3);
            border-color: var(--vinotinto-oscuro);
            font-weight: 500;
        }
        
        .btn-primary:hover {
            background-color: var(--vinotinto-medio);
            border-color: var(--vinotinto-medio);
        }
        
        .btn-secondary {
            background-color: var(--dorado);
            border-color: var(--dorado);
            color: var(--vinotinto-oscuro);
            font-weight: 600;
        }
        
        .btn-secondary:hover {
            background-color: #c49d2f;
            border-color: #c49d2f;
            color: var(--vinotinto-oscuro);
        }
        
        /* Cards */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        /*.card:hover {
            transform: translateY(-4px);
            box-shadow: 0 4px 16px rgba(0,0,0,0.12);
        }*/
        
        .card-header {
            background: linear-gradient(135deg, #6B1C3D 0%, #8B2E52 100%); box-shadow: 0 2px 10px rgba(212, 175, 55, 0.3);
            color: white;
            font-weight: 600;
            border-radius: 12px 12px 0 0 !important;
        }
        
        /* Tables */
        .table {
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
        }
        
        .table thead {
            background: linear-gradient(135deg, #6B1C3D 0%, #8B2E52 100%); box-shadow: 0 2px 10px rgba(212, 175, 55, 0.3);
            color: white;
        }
        
        .table tbody tr:hover {
            background-color: var(--dorado-claro);
        }
        
        /* Badges */
        .badge-activo {
            background-color: #28a745;
        }
        
        .badge-inactivo {
            background-color: #dc3545;
        }
        
        /* Footer */
        .footer-scholarium {
            background: linear-gradient(135deg, #6B1C3D 0%, #8B2E52 100%); box-shadow: 0 2px 10px rgba(212, 175, 55, 0.3);
            color: white;
            padding: 2rem 0;
            margin-top: 4rem;
        }
        
        /* Alerts */
        .alert {
            border-radius: 8px;
            border: none;
        }
        
        /* Forms */
        .form-label {
            font-weight: 500;
            color: var(--gris-oscuro);
        }
        
        .form-control:focus {
            border-color: var(--vinotinto-medio);
            box-shadow: 0 0 0 0.2rem rgba(139, 46, 82, 0.25);
        }
        
        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, var(--vinotinto-oscuro) 0%, var(--vinotinto-medio) 100%);
            color: white;
            padding: 4rem 0;
            margin-bottom: 3rem;
        }
        
        .hero-section h1 {
            font-weight: 700;
            margin-bottom: 1rem;
        }
        
        .hero-section p {
            font-size: 1.2rem;
            opacity: 0.95;
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-scholarium">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="bi bi-mortarboard-fill"></i> Scholarium
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('nosotros') ? 'active' : '' }}" href="{{ route('nosotros') }}">Nosotros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contacto') ? 'active' : '' }}" href="{{ route('contacto') }}">Contacto</a>
                    </li>
                    
                    @auth
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Dashboard</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu">
                                <li><span class="dropdown-item-text"><small>Rol: {{ ucfirst(Auth::user()->role) }}</small></span></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="bi bi-box-arrow-right"></i> Cerrar Sesión
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">
                                <i class="bi bi-box-arrow-in-right"></i> Ingresar
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">
                                <i class="bi bi-person-plus"></i> Registrarse
                            </a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer-scholarium mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5><i class="bi bi-mortarboard-fill"></i> Scholarium</h5>
                    <p>Colegio Santa María de Jesús<br>
                    Excelencia académica y formación integral</p>
                </div>
                <div class="col-md-4">
                    <h5>Enlaces Rápidos</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('home') }}" class="text-white text-decoration-none">Inicio</a></li>
                        <li><a href="{{ route('nosotros') }}" class="text-white text-decoration-none">Nosotros</a></li>
                        <li><a href="{{ route('contacto') }}" class="text-white text-decoration-none">Contacto</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Contacto</h5>
                    <p>
                        <i class="bi bi-geo-alt-fill"></i> Lima, Perú<br>
                        <i class="bi bi-telephone-fill"></i> +51 2 1234 5678<br>
                        <i class="bi bi-envelope-fill"></i> contacto@scholarium.pe
                    </p>
                </div>
            </div>
            <hr class="bg-white">
            <div class="text-center">
                <p class="mb-0">&copy; {{ date('Y') }} Scholarium. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    @stack('scripts')
    
    {{--<!-- Alerts auto-hide -->
    <script>
        setTimeout(function() {
            let alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                let bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    </script>

    --}}
</body>
</html>
