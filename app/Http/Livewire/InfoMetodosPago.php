<?php

namespace App\Http\Livewire;

use Livewire\Component;

class InfoMetodosPago extends Component
{
    public $isopen = false;
    
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
        return view('livewire.info-metodos-pago');
    }
}
