<?php

namespace App\Http\Livewire;

use Livewire\Component;

class InfoMetodosPago extends Component
{
    protected $listeners = ['render' => 'render'];

    public $isopen;
    
    public function open()
    {
        $this->isopen = true;  
        $this->emitTo('info-metodos-pago','render');
    }
    public function close()
    {
        $this->isopen = false;  
        $this->emit('volver');
    }

    public function render()
    {
        return view('livewire.info-metodos-pago');
    }
}
