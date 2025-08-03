<?php

namespace App\Http\Livewire\Jumpers\SurveyJunkey;

use App\Models\Links_usados;
use App\Models\User;
use DateTime;
use Livewire\Component;
use GuzzleHttp\Client;
use Livewire\WithPagination;

class Spectrum extends Component
{

    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public  $user,$jumper_complete = [],$jumper_detect = 0, $app_id, $link, $survery_id;

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

        

            $busqueda_trans= strpos($this->link, 'ps_supplier_sid=');

                if($busqueda_trans != false){
                    $posicion_elem1 = $busqueda_trans + 16;
                    $i_elem1 = 0;
                    $busq_elem1 = 0;
                    
                    do{
                        $detect_elem1= substr($this->link, $posicion_elem1,1);

                        if($detect_elem1 == '&') $i_elem1 = 1;
                        else{
                            $posicion_elem1 = $posicion_elem1 + 1;
                            $busq_elem1 ++;
                        }

                        if($busq_elem1 > 200){
                            $i_elem1 = 1;
                        }

                    }while($i_elem1 != 1);

                    $sid = substr($this->link,($busqueda_trans + 16),($posicion_elem1 - ($busqueda_trans + 16)));
                }

                    ///////////////////////////////////


                $busqueda_trans2= strpos($this->link, 'ps_supplier_respondent_id=');

                if($busqueda_trans2 != false){         


                    $id = substr($this->link,($busqueda_trans2 + 26));

                }
    

            try {



                $client = new Client(['base_uri' => 'http://67.205.168.133/',]);
        
                $resultado = $client->request('GET', '/spectrum_survey_junkie/1/'.$sid.'/'.$id );

                    

        
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
        return view('livewire.jumpers.survey-junkey.spectrum');
    }
}
