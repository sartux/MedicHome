<nav class="bg-white border-b border-gray-200" style="background-color: #2C9B4E;">
    <div class="container mx-auto px-4 py-3 flex justify-between items-center">
        <!-- Logo -->
        <a class="text-lg font-semibold text-white" href="{{ route('dashboard') }}">
            <x-application-logo class="h-10" />
        </a>

        <!-- Mobile Toggle Button -->
        <button class="lg:hidden flex items-center px-3 py-2 border rounded text-white border-white hover:text-gray-200 hover:border-gray-200 focus:outline-none" 
                onclick="document.getElementById('navbarNav').classList.toggle('hidden')">
            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"><path d="M3 6h14M3 12h14M3 18h14"/></svg>
        </button>

        <!-- Nav Links -->
        <div class="hidden lg:flex items-center space-x-4" id="navbarNav">
            <ul class="flex space-x-4">
                <!-- Dashboard Link -->
                <li>
                    <a href="{{ route('dashboard') }}" class="text-white hover:text-gray-200 px-3 py-2 rounded-md text-sm font-medium {{ request()->routeIs('dashboard') ? 'bg-green-700' : '' }}">
                        <i class="fas fa-chart-line mr-1"></i> Dashboard
                    </a>
                </li>

                <!-- Dropdown: Familia -->
                <li class="relative group">
                    <button class="text-white hover:text-gray-200 px-3 py-2 rounded-md text-sm font-medium">
                        <i class="fas fa-users mr-1"></i> Familia <i class="fas fa-chevron-down ml-1 text-xs"></i>
                    </button>
                    <ul class="absolute hidden bg-white shadow-lg rounded-md mt-2 min-w-max py-2 z-10 transition ease-in-out duration-150">
                        <li><a class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-100 hover:text-green-900" href="{{ route('familiares.index') }}">
                            <i class="fas fa-list mr-1"></i> Ver Familiares
                        </a></li>
                        <li><a class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-100 hover:text-green-900" href="{{ route('familiares.create') }}">
                            <i class="fas fa-user-plus mr-1"></i> Agregar Familiar
                        </a></li>
                    </ul>
                </li>

                <!-- Dropdown: Medicamentos -->
                <li class="relative group">
                    <button class="text-white hover:text-gray-200 px-3 py-2 rounded-md text-sm font-medium">
                        <i class="fas fa-pills mr-1"></i> Medicamentos <i class="fas fa-chevron-down ml-1 text-xs"></i>
                    </button>
                    <ul class="absolute hidden bg-white shadow-lg rounded-md mt-2 min-w-max py-2 z-10 transition ease-in-out duration-150">
                        <li><a class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-100 hover:text-green-900" href="{{ route('medicamentos.index') }}">
                            <i class="fas fa-list mr-1"></i> Ver Medicamentos
                        </a></li>
                        <li><a class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-100 hover:text-green-900" href="{{ route('medicamentos.create') }}">
                            <i class="fas fa-plus-circle mr-1"></i> Agregar Medicamento
                        </a></li>
                    </ul>
                </li>

                <!-- Dropdown: Configuración -->
                <li class="relative group">
                    <button class="text-white hover:text-gray-200 px-3 py-2 rounded-md text-sm font-medium">
                        <i class="fas fa-cog mr-1"></i> Configuración <i class="fas fa-chevron-down ml-1 text-xs"></i>
                    </button>
                    <ul class="absolute hidden bg-white shadow-lg rounded-md mt-2 min-w-max py-2 z-10 transition ease-in-out duration-150">
                        <li><a class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-100 hover:text-green-900" href="#">
                            <i class="fas fa-user-cog mr-1"></i> Usuarios
                        </a></li>
                        <li><a class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-100 hover:text-green-900" href="#">
                            <i class="fas fa-id-card mr-1"></i> Perfiles
                        </a></li>
                        <li><a class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-100 hover:text-green-900" href="#">
                            <i class="fas fa-clipboard-list mr-1"></i> Catálogos
                        </a></li>
                        <li class="relative group">
                            <div class="block px-4 py-2 text-sm text-gray-700 flex justify-between items-center hover:bg-green-100 hover:text-green-900 cursor-pointer">
                                <span><i class="fas fa-heartbeat mr-1"></i> Catálogos Médicos</span>
                                <i class="fas fa-chevron-right text-xs"></i>
                            </div>
                            <ul class="absolute hidden bg-white shadow-lg rounded-md left-full top-0 min-w-max py-2 z-10 transition ease-in-out duration-150">
                                <li><a class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-100 hover:text-green-900" href="{{ route('enfermedades.index') }}">
                                    <i class="fas fa-viruses mr-1"></i> Enfermedades Base
                                </a></li>
                                <li><a class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-100 hover:text-green-900" href="{{ route('alergias.index') }}">
                                    <i class="fas fa-allergies mr-1"></i> Alergias
                                </a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>

            <!-- User Dropdown -->
            <div class="relative ml-4 group">
                <button class="inline-flex items-center text-white bg-green-700 hover:bg-green-800 px-3 py-2 rounded-md text-sm font-medium focus:outline-none">
                    <i class="fas fa-user-circle mr-2"></i>
                    {{ Auth::user()->name }}
                    <i class="fas fa-chevron-down ml-2 text-xs"></i>
                </button>
                <ul class="absolute hidden bg-white shadow-lg rounded-md mt-2 right-0 min-w-max py-2 z-10 transition ease-in-out duration-150">
                    <li><a class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-100 hover:text-green-900" href="{{ route('profile.edit') }}">
                        <i class="fas fa-user-edit mr-1"></i> Mi Perfil
                    </a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-green-100 hover:text-green-900">
                                <i class="fas fa-sign-out-alt mr-1"></i> Cerrar Sesión
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<!-- JavaScript mejorado para los menús desplegables -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Seleccionamos todos los elementos dropdown
        const dropdowns = document.querySelectorAll('.group');
        
        // Variable para almacenar los timeouts
        let timeouts = {};
        
        dropdowns.forEach((dropdown, index) => {
            const button = dropdown.querySelector('button') || dropdown.querySelector('a');
            const submenu = dropdown.querySelector('ul');
            
            if (!button || !submenu) return;
            
            // ID único para este dropdown
            const dropdownId = `dropdown-${index}`;
            
            // Al hacer hover sobre el dropdown
            dropdown.addEventListener('mouseenter', () => {
                // Cancelar cualquier cierre pendiente
                if (timeouts[dropdownId]) {
                    clearTimeout(timeouts[dropdownId]);
                    delete timeouts[dropdownId];
                }
                
                // Mostrar el menú
                submenu.classList.remove('hidden');
            });
            
            // Al salir del dropdown
            dropdown.addEventListener('mouseleave', () => {
                // Retrasar el cierre para dar tiempo de mover el cursor al submenú
                timeouts[dropdownId] = setTimeout(() => {
                    submenu.classList.add('hidden');
                    delete timeouts[dropdownId];
                }, 300); // Retraso de 300ms antes de cerrar
            });
            
            // Si hay un submenu dentro de este dropdown (dropdown anidado)
            const nestedDropdowns = dropdown.querySelectorAll('.group');
            
            nestedDropdowns.forEach((nestedDropdown, nestedIndex) => {
                const nestedButton = nestedDropdown.querySelector('.group > div') || nestedDropdown.querySelector('.group > a');
                const nestedSubmenu = nestedDropdown.querySelector('ul');
                
                if (!nestedButton || !nestedSubmenu) return;
                
                // ID único para este dropdown anidado
                const nestedDropdownId = `${dropdownId}-nested-${nestedIndex}`;
                
                // Al hacer hover sobre el dropdown anidado
                nestedDropdown.addEventListener('mouseenter', (e) => {
                    // Detener la propagación para evitar conflictos con el parent
                    e.stopPropagation();
                    
                    // Cancelar cualquier cierre pendiente
                    if (timeouts[nestedDropdownId]) {
                        clearTimeout(timeouts[nestedDropdownId]);
                        delete timeouts[nestedDropdownId];
                    }
                    
                    // Mostrar submenu
                    nestedSubmenu.classList.remove('hidden');
                });
                
                // Al salir del dropdown anidado
                nestedDropdown.addEventListener('mouseleave', (e) => {
                    // Detener la propagación
                    e.stopPropagation();
                    
                    // Retrasar el cierre
                    timeouts[nestedDropdownId] = setTimeout(() => {
                        nestedSubmenu.classList.add('hidden');
                        delete timeouts[nestedDropdownId];
                    }, 300);
                });
            });
            
            // Agregar manejo de click para dispositivos táctiles
            button.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                
                // Toggle el submenu
                if (submenu.classList.contains('hidden')) {
                    submenu.classList.remove('hidden');
                } else {
                    submenu.classList.add('hidden');
                }
            });
        });
    });
</script>