<?php

namespace App\Http\Livewire\Pid;

use Livewire\Component;

class Register extends Component
{
    public $isopen,$pid;

    protected $listeners = ['render' => 'render'];

    public function open()
    {
        $this->isopen = true;  
        $this->emitTo('pid.register','render');
    }
    public function close()
    {
        $this->isopen = false;  
        $this->emit('volver');
    }

    public function render()
    {
        return view('livewire.pid.register');
    }

    public function save(){

        session(['pid' => $this->pid]);
       // session()->forget('pid');

        $this->reset(['isopen','pid']);
        $this->emit('volver');

    }
}
