<?php

namespace App\Http\Livewire\Jumpers\Encuestar;

use Livewire\Component;
use App\Models\Link;
use GuzzleHttp\Client;

class Encuestar4Index extends Component
{
    public $jumper_detect = 0, $tipo_total,$respuesta = [],$jumper_complete = "", $psid_search, $panel_search, $informacion_complete ="", $jumper_search, $estado="";

    protected $listeners = ['render' => 'render'];

    protected $rules = [
        'psid_search' => 'required',
        'panel_search' => 'required',
    ];

    protected $rules2 = [
        'jumper_search' => 'required',
    ];

    public function mount(){

        $this->informacion_complete = [];
        $this->respuesta = [];
    }

    public function render()
    {
        if($this->jumper_search){

            try {
                $client = new Client();
    
                $response = $client->post('http://146.190.74.228/jumper_ssi/1/', [
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

        return view('livewire.jumpers.encuestar.encuestar4-index');
    }

    public function updatedEstado(){

        $this->reset(['psid_search','panel_search','jumper_search','respuesta','jumper_detect']);
        $this->informacion_complete = [];
        $this->respuesta = [];
        $this->emitTo('jumpers.encuestar.encuestar4-index','render');


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

    public function clear(){
        $this->reset(['jumper_search','jumper_detect']);
       // $this->informacion_complete = [];
        $this->respuesta = [];
        //$this->emitTo('jumpers.encuestar.encuestar1-index','render');
    }



    public function consultar(){

        $rules = $this->rules;
        $this->validate($rules);
   
       // $this->emitTo('jumpers.encuestar.encuestar1-index','render');
  

        $this->reset(['jumper_search','respuesta','jumper_detect']);

        try {

            $client = new Client([
                //'base_uri' => 'http://127.0.0.1:8000',
                'base_uri' => 'http://146.190.74.228/',
            ]);

            if($this->panel_search == '38') $resultado = $client->request('GET', 'datos_encuestas_qt/1/'.$this->psid_search.'/'.$this->panel_search);
            else $resultado = $client->request('GET', 'jumper_vo_er/1/'.$this->psid_search.'/'.$this->panel_search);

            if($resultado->getStatusCode() == 200){

                $this->informacion_complete = json_decode($resultado->getBody(),true);

               


                if(!$this->informacion_complete)  $this->jumper_detect = 2;
                else{
                    $busqueda_https= strpos($this->informacion_complete['jumper'], 'ttps://');

                    if($busqueda_https != false) $this->jumper_detect = 10;
                    else $this->jumper_detect = 1;
                }
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

    public function generar(){

        try {
            $client = new Client();

            $response = $client->post('http://146.190.74.228/jumper_ssi/1/', [
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
                    $this->jumper_detect = 15;
                }
            }
        }

    }
}

