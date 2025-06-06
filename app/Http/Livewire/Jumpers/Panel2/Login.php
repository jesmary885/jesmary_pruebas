<?php

namespace App\Http\Livewire\Jumpers\Panel2;

use App\Models\User;
use Livewire\Component;
use GuzzleHttp\Client;
use Livewire\WithPagination;

class Login extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public  $user,$jumper_complete = [],$jumper_detect = 0, $email, $contrasena, $balance;

    protected $listeners = ['render' => 'render'];

    protected $rules = [
        'email' => 'required',
        'contrasena' => 'required',
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
        //$this->emitTo('jumpers.encuestar.encuestar1-index','render');
    }

    public function procesar(){

        $rules = $this->rules;
        $this->validate($rules);

         try {

            http://146.190.74.228/Panel_polls/1/email/password
            $client = new Client([
                //'base_uri' => 'http://127.0.0.1:8000',
                'base_uri' => 'http://147.182.190.233/',
            ]);



     
         $resultado = $client->request('GET', 'Golden_survey/1/'.$this->email.'/'.$this->contrasena);


            if($resultado->getStatusCode() == 200){

                $this->jumper_complete = json_decode($resultado->getBody(),true);

  

                foreach($this->jumper_complete as $registro){

                    $this->balance = $registro['Balance de la cuenta'];
                }

            

         
                
                if(!$this->jumper_complete)  $this->jumper_detect = 2;
               /* else{
                    $busqueda_https= strpos($this->informacion_complete['Survey'], 'ttps://');

                    if($busqueda_https != false) $this->jumper_detect = 10;
                    else $this->jumper_detect = 1;
                }*/
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
        return view('livewire.jumpers.panel2.login');
    }
}
