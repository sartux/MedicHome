<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MedicHome') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="alternate icon" href="{{ asset('favicon.ico') }}">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Estilos adicionales -->
    <style>
        :root {
            --color-primary: #2C9B4E;
            --color-primary-light: #4FBD77;
            --color-secondary: #22A69D;
            --color-bg-light: #F9F9F7;
        }
        
        body {
            font-family: 'Figtree', sans-serif;
        }
        
        .hero-gradient {
            background: linear-gradient(135deg, #2C9B4E 0%, #22A69D 100%);
        }
        
        .feature-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        }
        
        .btn-primary {
            background-color: var(--color-primary);
            border-color: var(--color-primary);
        }
        
        .btn-primary:hover {
            background-color: var(--color-primary-light);
            border-color: var(--color-primary-light);
        }
        
        .icon-circle {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(44, 155, 78, 0.1);
            color: #2C9B4E;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body class="antialiased bg-gray-50">
    <!-- Barra de navegación -->
    <nav class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 60 60" class="h-10 w-10">
                        <path d="M30,5 L50,17.5 L50,42.5 L30,55 L10,42.5 L10,17.5 L30,5 Z" stroke="#9EEDB9" stroke-width="1.5" fill="none"/>
                        <path d="M30,15 C25,10 18,14 18,20 C18,22 19,24 20,25 H27 L28,23 C28.3,22.5 29,22.4 29.3,23 L32,27 L36,18 C36.3,17.2 37.2,17.2 37.5,18 L41,25 H47 C49,21 44,13 36,19 Z" fill="#9EEDB9"/>
                        <path d="M41,26 L38,21 L34,30 C33.7,30.7 32.7,30.8 32.2,30 L29,26 L28,27 C27.8,27.3 27.4,27.5 27,27.5 H20 C21.5,29 25,33 30,38 C30.3,38.3 30.7,38.3 31,38 C36,33 39.5,29 41,27.5 H34 C33.7,27.5 33.3,27.3 33.2,27 Z" fill="#9EEDB9"/>
                    </svg>
                    <span class="ml-2 text-xl font-bold text-gray-800">MedicHome</span>
                </div>
                <div class="flex items-center">
                    @if (Route::has('login'))
                        <div class="ml-6 flex items-center">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-md transition-colors">
                                    Panel de Control
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="text-gray-700 hover:text-green-600 px-3 py-2 rounded-md text-sm font-medium transition-colors">
                                    Iniciar Sesión
                                </a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="ml-4 bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-md transition-colors">
                                        Registrarse
                                    </a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-gradient text-white">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
            <div class="lg:flex lg:items-center lg:justify-between">
                <div class="lg:w-1/2">
                    <h1 class="text-4xl md:text-5xl font-bold mb-4">Gestiona la salud de tu familia con facilidad</h1>
                    <p class="text-xl mb-8">MedicHome te ayuda a mantener organizados los tratamientos, medicamentos y citas médicas de toda tu familia en un solo lugar.</p>
                    <div class="flex flex-wrap gap-4">
                        <a href="{{ route('login') }}" class="bg-white text-green-600 hover:bg-gray-100 font-bold py-3 px-6 rounded-md transition-colors">
                            Iniciar Ahora
                        </a>
                        <a href="#caracteristicas" class="border border-white text-white hover:bg-white hover:text-green-600 font-bold py-3 px-6 rounded-md transition-colors">
                            Conocer Más
                        </a>
                    </div>
                </div>
                <div class="mt-10 lg:mt-0 lg:w-1/2 flex justify-center">
                    <img src="/api/placeholder/600/400" alt="MedicHome Dashboard" class="rounded-lg shadow-xl" />
                </div>
            </div>
        </div>
    </div>

    <!-- Características -->
    <div id="caracteristicas" class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Gestión completa de la salud familiar</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">Herramientas intuitivas para mantener al día los tratamientos y citas médicas de todos los miembros de la familia.</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Característica 1 -->
                <div class="bg-white p-6 rounded-lg shadow-md feature-card">
                    <div class="icon-circle">
                        <i class="fas fa-pills text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Control de Medicamentos</h3>
                    <p class="text-gray-600">Gestiona tratamientos, dosis y horarios de medicamentos para cada miembro de la familia.</p>
                </div>

                <!-- Característica 2 -->
                <div class="bg-white p-6 rounded-lg shadow-md feature-card">
                    <div class="icon-circle">
                        <i class="fas fa-calendar-alt text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Agenda Médica</h3>
                    <p class="text-gray-600">Programa y recibe recordatorios de citas médicas, controles y exámenes pendientes.</p>
                </div>

                <!-- Característica 3 -->
                <div class="bg-white p-6 rounded-lg shadow-md feature-card">
                    <div class="icon-circle">
                        <i class="fas fa-file-medical-alt text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Historial Médico Digital</h3>
                    <p class="text-gray-600">Almacena diagnósticos, alergias y condiciones médicas de forma segura y accesible.</p>
                </div>

                <!-- Característica 4 -->
                <div class="bg-white p-6 rounded-lg shadow-md feature-card">
                    <div class="icon-circle">
                        <i class="fas fa-users text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Perfiles Familiares</h3>
                    <p class="text-gray-600">Crea perfiles para cada miembro de la familia con información médica relevante.</p>
                </div>

                <!-- Característica 5 -->
                <div class="bg-white p-6 rounded-lg shadow-md feature-card">
                    <div class="icon-circle">
                        <i class="fas fa-bell text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Recordatorios Personalizados</h3>
                    <p class="text-gray-600">Configura alertas para medicamentos, renovación de recetas y citas próximas.</p>
                </div>

                <!-- Característica 6 -->
                <div class="bg-white p-6 rounded-lg shadow-md feature-card">
                    <div class="icon-circle">
                        <i class="fas fa-lock text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Privacidad y Seguridad</h3>
                    <p class="text-gray-600">Información médica protegida con los más altos estándares de seguridad y privacidad.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Testimonios o información adicional -->
    <div class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-800 mb-4">La forma más inteligente de gestionar la salud familiar</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">Nuestra plataforma está diseñada para ayudarte a mantener al día todos los aspectos relacionados con la salud de tu familia.</p>
            </div>

            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="md:flex">
                    <div class="md:w-1/2 p-8 flex items-center">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-800 mb-4">Comienza a usar MedicHome hoy</h3>
                            <p class="text-gray-600 mb-6">Registrarse es rápido y sencillo. Empieza a gestionar la salud de tu familia de manera eficiente con nuestra plataforma intuitiva.</p>
                            <a href="{{ route('register') }}" class="inline-block bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-md transition-colors">
                                Crear Cuenta Gratuita
                            </a>
                        </div>
                    </div>
                    <div class="md:w-1/2 bg-green-50 p-8">
                        <div class="rounded-lg bg-white p-6 shadow-md">
                            <div class="flex items-center mb-4">
                                <div class="h-12 w-12 rounded-full bg-green-100 flex items-center justify-center">
                                    <i class="fas fa-quote-left text-green-600"></i>
                                </div>
                                <div class="ml-4">
                                    <h4 class="text-lg font-semibold">María García</h4>
                                    <p class="text-gray-500">Madre de familia</p>
                                </div>
                            </div>
                            <p class="text-gray-600 italic">"MedicHome ha transformado la forma en que gestiono los medicamentos y citas médicas de mi familia. Es una herramienta indispensable para mantener todo organizado."</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="md:flex md:justify-between">
                <div class="mb-8 md:mb-0">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 60 60" class="h-10 w-10">
                            <path d="M30,5 L50,17.5 L50,42.5 L30,55 L10,42.5 L10,17.5 L30,5 Z" stroke="#9EEDB9" stroke-width="1.5" fill="none"/>
                            <path d="M30,15 C25,10 18,14 18,20 C18,22 19,24 20,25 H27 L28,23 C28.3,22.5 29,22.4 29.3,23 L32,27 L36,18 C36.3,17.2 37.2,17.2 37.5,18 L41,25 H47 C49,21 44,13 36,19 Z" fill="#9EEDB9"/>
                            <path d="M41,26 L38,21 L34,30 C33.7,30.7 32.7,30.8 32.2,30 L29,26 L28,27 C27.8,27.3 27.4,27.5 27,27.5 H20 C21.5,29 25,33 30,38 C30.3,38.3 30.7,38.3 31,38 C36,33 39.5,29 41,27.5 H34 C33.7,27.5 33.3,27.3 33.2,27 Z" fill="#9EEDB9"/>
                        </svg>
                        <span class="ml-2 text-xl font-bold">MedicHome</span>
                    </div>
                    <p class="mt-4 max-w-md text-gray-400">Plataforma para la gestión integral de la salud familiar, tratamientos médicos y agenda de citas.</p>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-8">
                    <div>
                        <h3 class="text-sm font-semibold uppercase tracking-wider">Plataforma</h3>
                        <ul class="mt-4 space-y-2">
                            <li><a href="#" class="text-gray-400 hover:text-white">Características</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white">Seguridad</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white">Planes</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold uppercase tracking-wider">Soporte</h3>
                        <ul class="mt-4 space-y-2">
                            <li><a href="#" class="text-gray-400 hover:text-white">Centro de ayuda</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white">Contacto</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white">FAQ</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold uppercase tracking-wider">Legal</h3>
                        <ul class="mt-4 space-y-2">
                            <li><a href="#" class="text-gray-400 hover:text-white">Privacidad</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white">Términos</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="mt-12 border-t border-gray-700 pt-8 flex justify-between items-center">
                <p class="text-sm text-gray-400">&copy; 2025 MedicHome. Todos los derechos reservados.</p>
                <div class="flex space-x-6">
                    <a href="#" class="text-gray-400 hover:text-white">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>