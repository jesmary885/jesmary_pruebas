<?php

namespace App\Http\Livewire\Jumpers\K23;

use App\Models\Comments;
use App\Models\Link;
use App\Models\User_Links_Points;
use GuzzleHttp\Client;
use Livewire\Component;
use Livewire\WithPagination;

class K23Index extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public  $jumper_complete = [],$jumper_list = 0,$busqueda_link,$comment_new_psid_register,$pid_register_high,$psid_register_bh,$high_register_bh,$basic_register_bh,$posicionpid,$psid_detectado,$posicion_total_k,$posicionk,$no_jumpear,$posicion, $no_detect = '0', $jumper_detect = 0, $k_detect = '0', $wix_detect = '0', $psid_register=0,$jumper_redirect,$link_complete_2,$calculo_high = 0,$pid_new=0,$search,$jumper_2,$points_user,$user_auth,$comentario,$is_high,$is_basic,$calc_link,$jumper_select,$points_user_positive, $points_user_negative, $jumper_detect_k ='',$pid_manual,$pid_detectado = 'si',$pid_buscar,$psid_buscar,$ids_buscar,$k2_buscar ;

    protected $listeners = ['render' => 'render', 'registro_psid' => 'registro_psid'];
    
    public function mount(){
        $this->user_auth =  auth()->user()->id;
        $this->points_user='no';
        if(session('pid')) $this->pid_new = session('pid');
        if(session('psid')) $this->psid_register = session('psid');
        if(session('search')) $this->search = session('search');
    }

    protected $rules_pid = [
        'pid_manual' => 'required|min:8',
    ];

    public function jumpear(){
       
        $rules_pid = $this->rules_pid;
        $this->validate($rules_pid);

        $this->pid_buscar = $this->pid_manual;

        $client = new Client([
            //'base_uri' => 'http://127.0.0.1:8000',
            'base_uri' => 'http://146.190.74.228/',
        ]);

        $resultado = $client->request('GET', '/k23/1/'.$this->ids_buscar.'/'.$this->psid_buscar.'/'.$this->k2_buscar.'/'.$this->pid_buscar);

        if($resultado->getStatusCode() == 200){

            $this->jumper_detect = 0;

            $this->jumper_complete = json_decode($resultado->getBody(),true);
        }

        else{
            $this->jumper_detect = 3;
        }
    }

    public function render()
    {

        $subs_psid = '0';
       
        $comments =0;
        $jumper = "";
        $link_complete="";
        $this->psid_buscar = "";
        $this->pid_buscar = "";
        $busqueda_link_def = "";
     
        $this->no_jumpear = 0;
        $this->jumper_detect = 0;
        $this->points_user='no';
        $this->no_detect = '0';
        $this->k_detect = '0';
        $this->comment_new_psid_register = '';
        $this->posicion = 8; //me esta buscand a partir de https://

        $this->search = trim($this->search); //quitando espacios en blancos al inicio y final
        $long_psid = strlen($this->search); //buscando cuantos caracteres tiene en total

        if($long_psid>=5){

                $busqueda_ast_ = strpos($this->search, '**');
            
                if($busqueda_ast_ !== false){
                    $busqueda_id= strpos($this->search, '**');

                    if(session('psid')) $this->psid_buscar = substr($this->search,($busqueda_id - 22),11).substr(session('psid'),11,11);
                    else $this->psid_buscar = substr($this->search,($busqueda_id - 22),22);

                    $busqueda_ids= strpos($this->search, 'IDS=');

                        if($busqueda_ids != false){

                            $posicion_ids = $busqueda_ids + 4;
                            $i_ids = 0;
                            $busq_ids_s = 0;
                            
                            do{
                                $detect_ids= substr($this->search, $posicion_ids,1);
        
                                if($detect_ids == '&') $i_ids = 1;
                                else{
                                    $posicion_ids = $posicion_ids + 1;
                                    $busq_ids_s ++;
                                }

                                if($busq_ids_s > 20){
                                    $i_ids = 1;
                                }
        
                            }while($i_ids != 1);

                            if($busq_ids_s < 20)
                                $this->ids_buscar = substr($this->search,($busqueda_ids + 4),($posicion_ids - ($busqueda_ids + 4)));

                            else
                                //$this->ids_buscar = substr($this->search,($busqueda_ids + 4),20);
                                $this->jumper_detect = 3;
                        }

                        else{

                            //dd('gg');
                            $this->jumper_detect = 3;
                        }


                        $busqueda_k2= strpos($this->search, '&K2=');


                        if($busqueda_k2 != false){

                            $posicion_k2 = $busqueda_k2 + 4;
                            $i_k2 = 0;
                            $busq_k2_s = 0;
                            
                            do{
                                $detect_k2= substr($this->search, $posicion_k2,1);
        
                                if($detect_k2 == '&') $i_k2 = 1;
                                else{
                                    $posicion_k2 = $posicion_k2 + 1;
                                    $busq_k2_s ++;
                                }

                                if($busq_k2_s > 20){
                                    $i_k2 = 1;
                                }
        
                            }while($i_k2 != 1);



                            if($busq_k2_s < 20)
                                $this->k2_buscar = substr($this->search,($busqueda_k2 + 4),($posicion_k2 - ($busqueda_k2 + 4)));

                            else
                                //$this->ids_buscar = substr($this->search,($busqueda_ids + 4),20);
                                $this->jumper_detect = 3;
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
                                    $this->busqueda_link = Link::where('psid',substr($this->psid_buscar,0,5))->first();
            
                                    $busqueda_link_def =  $this->busqueda_link;
            
                                        if($this->busqueda_link){
                                            $user_point= User_Links_Points::where('link_id',$this->busqueda_link->id)
                                                ->where('user_id',auth()->user()->id)
                                                ->first();
                                                            
                                            $comments = Comments::where('link_id',$this->busqueda_link->id)
                                                ->latest('id')
                                                ->paginate(5);
                                                                
                                                if($user_point) {
                                                    if($user_point->point == 'positive'){
                                                
                                                        $this->points_user_positive='si';
                                                        $this->points_user_negative='no';
                                                        $this->points_user='si';
                            
                                                    }
                            
                                                    else{
                                                        $this->points_user_positive='no';
                                                        $this->points_user_negative='si';
                                                    }
                                                            
                                                }
                                                else{
                                                    $this->points_user_positive='no';
                                                    $this->points_user_negative='no';
                                                }
            
                                        }
                                        else{
                                            $url_detect_com= strpos($this->search, 'ttp');
            
                                            if($url_detect_com != false){
            
                                                $con_seguridad= strpos($this->search, 'ttps');
                                                $i = 0;
                                                    
                                                do{
                                                    $detect= substr($this->search, $this->posicion,1);
            
                                                    if($detect == '/') $i = 1;
                                                    else{
                                                        $i = 0;
                                                        $this->posicion = $this->posicion + 1;
                                                    }
            
                                                }
                                                while($i != 1);
            
                                                if($con_seguridad != false){
                                                    $url_detect = 'https://'.substr($this->search,8,($this->posicion-8));
                                                }
            
                                                else{
                                                    $url_detect = 'https://'.substr($this->search,7,($this->posicion-7));
                                                }
            
                                                $link = new Link();
                                                $link->jumper = $url_detect;
                                                $link->psid = substr($this->psid_buscar,0,5);
                                                $link->user_id = auth()->user()->id;
                                                $link->jumper_type_id = 5;
                                                $link->k_detected = 'K=1000';
                                                $link->save();
            
                                                $this->busqueda_link = Link::where('id',$link->id)->first();
            
                                                $this->jumper_2 = '1';
                                        
                                                $user_point= User_Links_Points::where('link_id',$this->busqueda_link->id)
                                                    ->where('user_id',$this->user_auth)
                                                    ->first();
                                                                    
                                                $comments = Comments::where('link_id',$this->busqueda_link->id)
                                                    ->latest('id')
                                                    ->paginate(5);
                                                                    
                                                    if($user_point) {
                                                        if($user_point->point == 'positive'){
                                                    
                                                            $this->points_user_positive='si';
                                                            $this->points_user_negative='no';
                                                            $this->points_user='si';
                                
                                                        }
                                
                                                        else{
                                                            $this->points_user_positive='no';
                                                            $this->points_user_negative='si';
                                                        }
                                                                
                                                    }
                                                    else{
                                                        $this->points_user_positive='no';
                                                        $this->points_user_negative='no';
                                                    }
                                            }
                                        }
                                }
                
                            }
                            else{
                                $this->pid_detectado = 'no';
                                $this->busqueda_link = Link::where('psid',substr($this->psid_buscar,0,5))->first();
                
                                $busqueda_link_def =  $this->busqueda_link;
                
                                            if($this->busqueda_link){
                                                $user_point= User_Links_Points::where('link_id',$this->busqueda_link->id)
                                                    ->where('user_id',auth()->user()->id)
                                                    ->first();
                                                                
                                                $comments = Comments::where('link_id',$this->busqueda_link->id)
                                                    ->latest('id')
                                                    ->paginate(5);
                                                                    
                                                    if($user_point) {
                                                        if($user_point->point == 'positive'){
                                                    
                                                            $this->points_user_positive='si';
                                                            $this->points_user_negative='no';
                                                            $this->points_user='si';
                                
                                                        }
                                
                                                        else{
                                                            $this->points_user_positive='no';
                                                            $this->points_user_negative='si';
                                                        }
                                                                
                                                    }
                                                    else{
                                                        $this->points_user_positive='no';
                                                        $this->points_user_negative='no';
                                                    }
                
                                            }
                                            else{
                                                $url_detect_com= strpos($this->search, 'ttp');
                
                                                if($url_detect_com != false){
                
                                                    $con_seguridad= strpos($this->search, 'ttps');
                                                    $i = 0;
                                                        
                                                    do{
                                                        $detect= substr($this->search, $this->posicion,1);
                
                                                        if($detect == '/') $i = 1;
                                                        else{
                                                            $i = 0;
                                                            $this->posicion = $this->posicion + 1;
                                                        }
                
                                                    }
                                                    while($i != 1);
                
                                                    if($con_seguridad != false){
                                                        $url_detect = 'https://'.substr($this->search,8,($this->posicion-8));
                                                    }
                
                                                    else{
                                                        $url_detect = 'https://'.substr($this->search,7,($this->posicion-7));
                                                    }
                
                                                    $link = new Link();
                                                    $link->jumper = $url_detect;
                                                    $link->psid = substr($this->psid_buscar,0,5);
                                                    $link->user_id = auth()->user()->id;
                                                    $link->jumper_type_id = 5;
                                                    $link->k_detected = 'K=1000';
                                                    $link->save();
                
                                                    $this->busqueda_link = Link::where('id',$link->id)->first();
                
                                                    $this->jumper_2 = '1';
                                            
                                                    $user_point= User_Links_Points::where('link_id',$this->busqueda_link->id)
                                                        ->where('user_id',$this->user_auth)
                                                        ->first();
                                                                        
                                                    $comments = Comments::where('link_id',$this->busqueda_link->id)
                                                        ->latest('id')
                                                        ->paginate(5);
                                                                        
                                                        if($user_point) {
                                                            if($user_point->point == 'positive'){
                                                        
                                                                $this->points_user_positive='si';
                                                                $this->points_user_negative='no';
                                                                $this->points_user='si';
                                    
                                                            }
                                    
                                                            else{
                                                                $this->points_user_positive='no';
                                                                $this->points_user_negative='si';
                                                            }
                                                                    
                                                        }
                                                        else{
                                                            $this->points_user_positive='no';
                                                            $this->points_user_negative='no';
                                                        }
                                                }
                                            }
                            }
                        }
    
                        if($this->jumper_detect == 0 && $this->pid_detectado == 'si'){

                            if($this->jumper_list == 0){
                                $client = new Client([
                                    //'base_uri' => 'http://127.0.0.1:8000',
                                    'base_uri' => 'http://146.190.74.228/',
                                ]);
            
                                $resultado = $client->request('GET', '/k23/1/'.$this->ids_buscar.'/'.$this->psid_buscar.'/'.$this->k2_buscar.'/'.$this->pid_buscar);

                                if($resultado->getStatusCode() == 200){
     
                                    $this->jumper_complete = json_decode($resultado->getBody(),true);
     
                                    $this->busqueda_link = Link::where('psid',substr($this->psid_buscar,0,5))->first();
         
                                    if($this->busqueda_link){
                                         $user_point= User_Links_Points::where('link_id',$this->busqueda_link->id)
                                             ->where('user_id',auth()->user()->id)
                                             ->first();
                                                         
                                         $comments = Comments::where('link_id',$this->busqueda_link->id)
                                             ->latest('id')
                                             ->paginate(5);
                                                             
                                             if($user_point) {
                                                if($user_point->point == 'positive'){
                                              
                                                    $this->points_user_positive='si';
                                                    $this->points_user_negative='no';
                                                    $this->points_user='si';
                        
                                                }
                        
                                                else{
                                                    $this->points_user_positive='no';
                                                    $this->points_user_negative='si';
                                                }
                                                        
                                            }
                                            else{
                                                $this->points_user_positive='no';
                                                $this->points_user_negative='no';
                                            }
         
                                    }
                                    else{
                                         $url_detect_com= strpos($this->search, 'ttp');
         
                                         if($url_detect_com != false){
         
                                             $con_seguridad= strpos($this->search, 'ttps');
                                             $i = 0;
                                                 
                                             do{
                                                 $detect= substr($this->search, $this->posicion,1);
         
                                                 if($detect == '/') $i = 1;
                                                 else{
                                                     $i = 0;
                                                     $this->posicion = $this->posicion + 1;
                                                 }
         
                                             }
                                             while($i != 1);
         
                                             if($con_seguridad != false){
                                                 $url_detect = 'https://'.substr($this->search,8,($this->posicion-8));
                                             }
         
                                             else{
                                                 $url_detect = 'https://'.substr($this->search,7,($this->posicion-7));
                                             }
         
                                             $link = new Link();
                                             $link->jumper = $url_detect;
                                             $link->psid = substr($this->psid_buscar,0,5);
                                             $link->user_id = auth()->user()->id;
                                             $link->jumper_type_id = 8;
                                             $link->k_detected = 'K=23';
                                             $link->save();
         
                                             $this->busqueda_link = Link::where('id',$link->id)->first();
         
                                             $this->jumper_2 = '1';
                                     
                                             $user_point= User_Links_Points::where('link_id',$this->busqueda_link->id)
                                                 ->where('user_id',$this->user_auth)
                                                 ->first();
                                                                 
                                             $comments = Comments::where('link_id',$this->busqueda_link->id)
                                                 ->latest('id')
                                                 ->paginate(5);
                                                                 
                                                 if($user_point) {
                                                    if($user_point->point == 'positive'){
                                                  
                                                        $this->points_user_positive='si';
                                                        $this->points_user_negative='no';
                                                        $this->points_user='si';
                            
                                                    }
                            
                                                    else{
                                                        $this->points_user_positive='no';
                                                        $this->points_user_negative='si';
                                                    }
                                                            
                                                }
                                                else{
                                                    $this->points_user_positive='no';
                                                    $this->points_user_negative='no';
                                                }
                                         }
                                    }

                                     $this->jumper_list = 1;
                                     $this->jumper_detect = 1;
                                }
     
                                else{
                                     $this->jumper_detect = 3;
                                }
                            }

                            else{
                                $this->busqueda_link = Link::where('psid',substr($this->psid_buscar,0,5))->first();
         
                                $busqueda_link_def =  $this->busqueda_link;
         
                                if($this->busqueda_link){
                                    $user_point= User_Links_Points::where('link_id',$this->busqueda_link->id)
                                        ->where('user_id',auth()->user()->id)
                                        ->first();
                                                         
                                    $comments = Comments::where('link_id',$this->busqueda_link->id)
                                        ->latest('id')
                                        ->paginate(5);
                                                             
                                        if($user_point) {
                                            if($user_point->point == 'positive'){
                                          
                                                $this->points_user_positive='si';
                                                $this->points_user_negative='no';
                                                $this->points_user='si';
                    
                                            }
                    
                                            else{
                                                $this->points_user_positive='no';
                                                $this->points_user_negative='si';
                                            }
                                                    
                                        }
                                        else{
                                            $this->points_user_positive='no';
                                            $this->points_user_negative='no';
                                        }
         
                                }
                            }

                        }
    
                        else{
                            if($this->pid_detectado == 'si' && $this->jumper_detect != 0){
                                $this->jumper_detect = 3;
                            }
                        }
              
                }
                else{
                    $busqueda_psid_ = strpos($this->search, 'psid');
            
                    if($busqueda_psid_ !== false){
                        $busqueda_psid= strpos($this->search, 'psid');

                       if(session('psid'))$psid_complete = substr($this->search,($busqueda_psid + 5),11).substr(session('psid'),11,11);
                        else  $this->psid_buscar = substr($this->search,($busqueda_psid + 5),22);

                        $busqueda_ids= strpos($this->search, 'IDS=');

                        if($busqueda_ids != false){

                            $posicion_ids = $busqueda_ids + 4;
                            $i_ids = 0;
                            $busq_ids_s = 0;
                            
                            do{
                                $detect_ids= substr($this->search, $posicion_ids,1);
        
                                if($detect_ids == '&') $i_ids = 1;
                                else{
                                    $posicion_ids = $posicion_ids + 1;
                                    $busq_ids_s ++;
                                }

                                if($busq_ids_s > 20){
                                    $i_ids = 1;
                                }
        
                            }while($i_ids != 1);

                            if($busq_ids_s < 20)
                                $this->ids_buscar = substr($this->search,($busqueda_ids + 4),($posicion_ids - ($busqueda_ids + 4)));

                            else
                                //$this->ids_buscar = substr($this->search,($busqueda_ids + 4),20);
                                $this->jumper_detect = 3;
                        }

                        else{
                            $this->jumper_detect = 3;
                        }


                        $busqueda_k2= strpos($this->search, '&K2=');


                        if($busqueda_k2 != false){

                            $posicion_k2 = $busqueda_k2 + 4;
                            $i_k2 = 0;
                            $busq_k2_s = 0;
                            
                            do{
                                $detect_k2= substr($this->search, $posicion_k2,1);
        
                                if($detect_k2 == '&') $i_k2 = 1;
                                else{
                                    $posicion_k2 = $posicion_k2 + 1;
                                    $busq_k2_s ++;
                                }

                                if($busq_k2_s > 20){
                                    $i_k2 = 1;
                                }
        
                            }while($i_k2 != 1);



                            if($busq_k2_s < 20)
                                $this->k2_buscar = substr($this->search,($busqueda_k2 + 4),($posicion_k2 - ($busqueda_k2 + 4)));

                            else
                                //$this->ids_buscar = substr($this->search,($busqueda_ids + 4),20);
                                $this->jumper_detect = 3;
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
                                    $this->busqueda_link = Link::where('psid',substr($this->psid_buscar,0,5))->first();
            
                                    $busqueda_link_def =  $this->busqueda_link;
            
                                        if($this->busqueda_link){
                                            $user_point= User_Links_Points::where('link_id',$this->busqueda_link->id)
                                                ->where('user_id',auth()->user()->id)
                                                ->first();
                                                            
                                            $comments = Comments::where('link_id',$this->busqueda_link->id)
                                                ->latest('id')
                                                ->paginate(5);
                                                                
                                                if($user_point) {
                                                    if($user_point->point == 'positive'){
                                                
                                                        $this->points_user_positive='si';
                                                        $this->points_user_negative='no';
                                                        $this->points_user='si';
                            
                                                    }
                            
                                                    else{
                                                        $this->points_user_positive='no';
                                                        $this->points_user_negative='si';
                                                    }
                                                            
                                                }
                                                else{
                                                    $this->points_user_positive='no';
                                                    $this->points_user_negative='no';
                                                }
            
                                        }
                                        else{
                                            $url_detect_com= strpos($this->search, 'ttp');
            
                                            if($url_detect_com != false){
            
                                                $con_seguridad= strpos($this->search, 'ttps');
                                                $i = 0;
                                                    
                                                do{
                                                    $detect= substr($this->search, $this->posicion,1);
            
                                                    if($detect == '/') $i = 1;
                                                    else{
                                                        $i = 0;
                                                        $this->posicion = $this->posicion + 1;
                                                    }
            
                                                }
                                                while($i != 1);
            
                                                if($con_seguridad != false){
                                                    $url_detect = 'https://'.substr($this->search,8,($this->posicion-8));
                                                }
            
                                                else{
                                                    $url_detect = 'https://'.substr($this->search,7,($this->posicion-7));
                                                }
            
                                                $link = new Link();
                                                $link->jumper = $url_detect;
                                                $link->psid = substr($this->psid_buscar,0,5);
                                                $link->user_id = auth()->user()->id;
                                                $link->jumper_type_id = 5;
                                                $link->k_detected = 'K=1000';
                                                $link->save();
            
                                                $this->busqueda_link = Link::where('id',$link->id)->first();
            
                                                $this->jumper_2 = '1';
                                        
                                                $user_point= User_Links_Points::where('link_id',$this->busqueda_link->id)
                                                    ->where('user_id',$this->user_auth)
                                                    ->first();
                                                                    
                                                $comments = Comments::where('link_id',$this->busqueda_link->id)
                                                    ->latest('id')
                                                    ->paginate(5);
                                                                    
                                                    if($user_point) {
                                                        if($user_point->point == 'positive'){
                                                    
                                                            $this->points_user_positive='si';
                                                            $this->points_user_negative='no';
                                                            $this->points_user='si';
                                
                                                        }
                                
                                                        else{
                                                            $this->points_user_positive='no';
                                                            $this->points_user_negative='si';
                                                        }
                                                                
                                                    }
                                                    else{
                                                        $this->points_user_positive='no';
                                                        $this->points_user_negative='no';
                                                    }
                                            }
                                        }
                                }
                
                            }
                            else{
                                $this->pid_detectado = 'no';
                                $this->busqueda_link = Link::where('psid',substr($this->psid_buscar,0,5))->first();
                
                                $busqueda_link_def =  $this->busqueda_link;
                
                                            if($this->busqueda_link){
                                                $user_point= User_Links_Points::where('link_id',$this->busqueda_link->id)
                                                    ->where('user_id',auth()->user()->id)
                                                    ->first();
                                                                
                                                $comments = Comments::where('link_id',$this->busqueda_link->id)
                                                    ->latest('id')
                                                    ->paginate(5);
                                                                    
                                                    if($user_point) {
                                                        if($user_point->point == 'positive'){
                                                    
                                                            $this->points_user_positive='si';
                                                            $this->points_user_negative='no';
                                                            $this->points_user='si';
                                
                                                        }
                                
                                                        else{
                                                            $this->points_user_positive='no';
                                                            $this->points_user_negative='si';
                                                        }
                                                                
                                                    }
                                                    else{
                                                        $this->points_user_positive='no';
                                                        $this->points_user_negative='no';
                                                    }
                
                                            }
                                            else{
                                                $url_detect_com= strpos($this->search, 'ttp');
                
                                                if($url_detect_com != false){
                
                                                    $con_seguridad= strpos($this->search, 'ttps');
                                                    $i = 0;
                                                        
                                                    do{
                                                        $detect= substr($this->search, $this->posicion,1);
                
                                                        if($detect == '/') $i = 1;
                                                        else{
                                                            $i = 0;
                                                            $this->posicion = $this->posicion + 1;
                                                        }
                
                                                    }
                                                    while($i != 1);
                
                                                    if($con_seguridad != false){
                                                        $url_detect = 'https://'.substr($this->search,8,($this->posicion-8));
                                                    }
                
                                                    else{
                                                        $url_detect = 'https://'.substr($this->search,7,($this->posicion-7));
                                                    }
                
                                                    $link = new Link();
                                                    $link->jumper = $url_detect;
                                                    $link->psid = substr($this->psid_buscar,0,5);
                                                    $link->user_id = auth()->user()->id;
                                                    $link->jumper_type_id = 5;
                                                    $link->k_detected = 'K=1000';
                                                    $link->save();
                
                                                    $this->busqueda_link = Link::where('id',$link->id)->first();
                
                                                    $this->jumper_2 = '1';
                                            
                                                    $user_point= User_Links_Points::where('link_id',$this->busqueda_link->id)
                                                        ->where('user_id',$this->user_auth)
                                                        ->first();
                                                                        
                                                    $comments = Comments::where('link_id',$this->busqueda_link->id)
                                                        ->latest('id')
                                                        ->paginate(5);
                                                                        
                                                        if($user_point) {
                                                            if($user_point->point == 'positive'){
                                                        
                                                                $this->points_user_positive='si';
                                                                $this->points_user_negative='no';
                                                                $this->points_user='si';
                                    
                                                            }
                                    
                                                            else{
                                                                $this->points_user_positive='no';
                                                                $this->points_user_negative='si';
                                                            }
                                                                    
                                                        }
                                                        else{
                                                            $this->points_user_positive='no';
                                                            $this->points_user_negative='no';
                                                        }
                                                }
                                            }
                            }
                        }
    

                        if($this->jumper_detect == 0 && $this->pid_detectado == 'si'){

                            $client = new Client([
                                //'base_uri' => 'http://127.0.0.1:8000',
                                'base_uri' => 'http://146.190.74.228/',
                            ]);
        
                            $resultado = $client->request('GET', '/k23/1/'.$this->ids_buscar.'/'.$this->psid_buscar.'/'.$this->k2_buscar.'/'.$this->pid_buscar);
        
                            if($resultado->getStatusCode() == 200){
                                //$jumper_complete = substr(json_decode((string)$resultado->getBody(),true),12,-2);

                                $this->jumper_complete = json_decode($resultado->getBody(),true);
    
                                $this->busqueda_link = Link::where('psid',substr($this->psid_buscar,0,5))->first();
    
                                $busqueda_link_def =  $this->busqueda_link;
    
                                if($this->busqueda_link){
                                    $user_point= User_Links_Points::where('link_id',$this->busqueda_link->id)
                                        ->where('user_id',auth()->user()->id)
                                        ->first();
                                                    
                                    $comments = Comments::where('link_id',$this->busqueda_link->id)
                                        ->latest('id')
                                        ->paginate(5);
                                                        
                                        if($user_point) {
                                            if($user_point->point == 'positive'){
                                          
                                                $this->points_user_positive='si';
                                                $this->points_user_negative='no';
                                                $this->points_user='si';
                    
                                            }
                    
                                            else{
                                                $this->points_user_positive='no';
                                                $this->points_user_negative='si';
                                            }
                                                    
                                        }
                                        else{
                                            $this->points_user_positive='no';
                                            $this->points_user_negative='no';
                                        }
    
                                }
                                else{
                                    $url_detect_com= strpos($this->search, 'ttp');
    
                                    if($url_detect_com != false){
    
                                        $con_seguridad= strpos($this->search, 'ttps');
                                        $i = 0;
                                            
                                        do{
                                            $detect= substr($this->search, $this->posicion,1);
    
                                            if($detect == '/') $i = 1;
                                            else{
                                                $i = 0;
                                                $this->posicion = $this->posicion + 1;
                                            }
    
                                        }
                                        while($i != 1);
    
                                        if($con_seguridad != false){
                                            $url_detect = 'https://'.substr($this->search,8,($this->posicion-8));
                                        }
    
                                        else{
                                            $url_detect = 'https://'.substr($this->search,7,($this->posicion-7));
                                        }
    
                                        $link = new Link();
                                        $link->jumper = $url_detect;
                                        $link->psid = substr($this->psid_buscar,0,5);
                                        $link->user_id = auth()->user()->id;
                                        $link->jumper_type_id = 8;
                                        $link->k_detected = 'K=23';
                                        $link->save();
    
                                        $this->busqueda_link = Link::where('id',$link->id)->first();
    
                                        $this->jumper_2 = '1';
                                
                                        $user_point= User_Links_Points::where('link_id',$this->busqueda_link->id)
                                            ->where('user_id',$this->user_auth)
                                            ->first();
                                                            
                                        $comments = Comments::where('link_id',$this->busqueda_link->id)
                                            ->latest('id')
                                            ->paginate(5);
                                                            
                                            if($user_point) {
                                                if($user_point->point == 'positive'){
                                              
                                                    $this->points_user_positive='si';
                                                    $this->points_user_negative='no';
                                                    $this->points_user='si';
                        
                                                }
                        
                                                else{
                                                    $this->points_user_positive='no';
                                                    $this->points_user_negative='si';
                                                }
                                                        
                                            }
                                            else{
                                                $this->points_user_positive='no';
                                                $this->points_user_negative='no';
                                            }
                                    }
                                }
    
                                $this->jumper_detect = 1;
                            }

                            else{
                                $this->jumper_detect = 3;
                            }

                        }

                        else{
                            if($this->pid_detectado == 'si' && $this->jumper_detect != 0){
                                $this->jumper_detect = 3;
                            }
                        }
                    }

                    else{
                        $this->jumper_detect = 3;
                    }

                    session()->forget('search');
                }
                        
                session()->forget('search');

        }
        else{
            $this->calc_link = 0;
        }

        return view('livewire.jumpers.k23.k23-index',compact('jumper','comments','subs_psid','busqueda_link_def'));
    }

    public function positivo($jumper_id){

        $user_point= User_Links_Points::where('link_id',$jumper_id)
            ->where('user_id',$this->user_auth)
            ->first();

        if($user_point){
            $user_point->update([
                'point' => 'positive'
            ]);

            $jumper_id = Link::where('id',$jumper_id)->first();

            $new_points_positive = $jumper_id->positive_points + 1;
            $new_points_negative = $jumper_id->negative_points - 1;

            $jumper_id->update([
                'positive_points' => $new_points_positive, 
                'negative_points' => $new_points_negative, 
            ]);

            $this->points_user_positive='si';
            $this->points_user_negative='no';

        }
        else{
            $links_points = new User_Links_Points();
            $links_points->user_id = auth()->user()->id;
            $links_points->link_id = $jumper_id;
            $links_points->point = 'positive';
            $links_points->save();

            $jumper_id = Link::where('id',$jumper_id)->first();

            $new_points = $jumper_id->positive_points + 1;

            $jumper_id->update([
                'positive_points' => $new_points, 
            ]);

            $this->points_user_positive='si';
            $this->points_user_negative='no';

        }

        

    }

    public function negativo($jumper_id){
        $user_point= User_Links_Points::where('link_id',$jumper_id)
            ->where('user_id',$this->user_auth)
            ->first();

        if($user_point){
            $user_point->update([
                'point' => 'negative'
            ]);

            $jumper_id = Link::where('id',$jumper_id)->first();

            $new_points_positive = $jumper_id->positive_points - 1;
            $new_points_negative = $jumper_id->negative_points + 1;

            $jumper_id->update([
                'positive_points' => $new_points_positive, 
                'negative_points' => $new_points_negative, 
            ]);

            $this->points_user_positive='no';
            $this->points_user_negative='si';

        }
        else{
            $links_points = new User_Links_Points();
            $links_points->user_id = auth()->user()->id;
            $links_points->link_id = $jumper_id;
            $links_points->point = 'negative';
            $links_points->save();

            $jumper_id = Link::where('id',$jumper_id)->first();

            $new_points = $jumper_id->negative_points + 1;

            $jumper_id->update([
                'negative_points' => $new_points, 
            ]);

            $this->points_user_positive='no';
            $this->points_user_negative='si';

        }

        
    }

    public function comentar(){
        if($this->comentario != ''){
           
            $comment = new Comments();
            $comment->comment = $this->comentario;
            $comment->link_id = $this->busqueda_link->id;
            $comment->user_id = auth()->user()->id;
            $comment->save();

            $this->reset(['comentario']);
        }
    }

    public function clear(){
          $this->reset(['search']);
        $this->jumper_list = 0;
        $this->jumper_complete = [];
        session()->forget('search');
        $this->busqueda_link = "";
        return redirect()->route('kveintitres.index');

    }
}
