<?php

namespace App\Http\Controllers;

use App\Http\Livewire\Cint\CintImport;
use App\Imports\DataCintImport;
use App\Models\Link;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class JumpersController extends Controller
{
    public function cint(){
        return view('jumpers.cint');
    }

    public function cint2(){
        return view('jumpers.cint2');
    }

    public function k1083(){
        return view('jumpers.k1083');
    }

    public function k1020(){
        return view('jumpers.k1020');
    }

    public function k10611(){
        return view('jumpers.k10611');
    }

    public function k11619(){
        return view('jumpers.k11619');
    }

    public function k10659(){
        return view('jumpers.k10659');
    }

    public function k1093(){
        return view('jumpers.k1093');
    }

    public function k2049(){
        return view('jumpers.k2049');
    }

    public function k1091(){
        return view('jumpers.k1091');
    }

    public function k10634(){
        return view('jumpers.k10634');
    }

    public function internals(){
        return view('jumpers.internals');
    }

    public function k3906(){
        return view('jumpers.k3906');
     }

     public function k3203(){
        return view('jumpers.k3203');
     }

     public function k2066(){
        return view('jumpers.k2066');
     }

     public function k2001(){
        return view('jumpers.k2001');
     }

     public function ktmr(){
        return view('jumpers.ktmr');
     }

     public function k11052(){
        return view('jumpers.k11052');
     }
     public function k15293(){
        return view('jumpers.k15293');
     }
     public function k17564(){
        return view('jumpers.k17564');
     }

     public function k1098(){
        return view('jumpers.k1098');
     }

     public function k1092(){
        return view('jumpers.k1092');
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

    public function samplicio_bz(){
        return view('jumpers.samplicio_bz');
       
    }

    public function samplicio_index(){
        return view('jumpers.samplicio_index');
       
    }

    public function samplicio_p(){
        return view('jumpers.samplicio_p');
       
    }

    public function scube(){
         return view('jumpers.scube');

    }

    public function spectrum(){
        return view('jumpers.spectrum');
       
    }

    public function spectrum2(){
        return view('jumpers.spectrum2');
       
    }

    public function spectrum3(){
        return view('jumpers.spectrum3');
       
    }

    public function toluna(){
        return view('jumpers.toluna');
    }

    public function toluna2(){
        return view('jumpers.toluna2');
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

       /* $request->validate([
            'import_file' => 'required'
        ]);*/
     
        $file = $request->file('import_file');

        Excel::import(new DataCintImport, $file);

        return redirect()->route('cint.index');
    }

        public function kmil_poderosa1(){
            return view('jumpers.kmil_poderosa');
         
        }

        public function kmil_poderosa2(){
            return view('jumpers.kmil_poderosa2');
         
        }

        public function k23_poderosa(){
            return view('jumpers.k23_poderosa');
         
        }

        public function k2028(){
            return view('jumpers.k2028');
         
        }

        public function k5460(){
            return view('jumpers.k5460');
         
        }

        public function k6057(){
            return view('jumpers.k6057');
         
        }

        public function k7341_poderosa(){
            return view('jumpers.k7341_poderosa');
        }

}
