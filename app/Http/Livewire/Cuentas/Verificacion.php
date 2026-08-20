<?php

namespace App\Http\Livewire\Cuentas;

use Livewire\Component;
use GuzzleHttp\Client;

class Verificacion extends Component
{


    public  $jumper_complete = [],$jumper_detect = 0, $search;

    protected $listeners = ['render' => 'render'];

    protected $rules = [
        'search' => 'required',
    ];
    
    public function mount(){


        if(session('search')) $this->search = session('search');
        $this->jumper_detect = 0;


    }

    public function clear(){
        $this->reset(['search']);
        $this->jumper_complete = [];
        $this->jumper_detect = 0;
    }

    public function procesar(){

        $rules = $this->rules;
        $this->validate($rules);

        $this->jumper_detect = 0;

        
           
         try {

            
            // if($b_asper == 0){

            //     $client = new Client([
            //     //'base_uri' => 'http://127.0.0.1:8000',
            //         'base_uri' => 'http://146.190.74.228/',
            //     ]);

            //      $resultado = $client->request('GET', 'Startp/1/'.$e.'/'.$p.'/'.$c.'/'.$u.'/'.$s.'/'.$l.'/'.$r.'/'.$t.'/'.$o.'/'.$prcr.'/'.$h);

            // }else{

                $client = new Client();

                $resultado = $client->post('http://147.182.190.233/status_revision/1/', [
                    'headers' => ['Content-Type' => 'application/json'],
                    'body' => json_encode([
                        'link' => $this->search
                    ])
                ]);

            // }
            

            if($resultado->getStatusCode() == 200){

                $this->jumper_complete = json_decode($resultado->getBody(),true);


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
    public function render()
    {
        return view('livewire.cuentas.verificacion');
    }
}
