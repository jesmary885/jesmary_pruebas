<?php

namespace App\Http\Livewire\Ktmr;

use App\Models\CuentasKtmr;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Administracion extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    protected $listeners = ['render' => 'render'];

    public $search,$user_autentic;

    public function updatingSearch(){
        $this->resetPage();
    }

    public function cant_jump($user_id){

        return CuentasKtmr::where('user_id', $user_id) 
        ->count();

    }

    public function render()
    {

        $users = User::where('username', 'LIKE', '%' . $this->search . '%')
            ->permission('menu.ktmr')
            ->latest('id')
            ->paginate(20);

        return view('livewire.ktmr.administracion',compact('users'));
    }
}
