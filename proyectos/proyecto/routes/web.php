<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Livewire\Auth\LoginForm;
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Motorista\Dashboard as MotoristaDashboard;
use App\Livewire\EnviosIndex;
use App\Livewire\EnviosForm;
use App\Livewire\MotoristasIndex;
use App\Livewire\MotoristasForm;
use App\Livewire\VehiculosIndex;
use App\Livewire\VehiculosForm;
use App\Livewire\UsersIndex;
use App\Livewire\UsersForm;
use App\Livewire\MotoristaEnvios;
use App\Livewire\Tracking;
use App\Livewire\MotoristaVehiculo;

Route::get('/', function () {
    return redirect()->route('login');
});

// LOGIN
Route::get('/login', LoginForm::class)
    ->name('login')
    ->middleware('guest');

// LOGOUT
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('login');
})->name('logout');

// ADMIN
Route::middleware(['auth', 'is_admin'])->group(function () {

    Route::get('/admin', AdminDashboard::class)->name('admin.dashboard');

    // ENVÍOS
    Route::get('/envios', EnviosIndex::class)->name('envios.index');
    Route::get('/envios/crear', EnviosForm::class)->name('envios.create');
    Route::get('/envios/{envio}/editar', EnviosForm::class)->name('envios.edit');

    // USUARIOS
    Route::get('/usuarios', UsersIndex::class)->name('usuarios.index');
    Route::get('/usuarios/crear', UsersForm::class)->name('usuarios.create');
    Route::get('/usuarios/{user}/editar', UsersForm::class)->name('usuarios.edit');

    // MOTORISTAS
    Route::get('/motoristas', MotoristasIndex::class)->name('motoristas.index');
    Route::get('/motoristas/crear', MotoristasForm::class)->name('motoristas.create');
    Route::get('/motoristas/{user}/editar', MotoristasForm::class)->name('motoristas.edit');

    // VEHÍCULOS
    Route::get('/vehiculos', VehiculosIndex::class)->name('vehiculos.index');
    Route::get('/vehiculos/create', VehiculosForm::class)->name('vehiculos.create');
    Route::get('/vehiculos/{vehiculo}/editar', VehiculosForm::class)->name('vehiculos.edit');

    Route::get('/admin/tracking', Tracking::class)->name('admin.tracking');
    
});

Route::middleware(['auth', 'is_motorista'])->group(function () {
    Route::get('/motorista', MotoristaDashboard::class)
        ->name('motorista.dashboard');

    Route::get('/motorista/envios', MotoristaEnvios::class)
        ->name('motorista.envios');

    Route::get('/motorista/tracking', Tracking::class)->name('motorista.tracking');

    Route::get('/motorista/vehiculo', MotoristaVehiculo::class)
        ->name('motorista.vehiculo');

});

