<?php

namespace App\Http\Livewire\Jumpers\Ssidkr;

use App\Models\Comments;
use App\Models\Link;
use App\Models\User_Links_Points;
use Livewire\Component;
use Livewire\WithPagination;

class SsidkrIndex extends Component
{

    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public $posicion_total_k,$posicionk,$no_jumpear,$posicion, $no_detect = '0', $jumper_detect = 0, $k_detect = '0', $wix_detect = '0', $psid_register=0,$jumper_redirect,$link_complete_2,$calculo_high = 0,$pid_new=0,$search,$jumper_2,$points_user,$user_auth,$comentario,$is_high,$is_basic,$calc_link,$jumper_select ;

    protected $listeners = ['render' => 'render'];

    public function mount($jumper,$link_complete){
        if($jumper != 0){
            $this->link_complete_2 = $link_complete;
            $this->jumper_redirect= Link::where('id',$jumper)->first();
        }
        $this->jumper_2 = '';
        $this->user_auth =  auth()->user()->id;
        $this->points_user='no';
        $this->is_basic = 'no';
        $this->is_high = 'no';
        $this->calc_link = 0;
        if(session('pid')) $this->pid_new = session('pid');
        if(session('psid')) $this->psid_register = session('psid');
    }



    public function render()
    {
        $subs_psid = '0';
        $jumper_complete = 0;
        $comments ="";
        $jumper = "";
        $link_complete="";
        $this->no_jumpear = 0;
        $this->jumper_detect = 0;
        $this->k_detect = '0';
        $this->wix_detect = '0';
        $this->is_basic = 'no';
        $this->is_high = 'no';
        $this->points_user='no';
        $this->no_detect = '0';
        $this->posicion = 8; //me esta buscand a partir de https://


        $this->search = trim($this->search); //quitando espacios en blancos al inicio y final
        $long_psid = strlen($this->search); //buscando cuantos caracteres tiene en total
    
        if($long_psid>=5 || $this->jumper_redirect){
            if($this->jumper_redirect){
                $jumper = $this->jumper_redirect;
                //aca estoy completando el psid que traje de la redireccion con  mi ultima letra de mi psid
                if(session('psid')) $link_complete =$this->link_complete_2.substr(session('psid'),21);
                else $link_complete = $this->link_complete_2.'*';

                $this->calc_link = 1;
            }
            else{
                if((strpos($this->search, 'ttps://') == false) && (strpos($this->search, 'ttp://') == false)){
                    $subs_psid =  substr($this->search,0,5);
                    $psid_complete = $subs_psid;

                    if(strlen($this->search) >= 22){
                        $subs_psid_sin_cortar = substr($this->search,22);
                        //$psid_complete = substr($subs_psid_sin_cortar,0,21);
                        $psid_complete = substr($this->search,0,21);
                    }
                    else{
                        $this->no_jumpear = 1;
                    }

                }
                else{
                    $busqueda_ast_ = strpos($this->search, '**');

                    if($busqueda_ast_ !== false){
                        $busqueda_id= strpos($this->search, '**');
                        $subs_psid = substr($this->search,($busqueda_id - 22),5);
                        $subs_psid_sin_cortar = substr($this->search,($busqueda_id - 22));
                        $psid_complete = substr($subs_psid_sin_cortar,0,21);
                    }
                    else{
                        $busqueda_psid_ = strpos($this->search, 'psid');

                        if($busqueda_psid_ !== false){
                            $busqueda_psid= strpos($this->search, 'psid'); 
                            $subs_psid = substr($this->search,($busqueda_psid + 5),5);
                            $subs_psid_sin_cortar = substr($this->search,($busqueda_psid + 5));
                            $psid_complete = substr($subs_psid_sin_cortar,0,21);
                        }

                        else{

                            $busqueda_id_ = strpos($this->search, 'id=');

                            if($busqueda_id_ !== false){
                                $busqueda_id= strpos($this->search, 'id='); 
                                $subs_psid = substr($this->search,($busqueda_id+ 3),5);
                                $subs_psid_sin_cortar = substr($this->search,($busqueda_id + 5));
                                $psid_complete = substr($subs_psid_sin_cortar,0,21);
                            }

                            else{
                                $subs_psid = 'no_existe_psid_error_volver_a_intentar&&..';

                            }

                        }
                    }
                }

                $jumper = Link::where('psid',$subs_psid)->first();

            }

            if($jumper){
                if(!$this->jumper_redirect){
                    if($jumper->jumper_type_id == 1){
                        //en el caso de direccionamiento desde otras vas a padar el jumper y el psid_complete
                         $this->is_basic = "si";
                        if(session('psid')) $link_complete =$psid_complete.substr(session('psid'),21);
                        else $link_complete = $psid_complete.'(ultima letra del tu psid)';
                        
                        $this->calc_link = 1;
                    } 
                    if($jumper->jumper_type_id == 2){
                        if(session('psid')) $link_complete = $psid_complete.substr(session('psid'),21);
                        else $link_complete = $psid_complete.'(ultima letra de tu psid)';
                        
                        $this->is_high = "si";
                    }
                }

                if($jumper->jumper)$this->jumper_detect = $jumper->jumper;
                else{
                    $url_detect_com= strpos($this->search, 'ttps://');

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
    
                        }while($i != 1);
    
    
                        if($con_seguridad != false){
                            $url_detect = 'https://'.substr($this->search,8,($this->posicion-8));
                        }
        
                        else{
                            $url_detect = 'https://'.substr($this->search,7,($this->posicion-7));
                        }
    
         
                        if($url_detect != 'https://dkr1.ssisurveys.com'){
                            $jumper->update(
                                ['jumper' => $url_detect ]
                            );
                        }
                    }
                
                }

                if($jumper->k_detected) $this->k_detect = $jumper->k_detected;
                else{
                    $k_detect= strpos($this->search, '_k=');
                    if($k_detect){
                        $this->posicionk = $k_detect + 3;
    
                        $ik = 0;
                        
                            do{
                                $detectk= substr($this->search, $this->posicionk,1);
                                    
                                if($detectk == '&') $ik = 1;
                                else{
                                    $ik = 0;
                                    $this->posicionk = $this->posicionk + 1;
                                }
                            }
                            while($ik != 1);
    
                            $this->posicion_total_k = $this->posicionk -  ($k_detect + 3);
                        
                        $jumper->update(
                            ['k_detected' => 'K='.substr($this->search,($k_detect + 3),$this->posicion_total_k) ]
                        );
                    }
                }

                $this->jumper_2 = '1';
                
                $user_point= User_Links_Points::where('link_id',$jumper->id)
                    ->where('user_id',$this->user_auth)
                    ->first();
                                
                $comments = Comments::where('link_id',$jumper->id)
                    ->latest('id')
                    ->paginate(5);
                                
                if($user_point) $this->points_user='si';
                else $this->points_user='no';
        
                if($jumper->jumper_type_id == 1){
                    $this->is_basic = "si";
                    $jumper_complete = 'https://dkr1.ssisurveys.com/projects/end?rst=1&psid='.$link_complete.'**&basic='.$jumper->basic;
                } 
                            
                if($jumper->jumper_type_id == 2){
                    if(session('pid')){
                        $this->calc_link = 1;
                        $calculo_high_new = $this->calculo_high($jumper->id);
                        $jumper_complete = 'https://dkr1.ssisurveys.com/projects/end?rst=1&psid='.$link_complete.'**&high='.$calculo_high_new;
                    }
                    else{
                        //$buscar_pid_search = 
                        if($this->calc_link == 0){
                            $jumper_complete = 'Ingrese su PID para calcular el valor high';
                        }
                        else{
                            $jumper_complete = 'https://dkr1.ssisurveys.com/projects/end?rst=1&psid='.$link_complete.'**&high='.$this->calculo_high;
                        }
                    }
                } 
                $this->jumper_redirect = [];
            } 

