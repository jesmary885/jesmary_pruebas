<?php

namespace App\Http\Livewire\Admin;

use App\Models\CuentaK;
use Livewire\Component;
use Livewire\WithPagination;

class Registroc extends Component
{

     use WithPagination;

    public $user,$registro_select;

     protected $paginationTheme = "bootstrap";

    protected $listeners = [
        'render' => 'render',
        'confirm_eliminar' => 'confirm_eliminar' 
    ];

    public function mount(){
        $this->user = auth()->user();
    }
    public function render()
    {

        $registros = CuentaK::where('user_id',$this->user->id)
            ->paginate(15);

        return view('livewire.admin.registroc',compact('registros'));
    }

    public function Eliminar($registro){

        $this->registro_select = $registro;

        $this->emit('confirm', '¿Esta seguro de eliminar el registro?, confirme','admin.registroc','confirm_eliminar','Registro eliminado');

    }

    public function confirm_eliminar(){

        CuentaK::where('id',$this->registro_select)->first()->delete();

    }


}
