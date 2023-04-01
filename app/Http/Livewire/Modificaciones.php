<?php

namespace App\Http\Livewire;

use App\Models\Modificaciones as ModelsModificaciones;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class Modificaciones extends Component
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
     
        $users_modif = ModelsModificaciones::whereHas('user',function(Builder $query){
            $query->where('username','LIKE', '%' . $this->search . '%');
        })
        ->latest('id')
        ->paginate(25);

        return view('livewire.modificaciones',compact('users_modif'));
    }
}
