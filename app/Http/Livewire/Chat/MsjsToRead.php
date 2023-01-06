<?php

namespace App\Http\Livewire\Chat;

use Illuminate\Support\Facades\Notification;

use Livewire\Component;

class MsjsToRead extends Component
{
   /* public $chat;*/
   protected $listeners = ['render' => 'render'];

    //Oyentes

    public function getListeners()
    {
        $user_id = auth()->user()->id;
        return [
            "echo-notification:App.Models.User.{$user_id},notification" => 'render',
        ];
    }
    
    public function render()
    {
        $msjs = 0;
        $chats= auth()->user()->chats()->has('users',2)->get();

        foreach ($chats as $chat_msjs_no_read){
            if($chat_msjs_no_read->unread_messages){
                $msjs = $msjs + $chat_msjs_no_read->unread_messages;
            }
        }

        return view('livewire.chat.msjs-to-read',compact('msjs'));
    }
}
