<?php

namespace App\Http\Livewire\Ktmr;

use App\Models\CuentasKtmr;
use Livewire\Component;

class CuentasCrearDatos extends Component
{
    public $isopen = false;
    public $correo,$password, $link_inicial, $cuenta_id;

    protected $rules = [
        'correo' => 'required|email',
        'password' => 'required',
    ];

    public function mount($cuenta_id){
        $this->cuenta_id = $cuenta_id;

        $c = CuentasKtmr::where('id',$this->cuenta_id )->first();

        $this->correo = $c->email;
        $this->password = $c->password;
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
        return view('livewire.ktmr.cuentas-crear-datos');
    }

    public function guardar(){

        $rules = $this->rules;
        $this->validate($rules);

        $datos = CuentasKtmr::where('id', $this->cuenta_id) 
        ->first();
      
        $datos->update([
            'email' => $this->correo,
            'password' => $this->password,
           
        ]);
  
        $this->reset(['isopen']);
        $this->emitTo('ktmr.cuentas','render');
        $this->emit('alert','Datos cargados correctamente');
    }
}
