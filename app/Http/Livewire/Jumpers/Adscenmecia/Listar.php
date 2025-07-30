<?php

namespace App\Http\Livewire\Jumpers\Adscenmecia;


use App\Models\User;
use Livewire\Component;
use GuzzleHttp\Client;
use Livewire\WithPagination;

class Listar extends Component
{

    
     use WithPagination;
    protected $paginationTheme = "bootstrap";

    public  $user,$jumper_complete = [],$jumper_detect = 0, $type, $link, $encuentas_actk;

    protected $listeners = ['render' => 'render'];

    protected $rules = [
        'type' => 'required',
    ];

     public function updatedType(){
        $this->jumper_complete = [];
    }
    
    public function mount(){


      //  if(session('search')) $this->search = session('search');
        $this->jumper_detect = 0;
         $this->jumper_complete = [];

        $this->user = User::where('id',auth()->user()->id)->first();
    }

    public function clear(){
        $this->reset(['link']);
       // $this->informacion_complete = [];
        $this->jumper_complete = [];

         $this->jumper_detect = 0;
        //$this->emitTo('jumpers.encuestar.encuestar1-index','render');
    }

    public function procesar(){
  

        $rules = $this->rules;
        $this->validate($rules);

         $this->jumper_detect = 0;

        try {


            if($this->type == 'Inbrain') $codigo = '5140414';
            elseif($this->type == 'Bitlabs') $codigo = '5064420';
            elseif($this->type == 'CInt') $codigo = '45003';
            elseif($this->type == 'cpx') $codigo = '5000313';
            elseif($this->type == 'Opinion Network') $codigo = '5326343';
            elseif($this->type == 'Toluna') $codigo = '2951652';
            elseif($this->type == 'Grabpoints') $codigo = '5968664';
            elseif($this->type == 'Uniflow') $codigo = '5231984';
            elseif($this->type == 'ipso') $codigo = '5040990';
            else $codigo = '5905064';

             $client = new Client();

                $resultado = $client->post('http://67.205.168.133/Adscendmedia_encuestas/1/'.$codigo, [
                    'headers' => ['Content-Type' => 'application/json'],
                    'body' => json_encode([
                        'link' => $this->link
                    ])
                ]);


            if($resultado->getStatusCode() == 200){

               
                $this->jumper_complete = json_decode($resultado->getBody(),true);

                 if($this->jumper_complete['surveys'] == "No se encontraron Encuestas") $this->encuentas_act = 0;
                 else $this->encuentas_act = 1;
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
        return view('livewire.jumpers.adscenmecia.listar');
    }
}
