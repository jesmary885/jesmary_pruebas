<?php

namespace App\Http\Livewire\Jumpers\K17564;

use App\Models\Antibot;
use App\Models\Comments;
use App\Models\Link;
use App\Models\User_Links_Points;
use GuzzleHttp\Client;
use Livewire\Component;
use Livewire\WithPagination;

class K17564Index extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public  $operacion,$jumper_complete = [],$jumper_list = 0,$busqueda_link,$comment_new_psid_register,$pid_register_high,$psid_register_bh,$high_register_bh,$basic_register_bh,$posicionpid,$psid_detectado,$posicion_total_k,$posicionk,$no_jumpear,$posicion, $no_detect = '0', $jumper_detect = 0, $k_detect = '0', $wix_detect = '0', $psid_register=0,$jumper_redirect,$link_complete_2,$calculo_high = 0,$pid_new=0,$search,$jumper_2,$points_user,$user_auth,$comentario,$is_high,$is_basic,$calc_link,$jumper_select,$points_user_positive, $points_user_negative, $jumper_detect_k ='',$hash_buscar,$psid_buscar;

    protected $listeners = ['render' => 'render', 'registro_psid' => 'registro_psid', 'verific' => 'verific'];
    
    public function mount(){
        $this->user_auth =  auth()->user()->id;
        $this->points_user='no';
        if(session('pid')) $this->pid_new = session('pid');
        if(session('psid')) $this->psid_register = session('psid');
        if(session('search')) $this->search = session('search');
    }

    public function basic(){
        return redirect()->route('ssidkr.index');
    }

    public function k2062(){
        return redirect()->route('kdosmilsesentaydos.index');
    }

    public function k1000(){
        return redirect()->route('kmil.index');
    }

    public function k1092(){
        return redirect()->route('kmilnoventaydos.index');
    }

    public function k3203(){
        return redirect()->route('k3203.index');
    }

    public function numerologia(){

        $cant = Antibot::count();
        $random = rand(1,$cant);
        $this->operacion = Antibot::where('id',$random)->first();
        $operacion_total = 'Resuelve esta operación matemática ('.$this->operacion->nro1.' + '.$this->operacion->nro2. ')';

        $this->emit('numerologia',$operacion_total,'jumpers.k17564.k17564-index','verific');
    }

    public function verific($result){

        if($result[0] == $this->operacion->resultado){

            $client = new Client([
                //'base_uri' => 'http://127.0.0.1:8000',
                'base_uri' => 'http://146.190.74.228/',
            ]);

            $resultado = $client->request('GET', '/k17564/1/'.$this->psid_buscar.'/'.$this->hash_buscar);

            if($resultado->getStatusCode() == 200){

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
                         $link->jumper_type_id = 21;
                         $link->k_detected = 'K=17564';
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
            $this->reset(['search','operacion']);
            $this->emit('error','Resultado incorrecto, intentalo de nuevo');
       
        }
    }


    public function render()
    {
        $subs_psid = '0';
       
        $comments =0;
        $jumper = "";
        $link_complete="";
        $this->psid_buscar = "";
        $pid_buscar = "";
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

            $busqueda_k17564_ = strpos($this->search, 'k=17564&');

            if($busqueda_k17564_ !== false){
              
                $busqueda_ast_ = strpos($this->search, '**');
            
                if($busqueda_ast_ !== false){
                    $busqueda_id= strpos($this->search, '**');
                                    
                    //$this->psid_buscar = substr($this->search,($busqueda_id - 22),22);

                    if(session('psid')) $this->psid_buscar = substr($this->search,($busqueda_id - 22),11).substr(session('psid'),11,11);
                    else $this->psid_buscar = substr($this->search,($busqueda_id - 22),22);

                    $busqueda_hash= strpos($this->search, '&completeHash=');

                        if($busqueda_hash != false){

                            $posicion_hash = $busqueda_hash + 14;
                            $i_h2 = 0;
                            $busq_h2_s = 0;
                            
                            do{
                                $detect_h2= substr($this->search, $posicion_hash,1);
        
                                if($detect_h2 == '&') $i_h2 = 1;
                                else{
                                    $posicion_hash = $posicion_hash + 1;
                                    $busq_h2_s ++;
                                }

                                if($busq_h2_s > 90){
                                    $i_h2 = 1;
                                }
        
                            }while($i_h2 != 1);



                            if($busq_h2_s < 90){
                                $this->hash_buscar = substr($this->search,($busqueda_hash + 14),($posicion_hash - ($busqueda_hash + 14)));
                        
                            }
                            else
                                //$this->ids_buscar = substr($this->search,($busqueda_ids + 4),20);
                                $this->jumper_detect = 3;
                        }

                        else{
                            $this->jumper_detect = 3;
                        }



                       

                        if($this->jumper_detect == 0){

                            if($this->jumper_list == 0){

                                $this->numerologia();
                                
                            }

                            else{
                                $this->busqueda_link = Link::where('psid',substr($this->search,($busqueda_id - 22),5))->first();
         
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
                            $this->jumper_detect = 3;
                        }
              
                    /*}
                    else{
                        $this->jumper_detect = 3;
                    }*/
                }
                else{
                    $busqueda_psid_ = strpos($this->search, 'psid');
            
                    if($busqueda_psid_ !== false){
                        $busqueda_psid= strpos($this->search, 'psid'); 
                        //$this->psid_buscar = substr($this->search,($busqueda_psid + 5),22);

                        if(session('psid'))$psid_complete = substr($this->search,($busqueda_psid + 5),11).substr(session('psid'),11,11);
                        else  $this->psid_buscar = substr($this->search,($busqueda_psid + 5),22);

                        $busqueda_hash= strpos($this->search, '&completeHash=');

                        if($busqueda_hash != false){

                            $posicion_hash = $busqueda_hash + 14;
                            $i_h2 = 0;
                            $busq_h2_s = 0;
                            
                            do{
                                $detect_h2= substr($this->search, $posicion_hash,1);
        
                                if($detect_h2 == '&') $i_h2 = 1;
                                else{
                                    $posicion_hash = $posicion_hash + 1;
                                    $busq_h2_s ++;
                                }

                                if($busq_h2_s > 90){
                                    $i_h2 = 1;
                                }
        
                            }while($i_h2 != 1);

                            if($busq_h2_s < 90)
                                $this->hash_buscar = substr($this->search,($busqueda_hash + 14),($posicion_hash - ($busqueda_hash + 14)));

                            else
                                //$this->ids_buscar = substr($this->search,($busqueda_ids + 4),20);
                                $this->jumper_detect = 3;
                        }

                        else{
                            $this->jumper_detect = 3;
                        }
    
   
                            if($this->jumper_detect == 0){

                                $client = new Client([
                                   // 'base_uri' => 'http://127.0.0.1:8000',
                                   'base_uri' => 'http://146.190.74.228/',
                                ]);
            
                                $resultado = $client->request('GET', '/k17564/1/'.$this->psid_buscar.'/'.$this->hash_buscar);
            
                                if($resultado->getStatusCode() == 200){

                                    $this->jumper_complete = json_decode($resultado->getBody(),true);
        
                                    $this->busqueda_link = Link::where('psid',substr($this->search,($busqueda_psid + 5),5))->first();
        
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
                                            $link->psid = substr($this->search,($busqueda_psid + 5),5);
                                            $link->user_id = auth()->user()->id;
                                            $link->jumper_type_id = 21;
                                            $link->k_detected = 'K=17564';
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

                session(['search' =>  $this->search]);

                $busqueda_id= strpos($this->search, '**');

                if($busqueda_id !== false){

                    $this->busqueda_link = Link::where('psid',substr($this->search,($busqueda_id - 22),5))->first();
                }

                else{
                    if(strlen($this->search) < 24){
                        $busqueda_psid_ =  substr($this->search,0,5);
                        $this->busqueda_link = Link::where('psid',$busqueda_psid_)->first();
                    }

                    else{

                        $busqueda_psid_ = strpos($this->search, 'psid');
                
                        if($busqueda_psid_ !== false){
                        
                            $this->busqueda_link = Link::where('psid',substr($this->search,($busqueda_psid_ + 5),5))->first();
                        }
                    }
                }

                
                if($this->busqueda_link){
                    $busqueda_k3203_ = strpos($this->search, 'k=3203&');
                    $busqueda_k2062_ = strpos($this->search, 'k=2062&');
                    $busqueda_k1092_ = strpos($this->search, 'k=1092&');
                    $busqueda_k1000_ = strpos($this->search, 'k=1000&');

                    if($busqueda_k3203_ == false && $busqueda_k2062_ == false && $busqueda_k1092_ == false && $busqueda_k1000_ == false ){

                        if($this->busqueda_link->jumper_type_id == 1 || $this->busqueda_link->jumper_type_id == 2) {

                            session(['search' =>  $this->search]);
                            $this->basic();

                        }

                        
                        elseif($this->busqueda_link->k_detected == 'K=7341'){
                    

                            $this->k_detect = 'k=7341';
                            $this->jumper_detect_k = $this->busqueda_link->jumper;

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

                            session()->forget('search');

        
                        }

                        elseif($this->busqueda_link->k_detected == 'K=3203') {
                            session(['search' =>  $this->search]);
                            $this->k3203();
                        }
                        elseif($this->busqueda_link->k_detected == 'K=2062') {
                            session(['search' =>  $this->search]);
                            $this->k2062();
                        }
                        elseif($this->busqueda_link->k_detected == 'K=1092') {
                            session(['search' =>  $this->search]);
                            $this->k1092();
                        }
                        elseif($this->busqueda_link->k_detected == 'K=1000') {
                            session(['search' =>  $this->search]);
                            $this->k1000();
                        }
                        else{
                       
                            if($this->busqueda_link->k_detected){
                        
                                $this->k_detect = $this->busqueda_link->k_detected;
                       
                            }
                            if($this->busqueda_link->jumper){
                                $this->jumper_detect_k = $this->busqueda_link->jumper;
                            }

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
                            session()->forget('search');
                        }
                    }
                    else{
                        if($busqueda_k3203_  != false) {
                            session()->forget('search');
                            $this->k3203();
                        }
                        if($busqueda_k2062_  != false) {
                            session()->forget('search');
                            $this->k2062();
                        }
                        if($busqueda_k1092_ != false) {
                            session()->forget('search');
                            $this->k1092();
                        }
                        if($busqueda_k1000_  != false) {
                            session()->forget('search');
                            $this->k1000();
                        }
                       
                    }
                    
                }

                
                else{
                    $this->no_detect = 1;
                    session()->forget('search');
                }
            }
        }
        else{
            $this->calc_link = 0;
        }

        return view('livewire.jumpers.k17564.k17564-index',compact('jumper','comments','subs_psid','busqueda_link_def'));
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
        /*$this->reset(['search']);
        $this->jumper_list = 0;
        $this->jumper_complete = [];
        session()->forget('search');
        $this->busqueda_link = 0;*/


        $this->reset(['search']);
        $this->jumper_list = 0;
        $this->jumper_complete = [];
        session()->forget('search');
        $this->busqueda_link = "";
        return redirect()->route('k17564.index');
    }
}
