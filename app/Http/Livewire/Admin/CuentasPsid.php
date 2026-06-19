<?php

namespace App\Http\Livewire\Admin;

use App\Models\CuentasPsid as ModelsCuentasPsid;
use App\Models\Trabajadores;
use App\Models\User;
use Livewire\Component;

class CuentasPsid extends Component
{


    protected $listeners = ['render' => 'render'];

    public $user_autentic;

    public function cant_cuentas($user_id){
        return ModelsCuentasPsid::where('user_id',$user_id)->count();
    }

    public function mount(){

        $this->user_autentic = auth()->user()->id;
    }

    public function rol_numero_quitar($userID){

        $user = User::where('id',$userID)->first();
        $roles_user = $user->roles->all();
        $rol_numero = 0;

        foreach($roles_user as $rol){
            if($rol->id == 23) $rol_numero = 1;
        }

        if($rol_numero == 1) $user->roles()->detach(23);

        $this->emit('alert','Rol de numeros PVA eliminado');
    }

    public function rol_numero($userID){

        $user = User::where('id',$userID)->first();
        $roles_user = $user->roles->all();
        $inactivo = 0;

        foreach($roles_user as $rol){
            if($rol->id == 4) $inactivo = 1;
        }

        $user->assignRole('Numeros PVA');

        if($inactivo == 1) $user->roles()->detach(4);

        $this->emit('alert','Rol agregado correctamente');
    }



    public function rol_junkie_quitar($userID){

        $user = User::where('id',$userID)->first();
        $roles_user = $user->roles->all();
        $rol_junkie = 0;

        foreach($roles_user as $rol){
            if($rol->id == 26) $rol_junkie = 1;
        }

        if($rol_junkie == 1) $user->roles()->detach(26);

        $this->emit('alert','Rol de junkie eliminado');
    }


    public function rol_junkie($userID){

        $user = User::where('id',$userID)->first();
        $roles_user = $user->roles->all();
        $inactivo = 0;

        foreach($roles_user as $rol){
            if($rol->id == 4) $inactivo = 1;
        }

        $user->assignRole('JUNKIE');

        if($inactivo == 1) $user->roles()->detach(4);

        $this->emit('alert','Rol agregado correctamente');
    }


    public function rol_listarssi_quitar($userID){

        $user = User::where('id',$userID)->first();
        $roles_user = $user->roles->all();
        $rol_ssi = 0;

        foreach($roles_user as $rol){
            if($rol->id == 25) $rol_ssi = 1;
        }

        if($rol_ssi == 1) $user->roles()->detach(25);

        $this->emit('alert','Rol de listar SSI eliminado');
    }

    public function rol_listar_ssi($userID){

        $user = User::where('id',$userID)->first();
        $roles_user = $user->roles->all();
        $inactivo = 0;

        foreach($roles_user as $rol){
            if($rol->id == 4) $inactivo = 1;
        }

        $user->assignRole('SSI LISTAR');

        if($inactivo == 1) $user->roles()->detach(4);

        $this->emit('alert','Rol agregado correctamente');
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

    public function verificar_rol($tipo,$user_id){

        if($tipo == 'otorgar_numero'){

            $user = User::where('id',$user_id)->first();
            $roles_user = $user->roles->all();
            $act = 0;

            foreach($roles_user as $rol){
                if($rol->id == 23) $act = 1;
            }

            if($act == '1') return '1'; else
            return '0';

        }
        
        elseif($tipo == 'rol_listar_ssi'){

            $user = User::where('id',$user_id)->first();
            $roles_user = $user->roles->all();
            $act = 0;

            foreach($roles_user as $rol){
                if($rol->id == 25) $act = 1;
            }

            if($act == '1') return '1'; else
            return '0';

        }

        else{

            $user = User::where('id',$user_id)->first();
            $roles_user = $user->roles->all();
            $act = 0;

            foreach($roles_user as $rol){
                if($rol->id == 26) $act = 1;
            }

            if($act == '1') return '1'; else
            return '0';

        }

    }


    public function render()
    {

        $users = User::where('status','activo')
            ->where('id','!=','2204')
            ->where('id','!=','2205')
            ->where('id','!=','2206')
            ->where('id','!=','249')
            ->where('id','!=','509')
            ->permission('menu.premium')
            ->get();

        return view('livewire.admin.cuentas-psid',compact('users'));
    }
}
