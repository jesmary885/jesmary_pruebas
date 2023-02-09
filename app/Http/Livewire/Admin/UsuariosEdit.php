<?php

namespace App\Http\Livewire\Admin;

use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Livewire\Component;

class UsuariosEdit extends Component
{
    public $estado_id ="", $roles_id, $last_date, $plan, $balance;
    public $usuario;
    public $username, $roles, $email, $estado = 'inactivo', $password, $password_confirm;

    public $isopen = false;

      
    protected $rules = [
        'estado' => 'required',
        'username' => 'required|max:30',
        'roles_id' => 'required',
    ];

    public function mount(){
        $this->username = $this->usuario->username;
        $this->email = $this->usuario->email;
        if( $this->usuario->status =='activo') $this->estado=1 ; else $this->estado = 0;
        $this->last_date = $this->usuario->last_payment_date;
        $this->balance = $this->usuario->balance;
        $this->plan = $this->usuario->plan;
        $this->roles_id = $this->usuario->roles->first()->id;
        $this->roles=Role::all();
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
        return view('livewire.admin.usuarios-edit');
    }

    public function update(){
        $rules = $this->rules;
        $this->validate($rules);

        $rule_email = [
            'email' => 'required|max:50|email|unique:users,email,' .$this->usuario->id,
        ];

        $this->validate($rule_email);

        if($this->estado == 0) $estado = 'inactivo'; else $estado = 'activo';
 
        $this->usuario->update([
            'name' => $this->username,
            'username' => $this->username,
            'email' => $this->email,
            'status' => $estado,
            'balance' => $this->balance,
            'plan' => $this->plan,
            'last_payment_date' => date("Y-m-d", strtotime($this->last_date)),
        ]);
        $this->usuario->roles()->sync($this->roles_id);

        $this->reset(['isopen']);
        $this->emitTo('admin.usuarios-index','render');
        $this->emit('alert','Datos modificados correctamente');
    }
}
