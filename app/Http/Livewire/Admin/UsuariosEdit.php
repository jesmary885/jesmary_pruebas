<?php

namespace App\Http\Livewire\Admin;

use App\Models\Modificaciones;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Livewire\Component;

class UsuariosEdit extends Component
{
    public $estado_id ="", $roles_id, $last_date, $plan, $balance, $comentario;
    public $usuario;
    public $username, $roles, $email, $estado = 'inactivo', $password, $password_confirm;

    public $isopen = false;

      
    protected $rules = [
        'estado' => 'required',
        'username' => 'required|max:30',
        'roles_id' => 'required',
        'comentario' => 'required',


    ];

    public function mount(){
        $this->username = $this->usuario->username;
        $this->email = $this->usuario->email;
        if( $this->usuario->status =='activo') $this->estado=1 ; else $this->estado = 0;
        $this->last_date = $this->usuario->last_payment_date;
        $this->balance = $this->usuario->balance;
        $this->plan = $this->usuario->type;
        $this->roles_id = $this->usuario->roles->first()->id;
        $this->roles=Role::where('id','!=','1')
            ->where('id','!=','13')
            ->get();
        //$this->roles=Role::all();
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

        if(auth()->user()->id != 3){

            $rule_email = [
                'email' => 'required|max:50|email|unique:users,email,' .$this->usuario->id,
            ];
    
            $this->validate($rule_email);
    
            $rule_username = [
                'username' => 'required|max:30|unique:users,username,' .$this->usuario->id,
            ];
    
            $this->validate($rule_username);
    
    
            if($this->estado == 0) $estado = 'inactivo'; 
            else $estado = 'activo';
    
            
            if($this->roles_id == '2'){
                if($this->usuario->type != 'gratis'){
                    $this->usuario->update([
                        'name' => $this->username,
                        'username' => $this->username,
                        'email' => $this->email,
                        'status' => $estado,
                        'type' => $this->plan,
                        'last_payment_date' => date("Y-m-d", strtotime($this->last_date)),
                    ]);
                }
                else{
                    $this->usuario->update([
                        'name' => $this->username,
                        'username' => $this->username,
                        'email' => $this->email,
                        'status' => $estado,
                        'type' => $this->plan,
                        'last_payment_date' => date("Y-m-d", strtotime($this->last_date)),
                    ]);
                }
    
            }
    
            if($this->roles_id == '4'){
                if($this->usuario->type != 'gratis'){
                    $this->usuario->update([
                        'name' => $this->username,
                        'username' => $this->username,
                        'email' => $this->email,
                        'status' => $estado,
                        'type' => $this->plan,
                    ]);
                }
            }
    
            if($this->roles_id == '10'){
                if($this->usuario->type != 'gratis'){
                    $this->usuario->update([
                        'name' => $this->username,
                        'username' => $this->username,
                        'email' => $this->email,
                        'status' => $estado,
                        'type' => $this->plan,
                        'last_payment_date' => date("Y-m-d", strtotime($this->last_date)),
                    ]);
                }
    
                else{
                    $this->usuario->update([
                        'name' => $this->username,
                        'username' => $this->username,
                        'email' => $this->email,
                        'status' => $estado,
                        'type' => $this->plan,
                        'last_payment_date' => date("Y-m-d", strtotime($this->last_date)),
                    ]);
                }
    
            }
     
           
            $this->usuario->roles()->sync($this->roles_id);
    
    
            $user_mod = new Modificaciones();
            $user_mod->user_id = $this->usuario->id;
            $user_mod->admin_id = auth()->user()->id;
            $user_mod->justificacion = $this->comentario;
            $user_mod->save();
    
            $this->reset(['isopen']);
            $this->emitTo('admin.usuarios-index','render');
            $this->emit('alert','Datos modificados correctamente');
            
        }

    }
}
