<?php

namespace App\Http\Livewire\Jumpers;

use Livewire\Component;

use GuzzleHttp\Client;

class Wix extends Component
{

    public $jumper_complete , $search, $psid_register=0,$pid_new=0,$type, $jumper_detect = 0,$busqueda_link;

    protected $listeners = ['render' => 'render', 'registro_psid' => 'registro_psid'];

    public function render()
    {
        $this->jumper_complete = 0;
        $link_complete = 0;
        $this->jumper_detect = 0;

        $this->search = trim($this->search); //quitando espacios en blancos al inicio y final
        $long_psid = strlen($this->search); //buscando cuantos caracteres tiene en total

        if($long_psid>80){

            $busqueda_ast_ = strpos($this->search, '**');
            
                if($busqueda_ast_ !== false){
                    $busqueda_id= strpos($this->search, '**');
                                    
                    $psid_buscar = substr($this->search,($busqueda_id - 22),22);

                    $busqueda_pid= strpos($this->search, '&PID=');
                    $busqueda_pid_2= strpos($this->search, '&pid=');

                    if($busqueda_pid !== false || $this->pid_new != 0 || $busqueda_pid_2 !== false ){


                        if($busqueda_pid !== false || $busqueda_pid_2 !== false){
                            if($busqueda_pid !== false)
                                $pid_detect_com= strpos($this->search, '&PID=');
                                
                            if($busqueda_pid_2 !== false)
                                $pid_detect_com= strpos($this->search, '&pid=');

                            $posicion_pid = $pid_detect_com + 5;
                            $i = 0;
                            
                            do{
                                $detect= substr($this->search, $posicion_pid,1);
        
                                if($detect == '&') $i = 1;
                                else{
                                    $i = 0;
                                    $posicion_pid = $posicion_pid + 1;
                                }
        
                            }while($i != 1);

                            if(is_numeric(substr($this->search,($pid_detect_com + 5),($posicion_pid - ($pid_detect_com + 5)))))
                                $pid_buscar = substr($this->search,($pid_detect_com + 5),($posicion_pid - ($pid_detect_com + 5)));
                            else{
                                $this->jumper_detect = 3;
                            }
                                
                        }
                        else{
                            $pid_buscar = session('pid');
                        }

                        $busqueda_ord= strpos($this->search, '&ORD=');

                        if($busqueda_ord != false){

                            $posicion_ord = $busqueda_ord + 5;
                            $i_ord = 0;
                            
                            do{
                                $detect_ord= substr($this->search, $posicion_ord,1);
        
                                if($detect_ord == '') $i_ord = 1;
                                else{
                                    $posicion_ord = $posicion_ord + 1;
                                }
        
                            }while($i_ord != 1);

                            $ord_buscar = substr($this->search,($busqueda_ord + 5),($posicion_ord - ($busqueda_ord + 5)));
                        }

                        else{
                            $this->jumper_detect = 3;
                        }


                        if($this->jumper_detect == 0){

                            $client = new Client([
                                //'base_uri' => 'http://127.0.0.1:8000',
                                'base_uri' => 'http://146.190.74.228/',
                            ]);
        
                            $resultado = $client->request('GET', '/w/wix/'.$psid_buscar.'/'.$pid_buscar.'/'.$ord_buscar);
        
                            if($resultado->getStatusCode() == 200){
                              
                                $this->jumper_detect = 1;

                                $this->emit('alert','Saltador wix procesado con éxito');
                            }

                            else{
                                $this->jumper_detect = 3;
                            }

                            session()->forget('search');

                        }
    
                        else{
                            $this->jumper_detect = 2;
                        }
              
                    }
                }
                else{
                    $busqueda_psid_ = strpos($this->search, 'psid');
            
                    if($busqueda_psid_ !== false){
                        $busqueda_psid= strpos($this->search, 'psid'); 
                        $psid_buscar = substr($this->search,($busqueda_psid + 5),22);
    
                        $busqueda_pid= strpos($this->search, '&PID=');
                        $busqueda_pid_2= strpos($this->search, '&pid=');
    
                        if($busqueda_pid !== false || $this->pid_new != 0 || $busqueda_pid_2 !== false){
    
                            if($busqueda_pid !== false || $busqueda_pid_2 !== false){
                                if($busqueda_pid !== false)
                                    $pid_detect_com= strpos($this->search, '&PID=');
                                if($busqueda_pid_2 !== false)
                                    $pid_detect_com= strpos($this->search, '&pid=');

                                $posicion_pid = $pid_detect_com + 5;
                                $i = 0;
                                    
                                do{
                                    $detect= substr($this->search, $posicion_pid,1);
                
                                    if($detect == '&') $i = 1;
                                    else{
                                        $i = 0;
                                        $posicion_pid = $posicion_pid + 1;
                                    }
                
                                }while($i != 1);
            
                                $pid_buscar = substr($this->search,($pid_detect_com + 5),($posicion_pid - ($pid_detect_com + 5)));
                            }
                            else{
                                 $pid_buscar = session('pid');
                            }

                            $busqueda_ord= strpos($this->search, '&ORD=');

                            if($busqueda_ord != false){

                                $posicion_ord = $busqueda_ord + 5;
                                $i_ord = 0;
                                
                                do{
                                    $detect_ord= substr($this->search, $posicion_ord,1);
            
                                    if($detect_ord == '') $i_ord = 1;
                                    else{
                                        $posicion_ord = $posicion_ord + 1;
                                    }
            
                                }while($i_ord != 1);

                                $ord_buscar = substr($this->search,($busqueda_ord + 5),($posicion_ord - ($busqueda_ord + 5)));

                            }

                            else{
                                $this->jumper_detect = 3;
                            }
    
                                
                            if($this->jumper_detect == 0){

                                $client = new Client([
                                   // 'base_uri' => 'http://127.0.0.1:8000',
                                   'base_uri' => 'http://146.190.74.228/',
                                ]);
            
                                $resultado = $client->request('GET', '/w/wix/'.$psid_buscar.'/'.$pid_buscar.'/'.$ord_buscar);
            
                                if($resultado->getStatusCode() == 200){
                                  
                                    $this->jumper_detect = 1;
    
                                    $this->emit('alert','Saltador wix procesado con éxito');
                                }
    
                                else{
                                    $this->jumper_detect = 3;
                                }
    
                            }
        
                            else{
                                $this->jumper_detect = 2;
                            }
                        }
                        else{
                            $this->jumper_detect = 3;
                        }
                    }

                    else{
                        $this->jumper_detect = 3;
                    }

                    session()->forget('search');
                }

           
           
        }

        return view('livewire.jumpers.wix');
    }

    public function clear(){
        $this->reset(['search']);
    }
}
