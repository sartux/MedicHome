// Archivo: app/Http/Middleware/CheckNucleoFamiliarAccess.php

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckNucleoFamiliarAccess
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();
        
        // Verificar si el usuario está autenticado
        if (!$user) {
            return redirect()->route('login');
        }
        
        // Superadmin puede acceder a todo
        if ($user->isSuperAdmin()) {
            return $next($request);
        }
        
        // Si el usuario está vinculado a un núcleo
        if ($user->nucleo_familiar_id) {
            $nucleo = $user->nucleoFamiliar;
            
            // Verificar si el núcleo está activo
            if (!$nucleo || !$nucleo->isActivo()) {
                auth()->logout();
                return redirect()->route('login')
                    ->with('error', 'El acceso a su núcleo familiar ha sido desactivado. Contacte al administrador.');
            }
            
            // Si el usuario es admin de núcleo, permitir acceso
            if ($user->isNucleoAdmin()) {
                return $next($request);
            }
        }
        
        // En otros casos, redireccionar o mostrar error
        return redirect()->route('dashboard')
            ->with('error', 'No tiene permisos para acceder a esta sección.');
    }
}