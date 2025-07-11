<?php

namespace App\Http\Livewire\Jumpers\Inbrain;

use App\Models\Link;
use App\Models\User;
use Livewire\Component;
use GuzzleHttp\Client;
use Livewire\WithPagination;

class Rex extends Component
{

       use WithPagination;
    protected $paginationTheme = "bootstrap";

    public  $user,$jumper_detect = 0, $search, $opcion,$time,$monto;

    public  $tipo_total,$respuesta = [],$jumper_complete = [], $psid_search, $panel_search, $informacion_complete ="", $jumper_search, $estado="";

    protected $listeners = ['render' => 'render'];

    protected $rules = [
        'search' => 'required',
    ];
    
    public function mount(){


        if(session('search')) $this->search = session('search');
        $this->jumper_detect = 0;

        $this->user = User::where('id',auth()->user()->id)->first();
    }

    public function clear(){
        $this->reset(['search']);
       // $this->informacion_complete = [];
        $this->jumper_complete = [];

         $this->jumper_detect = 0;
        //$this->emitTo('jumpers.encuestar.encuestar1-index','render');
    }

    public function procesar(){

        $rules = $this->rules;
        $this->validate($rules);


         try {


            $client = new Client([
                //'base_uri' => 'http://127.0.0.1:8000',
                'base_uri' => 'http://147.182.190.233/',
            ]);

            $busqueda_a= strpos($this->search, 'access_key=');

            if($busqueda_a != false){
                $posicion_a = $busqueda_a + 11;
                $i_a = 0;
                $busq_a = 0;

                do{
                    $detect_a= substr($this->search, $posicion_a,1);
            
                    if($detect_a == '&') $i_a = 1;
                    else{
                        $posicion_a = $posicion_a + 1;
                        $busq_a ++;
                    }

                    if($busq_a > 300){
                        $i_a = 2;
                    }
            
                }while($i_a == 0 );

                if($i_a == 1) $a = substr($this->search,($busqueda_a + 11),($posicion_a - ($busqueda_a + 11)));
                else $a = substr($this->search,($posicion_a ));
            }

            /////////////////////////////////////////////////

            $busqueda_ch= strpos($this->search, 'choice=');

            if($busqueda_ch != false){
                $posicion_ch = $busqueda_ch + 7;
                $i_ch = 0;
                $busq_ch = 0;

                do{
                    $detect_ch= substr($this->search, $posicion_ch,1);
            
                    if($detect_ch == '&') $i_ch = 1;
                    else{
                        $posicion_ch = $posicion_ch + 1;
                        $busq_ch ++;
                    }

                    if($busq_ch > 300){
                        $i_ch = 2;
                    }
            
                }while($i_ch == 0 );

                if($i_ch == 1) $ch = substr($this->search,($busqueda_ch + 7),($posicion_ch - ($busqueda_ch + 7)));
                else $ch = substr($this->search,($posicion_ch ));
            }

            //////////////////////////////////////////////////

             $busqueda_sd= strpos($this->search, 'sourceData=');

            if($busqueda_sd != false){
                $posicion_sd = $busqueda_sd + 11;
                $i_sd = 0;
                $busq_sd = 0;

                do{
                    $detect_sd= substr($this->search, $posicion_sd,1);
            
                    if($detect_sd == '&') $i_sd = 1;
                    else{
                        $posicion_sd = $posicion_sd + 1;
                        $busq_sd ++;
                    }

                    if($busq_sd > 300){
                        $i_sd = 2;
                    }
            
                }while($i_sd == 0 );

                if($i_sd == 1) $sd = substr($this->search,($busqueda_sd + 11),($posicion_sd - ($busqueda_sd + 11)));
                else $sd = substr($this->search,($posicion_sd ));
            }

            ////////////////////////////////

            $busqueda_tt= strpos($this->search, 'timestamp=');

            if($busqueda_tt != false){
                $posicion_tt = $busqueda_tt + 10;
                $i_tt = 0;
                $busq_tt = 0;

                do{
                    $detect_tt= substr($this->search, $posicion_tt,1);
            
                    if($detect_tt == '&') $i_tt = 1;
                    else{
                        $posicion_tt = $posicion_tt + 1;
                        $busq_tt ++;
                    }

                    if($busq_tt > 300){
                        $i_tt = 2;
                    }
            
                }while($i_tt == 0 );

                if($i_tt == 1) $tt = substr($this->search,($busqueda_tt + 10),($posicion_tt - ($busqueda_tt + 10)));
                else $tt = substr($this->search,($posicion_tt ));
            }else{

                 $busqueda_ttt= strpos($this->search, '×tamp=');

                if($busqueda_ttt != false){
                    $posicion_ttt = $busqueda_ttt + 7;
                    $i_ttt = 0;
                    $busq_ttt = 0;

                    do{
                        $detect_ttt= substr($this->search, $posicion_ttt,1);
                
                        if($detect_ttt == '&') $i_ttt = 1;
                        else{
                            $posicion_ttt = $posicion_ttt + 1;
                            $busq_ttt ++;
                        }

                        if($busq_ttt > 300){
                            $i_ttt = 2;
                        }
                
                    }while($i_ttt == 0 );

                    if($i_ttt == 1) $tt = substr($this->search,($busqueda_ttt + 7),($posicion_ttt - ($busqueda_ttt + 7)));
                    else $tt = substr($this->search,($posicion_ttt ));
                }

            }

            ////////////////////////////////////////////////

    


            $busqueda_s= strpos($this->search, 'signature=');

            if($busqueda_s != false){
                $posicion_s = $busqueda_s + 10;
                $i_s = 0;
                $busq_s = 0;

                do{
                    $detect_s= substr($this->search, $posicion_s,1);
            
                    if($detect_s == '&') $i_s = 1;
                    else{
                        $posicion_s = $posicion_s + 1;
                        $busq_s ++;
                    }

                    if($busq_s > 500){
                        $i_s = 2;
                    }
            
                }while($i_s == 0 );

                if($i_s == 1) $s = substr($this->search,($busqueda_s + 10),($posicion_s - ($busqueda_s + 10)));
                else{

                    $s = substr($this->search,($busqueda_s + 10));
                } 
            }



     
         $resultado = $client->request('GET', 'inbrain_rex/1/'.$a.'/'.$ch.'/'.$sd.'/'.$tt.'/'.$s);

            if($resultado->getStatusCode() == 200){

                $value = json_decode($resultado->getBody(),true);

                if (isset($value ['survey_link'])) {

                    if (isset($value ['monto'])) {

                        $this->jumper_complete = $value ['survey_link'];
                        $this->time = $value ['time'];
                        $this->monto = $value ['monto'];
                        $this->opcion = 3;

                    } elseif (isset($value ['time'])) {

                        $this->jumper_complete = $value ['survey_link'];
                        $this->time = $value ['time'];
                        $this->opcion = 4;
                    }else{
                        $this->jumper_complete = $value ['survey_link'];
                        $this->opcion = 1;
                    }


                } elseif (isset($value ['Screen'])) {

                    $this->jumper_complete = $value ['Screen'];
                    $this->opcion = 2;
                }




                if(!$this->jumper_complete)  $this->jumper_detect = 2;
    
            }

            else{

                $this->jumper_detect = 2;
            }
        }
        catch (\GuzzleHttp\Exception\RequestException $e) {
            
            $error['error'] = $e->getMessage();
            $error['request'] = $e->getRequest();

            if($e->hasResponse()){
                if ($e->getResponse()->getStatusCode() !== '200'){

      

                    $error['response'] = $e->getResponse(); 
                    $this->jumper_detect = 2;
                }
            }
        }
    }

