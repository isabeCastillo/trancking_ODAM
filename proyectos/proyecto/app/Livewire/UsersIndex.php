<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class UsersIndex extends Component
{
    use WithPagination;

    protected string $paginationTheme = 'tailwind';

    public string $search = '';
    public string $rol    = '';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingRol(): void
    {
        $this->resetPage();
    }

    public function eliminar(int $id): void
    {
        //evitar borrar al usuario autenticado
        if (auth()->id() === $id) {
            session()->flash('message', 'No puedes eliminar tu propio usuario.');
            return;
        }

        $user = User::findOrFail($id);
        $user->delete();

        session()->flash('message', 'Usuario eliminado correctamente.');
    }

    public function render()
    {
        $query = User::query()->orderBy('name');

        if ($this->search !== '') {
            $texto = '%' . $this->search . '%';
            $query->where(function ($q) use ($texto) {
                $q->where('name', 'like', $texto)
                  ->orWhere('username', 'like', $texto)
                  ->orWhere('email', 'like', $texto);
            });
        }

        if ($this->rol !== '') {
            $query->where('rol', $this->rol);
        }

        return view('livewire.users-index', [
            'usuarios' => $query->paginate(10),
        ]);
    }
}
