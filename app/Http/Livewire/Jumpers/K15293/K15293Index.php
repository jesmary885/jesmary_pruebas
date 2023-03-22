<?php

namespace App\Http\Livewire\Jumpers\K15293;

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

class K15293Index extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public  $user,$operacion, $jumper_complete = [],$jumper_list = 0,$busqueda_link,$comment_new_psid_register,$pid_register_high,$psid_register_bh,$high_register_bh,$basic_register_bh,$posicionpid,$psid_detectado,$posicion_total_k,$posicionk,$no_jumpear,$posicion, $no_detect = '0', $jumper_detect = 0, $k_detect = '0', $wix_detect = '0', $psid_register=0,$jumper_redirect,$link_complete_2,$calculo_high = 0,$pid_new=0,$search,$jumper_2,$points_user,$user_auth,$comentario,$is_high,$is_basic,$calc_link,$jumper_select,$points_user_positive, $points_user_negative, $jumper_detect_k ='',$pid_manual,$pid_detectado = 'si',$pid_buscar,$psid_buscar;

    protected $listeners = ['render' => 'render', 'registro_psid' => 'registro_psid' , 'verific' => 'verific'];
    
    public function mount(){
        $this->user_auth =  auth()->user()->id;
        if(session('pid')) $this->pid_new = session('pid');
        if(session('psid')) $this->psid_register = session('psid');
        if(session('search')) $this->search = session('search');

        $this->jumper_detect = 0;
        $this->busqueda_link = "";

        $this->user = User::where('id',auth()->user()->id)->first();
    }

    public function basic(){
        return redirect()->route('ssidkr.index');
    }

    public function k2062(){
        return redirect()->route('kdosmilsesentaydos.index');
    }

    public function k1092(){
        return redirect()->route('kmilnoventaydos.index');
    }

    public function k3203(){
        return redirect()->route('k3203.index');
    }

    public function k7341(){
        return redirect()->route('ksietemilcuarentayuno.index');
    }

    protected $rules_pid = [
        'pid_manual' => 'required|min:8',
    ];


    public function verific($result){

        if($result[0] == $this->operacion->resultado){

            if($this->pid_manual){
                $this->pid_buscar = $this->pid_manual;
            }

            $link_register = new Links_usados();
            $link_register->link = $this->search;
            $link_register->k_detected  = 'K=15293';
            $link_register->user_id  = $this->user->id;
            $link_register->save();

            try {

                $client = new Client([
                    //'base_uri' => 'http://127.0.0.1:8000',
                    'base_uri' => 'http://146.190.74.228/',
                ]);
        
                $resultado = $client->request('GET', '/k15293/1/'.$this->psid_buscar);
        
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
                                                $link->jumper_type_id = 20;
                                                $link->k_detected = 'K=15293';
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

            $this->reset(['search','operacion']);

            $this->emit('error','Resultado incorrecto, intentalo de nuevo');
       
        }
    }

    public function numerologia(){

        $cant = Antibot::count();
        $random = rand(1,$cant);
        $this->operacion = Antibot::where('id',$random)->first();
        $operacion_total = 'Resuelve esta operación matemática ('.$this->operacion->nro1.' + '.$this->operacion->nro2. ')';

        $this->emit('numerologia',$operacion_total,'jumpers.k15293.k15293-index','verific');
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
        $this->k_detect = '0';
        //$this->jumper_detect = 0;
        //$this->busqueda_link = "";
        $this->no_detect = '0';
        $this->comment_new_psid_register = '';
        $this->posicion = 8; //me esta buscand a partir de https://

        $this->search = trim($this->search); //quitando espacios en blancos al inicio y final
        $long_psid = strlen($this->search); //buscando cuantos caracteres tiene en total


        if($long_psid>=5){

            $busqueda_k1000_ = strpos($this->search, 'k=15293&');

            if($busqueda_k1000_ !== false){
                
                $busqueda_ast_ = strpos($this->search, '**');

                
                if($busqueda_ast_ !== false){
                    $busqueda_id= strpos($this->search, '**');
                                    
                    //$this->psid_buscar = substr($this->search,($busqueda_id - 22),22);

                    if(session('psid')) $this->psid_buscar = substr($this->search,($busqueda_id - 22),11).substr(session('psid'),11,11);
                    else $this->psid_buscar = substr($this->search,($busqueda_id - 22),22);

                  


                    if($this->jumper_detect == 0){

                        if($this->jumper_list == 0){

                            $link_register_search = Links_usados::where('link',$this->search)
                                ->where('k_detected','K=15293')
                                ->where('user_id',$this->user->id)
                                ->first();

                            if($link_register_search){

                                $this->jumper_detect = 7;
                                
                            }
                            else{
                                $date = new DateTime();

                                $date_actual= $date->format('Y-m-d H:i:s');
                                $date_actual_30 = $date->modify('-30 minute')->format('Y-m-d H:i:s');

                                $links_usados = Links_usados::where('k_detected','K=15293')
                                    ->where('user_id',$this->user->id)
                                    ->whereBetween('created_at',[$date_actual_30,$date_actual])
                                    ->count();

                                if($links_usados <= 6){
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
                else{
                    $this->jumper_detect = 3;
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
                    $busqueda_k7341_ = strpos($this->search, 'k=7341&');

                    if($busqueda_k3203_ == false && $busqueda_k2062_ == false && $busqueda_k1092_ == false && $busqueda_k7341_ == false ){

                        if($this->busqueda_link->jumper_type_id == 1 || $this->busqueda_link->jumper_type_id == 2) {

                            session(['search' =>  $this->search]);
                            $this->basic();
    
                        }
    
                        elseif($this->busqueda_link->k_detected == 'K=1000'){

                            
    
                            $this->k_detect = 'k=1000';
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
                            session()->forget('search');
                            $this->k3203();
                        }
                        elseif($this->busqueda_link->k_detected == 'K=2062') {
                            session()->forget('search');
                            $this->k2062();
                        }
                        elseif($this->busqueda_link->k_detected == 'K=1092') {
                            session()->forget('search');
                            $this->k1092();
                        }
                        elseif($this->busqueda_link->k_detected == 'K=7341') {
                            session()->forget('search');
                            $this->k7341();
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
                        if($busqueda_k7341_  != false) {
                            session()->forget('search');
                            $this->k7341();
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

       // session()->forget('search');

        return view('livewire.jumpers.k15293.k15293-index',compact('jumper','comments','subs_psid','busqueda_link_def'));
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

        $this->emitTo('jumpers.k15293.k15293-index','render');        

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

        $this->emitTo('jumpers.k15293.k15293-index','render');

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

        $this->emitTo('jumpers.k15293.k15293-index','render');
    }

    public function clear(){
        $this->reset(['search']);
        $this->jumper_list = 0;
        $this->jumper_complete = [];
        session()->forget('search');
        $this->busqueda_link = "";
        return redirect()->route('k15293.index');
        

    }
}
