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

        if($long_psid>5){

            $busqueda_ast_ = strpos($this->search, '**');
            
                if($busqueda_ast_ !== false){
                    $busqueda_id= strpos($this->search, '**');
                                    
                    $psid_buscar = substr($this->search,($busqueda_id - 22),22);

                    $busqueda_pid= strpos($this->search, '&PID=');
                    $busqueda_pid2= strpos($this->search, '&pid=');
                    $busqueda_pid3= strpos($this->search, '?ID=');
                    $busqueda_pid4= strpos($this->search, '?id=');
                    $busqueda_pid5= strpos($this->search, '&ID=');
                    $busqueda_pid6= strpos($this->search, '&id=');

                    if($this->pid_new != 0 ||  $busqueda_pid !== false || $busqueda_pid2 !== false || $busqueda_pid3 !== false || $busqueda_pid4 !== false || $busqueda_pid5 !== false || $busqueda_pid6 !== false){


                        if($busqueda_pid !== false || $busqueda_pid2 !== false || $busqueda_pid3 !== false || $busqueda_pid4 !== false || $busqueda_pid5 !== false || $busqueda_pid6 !== false){
                            if($busqueda_pid !== false){
                                $pid_detect_com= strpos($this->search, '&PID=');
                                $posicion_pid = $pid_detect_com + 5;
                                $pid_calculate = $pid_detect_com + 5;
                            }
                            elseif($busqueda_pid2 !== false){ 
                                $pid_detect_com= strpos($this->search, '&pid=');
                                $posicion_pid = $pid_detect_com + 5;
                                $pid_calculate = $pid_detect_com + 5;
                            }
                            elseif($busqueda_pid3 !== false){
                                $pid_detect_com= strpos($this->search, '?ID=');
                                $posicion_pid = $pid_detect_com + 4;
                                $pid_calculate = $pid_detect_com + 4;
                            }
                            elseif($busqueda_pid4 !== false){
                                $pid_detect_com= strpos($this->search, '?id=');
                                $posicion_pid = $pid_detect_com + 4;
                                $pid_calculate = $pid_detect_com + 4;
                            }
                            elseif($busqueda_pid5 !== false){
                                $pid_detect_com= strpos($this->search, '&ID=');
                                $posicion_pid = $pid_detect_com + 4;
                                $pid_calculate = $pid_detect_com + 4;
                            }
                            else{
                                $pid_detect_com= strpos($this->search, '&id=');
                                $posicion_pid = $pid_detect_com + 4;
                                $pid_calculate = $pid_detect_com + 4;
                            }

                            $i = 0;
                            $busq_pid_s = 0;
                            
                            do{
                                $detect= substr($this->search, $posicion_pid,1);
        
                                if($detect == '&') $i = 1;
                                else{
                                    $i = 0;
                                    $posicion_pid = $posicion_pid + 1;
                                    $busq_pid_s ++;
                                }

                                if($busq_pid_s > 13){
                                    $i = 1;
                                }
        
                            }while($i != 1);

                            if($busq_pid_s < 13){
                                if(is_numeric(substr($this->search,($pid_calculate),($posicion_pid - ($pid_calculate)))))
                                    $pid_buscar = substr($this->search,($pid_calculate),($posicion_pid - ($pid_calculate)));
                                else $this->jumper_detect = 3;
                                
                            }
                            else{
                                if(is_numeric(substr($this->search,($pid_calculate),11)))
                                    $pid_buscar = substr($this->search,($pid_calculate),11);
                                else $this->jumper_detect = 3;
                            }
                                
                        }
                        else{
                            $pid_buscar = session('pid');
                        }

                        $busqueda_ord= strpos($this->search, '=ORD');


                        if($busqueda_ord != false){

                            $posicion_ord = $busqueda_ord + 1;
                            $i_ord = 0;
                            $busq_ord_s = 0;
                            
                            do{
                                $detect_ord= substr($this->search, $posicion_ord,1);
        
                                if($detect_ord == '&' || $detect_ord == '\\') $i_ord = 1;
                                else{
                                    $posicion_ord = $posicion_ord + 1;
                                    $busq_ord_s ++;
                                }

                                if($busq_ord_s > 20){
                                    $i_ord = 1;
                                }
        
                            }while($i_ord != 1);

                            if($busq_ord_s < 20)
                                $ord_buscar = substr($this->search,($busqueda_ord + 1),($posicion_ord - ($busqueda_ord + 1)));

                            else
                                $ord_buscar = substr($this->search,($busqueda_ord + 1),20);
                       
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

                                $this->jumper_complete = json_decode($resultado->getBody(),true);

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
                        $busqueda_pid2= strpos($this->search, '&pid=');
                        $busqueda_pid3= strpos($this->search, '?ID=');
                        $busqueda_pid4= strpos($this->search, '?id=');
                        $busqueda_pid5= strpos($this->search, '&ID=');
                        $busqueda_pid6= strpos($this->search, '&id=');
    
                        if($this->pid_new != 0 ||  $busqueda_pid !== false || $busqueda_pid2 !== false || $busqueda_pid3 !== false || $busqueda_pid4 !== false || $busqueda_pid5 !== false || $busqueda_pid6 !== false){
    
                            if($busqueda_pid !== false || $busqueda_pid2 !== false || $busqueda_pid3 !== false || $busqueda_pid4 !== false || $busqueda_pid5 !== false || $busqueda_pid6 !== false){
                                if($busqueda_pid !== false){
                                    $pid_detect_com= strpos($this->search, '&PID=');
                                    $posicion_pid = $pid_detect_com + 5;
                                    $pid_calculate = $pid_detect_com + 5;
                                }
                                elseif($busqueda_pid2 !== false){ 
                                    $pid_detect_com= strpos($this->search, '&pid=');
                                    $posicion_pid = $pid_detect_com + 5;
                                    $pid_calculate = $pid_detect_com + 5;
                                }
                                elseif($busqueda_pid3 !== false){
                                    $pid_detect_com= strpos($this->search, '?ID=');
                                    $posicion_pid = $pid_detect_com + 4;
                                    $pid_calculate = $pid_detect_com + 4;
                                }
                                elseif($busqueda_pid4 !== false){
                                    $pid_detect_com= strpos($this->search, '?id=');
                                    $posicion_pid = $pid_detect_com + 4;
                                    $pid_calculate = $pid_detect_com + 4;
                                }
                                elseif($busqueda_pid5 !== false){
                                    $pid_detect_com= strpos($this->search, '&ID=');
                                    $posicion_pid = $pid_detect_com + 4;
                                    $pid_calculate = $pid_detect_com + 4;
                                }
                                else{
                                    $pid_detect_com= strpos($this->search, '&id=');
                                    $posicion_pid = $pid_detect_com + 4;
                                    $pid_calculate = $pid_detect_com + 4;
                                }
                                
                                $i = 0;
                                $busq_pid_s = 0;
                                
                                do{
                                    $detect= substr($this->search, $posicion_pid,1);
            
                                    if($detect == '&') $i = 1;
                                    else{
                                        $i = 0;
                                        $posicion_pid = $posicion_pid + 1;
                                        $busq_pid_s ++;
                                    }
    
                                    if($busq_pid_s > 13){
                                        $i = 1;
                                    }
            
                                }while($i != 1);
    
                                if($busq_pid_s < 13){
                                    if(is_numeric(substr($this->search,($pid_calculate),($posicion_pid - ($pid_calculate)))))
                                        $pid_buscar = substr($this->search,($pid_calculate),($posicion_pid - ($pid_calculate)));
                                    else $this->jumper_detect = 3;
                                    
                                }
                                else{
                                    if(is_numeric(substr($this->search,($pid_calculate),11)))
                                        $pid_buscar = substr($this->search,($pid_calculate),11);
                                    else $this->jumper_detect = 3;
                                }
                            }
                            else{
                                $pid_buscar = session('pid');
                            }
    
                            
    
                            $busqueda_ord= strpos($this->search, '=ORD');
    
    
                            if($busqueda_ord != false){
    
                                $posicion_ord = $busqueda_ord + 1;
                                $i_ord = 0;
                                $busq_ord_s = 0;
                                
                                do{
                                    $detect_ord= substr($this->search, $posicion_ord,1);
            
                                    if($detect_ord == '&' || $detect_ord == '\\') $i_ord = 1;
                                    else{
                                        $posicion_ord = $posicion_ord + 1;
                                        $busq_ord_s ++;
                                    }

                                    if($busq_ord_s > 20){
                                        $i_ord = 1;
                                    }
            
                                }while($i_ord != 1);

                                if($busq_ord_s < 20)
                                    $ord_buscar = substr($this->search,($busqueda_ord + 1),($posicion_ord - ($busqueda_ord + 1)));

                                else
                                    $ord_buscar = substr($this->search,($busqueda_ord + 1),20);

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

                                    $this->jumper_complete = json_decode($resultado->getBody(),true);
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
