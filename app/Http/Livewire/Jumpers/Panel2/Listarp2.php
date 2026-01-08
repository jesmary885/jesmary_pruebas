<?php

namespace App\Http\Livewire\Jumpers\Panel2;

use App\Models\User;
use Livewire\Component;
use GuzzleHttp\Client;
use Livewire\WithPagination;

class Listarp2 extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public  $user,$jumper_complete = [],$jumper_detect = 0, $app_id, $ext_user_id, $token;

    protected $listeners = ['render' => 'render'];


    protected $rules = [
        'app_id' => 'required',
        'ext_user_id' => 'required',
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

    public function procesar(){

  

        $rules = $this->rules;
        $this->validate($rules);

        try {

            
            $client = new Client([
                //'base_uri' => 'http://127.0.0.1:8000',
                'base_uri' => 'http://146.190.74.228/',
            ]);

            $resultado = $client->request('GET', 'Cpx_surveys_listar_encuestasP1_P2/1/'.$this->app_id.'/'.$this->ext_user_id.'/'.$this->token);

     
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
        return view('livewire.jumpers.panel2.listarp2');
    }
}
