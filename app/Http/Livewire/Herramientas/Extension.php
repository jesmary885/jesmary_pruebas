<?php

namespace App\Http\Livewire\Herramientas;

use App\Models\Links_usados;
use App\Models\User;
use Livewire\Component;
use GuzzleHttp\Client;
use Livewire\WithPagination;
use DateTime;

class Extension extends Component
{
     use WithPagination;
    protected $paginationTheme = "bootstrap";

    public  $user,$jumper_complete = [],$jumper_detect = 0, $email, $numero;

    protected $listeners = ['render' => 'render'];

    protected $rules = [
        'numero' => 'required',
    ];
    
    public function mount(){


      //  if(session('search')) $this->search = session('search');
        $this->jumper_detect = 0;

        $this->user = User::where('id',auth()->user()->id)->first();
    }

    public function clear(){
        $this->reset(['email','contrasena']);
       // $this->informacion_complete = [];
        $this->jumper_complete = [];

         $this->jumper_detect = 0;
        //$this->emitTo('jumpers.encuestar.encuestar1-index','render');
    }

    public function procesar(){

        $rules = $this->rules;
        $this->validate($rules);

        $date = new DateTime();

        $date_actual= $date->format('Y-m-d');

        
        $links_usados = Links_usados::where('k_detected','extension')
            ->where('user_id',$this->user->id)
             ->whereDate('created_at',$date_actual)
            ->count();

                        
        if($links_usados <= 4 ){

            try {



    
                $client = new Client([
                    //'base_uri' => 'http://127.0.0.1:8000',
                    'base_uri' => 'http://67.205.168.133/',
                ]);

        
        
            $resultado = $client->request('GET', 'calcular_sha1/1/'.$this->numero);


                if($resultado->getStatusCode() == 200){

                    $this->jumper_complete = json_decode($resultado->getBody(),true);

                    $link_register = new Links_usados();
                        $link_register->link = $this->numero;
                        $link_register->link_resultado = $this->jumper_complete['key'];
                        $link_register->k_detected  = 'extension';
                        $link_register->user_id  = $this->user->id;
                        $link_register->save();

                    
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
        }else{
             $this->jumper_detect = 8;
        }
    }


    public function render()
    {
        return view('livewire.herramientas.extension');
    }
}
