<?php

namespace App\Http\Livewire\Jumpers\K1093;

use App\Models\Antibot;
use App\Models\Comments;
use App\Models\Link;
use App\Models\Links_usados;
use App\Models\User;
use App\Models\User_Links_Points;
use DateTime;
use GuzzleHttp\Client;
use Livewire\Component;
use Livewire\WithPagination;
class K1093Index extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public  $user,$jumper_complete = [],$jumper_list = 0,$busqueda_link,$comment_new_psid_register,$pid_register_high,$psid_register_bh,$high_register_bh,$basic_register_bh,$posicionpid,$psid_detectado,$posicion_total_k,$posicionk,$no_jumpear,$posicion, $no_detect = '0', $jumper_detect = 0, $k_detect = '0', $psid_register=0,$link_complete_2,$calculo_high = 0,$pid_new=0,$search,$jumper_2,$points_user,$user_auth,$comentario,$calc_link,$jumper_select,$points_user_positive, $points_user_negative, $jumper_detect_k ='',$pid_manual,$pid_detectado = 'si',$pid_buscar,$operacion;

    protected $listeners = ['render' => 'render', 'registro_psid' => 'registro_psid', 'verific' => 'verific'];
    
    public function mount(){
        $this->user_auth =  auth()->user()->id;
        if(session('pid')) $this->pid_new = session('pid');
        if(session('psid')) $this->psid_register = session('psid');
        if(session('search')) $this->search = session('search');
        $this->jumper_detect = 0;
        $this->jumper_list = 0;
        $this->busqueda_link = "";

        $this->user = User::where('id',auth()->user()->id)->first();
    }

    protected $rules_pid = [
        'pid_manual' => 'required|min:6',
    ];

    public function jumpear(){
        $rules_pid = $this->rules_pid;
        $this->validate($rules_pid);

        $this->pid_buscar = $this->pid_manual;

        $link_register_search = Links_usados::where('link',$this->search)
            ->where('k_detected','K=1093')
            ->where('user_id',$this->user->id)
            ->count();

        if($link_register_search >= 2){

            $this->jumper_detect = 7;
                                
        }
        else{
            $date = new DateTime();

            $date_actual= $date->format('Y-m-d H:i:s');
            $date_actual_30 = $date->modify('-30 minute')->format('Y-m-d H:i:s');

            $links_usados = Links_usados::where('k_detected','K=1093')
                ->where('user_id',$this->user->id)
                ->whereBetween('created_at',[$date_actual_30,$date_actual])
                ->count();

            if($links_usados <= 5){
                $this->numerologia();
            }
            else{
                $alertas = $this->user->cant_links_jump_alert + 1;
                $this->user->update(['cant_links_jump_alert'=>$alertas]);
                $this->jumper_detect = 6;
            }
        }
    }

    public function numerologia(){

        $cant = Antibot::count();
        $random = rand(1,$cant);
        $this->operacion = Antibot::where('id',$random)->first();
        $operacion_total = 'Resuelve esta operación matemática ('.$this->operacion->nro1.' + '.$this->operacion->nro2. ')';

        $this->emit('numerologia',$operacion_total,'jumpers.k1093.k1093-index','verific');
    }

    public function verific($result){

        if($result[0] == $this->operacion->resultado){

            if($this->pid_manual){
                $this->pid_buscar = $this->pid_manual;
            }

            $busqueda_id= strpos($this->search, '**');
                                    
            if(session('psid')) $psid_buscar = substr($this->search,($busqueda_id - 22),11).substr(session('psid'),11,11);
            else $psid_buscar = substr($this->search,($busqueda_id - 22),22);

         /*   $busqueda_surveyno= strpos($this->search, '?surveyno=');

            if($busqueda_surveyno != false){

                $posicion_suveyno = $busqueda_surveyno + 10;
                $i_elem1 = 0;
                $busq_elem1 = 0;
                            
                do{
                    $detect_elem1= substr($this->search, $posicion_suveyno,1);
        
                    if($detect_elem1 == '&') $i_elem1 = 1;
                    else{
                        $posicion_suveyno = $posicion_suveyno + 1;
                        $busq_elem1 ++;
                    }

                    if($busq_elem1 > 20){
                        $i_elem1 = 1;
                    }
        
                }while($i_elem1 != 1);

                $surveyno_buscar = substr($this->search,($busqueda_surveyno + 10),($posicion_suveyno - ($busqueda_surveyno + 10)));

            }*/

           /* $busqueda_spid= strpos($this->search, '&spid');

            if($busqueda_spid != false){
                $posicion_spid = $busqueda_spid + 6;
                $i_elem2 = 0;
                $busq_elem2 = 0;
                            
                do{
                    $detect_elem2= substr($this->search, $posicion_spid,1);
        
                    if($detect_elem2 == '&') $i_elem2 = 1;
                    else{
                        $posicion_spid = $posicion_spid + 1;
                        $busq_elem2 ++;
                    }

                    if($busq_elem2 > 20){
                        $i_elem2 = 1;
                    }
        
                }while($i_elem2 != 1);

                $spid_buscar = substr($this->search,($busqueda_spid + 6 ),($posicion_spid - ($busqueda_spid + 6)));

            }*/

           /* $busqueda_hash= strpos($this->search, 'k=1093&_s=');


            if($busqueda_hash != false){
                $hash_buscar = substr($this->search,($busqueda_hash + 10 ));
            }*/

            try {
                $client = new Client(['base_uri' => 'http://147.182.190.233/',]);

                $resultado = $client->request('GET', '/k1093/1/'.$psid_buscar);


                if($resultado->getStatusCode() == 200){

                    $this->jumper_complete = json_decode($resultado->getBody(),true);

                    $link_register = new Links_usados();
                    $link_register->link = $this->search;
                    $link_register->k_detected  = 'K=1093';
                    $link_register->user_id  = $this->user->id;
                    $link_register->link_resultado = $this->jumper_complete['jumper'];
                    $link_register->save();

                    

                    /*$jump1 = json_decode($resultado->getBody(),true);

                    $busqueda_psid_vacio= strpos($jump1['jumper'], '&psid=');


                    if($busqueda_psid_vacio!= false){

                    $posicion_psid_vacio = $busqueda_psid_vacio + 6;
                    $i_psid_vacio = 0;
                    $busq_psid_vacio = 0;
                            
                    do{
                        $detect_psid_vacio = substr($jump1['jumper'], $posicion_psid_vacio,1);
            
                        if($detect_psid_vacio == '&') $i_psid_vacio = 1;
                        else{
                            $posicion_psid_vacio = $posicion_psid_vacio + 1;
                            $busq_psid_vacio ++;
                        }

                        if($busq_psid_vacio > 28){
                            $i_psid_vacio = 1;
                        }

            
                        }while($i_psid_vacio != 1);

                        if($busq_psid_vacio == 0){
                            $this->jumper_detect = 2;
                            
                        }
                        else{
                            $this->jumper_list = 1;
                            $this->jumper_detect = 1;
                            $this->jumper_complete = json_decode($resultado->getBody(),true);
                        }

                    }*/

                   


                    $this->busqueda_link = Link::where('psid',substr($psid_buscar,0,5))->first();

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
                                            if($url_detect != 'https://dkr1.ssisurveys.com' && $url_detect != 'https://online.ssisurveys.com'  && $url_detect != 'https://online.surveynetwork.com' ){
                                            $link->jumper = $url_detect;
                                            }
                                            $link->psid = substr($psid_buscar,0,5);
                                            $link->user_id = auth()->user()->id;
                                            $link->jumper_type_id = 30;
                                            $link->k_detected = 'K=1093';
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
            catch (\GuzzleHttp\Exception\RequestException $e) {
           

                $error['error'] = $e->getMessage();
                $error['request'] = $e->getRequest();

                if($e->hasResponse()){
                    if ($e->getResponse()->getStatusCode() !== '200'){

                        $error['response'] = $e->getResponse(); 
                        $this->jumper_detect = 2;
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
        $this->pid_buscar = "";
        $busqueda_link_def = "";
        $this->no_jumpear = 0;
        $this->k_detect = '0';
        $this->no_detect = '0';
        $this->comment_new_psid_register = '';
        $this->posicion = 8; //me esta buscand a partir de https://

        $this->search = trim($this->search); //quitando espacios en blancos al inicio y final
        $long_psid = strlen($this->search); //buscando cuantos caracteres tiene en total


        if($long_psid>=5){

            $busqueda_k1093_ = strpos($this->search, 'k=1093&');

            if($busqueda_k1093_ !== false){


                
                $busqueda_ast_ = strpos($this->search, '**');

                if($busqueda_ast_ !== false){
                    $busqueda_id= strpos($this->search, '**');
                                    
                    if(session('psid')) $psid_buscar = substr($this->search,($busqueda_id - 22),11).substr(session('psid'),11,11);
                    else $psid_buscar = substr($this->search,($busqueda_id - 22),22);

                    if(session('pid')){
                        $this->pid_buscar = session('pid');
                    }

                    else{
                        $this->pid_detectado = 'no';
                        $this->busqueda_link = Link::where('psid',substr($psid_buscar,0,5))->first();
        
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
                                            if($url_detect != 'https://dkr1.ssisurveys.com' && $url_detect != 'https://online.ssisurveys.com'  && $url_detect != 'https://online.surveynetwork.com' ){
                                                $link->jumper = $url_detect;
                                            }
                                            $link->psid = substr($psid_buscar,0,5);
                                            $link->user_id = auth()->user()->id;
                                            $link->jumper_type_id = 30;
                                            $link->k_detected = 'K=1093';
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

                   /* $busqueda_surveyno= strpos($this->search, '?surveyno=');

                    if($busqueda_surveyno != false){

                            $posicion_elem1 = $busqueda_surveyno + 10;
        
                    }

                    else{

                        $this->jumper_detect = 3;
                    }*/

                   /* $busqueda_spid= strpos($this->search, '&spid');

                    if($busqueda_spid != false){
                            $posicion_elem1 = $busqueda_spid + 10;
                    }

                    else{
                        $this->jumper_detect = 3;
                    }*/

                    if($this->jumper_detect == 0 && $this->pid_detectado == 'si'){

                        if($this->jumper_list == 0){
                            $link_register_search = Links_usados::where('link',$this->search)
                            ->where('k_detected','K=1093')
                            ->where('user_id',$this->user->id)
                            ->count();

                            if($link_register_search >= 1){

                                $this->jumper_detect = 7;
                                
                            }
                            else{
                                $date = new DateTime();

                                $date_actual= $date->format('Y-m-d H:i:s');
                                $date_actual_30 = $date->modify('-30 minute')->format('Y-m-d H:i:s');

                                $links_usados = Links_usados::where('k_detected','K=1093')
                                    ->where('user_id',$this->user->id)
                                    ->whereBetween('created_at',[$date_actual_30,$date_actual])
                                    ->count();

                                if($links_usados <= 5){
                                    $this->numerologia();
                                }
                                else{
                                    $alertas = $this->user->cant_links_jump_alert + 1;
                                    $this->user->update(['cant_links_jump_alert'=>$alertas]);
                                    $this->jumper_detect = 6;
                                }
                            }
                        }

                        else{
                            $this->busqueda_link = Link::where('psid',substr($psid_buscar,0,5))->first();
     
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
                        $this->busqueda_link = Link::where('psid',substr($psid_buscar,0,5))->first();
     
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

        return view('livewire.jumpers.k1093.k1093-index',compact('jumper','comments','subs_psid','busqueda_link_def'));
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

        $this->emitTo('jumpers.k1093.k1093-index','render');
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

        $this->emitTo('jumpers.k1093.k1093-index','render');

        
    }

    public function comentar(){
        if($this->comentario != ''){
           
            $comment = new Comments();
            $comment->comment = $this->comentario;
            $comment->link_id = $this->busqueda_link->id;
            $comment->user_id = auth()->user()->id;
            $comment->save();

            $this->reset(['comentario']);

            $this->emitTo('jumpers.k1093.k1093-index','render');
        }
    }

    public function clear(){
        $this->reset(['search']);
        $this->jumper_detect = 0;
        $this->jumper_list = 0;
        $this->jumper_complete = [];
        session()->forget('search');
        $this->busqueda_link = "";
        return redirect()->route('k1093.index');

    }
}
