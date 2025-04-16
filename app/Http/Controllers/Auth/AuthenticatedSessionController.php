<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
    
        $request->session()->regenerate();
        
        // Verificar si el núcleo familiar del usuario está activo
        $user = auth()->user();
        if ($user->nucleo_familiar_id && !$user->isSuperAdmin()) {
            $nucleo = $user->nucleoFamiliar;
            
            if (!$nucleo || !$nucleo->isActivo()) {
                auth()->logout();
                return redirect()->route('login')
                    ->with('error', 'El acceso a su núcleo familiar ha sido desactivado. Contacte al administrador.');
            }
        }
    
        return redirect()->intended(RouteServiceProvider::HOME);
    }
    

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
