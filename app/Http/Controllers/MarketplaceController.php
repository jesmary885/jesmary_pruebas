<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MarketplaceController extends Controller
{
    public function index(){
        return view('marketplace.index');
    }

    public function shop($marketplace){
        return view('marketplace.shop',compact('marketplace'));
    }

    public function compras(){
        return view('mis_compras.index');
    }
}
