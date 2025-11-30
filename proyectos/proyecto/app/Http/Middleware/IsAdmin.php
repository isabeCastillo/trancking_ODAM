<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //este revisa si ya autentico si no va directo al login
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        // si no es admin lo mandara directamente al dashboard correpondiete segun su rol
        if (auth()->user()->rol !== 'admin') {
            if (auth()->user()->rol === 'motorista') {
                return redirect()->route('motorista.dashboard');
            }
            return redirect()->route('login');
        }
        return $next($request);
    }
}
