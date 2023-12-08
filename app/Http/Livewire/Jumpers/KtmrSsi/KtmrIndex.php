<?php

namespace App\Http\Livewire\Jumpers\KtmrSsi;

use App\Models\Antibot;
use App\Models\Links_usados;
use App\Models\User;
use DateTime;
use Livewire\Component;
use GuzzleHttp\Client;

class KtmrIndex extends Component
{
    public $limit, $user,$calculo = 0, $jumper_complete = "", $search, $psid_register=0,$pid_new=0,$type, $jumper_detect = 0,$busqueda_link,$psid_buscar,$operacion;

    protected $listeners = ['render' => 'render', 'jumpear' => 'jumpear', 'verific' => 'verific', 'jump' => 'jump'];

    public function mount(){
     
        if(session('psid')) $this->psid_register = session('psid');
        if(session('search')) $this->search = session('search');
        $this->jumper_detect = 0;
        $this->busqueda_link = "";

        $this->user = User::where('id',auth()->user()->id)->first();

        if($this->user->id == '1') $this->limit == 19;
        else $this->limit == 9;
    }
    
    public function numerologia(){

        $cant = Antibot::count();
        $random = rand(1,$cant);
        $this->operacion = Antibot::where('id',$random)->first();
        $operacion_total = 'Resuelve esta operación matemática ('.$this->operacion->nro1.' + '.$this->operacion->nro2. ')';

        $this->emit('numerologia',$operacion_total,'jumpers.ktmr-ssi.ktmr-index','verific');
    }

    public function verific($result){

        if($result[0] == $this->operacion->resultado){

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
                }
                if($busqueda_pid2 !== false){ 
                    
                    $pid_detect_com= strpos($this->search, '&pid=');
                    $posicion_pid = $pid_detect_com + 5;
                    $pid_calculate = $pid_detect_com + 5;
                }
                if($busqueda_pid3 !== false){
                    $pid_detect_com= strpos($this->search, '?ID=');
                    $posicion_pid = $pid_detect_com + 4;
                    $pid_calculate = $pid_detect_com + 4;
                }
                if($busqueda_pid4 !== false){
                    $pid_detect_com= strpos($this->search, '?id=');
                    $posicion_pid = $pid_detect_com + 4;
                    $pid_calculate = $pid_detect_com + 4;
                }
                if($busqueda_pid5 !== false){
                    $pid_detect_com= strpos($this->search, '&ID=');
                    $posicion_pid = $pid_detect_com + 4;
                    $pid_calculate = $pid_detect_com + 4;
                }
                if($busqueda_pid7 !== false){
                    $pid_detect_com= strpos($this->search, '&Broker=');
                    $posicion_pid = $pid_detect_com + 8;
                    $pid_calculate = $pid_detect_com + 8;
                }
                if($busqueda_pid6 !== false){
                    $pid_detect_com= strpos($this->search, '&id=');
                    $posicion_pid = $pid_detect_com + 4;
                    $pid_calculate = $pid_detect_com + 4;
                }
                if($busqueda_pid8 !== false){
                    $pid_detect_com= strpos($this->search, '?PID=');
                    $posicion_pid = $pid_detect_com + 5;
                    $pid_calculate = $pid_detect_com + 5;
                }
                if($busqueda_pid9 !== false){
                    $pid_detect_com= strpos($this->search, '?pid=');
                    $posicion_pid = $pid_detect_com + 5;
                    $pid_calculate = $pid_detect_com + 5;
                }
                if($busqueda_pid10 !== false){
                    $pid_detect_com= strpos($this->search, 'fill?1=');
                    $posicion_pid = $pid_detect_com + 7;
                    $pid_calculate = $pid_detect_com + 7;
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

                    if($busq_pid_s > 14){
                        $i = 1;
                    }

                }while($i != 1);

                if($busq_pid_s < 14){
                    if(is_numeric(substr($this->search,($pid_calculate),($posicion_pid - ($pid_calculate)))))
                    $pid = substr($this->search,($pid_calculate),($posicion_pid - ($pid_calculate)));
                }
                else{
                    $pid = substr($this->search,($pid_calculate));
                }
            }
            else{
                $pid = 0;
            }

            $busqueda_DYN_ = strpos($this->search, '&DYN=');
            $busqueda_dyn_ = strpos($this->search, '&dyn=');

                if($busqueda_DYN_ != false || $busqueda_dyn_ != false){
                    if($busqueda_DYN_ != false) {
                        $posicion_dyn = $busqueda_DYN_ + 5;
                        $busqueda_dyn_p = $busqueda_DYN_ + 5;
                    }
                    else {
                        $posicion_dyn = $busqueda_dyn_ + 5;
                        $busqueda_dyn_p = $busqueda_dyn_ + 5;
                    }

                            $i_dyn = 0;
                            $busq_dyn = 0;
                            
                            do{
                                $detect_dyn= substr($this->search, $posicion_dyn,1);
        
                                if($detect_dyn == '&') $i_dyn = 1;
                                else{
                                    $posicion_dyn = $posicion_dyn + 1;
                                    $busq_dyn ++;
                                }

                                if($busq_dyn > 15){
                                    $i_dyn = 1;
                                }
        
                            }while($i_dyn != 1);

                            if($busq_dyn < 15)
                                $dyn_buscar = substr($this->search,($busqueda_dyn_p),($posicion_dyn - ($busqueda_dyn_p)));

                            else
                            $dyn_buscar = substr($this->search,($busqueda_dyn_p));
                }


