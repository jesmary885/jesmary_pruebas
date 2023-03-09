<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function users(){
        return view('admin.users');
    }

    public function pagos(){
        return view('admin.pagos');
    }

    public function comunidad(){
        return view('admin.comunidad');
    }

    public function paymentsMethods(){
        return view('admin.metodos_pago');
    }

    public function sales(){
        return view('admin.ventas');
    }

    public function marketplace(){
        $vista = 'venta';
        return view('admin.marketplace',compact('vista'));
    }

    public function marketplace_compra(){
        $vista = 'compra';
        return view('admin.marketplace',compact('vista'));
    }

    public function ganancias(){
        return view('admin.ganancias');
    }
    
    public function jumpers(){
        return view('admin.jumpers');
    }
}
