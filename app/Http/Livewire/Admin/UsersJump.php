<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

use App\Models\Link;
use App\Models\Links_usados;
use App\Models\User;
use Livewire\WithPagination;
use DateTime;


class UsersJump extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    protected $listeners = ['render' => 'render'];

    public $search, $vista_registros = 0,$total_registros,$user_autentic;

    public function updatingSearch(){
        $this->resetPage();
    }

    public function mount(){

        $this->user_autentic = auth()->user()->id;
    }

    public function cant_k1000($user){

        $date = new DateTime();

        $date_actual= $date->format('Y-m-d');

        $cant_k1000 = Links_usados::where('user_id',$user)
            ->whereDate('created_at',$date_actual)
            ->where('k_detected','K=1000_NEW')
            ->count();

        if($user == '2' || $user == '1345'){
            if($cant_k1000 > 20) return '20';
            else return $cant_k1000;
        }
        else{
            return $cant_k1000;
        }

      
        
    }

    public function cant_k23($user){

        $date = new DateTime();

        $date_actual= $date->format('Y-m-d');

        $cant_k23 = Links_usados::where('user_id',$user)
            ->whereDate('created_at',$date_actual)
            ->where('k_detected','K=23_NEW')
            ->count();

            if($user == '2' || $user == '1345'){
                if($cant_k23 > 20) return '20';
                else return $cant_k23;
            }
            else{
                return $cant_k23;
            }

    }

    public function cant_k1083($user){

        $date = new DateTime();

        $date_actual= $date->format('Y-m-d');

        $cant_k1083 = Links_usados::where('user_id',$user)
            ->whereDate('created_at',$date_actual)
            ->where('k_detected','K=1083')
            ->count();


            if($user == '2' || $user == '1345'){
                if($cant_k1083 > 20) return '20';
                else return $cant_k1083;
            }
            else{
                return $cant_k1083;
            }
    }

    public function cant_k1000YSN($user){

        $date = new DateTime();

        $date_actual= $date->format('Y-m-d');

        $cant_k1000ysn = Links_usados::where('user_id',$user)
            ->whereDate('created_at',$date_actual)
            ->where('k_detected','K=1000_YSN')
            ->count();

            if($user == '2' || $user == '1345'){
                if($cant_k1000ysn > 20) return '20';
                else return $cant_k1000ysn;
            }
            elseif($user == '268' || $user == '584' || $user == '746' || $user == '1901' || $user == '112' || $user == '14' || $user == '92'){
                if($cant_k1000ysn > 5) return '5';
                else return $cant_k1000ysn;
            }
            else{
                return $cant_k1000ysn;
            }
        
    }

    public function render()
    {



        $users = User::where('username', 'LIKE', '%' . $this->search . '%')
        ->where('status','activo')
        ->permission('menu.premium')
        ->latest('id')
        ->paginate(20);
    
        return view('livewire.admin.users-jump',compact('users'));
    }

    public function reiniciar($userID){

        $date = new DateTime();

        $date_actual= $date->format('Y-m-d');

        Links_usados::where('user_id',$userID)
            ->whereDate('created_at',$date_actual)
            ->delete();

        $this->emit('alert','Jumpers reiniciados correctamente');
    }
}
