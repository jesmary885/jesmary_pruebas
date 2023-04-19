<?php

namespace App\Http\Livewire\Admin;

use App\Models\JumperType;
use App\Models\Links_usados;
use DateTime;
use Livewire\Component;

class CantJumperDia extends Component
{
    public function cant($jump){

        $date = new DateTime();

        $date_actual= $date->format('Y-m-d');

        $sin_k = ltrim($jump, 'K');
        $k= 'K='.$sin_k;

        $links_usados = Links_usados::where('k_detected',$k)
                    ->wheredate('created_at',$date_actual)
                    ->count();

        return $links_usados;

    }

    public function render()
    {

        $date = new DateTime();
        $date_actual= $date->format('Y-m-d');

        $jumpers = JumperType::where('id','!=',1)
        ->where('id','!=',2)
        ->where('id','!=',3)
        ->where('id','!=',4)
        ->where('id','!=',10)
        ->where('id','!=',11)
        ->where('id','!=',12)
        ->where('id','!=',13)
        ->where('id','!=',14)
        ->where('id','!=',15)
        ->get();
        return view('livewire.admin.cant-jumper-dia',compact('jumpers','date_actual'));
    }
}
