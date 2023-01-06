<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index($conta='no'){
       
        return view('chat.index', compact('conta'));
    }

    public function chat_convers($user){
        return view('chat.chat_convers',compact('user'));
    }
}
