<?php

namespace App\Http\Livewire\Compras;

use Livewire\Component;

class CompraEdit extends Component
{
    public function render()
    {
        return view('livewire.compras.compra-edit');
    }


    /*$points_vendedor = $this->marketplace->user->points + $this->ptos_vendedor;
                $sales_vendedor = $this->marketplace->user->sales + 1;

                $points_marketplace =  $this->marketplace->points + $this->ptos_producto;
                $sales_marketplace = $this->marketplace->sales + 1;
                
                $cant_new = $this->marketplace->cant - $this->qty;

                $this->marketplace->user->update([
                    'points' => $points_vendedor,
                    'sales' => $sales_vendedor,
                ]);

                $this->marketplace->update([
                    'points' => $points_marketplace,
                    'sales' => $sales_marketplace,
                    'cant' => $cant_new,
                ]);*/
}

