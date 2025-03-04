<nav class="bg-white border-b border-gray-200">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
        <!-- Logo -->
        <a class="text-lg font-semibold text-gray-800" href="{{ route('dashboard') }}">
            <x-application-logo class="h-8" />
        </a>

        <!-- Mobile Toggle Button -->
        <button class="lg:hidden flex items-center px-3 py-2 border rounded text-gray-600 border-gray-300 hover:text-gray-900 hover:border-gray-400 focus:outline-none" 
                onclick="document.getElementById('navbarNav').classList.toggle('hidden')">
            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"><path d="M3 6h14M3 12h14M3 18h14"/></svg>
        </button>

        <!-- Nav Links -->
        <div class="hidden lg:flex items-center space-x-4" id="navbarNav">
            <ul class="flex space-x-4">
                <!-- Dashboard Link -->
                <li>
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </li>

                <!-- Dropdowns -->
                <li class="relative group">
                    <x-nav-link href="#" class="inline-flex items-center">
                        {{ __('Familia') }}
                    </x-nav-link>
                    <ul class="absolute hidden bg-white shadow-lg rounded mt-2 min-w-max py-1 z-10 transition ease-in-out duration-150 delay-75">
                        <li><a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="{{ route('familiares.index') }}">Ver Familiares</a></li>
                        <li><a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="{{ route('familiares.create') }}">Agregar Familiar</a></li>
                    </ul>
                </li>

                <li class="relative group">
                    <x-nav-link href="#" class="inline-flex items-center">
                        {{ __('Medicamentos') }}
                    </x-nav-link>
                    <ul class="absolute hidden bg-white shadow-lg rounded mt-2 min-w-max py-1 z-10 transition ease-in-out duration-150 delay-75">
                        <li><a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="{{ route('medicamentos.index') }}">Ver Medicamentos</a></li>
                        <li><a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="{{ route('medicamentos.create') }}">Agregar Medicamento</a></li>
                    </ul>
                </li>

                <li class="relative group">
                    <x-nav-link href="#" class="inline-flex items-center">
                        {{ __('Configuración') }}
                    </x-nav-link>
                    <ul class="absolute hidden bg-white shadow-lg rounded mt-2 min-w-max py-1 z-10 transition ease-in-out duration-150 delay-75">
                        <li><a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="#">Usuarios</a></li>
                        <li><a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="#">Perfiles</a></li>
                        <li><a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="#">Servicios</a></li>
                        <li><a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="#">Catálogos</a></li>
                        <li class="relative group">
                            <x-nav-link href="#" class="inline-flex items-center">
                                {{ __('Catálogos Médicos') }}
                                <svg class="ml-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20"><path d="M5.23 7.21a.75.75 0 011.07.02L10 10.878l3.7-3.666a.75.75 0 011.074 1.048l-4.27 4.233a.75.75 0 01-1.074 0L5.23 8.28a.75.75 0 01.02-1.07z"></path></svg>
                            </x-nav-link>
                            <ul class="absolute hidden bg-white shadow-lg rounded mt-2 min-w-max py-1 z-10 transition ease-in-out duration-150 delay-75">
                                <li><a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="{{ route('enfermedades.index') }}">Enfermedades Base</a></li>
                                <li><a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="{{ route('alergias.index') }}">Alergias</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>

            <!-- User Dropdown -->
            <div class="relative ml-4 group">
                <button class="inline-flex items-center text-gray-600 focus:outline-none">
                    {{ Auth::user()->name }}
                    <svg class="ml-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20"><path d="M5.23 7.21a.75.75 0 011.07.02L10 10.878l3.7-3.666a.75.75 0 011.074 1.048l-4.27 4.233a.75.75 0 01-1.074 0L5.23 8.28a.75.75 0 01.02-1.07z"></path></svg>
                </button>
                <ul class="absolute hidden bg-white shadow-lg rounded mt-2 min-w-max py-1 z-10 transition ease-in-out duration-150 delay-75">
                    <li><a class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" href="{{ route('profile.edit') }}">Perfil</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Cerrar sesión</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>


<!-- JavaScript para mostrar el submenú al pasar el mouse con un retraso en el cierre -->
<script>
    document.querySelectorAll('.group').forEach(item => {
        let timeout;

        // Mostrar el submenú al pasar el mouse
        item.addEventListener('mouseenter', () => {
            clearTimeout(timeout); // Cancelar cualquier cierre pendiente
            item.querySelector('ul').classList.remove('hidden'); // Mostrar el submenú
        });

        // Retraso para ocultar el submenú cuando el mouse sale
        item.addEventListener('mouseleave', () => {
            timeout = setTimeout(() => {
                item.querySelector('ul').classList.add('hidden'); // Ocultar el submenú
            }, 100); // Tiempo en milisegundos (ajusta si es necesario)
        });
    });
</script>

