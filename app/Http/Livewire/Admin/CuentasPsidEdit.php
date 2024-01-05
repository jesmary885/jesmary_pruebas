<?php

namespace App\Http\Livewire\Admin;

use App\Models\Trabajadores;
use App\Models\User;
use Livewire\Component;

class CuentasPsidEdit extends Component
{

    public $rol,$admin,$users_admin,$usuario;

    public $isopen = false;

    protected $rules = [
        'rol' => 'required',
        'admin' => 'required',
    ];

    public function mount($usuario){

        $this->usuario = $usuario;

        $this->users_admin = User::whereHas("roles", function($q){ $q->where("name", "Administrador"); })
        ->get();

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
        return view('livewire.admin.cuentas-psid-edit');
    }

    public function guardar(){

    
        $rules = $this->rules;
        $this->validate($rules);

        $trabajador = Trabajadores::where('user_id', $this->usuario->id)->first();

        if($trabajador){

            $trabajador->update([
                'lider_id' => $this->admin,
                'rol' => $this->rol,
            ]);
        }
        else{
            $user_m = new Trabajadores();
            $user_m->user_id = $this->usuario->id;
            $user_m->lider_id = $this->admin;
            $user_m->rol = $this->rol;
            $user_m->save();
        }

        $this->reset(['isopen']);
        $this->emitTo('admin.cuentas-psid','render');
        $this->emit('alert','Datos guardados correctamente');
    }
}
