<?php

namespace App\Http\Livewire\Admin;

use App\Models\PagoRegistrosRecarga;
use App\Models\User;
use Livewire\Component;

class PagosEdit extends Component
{

    public $isopen = false;
    public $registro,$admin_verifi_id,$status,$users_admin;

    public function open()
    {
        $this->isopen = true;  
    }
    public function close()
    {
        $this->isopen = false;  
    }

    protected $rules = [
        'status' => 'required',
        'admin_verifi_id' => 'required'
    ];

    public function mount(PagoRegistrosRecarga $registro){
        $this->registro = $registro;

        if($registro->status == 'verificado'){
            $this->status = 1;
            $this->admin_verifi_id = $registro->admin_second_id;
        }

        $this->users_admin = User::whereHas("roles", function($q){ $q->where("name", "Administrador"); })
        ->where('id','!=',auth()->id())
        ->get();

    }

    public function render()
    {
        return view('livewire.admin.pagos-edit');
    }

    public function save(){
        $rules = $this->rules;
        $this->validate($rules);

        if($this->status == '1'){
            $this->registro->update([
                'status' => 'verificado',
                'admin_first_id' => auth()->id(),
                'admin_second_id' => $this->admin_verifi_id
            ]);
        }

        else{
            $this->registro->update([
                'status' => 'pendiente',
                'admin_first_id' => auth()->id(),
                'admin_second_id' => $this->admin_verifi_id
            ]);

            $user_cliente = User::where('id',$this->registro->user_id)->first();

            $user_cliente->update([
                'status' => 'inactivo',
            ]);

            $user_cliente->roles()->sync(4);
        }

        $this->reset(['isopen']);
        $this->emitTo('admin.pagos-index','render');
        $this->emit('alert','Datos modificados correctamente');
    }
}
