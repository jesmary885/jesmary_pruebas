<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PsidController extends Controller
{
    public function index_psid(){
        $isopen = 'true';
        return view('psid_register',compact('isopen'));
    }

    public function index_pid(){
        $isopen = 'true';
        return view('pid_register',compact('isopen'));
    }

    public function limpiar_pid(){
        session()->forget('pid');
        return back();
    }

    public function limpiar_psid(){
        session()->forget('psid');
        return back();
       
    }

    public function index_bloc(){
        $isopen = 'true';
        return view('bloc',compact('isopen'));
    }
}