            else {

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

                    $k_detect= strpos($this->search, '_k=');

                    if($k_detect){
                        $this->posicionk = $k_detect + 3;

                        
                        $ik = 0;
                    
                            do{
                                $detectk= substr($this->search, $this->posicionk,1);
                                
                                if($detectk == '&') $ik = 1;
                                else{
                                    $ik = 0;
                                    $this->posicionk = $this->posicionk + 1;
                                }
                            }
                            while($ik != 1);

                            $this->posicion_total_k = $this->posicionk -  ($k_detect + 3);
                    }

     
                    if($url_detect != 'https://dkr1.ssisurveys.com'){

                        if($subs_psid != 'no_existe_psid_error_volver_a_intentar&&..'){
                            $link = new Link();
                            $link->jumper = $url_detect;
                            $link->psid = $subs_psid;
                            $link->user_id = auth()->user()->id;
                            $link->jumper_type_id = 15;
                            if($k_detect) $link->k_detected = 'K='.substr($this->search,($k_detect + 3),$this->posicion_total_k);
                            $link->save();

                            $this->jumper_detect = $url_detect;

                            $jumper = Link::get()->last();

                            //////falta optimizar

                            $this->jumper_2 = '1';
                
                            $user_point= User_Links_Points::where('link_id',$jumper->id)
                                ->where('user_id',$this->user_auth)
                                ->first();
                                            
                            $comments = Comments::where('link_id',$jumper->id)
                                ->latest('id')
                                ->paginate(5);
                                            
                            if($user_point) $this->points_user='si';
                            else $this->points_user='no';
                    
                            if($jumper->jumper_type_id == 1){
                                $this->is_basic = "si";
                                $jumper_complete = 'https://dkr1.ssisurveys.com/projects/end?rst=1&psid='.$link_complete.'**&basic='.$jumper->basic;
                            } 
                                        
                            if($jumper->jumper_type_id == 2){
                                if(session('pid')){
                                    $this->calc_link = 1;
                                    $calculo_high_new = $this->calculo_high($jumper->id);
                                    $jumper_complete = 'https://dkr1.ssisurveys.com/projects/end?rst=1&psid='.$link_complete.'**&high='.$calculo_high_new;
                                }
                                else{
                                    //$buscar_pid_search = 
                                    if($this->calc_link == 0){
                                        $jumper_complete = 'Ingrese su PID para calcular el valor high';
                                    }
                                    else{
                                        $jumper_complete = 'https://dkr1.ssisurveys.com/projects/end?rst=1&psid='.$link_complete.'**&high='.$this->calculo_high;
                                    }
                                }
                            } 

                            if($jumper->k_detected) $this->k_detect = $jumper->k_detected;
                        


                            //////fin optimizar
                        }
                    }
                    else{
                        $this->no_detect = 1;
                    }
                    $this->jumper_2 = '';
                }

