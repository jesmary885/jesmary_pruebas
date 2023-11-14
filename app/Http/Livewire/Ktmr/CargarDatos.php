<?php

namespace App\Http\Livewire\Ktmr;

use App\Models\CuentasKtmr;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CargarDatos extends Component
{
    public $isopen = false;
    public $correo,$password, $link_inicial;

    protected $rules = [
        'correo' => 'required|email',
        'password' => 'required',
    ];

    public function mount($inicial){
        $this->link_inicial = $inicial;
    }

    public function open()
    {
        $this->isopen = true;  
    }
    public function close()
    {
        $this->isopen = false;  
    }

    public function render()
    {
        return view('livewire.ktmr.cargar-datos');
    }

    public function guardar(){

        $rules = $this->rules;
        $this->validate($rules);

        $datos = CuentasKtmr::where('user_id', Auth::id()) 
        ->where('link_inicial',$this->link_inicial)
        ->first();
      
        $datos->update([
            'email' => $this->correo,
            'password' => $this->password,
           
        ]);
  
        $this->reset(['isopen']);
        $this->emit('alert','Datos cargados correctamente');
    }
}
