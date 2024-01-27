<?php

namespace App\Http\Livewire\Chat;

use App\Models\Chat;
use App\Models\Contact;
use Livewire\Component;
use Illuminate\Support\Facades\Notification;

class ChatComponent extends Component
{
    public $search;
    public $contactChat,$chat, $bodyMessage, $chat_id,$users,$vista = "chat", $conta;

    protected $listeners = ['render' => 'render','open_chat_contact' => 'open_chat_contact'];

    public function mount(){
      //  dd($this->conta);
      
        if($this->conta != 'no'){
            $contc = Contact::where('user_id',auth()->id())
            ->where('contact_id',$this->conta)
            ->first();

            $contact_sele= $this->conta;

            $chat= auth()->user()->chats()
            ->whereHas('users',function($query) use ($contact_sele){
                $query->where('user_id', $contact_sele);
            })
            ->has('users',2)
            ->first();

        if($chat){
            $this->chat = $chat;
   
            $this->chat_id = $this->chat->id;
            $this->reset('bodyMessage','contactChat','search');
        }
        else{
            $this->contactChat = $contc;
            $this->reset('chat','bodyMessage','search');
        }

        }
        $this->users = collect();
       
    }
    

    //Oyentes

    public function getListeners()
    {
        $user_id = auth()->user()->id;
        return [
            "echo-notification:App.Models.User.{$user_id},notification" => 'render',
            "echo-presence:chat.1,here" => 'chatHere',
            "echo-presence:chat.1,joining" => 'chatJoining',
            "echo-presence:chat.1,leaving" => 'chatLeaving',
        ];
    }

    //propiedad computada
    public function getContactsProperty(){
        return Contact::where('user_id',auth()->id())
            ->when($this->search, function($query){
                $query->where(function($query){
                    $query->where('name', 'like', '%'.$this->search.'%')
                        ->orWhereHas('user',function($query){
                            $query->where('email','like', '%'.$this->search.'%');
                        });
                    });
                })
            ->get() ?? [];
    }

    public function getChatsProperty(){
        return auth()->user()->chats()->get()->sortByDesc('last_message_at');
    }

    public function getMessagesProperty(){
        return $this->chat ? $this->chat->messages()->get() : [];
        //es igual a Message::where('chat_id', $this->chat->id)->get()
    }

    public function getUsersNotificationsProperty(){
        return $this->chat ? $this->chat->users->where('id','!=', auth()->id()) : collect();
        //es igual a Message::where('chat_id', $this->chat->id)->get()
    }

    public function open_chat_contact(Contact $contact){
 
        $chat= auth()->user()->chats()
            ->whereHas('users',function($query) use ($contact){
                $query->where('user_id', $contact->contact_id);
            })
            ->has('users',2)
            ->first();

        if($chat){
            $this->chat = $chat;
            $this->chat_id = $this->chat->id;
            $this->reset('bodyMessage','contactChat','search');
        }
        else{
            $this->contactChat = $contact;
            $this->reset('chat','bodyMessage','search');
        }

    }

    public function getActiveProperty(){

        if (empty($this->users_notifications->first()->id)){

            return collect();

        }else{

            return $this->users->contains($this->users_notifications->first()->id);

        }
      
       // return $this->users->contains($this->users_notifications->first()->id);
     

    }

    //Ciclo de vida

    public function updatedBodyMessage($value){
        if (empty($this->users_notifications->first()->id)){

            return collect();

        }

        else{

            if($value){
                Notification::send($this->users_notifications, new \App\Notifications\UserTyping($this->chat->id));
            }
        }

    }

    //Métodos

    //evento todos los usuarios en la sala de chat
    public function chatHere($users){
        $this->users = collect($users)->pluck('id');

    }
    //evento cuando se sume un nuevo usuario
    public function chatJoining($user){
        $this->users->push($user['id']);

    }
    //evento que retorna los usuarios que se han desconectado
    public function chatLeaving($user){
        $this->users = $this->users->filter(function($id) use ($user){
            return $id != $user['id'];
        });
    }

    public function open_chat(Chat $chat){
        $this->chat = $chat;
        $this->chat_id = $this->chat->id;
        $this->reset('bodyMessage','contactChat');

       
    }

    public function sendMessage(){
        $this->validate([
            'bodyMessage' => 'required'
        ]);

        if(!$this->chat){
            $this->chat = Chat::create();
            $this->chat_id = $this->chat->id;
            $this->chat->users()->attach([auth()->user()->id,$this->contactChat->contact_id]);
        }

        $this->chat->messages()->create([
            'body' => $this->bodyMessage,
            'user_id' => auth()->user()->id

        ]);

        Notification::send($this->users_notifications, new \App\Notifications\NewMessage());

        $this->reset('bodyMessage','contactChat');        
    }

    public function render()
    {

        if($this->chat){
            $this->chat->messages()->where('user_id','!=',auth()->id())
            ->where('is_read',false)
            ->update([
                'is_read' => true,
            ]);

            $this->emit('scrollIntoView');
        }
        return view('livewire.chat.chat-component');
    }
}
