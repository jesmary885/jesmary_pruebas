<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsuariosPaying extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    protected $listeners = ['render' => 'render'];

    public $search;

    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {
        $users = User::where('type',null)
        ->latest('id')
        ->paginate(20);
        
        $total = User::where('type',null)
        ->count();

        return view('livewire.admin.usuarios-paying',compact('users','total'));
    }
}
