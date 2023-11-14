<?php

namespace App\Http\Livewire\Ktmr;

use App\Models\CuentasKtmr;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;

class AdministracionCuentas extends Component
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

        $users = CuentasKtmr::whereHas('user',function(Builder $query){
            $query->where('name','LIKE', '%' . $this->search . '%');
        })
        ->latest('id')
        ->paginate(20);

        return view('livewire.ktmr.administracion-cuentas',compact('users'));
    }
}
