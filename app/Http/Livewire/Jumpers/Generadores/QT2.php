<?php

namespace App\Http\Livewire\Jumpers\Generadores;

use App\Models\Link;
use App\Models\User;
use Livewire\Component;

use GuzzleHttp\Client;
use Livewire\WithPagination;


class QT2 extends Component
{

     use WithPagination;
    protected $paginationTheme = "bootstrap";

    public  $user,$jumper_detect = 0, $search;

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

    public function procesar(){

        $rules = $this->rules;
        $this->validate($rules);

        $this->reset(['jumper_detect']);

        try {
            $client = new Client();

            $response = $client->post('http://147.182.190.233/inbrain_pstart/1/', [
                'headers' => ['Content-Type' => 'application/json'],
                'body' => json_encode([
                    'link' => $this->search
                ])
            ]);

            $this->respuesta = json_decode($response->getBody(),true);

        }

        catch (\GuzzleHttp\Exception\RequestException $e) {
                
            $error['error'] = $e->getMessage();
            $error['request'] = $e->getRequest();

            if($e->getMessage()){
                if ($e->getResponse()->getStatusCode() !== '200'){
                    $error['response'] = $e->getResponse(); 
                    $this->jumper_detect = 2;
                }
            }
        }


    }

    public function render()
    {
        return view('livewire.jumpers.generadores.q-t2');
    }
}
