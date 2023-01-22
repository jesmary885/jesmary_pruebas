<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function users(){
        return view('admin.users');
    }

    public function paymentsMethods(){
        return view('admin.metodos_pago');
    }

    public function sales(){
        return view('admin.ventas');
    }

    public function marketplace(){
        return view('admin.marketplace');
    }

    public function ganancias(){
        return view('admin.ganancias');
    }
    
    public function jumpers(){
        return view('admin.jumpers');
    }
}
