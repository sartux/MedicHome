<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckNucleoFamiliarActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();
            
            // El superadmin siempre puede acceder
            if ($user->is_superadmin) {
                return $next($request);
            }
            
            // Verificar si el usuario tiene un núcleo familiar activo
            if (!$user->puedeAcceder()) {
                Auth::logout();
                
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                
                return redirect()->route('login')
                    ->with('error', 'Tu cuenta está desactivada. Contacta al administrador.');
            }
        }
        
        return $next($request);
    }
}