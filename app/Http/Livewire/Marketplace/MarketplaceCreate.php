<?php

namespace App\Http\Livewire\Marketplace;

use App\Models\CategoryMarketplace;
use App\Models\Marketplace;
use App\Models\PaymentMethods;
use App\Models\saleMarketplace;
use Database\Seeders\MarketplacePaymentMethodsSeeder;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\MarketplacePaymentMethods as Pivot;

class MarketplaceCreate extends Component
{
    public $isopen = false,$vista,$tasa;
    public $market,$accion,$name,$price,$description,$categories,$category_id="",$estado="1",$cant,$payment_methods,$marketplace;

    public $createForm = [
        'payment_methods' => [],
    ];

    public $editForm = [
        'payment_methods' => [],
    ];

    protected $rules_venta = [
        'name' => 'required',
        'price' => 'required',
        'description' => 'required',
        'category_id' => 'required',
        'cant' => 'required',
    ];

    protected $rules_compra = [
        'name' => 'required',
        'tasa' => 'required',
        'description' => 'required',
        'category_id' => 'required',
        'cant' => 'required',
    ];

    protected $validationAttributes = [
        'name' => 'name',
        'price' => 'price',
        'description' => 'description',
        'category_id' => 'category_id',
        'createForm.payment_methods' => 'payment_methods',
    ];

    public function mount(Marketplace $marketplace,$vista){
        $this->vista = $vista;
        $this->marketplace = $marketplace;
        $this->categories =  CategoryMarketplace::all();
        $this->payment_methods = PaymentMethods::all();

        if($marketplace){
            $this->name = $this->marketplace->name;
            $this->description = $this->marketplace->description;
            $this->name = $this->marketplace->name;
            $this->price = $this->marketplace->price;
            $this->cant = $this->marketplace->cant;
            $this->category_id = $this->marketplace->category_marketplace_id;
            if( $this->marketplace->status =='Habilitado') $this->estado=1 ; else $this->estado = 0;
            $this->createForm['payment_methods'] = $this->marketplace->payment_methods->pluck('id');
        }
    }

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
        return view('livewire.marketplace.marketplace-create');
    }

    public function save(){

        if($this->vista == 'venta'){
            $rules_venta = $this->rules_venta;
            $this->validate($rules_venta);
        }
        else{
            $rules_compra = $this->rules_compra;
            $this->validate($rules_compra);
        }

        $user=Auth::id();

        if($this->accion == 'create')
        {
            if($this->vista == 'venta'){
                
                $marketplace = new Marketplace();
                $marketplace->name = $this->name;
                $marketplace->price = $this->price;
                $marketplace->description = $this->description;
                if($this->estado == '1') $marketplace->status = 'Habilitado';
                else $marketplace->status = 'Deshabilitado';
                $marketplace->user_id = $user;
                $marketplace->cant = $this->cant;
                $marketplace->type = 'venta';
                $marketplace->category_marketplace_id = $this->category_id;
                $marketplace->save();
                $marketplace->payment_methods()->attach($this->createForm['payment_methods']);
                $this->reset(['isopen','name','price','description','estado','cant','category_id','createForm']);
            }

            else{
                $marketplace = new Marketplace();
                $marketplace->name = $this->name;
                $marketplace->tasa = $this->tasa;
                $marketplace->description = $this->description;
                if($this->estado == '1') $marketplace->status = 'Habilitado';
                else $marketplace->status = 'Deshabilitado';
                $marketplace->user_id = $user;
                $marketplace->price = 0;
                $marketplace->cant = $this->cant;
                $marketplace->type = 'compra';
                $marketplace->category_marketplace_id = $this->category_id;
                $marketplace->save();
                $marketplace->payment_methods()->attach($this->createForm['payment_methods']);
                $this->reset(['isopen','name','tasa','description','estado','cant','category_id','createForm']);

            }
            
            $this->emit('alert','Datos registrados correctamente');
        }
        else{
            if($this->estado == '1') $estado = 'Habilitado';
            else $estado = 'Deshabilitado';

            if($this->vista == 'venta'){
                $this->marketplace->update([
                    'name' => $this->name,
                    'price' => $this->price,
                    'description' => $this->description,
                    'status' => $estado,
                    'cant' => $this->cant,
                    'category_marketplace_id' => $this->category_id
                ]);
            }
            else{
                $this->marketplace->update([
                    'name' => $this->name,
                    'tasa' => $this->tasa,
                    'description' => $this->description,
                    'status' => $estado,
                    'cant' => $this->cant,
                    'category_marketplace_id' => $this->category_id
                ]);

            }

            $this->marketplace->payment_methods()->sync($this->createForm['payment_methods']);
            $this->reset(['isopen']);
            $this->emit('alert','Datos modificados correctamente');
        }

        
        $this->emitTo('admin.marketplace-index','render');
    }

    public function delete($marketplaceId){
        $this->market = $marketplaceId;
        $busqueda = saleMarketplace::where('marketplace_id',$marketplaceId)->first();

        if($busqueda) $this->emit('errorSize', 'Esta publicación esta asociada a una venta/compra, no puede eliminarla');
        else $this->emit('confirm', 'Esta seguro de eliminar esta publicación?','admin.marketplace-index','confirmacion','La publicación se ha eliminado.');
    }

    public function confirmacion(){
        $market_destroy = Marketplace::where('id',$this->market)->first();
        $market_destroy->delete();
        $this->resetPage();
    }


}
