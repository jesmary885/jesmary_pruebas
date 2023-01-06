<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SobrenosotrosController extends Controller
{
    public function index(){
        return view('sobre-nosotros.index');
    }
}
