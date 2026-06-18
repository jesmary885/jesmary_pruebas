<?php

namespace App\Http\Livewire\Surveyje;

use App\Models\User;
use App\Models\UseYunkei;
use Livewire\Component;
use GuzzleHttp\Client;
use DateTime;
use Livewire\WithPagination;

class Listar extends Component
{

use WithPagination;
    protected $paginationTheme = "bootstrap";

    public  $user,$jumper_complete = [],$jumper_detect = 0, $app_id, $ext_user_id, $token,$user_idd,$ids;

    protected $listeners = ['render' => 'render'];


    protected $rules = [
        'ids' => 'required',
        'user_idd' => 'required',
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


        $date = new DateTime();

        $date_actual= $date->format('Y-m-d');

        $links_usados = UseYunkei::where('user_id',auth()->user()->id)
            ->wheredate('created_at',$date_actual)
            ->count();
                
        if($links_usados <= 4 || auth()->user()->id == '1' || auth()->user()->id == '2' || auth()->user()->id == '1345' ){

            $links_usados = UseYunkei::where('user_id',auth()->user()->id)
                ->where('codigo_user',$this->user_idd)
                ->wheredate('created_at',$date_actual)
                ->count();

            if(!$links_usados){
                $link_register = new UseYunkei();
                $link_register->codigo_user = $this->user_idd;
                $link_register->user_id  = auth()->user()->id;
                $link_register->save();
            }

            // try {

                
            //     $client = new Client([
            //         //'base_uri' => 'http://127.0.0.1:8000',
            //         'base_uri' => 'http://67.205.168.133/',
            //     ]);


            //     $resultado = $client->request('GET', 'surveyjunkie_encuestas/1/'.$this->token.'/'.$this->user_idd.'/'.$this->ids);

        
            //     if($resultado->getStatusCode() == 200){


            //     $this->jumper_complete = json_decode($resultado->getBody(),true);

            //         if(!$this->jumper_complete)  $this->jumper_detect = 2;

            //     }

            //     else{

            //         $this->jumper_detect = 2;
            //     }
            // }
            // catch (\GuzzleHttp\Exception\RequestException $e) {
                
            //     $error['error'] = $e->getMessage();
            //     $error['request'] = $e->getRequest();

            //     if($e->hasResponse()){
            //         if ($e->getResponse()->getStatusCode() !== '200'){

            //             $error['response'] = $e->getResponse(); 
            //             $this->jumper_detect = 2;
            //         }
            //     }
            // }


        }
        else{
            $this->jumper_detect = 6;
        }


        
    }
    public function render()
    {
        return view('livewire.surveyje.listar');
    }
}
