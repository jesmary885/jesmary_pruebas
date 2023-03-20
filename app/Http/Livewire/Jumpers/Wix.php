<?php

namespace App\Http\Livewire\Jumpers;

use Livewire\Component;

use GuzzleHttp\Client;

class Wix extends Component
{

    public $jumper_complete , $search, $psid_register=0,$pid_new=0,$type, $jumper_detect = 0,$busqueda_link,$pid_manual,$pid_detectado = 'si',$pid_buscar,$psid_buscar,$ord_buscar;

    protected $listeners = ['render' => 'render', 'registro_psid' => 'registro_psid'];

    protected $rules_pid = [
        'pid_manual' => 'required|min:8',
    ];

    public function jumpear(){
        $rules_pid = $this->rules_pid;
        $this->validate($rules_pid);

        $this->pid_buscar = $this->pid_manual;

        $client = new Client([
            //'base_uri' => 'http://127.0.0.1:8000',
            'base_uri' => 'http://67.205.168.133/',
        ]);

        $resultado = $client->request('GET', '/w/wix/'.$this->psid_buscar.'/'.$this->pid_buscar.'/'.$this->ord_buscar);

        if($resultado->getStatusCode() == 200){

            $this->jumper_complete = json_decode($resultado->getBody(),true);

        }

        else{
            $this->jumper_detect = 3;
        }
    }

