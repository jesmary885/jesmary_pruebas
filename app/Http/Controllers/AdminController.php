<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function users_jump(){
        return view('admin.users_jump');
    }

    public function users(){
        return view('admin.users');
    }

    public function modificaciones(){
        return view('admin.modificaciones');
    }

    public function canje(){
        return view('admin.canje');
    }

    public function multilogin(){
        return view('admin.multilogin');
    }

    public function users_paying(){
        return view('admin.users_paying');

    }

    public function k_nuevas(){
        return view('admin.k_nuevas');

    }

    public function tasa_cambio(){
        return view('admin.tasa_cambio');
    }

    public function jumper_dia(){
        return view('admin.jumper_dia');
    }

    public function comentarios(){
        return view('admin.comentarios');

    }

    public function users_free(){
        return view('admin.users_free');
        
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

    public function links_gener(){
        return view('admin.links_gener');
    }

}
