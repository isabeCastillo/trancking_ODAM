<?php

namespace App\Livewire\Motoristas;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class MotoristasForm extends Component
{
    public $user;
    public $name, $email, $username, $password;

    public function mount(?User $user = null)
    {
        $this->user = $user;

        if ($user) {
            $this->name = $user->name;
            $this->email = $user->email;
            $this->username = $user->username;
        }
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'username' => 'required|string',
            'password' => $this->user ? 'nullable' : 'required',
        ]);

        if ($this->user) {
            $this->user->update([
                'name' => $this->name,
                'email' => $this->email,
                'username' => $this->username,
                'rol' => 'motorista',
            ]);

            if ($this->password) {
                $this->user->update([
                    'password' => Hash::make($this->password),
                ]);
            }
        } else {
            User::create([
                'name' => $this->name,
                'email' => $this->email,
                'username' => $this->username,
                'password' => Hash::make($this->password),
                'rol' => 'motorista',
            ]);
        }

        return redirect()->route('motoristas.index');
    }

    public function render()
    {
        return view('motoristas.form');
    }
}

