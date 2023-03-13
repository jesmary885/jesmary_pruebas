<?php

namespace App\Http\Livewire\Jumpers\Ssidkr;

use App\Models\Comments;
use App\Models\Link;
use App\Models\User_Links_Points;
use GuzzleHttp\Client;
use Livewire\Component;
use Livewire\WithPagination;

class SsidkrIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public $type_basic,$descalific_active=0,$type,$jumper_complete_qt,$jumper_complete_sp,$comment_new_psid_register,$pid_register_high,$psid_register_bh,$high_register_bh,$basic_register_bh,$posicionpid,$psid_detectado,$posicion_total_k,$posicionk,$no_jumpear,$posicion, $no_detect = '0', $jumper_detect = 0, $k_detect = '0', $wix_detect = '0', $psid_register=0,$jumper_redirect,$link_complete_2,$calculo_high = 0,$pid_new=0,$search,$jumper_2,$points_user,$user_auth,$comentario,$is_high,$is_basic,$calc_link,$jumper_select,$points_user_positive, $points_user_negative, $router_cint_detect=0 ;

    protected $listeners = ['render' => 'render', 'registro_psid' => 'registro_psid', 'descalificar' => 'descalificar'];

    protected $rules_pid = [
        'pid_new' => 'required|min:8',
    ];
    
    public function mount(){
        $this->jumper_2 = '';
        $this->user_auth =  auth()->user()->id;
 
        $this->is_basic = 'no';
        $this->is_high = 'no';
        $this->calc_link = 0;
        if(session('pid')) $this->pid_new = session('pid');
        if(session('psid')) $this->psid_register = session('psid');
        if(session('search')) $this->search = session('search');
    }

    public function k3203(){
        session()->forget('search');
        return 'k3203';
    }

    public function k2062(){
        session()->forget('search');
        return 'k2062';
    }

    public function k2001(){
        session()->forget('search');
        return 'k2001';
    }

    public function k2066(){
        session()->forget('search');
        return 'k2066';
    }

    public function router(){
        session()->forget('search');
        return 'ktmr';
    }

    public function k1000(){
        session()->forget('search');
        return 'k1000';
    }

    public function k1092(){
        session()->forget('search');
        return 'k1092';
    }

    public function k7341(){
        session()->forget('search');
        return 'k7341';
    }

    public function k1098(){
        session()->forget('search');
        return 'k1098';
    }

    public function k23(){
        session()->forget('search');
        return 'k23';
    }
    public function k3906(){
        session()->forget('search');
        return 'k3906';
    }
    public function k11052(){
        session()->forget('search');
        return 'k11052';
    }
    public function k15293(){
        session()->forget('search');
        return 'k15293';
    }
    public function k17564(){
        session()->forget('search');
        return 'k17564';
    }

    public function render()
    {
        $subs_psid = '0';
        $jumper_complete = 0;
        $comments ="";
        $jumper = "";
        $link_complete="";
        $ultima_letra_psid_search = "";
        $nuevo_high_registrado = 0;
        $nuevo_basic_registrado = 0;
        $type_k = 0;
        $this->no_jumpear = 0;
        $this->jumper_detect = 0;
        $this->k_detect = '0';
        $this->wix_detect = '0';
        $this->is_basic = 'no';
        $this->is_high = 'no';
        $this->router_cint_detect = 0;
      //  $this->descalific_active = 0;
        

        $this->no_detect = '0';
        $this->comment_new_psid_register = '';
        $this->posicion = 8; //me esta buscand a partir de https://

        $this->search = trim($this->search); //quitando espacios en blancos al inicio y final
        $long_psid = strlen($this->search); //buscando cuantos caracteres tiene en total

    
        if($long_psid>=5){

            $busqueda_k3203_ = strpos($this->search, 'k=3203&');
            $busqueda_k2062_ = strpos($this->search, 'k=2062&');
            $busqueda_k1000_ = strpos($this->search, 'k=1000&');
            $busqueda_k1092_ = strpos($this->search, 'k=1092&');
            $busqueda_k7341_ = strpos($this->search, 'k=7341&');
            $busqueda_k1098_ = strpos($this->search, 'k=1098&');
              

                //Registro automático de high y basic
                if((strpos($this->search, '//dkr1.ssisurveys.com/projects/end?') !== false)){

                    if((strpos($this->search, 'imperium') === false)){
                            
                        if((strpos($this->search, '**&high=') !== false)){
                            $high_detectado = strpos($this->search, '**&high=');
                            if(session('pid')) {
                                $this->pid_register_high = session('pid');
                                $this->psid_register_bh = substr($this->search,($high_detectado - 22),5);
                                $this->high_register_bh = substr($this->search,($high_detectado + 8));

                                $nuevo_high_registrado = 1;

                                $this->registro_high();
                            }
                            else{

                                $nuevo_high_registrado = 2;

                                $this->emit('error','Por favor registre su pid para guardar el high ingresado');
                            }
                            
                        }
                        else{
                            
                            if((strpos($this->search, '**&basic=') != false)){
                                $basic_detectado = strpos($this->search, '**&basic=');
                                $this->psid_register_bh = substr($this->search,($basic_detectado - 22),5);
                                $this->basic_register_bh = substr($this->search,($basic_detectado + 9));
                                $this->type_basic = 1;

                                $nuevo_basic_registrado = 1;

                                $this->registro_basic();
                            }
                            else{
                                if((strpos($this->search, '%2A%2A&basic=') != false)){
                                
                                    $basic_detectado = strpos($this->search, '%2A%2A&basic=');
                                    $this->psid_register_bh = substr($this->search,($basic_detectado - 22),5);
                                    $this->basic_register_bh = substr($this->search,($basic_detectado + 13),5);
                                    $this->type_basic = 2;
                               
                                    $nuevo_basic_registrado = 1;
                                    $this->registro_basic();
                                }
                            }
                        }
                    }
                }

                elseif((strpos($this->search, '//api.dynata.com/respondent/exit?rst') !== false)){
                    if((strpos($this->search, '**&basic=') != false)){
                        $basic_detectado = strpos($this->search, '**&basic=');
                        $this->psid_register_bh = substr($this->search,($basic_detectado - 22),5);
                        $this->basic_register_bh = substr($this->search,($basic_detectado + 9));
                        $this->type_basic = 3;

                        $nuevo_basic_registrado = 1;

                        $this->registro_basic();
                    }

                }

                else{

                    if((strpos($this->search, 'ttps://') === false) && (strpos($this->search, 'ttp://') === false)){
                           
                            if(strlen($this->search) <= 11){
                                $this->no_jumpear = 1;

                                if(strlen($this->search) < 11){
                                    $subs_psid =  substr($this->search,0,5);
                                    $psid_complete = $subs_psid;
                                }

                                if(strlen($this->search) == 11){
                                    $subs_psid =  substr($this->search,0,5);
                                    $psid_complete = $subs_psid;
                                    if(session('psid'))$psid_complete = substr($this->search,0,11).substr(session('psid'),11,11);
                                    else  $psid_complete = $subs_psid;

                                }
                            }
        
                            if(strlen($this->search) > 11){

                                $busqueda_psid_ = strpos($this->search, 'psid');
        
                                if($busqueda_psid_ !== false){

                                    if(strlen($this->search) < 27) $this->no_jumpear = 1; 

                                    $subs_psid = substr($this->search,($busqueda_psid_ + 5),5);
                                    $subs_psid_sin_cortar = substr($this->search,($busqueda_psid_ + 5));

                                    if(session('psid'))$psid_complete = substr($subs_psid_sin_cortar,0,11).substr(session('psid'),11,11);
                                    else  $psid_complete = substr($subs_psid_sin_cortar,0,22);

                                }
                                else{

                                    $subs_psid = substr($this->search,0,5);

                                    if(strlen($this->search) < 22) $this->no_jumpear = 1; 

                                    if(session('psid'))$psid_complete = substr($this->search,0,11).substr(session('psid'),11,11);
                                    else  $psid_complete = substr($this->search,0,22);

                                }
                                
                            }
                            /*else{
                                $this->no_jumpear = 1;
                            }*/
        
                        }
                    else{
                            $busqueda_ast_ = strpos($this->search, '**');
        
                            if($busqueda_ast_ !== false){
                                $busqueda_id= strpos($this->search, '**');
                                
                                $subs_psid = substr($this->search,($busqueda_id - 22),5);
                                //$ultima_letra_psid_search = substr($this->search,($busqueda_id + 22),1);
                                $subs_psid_sin_cortar = substr($this->search,($busqueda_id - 22));
                                
                                if(session('psid'))$psid_complete = substr($subs_psid_sin_cortar,0,11).substr(session('psid'),11,11);
                                else  $psid_complete = substr($subs_psid_sin_cortar,0,22);
        
                                //Buscando coincidencia con el psid registrado
                                $busqueda_psid_registrado = substr($this->search,($busqueda_id - 11),11);
                                $this->psid_detectado = substr($this->search,($busqueda_id - 22),22);
                                
        
                                if(session('psid')){
                                    $ultimos_dig_psid = substr(session('psid'),11,11);
        
                                    if($busqueda_psid_registrado != $ultimos_dig_psid) {
                                        $this->emit('confirm', '¿Desea registrar el psid con terminal '.$busqueda_psid_registrado.'?','jumpers.ssidkr.ssidkr-index','registro_psid','Psid registrado');
                                    }
                                }
        
                                else{
                                    $this->emit('confirm', '¿Desea registrar el psid con terminal '.$busqueda_psid_registrado.'?','jumpers.ssidkr.ssidkr-index','registro_psid','Psid registrado');
                                }
        
        
                            }
                            else{
                                $busqueda_psid_ = strpos($this->search, 'psid');
        
                                if($busqueda_psid_ !== false){
                                    $busqueda_psid= strpos($this->search, 'psid'); 
                                    $subs_psid = substr($this->search,($busqueda_psid + 5),5);
                                    $subs_psid_sin_cortar = substr($this->search,($busqueda_psid + 5));

                                    if(session('psid'))$psid_complete = substr($subs_psid_sin_cortar,0,11).substr(session('psid'),11,11);
                                    else  $psid_complete = substr($subs_psid_sin_cortar,0,22);

                                    

                                    //$ultima_letra_psid_search = substr($this->search,($busqueda_psid + 27),1);
                                }
        
                                else{
        
                                    $busqueda_id_ = strpos($this->search, 'id=');
        
                                    if($busqueda_id_ !== false){
                                        $busqueda_id= strpos($this->search, 'id='); 
                                        $subs_psid = substr($this->search,($busqueda_id+ 3),5);
                                        $subs_psid_sin_cortar = substr($this->search,($busqueda_id + 5));
                                        
                                        if(session('psid'))$psid_complete = substr($subs_psid_sin_cortar,0,11).substr(session('psid'),11,11);
                                        else  $psid_complete = substr($subs_psid_sin_cortar,0,21);
                                        //$ultima_letra_psid_search = substr($this->search,($busqueda_id + 25),1);
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

                    if($jumper->jumper)$this->jumper_detect = $jumper->jumper;
                    else{

                        $url_detect_com= strpos($this->search, 'http');
                        $url_detect_com2= strpos($this->search, 'https');

                        if($url_detect_com !== false || $url_detect_com2 !== false){

                            if($url_detect_com2 !== false) {
                                $con_seguridad= strpos($this->search, 'https');
                                $posicion_url = 8;
                            }
                            else {
                                $con_seguridad= strpos($this->search, 'http');
                                $posicion_url = 7;
                            }

                            $i = 0;
                            
                            do{
                                $detect= substr($this->search, $posicion_url,1);

                                if($detect == '/') $i = 1;
                                else{
                                    $i = 0;
                                    $posicion_url = $posicion_url + 1;
                                }

                            }
                            while($i != 1);

                            if($url_detect_com2 !== false){

                            $url_detect = 'https://'.substr($this->search,8,($posicion_url-8));
                            }

                            else{
                                $url_detect = 'https://'.substr($this->search,7,($posicion_url-7));
                            }

                                if($url_detect != 'https://dkr1.ssisurveys.com' && $url_detect != 'https://online.ssisurveys.com' ){
                                    $jumper->update(
                                        ['jumper' => $url_detect ]
                                    );
                                    $this->jumper_detect = $url_detect ;
                                }
                        }
                    
                    }

                    if($this->jumper_detect){
                        $router_cint_detect= strpos($this->jumper_detect, 'router.cint.com');
                        if($router_cint_detect !== false) $this->router_cint_detect = 1;
                    }

                    

                    if($jumper->k_detected) $this->k_detect = $jumper->k_detected;
                    else{
                      
                        $k_detect= strpos($this->search, '_k=');
                        $k_detect2= strpos($this->search, '_K=');
                        if($k_detect != false || $k_detect2 != false){
                            if ($k_detect != false) $this->posicionk = $k_detect + 3;
                            else $this->posicionk = $k_detect2 + 3;
        
                            $ik = 0;
                            $i_busk = 0;
                            
                                do{
                                    $detectk= substr($this->search, $this->posicionk,1);
                                        
                                    if($detectk == '&') $ik = 1;
                                    else{
                                        $i_busk ++;
                                        $ik = 0;
                                        $this->posicionk = $this->posicionk + 1;
                                    }

                                    if($i_busk > 10){
                                        $ik= 1;
                                    }

                                }
                                while($ik != 1);

                            if($i_busk < 10){
        
                                $this->posicion_total_k = $this->posicionk -  ($k_detect + 3);
                                $this->k_detect = 'K='.substr($this->search,($k_detect + 3),$this->posicion_total_k);
            
                            }
                            else{
                                $this->posicion_total_k = 5;
                                $this->k_detect = 'K='.substr($this->search,($k_detect + 3),5);

                                
                            }

                            if((substr($this->search,($k_detect + 3),$this->posicion_total_k)) == '1000') $type_k = 5;
                            elseif((substr($this->search,($k_detect + 3),$this->posicion_total_k)) == '1092') $type_k = 6;
                            elseif((substr($this->search,($k_detect + 3),$this->posicion_total_k)) == '2062') $type_k = 7;
                            elseif((substr($this->search,($k_detect + 3),$this->posicion_total_k)) == '23') $type_k = 8;
                            elseif((substr($this->search,($k_detect + 3),$this->posicion_total_k)) == '7341') $type_k = 9;
                            elseif((substr($this->search,($k_detect + 3),$this->posicion_total_k)) == '1098') $type_k = 16;
                            elseif((substr($this->search,($k_detect + 3),$this->posicion_total_k)) == '3203') $type_k = 17;
                            elseif((substr($this->search,($k_detect + 3),$this->posicion_total_k)) == '3906') $type_k = 18;
                            elseif((substr($this->search,($k_detect + 3),$this->posicion_total_k)) == '11052') $type_k = 19;
                            elseif((substr($this->search,($k_detect + 3),$this->posicion_total_k)) == '15293') $type_k = 20;
                            elseif((substr($this->search,($k_detect + 3),$this->posicion_total_k)) == '17564') $type_k = 21;
                            elseif((substr($this->search,($k_detect + 3),$this->posicion_total_k)) == '2066') $type_k = 22;
                            elseif((substr($this->search,($k_detect + 3),$this->posicion_total_k)) == '2001') $type_k = 23;
                            else  $type_k = 15;

                            $jumper->update(
                                [
                                    'k_detected' => 'K='.substr($this->search,($k_detect + 3),$this->posicion_total_k),
                                     'jumper_type_id' => $type_k
                                ]
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

                    /////// aqui voy a buscar ese 3d% si esta voy a armar el jumper como me dijo jesus

                    if((strpos($this->search, 'psid%3d') !== false)){
                 
                        if((strpos($this->search, '**') != false)){
                            $this->calc_link = 1;

                            $busq= strpos($this->search, '**');
                            $psid_3d = substr($this->search,($busq - 22),22);

                            $busqueda_3dpid= strpos($this->search, 'pid%3d');
                            $busqueda_3dpid2= strpos($this->search, 'PID%3d');

                            if($busqueda_3dpid !== false || $busqueda_3dpid2 !== false){
                                $this->calc_link = 1;

                                if($busqueda_3dpid !== false)$pid_3d_detect_com= strpos($this->search, 'pid%3d');
                                else $pid_3d_detect_com= strpos($this->search, 'PID%3d');

                                $posicion_pid_3d = $pid_3d_detect_com + 6;
                                $i3d = 0;
                                $busq_pid_3d = 0;
                                    
                                    do{
                                        $detect3d= substr($this->search, $posicion_pid_3d,1);
                
                                        if($detect3d == '%') $i3d = 1;
                                        else{
                                            $i3d = 0;
                                            $posicion_pid_3d = $posicion_pid_3d + 1;
                                            $busq_pid_3d ++;
                                        }

                                        if($busq_pid_3d > 13){
                                            $i3d = 1;
                                        }
                
                                    }while($i3d != 1);

                                    if($busq_pid_3d < 13){
                                        $pid_3d= substr($this->search,($pid_3d_detect_com + 6),($posicion_pid_3d - ($pid_3d_detect_com + 6)));
                                        
                                    }
                                    else{
                                        $pid_3d = substr($this->search,($pid_3d_detect_com + 6),8);
                                    }

                                    $jumper_complete = 'http://dkr1.ssisurveys.com/projects/end?rst=1&med=&campaignID=66155&targetID=1375&hash=rkkJJodM4gFniQrnFz3oAw%2blStE%3d&LOI=7269&buyID=286602&psid='.$psid_3d.'**&pid='.$pid_3d.'&k2=';
                                }
                        
                        }
                    }

                    else{
            
                        if($jumper->jumper_type_id == 1){
                        
                            $this->is_basic = "si";
                            $this->calc_link = 1;
                            if($jumper->psid == 'j1nB1') $jumper_complete = 'https://dkr1.ssisurveys.com/projects/end?rst=1&psid='.$psid_complete.'**&basic='.$jumper->basic.'&psid=j1nB';
                            
                             /*   if($jumper->psid == 'aAC6g'){
                                if(session('pid')) $jumper_complete = 'https://dkr1.ssisurveys.com/projects/end?rst=1&psid='.session('pid').'**&basic=34334';
                                else $jumper_complete = 'https://dkr1.ssisurveys.com/projects/end?rst=1&psid=(QUITA LOS PARENTESIS QUE RODEA ESTA FRASE Y COLOCA TU PID)**&basic=34334';
                            }*/

                            elseif($jumper->psid == '1kY7h'){
                                if(session('pid'))
                                $jumper_complete = 'https://dkr1.ssisurveys.com/projects/end?rst=1&psid='.$psid_complete.'**&basic=80256&mid='.session('pid');
                                else 'https://dkr1.ssisurveys.com/projects/end?rst=1&psid='.$psid_complete.'**&basic=80256&mid=(QUITA LOS PARENTESIS QUE RODEA ESTA FRASE Y COLOCA TU PID)';
                            }

                            else{
                               
                                if($jumper->id_id == 2){
                                    $jumper_complete = 'https://dkr1.ssisurveys.com/projects/end?PSID='.$psid_complete.'%2A%2A&basic='.$jumper->basic.'&pe_ses_key=PSID&psid='.$psid_complete.'%2A%2A&rst=1';
                                }
                                elseif($jumper->id_id == 3){
                                    $jumper_complete = 'https://api.dynata.com/respondent/exit?rst=1&pe_ses_key=PSID&PSID='.$psid_complete.'**&basic='.$jumper->basic;
                                }
                                else{
                                    $jumper_complete = 'https://dkr1.ssisurveys.com/projects/end?rst=1&psid='.$psid_complete.'**&basic='.$jumper->basic;
                                }
                            }

                            session()->forget('search');

                        } 
                                    
                        if($jumper->jumper_type_id == 2){
                            $this->is_high = "si"; 
                            if(session('pid')){
                                $this->calc_link = 1;
                                $this->pid_new = session('pid');
                                $calculo_high_new = $this->calculo_high($jumper->id);
                                $jumper_complete = 'https://dkr1.ssisurveys.com/projects/end?rst=1&psid='.$psid_complete.'**&high='.$calculo_high_new;
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
                                    if($busqueda_pid6 !== false){
                                        $pid_detect_com= strpos($this->search, '&id=');
                                        $posicion_pid = $pid_detect_com + 4;
                                        $pid_calculate = $pid_detect_com + 4;
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
                                                $this->pid_new = substr($this->search,($pid_calculate),($posicion_pid - ($pid_calculate)));
                                            else $this->pid_new = 0;
                                            
                                        }
                                        else{
                                            if(is_numeric(substr($this->search,($pid_calculate),11)))
                                                $this->pid_new = substr($this->search,($pid_calculate),11);
                                            else $this->pid_new = 0;
                                        }
    
                                        $this->calc_link = 1;
                                        $calculo_high_new = $this->calculo_high($jumper->id);
                                        $jumper_complete = 'https://dkr1.ssisurveys.com/projects/end?rst=1&psid='.$psid_complete.'**&high='.$calculo_high_new;

                                    }

                                }


                                if($this->calc_link == 0){

                                    $jumper_complete = 'Ingrese su PID para calcular el valor high';
                                }
                                else{
                                    $this->calc_link = 1;
            
                                    $jumper_complete = 'https://dkr1.ssisurveys.com/projects/end?rst=1&psid='.$psid_complete.'**&high='.$this->calculo_high;
                                }
                            }
                            session()->forget('search');
                        } 
                        $this->jumper_redirect = [];
                    }
                } 

                else {
                    if($nuevo_basic_registrado != 0 || $nuevo_high_registrado != 0){

                        if($nuevo_high_registrado == 2) $this->comment_new_psid_register = 'Registra tu PID en el recuadro azul que esta sobre este mensaje, y vuelve a pegar el link en nuestro buscador, para guardar el high';
                        else $this->comment_new_psid_register = '¡Gracias!, el Psid '.$this->psid_register_bh. ' ha sido registrado exitosamente';
                    
                    }
                    else{
                        $url_detect_com= strpos($this->search, 'http');
                        $url_detect_com2= strpos($this->search, 'https');

                        if($url_detect_com !== false || $url_detect_com2 !== false){

                            if($url_detect_com2 !== false) {
                                $con_seguridad= strpos($this->search, 'https');
                                $posicion_url = 8;
                            }
                            else {
                                $con_seguridad= strpos($this->search, 'http');
                                $posicion_url = 7;
                            }

                            $i = 0;
                            
                            do{
                                $detect= substr($this->search, $posicion_url,1);

                                if($detect == '/') $i = 1;
                                else{
                                    $i = 0;
                                    $posicion_url = $posicion_url + 1;
                                }

                            }
                            while($i != 1);

                            if($url_detect_com2 !== false){

                                $url_detect = 'https://'.substr($this->search,8,($posicion_url-8));
                            }

                            else{
                                $url_detect = 'https://'.substr($this->search,7,($posicion_url-7));
                            }


                            $k_detect= strpos($this->search, '_k=');
                            $k_detect2= strpos($this->search, '_K=');

                            if($k_detect != false || $k_detect2 != false){
                                if ($k_detect != false) $this->posicionk = $k_detect + 3;
                                else $this->posicionk = $k_detect2 + 3;

                                $ik = 0;
                                $busq_pid_s = 0;
                            
                                    do{
                                        $detectk= substr($this->search, $this->posicionk,1);
                                        
                                        if($detectk == '&') $ik = 1;
                                        else{
                                            $ik = 0;
                                            $this->posicionk = $this->posicionk + 1;
                                            $busq_pid_s ++;
                                        }

                                        if($busq_pid_s > 13){
                                            $ik = 1;
                                        }
                                    }
                                    while($ik != 1);

                                    if($busq_pid_s < 13){
                                        $this->posicion_total_k = $this->posicionk -  ($k_detect + 3);

                                    }
                                    else{
                                        $this->posicion_total_k = 5;
                                    }

                                    //dd(substr($this->search,($k_detect + 3),$this->posicion_total_k));

                                    if((substr($this->search,($k_detect + 3),$this->posicion_total_k)) == '1000') $type_k = 5;
                                    elseif((substr($this->search,($k_detect + 3),$this->posicion_total_k)) == '1092') $type_k = 6;
                                    elseif((substr($this->search,($k_detect + 3),$this->posicion_total_k)) == '2062') $type_k = 7;
                                    elseif((substr($this->search,($k_detect + 3),$this->posicion_total_k)) == '23') $type_k = 8;
                                    elseif((substr($this->search,($k_detect + 3),$this->posicion_total_k)) == '7341') $type_k = 9;
                                    elseif((substr($this->search,($k_detect + 3),$this->posicion_total_k)) == '1098') $type_k = 16;
                                    elseif((substr($this->search,($k_detect + 3),$this->posicion_total_k)) == '3203') $type_k = 17;
                                    elseif((substr($this->search,($k_detect + 3),$this->posicion_total_k)) == '3906') $type_k = 18;
                                    elseif((substr($this->search,($k_detect + 3),$this->posicion_total_k)) == '11052') $type_k = 19;
                                    elseif((substr($this->search,($k_detect + 3),$this->posicion_total_k)) == '15293') $type_k = 20;
                                    elseif((substr($this->search,($k_detect + 3),$this->posicion_total_k)) == '17564') $type_k = 21;
                                    elseif((substr($this->search,($k_detect + 3),$this->posicion_total_k)) == '2066') $type_k = 22;
                                    elseif((substr($this->search,($k_detect + 3),$this->posicion_total_k)) == '2001') $type_k = 23;
                                    else  $type_k = 15;

                            }

            
                            if($url_detect != 'https://dkr1.ssisurveys.com'){
                             

                                if($subs_psid != 'no_existe_psid_error_volver_a_intentar&&..'){

                               
                                    $link = new Link();
                                    if($url_detect != 'https://online.ssisurveys.com') $link->jumper = $url_detect;
                                    $link->psid = $subs_psid;
                                    $link->user_id = auth()->user()->id;
                                    if($k_detect != false || $k_detect2 != false){
                                        $link->k_detected = 'K='.substr($this->search,($k_detect + 3),$this->posicion_total_k);
                                        $link->jumper_type_id = $type_k;
                                    }
                                    else{
                                        $link->jumper_type_id = 15;
                                    }
                                    $link->save();

                                    if($url_detect != 'https://online.ssisurveys.com') $this->jumper_detect = $url_detect;

                                    if($this->jumper_detect){
                                        $router_cint_detect= strpos($this->jumper_detect, 'router.cint.com');
                                        if($router_cint_detect !== false) $this->router_cint_detect = 1;
                                    }

                                    //$jumper = Link::get()->last();

                                    $jumper = Link::where('id',$link->id)->first();

                                    //////falta optimizar

                                    $this->jumper_2 = '1';
                        
                                    $user_point= User_Links_Points::where('link_id',$jumper->id)
                                        ->where('user_id',$this->user_auth)
                                        ->first();
                                                    
                                    $comments = Comments::where('link_id',$jumper->id)
                                        ->latest('id')
                                        ->paginate(5);
                                                    
                                        if($user_point) {
                                            if($user_point->point == 'positive'){
                                                $this->points_user_positive='si';
                                                $this->points_user_negative='no';
                    
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
                                        

                                    if((strpos($this->search, 'psid%3d') != false)){
                 
                                        if((strpos($this->search, '**') != false)){
                                            $this->calc_link = 1;
                
                                            $busq= strpos($this->search, '**');
                                            $psid_3d = substr($this->search,($busq - 22),22);
                
                                            $busqueda_3dpid= strpos($this->search, 'pid%3d');
                                            $busqueda_3dpid2= strpos($this->search, 'PID%3d');
                
                                            if($busqueda_3dpid !== false || $busqueda_3dpid2 !== false){
                                                $this->calc_link = 1;
                
                                                if($busqueda_3dpid !== false)$pid_3d_detect_com= strpos($this->search, 'pid%3d');
                                                else $pid_3d_detect_com= strpos($this->search, 'PID%3d');
                
                                                $posicion_pid_3d = $pid_3d_detect_com + 6;
                                                $i3d = 0;
                                                $busq_pid_3d = 0;
                                                    
                                                    do{
                                                        $detect3d= substr($this->search, $posicion_pid_3d,1);
                                
                                                        if($detect3d == '%') $i3d = 1;
                                                        else{
                                                            $i3d = 0;
                                                            $posicion_pid_3d = $posicion_pid_3d + 1;
                                                            $busq_pid_3d ++;
                                                        }
                
                                                        if($busq_pid_3d > 13){
                                                            $i3d = 1;
                                                        }
                                
                                                    }while($i3d != 1);
                
                                                    if($busq_pid_3d < 13){
                                                        $pid_3d= substr($this->search,($pid_3d_detect_com + 6),($posicion_pid_3d - ($pid_3d_detect_com + 6)));
                                                        
                                                    }
                                                    else{
                                                        $pid_3d = substr($this->search,($pid_3d_detect_com + 6),8);
                                                    }
                
                                                    $jumper_complete = 'http://dkr1.ssisurveys.com/projects/end?rst=1&med=&campaignID=66155&targetID=1375&hash=rkkJJodM4gFniQrnFz3oAw%2blStE%3d&LOI=7269&buyID=286602&psid='.$psid_3d.'**&pid='.$pid_3d.'&k2=';
                                                }
                                        
                                        }
                                    }

                                    else{
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
                            $busqueda_psid_qt = strpos($this->search, 'psid');

                            if($busqueda_psid_qt !== false){
                                $subs_psid = substr($this->search,($busqueda_psid_qt + 5),5);

                                $link = new Link();
                                $link->psid = $subs_psid;
                                $link->user_id = auth()->user()->id;
                                $link->jumper_type_id = 15;
                                $link->save();

                                $jumper = Link::where('id',$link->id)->first();

                                //$jumper = Link::get()->last();

                                $user_point= User_Links_Points::where('link_id',$jumper->id)
                                        ->where('user_id',$this->user_auth)
                                        ->first();
                                                    
                                $comments = Comments::where('link_id',$jumper->id)
                                        ->latest('id')
                                        ->paginate(5);
                                                    
                                if($user_point) {
                                    if($user_point->point == 'positive'){
                                        $this->points_user_positive='si';
                                        $this->points_user_negative='no';
                    
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
                                

                                $this->jumper_2 = '1';
                            }
                            else $this->no_detect = 1;
                            
                        }

                        
                    }
                }
                
        }
        
        else{
            $this->jumper_2 = '';
            $this->is_basic = 'no';
            $this->is_high = 'no';
            $this->calc_link = 0;
           // $this->jumper_complete_qt = '';
        }

       //session()->forget('search');
        return view('livewire.jumpers.ssidkr.ssidkr-index',compact('jumper_complete','jumper','comments','subs_psid'));
    }

    public function descalificador(){
        $this->emit('descalific');
    }

    public function descalificar($type){

        $this->calc_link = 0;
        $this->type = $type;
        $long_psid = strlen($this->search); //buscando cuantos caracteres tiene en total

        if($long_psid>=32){

            if($long_psid==32){
                $psid_detect = $this->search;
            }

            else{
                $busqueda_psid = strpos($this->search, 'psid=');
        
                if($busqueda_psid !== false){
                  /*  $i = 0;
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
                    }*/
                    $psid_detect = substr($this->search,$busqueda_psid);
                }
                else{
                    $this->emit('error','Algo en su link no esta bien. Copielo correctamente');  
                }
            }
            

            $client = new Client([
                // 'base_uri' => 'http://127.0.0.1:8000',
                'base_uri' => 'http://146.190.74.228/',
            ]);

        
            if($this->type[0] == 'usa')
                $resultado = $client->request('GET', '/Descalificador_usa/1/'.$psid_detect);
            else
                $resultado = $client->request('GET', '/Descalificador_uk/1/'.$psid_detect);

            if($resultado->getStatusCode() == 200){
                $this->emit('alert','Descalificación procesada');
                $this->descalific_active = 1;
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

    public function qt(){
        $this->search = trim($this->search); //quitando espacios en blancos al inicio y final
        $long_psid = strlen($this->search); //buscando cuantos caracteres tiene en total

        if($long_psid>=30){

            if($long_psid<33){
                $link_complete = $this->search;
                $this->jumper_complete_qt='https://dkr1.ssisurveys.com/projects/pstart?psid='.$link_complete.'&subpanelid=38';
            }
            else{

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
                        $this->jumper_complete_qt='https://dkr1.ssisurveys.com/projects/pstart?psid='.$url_complete.'&subpanelid=38';
                }

            }

        }
    }

    public function sp(){
        $this->search = trim($this->search); //quitando espacios en blancos al inicio y final
        $long_psid = strlen($this->search); //buscando cuantos caracteres tiene en total

        if($long_psid>=22){

            if($long_psid==22){
                $link_complete = $this->search;
                $this->jumper_complete_sp = 'https://dkr1.ssisurveys.com/projects/end?rst=4&psid='.$link_complete.'**';
            }
            else{
                $busqueda_id= strpos($this->search, '**');

                if(($busqueda_id !== false)){
                                
                    $subs_psid_sin_cortar = substr($this->search,($busqueda_id - 22),22);
                                
                    if(session('psid'))$psid_complete = substr($subs_psid_sin_cortar,0,11).substr(session('psid'),11,11);
                    else  $psid_complete = substr($subs_psid_sin_cortar,0,22);

                    $this->jumper_complete_sp = 'https://dkr1.ssisurveys.com/projects/end?rst=4&psid='.$psid_complete.'**';
                }

                else{
                    if((strpos($this->search, 'psid=') !== false)){

                        $detectado= strpos($this->search, 'psid=');

                        $posicion = $detectado+27;

                        if(session('psid'))$psid_complete = substr($this->search,$detectado+5,(($posicion - ($detectado+5))-1)).substr(session('psid'),21,1);
                        else  $psid_complete = substr($this->search,$detectado+5,($posicion - ($detectado+5)));

                        $this->jumper_complete_sp = 'https://dkr1.ssisurveys.com/projects/end?rst=4&psid='.$psid_complete.'**';
                    }

                }

                

            }

        }
    }

    public function registro_psid(){

        //dd($this->psid_detectado);

        session(['psid' =>  $this->psid_detectado]);
        $this->psid_register = session('psid');


        //BUSCANDO PID Y AGREGANDOLO

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
            //dd('ok
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
            if($busqueda_pid8 !== false){
                $pid_detect_com= strpos($this->search, '?PID=');
                $posicion_pid = $pid_detect_com + 5;
                $pid_calculate = $pid_detect_com + 5;
                $cont_pid++;
            }
            if($busqueda_pid9 !== false){
                $pid_detect_com= strpos($this->search,'?pid=');
                $posicion_pid = $pid_detect_com + 5;
                $pid_calculate = $pid_detect_com + 5;
                $cont_pid++;
            }
            if($busqueda_pid10 !== false){
                $pid_detect_com= strpos($this->search,'fill?1=');
                $posicion_pid = $pid_detect_com + 7;
                $pid_calculate = $pid_detect_com + 7;
                $cont_pid++;
            }
            if($busqueda_pid6 !== false){
                $pid_detect_com= strpos($this->search, '&id=');
                $posicion_pid = $pid_detect_com + 4;
                $pid_calculate = $pid_detect_com + 4;
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
                    session(['pid' => substr($this->search,($pid_calculate),($posicion_pid - ($pid_calculate)))]);

                    /*$posicion_total_pid = $this->posicionpid - ($busqueda_pid_search + 4);
                    $valor_pid= substr($this->search,($busqueda_pid_search + 4),$posicion_total_pid);
                    if(is_numeric($valor_pid)) session(['pid' => substr($this->search,($busqueda_pid_search + 4),$posicion_total_pid)]);*/
                }
                else{

                    if(is_numeric(substr($this->search,($pid_calculate),11)))
                        session(['pid' => substr($this->search,($pid_calculate),11)]);


                    /*$valor_pid= substr($this->search,($busqueda_pid_search + 4),8);
                    if(is_numeric($valor_pid)) session(['pid' => substr($this->search,($busqueda_pid_search + 4),8)]);*/
                }

            }
            
        }

        //TERMINANDO DE AGREGAR EL PID

        session(['search' =>  $this->search]);

        return redirect()->route('ssidkr.index');

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

    public function comentar($jumper_id){

        if($this->comentario != ''){
            $jumper_id = Link::where('id',$jumper_id)->first();
            $comment = new Comments();
            $comment->comment = $this->comentario;
            $comment->link_id = $jumper_id->id;
            $comment->user_id = auth()->user()->id;
            $comment->save();

            $this->reset(['comentario']);
           // $this->emit('render', 'jumpers.ssidkr.ssidkr-index');
        }
    }

    public function calculo_high($jumper_id){
        $rules_pid = $this->rules_pid;
        $this->validate($rules_pid);

        $jumper_id = Link::where('id',$jumper_id)->first();
        $this->calculo_high = $jumper_id->high - ($jumper_id->pid - $this->pid_new) * round(($jumper_id->high / $jumper_id->pid),0);
        $this->calc_link = 1;
        return $this->calculo_high;
    }

    public function registro_basic(){

    $jumper_detect_basic = Link::where('psid',$this->psid_register_bh)->first();

       if($jumper_detect_basic){
            $jumper_detect_basic->update([
                'basic' => $this->basic_register_bh,
                'user_id' => auth()->user()->id,
                'jumper_type_id' => 1,
                'id_id' => $this->type_basic,
            ]);
       }
       else{
            $link = new Link();
            $link->basic = $this->basic_register_bh;
            $link->psid = $this->psid_register_bh;
            $link->user_id = auth()->user()->id;
            $link->jumper_type_id = 1;
            $link->id_id = $this->type_basic;
            $link->save();
       }

       $this->emit('alert','Datos registrados correctamente');
    }

    public function registro_high(){

        $jumper_detect_high = Link::where('psid',$this->psid_register_bh)->first();

        if($jumper_detect_high){
             $jumper_detect_high->update([
                'high' => $this->high_register_bh,
                'pid' => $this->pid_register_high,
                'user_id' => auth()->user()->id,
                'jumper_type_id' => 2,
             ]);
        }
        else{
            $link = new Link();
            $link->high = $this->high_register_bh;
            $link->psid = $this->psid_register_bh;
            $link->pid = $this->pid_register_high;
            $link->user_id = auth()->user()->id;
            $link->jumper_type_id = 2;
            $link->save();
        }

        $this->emit('alert','Datos registrados correctamente');
    }

    public function clear(){
        $this->reset(['search']);
        $this->jumper_complete_qt = '';
        $this->jumper_complete_sp = '';
        session()->forget('search');
        $this->descalific_active = 0;
        $this->router_cint_detect = 0;
    }
}
