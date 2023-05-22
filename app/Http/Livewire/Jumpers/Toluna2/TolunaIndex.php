<?php

namespace App\Http\Livewire\Jumpers\Toluna2;

use App\Models\Antibot;
use App\Models\Comments;
use App\Models\Link;
use App\Models\Links_usados;
use App\Models\User;
use App\Models\User_Links_Points;
use GuzzleHttp\Client;
use Livewire\Component;
use Livewire\WithPagination;
use DateTime;

class TolunaIndex extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";

    public  $user,$jumper_complete = "", $operacion, $jumper_list = 0,$busqueda_link,$comment_new_psid_register,$pid_register_high,$psid_register_bh,$posicionpid,$psid_detectado,$posicion_total_k,$posicionk,$no_jumpear,$posicion, $no_detect = '0', $jumper_detect = 0, $k_detect = '0', $wix_detect = '0', $psid_register=0,$jumper_redirect,$link_complete_2,$calculo_high = 0,$pid_new=0,$search,$jumper_2,$points_user,$user_auth,$comentario,$is_high,$is_basic,$calc_link,$jumper_select,$points_user_positive, $points_user_negative, $jumper_detect_k ='';

    protected $listeners = ['render' => 'render', 'registro_psid' => 'registro_psid' , 'verific' => 'verific'];
    
    public function mount(){
        $this->user_auth =  auth()->user()->id;
        $this->jumper_detect = 0;
        $this->busqueda_link = "";

        $this->user = User::where('id',auth()->user()->id)->first();
    }

    public function numerologia(){

        $cant = Antibot::count();
        $random = rand(1,$cant);
        $this->operacion = Antibot::where('id',$random)->first();
        $operacion_total = 'Resuelve esta operación matemática ('.$this->operacion->nro1.' + '.$this->operacion->nro2. ')';

        $this->emit('numerologia',$operacion_total,'jumpers.toluna2.toluna-index','verific');
    }

    public function verific($result){

        if($result[0] == $this->operacion->resultado){

            $busqueda_sname= strpos($this->search, 'sname=');

            if($busqueda_sname != false){

                $posicion_sname = $busqueda_sname + 6;
     
                $i_sname = 0;
                $busq_sname = 0;
                                
                do{
                    $detect_sname= substr($this->search, $posicion_sname,1);
            
                    if($detect_sname == '&') $i_sname = 1;
                    else{
                        $posicion_sname = $posicion_sname + 1;
                        $busq_sname ++;
                    }
    
                        if($busq_sname > 45){
                            $i_sname = 1;
                        }
            
                    }while($i_sname != 1);
    
                    if($busq_sname > 45){
                        $sname_buscar = substr($this->search,($busqueda_sname + 6 ));
                    }
                    else{
                        $sname_buscar = substr($this->search,($busqueda_sname + 6),($posicion_sname - ($busqueda_sname + 6)));
                       
                    }
                }
                else{
                    $this->jumper_detect = 3;
                }


            $busqueda_gid= strpos($this->search, 'gid=');
            $busqueda_GID= strpos($this->search, 'GID=');

            if($busqueda_gid != false || $busqueda_GID != false){

                if($busqueda_gid != false) $posicion_gid = $busqueda_gid + 4;
                else $posicion_gid = $busqueda_GID + 4;

                $i_gid = 0;
                $busq_gid = 0;
                            
                do{
                    $detect_gid= substr($this->search, $posicion_gid,1);
        
                    if($detect_gid == '&') $i_gid = 1;
                    else{
                        $posicion_gid = $posicion_gid + 1;
                        $busq_gid ++;
                    }

                    if($busq_gid > 20){
                        $i_gid = 1;
                    }
        
                }while($i_gid != 1);

                if($busqueda_gid != false) $busqueda_gid = $busqueda_gid;
                else $busqueda_gid = $busqueda_GID;

                if($busq_gid > 20){
                    if($busqueda_gid != false)
                    $gid_buscar = substr($this->search,($busqueda_gid + 4));
                   
                }
                else{
                    $gid_buscar = substr($this->search,($busqueda_gid + 4),($posicion_gid - ($busqueda_gid + 4)));
                    
                }

            }

            else{
                $this->jumper_detect = 3;
            }

            try {
                $client = new Client([
                    //'base_uri' => 'http://127.0.0.1:8000',
                    'base_uri' => 'http://146.190.74.228/',
                ]);

                $resultado = $client->request('GET', '/Toluna/2/'.$sname_buscar.'/'.$gid_buscar);

                if($resultado->getStatusCode() == 200){

                    $link_register = new Links_usados();
                    $link_register->link = $this->search;
                    $link_register->k_detected  = 'TOLUNA';
                    $link_register->user_id  = $this->user->id;
                    $link_register->save();

                    $this->jumper_complete = json_decode($resultado->getBody(),true);

                    $this->busqueda_link = Link::where('psid',substr($sname_buscar,0,5))->first();

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


                            $url_detect_ups= strpos($this->search, 'ups.');

                            if($url_detect_ups == false){
                                $link = new Link();
                                $link->jumper = $url_detect;
                                $link->psid = substr($sname_buscar,0,5);
                                $link->user_id = auth()->user()->id;
                                $link->jumper_type_id = 14;
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

    public function render()
    {
        
        $comments =0;
        $jumper = "";
        $link_complete="";
        $this->no_jumpear = 0;
        $this->no_detect = '0';
        $this->posicion = 8; //me esta buscand a partir de https://

        $this->search = trim($this->search); //quitando espacios en blancos al inicio y final
        $long_psid = strlen($this->search); //buscando cuantos caracteres tiene en total


        if($long_psid>=5){

            $busqueda_sname= strpos($this->search, 'sname=');

            if($this->jumper_detect == 0){

                if($busqueda_sname !== false){

                    $link_register_search = Links_usados::where('link',$this->search)
                    ->where('k_detected','TOLUNA')
                    ->where('user_id',$this->user->id)
                    ->count();

                    if($link_register_search >= 1){

                        $this->jumper_detect = 7;
                    }
                    else{
                        $date = new DateTime();

                        $date_actual= $date->format('Y-m-d H:i:s');
                        $date_actual_30 = $date->modify('-30 minute')->format('Y-m-d H:i:s');

                        $links_usados = Links_usados::where('k_detected','TOLUNA')
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
                    $this->jumper_detect = 3;
                }
            }

            if($this->jumper_detect == 1){

                $busqueda_sname= strpos($this->search, '&sname=');

                $sname_buscar = substr($this->search,($busqueda_sname + 7 ));
    
                $this->busqueda_link = Link::where('psid',substr($sname_buscar,0,5))->first();

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
            $this->calc_link = 0;
        }

        return view('livewire.jumpers.toluna2.toluna-index',compact('jumper','comments'));
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

        $this->emitTo('jumpers.toluna2.toluna-index','render');
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

        return view('livewire.jumpers.toluna2.toluna-index');
    }

    public function comentar(){
        if($this->comentario != ''){
           
            $comment = new Comments();
            $comment->comment = $this->comentario;
            $comment->link_id = $this->busqueda_link->id;
            $comment->user_id = auth()->user()->id;
            $comment->save();

            $this->reset(['comentario']);

            $this->emitTo('jumpers.toluna2.toluna-index','render');
        }
    }

    public function clear(){
        $this->reset(['search']);
        $this->jumper_list = 0;
        $this->jumper_complete = "";
        session()->forget('search');
        $this->busqueda_link = "";
        return redirect()->route('toluna2.index');
    }
}
