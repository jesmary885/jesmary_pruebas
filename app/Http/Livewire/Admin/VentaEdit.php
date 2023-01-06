<?php

namespace App\Http\Livewire\Admin;

use App\Models\saleMarketplace;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class VentaEdit extends Component
{
    public $isopen = false, $insuficiente= false, $qty, $sale_marketplace, $metodo_id, $metodo_id_bdd, $status, $ptos_vendedor, $ptos_producto, $user, $status_bdd;

    protected $rules = [
        'status' => 'required',    
    ];

    protected $rules_recibido_pagado = [
        'ptos_producto' => 'required',
        'metodo_id' => 'required',
        'ptos_vendedor' => 'required',
    ];

    protected $rules_no_recibido_pagado = [
        'metodo_id' => 'required',
        'ptos_vendedor' => 'required',
    ];

    protected $rules_recibido_no_pagado = [
        'ptos_producto' => 'required',
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

    public function mount(saleMarketplace $sale_marketplace){
        $this->sale_marketplace = $sale_marketplace;
        $this->qty = $sale_marketplace->cant;
        $this->status = $sale_marketplace->status;
        $this->status_bdd = $sale_marketplace->status;
        $this->metodo_id = $sale_marketplace->payment_method_id;
        $this->metodo_id_bdd = $sale_marketplace->payment_method_id;
        $this->ptos_vendedor = $sale_marketplace->points_vendedor;
        $this->ptos_producto = $sale_marketplace->points_producto;

    }

    public function decrement(){
        $this->qty = $this->qty - 1;
    }

    public function increment(){
        $this->qty = $this->qty + 1;
    }

    public function render()
    {
        $metodos= $this->sale_marketplace->marketplace->payment_methods;

        return view('livewire.admin.venta-edit', compact('metodos'));
    }

    public function save(){

        $rules = $this->rules;
        $this->validate($rules);

        if($this->status == 1){
                $rules_recibido = $this->rules_recibido_pagado;
                $this->validate($rules_recibido);     
        }
    
        if($this->status == 3){
                $rules_no_recibido_pagado = $this->rules_no_recibido_pagado;
                $this->validate($rules_no_recibido_pagado);     
        }
    
        if($this->status == 4){
                $rules_recibido_no_pagado = $this->rules_recibido_no_pagado;
                $this->validate($rules_recibido_no_pagado);     
        }  
        

        $ptos_bdd_user = $this->sale_marketplace->marketplace->user->points;
        $ptos_bdd_market = $this->sale_marketplace->marketplace->points;

        if($this->status_bdd == '1'){
            $ptos_vendedor = $this->sale_marketplace->points_vendedor;
            $ptos_producto = $this->sale_marketplace->points_producto;

            if($ptos_vendedor > $this->ptos_vendedor){
                $diferencia_ptos_vendedor = $ptos_vendedor - $this->ptos_vendedor; 
                $this->sale_marketplace->marketplace->user->update([
                    'points' => $ptos_bdd_user - $diferencia_ptos_vendedor,
                ]);
            }
            elseif($ptos_vendedor < $this->ptos_vendedor){
                $diferencia_ptos_vendedor = $this->ptos_vendedor - $ptos_vendedor;
                $this->sale_marketplace->marketplace->user->update([
                    'points' => $ptos_bdd_user + $diferencia_ptos_vendedor,
                ]); 
            }

            if($ptos_producto > $this->ptos_producto){
                $diferencia_ptos_producto = $ptos_producto- $this->ptos_producto; 
                $this->sale_marketplace->marketplace->update([
                    'points' => $ptos_bdd_market - $diferencia_ptos_producto,
                ]);
            }
            elseif($ptos_producto  < $this->ptos_producto){
                $diferencia_ptos_producto = $this->ptos_producto - $ptos_producto; 
                $this->sale_marketplace->marketplace->update([
                    'points' => $ptos_bdd_market + $diferencia_ptos_producto,
                ]); 
            }

            $this->reset(['isopen']);
            $this->emit('alert','Datos modificados correctamente');
        }

        if($this->status_bdd == '2'  && $this->status == '1'){
            if($this->metodo_id == '1'){

                $comprador = User::where('id',Auth::id())->first();
                $balance = $comprador->balance;
    
                if($balance < $this->qty * $this->sale_marketplace->marketplace->price){
                    $this->insuficiente = true;
                    $this->emit('error','El saldo en página del comprador es insuficiente para esta compra');
                   // $this->emitTo('marketplace.marketplace-shopping','render');
                }
    
                else{
                    $saldo_pagina = $comprador->balance - ($this->qty * $this->sale_marketplace->marketplace->price);
    
                    $comprador->update([
                        'balance' => $saldo_pagina,
                    ]);
                }
            }

            if($this->insuficiente == false){

                $this->sale_marketplace->update([
                    'status' => $this->status,
                    'payment_method_id' => $this->metodo_id,
                    'points_producto' => $this->ptos_producto,
                    'points_vendedor' =>  $this->ptos_vendedor
                ]);
    
                $points_vendedor = $this->sale_marketplace->marketplace->user->points + $this->ptos_vendedor;
                $sales_vendedor = $this->sale_marketplace->marketplace->user->sales + 1;
    
                $points_marketplace =  $this->sale_marketplace->marketplace->points + $this->ptos_producto;
                $sales_marketplace = $this->sale_marketplace->marketplace->sales + 1;
                $cant_new = $this->sale_marketplace->marketplace->cant - $this->qty;
    
                $this->sale_marketplace->marketplace->user->update([
                    'points' => $points_vendedor,
                    'sales' => $sales_vendedor,
                ]);
    
                $this->sale_marketplace->marketplace->update([
                    'points' => $points_marketplace,
                    'sales' => $sales_marketplace,
                    'cant' => $cant_new,
                ]);
    
                $this->reset(['qty','status','metodo_id','ptos_vendedor','ptos_producto']);
                $this->emit('alert','Datos registrados correctamente');
                $this->isopen = false;  
                $this->emitTo('compras.compras-index','render');
            }

        }


        
    }
    
}
