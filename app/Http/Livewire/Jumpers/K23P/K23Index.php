<?php

namespace App\Http\Livewire\Jumpers\K23P;

use App\Models\Antibot;
use App\Models\Comments;
use App\Models\CuentasPsid;
use App\Models\Link;
use App\Models\Links_usados;
use App\Models\RecargaLink;
use App\Models\User;
use App\Models\User_Links_Points;
use DateTime;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class K23Index extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public $limit, $recargas_user_dia,$canj=0,$total_jump_dia,$psid_buscar,$user,$operacion,$jumper_complete = [],$jumper_list = 0,$busqueda_link,$comment_new_psid_register,$pid_register_high,$psid_register_bh,$high_register_bh,$basic_register_bh,$posicionpid,$psid_detectado,$posicion_total_k,$posicionk,$no_jumpear,$posicion, $no_detect = '0', $jumper_detect = 0, $k_detect = '0', $wix_detect = '0', $psid_register=0,$jumper_redirect,$link_complete_2,$calculo_high = 0,$pid_new=0,$search,$jumper_2,$points_user,$user_auth,$comentario,$is_high,$is_basic,$calc_link,$jumper_select,$points_user_positive, $points_user_negative, $jumper_detect_k ='',$pid_manual,$pid_detectado = 'si',$pid_buscar ;

    protected $listeners = ['render' => 'render', 'registro_psid' => 'registro_psid','verific' => 'verific', 'confirmacion' => 'confirmacion'];
    
    public function mount(){
        $this->user_auth =  auth()->user()->id;
        $this->points_user='no';
        if(session('pid')) $this->pid_new = session('pid');
        if(session('psid')) $this->psid_register = session('psid');
        if(session('search')) $this->search = session('search');
        $this->jumper_detect = 0;
        $this->jumper_list = 0;
        $this->busqueda_link = "";

        $this->user = User::where('id',auth()->user()->id)->first();

        if($this->user->id == '2' || $this->user->id == '1345') $this->limit = 59;
       // elseif($this->user->id == '6' || $this->user->id == '55' || $this->user->id == '1885') $this->limit = 9;
        else $this->limit = 19;
    }

    protected $rules_pid = [
        'pid_manual' => 'required|min:6',
    ];

    public function jumpear(){

        if($this->jumper_detect == 0){
            $rules_pid = $this->rules_pid;
            $this->validate($rules_pid);

            $this->pid_buscar = $this->pid_manual;

            $link_register_search = Links_usados::where('link',$this->search)
            ->where('k_detected','K=23_NEW')
            ->where('user_id',$this->user->id)
            ->count();
    

            if($link_register_search >= 1){

                $this->jumper_detect = 7;
                
            }
            else{
            
                $date = new DateTime();

                if($this->user->ip) $multi = $this->user->ip;
                else{
                    $this->user->update([
                        'ip'=> request()->ip(),
                    ]);

                    $multi = $this->user->ip;
                }

                $ip_user = request()->ip();

                $date_actual= $date->format('Y-m-d');
                //$date_actual_30 = $date->modify('-30 minute')->format('Y-m-d H:i:s');

                $links_usados = Links_usados::where('k_detected','K=23_NEW')
                    ->where('user_id',$this->user->id)
                    ->wheredate('created_at',$date_actual)
                    ->count();

                if($links_usados <= $this->limit){
                    if($this->user->id != '1' && $this->user->id !='1254' && $this->user->id != '154' && $this->user->id != '30' && $this->user->id != '1836' && $this->user->id != '1820'){
                        if($multi == $ip_user){
                            $this->numerologia();
                        }

                        else{
                            $this->jumper_detect = 8;
                        }
                    }
                    else{
                        $this->numerologia();
                    }
                }
                else{
                    $alertas = $this->user->cant_links_jump_alert + 1;
                    $this->user->update(['cant_links_jump_alert'=>$alertas]);
                    $this->jumper_detect = 6;
                }
            }
        }
    }

    public function numerologia(){

        $cant = Antibot::count();
        $random = rand(1,$cant);
        $this->operacion = Antibot::where('id',$random)->first();
        $operacion_total = 'Resuelve esta operación matemática ('.$this->operacion->nro1.' + '.$this->operacion->nro2. ')';

        $this->emit('numerologia',$operacion_total,'jumpers.k23-p.k23-index','verific');

    }

    public function verific($result){

        if($result[0] == $this->operacion->resultado){

            if($this->pid_manual){
                $this->pid_buscar = $this->pid_manual;
            }

            
            $busqueda_selfserver= strpos($this->search, 'selfserve/');

                if($busqueda_selfserver != false){

                                $posicion_elem1 = $busqueda_selfserver + 10;
                                $i_elem1 = 0;
                                $busq_elem1 = 0;
                                
                                do{
                                    $detect_elem1= substr($this->search, $posicion_elem1,1);
            
                                    if($detect_elem1 == '/' || $detect_elem1 == '&' || $detect_elem1 == '?') $i_elem1 = 1;
                                    else{
                                        $posicion_elem1 = $posicion_elem1 + 1;
                                        $busq_elem1 ++;
                                    }

                                    if($busq_elem1 > 200){
                                        $i_elem1 = 1;
                                    }
            
                                }while($i_elem1 != 1);

                                $elem1 = substr($this->search,($busqueda_selfserver + 10),($posicion_elem1 - ($busqueda_selfserver + 10)));

                                if($detect_elem1 == '/'){
                                    $posicion_elem2 = $posicion_elem1 + 1;
                                    $i_elem2 = 0;
                                    $busq_elem2 = 0;

                                    do{
                                        $detect_elem2= substr($this->search, $posicion_elem2,1);
                
                                        if($detect_elem2 == '/' || $detect_elem2 == '&' || $detect_elem2 == '?') $i_elem2 = 1;
                                        else{
                                            $posicion_elem2 = $posicion_elem2 + 1;
                                            $busq_elem2 ++;
                                        }

                                        if($busq_elem2 > 200){
                                            $i_elem2 = 1;
                                        }
                
                                    }while($i_elem2 != 1);

                                    $elem2 = substr($this->search,($posicion_elem1 + 1),($posicion_elem2 - ($posicion_elem1 + 1)));

                                    if($detect_elem2 == '/'){
                                    
                                        $posicion_elem3 = $posicion_elem2 + 1;
                                        $i_elem3 = 0;
                                        $busq_elem3 = 0;

                                        do{
                                            $detect_elem3= substr($this->search, $posicion_elem3,1);
                    
                                            if($detect_elem3 == '/' || $detect_elem3 == '&' || $detect_elem3 == '?') $i_elem3 = 1;
                                            else{
                                                $posicion_elem3 = $posicion_elem3 + 1;
                                                $busq_elem3 ++;
                                            }

                                            if($busq_elem3 > 200){
                                                $i_elem3 = 1;
                                            }
                    
                                        }while($i_elem3 != 1);

                                        $elem3 = substr($this->search,($posicion_elem2 + 1),($posicion_elem3 - ($posicion_elem2 + 1)));
                                    }

                                    else{
                                        $elem3 = 0;
                                    }
                                }

                                else{
                                    $elem2 = 0;
                                }
                                

                            
                }

                $busqueda_id= strpos($this->search, '**');

                if(session('psid')) $psid_buscar = substr($this->search,($busqueda_id - 22),11).substr(session('psid'),11,11);
                else $psid_buscar = substr($this->search,($busqueda_id - 22),22);

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

                                if($busq_ids_s > 100){
                                    $i_ids = 1;
                                }
        
                            }while($i_ids != 1);

                            if($busq_ids_s < 100)
                                $ids_buscar = substr($this->search,($busqueda_ids + 4),($posicion_ids - ($busqueda_ids + 4)));

                            else
                                //$this->ids_buscar = substr($this->search,($busqueda_ids + 4),20);
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

                                if($busq_k2_s > 100){
                                    $i_k2 = 1;
                                }
        
                            }while($i_k2 != 1);



                            if($busq_k2_s < 100)
                                $k2_buscar = substr($this->search,($busqueda_k2 + 4),($posicion_k2 - ($busqueda_k2 + 4)));

                            else
                                //$this->ids_buscar = substr($this->search,($busqueda_ids + 4),20);
                                $this->jumper_detect = 3;
                }

                $busqueda_hash= strpos($this->search, 'k=23&_s=');


                if($busqueda_hash != false){
                    $hash_buscar = substr($this->search,($busqueda_hash + 8 ));
                }
                else{
                    $this->jumper_detect = 3;
                }

                $pid_buscar_def = substr($this->pid_buscar, 0, 6).rand(1101,9909);

                $busqueda_chanel= strpos($this->search, 'hannel=');

                if($busqueda_chanel != false){

                    $posicion_chanel = $busqueda_chanel + 7;
                    $i_chanel = 0;
                    $busq_chanel_s = 0;
                            
                    do{
                        $detect_chanel= substr($this->search, $posicion_chanel,1);
        
                        if($detect_chanel == '&') $i_chanel = 1;
                        else{
                            $posicion_chanel = $posicion_chanel + 1;
                            $busq_chanel_s ++;
                        }

                        if($busq_chanel_s > 100){
                            $i_chanel = 1;
                        }
        
                        }while($i_chanel != 1);

                    if($busq_chanel_s < 100)
                        $chanel_buscar = substr($this->search,($busqueda_chanel + 7),($posicion_chanel - ($busqueda_chanel + 7)));

                    else
                        //$this->ids_buscar = substr($this->search,($busqueda_ids + 4),20);
                        $this->jumper_detect = 3;
                }
                else{
                    $chanel_buscar = '2';
                }

            try {

                $client = new Client([
                    //'base_uri' => 'http://127.0.0.1:8000',
                    'base_uri' => 'http://147.182.190.233',
                ]);



                    if($elem3 == 0){
            
                         $resultado = $client->request('GET', '/k23_s2_k2_imperium/1/'.$ids_buscar.'/'.$psid_buscar.'/'.$k2_buscar.'/'.$chanel_buscar.'/'.$pid_buscar_def.'/'.$elem1.'/'.$elem2);
                        
                     
                    }
                    else{
                        $resultado = $client->request('GET', '/k23_s2_k2_imperium/1/'.$ids_buscar.'/'.$psid_buscar.'/'.$k2_buscar.'/'.$chanel_buscar.'/'.$pid_buscar_def.'/'.$elem1.'/'.$elem2.'/'.$elem3);
                       
                    }



                if($resultado->getStatusCode() == 200){

                    $this->jumper_complete = json_decode($resultado->getBody(),true);

                    $link_register = new Links_usados();
                    $link_register->link = $this->search;
                    $link_register->link_resultado = $this->jumper_complete['jumper'];
                    $link_register->k_detected  = 'K=23_NEW';
                    $link_register->user_id  = $this->user->id;
                    $link_register->save();

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
                            $link->psid = substr($psid_buscar,0,5);
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
            }

            catch (\GuzzleHttp\Exception\RequestException $e) {

                $error['error'] = $e->getMessage();
                $error['request'] = $e->getRequest();

                if($e->hasResponse()){
                    if ($e->getResponse()->getStatusCode() !== '200'){
                        $error['response'] = $e->getResponse(); 
                        $this->jumper_detect = 5;
                    }
                }
            }

        }

        else{

            $this->reset(['operacion']);

           $this->emit('error','Resultado incorrecto, intentalo de nuevo');
       
        }
    }

    public function render()
    {
        $subs_psid = '0';
       
        $comments =0;
        $jumper = "";
        $link_complete="";
        $psid_buscar = "";
        $this->pid_buscar = "";
        $busqueda_link_def = "";
     
        $this->no_jumpear = 0;
       // $this->jumper_detect = 0;
        $this->points_user='no';
        $this->no_detect = '0';
        $this->k_detect = '0';
        $this->comment_new_psid_register = '';
        $this->posicion = 8; //me esta buscand a partir de https://

        $this->search = trim($this->search); //quitando espacios en blancos al inicio y final
        $long_psid = strlen($this->search); //buscando cuantos caracteres tiene en total

        $date = new DateTime();
        $date_actual= $date->format('Y-m-d');

        $this->total_jump_dia = Links_usados::where('k_detected','K=23_NEW')
            ->where('user_id',$this->user->id)
            ->whereDate('created_at',$date_actual)
            ->count();

        if($this->total_jump_dia == 10) {
            if($this->user->balance >= 1) {
                $this->recargas_user_dia=RecargaLink::where('user_id',$this->user->id)
                    ->where('k','K=23_NEW')
                    ->whereDate('created_at',$date_actual)
                    ->count();
                        
                if($this->recargas_user_dia <= 1) $this->canj = 1;
            }
        }


        if($long_psid>=5){

            $busqueda_k23_ = strpos($this->search, 'k=23&');

            if($busqueda_k23_ !== false){

                        $busqueda_id= strpos($this->search, '**');

                        if(session('psid')) $this->psid_buscar = substr($this->search,($busqueda_id - 22),11).substr(session('psid'),11,11);
                        else $this->psid_buscar = substr($this->search,($busqueda_id - 22),22);

             

                        $psid_save_total  = substr($this->search,($busqueda_id - 5),5);

                        $buscar_psid_user = CuentasPsid::where('user_id',Auth::id())
                            ->where('psid',$psid_save_total)->count();
                            
                        if($buscar_psid_user == 0){
                            $psid_user_register= new CuentasPsid();
                            $psid_user_register->user_id = Auth::id();
                            $psid_user_register->psid = $psid_save_total;
                            $psid_user_register->save();
                        }

                        $busqueda_k2= strpos($this->search, '&K2=');

                        if($busqueda_k2 === false){
                            $this->jumper_detect = 3;
                        }

                        else{
                            $busqueda_selfserver= strpos($this->search, 'selfserve/');

                            if($busqueda_selfserver != false){

                                $posicion_elem1 = $busqueda_selfserver + 10;
                            
                            }

                            else{

                                $this->jumper_detect = 3;
                            }

                            


                            $busqueda_chanel= strpos($this->search, 'hannel=');

                            if($busqueda_chanel != false){
                                $posicion_chanel = $busqueda_chanel + 7;
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
                                                else {

                                                    $this->pid_detectado = 'no';
                                                
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
                                                }
                                            
                                        }
                                        else{
                                            if(is_numeric(substr($this->search,($pid_calculate),11)))
                                                $this->pid_buscar = substr($this->search,($pid_calculate),11);
                                                else {

                                                    $this->pid_detectado = 'no';
                                                
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
                                }
                            }

        
                            if($this->jumper_detect == 0 && $this->pid_detectado == 'si'){

                                if($this->jumper_list == 0){

                                    if($this->jumper_detect == 0){

                                            if($this->jumper_list == 0){
                
                                                $link_register_search = Links_usados::where('link',$this->search)
                                                ->where('k_detected','K=23_NEW')
                                                ->where('user_id',$this->user->id)
                                                ->count();
                                        
            
                                            if($link_register_search >= 1){
            
                                                $this->jumper_detect = 7;
                                                
                                            }
                                            else{
                                            
                                                $date = new DateTime();

                                                if($this->user->ip) $multi = $this->user->ip;
                                                else{
                                                    
                                                        $this->user->update([
                                                            'ip'=> request()->ip(),
                                                        ]);
        
                                                        $multi = $this->user->ip;

                                                    
                                                    
                                                }

                                                $ip_user = request()->ip();
            
                                                $date_actual= $date->format('Y-m-d');
                                                //$date_actual_30 = $date->modify('-30 minute')->format('Y-m-d H:i:s');

                                                $links_usados = Links_usados::where('k_detected','K=23_NEW')
                                                    ->where('user_id',$this->user->id)
                                                    ->wheredate('created_at',$date_actual)
                                                    ->count();
            
                                                if($links_usados <= $this->limit){
                                                    if($this->user->id != '1' && $this->user->id != '1254' && $this->user->id != '154' && $this->user->id != '30' && $this->user->id != '1836' && $this->user->id != '1820'){
                                                        if($multi == $ip_user){
                                                            $this->numerologia();
                                                        }
                                                    
                                                        else{
                                                            $this->jumper_detect = 8;
                                                        }
                                                    }
                                                    else{
                                                        $this->numerologia();
                                                    }
                                                }
                                                else{
                                                    $alertas = $this->user->cant_links_jump_alert + 1;
                                                    $this->user->update(['cant_links_jump_alert'=>$alertas]);
                                                    $this->jumper_detect = 6;
                                                }
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

                            if($this->jumper_detect == 1){
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

                session()->forget('search');
        
        
        
        
            }

            else{
                $this->jumper_detect = 3;
            }
        }
        
        else{
            $this->calc_link = 0;
        }
        return view('livewire.jumpers.k23-p.k23-index',compact('jumper','comments','subs_psid','busqueda_link_def'));
    }

    public function canjear(){
        if($this->total_jump_dia == 10) {
            if($this->user->balance >= 1) {
                if($this->recargas_user_dia <= 1){
                    $this->emit('canjear', '¿Esta seguro de realizar el canje?','jumpers.k23-p.k23-index','confirmacion','El caje se ha realizado');
                }
            }
        }
    }

    public function confirmacion(){

        $date = new DateTime();
        $date_actual= $date->format('Y-m-d');

        $jumpers = Links_usados::where('k_detected','K=23_NEW')
            ->where('user_id',$this->user->id)
            ->whereDate('created_at',$date_actual)
            ->take('5')
            ->delete();

        $balance = $this->user->balance - 1;

        $this->user->update([
            'balance' => $balance
        ]);

        $recarga = new RecargaLink();
        $recarga->k = 'K=23_NEW';
        $recarga->user_id = $this->user->id;
        $recarga->save();

        $this->canj = 0;

        $this->emitTo('jumpers.k23-p.k23-index','render');
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

        $this->emitTo('jumpers.k23-p.k23-index','render');

        

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

        $this->emitTo('jumpers.k23-p.k23-index','render');

        
    }

    public function comentar(){
        if($this->comentario != ''){
           
            $comment = new Comments();
            $comment->comment = $this->comentario;
            $comment->link_id = $this->busqueda_link->id;
            $comment->user_id = auth()->user()->id;
            $comment->save();

            $this->reset(['comentario']);

            $this->emitTo('jumpers.k23-p.k23-index','render');
        }
    }

    public function clear(){
          $this->reset(['search']);
        $this->jumper_list = 0;
        $this->jumper_detect = 0;
        $this->jumper_complete = [];
        session()->forget('search');
        $this->busqueda_link = "";
        return redirect()->route('k23_poderosa.index');

    }
}
