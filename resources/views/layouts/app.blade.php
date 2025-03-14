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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

     <!-- Favicon -->
     <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
     <link rel="alternate icon" href="{{ asset('favicon.ico') }}">
     <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">
    <!-- Estilos personalizados -->
    <style>
        :root {
            --color-primary: #2C9B4E;
            --color-primary-light: #4FBD77;
            --color-secondary: #22A69D;
            --color-bg-light: #F9F9F7;
            --color-text-dark: #333333;
            --color-text-medium: #6B7280;
            --color-success: #D1E7DD;
            --color-error: #F8D7DA;
        }
        
        body {
            background-color: var(--color-bg-light);
            font-family: 'Figtree', sans-serif;
        }
        
        .btn-primary {
            background-color: var(--color-primary) !important;
            border-color: var(--color-primary) !important;
        }
        
        .btn-primary:hover {
            background-color: var(--color-primary-light) !important;
            border-color: var(--color-primary-light) !important;
        }
        
        .btn-secondary {
            background-color: var(--color-secondary) !important;
            border-color: var(--color-secondary) !important;
        }
        
        .card {
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            background-color: white;
        }
        
        .alert-success {
            background-color: var(--color-success);
            border-color: #C3E6CB;
            color: #0F5132;
        }
        
        .alert-danger {
            background-color: var(--color-error);
            border-color: #F5C6CB;
            color: #842029;
        }
        
        .table th {
            background-color: var(--color-primary);
            color: white;
        }
        
        .medic-header {
            background-color: var(--color-primary);
            color: white;
        }
        
        .sidebar {
            background-color: white;
            border-right: 1px solid #eee;
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 medic-header">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            <div class="py-6">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    @if(session('success'))
                        <div class="mb-4 p-4 rounded-md alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    @if(session('error'))
                        <div class="mb-4 p-4 rounded-md alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    
                    @yield('content')
                </div>
            </div>
        </main>
        
        <!-- Footer -->
        <footer class="bg-white border-t border-gray-200 mt-auto py-4">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-sm text-gray-600">&copy; {{ date('Y') }} MedicHome. Todos los derechos reservados.</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Versión 1.0</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Scripts adicionales -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>