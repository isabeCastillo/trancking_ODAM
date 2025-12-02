<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LoginForm extends Component {
    public $username = '';
    public $password = '';
    public $mostrarPassword = false;


    protected $rules = [
        'username' => 'required|string',
        'password' => 'required|string',
    ];

    public function mount(){
        //si ya esta autenticado redirige segun rol
        if (Auth::check()) {
            if (auth()->user()->rol === 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('motorista.dashboard');
            }
        }
    }

    public function login() {
        $this->validate();

        $credentials = [
            'username' => $this->username,
            'password' => $this->password,
        ];

        if (Auth::attempt($credentials)) {
            session()->regenerate();
            if (auth()->user()->rol === 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('motorista.dashboard');
            }
        }

        //si falla muestra error
        $this->addError('auth', 'Usuario o contraseña incorrectos.');
    }

    public function render()
    {
        return view('livewire.auth.login-form')
            ->layout('components.layouts.auth');
    }
}
