<?php

namespace App\Http\Livewire\Jumpers\SpectrumSsi;

use Livewire\Component;

use App\Models\Links_usados;
use App\Models\User;
use DateTime;
use GuzzleHttp\Client;
use Livewire\WithPagination;

class SpectrumIndex extends Component
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

         $busqueda_id= strpos($this->link, '**');

            if(session('psid')) $psid_buscar = substr($this->link,($busqueda_id - 22),11).substr(session('psid'),11,11);
            else $psid_buscar = substr($this->link,($busqueda_id - 22),22); 

              $busqueda_e= strpos($this->link, 'respondent_id=');

        
                $posicion_e = $busqueda_e + 14;
                $i_e = 0;
                $busq_e = 0;

                do{
                    $detect_e= substr($this->link, $posicion_e,1);
            
                    if($detect_e == '&') $i_e = 1;
                    else{
                        $posicion_e = $posicion_e + 1;
                        $busq_e ++;
                    }

                    if($busq_e > 300){
                        $i_e = 2;
                    }
            
                }while($i_e == 0 );

                if($i_e == 1) $e = substr($this->link,($busqueda_e + 14),($posicion_e - ($busqueda_e + 14)));
                else $e = substr($this->link,($posicion_e ));


        
        try {


                $client = new Client([
                    'base_uri' => 'http://67.205.168.133/',
                ]);

                 $resultado = $client->request('GET', 'spectrum_ssi/1/'.$psid_buscar.'/'.$e);

     
            if($resultado->getStatusCode() == 200){

                $date = new DateTime();

                $date_actual= $date->format('Y-m-d H:i:s');
                $date_actual_30 = $date->modify('-30 minute')->format('Y-m-d H:i:s');

                $links_usados = Links_usados::where('k_detected','k-spectrum')
                    ->where('user_id',$this->user->id)
                    ->whereBetween('created_at',[$date_actual_30,$date_actual])
                    ->count();

                if($links_usados <= 8){
                    $this->jumper_complete = json_decode($resultado->getBody(),true);

                    $link_register = new Links_usados();
                    $link_register->link = $this->link;
                    $link_register->k_detected  = 'k-spectrum';
                    $link_register->user_id  = $this->user->id;
                    $link_register->link_resultado = $this->jumper_complete['jumper'];
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
        return view('livewire.jumpers.spectrum-ssi.spectrum-index');
    }
}
