<?php

namespace App\Http\Livewire\Psid;

use App\Models\CuentasPsid;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Register extends Component
{
    public $isopen,$psid;

    protected $listeners = ['render' => 'render'];

    public function open()
    {
        $this->isopen = true;  
        $this->emitTo('psid.register','render');
    }
    public function close()
    {
        $this->isopen = false;  
        $this->emit('volver');
    }

    public function render()
    {
        return view('livewire.psid.register');
    }

    public function save(){

        $long_psid = strlen($this->psid);
        if($long_psid > 22){
            $busqueda_id= strpos($this->psid, '*');

            $subs_psid = substr($this->psid,($busqueda_id - 22),22);

            $psid_total=str_replace("*","",$subs_psid);
            session(['psid' =>  $psid_total]);
            session()->forget('pid');
            $this->reset(['isopen','psid']);
            $this->emit('volver');
        }
        elseif($long_psid == 22){
            //$subs_psid = substr($this->psid,0,22);
            $psid_total=str_replace("*","",$this->psid);
            session(['psid' =>  $psid_total]);
            session()->forget('pid');

            $this->reset(['isopen','psid']);
            $this->emit('volver');
        }
        elseif($long_psid < 22){
            $this->emit('error','Faltan caracteres en su psid, intente de nuevo');
        }

        $psid_save_total = substr($psid_total,17,5);

        $buscar_psid_user = CuentasPsid::where('user_id',Auth::id())
            ->where('psid',$psid_save_total)->count();
        
        if($buscar_psid_user == 0){
            $psid_user_register= new CuentasPsid();
            $psid_user_register->user_id = Auth::id();
            $psid_user_register->psid = $psid_save_total;
            $psid_user_register->save();
        }


    }
}
