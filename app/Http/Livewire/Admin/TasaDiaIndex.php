<?php

namespace App\Http\Livewire\Admin;

use App\Models\Tasa_dia;
use Livewire\Component;

class TasaDiaIndex extends Component
{
    protected $listeners = ['render' => 'render'];
    
    public function render()
    {
        $tasas = Tasa_dia::get();

        return view('livewire.admin.tasa-dia-index',compact('tasas'));
    }
}