            try {

                $client = new Client([
                    //'base_uri' => 'http://127.0.0.1:8000',
                    'base_uri' => 'http://146.190.74.228/',
                ]);
    
                $resultado = $client->request('GET', '/ktmr/2/'.$this->psid_buscar.'/'.$pid.'/'.$dyn_buscar);
    
                if($resultado->getStatusCode() == 200){

                    $this->jumper_complete = json_decode($resultado->getBody(),true);

                    $link_register = new Links_usados();
                    $link_register->link = $this->search;
                    $link_register->link_resultado = $this->jumper_complete['jumper'];
                    $link_register->k_detected  = 'KTMR';
                    $link_register->user_id  = $this->user->id;
                    $link_register->save();

                    $this->jumper_detect = 1;
                }
    
                else{
                    //$this->jumper_detect = 2;

                    
                }
            }
            catch (\GuzzleHttp\Exception\RequestException $e) {
    
                $error['error'] = $e->getMessage();
                $error['request'] = $e->getRequest();

                if($e->hasResponse()){
                    if ($e->getResponse()->getStatusCode() !== '200'){
                        /*$error['response'] = $e->getResponse(); 
                        $this->jumper_detect = 2;*/


                        try {

                            $client = new Client([
                                //'base_uri' => 'http://127.0.0.1:8000',
                                'base_uri' => 'http://147.182.190.233/',
                            ]);
                
                            $resultado = $client->request('GET', '/ktmr/2/'.$this->psid_buscar.'/'.$pid.'/'.$dyn_buscar);
                
                            if($resultado->getStatusCode() == 200){
            
                                $link_register = new Links_usados();
                                $link_register->link = $this->search;
                                $link_register->k_detected  = 'KTMR';
                                $link_register->user_id  = $this->user->id;
                                $link_register->save();
            
                                $this->jumper_detect = 1;
                
                                $this->jumper_complete = json_decode($resultado->getBody(),true);
                            }
                
                            else{
                                $this->jumper_detect = 2;
            
                                
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
                }
    
            }
        }

        else{
            $this->reset(['search','operacion']);
            $this->calculo = 0;
            $this->emit('error','Resultado incorrecto, intentalo de nuevo');
       
        }
    }


    public function render()
    {
        $this->search = trim($this->search); //quitando espacios en blancos al inicio y final
        $long_psid = strlen($this->search); //buscando cuantos caracteres tiene en total

        if($long_psid>5){

            $busqueda_ast_ = strpos($this->search, '**');

                if($busqueda_ast_ !== false){
                    $busqueda_id= strpos($this->search, '**');

                    if(session('psid')) $this->psid_buscar = substr($this->search,($busqueda_id - 22),11).substr(session('psid'),11,11);
                    else $this->psid_buscar = substr($this->search,($busqueda_id - 22),22);
                }

                $busqueda_DYN_ = strpos($this->search, '&DYN=');
                $busqueda_dyn_ = strpos($this->search, '&dyn=');

                if($busqueda_DYN_ != false || $busqueda_dyn_ != false){
                    if($busqueda_DYN_ != false) {
                        $posicion_dyn = $busqueda_DYN_ + 5;
                        $busqueda_dyn_p = $busqueda_DYN_ + 5;
                    }
                    else {
                        $posicion_dyn = $busqueda_dyn_ + 5;
                        $busqueda_dyn_p = $busqueda_dyn_ + 5;
                    }
                }

                else{
                    $this->jumper_detect = 3;
                }
                    



            if($this->jumper_complete == "" && $this->jumper_detect == 0) {



                $link_register_search = Links_usados::where('link',$this->search)
                    ->where('k_detected','KTMR')
                    ->where('user_id',$this->user->id)
                    ->first();

                if($link_register_search){

                    $this->jumper_detect = 7;
                                    
                }
                else{

                    $date = new DateTime();

                    $date_actual= $date->format('Y-m-d H:i:s');
                    $date_actual_30 = $date->modify('-20 minute')->format('Y-m-d H:i:s');

                    $links_usados = Links_usados::where('k_detected','KTMR')
                        ->where('user_id',$this->user->id)
                        ->whereBetween('created_at',[$date_actual_30,$date_actual])
                        ->count();

                    if($links_usados <= 4){
                        $this->numerologia();
                    }
                    else{
                        $alertas = $this->user->cant_links_jump_alert + 1;
                        $this->user->update(['cant_links_jump_alert'=>$alertas]);
                        $this->jumper_detect = 6;
                    }
                }
            }
        }
        else{
            if($long_psid == 0){
                $this->reset(['search']);
                $this->jumper_complete = "";
                session()->forget('search');
                $this->busqueda_link = "";
            }
        
        }

        return view('livewire.jumpers.ktmr-ssi.ktmr-index');
    }

    public function clear(){
        $this->reset(['search']);
        $this->jumper_complete = "";
        session()->forget('search');
        $this->busqueda_link = "";
        return redirect()->route('ktmr_ssi.index');
    }
}
