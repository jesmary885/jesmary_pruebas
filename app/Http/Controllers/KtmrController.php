<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KtmrController extends Controller
{
    public function generador(){
        return view('ktmr.generador');
    }

    public function cuentas(){
        return view('ktmr.cuentas');
    }

    public function administracion(){
        return view('ktmr.administracion');
    }

    public function administracion_cuentas(){
        return view('ktmr.administracion_cuentas');
    }
}
