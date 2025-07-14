<?php

namespace App\Http\Controllers;

use App\Http\Livewire\Cint\CintImport;
use App\Imports\DataCintImport;
use App\Models\Link;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class JumpersController extends Controller
{


    public function cpxListar(){
        return view('cpx.listar');
    }

    public function cpxListar_2(){
        return view('cpx.listar_2');
    }

    public function cpxGenerar(){
        return view('cpx.generar');
    }



    public function cpxCalificador(){
        return view('cpx.calificador');
    }
    public function cpxJumper(){
        return view('cpx.jumper');
    }



    public function paradigsample(){
        return view('jumpers.paradigsample');
    }
    public function invite(){
        return view('jumpers.invite');
    }
    public function edgeapi(){
        return view('jumpers.edgeapi');
    }
    public function research(){
        return view('jumpers.research');
    }
    public function samplecube(){
        return view('jumpers.samplecube');
    }
    public function samplicity(){
        return view('jumpers.samplicity');
    }
    public function sayso(){
        return view('jumpers.sayso');
    }
    public function opinion(){
        return view('jumpers.opinion');
    }
    public function survey_emirs(){
        return view('jumpers.survey_emirs');
    }


    

    public function AdscenmeciaListar(){
        return view('Adscenmecia.listar');
    }
    public function Adscenmecia_saltador(){
        return view('Adscenmecia.saltador');
    }



    public function inbrainrex(){
        return view('inbrain.rex');
    }
    public function inbrainprofiled(){
        return view('inbrain.profiled');
    }
    public function inbrainwix(){
        return view('inbrain.wix');
    }
    public function inbrainstart(){
        return view('inbrain.start');
    }


    public function panel1Login(){
        return view('panel1.login');
    }

    

    public function panel3Login(){
        return view('panel3.login');
    }

    public function panel1Start(){
        return view('panel1.start');
    }

    public function panel1Jumper(){
        return view('panel1.jumper');
    }

     public function panel2Login(){
        return view('panel2.login');
    }

    public function panel2Start(){
        return view('panel2.start');
    }

    public function panel2Jumper(){
        return view('panel2.jumper');
    }

    public function pollsaltador(){
        return view('poll.saltador');
    }

    public function pollpreguntas(){
        return view('poll.preguntas');
    }

    public function polledad(){
        return view('poll.edad');
    }

    public function cint(){
        return view('jumpers.cint');
    }

    public function yoursurveynow(){
        return view('admin.yoursurveynow');
    }

    public function cint2(){
        return view('jumpers.cint2');
    }

    public function bitlab(){
        return view('jumpers.bitlab');
    }

    public function pollfish(){
        return view('jumpers.pollfish');
    }

    public function swagbucks(){
        return view('jumpers.swagbucks');
    }

    

    public function interno(){
        return view('jumpers.internals');
    }

    public function prodege_index(){
        return view('jumpers.prodege_index');
    }

    public function prodege_generador(){
        return view('jumpers.prodege_generador');
    }

    public function k1083(){
        return view('jumpers.k1083');
    }

    public function k1093_bea(){
        return view('jumpers.k1093_bea');
    }

    public function k5541(){
        return view('jumpers.k5541');
    }

    public function k7107(){
        return view('jumpers.k7107');
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

     public function k2000(){
        return view('jumpers.k2000');
     }

     public function k10125(){
        return view('jumpers.k10125');
     }

     public function k4453(){
        return view('jumpers.k4453');
     }

     public function k3889(){
        return view('jumpers.k3889');
     }

     public function k11483(){
        return view('jumpers.k11483');
     }

     public function k2066_poderosa(){
        return view('jumpers.k2066_poderosa');

     }

     public function k2001(){
        return view('jumpers.k2001');
     }

     public function ktmr(){
        return view('jumpers.ktmr');
     }

     public function ktmr_ssi(){
        return view('jumpers.ktmr_ssi');
     }

     public function ipso(){
        return view('jumpers.ipso');
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

    public function samplicio_cash(){
        return view('jumpers.samplicio_cash');
    }


    public function samplicio_tw(){
        return view('jumpers.samplicio_tw');
       
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

    public function spectrum_principal(){
        return view('jumpers.spectrum_principal');
       
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

    public function spectrum4(){
        return view('jumpers.spectrum4');
       
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

        public function k23_poderosa_SK2(){
            return view('jumpers.k23_poderosa_SK2');
         
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

        public function generador_new_qt(){
            return view('jumpers.generador_new_qt');
        }

         public function generador_new_qt_2(){
            return view('jumpers.generador_new_qt_2');
        }

        public function generador_new_vo(){
            return view('jumpers.generador_new_vo');

            
        }


        public function k23_poderosa_v2(){
            return view('jumpers.k23_poderosa_v2');
        }

        public function k1083_v2(){
            return view('jumpers.k1083_v2');
        }

        public function detector(){
            return view('jumpers.detector');
        }



        public function encuestar(){
            return view('jumpers.encuestar');

            
        }

}
