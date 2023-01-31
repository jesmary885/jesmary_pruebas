<?php

namespace App\Http\Livewire\Marketplace;

use App\Models\Chat;
use App\Models\Marketplace;
use App\Models\MarketplacePaymentMethods;
use App\Models\saleMarketplace;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Notification;

class MarketplaceShoppingFinish extends Component
{
    use WithFileUploads;

    public $chat_active,$file,$isopen = false, $insuficiente= false, $quantity, $qty = 1, $marketplace, $metodo_id, $status, $ptos_vendedor, $ptos_producto;

    protected $rules = [
        'metodo_id' => 'required',
    ];


    public function open()
    {
        $this->isopen = true;  
    }
    public function close()
    {
        $this->isopen = false;  
    }

    public function getActiveProperty(){

        if (empty($this->users_notifications->first()->id)){

            return collect();

        }else{

            return $this->users->contains($this->users_notifications->first()->id);

        }
    }

    //Ciclo de vida

    public function updatedBodyMessage($value){
        if (empty($this->users_notifications->first()->id)){
            return collect();
        }

        else{
            if($value){
                Notification::send($this->users_notifications, new \App\Notifications\UserTyping($this->chat_active->id));
            }
        }
    }

    public function getUsersNotificationsProperty(){
        return $this->chat_active ? $this->chat_active->users->where('id','!=', auth()->id()) : collect();
        //es igual a Message::where('chat_id', $this->chat->id)->get()
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
            $sale->status = 'solicitado';
            $sale->payment_method_id = $this->metodo_id;
            $sale->marketplace_id = $this->marketplace->id;
            $sale->user_id = Auth::id();
            if($this->metodo_id != 1) $sale->file = $this->file->store('constancias');
            $sale->save();

            $this->reset(['qty','metodo_id']);

            $user_vendedor = User::where('id',$this->marketplace->user_id)->first();

                $chat= auth()->user()->chats()
                    ->whereHas('users',function($query) use ($user_vendedor){
                        $query->where('user_id', $user_vendedor->id);
                    })
                    ->has('users',2)
                    ->first();

                if(!$chat){
                    $chat_nuevo = Chat::create();
                    $chat_nuevo->users()->attach([auth()->user()->id,$user_vendedor->id]);

                    $chat_nuevo->messages()->create([
                        'body' => 'Hola, he creado la orden nro. '.$sale->id.', he adjuntado la contancia de pago, espero su pronta respuesta',
                        'user_id' => auth()->user()->id
                    ]);

                    $this->chat_active = $chat_nuevo;

                    Notification::send($this->users_notifications, new \App\Notifications\NewMessage());
                }
                else{

                    $chat->messages()->create([
                        'body' => 'Hola, he creado la orden nro. '.$sale->id.', he adjuntado la contancia de pago, espero su pronta respuesta',
                        'user_id' => auth()->user()->id
                    ]);

                    $this->chat_active = $chat;

                    Notification::send($this->users_notifications, new \App\Notifications\NewMessage());

                }
        }


        $this->emit('alert','Datos registrados correctamente');
        $this->isopen = false;  

    }


    public function render()
    {
        $metodos= $this->marketplace->payment_methods;

        return view('livewire.marketplace.marketplace-shopping-finish',compact('metodos'));
    }
}
