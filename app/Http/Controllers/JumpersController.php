<?php

namespace App\Http\Controllers;

use App\Http\Livewire\Cint\CintImport;
use App\Models\Link;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class JumpersController extends Controller
{
    public function cint(){
        return view('jumpers.cint');
        
    }

    public function internals(){
        return view('jumpers.internals');
        
    }

    public function k3203(){
    
        return view('jumpers.k3203');
        
     }

    public function kmil(){
       return view('jumpers.k1000');
       
    }

    public function kmilnoventaydos(){
        return view('jumpers.k1092');
        
    }

    public function kdosmilsesentaydos(){
       return view('jumpers.k2062');
        
    }

    public function kveintitres(){
         return view('jumpers.k23');
        
    }

    public function ksietemilcuarentayuno(){
        return view('jumpers.k7341');
     
    }

    public function prodege(){
        return view('jumpers.prodege');
      
    }

    public function samplicio(){
        return view('jumpers.samplicio');
       
    }

    public function scube(){
         return view('jumpers.scube');

    }

    public function spectrum(){
        return view('jumpers.spectrum');
       
    }

    public function toluna(){
        return view('jumpers.toluna');

    }

    public function ssidkr(){
      
        return view('jumpers.ssidkr');
    }

    public function qt(){
        return view('jumpers.qt');
    }

    public function wix(){
        return view('jumpers.wix');
    }

    public function descalificador(){
        return view('jumpers.descalificador');
        
     }

     public function import_cint(Request $request){

        $request->validate([
            'import_file' => 'required'
        ]);
     
        
        $file = $request->file('import_file');

        Excel::import(new CintImport(), $file);

        return redirect()->route('jumpers.cint.cint-index');

    }

}