    public function render()
    {
        //$this->jumper_complete = 0;
        $link_complete = 0;
        $this->jumper_detect = 0;

        $this->search = trim($this->search); //quitando espacios en blancos al inicio y final
        $long_psid = strlen($this->search); //buscando cuantos caracteres tiene en total

        if($long_psid>5){

            $busqueda_ast_ = strpos($this->search, '**');
            
                if($busqueda_ast_ !== false){
                    $busqueda_id= strpos($this->search, '**');
                                    
                    $this->psid_buscar = substr($this->search,($busqueda_id - 22),22);

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
                                $this->ord_buscar = substr($this->search,($busqueda_ord + 1),($posicion_ord - ($busqueda_ord + 1)));

                            else
                                $this->ord_buscar = substr($this->search,($busqueda_ord + 1),20);
                       
                        }

                    else{
                   
                        $this->jumper_detect = 3;
                    }


                    if(session('pid')){
                            $this->pid_buscar = session('pid');
                    }
    
                    else{
                            $cont_pid = 0;
                            $busqueda_pid= strpos($this->search, '&PID=');
                            $busqueda_pid2= strpos($this->search, '&pid=');
                            $busqueda_pid3= strpos($this->search, '?ID=');
                            $busqueda_pid4= strpos($this->search, '?id=');
                            $busqueda_pid5= strpos($this->search, '&ID=');
                            $busqueda_pid6= strpos($this->search, '&id=');
                            $busqueda_pid7= strpos($this->search, '&Broker=');
                            $busqueda_pid8= strpos($this->search, '?PID=');
                            $busqueda_pid9= strpos($this->search, '?pid=');
                            $busqueda_pid10= strpos($this->search, 'fill?1=');
    
                            if($busqueda_pid !== false || $busqueda_pid2 !== false || $busqueda_pid3 !== false || $busqueda_pid4 !== false || $busqueda_pid5 !== false || $busqueda_pid6 !== false || $busqueda_pid7 !== false || $busqueda_pid8 !== false || $busqueda_pid9 !== false || $busqueda_pid10 !== false){
                        
                                if($busqueda_pid !== false){
                        
                                    $pid_detect_com= strpos($this->search, '&PID=');
                                    $posicion_pid = $pid_detect_com + 5;
                                    $pid_calculate = $pid_detect_com + 5;
                                    $cont_pid++;
                                }
                                if($busqueda_pid2 !== false){ 
                                    
                                    $pid_detect_com= strpos($this->search, '&pid=');
                                    $posicion_pid = $pid_detect_com + 5;
                                    $pid_calculate = $pid_detect_com + 5;
                                    $cont_pid++;
                                }
                                if($busqueda_pid3 !== false){
                                    $pid_detect_com= strpos($this->search, '?ID=');
                                    $posicion_pid = $pid_detect_com + 4;
                                    $pid_calculate = $pid_detect_com + 4;
                                    $cont_pid++;
                                }
                                if($busqueda_pid4 !== false){
                                    $pid_detect_com= strpos($this->search, '?id=');
                                    $posicion_pid = $pid_detect_com + 4;
                                    $pid_calculate = $pid_detect_com + 4;
                                    $cont_pid++;
                                }
                                if($busqueda_pid5 !== false){
                                    $pid_detect_com= strpos($this->search, '&ID=');
                                    $posicion_pid = $pid_detect_com + 4;
                                    $pid_calculate = $pid_detect_com + 4;
                                    $cont_pid++;
                                }
                                if($busqueda_pid7 !== false){
                                    $pid_detect_com= strpos($this->search, '&Broker=');
                                    $posicion_pid = $pid_detect_com + 8;
                                    $pid_calculate = $pid_detect_com + 8;
                                    $cont_pid++;
                                }
                                if($busqueda_pid6 !== false){
                                    $pid_detect_com= strpos($this->search, '&id=');
                                    $posicion_pid = $pid_detect_com + 4;
                                    $pid_calculate = $pid_detect_com + 4;
                                    $cont_pid++;
                                }
                                if($busqueda_pid8 !== false){
                                    $pid_detect_com= strpos($this->search, '?PID=');
                                    $posicion_pid = $pid_detect_com + 5;
                                    $pid_calculate = $pid_detect_com + 5;
                                    $cont_pid++;
                                }
                                if($busqueda_pid9 !== false){
                                    $pid_detect_com= strpos($this->search, '?pid=');
                                    $posicion_pid = $pid_detect_com + 5;
                                    $pid_calculate = $pid_detect_com + 5;
                                    $cont_pid++;
                                }
                                if($busqueda_pid10 !== false){
                                    $pid_detect_com= strpos($this->search, 'fill?1=');
                                    $posicion_pid = $pid_detect_com + 7;
                                    $pid_calculate = $pid_detect_com + 7;
                                    $cont_pid++;
                                }
    
    
                                if($cont_pid == 1){
    
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
                                            $this->pid_buscar = substr($this->search,($pid_calculate),($posicion_pid - ($pid_calculate)));
                                        else $this->jumper_detect = 3;
                                        
                                    }
                                    else{
                                        if(is_numeric(substr($this->search,($pid_calculate),11)))
                                            $this->pid_buscar = substr($this->search,($pid_calculate),11);
                                        else $this->jumper_detect = 3;
                                    }
    
                                }
    
                                else{
                                    $this->pid_detectado = 'no';
                                }
                  
                            }
                            else{
                                $this->pid_detectado = 'no';
                                
                            }

                    }

                    if($this->jumper_detect == 0 && $this->pid_detectado == 'si'){

                        $client = new Client([
                            //'base_uri' => 'http://127.0.0.1:8000',
                            'base_uri' => 'http://67.205.168.133/',
                        ]);
    
                        $resultado = $client->request('GET', '/w/wix/'.$this->psid_buscar.'/'.$this->pid_buscar.'/'.$this->ord_buscar);
    
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
                        if($this->pid_detectado == 'si' && $this->jumper_detect != 0){
                            $this->jumper_detect = 2;
                        }
                    }
                }
                else{
                    $busqueda_psid_ = strpos($this->search, 'psid');
            
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
                                $this->ord_buscar = substr($this->search,($busqueda_ord + 1),($posicion_ord - ($busqueda_ord + 1)));

                            else
                                $this->ord_buscar = substr($this->search,($busqueda_ord + 1),20);
                       
                        }

                    else{
                   
                        $this->jumper_detect = 3;
                    }


                    if(session('pid')){
                            $this->pid_buscar = session('pid');
                    }
    
