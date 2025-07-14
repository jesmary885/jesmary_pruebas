<?php

namespace App\Http\Livewire\Admin;

use App\Models\CuentasPsid as ModelsCuentasPsid;
use App\Models\Trabajadores;
use App\Models\User;
use Livewire\Component;

class CuentasPsid extends Component
{


    protected $listeners = ['render' => 'render'];

    public function cant_cuentas($user_id){
        return ModelsCuentasPsid::where('user_id',$user_id)->count();
    }

    public function rol($user_id){

        $user = User::where('id',$user_id)
        ->permission('administracion_principal')
        ->first();

        if($user){
            return [
                1 => "text-white text-center",
                2 => 'Administrador',
            ];
        }
        
        else{

            $user_rol = Trabajadores::where('user_id',$user_id)->first()->rol ?? 'No ha sido registrado';

            if($user_rol != 'No ha sido registrado'){

                return [
                    1 => "text-blue-400 text-center",
                    2 => $user_rol,
                ];
            }

            else{
                return [
                    1 => "text-red-400 text-center",
                    2 => 'No ha sido registrado',
                ];

            }

        }

    }

    public function lider($user_id){

        $user = User::where('id',$user_id)
            ->permission('administracion_principal')
            ->first();

        if($user) return '-';
        else{
            $user_lider = Trabajadores::where('user_id',$user_id)->first()->user->username ?? 'No ha sido registrado';

            if($user_lider != 'No ha sido registrado') return $user_lider;
            else return 'No ha sido registrado';
        }

    }


    public function render()
    {

        $users = User::where('status','activo')
            ->where('id','!=','2204')
            ->where('id','!=','2205')
            ->where('id','!=','2206')
            ->permission('menu.premium')
            ->get();

        return view('livewire.admin.cuentas-psid',compact('users'));
    }
}
