<?php

namespace App\Http\Livewire\Jumpers;

use Livewire\Component;
use GuzzleHttp\Client;

class Descalificador extends Component
{

    public $jumper_complete , $search, $psid_register=0,$pid_new=0,$type, $jumper_detect = 0;

    protected $listeners = ['render' => 'render', 'registro_psid' => 'registro_psid'];


    public function render()
    {

        $this->jumper_complete = 0;
        $link_complete = 0;
        $this->jumper_detect = 0;

        $this->search = trim($this->search); //quitando espacios en blancos al inicio y final
        $long_psid = strlen($this->search); //buscando cuantos caracteres tiene en total

        if($long_psid>=32){

            if($long_psid==32){
                $psid_detect = $this->search;
            }

            else{
                $busqueda_psid = strpos($this->search, 'psid=');
        
                if($busqueda_psid !== false){
                    $i = 0;
                    $i_bus = 0;
                    $posicion = $busqueda_psid + 5;
                            
                    do{
                        $detect= substr($this->search, $posicion,1);
        
                        if($detect == '&') $i = 1;
                        else{
                            $i = 0;
                            $i_bus ++;
                            $posicion = $posicion + 1;
                        }

                        if($i_bus > 35){
                            $i= 1;
                        }
        
                    }while($i != 1);

                    if($i_bus < 35){
                        $psid_detect = substr($this->search,$busqueda_psid+5,($posicion-($busqueda_psid+5)));
                    }
                    else{
                        $psid_detect = substr($this->search,$busqueda_psid+5,32);
                    }

            
                    $client = new Client([
                        'base_uri' => 'http://127.0.0.1:8000',
                    ]);
            
                    if($this->type == 'usa')
                        $resultado = $client->request('GET', '/Descalificador_usa/1/'.$psid_detect);
                    else
                        $resultado = $client->request('GET', '/Descalificador_Uk/1/'.$psid_detect);

                    if($resultado->getStatusCode() == 200){
                        $this->jumper_detect = 1;

                        $this->emit('alert','Descalificación exitosa');
                    }

                    else{
                        $this->jumper_detect = 3;

                        $this->emit('error','Ha ocurrido un error, intentelo de nuevo');
                    }

                }

                else{
                   
                    $this->jumper_detect = 2;

                    $this->emit('error','Algo en su link no esta bien. Copielo correctamente');
                    
                }

            }
           
        }

        return view('livewire.jumpers.descalificador');
    }

    public function clear(){
        $this->reset(['search']);
    }
}
