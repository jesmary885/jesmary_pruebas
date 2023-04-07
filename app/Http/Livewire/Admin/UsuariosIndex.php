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

    public $search;

    public function updatingSearch(){
        $this->resetPage();
    }

     //propiedad computada
    public function next_payment_date($value,$value2){
        
        if($value2 == 30) return date("d-m-Y",strtotime($value."+ 1 month")); else return date("d-m-Y",strtotime($value."+ 15 days"));
    }

    public function render()
    {
        $users = User::where('username', 'LIKE', '%' . $this->search . '%')
        ->orwhere('email', 'LIKE', '%' . $this->search . '%')
        ->orwhere('telegram', 'LIKE', '%' . $this->search . '%')
        ->orwhere('dni', 'LIKE', '%' . $this->search . '%')
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
}
