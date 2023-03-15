<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsuariosFree extends Component
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

        $users = User::where('type','gratis')
        ->latest('id')
        ->paginate(20);

        $total = User::where('type','gratis')
        ->count();
        
        return view('livewire.admin.usuarios-free',compact('users','total'));
    }
}