                else{
                    $this->no_detect = 1;
                }
            }
        }
        
        else{
            $this->jumper_2 = '';
            $this->is_basic = 'no';
            $this->is_high = 'no';
            $this->calc_link = 0;
        }


        return view('livewire.jumpers.ssidkr.ssidkr-index',compact('jumper_complete','jumper','comments','subs_psid'));
    }

    public function positivo($jumper_id){
        $jumper_id = Link::where('id',$jumper_id)->first();
        $new_points = $jumper_id->positive_points + 1;

        $jumper_id->update([
            'positive_points' => $new_points, 
        ]);

        $links_points = new User_Links_Points();
        $links_points->user_id = auth()->user()->id;
        $links_points->link_id = $jumper_id->id;
        $links_points->point = 'positive';
        $links_points->save();
        $this->emit('render', 'jumpers.ssidkr.ssidkr-index');
    }

    public function negativo($jumper_id){
        $jumper_id = Link::where('id',$jumper_id)->first();
        $new_points = $jumper_id->negative_points + 1;

        $jumper_id->update([
            'negative_points' => $new_points, 
        ]);
        $links_points = new User_Links_Points();
        $links_points->user_id = auth()->user()->id;
        $links_points->link_id = $jumper_id->id;
        $links_points->point = 'negative';
        $links_points->save();
        $this->emit('render', 'jumpers.ssidkr.ssidkr-index');
    }

    public function comentar($jumper_id){
        $jumper_id = Link::where('id',$jumper_id)->first();
        $comment = new Comments();
        $comment->comment = $this->comentario;
        $comment->link_id = $jumper_id->id;
        $comment->user_id = auth()->user()->id;
        $comment->save();

        $this->reset(['comentario']);
        $this->emit('render', 'jumpers.ssidkr.ssidkr-index');
    }

    public function calculo_high($jumper_id){
        $jumper_id = Link::where('id',$jumper_id)->first();
        $this->calculo_high = $jumper_id->high - ($jumper_id->pid - $this->pid_new) * round(($jumper_id->high / $jumper_id->pid),0);
        if(session('pid')) return $this->calculo_high;
        else{
     
            $this->calc_link = 1;
            $this->emit('render', 'jumpers.ssidkr.ssidkr-index');
        }
    }

    public function clear(){
        $this->reset(['search']);
    }
}
