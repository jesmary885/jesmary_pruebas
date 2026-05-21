<?php

namespace App\Http\Livewire\Ssi;

use App\Models\CommentLinkSsi;
use App\Models\Linkssi;
use App\Models\User;
use Livewire\Component;
use GuzzleHttp\Client;
use Livewire\WithPagination;

class Listar extends Component
{

use WithPagination;
    protected $paginationTheme = "bootstrap";

    public  $comentario,$user,$jumper_complete = [],$jumper_detect = 0, $ip,$token,$ctx,$jumper_ctx = [],$search,$k_detect=0;

    private $comments = "";
    protected $listeners = ['render' => 'render'];


    protected $rules = [
        // 'ip' => 'required',
        'token' => 'required',
    ];

    
    public function mount(){


      //  if(session('search')) $this->search = session('search');
        $this->jumper_detect = 0;

        $this->user = User::where('id',auth()->user()->id)->first();
    }

    public function clear(){
        $this->reset(['link']);
       // $this->informacion_complete = [];
        $this->jumper_complete = [];

         $this->jumper_detect = 0;
        //$this->emitTo('jumpers.encuestar.encuestar1-index','render');
    }

    public function sacar_link($link){

     $busqueda= strpos($link, '?ctx=');

                if($busqueda != false){
                    return substr($link,($busqueda + 5 ));
                }

    }

    

    

    public function procesar(){

        $this->jumper_detect=0;

  

        $rules = $this->rules;
        $this->validate($rules);

        try {

        // Ver qué valor tiene $this->ip



            $client = new Client([
                //'base_uri' => 'http://127.0.0.1:8000',
                'base_uri' => 'http://147.182.190.233/',
            ]);

                    
            // URL base con path parameters
            $url = 'Listar_SSI/1/' . $this->token;

            // Agregar ip como query parameter solo si tiene valor
            $options = [];
            if (!empty($this->ip)) {
                $options['query'] = ['ip' => $this->ip];
            }

            $resultado = $client->request('GET', $url, $options);

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

    public function procesar_ctx(){

  

        $rules_ctx = $this->rules_ctx;
        $this->validate($rules_ctx);

        try {


             $client = new Client([
                //'base_uri' => 'http://127.0.0.1:8000',
                'base_uri' => 'http://147.182.190.233/',
            ]);


            $resultado = $client->request('GET', 'Ctx_SSI/1/'.$this->ctx);

     
            if($resultado->getStatusCode() == 200){

               $this->jumper_ctx = json_decode($resultado->getBody(),true);

            

                if(!$this->jumper_ctx)  $this->jumper_detect = 2;

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

      

      
        return view('livewire.ssi.listar');
    }
}
