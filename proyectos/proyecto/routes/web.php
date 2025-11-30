<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Livewire\EnviosIndex;
use App\Livewire\EnviosForm;
use App\Livewire\MotoristasIndex;
use App\Livewire\MotoristasForm;
use App\Livewire\VehiculosIndex;
use App\Livewire\VehiculosForm;


Route::get('/', function () {
    return view('welcome');
});

//login
Route::get('/login', function () {
    if (Auth::check()) {
        // Si ya está logueado, redirigir según rol
        if (auth()->user()->rol === 'admin') {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('motorista.dashboard');
        }
    }

    return view('auth.login');
})->name('login');

//procesa login
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

//cerrar sesion
Route::post('/logout', function (Request $request) {
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('login');
})->name('logout');

//rutas del admin
Route::middleware(['auth', 'is_admin'])->group(function () {

    Route::get('/admin', function () {
        return view('dashboard.admin');
    })->name('admin.dashboard');

    // rutas de envíos (estas deben estar dentro del admin)
    Route::get('/envios', EnviosIndex::class)->name('envios.index');
    Route::get('/envios/crear', EnviosForm::class)->name('envios.create');
    Route::get('/envios/{envio}/editar', EnviosForm::class)->name('envios.edit');

});

//rutas para motorista
Route::middleware(['auth', 'is_motorista'])->group(function () {
    Route::get('/motorista', function () {
        return view('dashboard.motorista');
    })->name('motorista.dashboard');
});

Route::middleware(['auth'])->group(function () {

    // rutas para creacion de motoristas
    Route::get('/motoristas', MotoristasIndex::class)->name('motoristas.index');
    Route::get('/motoristas/create', MotoristasForm::class)->name('motoristas.create');
    Route::get('/motoristas/{id}/edit', MotoristasForm::class)->name('motoristas.edit');

    // rutas para creacion de vehículos
    Route::get('/vehiculos', VehiculosIndex::class)->name('vehiculos.index');
    Route::get('/vehiculos/create', VehiculosForm::class)->name('vehiculos.create');
    Route::get('/vehiculos/{id}/edit', VehiculosForm::class)->name('vehiculos.edit');
});