                    else{
                            $cont_pid = 0;
                            $busqueda_pid= strpos($this->search, '&PID=');
                            $busqueda_pid2= strpos($this->search, '&pid=');
                            $busqueda_pid3= strpos($this->search, '?ID=');
                            $busqueda_pid4= strpos($this->search, '?id=');
                            $busqueda_pid5= strpos($this->search, '&ID=');
                            $busqueda_pid6= strpos($this->search, '&id=');
                            $busqueda_pid7= strpos($this->search, '&Broker=');
                            $busqueda_pid8= strpos($this->search, '?PID=');
                            $busqueda_pid9= strpos($this->search, '?pid=');
                            $busqueda_pid10= strpos($this->search, 'fill?1=');
    
                            if($busqueda_pid !== false || $busqueda_pid2 !== false || $busqueda_pid3 !== false || $busqueda_pid4 !== false || $busqueda_pid5 !== false || $busqueda_pid6 !== false || $busqueda_pid7 !== false || $busqueda_pid8 !== false || $busqueda_pid9 !== false || $busqueda_pid10 !== false){
                        
                                if($busqueda_pid !== false){
                        
                                    $pid_detect_com= strpos($this->search, '&PID=');
                                    $posicion_pid = $pid_detect_com + 5;
                                    $pid_calculate = $pid_detect_com + 5;
                                    $cont_pid++;
                                }
                                if($busqueda_pid2 !== false){ 
                                    
                                    $pid_detect_com= strpos($this->search, '&pid=');
                                    $posicion_pid = $pid_detect_com + 5;
                                    $pid_calculate = $pid_detect_com + 5;
                                    $cont_pid++;
                                }
                                if($busqueda_pid3 !== false){
                                    $pid_detect_com= strpos($this->search, '?ID=');
                                    $posicion_pid = $pid_detect_com + 4;
                                    $pid_calculate = $pid_detect_com + 4;
                                    $cont_pid++;
                                }
                                if($busqueda_pid4 !== false){
                                    $pid_detect_com= strpos($this->search, '?id=');
                                    $posicion_pid = $pid_detect_com + 4;
                                    $pid_calculate = $pid_detect_com + 4;
                                    $cont_pid++;
                                }
                                if($busqueda_pid5 !== false){
                                    $pid_detect_com= strpos($this->search, '&ID=');
                                    $posicion_pid = $pid_detect_com + 4;
                                    $pid_calculate = $pid_detect_com + 4;
                                    $cont_pid++;
                                }
                                if($busqueda_pid7 !== false){
                                    $pid_detect_com= strpos($this->search, '&Broker=');
                                    $posicion_pid = $pid_detect_com + 8;
                                    $pid_calculate = $pid_detect_com + 8;
                                    $cont_pid++;
                                }
                                if($busqueda_pid6 !== false){
                                    $pid_detect_com= strpos($this->search, '&id=');
                                    $posicion_pid = $pid_detect_com + 4;
                                    $pid_calculate = $pid_detect_com + 4;
                                    $cont_pid++;
                                }
                                if($busqueda_pid8 !== false){
                                    $pid_detect_com= strpos($this->search, '?PID=');
                                    $posicion_pid = $pid_detect_com + 5;
                                    $pid_calculate = $pid_detect_com + 5;
                                    $cont_pid++;
                                }
                                if($busqueda_pid9 !== false){
                                    $pid_detect_com= strpos($this->search, '?pid=');
                                    $posicion_pid = $pid_detect_com + 5;
                                    $pid_calculate = $pid_detect_com + 5;
                                    $cont_pid++;
                                }
                                if($busqueda_pid10 !== false){
                                    $pid_detect_com= strpos($this->search, 'fill?1=');
                                    $posicion_pid = $pid_detect_com + 7;
                                    $pid_calculate = $pid_detect_com + 7;
                                    $cont_pid++;
                                }
    
    
                                if($cont_pid == 1){
    
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
                                            $this->pid_buscar = substr($this->search,($pid_calculate),($posicion_pid - ($pid_calculate)));
                                        else $this->jumper_detect = 3;
                                        
                                    }
                                    else{
                                        if(is_numeric(substr($this->search,($pid_calculate),11)))
                                            $this->pid_buscar = substr($this->search,($pid_calculate),11);
                                        else $this->jumper_detect = 3;
                                    }
    
                                }
    
                                else{
                                    $this->pid_detectado = 'no';
                                }
                  
                            }
                            else{
                                $this->pid_detectado = 'no';
                                
                            }
                    }

                    if($this->jumper_detect == 0 && $this->pid_detectado == 'si'){

                        $client = new Client([
                            //'base_uri' => 'http://127.0.0.1:8000',
                            'base_uri' => 'http://67.205.168.133/',
                        ]);
    
                        $resultado = $client->request('GET', '/w/wix/'.$this->psid_buscar.'/'.$this->pid_buscar.'/'.$this->ord_buscar);
    
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
                        if($this->pid_detectado == 'si' && $this->jumper_detect != 0){
                            $this->jumper_detect = 2;
                        }
                    }

                    session()->forget('search');
                }
        }

        return view('livewire.jumpers.wix');
    }

    public function clear(){
        $this->reset(['search']);
        $this->jumper_complete = [];
        session()->forget('search');
        $this->busqueda_link = "";
        return redirect()->route('wix.index');
    }
}
