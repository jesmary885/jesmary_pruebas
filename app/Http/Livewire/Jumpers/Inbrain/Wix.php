<?php

namespace App\Http\Livewire\Jumpers\Inbrain;

use App\Models\Link;
use App\Models\User;
use Livewire\Component;

use GuzzleHttp\Client;
use Livewire\WithPagination;

class Wix extends Component
{

    use WithPagination;
    protected $paginationTheme = "bootstrap";

     public  $user,$jumper_detect = 0,$search, $opcion,$time,$monto;

    public  $psid,$sub,$tipo_total,$respuesta = [],$jumper_complete = [], $psid_search, $panel_search, $informacion_complete ="", $jumper_search, $estado="";

    protected $listeners = ['render' => 'render'];

    protected $rules = [
        'psid' => 'required',
        'sub' => 'required',
    ];
    
     protected $rules_2 = [
        'jumper_search' => 'required',
    ];
    public function mount(){


        $this->user = User::where('id',auth()->user()->id)->first();

        $this->respuesta = [];
    }

     public function updatedEstado(){

        $this->reset(['psid','sub','jumper_complete','respuesta','jumper_detect','jumper_search']);
      //  $this->informacion_complete = [];
        $this->respuesta = [];
        $this->emitTo('jumpers.inbrain.wix','render');


    }

    public function clear(){
    
       // $this->informacion_complete = [];
        $this->jumper_complete = [];

         $this->jumper_detect = 0;
        //$this->emitTo('jumpers.encuestar.encuestar1-index','render');
    }
    
    public function con(){


        $rules_2 = $this->rules_2;
        $this->validate($rules_2);


        try {
                $client = new Client();
    
                $response = $client->post('http://147.182.190.233/inbrain_jumper/1/', [
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


            $resultado = $client->request('GET', 'inbrain_saltador_wix/1/'.$this->psid.'/'.$this->sub);

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
                }

                $this->jumper_detect = 0;



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
        return view('livewire.jumpers.inbrain.wix');
    }
}
