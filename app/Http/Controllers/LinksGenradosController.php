<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LinksGenradosController extends Controller
{
    public function index(){

        $isopen = 'true';
        return view('jumpers.ver_links',compact('isopen'));
    }

    public function index_informacion(){

        $isopen = 'true';
        return view('info_interes',compact('isopen'));
    }

    public function info(){
        return view('info');
    }
}
