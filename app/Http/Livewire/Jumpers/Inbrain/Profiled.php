<?php

namespace App\Http\Livewire\Jumpers\Inbrain;

use App\Models\Link;
use App\Models\User;
use Livewire\Component;

use GuzzleHttp\Client;
use Livewire\WithPagination;

class Profiled extends Component
{

    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public  $user,$jumper_detect = 0, $search, $opcion,$time,$monto;

    public  $tipo_total,$respuesta = [],$jumper_complete = [], $psid_search, $panel_search, $informacion_complete ="", $jumper_search, $estado="";

    protected $listeners = ['render' => 'render'];

    protected $rules = [
        'search' => 'required',
    ];

     protected $rules_2 = [
        'jumper_search' => 'required',
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

     public function consultar(){

        $rules_2 = $this->rules_2;
        $this->validate($rules_2);


        try {
                $client = new Client();
    
                $response = $client->post('http://67.205.168.133/inbrain_jumper/1/', [
                    'headers' => ['Content-Type' => 'application/json'],
                    'body' => json_encode([
                        'link' => $this->jumper_search
                    ])
                ]);
    
                $this->respuesta = json_decode($response->getBody(),true);
    
            }
    
            catch (\GuzzleHttp\Exception\RequestException $e) {
                    
                $error['error'] = $e->getMessage();
                $error['request'] = $e->getRequest();
    
                if($e->getMessage()){
                    if ($e->getResponse()->getStatusCode() !== '200'){
                        $error['response'] = $e->getResponse(); 
                        $this->jumper_detect = 2;
                    }
                }
            }

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

       

            ////////////////////////////////////////////////////////////////////////////
             $busqueda_rsid= strpos($this->search, 'rsid=');

            if($busqueda_rsid != false){
                $posicion_rsid = $busqueda_rsid + 5;
                $i_rsid = 0;
                $busq_rsid = 0;

                do{
                    $detect_rsid= substr($this->search, $posicion_rsid,1);
            
                    if($detect_rsid == '&') $i_rsid = 1;
                    else{
                        $posicion_rsid = $posicion_rsid + 1;
                        $busq_rsid ++;
                    }

                    if($busq_rsid > 300){
                        $i_rsid = 2;
                    }
            
                }while($i_rsid == 0 );

                if($i_rsid == 1) $rsid = substr($this->search,($busqueda_rsid + 5),($posicion_rsid - ($busqueda_rsid + 5)));
                else $rsid = substr($this->search,($posicion_rsid ));
            }


            //////////////////////////////////////////////////

             $busqueda_fmas= strpos($this->search, 'fmasSampleId=');

            if($busqueda_fmas != false){
                $posicion_fmas = $busqueda_fmas + 13;
                $i_fmas = 0;
                $busq_fmas = 0;

                do{
                    $detect_fmas= substr($this->search, $posicion_fmas,1);
            
                    if($detect_fmas == '&') $i_fmas = 1;
                    else{
                        $posicion_fmas = $posicion_fmas + 1;
                        $busq_fmas ++;
                    }

                    if($busq_fmas > 300){
                        $i_fmas = 2;
                    }
            
                }while($i_fmas == 0 );

                if($i_fmas == 1) $fmas = substr($this->search,($busqueda_fmas + 13),($posicion_fmas - ($busqueda_fmas + 13)));
                else $fmas = substr($this->search,($posicion_fmas ));
            }

      


            ////////////////////////////////
            $busqueda_profilin= strpos($this->search, 'profilingId=');

            if($busqueda_profilin != false){
                $posicion_profilin = $busqueda_profilin + 12;
                $i_profilin = 0;
                $busq_profilin = 0;

                do{
                    $detect_profilin= substr($this->search, $posicion_profilin,1);
            
                    if($detect_profilin == '&') $i_profilin = 1;
                    else{
                        $posicion_profilin = $posicion_profilin + 1;
                        $busq_profilin ++;
                    }

                    if($busq_profilin > 300){
                        $i_profilin = 2;
                    }
            
                }while($i_profilin == 0 );

                if($i_profilin == 1) $profilin = substr($this->search,($busqueda_profilin + 12),($posicion_profilin - ($busqueda_profilin + 12)));
                else $profilin = substr($this->search,($posicion_profilin ));
            }


         

             ////////////////////////////////
            $busqueda_psid= strpos($this->search, 'psid=');

            if($busqueda_psid != false){
                $posicion_psid = $busqueda_psid + 5;
                $i_psid = 0;
                $busq_psid = 0;

                do{
                    $detect_psid= substr($this->search, $posicion_psid,1);
            
                    if($detect_psid == '*') $i_psid = 1;
                    else{
                        $posicion_psid = $posicion_psid + 1;
                        $busq_psid ++;
                    }

                    if($busq_psid > 300){
                        $i_psid = 2;
                    }
            
                }while($i_psid == 0 );

                if($i_psid == 1) $psid = substr($this->search,($busqueda_psid + 5),($posicion_psid - ($busqueda_psid + 5)));
                else $psid = substr($this->search,($posicion_psid ));
            }


            ////////////////////////////////
            $busqueda_subp= strpos($this->search, 'subpanelid=');

            if($busqueda_subp != false){
                $posicion_subp = $busqueda_subp + 11;
                $i_subp = 0;
                $busq_subp = 0;

                do{
                    $detect_subp= substr($this->search, $posicion_subp,1);
            
                    if($detect_subp == '&') $i_subp = 1;
                    else{
                        $posicion_subp = $posicion_subp + 1;
                        $busq_subp ++;
                    }

                    if($busq_subp > 300){
                        $i_subp = 2;
                    }
            
                }while($i_subp == 0 );

                if($i_subp == 1) $subp = substr($this->search,($busqueda_subp + 11),($posicion_subp - ($busqueda_subp + 11)));
                else $subp = substr($this->search,($posicion_subp ));
            }



             ////////////////////////////////
            $busqueda_choice= strpos($this->search, 'choice=');

            if($busqueda_choice != false){
                $posicion_choice = $busqueda_choice + 7;
                $i_choice = 0;
                $busq_choice = 0;

                do{
                    $detect_choice= substr($this->search, $posicion_choice,1);
            
                    if($detect_choice == '&') $i_choice = 1;
                    else{
                        $posicion_choice = $posicion_choice + 1;
                        $busq_choice ++;
                    }

                    if($busq_subp > 300){
                        $i_choice = 2;
                    }
            
                }while($i_choice == 0 );

                if($i_choice == 1) $choice = substr($this->search,($busqueda_choice + 7),($posicion_choice - ($busqueda_choice + 7)));
                else $choice = substr($this->search,($posicion_choice ));
            }

      
              ////////////////////////////////
            $busqueda_fmasInv= strpos($this->search, 'fmasInvite=');

            if($busqueda_fmasInv != false){
                $posicion_fmasInv = $busqueda_fmasInv + 11;
                $i_fmasInv = 0;
                $busq_fmasInv = 0;

                do{
                    $detect_fmasInv= substr($this->search, $posicion_fmasInv,1);
            
                    if($detect_fmasInv == '&') $i_fmasInv = 1;
                    else{
                        $posicion_fmasInv = $posicion_fmasInv + 1;
                        $busq_fmasInv ++;
                    }

                    if($busq_fmasInv > 300){
                        $i_fmasInv = 2;
                    }
            
                }while($i_fmasInv == 0 );

                if($i_fmasInv == 1) $fmasInv = substr($this->search,($busqueda_fmasInv + 11),($posicion_fmasInv - ($busqueda_fmasInv + 11)));
                else $fmasInv = substr($this->search,($posicion_fmasInv ));
            }


              ////////////////////////////////
            $busqueda_time= strpos($this->search, 'timestamp=');

            if($busqueda_time != false){
                $posicion_time = $busqueda_time + 10;
                $i_time = 0;
                $busq_time = 0;

                do{
                    $detect_time= substr($this->search, $posicion_time,1);
            
                    if($detect_time == '&') $i_time = 1;
                    else{
                        $posicion_time = $posicion_time + 1;
                        $busq_time ++;
                    }

                    if($busq_time > 300){
                        $i_time = 2;
                    }
            
                }while($i_time == 0 );

                if($i_time == 1) $time = substr($this->search,($busqueda_time + 10),($posicion_time - ($busqueda_time + 10)));
                else $time = substr($this->search,($posicion_time ));
            }

     

              ////////////////////////////////
            $busqueda_signature= strpos($this->search, 'signature=');

            if($busqueda_signature != false){
                $posicion_signature = $busqueda_signature + 10;
                $i_signature = 0;
                $busq_signature = 0;

                do{
                    $detect_signature= substr($this->search, $posicion_signature,1);
            
                    if($detect_signature == '&') $i_signature = 1;
                    else{
                        $posicion_signature = $posicion_signature + 1;
                        $busq_signature ++;
                    }

                    if($busq_signature > 300){
                        $i_signature = 2;
                    }
            
                }while($i_signature == 0 );

                if($i_signature == 1) $signature = substr($this->search,($busqueda_signature + 10),($posicion_signature - ($busqueda_signature + 10)));
                else $signature = substr($this->search,($busqueda_signature + 10 ));
            }


            ////////////////////////////////////////////////



     
         $resultado = $client->request('GET', 'inbrain_saltador_profiled/1/'.$a.'/'.$rsid.'/'.$fmas.'/'.$profilin.'/'.$psid.'/'.$subp.'/'.$choice.'/'.$fmasInv.'/'.$time.'/'.$signature);

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
                    }


                } elseif (isset($value ['jumper'])) {

                    $this->jumper_complete = $value ['jumper'];
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
        return view('livewire.jumpers.inbrain.profiled');
    }
}
