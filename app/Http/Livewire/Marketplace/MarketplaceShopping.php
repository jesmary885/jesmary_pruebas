<?php

namespace App\Http\Livewire\Marketplace;

use App\Models\Contact;
use App\Models\Marketplace;
use App\Models\User;
use Livewire\Component;

class MarketplaceShopping extends Component
{
    public $marketplace,$marketplace_select, $contact, $porcentaje_marketplace, $porcentaje_vendedor;

    protected $listeners = ['render' => 'render'];

    public function mount(){
        $this->marketplace_select = Marketplace::where('id',$this->marketplace)->first(); 

        if($this->marketplace_select->sales)$this->porcentaje_marketplace = (100 * $this->marketplace_select->points) / ($this->marketplace_select->sales * 5)  ?? 0;

        $user= User::where('id',$this->marketplace_select->user_id)->first();
        if($user->sales) $this->porcentaje_vendedor = (100 * $user->points) / ($user->sales * 5)  ?? 0;
       
    }

    public function reputation($value){

        if($value->sales > 0){
            $valor = (100 * $value->points) / ($value->sales * 5);

            if($valor >= 95){
                return [
                    1 => "fas fa-star text-md text-yellow-400 mt-3 mr-2",
                    2 =>"fas fa-star text-md text-yellow-400 mt-3 mr-2",
                    3 =>"fas fa-star text-md text-yellow-400 mt-3 mr-2",
                    4=> "fas fa-star text-md text-yellow-400 mt-3 mr-2",
                    5=> "fas fa-star text-md text-yellow-400 mt-3 mr-2",
                ];
            }

            elseif($valor >=75 && $valor < 95){
                return [
                    1 => "fas fa-star text-md text-yellow-400 mt-3 mr-2",
                    2 =>"fas fa-star text-md text-yellow-400 mt-3 mr-2",
                    3 =>"fas fa-star text-md text-yellow-400 mt-3 mr-2",
                    4=> "fas fa-star text-md text-yellow-400 mt-3 mr-2",
                    5=> "fas fa-star text-md text-gray-400 mt-3 mr-2",
                ];
            }

            elseif($valor >=50 && $valor < 75){
                return [
                    1 => "fas fa-star text-md text-yellow-400 mt-3 mr-2",
                    2 =>"fas fa-star text-md text-yellow-400 mt-3 mr-2",
                    3 =>"fas fa-star text-md text-yellow-400 mt-3 mr-2",
                    4=> "fas fa-star text-md text-gray-400 mt-3 mr-2",
                    5=> "fas fa-star text-md text-gray-400 mt-3 mr-2",
                ];
            }

            elseif($valor >=25 && $valor < 50){
                return [
                    1 => "fas fa-star text-md text-yellow-400 mt-3 mr-2",
                    2 =>"fas fa-star text-md text-yellow-400 mt-3 mr-2",
                    3 =>"fas fa-star text-md text-gray-400 mt-3 mr-2",
                    4=> "fas fa-star text-md text-gray-400 mt-3 mr-2",
                    5=> "fas fa-star text-md text-gray-400 mt-3 mr-2",
                ];
            }

            else{
                return [
                    1 => "fas fa-star text-md text-yellow-400 mt-3 mr-2",
                    2 =>"fas fa-star text-md text-gray-400 mt-3 mr-2",
                    3 =>"fas fa-star text-md text-gray-400 mt-3 mr-2",
                    4=> "fas fa-star text-md text-gray-400 mt-3 mr-2",
                    5=> "fas fa-star text-md text-gray-400 mt-3 mr-2",
                ];
            }
        }

        else
        {
            return [
                1 =>"fas fa-star text-md text-gray-400 mt-3 mr-2",
                2 =>"fas fa-star text-md text-gray-400 mt-3 mr-2",
                3 =>"fas fa-star text-md text-gray-400 mt-3 mr-2",
                4=> "fas fa-star text-md text-gray-400 mt-3 mr-2",
                5=> "fas fa-star text-md text-gray-400 mt-3 mr-2"];
        }
    }

