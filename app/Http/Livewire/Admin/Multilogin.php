<?php

namespace App\Http\Livewire\Admin;

use App\Models\Multilog;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Multilogin extends Component
{

    use WithPagination;

    protected $paginationTheme = "bootstrap";

    public $fecha_inicio,$fecha_fin,$vista_registros = 0,$search,$buscador;

    protected $listeners = ['render' => 'render'];

    public function multilog($usuario){

        $mes= date('m');
        $ano= date('Y');
        $dia= date('d');

       

        $user_ip = Multilog::whereDay('created_at', $dia)
        ->whereYear('created_at', $ano)
        ->whereMonth('created_at', $mes)
        ->where('user_id',$usuario)
        ->count();
        

        return $user_ip;
    }

    public function render()
    {
        

        $users = User::paginate(25);

        return view('livewire.admin.multilogin',compact('users'));
    }
}
