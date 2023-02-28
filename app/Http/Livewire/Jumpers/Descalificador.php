<?php

namespace App\Http\Livewire\Jumpers;

use Livewire\Component;
use GuzzleHttp\Client;

class Descalificador extends Component
{

    public $search,$type;

    protected $listeners = ['render' => 'render'];

    public $isopen = false;

    protected $rules = [
        'type' => 'required',
    ];

    public function mount($search){
        $this->search = $search;
    }

    public function open()
    {
        $this->isopen = true;  
    }
    public function close()
    {
        $this->isopen = false;  
    }

    public function save(){
      
       
        $long_psid = strlen($this->search); //buscando cuantos caracteres tiene en total

        if($long_psid>=32){
            $this->close();

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
                }
                else{
                    $this->emit('error','Algo en su link no esta bien. Copielo correctamente');  
                }
            }

           // $this->emit('alert','Espere mientras se procesa su solicitud...');
            

            $client = new Client([
                // 'base_uri' => 'http://127.0.0.1:8000',
                'base_uri' => 'http://146.190.74.228/',
            ]);

        
            
            if($this->type == 'usa')
                $resultado = $client->request('GET', '/Descalificador_usa/1/'.$psid_detect);
            else
                $resultado = $client->request('GET', '/Descalificador_Uk/1/'.$psid_detect);

            if($resultado->getStatusCode() == 200){
                $this->emit('alert','Descalificación exitosa');
            }

            else{
                $this->emit('error','Ha ocurrido un error, intentelo de nuevo');
            }

        }

        else{
            $this->emit('error','Algo en su link no esta bien. Copielo correctamente');
        }

        $this->reset(['type']);
    }

    public function render()
    {

        return view('livewire.jumpers.descalificador');
    }

}
