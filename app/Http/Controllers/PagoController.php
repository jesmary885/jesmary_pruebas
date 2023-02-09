<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagoController extends Controller
{
    public function index(){
        $isopen = 'true';
        return view('pago.reporte_pago',compact('isopen'));
    }
}
