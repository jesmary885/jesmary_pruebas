<?php

namespace App\Http\Livewire\Admin;

use App\Models\Link;
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

    public function links($user){
        return Link::where('user_id',$user)->count();
        
    }

    public function links_negativos($user){
        return Link::where('user_id',$user)
            ->where('negative_points','>','2')
            ->count();
    }

    public function render()
    {
        $users = User::where('type','!=','gratis')
        ->latest('id')
        ->paginate(20);
        
        $total = User::where('type','!=','gratis')
        ->count();

        return view('livewire.admin.usuarios-paying',compact('users','total'));
    }
}
