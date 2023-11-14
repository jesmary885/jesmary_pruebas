<?php

namespace App\Http\Livewire\Ktmr;

use App\Models\Antibot;
use App\Models\CuentasKtmr;
use App\Models\User;
use DateTime;
use GuzzleHttp\Client;
use Livewire\Component;

class Generador extends Component
{
    public $registro_datos,$user,$calculo = 0, $total_jump_dia, $jumper_complete = "", $search,$type, $jumper_detect = 0,$busqueda_link,$operacion;

    protected $listeners = ['render' => 'render', 'jumpear' => 'jumpear', 'verific' => 'verific', 'jump' => 'jump'];

    public function mount(){
     
        $this->jumper_detect = 0;
        $this->busqueda_link = "";

        $this->user = User::where('id',auth()->user()->id)->first();
    }
    
    public function numerologia(){

        $cant = Antibot::count();
        $random = rand(1,$cant);
        $this->operacion = Antibot::where('id',$random)->first();
        $operacion_total = 'Resuelve esta operación matemática ('.$this->operacion->nro1.' + '.$this->operacion->nro2. ')';

        $this->emit('numerologia',$operacion_total,'ktmr.generador','verific');
    }

    public function verific($result){

        if($result[0] == $this->operacion->resultado){

            $busqueda_pid_ = strpos($this->search, '&pid=');

            if($busqueda_pid_ != false){
          
                $posicion_pid = $busqueda_pid_ + 5;
                $i_pid = 0;
                $busq_pid = 0;
                            
                do{
                    $detect_pid= substr($this->search, $posicion_pid,1);
        
                    if($detect_pid == '&') $i_pid = 1;
                    else{
                        $posicion_pid = $posicion_pid + 1;
                        $busq_pid ++;
                    }
        
                }while($i_pid != 1);

                //if($busq_pid < 15)
                $pid_buscar = substr($this->search,($busqueda_pid_ + 5),($posicion_pid - ($busqueda_pid_ + 5)));
                //else
                //$this->jumper_detect = 3;
            }

            $busqueda_state_ = strpos($this->search, '&state=');

            if($busqueda_state_ != false){
          
                $posicion_state = $busqueda_state_ + 7;
                $state_buscar = substr($this->search,($posicion_state));

   

            }

            $busqueda_y_ = strpos($this->search, '&y=');

            if($busqueda_y_ != false){
          
                $posicion_y = $busqueda_y_ + 3;
                $i_y = 0;
                $busq_y = 0;
                            
                do{
                    $detect_y= substr($this->search, $posicion_y,1);
        
                    if($detect_y == '&') $i_y = 1;
                    else{
                        $posicion_y = $posicion_y + 1;
                        $busq_y ++;
                    }
        
                }while($i_y != 1);

                //if($busq_pid < 15)
                $y_buscar = substr($this->search,($busqueda_y_ + 3),($posicion_y - ($busqueda_y_ + 3)));

            }

            $busqueda_pri_ = strpos($this->search, '&pri=');

            if($busqueda_pri_ != false){
          
                $posicion_pri = $busqueda_pri_ + 5;
                $i_pri = 0;
                            
                do{
                    $detect_pri= substr($this->search, $posicion_pri,1);
        
                    if($detect_pri == '&') $i_pri = 1;
                    else{
                        $posicion_pri = $posicion_pri + 1;

                    }
        
                }while($i_pri != 1);

                //if($busq_pid < 15)
                $pri_buscar = substr($this->search,($busqueda_pri_ + 5),($posicion_pri - ($busqueda_pri_ + 5)));
            }

            try {

                $client = new Client([
                    //'base_uri' => 'http://127.0.0.1:8000',
                    'base_uri' => 'http://146.190.74.228/',
                ]);

    
               $resultado = $client->request('GET', '/ktmr1500/1/'.$pid_buscar.'/'.$state_buscar.'/'.$y_buscar.'/'.$pri_buscar);
    
                if($resultado->getStatusCode() == 200){

                    $this->jumper_complete = json_decode($resultado->getBody(),true);

                    $link_register = new CuentasKtmr();
                    $link_register->link_inicial = $this->search;
                    $link_register->link_resultado = $this->jumper_complete['jumper'];
                    $link_register->user_id  = $this->user->id;
                    $link_register->save();

                    $this->jumper_detect = 1;
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

        $this->total_jump_dia = CuentasKtmr::where('user_id',$this->user->id)
            ->count();
        
        if($long_psid>5){

            $registro_datos_count = CuentasKtmr::where('user_id',$this->user->id)->get();

            foreach($registro_datos_count as $registros_c){

                if($registros_c->email == '' || $registros_c->password == '') $this->registro_datos = 1;
                else $this->registro_datos = 0;

            }


            if($this->jumper_complete == "" && $this->jumper_detect == 0) {

                if($this->registro_datos == 0) $this->numerologia();
                else $this->jumper_detect = 10;

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

        return view('livewire.ktmr.generador');
    }

    public function clear(){
        $this->reset(['search']);
        $this->jumper_complete = "";
        session()->forget('search');
        $this->busqueda_link = "";
        return redirect()->route('ktmr.generador.index');
    }
}
