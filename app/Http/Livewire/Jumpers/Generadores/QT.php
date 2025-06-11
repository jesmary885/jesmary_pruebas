<?php

namespace App\Http\Livewire\Jumpers\Generadores;

use App\Models\User;
use Livewire\Component;
use GuzzleHttp\Client;

class QT extends Component
{

    protected $paginationTheme = "bootstrap";

    public  $user,$jumper_detect = 0, $search, $opcion = 0;

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

    public function render()
    {
        return view('livewire.jumpers.generadores.q-t');
    }

    
    public function procesar(){

        $rules = $this->rules;
        $this->validate($rules);

        $this->reset(['jumper_detect']);

  
        try {


            $client = new Client([
                //'base_uri' => 'http://127.0.0.1:8000',
                'base_uri' => 'http://67.205.168.133/',
            ]);

 
            $resultado = $client->request('GET', '/QT_pstart_web/1/'.$this->search);

            if($resultado->getStatusCode() == 200){

                 $value = json_decode($resultado->getBody(),true);


                if ($value['encuesta'] == 'El pstart no contiene &sfcSessionID ') $this->opcion = 2;
                else{

                    $this->jumper_complete = $value ['encuesta'];
                    $this->opcion = 1;
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
