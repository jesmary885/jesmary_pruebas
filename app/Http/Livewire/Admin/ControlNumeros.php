<?php

namespace App\Http\Livewire\Admin;

use App\Models\Numeros;
use App\Models\Trabajadores;
use App\Models\User;
use Livewire\Component;
use GuzzleHttp\Client;
use Livewire\WithPagination;

class ControlNumeros extends Component
{

    use WithPagination;

    public $user,$registro_select,$search;

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



        $registros = Numeros::where('numero', 'LIKE', '%' . $this->search . '%')
            ->where('status','activo')
            ->get();

        return view('livewire.admin.control-numeros',compact('registros'));
    }



    public function Eliminar($registro){

        $this->registro_select = $registro;

        $this->emit('confirm', '¿Esta seguro de eliminar el registro?, confirme','admin.control-numeros','confirm_eliminar','Registro eliminado');

    }

    public function confirm_eliminar(){

        Numeros::where('id',$this->registro_select)->first()->delete();

    }


}
