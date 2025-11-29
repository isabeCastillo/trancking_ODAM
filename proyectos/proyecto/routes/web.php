<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});
//login
Route::get('/login', function(){
    if (Auth::check()) {
        // Si ya está logueado, redirigir según rol
        if (auth()->user()->rol === 'admin') {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('motorista.dashboard');
        }
    }
    return view('login.login');
})->name('login');
// Procesar login
Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'username' => ['required'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        if (auth()->user()->rol === 'admin') {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('motorista.dashboard');
        }
    }

    return back()->withErrors([
        'username' => 'Las credenciales no coinciden con nuestros registros.',
    ])->onlyInput('username');
})->name('login.post');

// Cerrar sesión
Route::post('/logout', function (Request $request) {
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('login');
})->name('logout');

// Rutas protegidas por autenticación
Route::middleware('auth')->group(function () {
    Route::get('/admin', function () {
        return view('dashboards.admin');
    })->name('admin.dashboard');

    Route::get('/motorista', function () {
        return view('dashboards.motorista');
    })->name('motorista.dashboard');
});