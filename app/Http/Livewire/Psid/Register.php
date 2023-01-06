<?php

namespace App\Http\Livewire\Psid;

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
            $subs_psid = substr($this->psid,0,22);
            session(['psid' => $subs_psid]);
            session()->forget('pid');
            $this->reset(['isopen','psid']);
            $this->emit('volver');
        }
        elseif($long_psid == 22){
            //$subs_psid = substr($this->psid,0,22);
            session(['psid' => $this->psid]);
            session()->forget('pid');

            $this->reset(['isopen','psid']);
            $this->emit('volver');
        }
        elseif($long_psid < 22){
            $this->emit('error','Faltan caracteres en su psid, intente de nuevo');
        }
    }
}
