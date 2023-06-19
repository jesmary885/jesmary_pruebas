<?php

namespace App\Http\Livewire\Jumpers\Samplicio;

use App\Models\Antibot;
use App\Models\Links_usados;
use App\Models\User;
use DateTime;
use Livewire\Component;
use GuzzleHttp\Client;

class SamplicioCash extends Component
{

    public $user,$calculo = 0, $jumper_complete = "", $search, $psid_register=0,$pid_new=0,$type, $jumper_detect = 0,$busqueda_link,$psid_buscar,$operacion;

    protected $listeners = ['render' => 'render', 'jumpear' => 'jumpear', 'verific' => 'verific', 'jump' => 'jump'];

    public function mount(){
     
        if(session('psid')) $this->psid_register = session('psid');
        if(session('search')) $this->search = session('search');
        $this->jumper_detect = 0;
        $this->busqueda_link = "";

        $this->user = User::where('id',auth()->user()->id)->first();
    }
    
    public function numerologia(){

        $cant = Antibot::count();
        $random = rand(1,$cant);
        $this->operacion = Antibot::where('id',$random)->first();
        $operacion_total = 'Resuelve esta operación matemática ('.$this->operacion->nro1.' + '.$this->operacion->nro2. ')';

        $this->emit('numerologia',$operacion_total,'jumpers.samplicio.samplicio-cash','verific');
    }

    public function verific($result){

        if($result[0] == $this->operacion->resultado){

            try {

                $busqueda_SSID_ = strpos($this->search, 'SSID=');
                $busqueda_ssid_ = strpos($this->search, 'ssid=');

                if($busqueda_SSID_ != false || $busqueda_ssid_ != false){
                    if($busqueda_SSID_ != false) {
                        $posicion_ssid = $busqueda_SSID_ + 5;
                        $busqueda_ssid_p = $busqueda_SSID_ + 5;
                    }
                    else {
                        $posicion_ssid = $busqueda_ssid_ + 5;
                        $busqueda_ssid_p = $busqueda_ssid_ + 5;
                    }

                            $i_ssid = 0;
                            $busq_ssid = 0;
                            
                            do{
                                $detect_ssid= substr($this->search, $posicion_ssid,1);
        
                                if($detect_ssid == '&') $i_ssid = 1;
                                else{
                                    $posicion_ssid = $posicion_ssid + 1;
                                    $busq_ssid ++;
                                }

                                if($busq_ssid > 150){
                                    $i_ssid = 1;
                                }
        
                            }while($i_ssid != 1);

                            if($busq_ssid < 150)
                                $ssid_buscar = substr($this->search,($busqueda_ssid_p),($posicion_ssid - ($busqueda_ssid_p)));

                            else
                                $ssid_buscar = substr($this->search,($busqueda_ssid_p));

                }

                $client = new Client([
                    //'base_uri' => 'http://127.0.0.1:8000',
                    'base_uri' => 'http://147.182.190.233/',
                ]);
    
                $resultado = $client->request('GET', '/Samplicio_cashyp/1/'.$ssid_buscar);
    
                if($resultado->getStatusCode() == 200){

                    $link_register = new Links_usados();
                    $link_register->link = $this->search;
                    $link_register->k_detected  = 'SAMPLICIO';
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

            $busqueda_SSID_ = strpos($this->search, '&SSID=');
            $busqueda_ssid_ = strpos($this->search, '&ssid=');

            if($busqueda_SSID_ != false || $busqueda_ssid_ != false){

            }
            else{

                $this->jumper_detect = 3;
            }


            if($this->jumper_complete == "" && $this->jumper_detect == 0) {
                $link_register_search = Links_usados::where('link',$this->search)
                    ->where('k_detected','SAMPLICIO')
                    ->where('user_id',$this->user->id)
                    ->first();

                if($link_register_search){

                    $this->jumper_detect = 7;
                                    
                }
                else{
                    $date = new DateTime();

                    $date_actual= $date->format('Y-m-d H:i:s');
                    $date_actual_30 = $date->modify('-30 minute')->format('Y-m-d H:i:s');

                    $links_usados = Links_usados::where('k_detected','SAMPLICIO')
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
        }
        else{
            if($long_psid == 0){
                $this->reset(['search']);
                $this->jumper_complete = "";
                session()->forget('search');
                $this->busqueda_link = "";
            }
        
        }


        return view('livewire.jumpers.samplicio.samplicio-cash');
    }

    public function clear(){
        $this->reset(['search']);
        $this->jumper_complete = "";
        session()->forget('search');
        $this->busqueda_link = "";
        return redirect()->route('samplicio_cash.index');
    }

}
