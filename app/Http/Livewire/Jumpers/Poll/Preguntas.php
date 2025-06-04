<?php

namespace App\Http\Livewire\Jumpers\Poll;

use App\Models\User;
use Livewire\Component;
use GuzzleHttp\Client;
use Livewire\WithPagination;

class Preguntas extends Component
{
       use WithPagination;
    protected $paginationTheme = "bootstrap";

    public  $user,$jumper_complete = [],$jumper_detect = 0, $search, $edad;

    protected $listeners = ['render' => 'render'];

    protected $rules = [
        'search' => 'required',
        'edad' => 'required',
    ];
    
    public function mount(){


        if(session('search')) $this->search = session('search');
        $this->jumper_detect = 0;

        $this->user = User::where('id',auth()->user()->id)->first();
    }

    public function clear(){
        $this->reset(['search','edad']);
       // $this->informacion_complete = [];
        $this->jumper_complete = [];
        //$this->emitTo('jumpers.encuestar.encuestar1-index','render');
    }

    public function procesar(){

        $rules = $this->rules;
        $this->validate($rules);

         try {

            $client = new Client([
                //'base_uri' => 'http://127.0.0.1:8000',
                'base_uri' => 'http://67.205.168.133/',
            ]);

            $busqueda_surv= strpos($this->search, '/surveyRedirect/');

            if($busqueda_surv != false){
                $posicion_elem1 = $busqueda_surv + 16;
                $i_elem1 = 0;
                $busq_elem1 = 0;

                do{
                    $detect_elem1= substr($this->search, $posicion_elem1,1);
            
                    if($detect_elem1 == '?') $i_elem1 = 1;
                    else{
                        $posicion_elem1 = $posicion_elem1 + 1;
                        $busq_elem1 ++;
                    }

                    if($busq_elem1 > 300){
                        $i_elem1 = 2;
                    }
            
                }while($i_elem1 == 0 );

                if($i_elem1 == 1) $surv = substr($this->search,($busqueda_surv + 16),($posicion_elem1 - ($busqueda_surv + 16)));
                else $surv = substr($this->search,($posicion_elem1 ));

            }

       
     
         $resultado = $client->request('GET', 'Pollstatic_screen_questions/1/'.$surv.'/'.$this->edad);


            if($resultado->getStatusCode() == 200){

                $this->jumper_complete = json_decode($resultado->getBody(),true);

         
                
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
        return view('livewire.jumpers.poll.preguntas');
    }
}
