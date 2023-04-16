<?php

namespace App\Http\Livewire\Jumpers\Ktmr;

use App\Models\Antibot;
use App\Models\Links_usados;
use App\Models\User;
use DateTime;
use Livewire\Component;
use GuzzleHttp\Client;

class KtmrIndex extends Component
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

        $this->emit('numerologia',$operacion_total,'jumpers.ktmr.ktmr-index','verific');
    }

    public function verific($result){

        if($result[0] == $this->operacion->resultado){

            try {
  
                $client = new Client([
                    //'base_uri' => 'http://127.0.0.1:8000',
                    'base_uri' => 'http://209.94.57.88/',
                ]);
    
                $resultado = $client->request('GET', '/ktmr/1/'.$this->psid_buscar);
    
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

            $busqueda_f_ = strpos($this->search, '/Fingerprint/');

            if($busqueda_f_ != false) $this->psid_buscar= substr($this->search, $busqueda_f_ + 13);
            else $this->psid_buscar= $this->search;

            if($this->jumper_complete == "") {
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
                    $date_actual_30 = $date->modify('-30 minute')->format('Y-m-d H:i:s');

                    $links_usados = Links_usados::where('k_detected','KTMR')
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

        return view('livewire.jumpers.ktmr.ktmr-index');
    }

    public function clear(){
        $this->reset(['search']);
        $this->jumper_complete = "";
        session()->forget('search');
        $this->busqueda_link = "";
        return redirect()->route('ktmr.index');
    }
}
