<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
Use Livewire\WithPagination;

class UsuariosIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    protected $listeners = ['render' => 'render'];

    public $search,$user_autentic;

    public function updatingSearch(){
        $this->resetPage();
    }

    public function mount(){

        $this->user_autentic = auth()->user()->id;
    }

     //propiedad computada
    public function next_payment_date($value,$value2){
        
        if($value2 == 30) return date("d-m-Y",strtotime($value."+ 1 month")); else return date("d-m-Y",strtotime($value."+ 15 days"));
    }

    public function render()
    {
        $users = User::where('username', 'LIKE', '%' . $this->search . '%')
        ->where('id','!=','2017')
        ->where('id','!=','2018')
        ->where('id','!=','2019')
        ->where('id','!=','2020')
        ->where('id','!=','2021')
        ->where('id','!=','2022')
        ->where('id','!=','2023')
        ->where('id','!=','2024')
        ->where('id','!=','2033')
        ->where('id','!=','2034')
        ->where('id','!=','2035')
        ->where('id','!=','2036')
        ->where('id','!=','2037')
        ->where('id','!=','2038')
        ->where('id','!=','2039')
        ->where('id','!=','2040') 
        ->latest('id')
        ->paginate(20);

        return view('livewire.admin.usuarios-index',compact('users'));
    }

    public function reputation_vendedor($value){
        $user= User::where('id',$value)->first();

        if($user->sales > 0){
            $valor = (100 * $user->points) / ($user->sales * 5);

            if($valor >= 95){
                return [
                    1 => "fas fa-heart text-md text-red-500 mt-3 mr-2",
                    2 =>"fas fa-heart text-md text-red-500 mt-3 mr-2",
                    3 =>"fas fa-heart text-md text-red-500 mt-3 mr-2",
                    4=> "fas fa-heart text-md text-red-500 mt-3 mr-2",
                    5=> "fas fa-heart text-md text-red-500 mt-3 mr-2",
                ];
            }

            elseif($valor >=75 && $valor < 95){
                return [
                    1 => "fas fa-heart text-md text-red-500 mt-3 mr-2",
                    2 =>"fas fa-heart text-md text-red-500 mt-3 mr-2",
                    3 =>"fas fa-heart text-md text-red-500 mt-3 mr-2",
                    4=> "fas fa-heart text-md text-red-500 mt-3 mr-2",
                    5=> "fas fa-heart-broken text-md text-gray-400 mt-3 mr-2",
                ];
            }

            elseif($valor >=50 && $valor < 75){
                return [
                    1 => "fas fa-heart text-md text-red-500 mt-3 mr-2",
                    2 =>"fas fa-heart text-md text-red-500 mt-3 mr-2",
                    3 =>"fas fa-heart text-md text-red-500 mt-3 mr-2",
                    4=> "fas fa-heart-broken text-md text-gray-400 mt-3 mr-2",
                    5=> "fas fa-heart-broken text-md text-gray-400 mt-3 mr-2",
                ];
            }

            elseif($valor >=25 && $valor < 50){
                return [
                    1 => "fas fa-heart text-md text-red-500 mt-3 mr-2",
                    2 =>"fas fa-heart text-md text-red-500 mt-3 mr-2",
                    3 =>"fas fa-heart-broken text-md text-gray-400 mt-3 mr-2",
                    4=> "fas fa-heart-broken text-md text-gray-400 mt-3 mr-2",
                    5=> "fas fa-heart-broken text-md text-gray-400 mt-3 mr-2",
                ];
            }

            else{
                return [
                    1 => "fas fa-heart text-md text-red-500 mt-2 mr-2",
                    2 =>"fas fa-heart-broken text-md text-gray-400 mt-3 mr-2",
                    3 =>"fas fa-heart-broken text-md text-gray-400 mt-3 mr-2",
                    4=> "fas fa-heart-broken text-md text-gray-400 mt-3 mr-2",
                    5=> "fas fa-heart-broken text-md text-gray-400 mt-3 mr-2",
                ];
            }
        }

        else
        {
            return [
                1 =>"fas fa-heart-broken text-md text-gray-400 mt-3 mr-2",
                2 =>"fas fa-heart-broken text-md text-gray-400 mt-3 mr-2",
                3 =>"fas fa-heart-broken text-md text-gray-400 mt-3 mr-2",
                4=> "fas fa-heart-broken text-md text-gray-400 mt-3 mr-2",
                5=> "fas fa-heart-broken text-md text-gray-400 mt-3 mr-2"];
        }
    }

    public function rol_ktmr($userID){

        $user = User::where('id',$userID)->first();
        $roles_user = $user->roles->all();
        $inactivo = 0;

        foreach($roles_user as $rol){
            if($rol->id == 4) $inactivo = 1;
        }

        $user->assignRole('Usuario Ktmr');

        if($inactivo == 1) $user->roles()->detach(4);

        $this->emit('alert','Rol agregado correctamente');
    }

    public function quitar_rol_ktmr($userID){

        $user = User::where('id',$userID)->first();
        $roles_user_cant = $user->roles->count();

        if($roles_user_cant == 1) $user->assignRole('Inactivo');

        $user->roles()->detach(12);
        
        $this->emit('alert','Rol ktmr eliminado correctamente');
    }
}
