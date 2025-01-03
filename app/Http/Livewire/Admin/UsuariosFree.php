<?php

namespace App\Http\Livewire\Admin;

use App\Models\Link;
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

        $users = User::where('type','gratis')
        ->latest('id')
        ->where('id','!=','2017')
        ->where('id','!=','2018')
        ->where('id','!=','2019')
        ->where('id','!=','2020')
        ->where('id','!=','2021')
        ->where('id','!=','2022')
        ->where('id','!=','2023')
        ->where('id','!=','2024')
        ->where('id','!=','2033')
        ->where('id','!=','2034')
        ->where('id','!=','2036')
        ->where('id','!=','2037')
        ->where('id','!=','2038')
        ->where('id','!=','2039')
        ->where('id','!=','2040')
        ->paginate(20);

        $total = User::where('type','gratis')
        ->where('id','!=','2017')
        ->where('id','!=','2018')
        ->where('id','!=','2019')
        ->where('id','!=','2020')
        ->where('id','!=','2021')
        ->where('id','!=','2022')
        ->where('id','!=','2023')
        ->where('id','!=','2024')
        ->where('id','!=','2033')
        ->where('id','!=','2034')
        ->where('id','!=','2036')
        ->where('id','!=','2037')
        ->where('id','!=','2038')
        ->where('id','!=','2039')
        ->where('id','!=','2040') 
        ->count();
        
        return view('livewire.admin.usuarios-free',compact('users','total'));
    }
}
