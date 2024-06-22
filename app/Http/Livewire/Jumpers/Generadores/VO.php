<?php

namespace App\Http\Livewire\Jumpers\Generadores;

use App\Models\User;
use Livewire\Component;
use GuzzleHttp\Client;

class VO extends Component
{

    public $jumper_complete = "", $psid_search, $panel_search, $jumper_detect = 0;

    protected $listeners = ['render' => 'render'];

    protected $rules = [
        'psid_search' => 'required',
        'panel_search' => 'required',
    ];

    public function mount(){

        $this->jumper_complete = [];
    }

    public function render()
    {
        return view('livewire.jumpers.generadores.v-o');
    }

    public function generar(){


        $rules = $this->rules;
        $this->validate($rules);

        
        try {

            $client = new Client([
                //'base_uri' => 'http://127.0.0.1:8000',
                'base_uri' => 'http://146.190.74.228/',
            ]);


            $resultado = $client->request('GET', 'abrirc/1/'.$this->psid_search.'/'.$this->panel_search);

            if($resultado->getStatusCode() == 200){
                $this->jumper_complete = json_decode($resultado->getBody(),true);
            }

            else{
    
            }
        }
        catch (\GuzzleHttp\Exception\RequestException $e) {

            $error['error'] = $e->getMessage();
            $error['request'] = $e->getRequest();

            if($e->hasResponse()){
                if ($e->getResponse()->getStatusCode() !== '200'){
                    /*$error['response'] = $e->getResponse(); 
                    $this->jumper_detect = 2;*/ 


                    try {

                        $client = new Client([
                            //'base_uri' => 'http://127.0.0.1:8000',
                            'base_uri' => 'http://146.190.74.228/',
                        ]);
            
                        $resultado = $client->request('GET', 'abrirc_2/1/'.$this->psid_search.'/'.$this->panel_search);
            
                        if($resultado->getStatusCode() == 200){
        
                           
            
                            $this->jumper_complete = json_decode($resultado->getBody(),true);
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
            }

        }
    }

    public function clear_psid(){
        $this->reset(['psid_search']);

       // $this->jumper_complete = [];

       // return redirect()->route('generador_vo.index');

    }

    public function clear_panel(){
        $this->reset(['panel_search']);

       // $this->jumper_complete = [];

       // return redirect()->route('generador_vo.index');

    }
}
