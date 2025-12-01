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
use App\Livewire\Auth\LoginForm;

Route::get('/', function () {
    return redirect()->route('login');
});

//login
Route::get('/login', LoginForm::class)
    ->name('login')
    ->middleware('guest');

//cerrar sesion
Route::post('/logout', function (Request $request) {
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('login');
})->name('logout');

//ruta del admin
Route::middleware(['auth', 'is_admin'])->group(function () {

    Route::get('/admin', function () {
        return view('dashboard.admin');
    })->name('admin.dashboard');

    Route::get('/envios', EnviosIndex::class)->name('envios.index');
    Route::get('/envios/crear', EnviosForm::class)->name('envios.create');
    Route::get('/envios/{envio}/editar', EnviosForm::class)->name('envios.edit');
});

//ruta para el motorista
Route::middleware(['auth', 'is_motorista'])->group(function () {
    Route::get('/motorista', function () {
        return view('dashboard.motorista');
    })->name('motorista.dashboard');
});

//Rutas para cualquier usuario autenticado
Route::middleware(['auth'])->group(function () {

    Route::get('/motoristas', MotoristasIndex::class)->name('motoristas.index');
    Route::get('/motoristas/crear', MotoristasForm::class)->name('motoristas.create');
    Route::get('/motoristas/{user}/editar', MotoristasForm::class)->name('motoristas.edit');

    Route::get('/vehiculos', VehiculosIndex::class)->name('vehiculos.index');
    Route::get('/vehiculos/create', VehiculosForm::class)->name('vehiculos.create');
    Route::get('/vehiculos/{vehiculo}/editar', VehiculosForm::class)->name('vehiculos.edit');
});
