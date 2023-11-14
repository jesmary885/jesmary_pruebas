<?php

namespace App\Http\Livewire\Ktmr;

use App\Models\CuentasKtmr;
use Livewire\Component;
use Livewire\WithPagination;

class Cuentas extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    protected $listeners = ['render' => 'render'];

    public $search,$user_autentic;

    public function updatingSearch(){
        $this->resetPage();
    }

    public function ver($jumper){
        $jump = CuentasKtmr::where('id',$jumper)->first();

        $this->emit('comment',$jump->link_inicial);
    }

    public function render()
    {
        $cuentas = CuentasKtmr::where('user_id',auth()->user()->id)
        ->latest('id')
        ->paginate(20);

        return view('livewire.ktmr.cuentas',compact('cuentas'));
    }
}
