<?php

namespace App\Http\Livewire\Jumpers\CPX;

use App\Models\Links_usados;
use App\Models\User;
use DateTime;
use Livewire\Component;
use GuzzleHttp\Client;
use Livewire\WithPagination;

class CpxCalificador extends Component
{

     use WithPagination;
    protected $paginationTheme = "bootstrap";

    public  $user,$jumper_complete = [],$jumper_detect = 0, $app_id, $link, $survery_id;

    protected $listeners = ['render' => 'render'];

    protected $rules = [
        'app_id' => 'required',
         'survery_id' => 'required',
        'link' => 'required',
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

            $client = new Client();

                $resultado = $client->post('http://146.190.74.228/cpx_survey_detail_freecash/1/'.$this->app_id.'/'.$this->survery_id, [
                    'headers' => ['Content-Type' => 'application/json'],
                    'body' => json_encode([
                        'link' => $this->link
                    ])
                ]);

     
            if($resultado->getStatusCode() == 200){

                $date = new DateTime();

                $date_actual= $date->format('Y-m-d H:i:s');
                $date_actual_30 = $date->modify('-30 minute')->format('Y-m-d H:i:s');

                $links_usados = Links_usados::where('k_detected','CPX-CALIFICADOR')
                    ->where('user_id',$this->user->id)
                    ->whereBetween('created_at',[$date_actual_30,$date_actual])
                    ->count();

                if($links_usados <= 8){
                    $this->jumper_complete = json_decode($resultado->getBody(),true);

                    $link_register = new Links_usados();
                    $link_register->link = $this->link;
                    $link_register->k_detected  = 'CPX-CALIFICADOR';
                    $link_register->user_id  = $this->user->id;
                    $link_register->link_resultado = $this->jumper_complete['link'];
                    $link_register->save();
                }

                else{

                    $this->jumper_detect = 6;
                }


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
        return view('livewire.jumpers.c-p-x.cpx-calificador');
    }
}