    public function reputation_vendedor($value){
        $user= User::where('id',$value)->first();

        if($user->sales > 0){
            $valor = (100 * $user->points) / ($user->sales * 5);

            if($valor >= 95){
                return [
                    1 => "fas fa-heart text-md text-red-500 mt-3 mr-2",
                    2 =>"fas fa-heart text-md text-red-500 mt-3 mr-2",
                    3 =>"fas fa-heart text-md text-red-500 mt-3 mr-2",
                    4=> "fas fa-heart text-md text-red-500 mt-3 mr-2",
                    5=> "fas fa-heart text-md text-red-500 mt-3 mr-2",
                ];
            }

            elseif($valor >=75 && $valor < 95){
                return [
                    1 => "fas fa-heart text-md text-red-500 mt-3 mr-2",
                    2 =>"fas fa-heart text-md text-red-500 mt-3 mr-2",
                    3 =>"fas fa-heart text-md text-red-500 mt-3 mr-2",
                    4=> "fas fa-heart text-md text-red-500 mt-3 mr-2",
                    5=> "fas fa-heart-broken text-md text-gray-400 mt-3 mr-2",
                ];
            }

            elseif($valor >=50 && $valor < 75){
                return [
                    1 => "fas fa-heart text-md text-red-500 mt-3 mr-2",
                    2 =>"fas fa-heart text-md text-red-500 mt-3 mr-2",
                    3 =>"fas fa-heart text-md text-red-500 mt-3 mr-2",
                    4=> "fas fa-heart-broken text-md text-gray-400 mt-3 mr-2",
                    5=> "fas fa-heart-broken text-md text-gray-400 mt-3 mr-2",
                ];
            }

            elseif($valor >=25 && $valor < 50){
                return [
                    1 => "fas fa-heart text-md text-red-500 mt-3 mr-2",
                    2 =>"fas fa-heart text-md text-red-500 mt-3 mr-2",
                    3 =>"fas fa-heart-broken text-md text-gray-400 mt-3 mr-2",
                    4=> "fas fa-heart-broken text-md text-gray-400 mt-3 mr-2",
                    5=> "fas fa-heart-broken text-md text-gray-400 mt-3 mr-2",
                ];
            }

            else{
                return [
                    1 => "fas fa-heart text-md text-red-500 mt-2 mr-2",
                    2 =>"fas fa-heart-broken text-md text-gray-400 mt-3 mr-2",
                    3 =>"fas fa-heart-broken text-md text-gray-400 mt-3 mr-2",
                    4=> "fas fa-heart-broken text-md text-gray-400 mt-3 mr-2",
                    5=> "fas fa-heart-broken text-md text-gray-400 mt-3 mr-2",
                ];
            }
        }

        else
        {
            return [
                1 =>"fas fa-heart-broken text-md text-gray-400 mt-3 mr-2",
                2 =>"fas fa-heart-broken text-md text-gray-400 mt-3 mr-2",
                3 =>"fas fa-heart-broken text-md text-gray-400 mt-3 mr-2",
                4=> "fas fa-heart-broken text-md text-gray-400 mt-3 mr-2",
                5=> "fas fa-heart-broken text-md text-gray-400 mt-3 mr-2"];
        }
    }

    public function render()
    {
        return view('livewire.marketplace.marketplace-shopping');
    }

    public function contact(){

        $conta = Contact::where('user_id',auth()->id())
        ->where('contact_id',$this->marketplace_select->user_id)
        ->first();

    
        if(!$conta){
            $add_contact = new Contact();
            $add_contact -> name= $this->marketplace_select->user->username;
            $add_contact -> user_id = auth()->id();
            $add_contact -> contact_id= $this->marketplace_select->user_id;
            $add_contact ->save();

           
        }

            $this->emit('render');
            return redirect()->to('/chat-conver/'.$this->marketplace_select->user_id);

    }

}
