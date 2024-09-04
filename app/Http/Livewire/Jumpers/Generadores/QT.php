<?php

namespace App\Http\Livewire\Jumpers\Generadores;

use App\Models\User;
use Livewire\Component;
use GuzzleHttp\Client;

class QT extends Component
{


    public $jumper_complete = "", $psid_search, $panel_search, $jumper_detect;

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
        return view('livewire.jumpers.generadores.q-t');
    }

    
    public function generar(){

        $rules = $this->rules;
        $this->validate($rules);

        $this->reset(['jumper_detect']);

  
        try {

            $client = new Client([
                //'base_uri' => 'http://127.0.0.1:8000',
                'base_uri' => 'http://67.205.168.133/',
            ]);

 
            $resultado = $client->request('GET', '/abrir_QT/1/'.$this->psid_search.'/'.$this->panel_search);

            if($resultado->getStatusCode() == 200){

                $this->jumper_complete = json_decode($resultado->getBody(),true);

                //$this->jumper_detect = 1;
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
