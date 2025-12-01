<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class UsersForm extends Component {
    public ?User $user = null;

    public string $name = '';
    public string $username = '';
    public string $email = '';
    public string $rol = 'motorista';
    public string $password = '';
    public string $password_confirmation = '';

    public function mount(User $user = null): void {
        if ($user && $user->exists) {
            $this->user = $user;
            $this->name = $user->name;
            $this->username = $user->username;
            $this->email = $user->email;
            $this->rol = $user->rol;
        }
    }

    public function rules(): array {
        $userId = $this->user?->id;

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users', 'username')->ignore($userId),
            ],
            'email' => [
                'nullable',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($userId),
            ],
            'rol' => ['required', Rule::in(['admin', 'motorista'])],
        ];

        // Si es creación, la contraseña es obligatoria
        if (!$this->user) {
            $rules['password'] = ['required', 'min:6', 'confirmed'];
        } else {
            // En edición, solo si se escribe algo en password
            if ($this->password !== '') {
                $rules['password'] = ['required', 'min:6', 'confirmed'];
            }
        }

        return $rules;
    }

    public function guardar(){
        $data = $this->validate();

        $values = [
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'rol' => $this->rol,
        ];

        if ($this->password !== '') {
            $values['password'] = Hash::make($this->password);
        }

        if ($this->user && $this->user->exists) {
            $this->user->update($values);
            session()->flash('message', 'Usuario actualizado correctamente.');
        } else {
            $this->user = User::create($values);
            session()->flash('message', 'Usuario creado correctamente.');
        }

        return redirect()->route('usuarios.index');
    }

    public function render()
    {
        return view('livewire.users-form');
    }
}
