<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $user = User::where('id',auth()->user()->id)->first();
        $rol = $user->roles->first()->id;

        return view('home',compact('rol'));
    }


}
