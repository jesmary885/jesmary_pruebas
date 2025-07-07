<?php

namespace App\Http\Livewire\Jumpers\CPX;

use App\Models\Links_usados;
use App\Models\User;
use DateTime;
use Livewire\Component;
use GuzzleHttp\Client;
use Livewire\WithPagination;

class CpxJumper extends Component
{

    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public  $user,$jumper_complete = [],$jumper_detect = 0, $link;

    protected $listeners = ['render' => 'render'];

    protected $rules = [
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

            http://146.190.74.228/cpx_jumper_freecash/1/


                $resultado = $client->post('http://146.190.74.228/cpx_jumper_freecash//1/', [
                    'headers' => ['Content-Type' => 'application/json'],
                    'body' => json_encode([
                        'link' => $this->link
                    ])
                ]);

     
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
        return view('livewire.jumpers.c-p-x.cpx-jumper');
    }
}
