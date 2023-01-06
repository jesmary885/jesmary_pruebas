<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;

class JumpersController extends Controller
{
    public function cint($jumper=0,$link_complete=0){
        return view('jumpers.cint',compact('jumper','link_complete'));
        
    }

    public function internals($jumper=0,$link_complete=0){
        return view('jumpers.internals',compact('jumper','link_complete'));
        
    }

    public function kmil($jumper=0,$link_complete=0){
       return view('jumpers.k1000',compact('jumper','link_complete'));
       
    }

    public function kmilnoventaydos($jumper=0,$link_complete=0){
        return view('jumpers.k1092',compact('jumper','link_complete'));
        
    }

    public function kdosmilsesentaydos($jumper=0,$link_complete=0){
       return view('jumpers.k2062',compact('jumper','link_complete'));
        
    }

    public function kveintitres($jumper=0,$link_complete=0){
         return view('jumpers.k23',compact('jumper','link_complete'));
        
    }

    public function ksietemilcuarentayuno($jumper=0,$link_complete=0){
        return view('jumpers.k7341',compact('jumper','link_complete'));
     
    }

    public function prodege($jumper=0,$link_complete=0){
        return view('jumpers.prodege',compact('jumper','link_complete'));
      
    }

    public function samplicio($jumper=0,$link_complete=0){
        return view('jumpers.samplicio',compact('jumper','link_complete'));
       
    }

    public function scube($jumper=0,$link_complete=0){
         return view('jumpers.scube',compact('jumper','link_complete'));

    }

    public function spectrum($jumper=0,$link_complete=0){
        return view('jumpers.spectrum',compact('jumper','link_complete'));
       
    }

    public function toluna($jumper=0,$link_complete=0){
        return view('jumpers.toluna',compact('jumper','link_complete'));

    }

    public function ssidkr($jumper=0,$link_complete=0){
        return view('jumpers.ssidkr',compact('jumper','link_complete'));
    }

}
