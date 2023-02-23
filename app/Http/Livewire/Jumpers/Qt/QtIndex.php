<?php

namespace App\Http\Livewire\Jumpers\Qt;

use Livewire\Component;

class QtIndex extends Component
{

    public $jumper_complete , $search, $psid_register=0,$pid_new=0;

    protected $listeners = ['render' => 'render', 'registro_psid' => 'registro_psid'];

    
    public function save(){
        $this->emit('copiar_port');
        $this->emit('saved');
    }

    public function render()
    {
        $this->jumper_complete = 0;
        $link_complete = 0;

        $this->search = trim($this->search); //quitando espacios en blancos al inicio y final
        $long_psid = strlen($this->search); //buscando cuantos caracteres tiene en total

        if($long_psid>=30){

            if($long_psid<35){
                $link_complete = $this->search;
                $this->jumper_complete='https://dkr1.ssisurveys.com/projects/pstart?psid='.$link_complete.'&subpanelid=38';
            }
            else{

                //dd(strpos($this->search, 'psid='));

                if((strpos($this->search, 'psid=') !== false)){

                    $detectado= strpos($this->search, 'psid=');
                    
                    $i = 0;
                    $posicion = 5;
                        
                    do{
                        $detect= substr($this->search, $posicion,1);
    
                            if($detect == '&') $i = 1;
                            else{
                                $i = 0;
                                $posicion = $posicion + 1;
                            }
    
                        }while($i != 1);
  
                        $url_complete = substr($this->search,$detectado+5,($posicion-($detectado+5)));

                        $this->jumper_complete='https://dkr1.ssisurveys.com/projects/pstart?psid='.$url_complete.'&subpanelid=38';
                        

                }

            }

        }

        return view('livewire.jumpers.qt.qt-index');
    }

    public function clear(){
        $this->reset(['search']);
    }
}
