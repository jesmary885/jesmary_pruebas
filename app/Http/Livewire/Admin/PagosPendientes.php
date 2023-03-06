<?php

namespace App\Http\Livewire\Admin;

use App\Models\PagoRegistrosRecarga;
use Livewire\Component;

class PagosPendientes extends Component
{
    protected $listeners = ['render' => 'render'];

    public function render()
    {
        $pagos_pendientes = PagoRegistrosRecarga::where('status','pendiente')->count();
        return view('livewire.admin.pagos-pendientes',compact('pagos_pendientes'));
    }
}
