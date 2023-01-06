<?php

namespace App\Http\Livewire\Marketplace;

use App\Models\Marketplace;
use App\Models\MarketplacePaymentMethods;
use App\Models\saleMarketplace;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MarketplaceShoppingFinish extends Component
{
    public $isopen = false, $insuficiente= false, $quantity, $qty = 1, $marketplace, $metodo_id, $status, $ptos_vendedor, $ptos_producto;

    protected $rules = [
        'status' => 'required',
    
    ];

    protected $rules_recibido_pagado = [
        'ptos_producto' => 'required',
        'metodo_id' => 'required',
        'ptos_vendedor' => 'required',
    ];


    public function open()
    {
        $this->isopen = true;  
    }
    public function close()
    {
        $this->isopen = false;  
    }

    public function mount(Marketplace $marketplace){
        $this->marketplace = $marketplace;
        $this->quantity = $marketplace->cant;
    }

    public function decrement(){
        $this->qty = $this->qty - 1;
    }

    public function increment(){
        $this->qty = $this->qty + 1;
    }

    public function save(){

        $rules = $this->rules;
        $this->validate($rules);

        if($this->status == 1){
            $rules_recibido = $this->rules_recibido_pagado;
            $this->validate($rules_recibido);     

            if($this->metodo_id == '1'){

                $comprador = User::where('id',Auth::id())->first();
                $balance = $comprador->balance;

                if($balance < $this->qty * $this->marketplace->price){
                    $this->insuficiente = true;
                    $this->emit('error','El saldo en página del comprador es insuficiente para esta compra');
                // $this->emitTo('marketplace.marketplace-shopping','render');
                }

                else{
                    $saldo_pagina = $comprador->balance - ($this->qty * $this->marketplace->price);

                    $comprador->update([
                        'balance' => $saldo_pagina,
                    ]);
                }
            }

            if($this->insuficiente == false){
                $sale = new saleMarketplace();
                $sale->total_paid = $this->qty * $this->marketplace->price;
                $sale->cant = $this->qty;
                $sale->status = $this->status;
                $sale->payment_method_id = $this->metodo_id;
                $sale->marketplace_id = $this->marketplace->id;
                $sale->points_producto = $this->ptos_producto;
                $sale->points_vendedor =  $this->ptos_vendedor;
                $sale->user_id = Auth::id();
                $sale->save();

                $points_vendedor = $this->marketplace->user->points + $this->ptos_vendedor;
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
                ]);

                $this->reset(['qty','status','metodo_id','ptos_vendedor','ptos_producto']);

            }

        }

        else{
            $sale = new saleMarketplace();
            $sale->total_paid = $this->qty * $this->marketplace->price;
            $sale->cant = $this->qty;
            $sale->status = $this->status;
            $sale->marketplace_id = $this->marketplace->id;
            $sale->user_id = Auth::id();
            $sale->save();

            $this->reset(['qty','status']);
        }

        $this->emit('alert','Datos registrados correctamente');
        $this->isopen = false;  
        $this->emitTo('marketplace.marketplace-shopping','render');
        
    }


    public function render()
    {
        $metodos= $this->marketplace->payment_methods;

        return view('livewire.marketplace.marketplace-shopping-finish',compact('metodos'));
    }
}
