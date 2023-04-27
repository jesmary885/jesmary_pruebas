<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

use App\Models\Link;
use App\Models\Links_usados;
use App\Models\User;
use Livewire\WithPagination;
use DateTime;


class UsersJump extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    protected $listeners = ['render' => 'render'];

    public $search, $vista_registros = 0,$total_registros;

    public function updatingSearch(){
        $this->resetPage();
    }

    public function cant_k1000($user){

        $date = new DateTime();

        $date_actual= $date->format('Y-m-d');

        $cant_k1000 = Links_usados::where('user_id',$user)
            ->whereDate('created_at',$date_actual)
            ->where('k_detected','K=1000_NEW')
            ->count();

        return $cant_k1000;
        
    }

    public function cant_k23($user){

        $date = new DateTime();

        $date_actual= $date->format('Y-m-d');

        $cant_k1000 = Links_usados::where('user_id',$user)
            ->whereDate('created_at',$date_actual)
            ->where('k_detected','K=23_NEW')
            ->count();

        return $cant_k1000;
        
    }

    public function cant_k1083($user){

        $date = new DateTime();

        $date_actual= $date->format('Y-m-d');

        $cant_k1000 = Links_usados::where('user_id',$user)
            ->whereDate('created_at',$date_actual)
            ->where('k_detected','K=1083_NEW')
            ->count();

        return $cant_k1000;
        
    }

    public function render()
    {

        $users = User::where('username', 'LIKE', '%' . $this->search . '%')
        ->where('type','!=','gratis')
        ->where('status','activo')
        ->permission('menu.premium')
        ->latest('id')
        ->paginate(20);
    
        return view('livewire.admin.users-jump',compact('users'));
    }
}
