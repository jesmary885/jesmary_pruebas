<?php

namespace App\Http\Livewire;

use App\Models\Tasa_dia;
use Livewire\Component;

class InfoPlanes extends Component
{
    public $isopen = false, $tasa_dia_dolar, $tasa_dia_ltc;
    
    public function open()
    {
        $this->isopen = true;  
    }
    public function close()
    {
        $this->isopen = false;  
    }

    public function mount(){

        $this->tasa_dia_dolar = Tasa_dia::where('moneda','DOLAR')->first()->tasa;
        $this->tasa_dia_ltc = Tasa_dia::where('moneda','LTC')->first()->tasa;
    }
    
    public function render()
    {
        return view('livewire.info-planes');
    }
}
