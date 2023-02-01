<?php

namespace App\Http\Livewire\Compras;

use App\Models\Chat;
use App\Models\CommentUser;
use App\Models\saleMarketplace;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use Livewire\Component;

class CompraEdit extends Component
{

    public $existe = 0,$chat_active,$comentario_enviar,$condicion_venta = 'neutro',$isopen = false, $qty, $sale_marketplace, $metodo_id, $metodo_id_bdd, $status = 3, $ptos_vendedor, $ptos_producto, $user, $status_bdd,$educado,$seguro,$rapido,$maleducado,$no_confiable;

    public function render()
    {
        return view('livewire.compras.compra-edit');
    }

    protected $rules = [
        'status' => 'required',    
    ];

    public function open()
    {
        $this->isopen = true;  
    }
    public function close()
    {
        $this->isopen = false;  
    }

    public function mount(saleMarketplace $marketplace){
        $this->sale_marketplace = $marketplace;

        if($this->sale_marketplace->status == 'Producto enviado'){
            $this->status = 1;
            $this->existe = 1;
        } 
        if ($this->sale_marketplace->status == 'Producto no recibido') {
            $this->status = 2;
            $this->existe = 1;
        }


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

    public function save(){

        $rules = $this->rules;
        $this->validate($rules);

        if($this->condicion_venta != 'neutro')
        {
            $comentario = '';

            if($this->status == 1) $status = 'Producto recibido';
            else $status = 'Producto no recibido';

            $this->sale_marketplace->update([
                'status' => $status,
            ]);

            if($this->condicion_venta == 'positivo'){
                if($this->educado == 1) $comentario = '-Educado y amable-'.' '.$comentario;
                if($this->seguro == 1) $comentario = '-Seguro y confiable-'.' '.$comentario;
                if($this->rapido == 1) $comentario = '-Rápido-'.' '.$comentario;
            }

            if($this->condicion_venta == 'negativo'){
                if($this->maleducado == 1) $comentario = '-Maleducado y malhablado-'.' '.$comentario;
                if($this->no_confiable == 1) $comentario = '-No confiable-'.' '.$comentario;
            }

            if($this->existe == 0){
                $comment_user = new CommentUser();
                $comment_user->user_id =  $this->sale_marketplace->marketplace->user_id;
                $comment_user->posicion =  'Vendedor';
                $comment_user->comment =  $comentario;
                $comment_user->categoria_comentario =  $this->condicion_venta;
                $comment_user->user_create_id = auth()->id();
                $comment_user->sale_marketplace_id= $this->sale_marketplace->id;
                $comment_user->save();
            }

            else{
                $sale_market_search = CommentUser::where('user_id',$this->sale_marketplace->marketplace->user_id)
                    ->where('user_create_id',auth()->id())
                    ->where('sale_marketplace_id',$this->sale_marketplace->id)
                    ->first();

                  $sale_market_search->update([
                    'categoria_comentario' => $this->condicion_venta,
                    'comment' => $comentario,
                  ]);  

            }
            

            if($this->comentario_enviar){
                $user_vendedor  = User::where('id',$this->sale_marketplace->marketplace->user_id)->first();
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
                        'body' => $this->comentario_enviar,
                        'user_id' => auth()->user()->id
                    ]);

                    $this->chat_active = $chat_nuevo;

                    Notification::send($this->users_notifications, new \App\Notifications\NewMessage());
                }
                else{

                    $chat->messages()->create([
                        'body' => $this->comentario_enviar,
                        'user_id' => auth()->user()->id
                    ]);

                    $this->chat_active = $chat;

                    Notification::send($this->users_notifications, new \App\Notifications\NewMessage());

                }
            }

            //$this->reset(['qty','status','metodo_id','ptos_vendedor','ptos_producto']);
            $this->emit('alert','Datos registrados correctamente');
            $this->isopen = false;  
            $this->emitTo('compras','compras-index','render');
        }
        else{
            $this->emit('error','Debe indicar como fue tu experiencia con el vendedor');
        }

     }

    public function positivo(){
        $this->condicion_venta = 'positivo';
    }

    public function negativo(){
        $this->condicion_venta = 'negativo';
    }


    /*

                $points_marketplace =  $this->sale_marketplace->points + $this->ptos_producto;
                $sales_marketplace = $this->sale_marketplace->sales + 1;
                
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