    public function type($jumper){

        $busqueda_psid_ = strpos($jumper, 'psid=');
        $subs_psid = substr($jumper,($busqueda_psid_ + 5),5);

        $busqueda = Link::where('psid',$subs_psid)->first();

        if($busqueda){

            if($busqueda->k_detected){

                $this->tipo_total='si';
                return $busqueda->k_detected;
    
            } 
            elseif($busqueda->basic){
                $this->tipo_total='si';
                return 'Basic';
    
            } 
            elseif ($busqueda->high){
                $this->tipo_total='si';
                return 'High';
    
            } 
            else{
    
                $this->tipo_total='no';
                return 'No registrada';
    
            } 

        }

        else{
    
            $this->tipo_total='no';
            return 'No registrada';

        } 

        
    }

    public function positive($jumper){
        if($this->tipo_total == 'si'){

            $busqueda_psid_ = strpos($jumper, 'psid=');
            $subs_psid = substr($jumper,($busqueda_psid_ + 5),5);

            $busqueda = Link::where('psid',$subs_psid)->first();

            if($busqueda)return $busqueda->positive_points; 
            else return '-';
        }

        else{
            return '-';
        }


        
        
    }

    public function negative($jumper){

        if($this->tipo_total == 'si'){
            $busqueda_psid_ = strpos($jumper, 'psid=');
            $subs_psid = substr($jumper,($busqueda_psid_ + 5),5);

            $busqueda = Link::where('psid',$subs_psid)->first();

            if($busqueda) return $busqueda->negative_points;
            else return '-';
            
        }
        else{
            return '-';
        }
    }

    public function render()
    {
        return view('livewire.jumpers.inbrain.rex');
    }
}
